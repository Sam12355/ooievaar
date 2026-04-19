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

// Helper to check if product is favorited
function avw_is_favorited($product_id) {
    return in_array($product_id, avw_get_favorites());
}
