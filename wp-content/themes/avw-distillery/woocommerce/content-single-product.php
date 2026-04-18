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

	<!-- PRODUCT IMAGES -->
	<div class="product-gallery">
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
			/**
			 * Hook: woocommerce_single_product_summary.
			 * We filter this to only show add_to_cart as we've custom-placed the rest
			 */
            // Just outputting add to cart for maximum control
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
.single_add_to_cart_button:hover {
    background-color: #000 !important;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    transform: translateY(-2px) !important;
}

.cart {
    display: flex !important;
    align-items: center !important;
    gap: 16px !important;
    flex-wrap: wrap !important;
}

.quantity .qty {
    background: transparent !important;
    border: 1px solid rgba(54, 34, 29, 0.2) !important;
    border-radius: 12px !important;
    padding: 12px !important;
    width: 70px !important;
    font-family: 'DM Sans', sans-serif !important;
    font-weight: 500 !important;
    text-align: center !important;
}

.price del {
    opacity: 0.4;
    font-size: 0.7em;
    margin-right: 10px;
}
.price ins {
    text-decoration: none;
}
</style>

<?php do_action( 'woocommerce_after_single_product' ); ?>
