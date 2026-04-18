<?php
defined( 'ABSPATH' ) || exit;

// Force WooCommerce to load our stunning archive-product layout for all category pages
if ( function_exists('wc_get_template') ) {
    wc_get_template( 'archive-product.php' );
} else {
    get_template_part( 'index' );
}
