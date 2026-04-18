<?php
defined( 'ABSPATH' ) || exit;

// Route all product searches to our stunning custom WooCommerce archive layout
if ( isset($_GET['post_type']) && $_GET['post_type'] === 'product' ) {
    if ( function_exists('wc_get_template') ) {
        wc_get_template( 'archive-product.php' );
        exit;
    }
}

// Fallback for regular searches
get_header();
?>
<section class="bg-[#e0cbb0] py-20 px-6 min-h-[60vh] flex flex-col items-center justify-center">
    <h1 class="font-kurversbrug text-[36px] sm:text-[48px] text-[#36221d] mb-4">Zoekresultaten</h1>
    <div class="max-w-[800px] text-center">
        <?php
        if ( have_posts() ) {
            while ( have_posts() ) : the_post();
                echo '<a href="' . get_permalink() . '" class="block bg-white/50 p-4 rounded-xl mb-4 hover:bg-white transition-colors">';
                echo '<h2 class="font-sans text-[20px] text-[#36221d]">' . get_the_title() . '</h2>';
                echo '</a>';
            endwhile;
        } else {
            echo '<p class="font-sans text-lg text-[#36221d]">Geen resultaten gevonden.</p>';
        }
        ?>
    </div>
</section>
<?php get_footer(); ?>
