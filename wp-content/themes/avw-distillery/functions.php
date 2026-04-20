<?php

/**
 * PURGE CACHE ON EVERY LOAD (TEMPORARY)
 */
if ( class_exists( 'LiteSpeed\Purge' ) ) {
    \LiteSpeed\Purge::purge_all();
}

function avw_distillery_scripts() {
    // Enqueue Main Style with dynamic version to kill cache
    wp_enqueue_style('avw-style', get_stylesheet_uri(), array(), time());

    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,400&display=swap', array(), null);

    // Enqueue Tailwind (CDN)
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null, false);

    // Enqueue GSAP & ScrollTrigger
    wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', array(), null, true);
    wp_enqueue_script('gsap-scroll-trigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', array('gsap'), null, true);

    // Enqueue Lenis
    wp_enqueue_script('lenis', 'https://unpkg.com/lenis@1.1.20/dist/lenis.min.js', array(), null, true);

    // Enqueue Swiper for carousels
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);

    // Enqueue Main Script with dynamic version
    wp_enqueue_script('avw-main-script', get_template_directory_uri() . '/js/script.js', array('gsap', 'gsap-scroll-trigger', 'lenis', 'swiper-js'), time(), true);
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
        $is_first_level = ($level === 1);
        
        // Use unique group names for each level to avoid recursive hover bleed
        $group_name = 'lvl-' . $level;
        $panel_pos = $is_first_level ? 'top-full left-0 pt-4 translate-y-2' : 'left-full top-0 ml-4 translate-x-2';
        
        // Match the group/lvl-N name from the parent loop
        $hover_trigger = 'group-hover/' . $group_name . ':opacity-100 group-hover/' . $group_name . ':visible ' . ($is_first_level ? 'group-hover/' . $group_name . ':translate-y-0' : 'group-hover/' . $group_name . ':translate-x-0');
        ?>
        <div class="dropdown-panel absolute <?php echo $panel_pos; ?> opacity-0 invisible transition-all duration-300 z-[<?php echo $z_index; ?>] <?php echo $hover_trigger; ?>">
            <div class="bg-black border border-[#cdbca6]/10 rounded-xl shadow-2xl p-6 min-w-[240px]">
                <div class="flex flex-col gap-4">
                    <?php foreach ($children as $child) : ?>
                        <div class="relative group/<?php echo 'lvl-' . ($level + 1); ?>">
                            <a href="<?php echo esc_url($child->url); ?>" class="font-kurversbrug text-[#cdbca6]/80 text-[13px] uppercase tracking-wider hover:text-white flex items-center justify-between gap-4">
                                <?php echo esc_html($child->title); ?>
                                <?php if (!empty($child->children)) : ?>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
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
