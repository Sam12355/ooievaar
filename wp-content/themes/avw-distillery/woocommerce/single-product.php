<?php
/**
 * The Template for displaying all single products
 */
header('X-AVW-Template: single-product');
nocache_headers();

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php
    // Get the product object to show the real data in the hero
    global $product;
?>

<!-- PRODUCT HERO (PARALLAX) -->
<section class="relative bg-[#36221d] pt-24 pb-10 sm:pt-28 sm:pb-14 px-4 sm:px-6 overflow-hidden">
    <!-- Background Image with Parallax & Huge Scale buffer -->
    <div class="absolute inset-0 z-0">
        <img id="product-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="A. van Wees Distilleerderij" class="w-full h-[120%] object-cover opacity-60 scale-125" style="object-position: center 30%; transform-origin: center center;" />
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-transparent"></div>
    </div>

    <div class="max-w-[1000px] mx-auto text-center relative z-10">
        <!-- Breadcrumbs -->
        <nav class="font-sans text-[#eedfcb]/70 text-[13px] uppercase tracking-widest mb-4">
            <a href="<?php echo home_url(); ?>" class="hover:text-white transition-colors">Home</a> 
            <span class="mx-2">&bull;</span>
            <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="hover:text-white transition-colors">Assortment</a>
            <span class="mx-2">&bull;</span>
            <span class="text-white"><?php the_title(); ?></span>
        </nav>
        
        <h1 class="font-kurversbrug text-[#eedfcb] text-[36px] sm:text-[48px] md:text-[64px] mb-4 drop-shadow-lg leading-tight">
            <?php the_title(); ?>
        </h1>
        
        <?php if ( $product && $product->get_short_description() ) : ?>
        <div class="max-w-[700px] mx-auto font-sans text-white text-[16px] sm:text-[18px] opacity-90 drop-shadow-md">
            <?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ); ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- MAIN PRODUCT CONTENT -->
<section class="bg-[#fdf8f1] py-12 sm:py-20 px-4 sm:px-6">
    <div class="max-w-[1300px] mx-auto">
        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>
            <?php wc_get_template_part( 'content', 'single-product' ); ?>
        <?php endwhile; // end of the loop. ?>
    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Parallax Effect for Single Product Hero
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.to("#product-hero-img", {
            yPercent: 30,
            ease: "none",
            scrollTrigger: {
                trigger: "h1",
                start: "top bottom",
                end: "bottom top",
                scrub: true
            }
        });
    }
});
</script>

<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
