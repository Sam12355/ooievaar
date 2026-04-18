<?php

function avw_distillery_scripts() {
    // Enqueue Main Style
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

    // Enqueue Main Script
    wp_enqueue_script('avw-main-script', get_template_directory_uri() . '/js/script.js', array('gsap', 'gsap-scroll-trigger', 'lenis'), '1.0.0', true);
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
function avw_product_search_join( $join, $query ) {
    global $wpdb;
    if ( is_search() && $query->is_main_query() && isset($_GET['post_type']) && $_GET['post_type'] === 'product' ) {
        $join .= " LEFT JOIN {$wpdb->postmeta} AS pm_sku ON {$wpdb->posts}.ID = pm_sku.post_id AND pm_sku.meta_key = '_sku' ";
    }
    return $join;
}
add_filter( 'posts_join', 'avw_product_search_join', 10, 2 );

// Replace WP's default word-splitting search (which breaks on hyphens) with exact phrase matching
function avw_custom_woo_search( $search, $wp_query ) {
    global $wpdb;
    if ( ! is_admin() && $wp_query->is_search() && $wp_query->is_main_query() && isset($_GET['post_type']) && $_GET['post_type'] === 'product' ) {
        $search_term = $wp_query->get('s');
        if ( empty( $search_term ) ) return $search;
        
        $like = '%' . $wpdb->esc_like( $search_term ) . '%';
        
        $search = " AND (
            ({$wpdb->posts}.post_title LIKE '{$like}') 
            OR ({$wpdb->posts}.post_excerpt LIKE '{$like}') 
            OR ({$wpdb->posts}.post_content LIKE '{$like}') 
            OR ( pm_sku.meta_value LIKE '{$like}' )
        ) ";
    }
    return $search;
}
add_filter( 'posts_search', 'avw_custom_woo_search', 500, 2 );

