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
<section class="relative bg-[#36221d] pt-28 pb-16 sm:pt-36 sm:pb-20 px-4 sm:px-6 overflow-hidden">
    <!-- Background Image with Parallax & Headroom buffer -->
    <div class="absolute inset-0 z-0">
        <img id="product-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="A. van Wees Distilleerderij" class="w-full h-full object-cover opacity-60 scale-110" style="object-position: center 40%; transform-origin: top center;" />
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-[#fdf8f1]"></div>
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

    <!-- RELATED PRODUCTS -->
    <div class="max-w-[1300px] mx-auto border-t border-[#36221d]/10 mt-20 pt-20" id="premium-related-section">
        <style>
            #premium-related-section h2 {
                font-family: 'Kurversbrug', serif !important;
                font-size: 32px !important;
                color: #36221d !important;
                margin-bottom: 40px !important;
                text-align: center !important;
            }
            #premium-related-section ul.products {
                display: grid !important;
                grid-template-columns: repeat(1, minmax(0, 1fr)) !important;
                gap: 24px !important;
                list-style: none !important;
                padding: 0 !important;
            }
            @media (min-width: 640px) {
                #premium-related-section ul.products {
                    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                    gap: 32px !important;
                }
            }
            @media (min-width: 1024px) {
                #premium-related-section ul.products {
                    grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
                }
            }
            #premium-related-section li.product {
                background: #eedfcb !important;
                border-radius: 32px !important;
                padding: 32px !important;
                display: flex !important;
                flex-direction: column !important;
                transition: transform 0.3s ease !important;
                width: 100% !important;
                margin: 0 !important;
            }
            #premium-related-section li.product:hover {
                transform: translateY(-5px) !important;
            }
            #premium-related-section li.product img {
                border-radius: 24px !important;
                background: white !important;
                margin-bottom: 24px !important;
                aspect-ratio: 1/1 !important;
                object-fit: contain !important;
                padding: 20px !important;
                width: 100% !important;
            }
            #premium-related-section li.product h2 {
                font-family: 'Kurversbrug', serif !important;
                font-size: 20px !important;
                margin-bottom: 12px !important;
                text-align: left !important;
                line-height: 1.3 !important;
            }
            #premium-related-section li.product .price {
                font-family: 'DM Sans', sans-serif !important;
                font-size: 18px !important;
                color: #36221d !important;
                margin-bottom: 20px !important;
                display: block !important;
            }
            #premium-related-section li.product .button {
                background: #36221d !important;
                color: #eedfcb !important;
                border-radius: 12px !important;
                padding: 12px 20px !important;
                font-size: 14px !important;
                text-align: center !important;
                text-transform: uppercase !important;
                font-weight: 600 !important;
                margin-top: auto !important;
                display: block !important;
            }
            #premium-related-section li.product .onsale {
                display: none !important; /* Keep it clean */
            }
        </style>
        <?php
        woocommerce_output_related_products();
        ?>
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
