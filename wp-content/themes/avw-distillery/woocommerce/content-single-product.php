<?php
/**
 * The template for displaying product content in the single-product.php template
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}
?>

	<!-- TOP SECTION: MAIN PRODUCT AREA -->
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start mb-12', $product ); ?>>

	<!-- LEFT: PRODUCT IMAGES (WITH MAGNIFICATION) -->
	<div class="product-gallery-container group/zoom cursor-crosshair">
		<div class="relative rounded-[32px] overflow-hidden bg-white shadow-xl shadow-black/5 aspect-square flex items-center justify-center p-8 border border-[#36221d]/5">
            <?php
            $image_id = $product->get_image_id();
            if ( $image_id ) {
                echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'w-full h-full object-contain transition-transform duration-700 ease-out group-hover/zoom:scale-150 transform-gpu' ) );
            } else {
                echo wc_placeholder_img( 'full', array( 'class' => 'w-full h-full object-contain' ) );
            }
            ?>
		</div>
	</div>

	<!-- RIGHT: PRODUCT SUMMARY -->
	<div class="product-info-summary flex flex-col gap-6 max-w-[540px]">
		<div class="meta-tags flex flex-wrap gap-3 mb-1">
            <?php
            $categories = wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">', '</span>' );
            if ( $categories ) : ?>
                <div class="text-[10px] uppercase tracking-widest font-bold text-[#36221d]/40 px-3 py-1 border border-[#36221d]/10 rounded-full">
                    <?php echo strip_tags($categories); ?>
                </div>
            <?php endif; ?>
            
            <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
                <div class="text-[10px] uppercase tracking-widest font-bold text-[#36221d]/40 px-3 py-1 border border-[#36221d]/10 rounded-full">
                    SKU: <?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?>
                </div>
            <?php endif; ?>
		</div>

        <div class="price-area">
            <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> font-sans text-[#36221d] flex items-baseline gap-2">
                <span class="text-[32px] md:text-[40px] font-bold leading-none"><?php echo $product->get_price_html(); ?></span>
            </p>
        </div>

		<div class="description-area font-sans text-black/80 text-[15px] sm:text-[16px] leading-relaxed">
			<?php the_content(); ?>
		</div>

		<div class="action-area pt-4 border-b border-[#36221d]/10 pb-10">
			<?php
            woocommerce_template_single_add_to_cart();
			?>
		</div>

        <!-- PRODUCT DETAILS (RESTORED TO TOP) -->
        <div class="product-tabs pt-4">
            <h4 class="font-kurversbrug text-[18px] text-[#36221d] mb-4 uppercase tracking-widest opacity-80">Product Informatie</h4>
            <div class="prose prose-sm font-sans text-black/70 max-w-none">
                <?php
                $tabs = apply_filters( 'woocommerce_product_tabs', array() );
                if ( ! empty( $tabs ) ) {
                    foreach ( $tabs as $key => $tab ) {
                        if ( $key !== 'description' && $key !== 'reviews' ) { 
                            echo '<div class="mb-3 last:mb-0 text-[13px] border-l-2 border-[#36221d]/10 pl-4 py-0.5"><strong>' . esc_html( $tab['title'] ) . ':</strong> ';
                            call_user_func( $tab['callback'], $key, $tab );
                            echo '</div>';
                        }
                    }
                }
                ?>
            </div>
        </div>
	</div>
</div>

<!-- SEPARATOR LINE -->
<div class="max-w-[1300px] mx-auto my-16 border-t border-[#36221d]/10"></div>

<!-- BOTTOM DISCOVERY AREA -->
<div class="max-w-[1300px] mx-auto px-4 sm:px-6 mb-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-20">
        
        <!-- LEFT: LUXURY REVIEWS (1 COL) -->
        <div class="lg:col-span-1 premium-reviews-container">
            <h4 class="font-kurversbrug text-[22px] text-[#36221d] mb-8 uppercase tracking-wide">Recensies</h4>
            <div class="reviews-aesthetic">
                <?php
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
                ?>
            </div>
        </div>

        <!-- RIGHT: RELATED CAROUSEL (2 COLS) -->
        <div class="lg:col-span-2">
            <?php
            $related_ids = wc_get_related_products( $product->get_id(), 9 );
            if ( ! empty( $related_ids ) ) : ?>
                <div class="related-carousel-wrapper relative group p-6 sm:p-10 rounded-[32px]">
                    <h4 class="font-kurversbrug text-[22px] text-[#36221d] mb-8 uppercase tracking-[0.2em] text-center">Inspiratie voor u</h4>
                    
                    <div class="relative px-4 sm:px-8">
                        <div class="swiper related-swiper overflow-hidden">
                            <div class="swiper-wrapper">
                                <?php foreach ( $related_ids as $related_id ) : 
                                    $rel_product = wc_get_product( $related_id );
                                    if ( ! $rel_product ) continue;
                                    ?>
                                    <div class="swiper-slide h-auto">
                                        <a href="<?php echo get_permalink( $related_id ); ?>" class="flex flex-col h-full bg-[#eedfcb] rounded-[24px] p-5 group transition-all hover:bg-white hover:shadow-xl">
                                            <div class="bg-white rounded-[16px] p-4 mb-4 aspect-square overflow-hidden flex items-center justify-center">
                                                <?php echo $rel_product->get_image( 'thumbnail', array( 'class' => 'max-h-full w-auto object-contain transition-transform group-hover:scale-110' ) ); ?>
                                            </div>
                                            <h5 class="font-kurversbrug text-[13px] text-[#36221d] line-clamp-2 mb-2"><?php echo $rel_product->get_name(); ?></h5>
                                            <p class="font-sans text-[12px] font-bold text-[#36221d] mt-auto"><?php echo strip_tags($rel_product->get_price_html()); ?></p>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Navigation Buttons (ULTRA VISIBLE & ICONIC) -->
                        <div class="swiper-button-next !text-[#eedfcb] !w-12 !h-12 !bg-[#36221d] rounded-full !-right-6 sm:!-right-10 shadow-2xl z-20 flex items-center justify-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                        <div class="swiper-button-prev !text-[#eedfcb] !w-12 !h-12 !bg-[#36221d] rounded-full !-left-6 sm:!-left-10 shadow-2xl z-20 flex items-center justify-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined') {
        new Swiper(".related-swiper", {
            slidesPerView: 1.5,
            spaceBetween: 15,
            loop: true,
            autoplay: { delay: 3500 },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: { slidesPerView: 2.2 },
                1024: { slidesPerView: 3 }
            }
        });
    }
});
</script>



<?php do_action( 'woocommerce_after_single_product' ); ?>
