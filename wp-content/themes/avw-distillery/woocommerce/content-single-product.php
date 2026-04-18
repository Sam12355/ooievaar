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

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start', $product ); ?>>

	<!-- PRODUCT IMAGES & RELATED CAROUSEL -->
	<div class="product-gallery-container flex flex-col gap-6">
		<div class="relative rounded-[32px] overflow-hidden bg-white shadow-xl shadow-black/5 aspect-square flex items-center justify-center p-8">
            <?php
            $image_id = $product->get_image_id();
            if ( $image_id ) {
                echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'w-full h-full object-contain' ) );
            } else {
                echo wc_placeholder_img( 'full', array( 'class' => 'w-full h-full object-contain' ) );
            }
            ?>
		</div>

        <!-- Compact Related Carousel (3-Item Auto-Play) -->
        <?php
        $related_ids = wc_get_related_products( $product->get_id(), 9 );
        if ( ! empty( $related_ids ) ) : ?>
            <div class="related-carousel-wrapper relative group">
                <h4 class="font-kurversbrug text-[14px] text-[#36221d] mb-4 uppercase tracking-[0.2em] opacity-60">Ontdek ook</h4>
                <div class="swiper related-swiper relative">
                    <div class="swiper-wrapper">
                        <?php foreach ( $related_ids as $related_id ) : 
                            $rel_product = wc_get_product( $related_id );
                            if ( ! $rel_product ) continue;
                            ?>
                            <div class="swiper-slide px-1">
                                <a href="<?php echo get_permalink( $related_id ); ?>" class="block bg-[#eedfcb]/80 rounded-[16px] p-3 group transition-all hover:bg-[#eedfcb]">
                                    <div class="bg-white rounded-[10px] p-2 mb-2 aspect-square overflow-hidden flex items-center justify-center">
                                        <?php echo $rel_product->get_image( 'thumbnail', array( 'class' => 'max-h-full w-auto object-contain transition-transform group-hover:scale-110' ) ); ?>
                                    </div>
                                    <h5 class="font-kurversbrug text-[11px] text-[#36221d] line-clamp-1 mb-0.5"><?php echo $rel_product->get_name(); ?></h5>
                                    <p class="font-sans text-[10px] font-bold text-[#36221d]"><?php echo strip_tags($rel_product->get_price_html()); ?></p>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Navigation Buttons (Hidden by default, shown on hover) -->
                    <div class="swiper-button-next !text-[#36221d] !w-6 !h-6 after:!text-[10px] bg-white/50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="swiper-button-prev !text-[#36221d] !w-6 !h-6 after:!text-[10px] bg-white/50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
            </div>
        <?php endif; ?>
	</div>

	<!-- PRODUCT SUMMARY -->
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

		<div class="action-area pt-4">
			<?php
            woocommerce_template_single_add_to_cart();
			?>
		</div>

        <!-- ADDITIONAL TABS/DESCRIPTION -->
        <div class="product-tabs border-t border-[#36221d]/10 pt-10 mt-4">
            <h4 class="font-kurversbrug text-[22px] text-[#36221d] mb-4 uppercase">Extra Informatie</h4>
            <div class="prose prose-sm font-sans text-black/70 max-w-none">
                <?php
                $tabs = apply_filters( 'woocommerce_product_tabs', array() );
                if ( ! empty( $tabs ) ) {
                    foreach ( $tabs as $key => $tab ) {
                        if ( $key !== 'description' ) { // Handled above by the_content()
                            echo '<div class="mb-4"><strong>' . esc_html( $tab['title'] ) . ':</strong> ';
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined') {
        new Swiper(".related-swiper", {
            slidesPerView: 3,
            spaceBetween: 8,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: { slidesPerView: 3 },
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
    max-width: 320px !important;
}
.single_add_to_cart_button:hover { background-color: #000 !important; }
.cart { display: flex !important; align-items: center !important; gap: 16px !important; flex-wrap: wrap !important; }
.quantity .qty { border: 1px solid rgba(54, 34, 29, 0.2) !important; border-radius: 12px !important; padding: 12px !important; width: 70px !important; text-align: center !important; }
.price del { opacity: 0.4; font-size: 0.7em; margin-right: 10px; }
.price ins { text-decoration: none; }

/* Swiper Nav Style */
.swiper-button-next:after, .swiper-button-prev:after { font-weight: bold; }
</style>

<?php do_action( 'woocommerce_after_single_product' ); ?>
