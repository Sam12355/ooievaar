<?php


function avw_distillery_scripts() {
    // Enqueue Main Style with dynamic version to kill cache
    wp_enqueue_style('avw-style', get_stylesheet_uri(), array(), time());

    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,400&display=swap', array(), null);

    // Enqueue Tailwind (CDN)
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null, false);

    // Enqueue Swiper for carousels
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);

    // Enqueue Main Script with dynamic version
    wp_enqueue_script('avw-main-script', get_template_directory_uri() . '/js/script.js', array('swiper-js'), time(), true);
}
add_action('wp_enqueue_scripts', 'avw_distillery_scripts');

function avw_tailwind_config() {
    ?>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        kurversbrug: ['Kurversbrug', 'serif'],
                        sans: ['DM Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <?php
}
add_action('wp_head', 'avw_tailwind_config');

function avw_setup_theme() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'avw-distillery' ),
    ) );
}
add_action( 'after_setup_theme', 'avw_setup_theme' );

function avw_widgets_init() {
    register_sidebar( array(
        'name'          => 'Shop Sidebar',
        'id'            => 'shop-sidebar',
        'before_widget' => '<div class="widget %2$s mb-10 border-b border-[#36221d]/10 pb-8 last:border-0">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="font-kurversbrug text-[22px] sm:text-[26px] text-[#36221d] mb-5 uppercase tracking-wide">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'avw_widgets_init' );

// Add SKU to search
function avw_force_exact_sentence_search( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $pt = $query->get('post_type');
        if ( $pt === 'product' || (is_array($pt) && in_array('product', $pt)) || (isset($_GET['post_type']) && $_GET['post_type'] === 'product') ) {
            $query->set( 'sentence', 1 );
            
            // BREAK OUT OF CATEGORY LOCK: If we are searching, ignore the current category/taxonomy filter
            if ( ! is_admin() ) {
                $query->set( 'tax_query', array() );
                $query->set( 'product_cat', '' );
                $query->set( 'taxonomy', '' );
                $query->set( 'term', '' );
                // Explicitly clear the 'product_cat' from the query string to be safe
                if (isset($query->query_vars['product_cat'])) unset($query->query_vars['product_cat']);
                if (isset($query->query_vars['taxonomy'])) unset($query->query_vars['taxonomy']);
                if (isset($query->query_vars['term'])) unset($query->query_vars['term']);
            }

            // PRECISION PRICE FILTERING
            if ( isset($_GET['min_price']) || isset($_GET['max_price']) ) {
                $meta_query = $query->get('meta_query');
                if ( ! is_array($meta_query) ) $meta_query = array();
                
                $price_filter = array(
                    'key'     => '_price',
                    'type'    => 'NUMERIC',
                    'compare' => 'BETWEEN',
                );

                $min = isset($_GET['min_price']) ? floatval($_GET['min_price']) : 0;
                $max = isset($_GET['max_price']) ? floatval($_GET['max_price']) : 999999;
                
                $price_filter['value'] = array($min, $max);
                $meta_query[] = $price_filter;
                
                $query->set('meta_query', $meta_query);
            }
        }
    }
}
add_action( 'pre_get_posts', 'avw_force_exact_sentence_search', 999 );

// Force the correct template for all product-related archive views and the assortment page
function avw_force_product_template( $template ) {
    $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $is_assortment = (strpos($uri, 'assortment') !== false) || is_shop() || is_product_taxonomy();
    $is_product_search = is_search() && (get_query_var( 'post_type' ) === 'product' || (isset($_GET['post_type']) && $_GET['post_type'] === 'product'));
    
    if ( $is_assortment || $is_product_search ) {
        $new_template = locate_template( array( 'woocommerce/archive-product.php' ) );
        if ( '' != $new_template ) {
            return $new_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'avw_force_product_template', 999 );

// Prevent SEO/Redirect plugins from hijacking search requests
function avw_prevent_search_redirects( $redirect_url ) {
    if ( is_search() && (isset($_GET['post_type']) && $_GET['post_type'] === 'product') ) {
        return false;
    }
    return $redirect_url;
}
add_filter( 'redirect_canonical', 'avw_prevent_search_redirects', 10 );


function avw_product_search_join( $join, $query ) {
    global $wpdb;
    $pt = $query->get('post_type');
    $is_product = ( $pt === 'product' || is_array($pt) && in_array('product', $pt) || (isset($_GET['post_type']) && $_GET['post_type'] === 'product') );
    
    if ( ! is_admin() && $query->is_search() && $query->is_main_query() && $is_product ) {
        $join .= " LEFT JOIN {$wpdb->postmeta} AS pm_sku ON ({$wpdb->posts}.ID = pm_sku.post_id AND pm_sku.meta_key = '_sku') ";
    }
    return $join;
}
add_filter( 'posts_join', 'avw_product_search_join', 10, 2 );

// Replace WP's default word-splitting search (which breaks on hyphens) with exact phrase matching
function avw_custom_woo_search( $search, $wp_query ) {
    global $wpdb;
    $pt = $wp_query->get('post_type');
    $is_product = ( $pt === 'product' || (is_array($pt) && in_array('product', $pt)) || (isset($_GET['post_type']) && $_GET['post_type'] === 'product') );
    
    if ( ! is_admin() && $wp_query->is_search() && $wp_query->is_main_query() && $is_product ) {
        $search_term = $wp_query->get('s');
        if ( empty( $search_term ) ) return $search;
        
        // Clean the search term: replace weird dashes with a simple space or hyphen
        $search_term = str_replace(array('–', '—'), '-', $search_term);
        
        // Split into words for an "AND" search (must contain all words)
        $words = explode(' ', $search_term);
        $search = " AND ( ";
        $subcases = array();
        
        foreach($words as $word) {
            $word = trim($word);
            if(empty($word)) continue;
            $like = '%' . $wpdb->esc_like( $word ) . '%';
            $subcases[] = "({$wpdb->posts}.post_title LIKE '{$like}' OR pm_sku.meta_value LIKE '{$like}')";
        }
        
        $search .= implode(' AND ', $subcases);
        $search .= " ) ";
    }
    return $search;
}
add_filter( 'posts_search', 'avw_custom_woo_search', 500, 2 );

// NUCLEAR OPTION: Physically strip the "term_taxonomy_id IN (XXX)" from the WHERE clause during search
function avw_nuclear_search_globalizer( $where, $wp_query ) {
    if ( ! is_admin() && $wp_query->is_search() && $wp_query->is_main_query() ) {
        $pt = $wp_query->get('post_type');
        if ( $pt === 'product' || (is_array($pt) && in_array('product', $pt)) || (isset($_GET['post_type']) && $_GET['post_type'] === 'product') ) {
            // This regex removes the category restriction entirely
            $where = preg_replace('/AND\s*\(\s*[^)]*?term_taxonomy_id\s+IN\s*\(\d+\)\s*\)/i', '', $where);
        }
    }
    return $where;
}
add_filter( 'posts_where', 'avw_nuclear_search_globalizer', 999, 2 );

/**
 * AUTO-SETUP: Create the Full Boutique Menu with Hierarchy
 */
function avw_auto_create_menu() {
    $menu_name = 'Supreme Boutique Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);

        $full_structure = array(
            'De Distilleerderij' => array(
                'url' => '#',
                'children' => array(
                    'Over' => '#',
                    'Receptuur & ambacht' => '#',
                    'Familiegeschiedenis' => '#',
                    'Vacatures' => '#',
                    'Contact' => '#',
                )
            ),
            'Producten' => array(
                'url' => '#',
                'children' => array(
                    'Assortiment' => '/assortiment/',
                )
            ),
            'Beleef' => array(
                'url' => '#',
                'children' => array(
                    'Proeflokaal' => '#',
                    'Rondleiding / Proeverij' => '#',
                    'Geneverschool' => '#'
                )
            ),
            'Kennis' => array(
                'url' => '#',
                'children' => array(
                    'Kennisbank' => array(
                        'url' => '#',
                        'children' => array('Kennis Artikel' => '#')
                    )
                )
            ),
            'Webwinkel' => array(
                'url' => '#',
                'children' => array(
                    'Producten' => array(
                        'url' => '#',
                        'children' => array(
                            'Categorien' => array('url' => '#', 'children' => array('Product' => '#')),
                            'Mandje' => '#',
                            'Afrekenen' => '#',
                            'Account/Inloggen' => '#',
                            'Service' => array('url' => '#', 'children' => array('FAQ' => '#', 'Verzend Info' => '#'))
                        )
                    ),
                    'Zakelijk' => '#'
                )
            ),
            'Blog & Nieuws' => array(
                'url' => '#',
                'children' => array('Artikel' => '#')
            )
        );

        if (!function_exists('avw_build_menu_recursive_setup')) {
            function avw_build_menu_recursive_setup($items, $menu_id, $parent_id = 0) {
                foreach ($items as $title => $data) {
                    $url = (is_array($data) && isset($data['url'])) ? $data['url'] : (is_array($data) ? '#' : $data);
                    $item_id = wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title'     => $title,
                        'menu-item-url'       => $url,
                        'menu-item-status'    => 'publish',
                        'menu-item-type'      => 'custom',
                        'menu-item-parent-id' => $parent_id,
                    ));
                    if (is_array($data)) {
                        $children = isset($data['children']) ? $data['children'] : (isset($data['url']) ? array() : $data);
                        if (!empty($children) && is_array($children)) {
                            avw_build_menu_recursive_setup($children, $menu_id, $item_id);
                        }
                    }
                }
            }
        }
        
        avw_build_menu_recursive_setup($full_structure, $menu_id);

        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}
add_action('init', 'avw_auto_create_menu');

/**
 * RECURSIVE dropdown RENDERER: The engine that powers infinite depth
 */
if (!function_exists('avw_render_dropdown')) {
    function avw_render_dropdown($children, $level = 1) {
        $z_index = 100 + $level;
        $is_first = ($level === 1);
        $pos_class = $is_first ? 'avw-drop-down' : 'avw-drop-right';
        ?>
        <div class="avw-dropdown <?php echo $pos_class; ?>" style="z-index:<?php echo $z_index; ?>;">
            <div class="bg-black border border-[#cdbca6]/10 rounded-xl shadow-2xl p-6 min-w-[240px]">
                <div class="flex flex-col gap-4">
                    <?php foreach ($children as $child) : ?>
                        <div class="avw-has-drop relative">
                            <a href="<?php echo esc_url($child->url); ?>" class="font-kurversbrug text-[#cdbca6]/80 text-[13px] uppercase tracking-wide hover:text-white flex items-center justify-between gap-4" style="text-decoration:none;">
                                <?php echo esc_html($child->title); ?>
                                <?php if (!empty($child->children)) : ?>
                                    <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                <?php endif; ?>
                            </a>
                            <?php if (!empty($child->children)) avw_render_dropdown($child->children, $level + 1); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }
}

/**
 * Boutique Menu Styling: Inject Tailwind & Kurversbrug classes into native WP Menu links
 */
function avw_add_menu_link_class( $atts, $item, $args ) {
    // Fuzzy matching to support Polylang/WPML language suffixes (e.g. primary___nl)
    if ( strpos( $args->theme_location, 'primary' ) !== false ) {
        $atts['class'] = 'font-kurversbrug font-light text-[#cdbca6] text-[14px] uppercase tracking-wider hover:text-white transition-colors whitespace-nowrap';
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'avw_add_menu_link_class', 10, 3 );

/**
 * Mobile Menu Styling: Inject alternate styles for the dropdown
 */
function avw_add_mobile_menu_link_class( $atts, $item, $args ) {
    if ( $args->theme_location == 'mobile' ) {
        $atts['class'] = 'block py-2 text-[#cdbca6] hover:text-white transition-colors';
    }
    return $atts;
}
// Note: We are using 'primary' for both for now, but filtered by the items_wrap in header.

/**
 * AJAX Cart Update: Update the header count when items are added to cart
 */
/**
 * AJAX Cart Update: Update the header count and sidebar totals
 */
function avw_cart_fragments( $fragments ) {
    // 1. Cart Badge Count
    ob_start();
    $cart_count = (isset(WC()->cart) && WC()->cart) ? WC()->cart->get_cart_contents_count() : 0;
    ?>
    <div id="cart-badge" class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-md transition-all <?php echo $cart_count > 0 ? 'scale-100 opacity-100' : 'scale-0 opacity-0'; ?>">
        <?php echo $cart_count; ?>
    </div>
    <?php
    $fragments['div#cart-badge'] = ob_get_clean();

    // 2. Totals Sidebar Panel (This is crucial for real-time updates)
    if ( is_cart() ) {
        ob_start();
        ?>
        <div class="avw-totals-sidebar" id="avw-cart-totals-sidebar">
            <h2 class="avw-totals-sidebar-title"><?php esc_html_e( 'Order Summary', 'woocommerce' ); ?></h2>

            <div class="avw-totals-row">
                <span class="avw-totals-label"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
                <span class="avw-totals-value"><?php wc_cart_totals_subtotal_html(); ?></span>
            </div>

            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <div class="avw-totals-row coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <span class="avw-totals-label"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
                    <span class="avw-totals-value"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
                </div>
            <?php endforeach; ?>

            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                <div class="avw-totals-row" style="flex-direction: column; align-items: flex-start; gap: 10px;">
                    <span class="avw-totals-label"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></span>
                    <div style="width:100%; font-size:12px; color: rgba(19,62,35,0.55);">
                        <?php woocommerce_shipping_calculator(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                <div class="avw-totals-row">
                    <span class="avw-totals-label"><?php echo esc_html( $fee->name ); ?></span>
                    <span class="avw-totals-value"><?php wc_cart_totals_fee_html( $fee ); ?></span>
                </div>
            <?php endforeach; ?>

            <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

            <div class="avw-totals-total-row">
                <span class="avw-totals-total-label"><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
                <div style="text-align: right;">
                    <?php $total_price = wc_price( WC()->cart->get_total( 'edit' ) ); ?>
                    <div class="avw-totals-total-amount"><?php echo $total_price; ?></div>
                    <?php if ( wc_tax_enabled() && WC()->cart->display_prices_including_tax() ) :
                        $tax_totals = WC()->cart->get_tax_totals();
                        if ( ! empty( $tax_totals ) ) : ?>
                        <div class="avw-totals-tax-note">
                            <?php if ( 'itemized' === get_option( 'woocommerce_tax_display_cart' ) ) :
                                foreach ( $tax_totals as $code => $tax ) :
                                    echo esc_html( $tax->label ) . ': ' . wp_kses_post( $tax->formatted_amount ) . '<br>';
                                endforeach;
                            else :
                                $tax_total_amount = wc_price( array_sum( wp_list_pluck( $tax_totals, 'amount' ) ) );
                                printf( esc_html__( 'incl. %1$s %2$s', 'woocommerce' ), WC()->countries->tax_or_vat(), $tax_total_amount );
                            endif; ?>
                        </div>
                    <?php endif; endif; ?>
                </div>
            </div>

            <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="avw-checkout-btn wc-forward checkout-button">
                <?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?>
            </a>

            <div class="avw-trust-badge">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <span><?php esc_html_e( 'Secure checkout', 'woocommerce' ); ?></span>
            </div>
        </div>
        <?php
        $fragments['#avw-cart-totals-sidebar'] = ob_get_clean();
    }

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'avw_cart_fragments' );
add_filter( 'woocommerce_update_order_review_fragments', 'avw_cart_fragments' );

/**
 * BOUTIQUE FAVORITES SYSTEM
 */

// Toggle Favorite via AJAX
add_action('wp_ajax_avw_v3_toggle_fav', 'avw_toggle_favorite');
add_action('wp_ajax_nopriv_avw_v3_toggle_fav', 'avw_toggle_favorite');

function avw_toggle_favorite() {
    ob_clean(); // Clear any stray server output
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    if (!$product_id) {
        wp_send_json_error('Invalid Product ID');
    }

    $favorites = avw_get_favorites();
    
    // Ensure we have an array and strict integers
    if (!is_array($favorites)) {
        $favorites = array();
    } else {
        $favorites = array_map('intval', $favorites);
    }

    $key = array_search($product_id, $favorites);

    if ($key !== false) {
        unset($favorites[$key]);
        $status = 'removed';
    } else {
        $favorites[] = $product_id;
        $status = 'added';
    }

    $favorites = array_values(array_unique($favorites));

    // Save to Cookie (Standard path/domain for compatibility)
    setcookie('avw_favorites', json_encode($favorites), time() + (30 * 86400), '/');

    // Save to User Meta (if logged in)
    if (is_user_logged_in()) {
        update_user_meta(get_current_user_id(), 'avw_favorites', $favorites);
    }

    wp_send_json_success(array(
        'status' => $status,
        'count'  => count($favorites)
    ));
}

// Get raw favorites array
function avw_get_favorites() {
    if (is_user_logged_in()) {
        $favs = get_user_meta(get_current_user_id(), 'avw_favorites', true);
        if (is_array($favs)) return $favs;
    }

    $cookie = isset($_COOKIE['avw_favorites']) ? stripslashes($_COOKIE['avw_favorites']) : '';
    $favs = json_decode($cookie, true);
    return is_array($favs) ? $favs : array();
}

// Helper to check if product is favorited
function avw_is_favorited($product_id) {
    return in_array($product_id, avw_get_favorites());
}

/* Replace 'Edit' text with a pencil icon on My Account Addresses page */
add_filter( 'woocommerce_my_account_my_address_edit_address_link_text', 'avw_edit_address_pencil_icon', 10, 2 );
function avw_edit_address_pencil_icon( $text, $load_address ) {
    return '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
}

/**
 * AJAX Add to Cart for Single Product
 */
add_action('wp_ajax_avw_ajax_add_to_cart', 'avw_ajax_add_to_cart');
add_action('wp_ajax_nopriv_avw_ajax_add_to_cart', 'avw_ajax_add_to_cart');

function avw_ajax_add_to_cart() {
    // Determine Product ID (WooCommerce forms often use 'add-to-cart' field name)
    $product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;
    if (!$product_id && isset($_POST['add-to-cart'])) {
        $product_id = absint($_POST['add-to-cart']);
    }

    $quantity = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;
    $variation_id = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : 0;
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id)) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if (get_option('woocommerce_cart_redirect_after_add') == 'yes') {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        WC_AJAX::get_refreshed_fragments();
    } else {
        $data = array(
            'error' => true,
            'product_url' => get_permalink($product_id)
        );
        wp_send_json($data);
    }
    wp_die();
}

/**
 * RECEPTEN: Custom Post Type + Taxonomies
 */
function avw_register_recept_cpt() {
    register_post_type( 'recept', array(
        'labels' => array(
            'name'               => 'Recepten',
            'singular_name'      => 'Recept',
            'add_new'            => 'Nieuw Recept',
            'add_new_item'       => 'Nieuw Recept Toevoegen',
            'edit_item'          => 'Recept Bewerken',
            'new_item'           => 'Nieuw Recept',
            'view_item'          => 'Recept Bekijken',
            'search_items'       => 'Recepten Zoeken',
            'not_found'          => 'Geen recepten gevonden',
            'not_found_in_trash' => 'Geen recepten in prullenbak',
        ),
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'recept' ),
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'          => 'dashicons-food',
        'show_in_rest'       => true,
    ));

    register_taxonomy( 'recept_product', 'recept', array(
        'labels'       => array( 'name' => 'Producten', 'singular_name' => 'Product' ),
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => array( 'slug' => 'recept-product' ),
        'show_in_rest' => true,
    ));

    register_taxonomy( 'recept_soort', 'recept', array(
        'labels'       => array( 'name' => 'Soorten', 'singular_name' => 'Soort' ),
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => array( 'slug' => 'recept-soort' ),
        'show_in_rest' => true,
    ));

    register_taxonomy( 'recept_gelegenheid', 'recept', array(
        'labels'       => array( 'name' => 'Gelegenheden', 'singular_name' => 'Gelegenheid' ),
        'hierarchical' => true,
        'public'       => true,
        'rewrite'      => array( 'slug' => 'recept-gelegenheid' ),
        'show_in_rest' => true,
    ));
}
add_action( 'init', 'avw_register_recept_cpt' );

/**
 * RECEPTEN: Seed default taxonomy terms (runs once per term, safe to re-run)
 */
function avw_seed_recept_terms() {
    if ( get_option( 'avw_recept_terms_v2' ) ) return;

    // Remove old placeholder terms
    $old_soorten = array( 'Cocktail', 'Longdrink', 'Shot', 'Mocktail', 'Warm drankje', 'Punch' );
    foreach ( $old_soorten as $name ) {
        $term = get_term_by( 'name', $name, 'recept_soort' );
        if ( $term ) wp_delete_term( $term->term_id, 'recept_soort' );
    }
    $old_gelegenheden = array( 'Zomer', 'Winter', 'Feest', 'Kerst', 'Verjaardag', 'Borrel' );
    foreach ( $old_gelegenheden as $name ) {
        $term = get_term_by( 'name', $name, 'recept_gelegenheid' );
        if ( $term ) wp_delete_term( $term->term_id, 'recept_gelegenheid' );
    }
    $old_products = array( 'Jonge genever', 'Oude genever', 'Korenwijn', 'Gin', 'Likeuren', 'Bitters' );
    foreach ( $old_products as $name ) {
        $term = get_term_by( 'name', $name, 'recept_product' );
        if ( $term ) wp_delete_term( $term->term_id, 'recept_product' );
    }

    // Seed correct terms from original site
    foreach ( array( 'Dessert', 'Zoet' ) as $name ) {
        if ( ! term_exists( $name, 'recept_soort' ) ) wp_insert_term( $name, 'recept_soort' );
    }
    foreach ( array( 'Bij de koffie', 'Feestdag' ) as $name ) {
        if ( ! term_exists( $name, 'recept_gelegenheid' ) ) wp_insert_term( $name, 'recept_gelegenheid' );
    }

    update_option( 'avw_recept_terms_v2', '1' );
}
add_action( 'init', 'avw_seed_recept_terms', 20 );

/**
 * RECEPTEN: AJAX search handler
 */
add_action( 'wp_ajax_avw_recept_search', 'avw_recept_search' );
add_action( 'wp_ajax_nopriv_avw_recept_search', 'avw_recept_search' );

function avw_recept_search() {
    $product     = isset($_POST['product'])     ? sanitize_text_field($_POST['product'])     : '';
    $soort       = isset($_POST['soort'])       ? sanitize_text_field($_POST['soort'])       : '';
    $gelegenheid = isset($_POST['gelegenheid']) ? sanitize_text_field($_POST['gelegenheid']) : '';
    $keyword     = isset($_POST['keyword'])     ? sanitize_text_field($_POST['keyword'])     : '';

    $args = array(
        'post_type'      => 'recept',
        'post_status'    => 'publish',
        'posts_per_page' => 50,
        'orderby'        => 'title',
        'order'          => 'ASC',
    );

    $tax_query = array( 'relation' => 'AND' );
    if ( $product )     $tax_query[] = array( 'taxonomy' => 'recept_product',     'field' => 'slug', 'terms' => $product );
    if ( $soort )       $tax_query[] = array( 'taxonomy' => 'recept_soort',       'field' => 'slug', 'terms' => $soort );
    if ( $gelegenheid ) $tax_query[] = array( 'taxonomy' => 'recept_gelegenheid', 'field' => 'slug', 'terms' => $gelegenheid );
    if ( count($tax_query) > 1 ) $args['tax_query'] = $tax_query;

    if ( $keyword ) $args['s'] = $keyword;

    $query = new WP_Query( $args );
    $results = array();

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $img = get_the_post_thumbnail_url( get_the_ID(), 'large' )
                ?: get_the_post_thumbnail_url( get_the_ID(), 'full' );
            if ( ! $img ) {
                preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/', get_the_content(), $m );
                if ( ! empty( $m[1] ) ) $img = $m[1];
            }
            $results[] = array(
                'id'      => get_the_ID(),
                'title'   => get_the_title(),
                'url'     => get_permalink(),
                'excerpt' => wp_trim_words( get_the_excerpt(), 18 ),
                'image'   => $img ?: '',
            );
        }
        wp_reset_postdata();
    }

    wp_send_json_success( $results );
}

/**
 * VACATURES: Custom Post Type
 */
function avw_register_vacature_cpt() {
    register_post_type( 'vacature', array(
        'labels' => array(
            'name'               => 'Vacatures',
            'singular_name'      => 'Vacature',
            'add_new'            => 'Nieuwe Vacature',
            'add_new_item'       => 'Nieuwe Vacature Toevoegen',
            'edit_item'          => 'Vacature Bewerken',
            'new_item'           => 'Nieuwe Vacature',
            'view_item'          => 'Vacature Bekijken',
            'search_items'       => 'Vacatures Zoeken',
            'not_found'          => 'Geen vacatures gevonden',
            'not_found_in_trash' => 'Geen vacatures in prullenbak',
            'all_items'          => 'Alle Vacatures',
        ),
        'public'         => true,
        'has_archive'    => false,
        'rewrite'        => array( 'slug' => 'vacature' ),
        'supports'       => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon'      => 'dashicons-id-alt',
        'menu_position'  => 5,
        'show_in_rest'   => true,
    ));
}
add_action( 'init', 'avw_register_vacature_cpt' );

/**
 * VACATURES: Meta box for vacancy details
 */
function avw_vacature_meta_box() {
    add_meta_box(
        'avw_vacature_details',
        'Vacature Details',
        'avw_vacature_meta_box_html',
        'vacature',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'avw_vacature_meta_box' );

function avw_vacature_meta_box_html( $post ) {
    wp_nonce_field( 'avw_vacature_save', 'avw_vacature_nonce' );
    $afdeling     = get_post_meta( $post->ID, '_vacature_afdeling',     true );
    $locatie      = get_post_meta( $post->ID, '_vacature_locatie',      true );
    $uren         = get_post_meta( $post->ID, '_vacature_uren',         true );
    $contracttype = get_post_meta( $post->ID, '_vacature_contracttype', true );
    ?>
    <p>
        <label style="font-weight:600;display:block;margin-bottom:4px;">Afdeling</label>
        <input type="text" name="vacature_afdeling" value="<?php echo esc_attr($afdeling); ?>" style="width:100%;" placeholder="bijv. Productie" />
    </p>
    <p>
        <label style="font-weight:600;display:block;margin-bottom:4px;">Locatie</label>
        <input type="text" name="vacature_locatie" value="<?php echo esc_attr($locatie); ?>" style="width:100%;" placeholder="bijv. Amsterdam" />
    </p>
    <p>
        <label style="font-weight:600;display:block;margin-bottom:4px;">Uren per week</label>
        <input type="text" name="vacature_uren" value="<?php echo esc_attr($uren); ?>" style="width:100%;" placeholder="bijv. 32-40 uur" />
    </p>
    <p>
        <label style="font-weight:600;display:block;margin-bottom:4px;">Contracttype</label>
        <select name="vacature_contracttype" style="width:100%;">
            <option value="">— kies —</option>
            <?php foreach ( array('Vast', 'Tijdelijk', 'Freelance', 'Stage') as $opt ): ?>
                <option value="<?php echo $opt; ?>" <?php selected( $contracttype, $opt ); ?>><?php echo $opt; ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <?php
}

function avw_vacature_save_meta( $post_id ) {
    if ( ! isset($_POST['avw_vacature_nonce']) || ! wp_verify_nonce($_POST['avw_vacature_nonce'], 'avw_vacature_save') ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( ! current_user_can('edit_post', $post_id) ) return;

    $fields = array( 'vacature_afdeling', 'vacature_locatie', 'vacature_uren', 'vacature_contracttype' );
    foreach ( $fields as $field ) {
        if ( isset($_POST[$field]) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field($_POST[$field]) );
        }
    }
}
add_action( 'save_post_vacature', 'avw_vacature_save_meta' );

/**
 * VACATURES: Custom admin columns
 */
function avw_vacature_columns( $cols ) {
    return array(
        'cb'                    => $cols['cb'],
        'title'                 => 'Functie',
        'vacature_afdeling'     => 'Afdeling',
        'vacature_locatie'      => 'Locatie',
        'vacature_uren'         => 'Uren',
        'vacature_contracttype' => 'Contract',
        'date'                  => 'Datum',
    );
}
add_filter( 'manage_vacature_posts_columns', 'avw_vacature_columns' );

function avw_vacature_column_content( $col, $post_id ) {
    $map = array(
        'vacature_afdeling'     => '_vacature_afdeling',
        'vacature_locatie'      => '_vacature_locatie',
        'vacature_uren'         => '_vacature_uren',
        'vacature_contracttype' => '_vacature_contracttype',
    );
    if ( isset($map[$col]) ) {
        echo esc_html( get_post_meta($post_id, $map[$col], true) ?: '—' );
    }
}
add_action( 'manage_vacature_posts_custom_column', 'avw_vacature_column_content', 10, 2 );


/**
 * NIEUWS: Custom Post Type
 */
function avw_register_nieuws_cpt() {
    register_post_type( 'avw_nieuws', array(
        'labels' => array(
            'name'               => 'Nieuws',
            'singular_name'      => 'Nieuwsbericht',
            'add_new'            => 'Nieuw Bericht',
            'add_new_item'       => 'Nieuw Nieuwsbericht Toevoegen',
            'edit_item'          => 'Nieuwsbericht Bewerken',
            'new_item'           => 'Nieuw Nieuwsbericht',
            'view_item'          => 'Nieuwsbericht Bekijken',
            'search_items'       => 'Nieuwsberichten Zoeken',
            'not_found'          => 'Geen nieuwsberichten gevonden',
            'not_found_in_trash' => 'Geen nieuwsberichten in prullenbak',
            'all_items'          => 'Alle Nieuwsberichten',
        ),
        'public'          => true,
        'has_archive'     => false,
        'rewrite'         => array( 'slug' => 'nieuws-item' ),
        'supports'        => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'       => 'dashicons-megaphone',
        'menu_position'   => 4,
        'show_in_rest'    => true,
    ));
}
add_action( 'init', 'avw_register_nieuws_cpt' );

/**
 * Auto-apply page-nieuws.php template to any page with a news-related slug
 * so the English news page works even if the template wasn't manually assigned.
 */
add_filter( 'page_template', function( $template ) {
    if ( ! is_page() ) return $template;
    $news_slugs = array( 'news', 'nieuws', 'en-nieuws', 'news-en', 'nl-nieuws', 'actueel' );
    if ( is_page( $news_slugs ) ) {
        $t = get_template_directory() . '/page-nieuws.php';
        if ( file_exists( $t ) ) return $t;
    }
    return $template;
} );

/**
 * NIEUWS: Custom admin columns
 */
function avw_nieuws_columns( $cols ) {
    return array(
        'cb'            => $cols['cb'],
        'title'         => 'Titel',
        'nieuws_thumb'  => 'Foto',
        'date'          => 'Datum',
    );
}
add_filter( 'manage_avw_nieuws_posts_columns', 'avw_nieuws_columns' );

function avw_nieuws_column_content( $col, $post_id ) {
    if ( $col === 'nieuws_thumb' ) {
        $thumb = get_the_post_thumbnail( $post_id, array(60, 40) );
        echo $thumb ?: '—';
    }
}
add_action( 'manage_avw_nieuws_posts_custom_column', 'avw_nieuws_column_content', 10, 2 );

/**
 * KENNISBANK: Custom Post Type
 */
function avw_register_kennis_cpt() {
    register_post_type( 'avw_kennis', array(
        'labels' => array(
            'name'               => 'Kennisbank',
            'singular_name'      => 'Kennisartikel',
            'add_new'            => 'Nieuw Artikel',
            'add_new_item'       => 'Nieuw Kennisartikel Toevoegen',
            'edit_item'          => 'Kennisartikel Bewerken',
            'new_item'           => 'Nieuw Kennisartikel',
            'view_item'          => 'Kennisartikel Bekijken',
            'search_items'       => 'Kennisartikelen Zoeken',
            'not_found'          => 'Geen kennisartikelen gevonden',
            'not_found_in_trash' => 'Geen kennisartikelen in prullenbak',
            'all_items'          => 'Alle Kennisartikelen',
        ),
        'public'          => true,
        'has_archive'     => false,
        'rewrite'         => array( 'slug' => 'kennis-artikel' ),
        'supports'        => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'       => 'dashicons-book-alt',
        'menu_position'   => 5,
        'show_in_rest'    => true,
    ));
}
add_action( 'init', 'avw_register_kennis_cpt' );

/**
 * KENNISBANK: Custom admin columns
 */
function avw_kennis_columns( $cols ) {
    return array(
        'cb'           => $cols['cb'],
        'title'        => 'Titel',
        'kennis_thumb' => 'Afbeelding',
        'date'         => 'Datum',
    );
}
add_filter( 'manage_avw_kennis_posts_columns', 'avw_kennis_columns' );

function avw_kennis_column_content( $col, $post_id ) {
    if ( $col === 'kennis_thumb' ) {
        $thumb = get_the_post_thumbnail( $post_id, array( 60, 40 ) );
        echo $thumb ?: '—';
    }
}
add_action( 'manage_avw_kennis_posts_custom_column', 'avw_kennis_column_content', 10, 2 );

// Flush rewrite rules so avw_kennis single URLs resolve correctly
add_action( 'init', function() {
    if ( get_option('avw_kennis_rules_v3') ) return;
    flush_rewrite_rules();
    update_option('avw_kennis_rules_v3', 1);
}, 999 );

/**
 * Register avw_kennis and avw_nieuws as translatable post types in Polylang.
 * This enables the language metabox, "+" translation button, and language switcher
 * on single posts for both CPTs.
 */
add_filter( 'pll_get_post_types', function( $post_types, $is_settings ) {
    $post_types['avw_kennis'] = 'avw_kennis';
    $post_types['avw_nieuws'] = 'avw_nieuws';
    return $post_types;
}, 10, 2 );

/**
 * SEARCH: Live product search
 */
add_action('wp_ajax_avw_live_search',        'avw_live_search');
add_action('wp_ajax_nopriv_avw_live_search', 'avw_live_search');

function avw_live_search() {
    $query = sanitize_text_field( $_POST['query'] ?? '' );
    if ( mb_strlen( $query ) < 2 ) {
        wp_send_json_success( array( 'html' => '', 'count' => 0, 'url' => '' ) );
    }

    $products = new WP_Query( array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        's'              => $query,
        'posts_per_page' => 6,
    ) );

    ob_start();
    while ( $products->have_posts() ) {
        $products->the_post();
        $product = wc_get_product( get_the_ID() );
        $img     = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'thumbnail' ) : wc_placeholder_img_src();
        $price   = $product ? strip_tags( wc_price( wc_get_price_to_display( $product ) ) ) : '';
        ?>
        <a class="avw-sr-item" href="<?php the_permalink(); ?>">
            <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" />
            <div class="avw-sr-info">
                <span class="avw-sr-title"><?php the_title(); ?></span>
                <?php if ( $price ) : ?>
                    <span class="avw-sr-price"><?php echo esc_html( get_woocommerce_currency_symbol() . ' ' . $price ); ?></span>
                <?php endif; ?>
            </div>
        </a>
        <?php
    }
    wp_reset_postdata();
    $html = ob_get_clean();

    wp_send_json_success( array(
        'html'  => $html,
        'count' => $products->found_posts,
        'url'   => home_url( '/?s=' . urlencode( $query ) . '&post_type=product' ),
    ) );
}

/**
 * Add Cart Badge to AJAX Fragments
 */
add_filter('woocommerce_add_to_cart_fragments', 'avw_cart_badge_fragment');
function avw_cart_badge_fragment($fragments) {
    ob_start();
    $count = WC()->cart->get_cart_contents_count();
    ?>
    <div id="cart-badge" class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-md transition-all <?php echo $count > 0 ? 'scale-100 opacity-100' : 'scale-0 opacity-0'; ?>">
        <?php echo $count; ?>
    </div>
    <?php
    $fragments['#cart-badge'] = ob_get_clean();
    return $fragments;
}

/**
 * POLYLANG: Register theme strings for translation
 * After registering, go to WP Admin → Languages → String Translations to add EN translations.
 */
add_action('init', function() {
    if ( ! function_exists('pll_register_string') ) return;
    $g = 'avw-theme';

    // Homepage hero
    pll_register_string('hero-p1',    "A. van Wees distilleerderij 'De Ooievaar' is de enig overgebleven, ambachtelijke distilleerderij in Amsterdam.", $g);
    pll_register_string('hero-p2',    'Gevestigd in het hart van de Jordaan, distilleren wij volgens authentieke receptuur.', $g);

    // Homepage products section
    pll_register_string('prod-title', 'Een Greep uit ons assortiment', $g);
    pll_register_string('prod-body',  'Door onze ambachtelijke manier van werken houden wij een traditie in stand die stamt uit de 16e eeuw. Met de grote kennis van distilleren die in ons bedrijf aanwezig is en de liefde voor een edel vak produceren wij Oudhollands gedistilleerd van unieke kwaliteit. Tegelijk ontwikkelen wij met oude kennis nieuwe producten zoals een groentenlikeur.', $g);
    pll_register_string('prod-filter-all', 'Toon Alles', $g);
    pll_register_string('prod-btn',   'Naar de WEBWINKEL', $g);

    // Homepage about section
    pll_register_string('about-title', 'Honderden ambachtelijke dranken rechtstreeks uit onze Amsterdamse distilleerderij', $g);
    pll_register_string('about-p1',   'A.van Wees anno 1883 distilleerderij de Ooievaar anno 1782 omvat de enig overgebleven, ambachtelijke distilleerderij in Amsterdam. U vindt ons in de Driehoekstraat in het hart van de Jordaan.', $g);
    pll_register_string('about-p2',   'We distilleren producten met natuurlijke ingrediënten, op basis van oorspronkelijke receptuur – en dat proeft u. Onze specialiteiten? Tongstrelende Oudhollandse genevers en likeuren.', $g);
    pll_register_string('about-btn',  'Lees meer over de distilleerderij', $g);

    // Homepage news section
    pll_register_string('news-title', 'Laatste Nieuws', $g);
    pll_register_string('news-sub',   'Lees hier de laatste nieuwtjes over de oudste distillerderij van Amsterdam', $g);
    pll_register_string('news-btn',   'Lees Alle nieuwsartikelen', $g);
}, 20);

// ── Create English navigation menu (runs once, then skips) ──
add_action('init', function() {
    if ( get_option('avw_en_menu_v3') ) return;

    // Get or create the menu
    $menu_obj = wp_get_nav_menu_object('English Menu');
    if ( $menu_obj ) {
        $menu_id = $menu_obj->term_id;
        $old = wp_get_nav_menu_items($menu_id);
        if ( $old ) foreach ( $old as $it ) wp_delete_post($it->ID, true);
    } else {
        $menu_id = wp_create_nav_menu('English Menu');
        if ( is_wp_error($menu_id) ) return;
    }

    // Helper: find English URL by Dutch slug(s)
    $en_url = function( $slugs, $fallback ) {
        foreach ( (array) $slugs as $slug ) {
            $page = get_page_by_path( $slug );
            if ( ! $page ) continue;
            if ( function_exists('pll_get_post') ) {
                $en_id = pll_get_post( $page->ID, 'en' );
                if ( $en_id ) return get_permalink( $en_id );
            }
            return home_url('/en/' . $slug . '/');
        }
        return home_url( $fallback );
    };

    // Helper: add one menu item, return its new item ID
    $add = function( $title, $url, $parent, $pos ) use ( $menu_id ) {
        return wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'     => $title,
            'menu-item-url'       => $url,
            'menu-item-status'    => 'publish',
            'menu-item-type'      => 'custom',
            'menu-item-position'  => $pos,
            'menu-item-parent-id' => $parent,
        ) );
    };

    $shop  = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/en/shop/');
    $shop  = preg_replace('#/nl/#', '/en/', $shop);
    $news  = get_post_type_archive_link('avw_nieuws') ?: home_url('/en/news/');
    $news  = preg_replace('#/nl/#', '/en/', $news);
    $cart  = function_exists('wc_get_cart_url')     ? wc_get_cart_url()     : home_url('/en/cart/');
    $check = function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/en/checkout/');
    $cart  = preg_replace('#/nl/#', '/en/', $cart);
    $check = preg_replace('#/nl/#', '/en/', $check);

    $pos = 1;

    // ── The Distillery ──
    $distillery = $add( 'The Distillery', $en_url( array('distilleerderij','de-distilleerderij'), '/en/distilleerderij/' ), 0, $pos++ );
    $add( 'About',          $en_url( array('over'),              '/en/over/' ),              $distillery, $pos++ );
    $add( 'Recipe & Craft', $en_url( array('receptuur-ambacht','receptuur'), '/en/receptuur/' ), $distillery, $pos++ );
    $add( 'Family History', $en_url( array('familiegeschiedenis'), '/en/familiegeschiedenis/' ), $distillery, $pos++ );
    $add( 'Vacancies',      $en_url( array('vacatures'),         '/en/vacatures/' ),         $distillery, $pos++ );
    $add( 'Contact',        $en_url( array('contact'),           '/en/contact/' ),           $distillery, $pos++ );

    // ── Products ──
    $products = $add( 'Products', $shop, 0, $pos++ );
    $add( 'Product',    $shop, $products, $pos++ );
    $add( 'Assortment', $en_url( array('assortiment'), '/en/assortiment/' ), $products, $pos++ );

    // ── Experience ──
    $experience = $add( 'Experience', $en_url( array('beleef'), '/en/beleef/' ), 0, $pos++ );
    $add( 'Tasting Room',    $en_url( array('proeflokaal'),           '/en/proeflokaal/' ),           $experience, $pos++ );
    $add( 'Tour / Tasting',  $en_url( array('rondleiding-proeverij','rondleiding'), '/en/rondleiding/' ), $experience, $pos++ );
    $add( 'Genever School',  $en_url( array('geneverschool'),         '/en/geneverschool/' ),         $experience, $pos++ );

    // ── Knowledge ──
    $knowledge = $add( 'Knowledge', $en_url( array('kennis'), '/en/kennis/' ), 0, $pos++ );
    $kennisbank = $add( 'Knowledge Base', $en_url( array('kennisbank'), '/en/kennisbank/' ), $knowledge, $pos++ );
    $add( 'Knowledge Article', $en_url( array('kennis-artikel','kennisartikel'), '/en/kennis-artikel/' ), $kennisbank, $pos++ );

    // ── Webshop ──
    $webshop = $add( 'Webshop', $shop, 0, $pos++ );
    $prod_sub = $add( 'Products', $shop, $webshop, $pos++ );
    $cats_sub = $add( 'Categories', $shop, $prod_sub, $pos++ );
    $add( 'Product',      $shop,  $cats_sub, $pos++ );
    $add( 'Cart',         $cart,  $webshop,  $pos++ );
    $add( 'Checkout',     $check, $webshop,  $pos++ );
    $add( 'Account / Login', $en_url( array('my-account','mijn-account'), '/en/my-account/' ), $webshop, $pos++ );
    $service = $add( 'Service', home_url('/en/'), $webshop, $pos++ );
    $add( 'FAQ',           $en_url( array('faq'), '/en/faq/' ),                     $service, $pos++ );
    $add( 'Shipping Info', $en_url( array('verzend-info','verzendinfo'), '/en/verzend-info/' ), $service, $pos++ );
    $add( 'Business',      $en_url( array('zakelijk'), '/en/zakelijk/' ),           $webshop,  $pos++ );

    // ── Blog & News ──
    $blog = $add( 'Blog & News', $news, 0, $pos++ );
    $add( 'Article', $news, $blog, $pos++ );

    // Assign to Polylang English primary location
    $pll = get_option('polylang');
    if ( is_array($pll) ) {
        $theme = get_stylesheet();
        if ( ! isset($pll['nav_menus'][$theme]['primary']) ) {
            $pll['nav_menus'][$theme]['primary'] = array();
        }
        $pll['nav_menus'][$theme]['primary']['en'] = (int) $menu_id;
        update_option('polylang', $pll);
    }

    update_option('avw_en_menu_v3', 1);
}, 99);

// ── Ensure Assortiment page has nl language + English translation (runs once) ──
add_action('init', function() {
    if ( get_option('avw_en_assortiment_v3') ) return;
    if ( ! function_exists('pll_set_post_language') || ! function_exists('pll_save_post_translations') || ! function_exists('pll_get_post') ) return;

    // Find the Dutch assortiment page by slug or by WooCommerce shop page id
    $nl_page = null;
    foreach ( array('assortiment', 'shop', 'winkel') as $slug ) {
        $nl_page = get_page_by_path( $slug );
        if ( $nl_page ) break;
    }
    if ( ! $nl_page && function_exists('wc_get_page_id') ) {
        $shop_id = wc_get_page_id('shop');
        if ( $shop_id > 0 ) $nl_page = get_post( $shop_id );
    }
    if ( ! $nl_page ) return;

    // Ensure Dutch language is set — this is what makes the "+" button appear
    pll_set_post_language( $nl_page->ID, 'nl' );

    // If English translation already exists just link it and finish
    $existing_en = pll_get_post( $nl_page->ID, 'en' );
    if ( $existing_en ) {
        pll_save_post_translations( array( 'nl' => $nl_page->ID, 'en' => $existing_en ) );
        update_option('avw_en_assortiment_v2', 1);
        return;
    }

    // Create English page
    $en_id = wp_insert_post( array(
        'post_title'    => 'Assortment',
        'post_name'     => 'assortment',
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_content'  => '',
    ) );
    if ( is_wp_error( $en_id ) ) return;

    pll_set_post_language( $en_id, 'en' );
    pll_save_post_translations( array( 'nl' => $nl_page->ID, 'en' => $en_id ) );

    update_option('avw_en_assortiment_v3', 1);
}, 99);

// ── Set manually created Assortiment page to English (runs once) ──
add_action('init', function() {
    if ( get_option('avw_fix_assortiment_en_v2') ) return;
    if ( ! function_exists('pll_set_post_language') || ! function_exists('pll_save_post_translations') || ! function_exists('pll_get_post_language') ) return;

    // Find the Dutch Assortiment page
    $nl_page = null;
    foreach ( array('assortiment', 'shop') as $slug ) {
        $p = get_page_by_path( $slug );
        if ( $p && pll_get_post_language( $p->ID ) === 'nl' ) { $nl_page = $p; break; }
    }
    if ( ! $nl_page && function_exists('wc_get_page_id') ) {
        $sid = wc_get_page_id('shop');
        if ( $sid > 0 ) $nl_page = get_post( $sid );
    }

    // Find the page using the Assortiment template that is NOT the Dutch page
    $candidates = get_posts( array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'page-over-de-producten.php',
    ) );

    $en_page = null;
    foreach ( $candidates as $c ) {
        if ( $nl_page && $c->ID === $nl_page->ID ) continue;
        $lang = function_exists('pll_get_post_language') ? pll_get_post_language( $c->ID ) : '';
        if ( $lang !== 'nl' ) { $en_page = $c; break; }
    }

    // Also search by title if template search found nothing
    if ( ! $en_page ) {
        $by_title = get_posts( array(
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => 5,
            'title'          => 'Assortiment',
        ) );
        foreach ( $by_title as $c ) {
            if ( $nl_page && $c->ID === $nl_page->ID ) continue;
            $en_page = $c; break;
        }
    }

    if ( ! $en_page ) { update_option('avw_fix_assortiment_en_v2', 1); return; }

    // Set to English and link translations
    pll_set_post_language( $en_page->ID, 'en' );
    if ( $nl_page ) {
        pll_set_post_language( $nl_page->ID, 'nl' );
        pll_save_post_translations( array( 'nl' => $nl_page->ID, 'en' => $en_page->ID ) );
    }

    update_option('avw_fix_assortiment_en_v2', 1);
}, 100);

// ── Link the two Assortiment pages as translations (runs once) ──
add_action('init', function() {
    if ( get_option('avw_link_assortiment_v1') ) return;
    if ( ! function_exists('pll_get_post_language') || ! function_exists('pll_save_post_translations') ) return;

    // Get all pages titled Assortiment or using the template
    $all = get_posts( array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'page-over-de-producten.php',
    ) );

    $nl_id = null;
    $en_id = null;

    foreach ( $all as $p ) {
        $lang = pll_get_post_language( $p->ID );
        if ( $lang === 'nl' && ! $nl_id ) $nl_id = $p->ID;
        if ( $lang === 'en' && ! $en_id ) $en_id = $p->ID;
    }

    // Also search all pages titled Assortiment regardless of template
    if ( ! $nl_id || ! $en_id ) {
        $by_title = get_posts( array(
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            's'              => 'Assortiment',
        ) );
        foreach ( $by_title as $p ) {
            $lang = pll_get_post_language( $p->ID );
            if ( $lang === 'nl' && ! $nl_id ) $nl_id = $p->ID;
            if ( $lang === 'en' && ! $en_id ) $en_id = $p->ID;
        }
    }

    if ( $nl_id && $en_id ) {
        pll_save_post_translations( array( 'nl' => $nl_id, 'en' => $en_id ) );
    }

    update_option('avw_link_assortiment_v1', 1);
}, 101);
