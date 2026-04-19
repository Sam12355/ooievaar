<?php
/**
 * Custom Boutique Cart Totals — De Ooievaar Distillery
 *
 * @package WooCommerce\Templates
 * @version 10.3.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <h2 class="font-kurversbrug text-[#cdbca6] uppercase tracking-[0.2em] mb-8 pb-5 border-b border-white/10">
        <?php esc_html_e( 'Cart totals', 'woocommerce' ); ?>
    </h2>

    <div class="space-y-6">
        <!-- Subtotal -->
        <div class="flex justify-between items-center border-b border-white/10 pb-4">
            <span class="text-[13px] uppercase tracking-widest opacity-70"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
            <span class="text-lg font-medium" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></span>
        </div>

        <!-- Coupons -->
        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <div class="flex justify-between items-center border-b border-white/10 pb-4 coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <span class="text-[13px] uppercase tracking-widest opacity-70"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
                <span class="text-lg font-medium" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
            </div>
        <?php endforeach; ?>

        <!-- Shipping -->
        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <div class="border-b border-white/10 pb-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-[13px] uppercase tracking-widest opacity-70"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></span>
                </div>
                <div data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>">
                    <?php woocommerce_shipping_calculator(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Fees -->
        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <div class="flex justify-between items-center border-b border-white/10 pb-4">
                <span class="text-[13px] uppercase tracking-widest opacity-70"><?php echo esc_html( $fee->name ); ?></span>
                <span class="text-lg font-medium" data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></span>
            </div>
        <?php endforeach; ?>

        <!-- Tax -->
        <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
            $taxable_address = WC()->customer->get_taxable_address();
            $estimated_text  = '';

            if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
                /* translators: %s location. */
                $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
            }

            if ( 'itemized' === get_option( 'woocommerce_tax_display_cart' ) ) : ?>
                <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                    <div class="flex justify-between items-center border-b border-white/10 pb-4 tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                        <span class="text-[13px] uppercase tracking-widest opacity-70"><?php echo esc_html( $tax->label ) . $estimated_text; ?></span>
                        <span class="text-lg font-medium" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="flex justify-between items-center border-b border-white/10 pb-4 tax-total">
                    <span class="text-[13px] uppercase tracking-widest opacity-70"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></span>
                    <span class="text-lg font-medium" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

        <!-- Grand Total -->
        <div class="flex justify-between items-center pt-4">
            <span class="font-kurversbrug text-xl uppercase tracking-widest"><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
            <div class="text-right">
                <span class="text-3xl font-bold text-[#cdbca6] block" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></span>
                <?php if ( wc_tax_enabled() && WC()->cart->display_prices_including_tax() ) : ?>
                    <?php if ( 'itemized' === get_option( 'woocommerce_tax_display_cart' ) ) : ?>
                        <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                            <small class="text-xs opacity-60 block"><?php printf( esc_html__( '(includes %s)', 'woocommerce' ), $tax->label ); ?>: <?php echo wp_kses_post( $tax->formatted_amount ); ?></small>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <small class="text-xs opacity-60 block"><?php printf( esc_html__( '(includes %s)', 'woocommerce' ), WC()->countries->tax_or_vat() ); ?>: <?php wc_cart_totals_taxes_total_html(); ?></small>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
    </div>

    <div class="wc-proceed-to-checkout mt-12">
        <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
    </div>

    <?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
