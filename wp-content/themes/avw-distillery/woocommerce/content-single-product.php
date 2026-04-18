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
	<div class="product-info-summary flex flex-col gap-8">
		<div class="meta-tags flex flex-wrap gap-3 mb-2">
            <?php
            $categories = wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">', '</span>' );
            if ( $categories ) : ?>
                <div class="text-[11px] uppercase tracking-widest font-bold text-[#36221d]/40 px-4 py-1.5 border border-[#36221d]/10 rounded-full">
                    <?php echo strip_tags($categories); ?>
                </div>
            <?php endif; ?>
            
            <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
                <div class="text-[11px] uppercase tracking-widest font-bold text-[#36221d]/40 px-4 py-1.5 border border-[#36221d]/10 rounded-full">
                    SKU: <?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?>
                </div>
            <?php endif; ?>
		</div>

        <div class="price-area">
            <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?> font-sans text-[#36221d] flex items-baseline gap-2">
                <span class="text-[28px] md:text-[34px] font-medium leading-none"><?php echo $product->get_price_html(); ?></span>
            </p>
        </div>

		<div class="description-area font-sans text-black/80 text-[16px] sm:text-[18px] leading-relaxed">
			<?php the_content(); ?>
		</div>

		<div class="action-area pt-4 border-b border-[#36221d]/10 pb-8">
			<?php
            woocommerce_template_single_add_to_cart();
			?>
		</div>

        <!-- PRODUCT DETAILS (RESTORED TO TOP) -->
        <div class="product-tabs pt-2">
            <h4 class="font-kurversbrug text-[20px] text-[#36221d] mb-4 uppercase tracking-wide">Product Informatie</h4>
            <div class="prose prose-sm font-sans text-black/70 max-w-none">
                <?php
                $tabs = apply_filters( 'woocommerce_product_tabs', array() );
                if ( ! empty( $tabs ) ) {
                    foreach ( $tabs as $key => $tab ) {
                        if ( $key !== 'description' && $key !== 'reviews' ) { 
                            echo '<div class="mb-4 last:mb-0 border-l-2 border-[#36221d]/10 pl-4 py-1"><strong>' . esc_html( $tab['title'] ) . ':</strong> ';
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
                <div class="related-carousel-wrapper relative group p-6 sm:p-10 bg-[#eedfcb]/30 rounded-[32px] border border-[#36221d]/5">
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

<style>
/* PREMIUM BUTTON STYLING */
.single_add_to_cart_button {
    background-color: #36221d !important;
    color: #eedfcb !important;
    padding: 16px 40px !important;
    border-radius: 16px !important;
    font-family: 'DM Sans', sans-serif !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    transition: all 0.3s ease !important;
    border: none !important;
    cursor: pointer !important;
    width: 100% !important;
    max-width: 300px !important;
}
.single_add_to_cart_button:hover { background-color: #000 !important; }

/* Swiper Nav Hide Default Arrow Fonts */
.swiper-button-next:after, .swiper-button-prev:after { display: none !important; }

/* LUXURY REVIEW AREA STYLING */
.reviews-aesthetic { font-family: 'DM Sans', sans-serif; }
.commentlist { padding: 0 !important; list-style: none !important; }
.commentlist li { margin-bottom: 2rem !important; border-bottom: 1px solid rgba(54, 34, 29, 0.1) !important; padding-bottom: 2rem !important; }
.comment-text { background: white !important; padding: 2rem !important; border-radius: 20px !important; box-shadow: 0 4px 12px rgba(0,0,0,0.03) !important; }
.star-rating { color: #36221d !important; font-size: 1.1em !important; margin-bottom: 0.5rem !important; }
.comment-author { font-weight: bold !important; color: #36221d !important; text-transform: uppercase !important; font-size: 0.8em !important; tracking: 0.1em !important; }
.comment-meta { margin-bottom: 1rem !important; opacity: 0.5; font-size: 0.8em; }
#review_form_wrapper { background: #eedfcb/30 !important; padding: 2rem !important; border-radius: 24px !important; margin-top: 3rem !important; border: 1px solid rgba(54, 34, 29, 0.1) !important; }
#reply-title { font-family: 'Kurversbrug', serif !important; text-transform: uppercase !important; margin-bottom: 1.5rem !important; display: block; }
.comment-form input, .comment-form textarea { width: 100% !important; border-radius: 12px !important; padding: 12px !important; border: 1px solid rgba(54, 34, 29, 0.1) !important; outline: none !important; }
.comment-form input:focus, .comment-form textarea:focus { border-color: #36221d !important; }
#submit { background: #36221d !important; color: #eedfcb !important; padding: 12px 30px !important; border-radius: 12px !important; text-transform: uppercase !important; font-weight: bold !important; border: none !important; margin-top: 1rem !important; cursor: pointer; }
</style>

<?php do_action( 'woocommerce_after_single_product' ); ?>
