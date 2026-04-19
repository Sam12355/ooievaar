<?php

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
function avw_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    $cart_count = WC()->cart->get_cart_contents_count();
    ?>
    <div id="cart-badge" class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-md transition-all <?php echo $cart_count > 0 ? 'scale-100 opacity-100' : 'scale-0 opacity-0'; ?>">
        <?php echo $cart_count; ?>
    </div>
    <?php
    $fragments['div#cart-badge'] = ob_get_clean();
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'avw_header_add_to_cart_fragment' );

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
// Force Cart Title to change for verification
add_filter('the_title', function($title, $id = null) {
    if (function_exists('is_cart') && is_cart() && in_the_loop()) {
        return 'Winkelmand - updated so i ll check if it can be seen in ui';
    }
    return $title;
}, 100, 2);

// Helper to check if product is favorited
function avw_is_favorited($product_id) {
    return in_array($product_id, avw_get_favorites());
}

/**
 * BOUTIQUE CART PAGE — Inject CSS directly on cart page
 * This runs AFTER Tailwind CDN so it always wins specificity battles.
 */
add_action('wp_head', 'avw_cart_page_styles', 100);
function avw_cart_page_styles() {
    if (!function_exists('is_cart') || !is_cart()) return;
    ?>
    <style id="avw-cart-boutique">
    /* Reset WooCommerce cart for boutique design */
    body.woocommerce-cart { background: #f8f5f0; }

    body.woocommerce-cart .woocommerce { max-width: 1200px; margin: 0 auto; padding: 40px 24px 100px; }

    /* Page title */
    body.woocommerce-cart h1.page-title {
        font-family: 'Kurversbrug', serif !important;
        font-size: clamp(2rem, 5vw, 3.5rem) !important;
        color: #133E23 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.15em !important;
        text-align: center !important;
        margin: 0 auto 50px !important;
    }

    /* ---- CART TABLE ---- */
    body.woocommerce-cart table.shop_table.cart {
        border: none !important;
        border-radius: 24px !important;
        overflow: hidden !important;
        box-shadow: 0 8px 40px rgba(0,0,0,0.08) !important;
        background: #ffffff !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        width: 100% !important;
        margin-bottom: 24px !important;
    }

    /* Table header */
    body.woocommerce-cart table.shop_table.cart thead tr th {
        background: rgba(19,62,35,0.04) !important;
        border-bottom: 1px solid rgba(19,62,35,0.08) !important;
        padding: 20px 24px !important;
        font-family: 'DM Sans', sans-serif !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.15em !important;
        color: #133E23 !important;
        border-top: none !important;
    }

    /* Rows */
    body.woocommerce-cart table.shop_table.cart tbody tr.cart_item {
        border-bottom: 1px solid rgba(19,62,35,0.05) !important;
        background: white !important;
    }
    body.woocommerce-cart table.shop_table.cart tbody tr.cart_item:last-child {
        border-bottom: none !important;
    }
    body.woocommerce-cart table.shop_table.cart tbody tr.cart_item:hover {
        background: rgba(19,62,35,0.015) !important;
    }

    /* Cells */
    body.woocommerce-cart table.shop_table.cart td {
        padding: 20px 24px !important;
        border: none !important;
        vertical-align: middle !important;
        font-family: 'DM Sans', sans-serif !important;
        font-size: 15px !important;
    }

    /* Thumbnail */
    body.woocommerce-cart table.shop_table.cart td.product-thumbnail img {
        width: 80px !important;
        height: 80px !important;
        object-fit: cover !important;
        border-radius: 16px !important;
        border: 1px solid rgba(19,62,35,0.08) !important;
        display: block !important;
    }

    /* Product name */
    body.woocommerce-cart table.shop_table.cart td.product-name a {
        font-weight: 700 !important;
        color: #133E23 !important;
        text-decoration: none !important;
        font-size: 15px !important;
    }
    body.woocommerce-cart table.shop_table.cart td.product-name a:hover {
        color: #9c8a74 !important;
    }

    /* Price / subtotal */
    body.woocommerce-cart table.shop_table.cart td.product-price,
    body.woocommerce-cart table.shop_table.cart td.product-subtotal {
        font-weight: 700 !important;
        color: #133E23 !important;
    }

    /* Remove btn */
    body.woocommerce-cart table.shop_table.cart td.product-remove a.remove {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 34px !important;
        height: 34px !important;
        border-radius: 50% !important;
        background: rgba(239,68,68,0.08) !important;
        color: #ef4444 !important;
        font-size: 20px !important;
        text-decoration: none !important;
        transition: all 0.2s !important;
        border: none !important;
    }
    body.woocommerce-cart table.shop_table.cart td.product-remove a.remove:hover {
        background: #ef4444 !important;
        color: white !important;
    }

    /* Quantity input */
    body.woocommerce-cart .quantity .qty {
        width: 64px !important;
        height: 42px !important;
        border-radius: 9999px !important;
        border: 1.5px solid rgba(19,62,35,0.25) !important;
        text-align: center !important;
        font-family: 'DM Sans', sans-serif !important;
        font-weight: 700 !important;
        font-size: 15px !important;
        color: #133E23 !important;
        background: transparent !important;
        outline: none !important;
        padding: 0 !important;
        -moz-appearance: textfield !important;
    }

    /* ---- ACTIONS ROW ---- */
    body.woocommerce-cart .woocommerce-cart-form .actions {
        background: rgba(19,62,35,0.02) !important;
        padding: 24px !important;
        display: flex !important;
        flex-wrap: wrap !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 16px !important;
    }

    /* Coupon */
    body.woocommerce-cart .coupon {
        display: flex !important;
        border-radius: 9999px !important;
        border: 1.5px solid rgba(19,62,35,0.15) !important;
        overflow: hidden !important;
        background: white !important;
    }
    body.woocommerce-cart .coupon #coupon_code {
        padding: 11px 20px !important;
        border: none !important;
        outline: none !important;
        font-size: 14px !important;
        min-width: 160px !important;
        background: transparent !important;
    }
    body.woocommerce-cart .coupon [name="apply_coupon"] {
        padding: 11px 22px !important;
        background: #133E23 !important;
        color: white !important;
        border: none !important;
        font-size: 11px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        font-weight: 700 !important;
        cursor: pointer !important;
    }

    /* Update button */
    body.woocommerce-cart [name="update_cart"] {
        padding: 12px 28px !important;
        border: 2px solid #133E23 !important;
        border-radius: 9999px !important;
        background: transparent !important;
        color: #133E23 !important;
        font-size: 11px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.15em !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        transition: all 0.3s !important;
    }
    body.woocommerce-cart [name="update_cart"]:hover {
        background: #133E23 !important;
        color: white !important;
    }

    /* ---- CART TOTALS (Green Dark Panel) ---- */
    body.woocommerce-cart .cart-collaterals { margin-top: 8px !important; }
    body.woocommerce-cart .cart-collaterals .cart_totals,
    body.woocommerce-cart .cart_totals {
        float: none !important;
        width: 100% !important;
        max-width: 480px !important;
        margin-left: auto !important;
        background: #133E23 !important;
        border-radius: 28px !important;
        padding: 40px !important;
        box-shadow: 0 30px 80px rgba(0,0,0,0.15) !important;
        border: none !important;
    }

    body.woocommerce-cart .cart_totals h2 {
        display: block !important;
        font-family: 'Kurversbrug', serif !important;
        font-size: 22px !important;
        color: #cdbca6 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.2em !important;
        margin-bottom: 32px !important;
        padding-bottom: 20px !important;
        border-bottom: 1px solid rgba(255,255,255,0.1) !important;
    }

    body.woocommerce-cart .cart_totals table {
        width: 100% !important;
        background: transparent !important;
        border: none !important;
    }
    body.woocommerce-cart .cart_totals table th,
    body.woocommerce-cart .cart_totals table td {
        padding: 14px 0 !important;
        border: none !important;
        border-top: 1px solid rgba(255,255,255,0.07) !important;
        font-family: 'DM Sans', sans-serif !important;
        color: rgba(255,255,255,0.8) !important;
        font-size: 14px !important;
        background: transparent !important;
    }
    body.woocommerce-cart .cart_totals table th {
        text-transform: uppercase !important;
        letter-spacing: 0.08em !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        width: 40% !important;
    }
    body.woocommerce-cart .cart_totals table .order-total th,
    body.woocommerce-cart .cart_totals table .order-total td {
        padding-top: 24px !important;
        border-top: 1px solid rgba(255,255,255,0.15) !important;
    }
    body.woocommerce-cart .cart_totals table .order-total th {
        font-family: 'Kurversbrug', serif !important;
        font-size: 18px !important;
        color: white !important;
    }
    body.woocommerce-cart .cart_totals table .order-total td {
        font-size: 30px !important;
        font-weight: 800 !important;
        color: #cdbca6 !important;
        text-align: right !important;
    }
    body.woocommerce-cart .cart_totals .woocommerce-Price-amount {
        color: #cdbca6 !important;
    }

    /* ---- CHECKOUT BUTTON ---- */
    body.woocommerce-cart .wc-proceed-to-checkout { margin-top: 32px !important; }
    body.woocommerce-cart .wc-proceed-to-checkout a.button,
    body.woocommerce-cart .checkout-button {
        display: block !important;
        width: 100% !important;
        background: #cdbca6 !important;
        color: #133E23 !important;
        padding: 20px !important;
        border-radius: 9999px !important;
        font-family: 'Kurversbrug', serif !important;
        font-size: 17px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.2em !important;
        text-align: center !important;
        text-decoration: none !important;
        transition: all 0.35s !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
        border: none !important;
    }
    body.woocommerce-cart .wc-proceed-to-checkout a.button:hover,
    body.woocommerce-cart .checkout-button:hover {
        background: #ffffff !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.25) !important;
    }

    /* Return to Shop */
    body.woocommerce-cart .return-to-shop { text-align: center; margin: 48px 0; }
    body.woocommerce-cart .return-to-shop a.button {
        display: inline-block !important;
        padding: 14px 36px !important;
        border: 2px solid #133E23 !important;
        border-radius: 9999px !important;
        background: transparent !important;
        color: #133E23 !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.15em !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        transition: all 0.3s !important;
    }
    body.woocommerce-cart .return-to-shop a.button:hover {
        background: #133E23 !important;
        color: white !important;
    }

    /* Shipping */
    body.woocommerce-cart .shipping-calculator-button {
        color: #cdbca6 !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        font-weight: 700 !important;
        text-decoration: none !important;
    }

    /* ---- MOBILE ---- */
    @media (max-width: 760px) {
        body.woocommerce-cart table.shop_table.cart thead { display: none !important; }
        body.woocommerce-cart table.shop_table.cart,
        body.woocommerce-cart table.shop_table.cart tbody,
        body.woocommerce-cart table.shop_table.cart tr,
        body.woocommerce-cart table.shop_table.cart td { display: block !important; width: 100% !important; }
        body.woocommerce-cart table.shop_table.cart tr.cart_item {
            border-radius: 20px !important;
            margin-bottom: 16px !important;
            padding: 12px !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06) !important;
        }
        body.woocommerce-cart table.shop_table.cart td {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            padding: 10px 8px !important;
            border-bottom: 1px solid rgba(0,0,0,0.04) !important;
        }
        body.woocommerce-cart table.shop_table.cart td::before {
            content: attr(data-title);
            font-weight: 700; font-size: 11px;
            text-transform: uppercase; color: #133E23; opacity: 0.5;
        }
        body.woocommerce-cart table.shop_table.cart td.product-remove { justify-content: flex-end !important; }
        body.woocommerce-cart table.shop_table.cart td.product-thumbnail::before { display: none !important; }
        body.woocommerce-cart .cart_totals { max-width: 100% !important; padding: 28px !important; }
        body.woocommerce-cart .woocommerce-cart-form .actions { flex-direction: column !important; }
    }

    /* ---- CRITICAL: Force ALL WooCommerce price text visible (Tailwind resets these) ---- */
    body.woocommerce-cart .woocommerce-Price-amount,
    body.woocommerce-cart .woocommerce-Price-amount bdi,
    body.woocommerce-cart .woocommerce-Price-currencySymbol,
    body.woocommerce-cart .amount,
    body.woocommerce-cart ins .amount,
    body.woocommerce-cart td.product-price *,
    body.woocommerce-cart td.product-subtotal * {
        color: #133E23 !important;
        font-weight: 700 !important;
        font-size: 15px !important;
        display: inline !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Force quantity input fully visible */
    body.woocommerce-cart input[type="number"],
    body.woocommerce-cart input[type="number"].qty,
    body.woocommerce-cart .qty {
        color: #133E23 !important;
        background: white !important;
        border: 1.5px solid rgba(19,62,35,0.25) !important;
        border-radius: 9999px !important;
        width: 64px !important;
        height: 42px !important;
        text-align: center !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        padding: 0 !important;
        display: inline-block !important;
        visibility: visible !important;
    }

    /* Ensure table cells are not collapsed */
    body.woocommerce-cart table.shop_table td.product-price,
    body.woocommerce-cart table.shop_table td.product-quantity,
    body.woocommerce-cart table.shop_table td.product-subtotal {
        min-width: 80px !important;
        white-space: nowrap !important;
    }

    /* Cart totals panel — force separation from table */
    body.woocommerce-cart .cart-collaterals {
        clear: both !important;
        display: block !important;
        margin-top: 40px !important;
    }
    </style>
    <?php
}
