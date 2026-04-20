<?php
/**
 * Custom Boutique Checkout Template — De Ooievaar Distillery
 *
 * @package WooCommerce\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
?>

<style>
/* ============================================================
   BOUTIQUE CHECKOUT — Full Design System
   ============================================================ */

.avw-checkout-container {
    font-family: 'DM Sans', sans-serif;
    color: #133E23;
    padding-bottom: 100px;
}

/* Page Header */
.avw-checkout-header {
    margin-bottom: 48px;
    text-align: center;
}
.avw-checkout-header h1 {
    font-family: 'Kurversbrug', serif;
    font-size: 40px;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    margin-bottom: 8px;
    color: #133E23;
}
.avw-checkout-header p {
    font-size: 14px;
    color: rgba(19,62,35,0.5);
    letter-spacing: 0.05em;
}

/* Two-column layout */
.avw-checkout-layout {
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 48px;
    align-items: start;
}

@media (max-width: 1024px) {
    .avw-checkout-layout { grid-template-columns: 1fr; gap: 32px; }
}

/* ---- Section Styling ---- */
.avw-checkout-card {
    background: #fff;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 4px 40px rgba(0,0,0,0.06);
    border: 1px solid rgba(19,62,35,0.04);
}

.avw-checkout-section-title {
    font-family: 'Kurversbrug', serif;
    font-size: 20px;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 32px;
    padding-bottom: 16px;
    border-bottom: 1px solid rgba(19,62,35,0.1);
    color: #133E23;
}

/* ---- Form Fields Fixes ---- */
.woocommerce-billing-fields__field-wrapper,
.woocommerce-shipping-fields__field-wrapper,
.woocommerce-additional-fields__field-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.form-row {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
    width: 100% !important;
    float: none !important;
}
.form-row-wide { grid-column: span 2; }
@media (max-width: 600px) {
    .form-row { grid-column: span 2; }
}

.form-row label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 8px;
    color: rgba(19,62,35,0.45);
}

.form-row input[type="text"],
.form-row input[type="email"],
.form-row input[type="tel"],
.form-row select,
.form-row textarea {
    padding: 14px 18px;
    border: 1.5px solid rgba(19,62,35,0.1);
    border-radius: 12px;
    font-size: 15px;
    color: #133E23;
    background: #fcfcfc;
    transition: all 0.2s;
    width: 100%;
}

.form-row input:focus,
.form-row select:focus {
    border-color: #133E23;
    background: #fff;
    outline: none;
    box-shadow: 0 0 0 4px rgba(19,62,35,0.05);
}

/* ---- Right Sidebar (Order Review) ---- */
.avw-order-review-sidebar {
    position: sticky;
    top: 100px;
}

#order_review {
    background: rgba(19,62,35,0.03);
    border-radius: 24px;
    padding: 32px;
    border: 1px solid rgba(19,62,35,0.08);
}

/* Order Review Table */
.shop_table.woocommerce-checkout-review-order-table {
    width: 100%;
    border-collapse: collapse;
}

.shop_table.woocommerce-checkout-review-order-table thead { display: none; }

.shop_table.woocommerce-checkout-review-order-table tr td,
.shop_table.woocommerce-checkout-review-order-table tr th {
    padding: 12px 0;
    border-bottom: 1px solid rgba(19,62,35,0.06);
    background: transparent !important;
    color: #133E23;
    font-size: 14px;
}

.shop_table.woocommerce-checkout-review-order-table .product-name {
    font-weight: 500;
}

.shop_table.woocommerce-checkout-review-order-table .product-total {
    text-align: right;
    font-weight: 700;
}

.shop_table.woocommerce-checkout-review-order-table .cart-subtotal th,
.shop_table.woocommerce-checkout-review-order-table .shipping th {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(19,62,35,0.5);
    font-weight: 700;
}

.shop_table.woocommerce-checkout-review-order-table .order-total th {
    font-family: 'Kurversbrug', serif;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #133E23;
    font-weight: normal;
}

.shop_table.woocommerce-checkout-review-order-table .order-total td {
    font-size: 24px;
    font-weight: 800;
    color: #133E23;
    text-align: right;
}

/* Payment Methods */
#payment {
    background: transparent !important;
    border-top: 1px solid rgba(19,62,35,0.1);
    margin-top: 24px;
    padding-top: 24px !important;
}

#payment ul.payment_methods {
    padding: 0 !important;
    margin-bottom: 24px !important;
    border: none !important;
}

#payment ul.payment_methods li {
    background: #fff;
    border-radius: 12px;
    padding: 16px !important;
    margin-bottom: 10px !important;
    border: 1px solid rgba(19,62,35,0.06);
    transition: all 0.2s;
}

#payment ul.payment_methods li input {
    margin-right: 12px !important;
}

#payment ul.payment_methods li label {
    font-weight: 700;
    color: #133E23;
    font-size: 14px;
    cursor: pointer;
}

#payment div.payment_box {
    background: rgba(19,62,35,0.03) !important;
    border-radius: 8px !important;
    font-size: 13px !important;
    color: rgba(19,62,35,0.7) !important;
    margin-top: 12px !important;
    padding: 12px !important;
}
#payment div.payment_box::before { display: none !important; }

/* Place Order Button */
#place_order {
    width: 100%;
    background: #133E23 !important;
    color: #cdbca6 !important;
    border-radius: 9999px !important;
    padding: 18px 24px !important;
    font-family: 'Kurversbrug', serif !important;
    font-size: 16px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.2em !important;
    border: none !important;
    transition: all 0.3s ease !important;
    margin-top: 20px !important;
    box-shadow: 0 8px 25px rgba(19,62,35,0.2) !important;
}

#place_order:hover {
    background: #0a2415 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 12px 35px rgba(19,62,35,0.3) !important;
    color: #fff !important;
}

/* Coupon info */
.woocommerce-form-coupon-toggle {
    margin-bottom: 24px;
}
.woocommerce-info {
    font-size: 14px;
    background: rgba(19,62,35,0.03);
    border: 1px solid rgba(19,62,35,0.06);
    color: #133E23;
    padding: 16px 20px;
    border-radius: 12px;
}

/* Responsive fixes */
@media (max-width: 768px) {
    .avw-checkout-card { padding: 24px; }
}
</style>

<div class="avw-checkout-container">

    <div class="avw-checkout-header">
        <h1><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></h1>
        <p><?php esc_html_e( 'Please provide your shipping and payment details below.', 'woocommerce' ); ?></p>
    </div>

    <form name="checkout" method="post" class="checkout woocommerce-checkout avw-checkout-layout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <!-- LEFT COLUMN: Forms -->
        <div class="avw-checkout-left">
            
            <?php if ( $checkout->get_checkout_fields() ) : ?>

                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                <div class="avw-checkout-card" id="customer_details">
                    <div class="avw-billing-section">
                        <h3 class="avw-checkout-section-title"><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    </div>

                    <div class="avw-shipping-section" style="margin-top: 48px;">
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>
                </div>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <?php endif; ?>

            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
            
            <div class="avw-checkout-card" style="margin-top: 32px;">
                <h3 id="order_review_heading" class="avw-checkout-section-title"><?php esc_html_e( 'Additional Information', 'woocommerce' ); ?></h3>
                <?php do_action( 'woocommerce_checkout_after_order_review_heading' ); ?>
            </div>

        </div>

        <!-- RIGHT COLUMN: Order Review & Payment -->
        <div class="avw-checkout-right">
            <div class="avw-order-review-sidebar">
                
                <h3 class="avw-checkout-section-title" style="margin-bottom: 24px; border:none; text-align:center;"><?php esc_html_e( 'Your Order', 'woocommerce' ); ?></h3>

                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

                <div style="margin-top: 24px; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(19,62,35,0.3);">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    <span>Secure encrypted checkout</span>
                </div>
            </div>
        </div>

    </form>

    <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

</div>
