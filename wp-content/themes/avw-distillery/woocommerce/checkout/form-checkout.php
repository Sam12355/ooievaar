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

if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
?>

<style>
/* ============================================================
   BOUTIQUE CHECKOUT — Comprehensive Design System
   ============================================================ */

* { box-sizing: border-box; }

.avw-checkout-container {
    font-family: 'DM Sans', sans-serif;
    color: #133E23;
    padding-bottom: 100px;
}

/* ---------- Page Header ---------- */
.avw-checkout-header {
    margin-bottom: 48px;
    text-align: center;
}
.avw-checkout-header h1 {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(28px, 5vw, 44px);
    letter-spacing: 0.15em;
    text-transform: uppercase;
    margin: 0 0 8px;
    color: #133E23;
    font-weight: normal;
}
.avw-checkout-header p {
    font-size: 14px;
    color: rgba(19,62,35,0.45);
    letter-spacing: 0.04em;
    margin: 0;
}

/* ---------- Two-column Layout ---------- */
.avw-checkout-layout {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 40px;
    align-items: start;
}
@media (max-width: 1100px) {
    .avw-checkout-layout { grid-template-columns: 1fr; gap: 32px; }
}

/* ---------- Cards ---------- */
.avw-checkout-card {
    background: #fff;
    border-radius: 20px;
    padding: 36px 40px;
    box-shadow: 0 4px 40px rgba(0,0,0,0.06);
    border: 1px solid rgba(19,62,35,0.05);
    margin-bottom: 24px;
}
.avw-checkout-card:last-child { margin-bottom: 0; }

.avw-checkout-section-title {
    font-family: 'Kurversbrug', serif;
    font-size: 18px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    margin: 0 0 28px;
    padding-bottom: 16px;
    border-bottom: 1px solid rgba(19,62,35,0.08);
    color: #133E23;
    font-weight: normal;
}

/* ---------- Notices / Alerts ---------- */
.woocommerce-info,
.woocommerce-message,
.woocommerce-error {
    border-radius: 12px !important;
    font-size: 14px !important;
    padding: 16px 20px !important;
    margin-bottom: 24px !important;
    list-style: none !important;
    border-left: 3px solid !important;
}
.woocommerce-info {
    background: rgba(19,62,35,0.04) !important;
    border-color: #133E23 !important;
    color: #133E23 !important;
}
.woocommerce-message {
    background: rgba(19,62,35,0.04) !important;
    border-color: #133E23 !important;
    color: #133E23 !important;
}
.woocommerce-error {
    background: rgba(220,38,38,0.04) !important;
    border-color: #dc2626 !important;
    color: #991b1b !important;
}
.woocommerce-info a,
.woocommerce-message a {
    color: #133E23 !important;
    font-weight: 700 !important;
    text-decoration: underline !important;
}

/* ---------- Coupon Toggle Banner ---------- */
.woocommerce-form-coupon-toggle {
    margin-bottom: 24px;
}
.woocommerce-form-coupon-toggle .woocommerce-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Coupon Form */
.checkout_coupon.woocommerce-form-coupon {
    background: #fff;
    border-radius: 16px;
    padding: 28px 32px;
    box-shadow: 0 4px 30px rgba(0,0,0,0.05);
    border: 1px solid rgba(19,62,35,0.07);
    margin-bottom: 24px;
    display: flex;
    gap: 12px;
    align-items: flex-end;
    flex-wrap: wrap;
}
.checkout_coupon p { margin: 0; flex: 1; min-width: 200px; }
.checkout_coupon label {
    font-size: 11px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    color: rgba(19,62,35,0.45) !important;
    display: block !important;
    margin-bottom: 8px !important;
}
.checkout_coupon input[type="text"] {
    padding: 13px 18px !important;
    border: 1.5px solid rgba(19,62,35,0.12) !important;
    border-radius: 10px !important;
    font-size: 15px !important;
    width: 100% !important;
    color: #133E23 !important;
    background: #fcfcfc !important;
    transition: border-color 0.2s !important;
}
.checkout_coupon input[type="text"]:focus {
    border-color: #133E23 !important;
    outline: none !important;
    box-shadow: 0 0 0 4px rgba(19,62,35,0.05) !important;
}
.checkout_coupon button[type="submit"] {
    padding: 13px 28px !important;
    background: #133E23 !important;
    color: #cdbca6 !important;
    border: none !important;
    border-radius: 9999px !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    cursor: pointer !important;
    transition: all 0.2s !important;
    white-space: nowrap !important;
}
.checkout_coupon button[type="submit"]:hover {
    background: #0a2415 !important;
}

/* ---------- Field Wrapper Grid ---------- */
.woocommerce-billing-fields__field-wrapper,
.woocommerce-shipping-fields__field-wrapper,
.woocommerce-additional-fields__field-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0 20px;
}

/* ---------- Individual Form Rows ---------- */
.form-row {
    display: flex;
    flex-direction: column;
    margin-bottom: 18px !important;
    width: 100% !important;
    float: none !important;
    padding: 0 !important;
}
.form-row-wide,
.form-row-wide.form-row { grid-column: span 2; }

/* Required star */
.required { color: #c0392b !important; font-size: 14px; margin-left: 2px; }

/* Labels */
.form-row > label,
.form-row label:first-child {
    font-size: 11px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    color: rgba(19,62,35,0.45) !important;
    margin-bottom: 7px !important;
    display: flex !important;
    align-items: center !important;
    gap: 2px !important;
}

/* Text / Email / Tel / Password inputs */
.form-row input[type="text"],
.form-row input[type="email"],
.form-row input[type="tel"],
.form-row input[type="password"],
.form-row input[type="number"],
.form-row textarea {
    padding: 13px 18px !important;
    border: 1.5px solid rgba(19,62,35,0.1) !important;
    border-radius: 12px !important;
    font-size: 15px !important;
    color: #133E23 !important;
    background: #fafafa !important;
    transition: all 0.2s !important;
    width: 100% !important;
    font-family: 'DM Sans', sans-serif !important;
    appearance: none !important;
    -webkit-appearance: none !important;
}
.form-row input:focus,
.form-row textarea:focus {
    border-color: #133E23 !important;
    background: #fff !important;
    outline: none !important;
    box-shadow: 0 0 0 4px rgba(19,62,35,0.06) !important;
}

/* Error state */
.form-row.woocommerce-invalid input,
.form-row.woocommerce-invalid select,
.form-row.woocommerce-invalid .select2-selection {
    border-color: #dc2626 !important;
    background: rgba(220,38,38,0.02) !important;
}
.form-row .woocommerce-error,
.woocommerce-invalid-required-field .form-row-label::after {
    font-size: 11px;
    color: #dc2626;
    margin-top: 4px;
}

/* ---------- Select (native) ---------- */
.form-row select {
    padding: 13px 42px 13px 18px !important;
    border: 1.5px solid rgba(19,62,35,0.1) !important;
    border-radius: 12px !important;
    font-size: 15px !important;
    color: #133E23 !important;
    background: #fafafa url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23133E23' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E") no-repeat right 14px center !important;
    background-size: 16px !important;
    cursor: pointer !important;
    width: 100% !important;
    font-family: 'DM Sans', sans-serif !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
}
.form-row select:focus {
    border-color: #133E23 !important;
    outline: none !important;
    box-shadow: 0 0 0 4px rgba(19,62,35,0.06) !important;
}

/* ---------- Select2 (WooCommerce custom dropdowns) ---------- */
.select2-container--default .select2-selection--single {
    height: 48px !important;
    border: 1.5px solid rgba(19,62,35,0.1) !important;
    border-radius: 12px !important;
    background: #fafafa !important;
    display: flex !important;
    align-items: center !important;
    transition: all 0.2s !important;
}
.select2-container--default.select2-container--focus .select2-selection--single,
.select2-container--default.select2-container--open .select2-selection--single {
    border-color: #133E23 !important;
    background: #fff !important;
    box-shadow: 0 0 0 4px rgba(19,62,35,0.06) !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #133E23 !important;
    font-size: 15px !important;
    font-family: 'DM Sans', sans-serif !important;
    line-height: 48px !important;
    padding-left: 18px !important;
    padding-right: 40px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 46px !important;
    right: 12px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow b {
    border-color: rgba(19,62,35,0.4) transparent transparent transparent !important;
}
.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
    border-color: transparent transparent rgba(19,62,35,0.8) transparent !important;
}
/* Select2 Dropdown */
.select2-dropdown {
    border: 1.5px solid rgba(19,62,35,0.12) !important;
    border-radius: 12px !important;
    box-shadow: 0 8px 30px rgba(0,0,0,0.1) !important;
    overflow: hidden !important;
    font-family: 'DM Sans', sans-serif !important;
}
.select2-search--dropdown .select2-search__field {
    border: 1.5px solid rgba(19,62,35,0.1) !important;
    border-radius: 8px !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
    color: #133E23 !important;
    margin: 8px !important;
    width: calc(100% - 16px) !important;
}
.select2-results__option {
    padding: 12px 16px !important;
    font-size: 14px !important;
    color: #133E23 !important;
    transition: background 0.15s !important;
}
.select2-results__option--highlighted {
    background: rgba(19,62,35,0.07) !important;
    color: #133E23 !important;
}
.select2-results__option[aria-selected="true"] {
    background: rgba(19,62,35,0.12) !important;
    font-weight: 700 !important;
}

/* ---------- Checkboxes (Ship to different address, Create account) ---------- */
.woocommerce-shipping-fields h3,
.woocommerce-account-fields h3 {
    font-family: 'DM Sans', sans-serif !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    color: #133E23 !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    margin: 0 0 20px !important;
    cursor: pointer !important;
}
/* Custom checkbox wrapper */
.woocommerce-form__label-for-checkbox,
label.checkbox {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    cursor: pointer !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    color: #133E23 !important;
    margin: 0 !important;
    letter-spacing: 0 !important;
    text-transform: none !important;
}
.woocommerce-form__label-for-checkbox input[type="checkbox"],
label.checkbox input[type="checkbox"],
.form-row input[type="checkbox"] {
    width: 18px !important;
    height: 18px !important;
    border: 2px solid rgba(19,62,35,0.2) !important;
    border-radius: 4px !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    background: #fafafa !important;
    cursor: pointer !important;
    position: relative !important;
    flex-shrink: 0 !important;
    transition: all 0.15s !important;
    margin: 0 !important;
    padding: 0 !important;
}
.woocommerce-form__label-for-checkbox input[type="checkbox"]:checked,
label.checkbox input[type="checkbox"]:checked,
.form-row input[type="checkbox"]:checked {
    background: #133E23 !important;
    border-color: #133E23 !important;
}
.woocommerce-form__label-for-checkbox input[type="checkbox"]:checked::after,
label.checkbox input[type="checkbox"]:checked::after,
.form-row input[type="checkbox"]:checked::after {
    content: '' !important;
    position: absolute !important;
    left: 4px !important;
    top: 1px !important;
    width: 6px !important;
    height: 10px !important;
    border: 2px solid #cdbca6 !important;
    border-top: none !important;
    border-left: none !important;
    transform: rotate(45deg) !important;
}

/* ---------- Terms & Conditions ---------- */
.woocommerce-terms-and-conditions-wrapper {
    margin-top: 16px;
    padding: 16px;
    background: rgba(19,62,35,0.03);
    border-radius: 10px;
    border: 1px solid rgba(19,62,35,0.06);
}
.woocommerce-terms-and-conditions-wrapper label {
    font-size: 13px !important;
    color: rgba(19,62,35,0.7) !important;
    font-weight: 400 !important;
    text-transform: none !important;
    letter-spacing: 0 !important;
}
.woocommerce-terms-and-conditions-wrapper a {
    color: #133E23 !important;
    font-weight: 700 !important;
    text-decoration: underline !important;
}
.woocommerce-terms-and-conditions {
    border: 1px solid rgba(19,62,35,0.08) !important;
    border-radius: 8px !important;
    padding: 12px 16px !important;
    font-size: 13px !important;
    color: rgba(19,62,35,0.7) !important;
    line-height: 1.6 !important;
    background: #fafafa !important;
    margin-bottom: 12px !important;
}

/* ---------- Right Sidebar ---------- */
.avw-order-review-sidebar {
    position: sticky;
    top: 100px;
}

#order_review {
    background: #fff;
    border-radius: 20px;
    padding: 36px 32px;
    border: 1px solid rgba(19,62,35,0.07);
    box-shadow: 0 4px 40px rgba(0,0,0,0.06);
}

/* "Your Order" heading */
#order_review_heading,
.avw-order-sidebar-heading {
    font-family: 'Kurversbrug', serif;
    font-size: 18px;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #133E23;
    font-weight: normal;
    text-align: center;
    margin-bottom: 28px;
    padding-bottom: 18px;
    border-bottom: 2px solid rgba(19,62,35,0.08);
}

/* ---------- Date fields inline (Day / Month / Year) ---------- */
/* Target date field rows — make them sit side-by-side in a 3-col row */
#billing_birth_date_day_field,
#billing_birth_date_month_field,
#billing_birth_date_year_field,
[id$="_day_field"],
[id$="_month_field"],
[id$="_year_field"] {
    min-width: 0;
}
/* Force the billing wrapper area that contains date selects into a 3-col row */
.avw-date-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 12px;
    grid-column: span 2;
    margin-bottom: 18px;
}
.avw-date-row .form-row {
    margin-bottom: 0 !important;
}

/* Order Review Table */
table.woocommerce-checkout-review-order-table {
    width: 100%;
    border-collapse: collapse;
}
table.woocommerce-checkout-review-order-table thead {
    display: none;
}
table.woocommerce-checkout-review-order-table tbody tr td {
    padding: 12px 0;
    border-bottom: 1px solid rgba(19,62,35,0.06);
    font-size: 14px;
    color: #133E23;
    background: transparent !important;
    vertical-align: middle;
}
/* Product name column */
table.woocommerce-checkout-review-order-table .product-name {
    font-weight: 500;
    padding-right: 12px;
}
table.woocommerce-checkout-review-order-table .product-name .product-quantity {
    color: rgba(19,62,35,0.4);
    font-size: 13px;
    font-weight: 400;
}
/* Product total column */
table.woocommerce-checkout-review-order-table .product-total {
    text-align: right;
    font-weight: 700;
    white-space: nowrap;
}
/* Subtotal row */
table.woocommerce-checkout-review-order-table .cart-subtotal th,
table.woocommerce-checkout-review-order-table .cart-subtotal td {
    padding: 14px 0 10px;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(19,62,35,0.45);
    font-weight: 700;
    background: transparent !important;
}
table.woocommerce-checkout-review-order-table .cart-subtotal td {
    text-align: right;
    font-size: 14px;
    font-weight: 700;
    color: #133E23;
}
/* Shipping row */
table.woocommerce-checkout-review-order-table .shipping th {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(19,62,35,0.45);
    font-weight: 700;
    background: transparent !important;
}
table.woocommerce-checkout-review-order-table .shipping td {
    text-align: right;
    font-size: 13px;
    color: rgba(19,62,35,0.7);
    background: transparent !important;
}
/* Discounts/Coupons */
table.woocommerce-checkout-review-order-table .discount th,
table.woocommerce-checkout-review-order-table .coupon th {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(19,62,35,0.45);
    font-weight: 700;
    background: transparent !important;
}
table.woocommerce-checkout-review-order-table .discount td,
table.woocommerce-checkout-review-order-table .coupon td {
    text-align: right;
    color: #c0392b;
    font-weight: 700;
    background: transparent !important;
}
/* Tax row */
table.woocommerce-checkout-review-order-table .tax-rate th {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(19,62,35,0.45);
    font-weight: 700;
    background: transparent !important;
}
table.woocommerce-checkout-review-order-table .tax-rate td {
    text-align: right;
    font-size: 13px;
    color: rgba(19,62,35,0.6);
    background: transparent !important;
}
/* Total row */
table.woocommerce-checkout-review-order-table tfoot .order-total th {
    font-family: 'Kurversbrug', serif;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #133E23;
    font-weight: normal;
    padding-top: 20px;
    border-top: 1.5px solid rgba(19,62,35,0.12);
    border-bottom: none;
    background: transparent !important;
}
table.woocommerce-checkout-review-order-table tfoot .order-total td {
    font-size: 26px;
    font-weight: 800;
    color: #133E23;
    text-align: right;
    padding-top: 20px;
    border-top: 1.5px solid rgba(19,62,35,0.12);
    border-bottom: none;
    background: transparent !important;
    letter-spacing: -0.02em;
}
/* Tax note in total */
table.woocommerce-checkout-review-order-table tfoot .order-total small {
    display: block;
    font-size: 10px;
    font-weight: 500;
    color: rgba(19,62,35,0.35);
    margin-top: 4px;
    letter-spacing: 0.03em;
}

/* ---------- Payment Methods ---------- */
#payment {
    background: transparent !important;
    padding: 0 !important;
    margin-top: 24px;
}
#payment .payment_methods_heading {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(19,62,35,0.45);
    font-weight: 700;
    padding: 0 0 12px;
    border-bottom: 1px solid rgba(19,62,35,0.08);
    margin-bottom: 12px;
}
#payment ul.payment_methods {
    padding: 0 !important;
    margin: 0 0 20px !important;
    border-bottom: none !important;
    list-style: none !important;
}
#payment ul.payment_methods li.payment_method {
    background: #fff;
    border-radius: 12px;
    padding: 0 !important;
    margin-bottom: 8px !important;
    border: 1.5px solid rgba(19,62,35,0.08);
    transition: border-color 0.2s;
    overflow: hidden;
}
#payment ul.payment_methods li.payment_method:has(input:checked) {
    border-color: #133E23;
    box-shadow: 0 0 0 3px rgba(19,62,35,0.06);
}
/* Payment method label row */
#payment ul.payment_methods li input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}
#payment ul.payment_methods li label {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 18px;
    font-size: 14px;
    font-weight: 600;
    color: #133E23;
    cursor: pointer;
    background: transparent;
    width: 100%;
}
/* Custom radio bullet */
#payment ul.payment_methods li label::before {
    content: '';
    width: 18px;
    height: 18px;
    border: 2px solid rgba(19,62,35,0.25);
    border-radius: 50%;
    flex-shrink: 0;
    transition: all 0.2s;
    background: #fafafa;
}
#payment ul.payment_methods li:has(input:checked) label::before {
    border-color: #133E23;
    background: #133E23;
    box-shadow: inset 0 0 0 3px #fff;
}
/* Payment gateway logos */
#payment ul.payment_methods li label img {
    height: 22px;
    width: auto;
    margin-left: auto;
    opacity: 0.7;
}
/* Payment box (card fields, instructions) */
#payment div.payment_box {
    background: rgba(19,62,35,0.04) !important;
    border-top: 1px solid rgba(19,62,35,0.06) !important;
    padding: 16px 18px !important;
    font-size: 13px !important;
    color: rgba(19,62,35,0.65) !important;
    line-height: 1.6 !important;
    border-radius: 0 !important;
    margin: 0 !important;
}
#payment div.payment_box::before { display: none !important; }
/* Stripe / iDEAL / card input fields inside payment box */
#payment div.payment_box input[type="text"],
#payment div.payment_box input[type="tel"],
#payment div.payment_box select {
    padding: 11px 16px !important;
    border: 1.5px solid rgba(19,62,35,0.1) !important;
    border-radius: 9px !important;
    font-size: 14px !important;
    width: 100% !important;
    color: #133E23 !important;
    background: #fff !important;
    margin-top: 8px !important;
    font-family: 'DM Sans', sans-serif !important;
}

/* Place Order / Submit */
#place_order {
    display: block !important;
    width: 100% !important;
    background: #133E23 !important;
    color: #cdbca6 !important;
    border-radius: 9999px !important;
    padding: 18px 24px !important;
    font-family: 'Kurversbrug', serif !important;
    font-size: 16px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.2em !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    margin-top: 20px !important;
    box-shadow: 0 8px 28px rgba(19,62,35,0.2) !important;
    text-align: center !important;
}
#place_order:hover {
    background: #0a2415 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 14px 36px rgba(19,62,35,0.3) !important;
    color: #fff !important;
}

/* ---------- Shipping Methods (inside order review) ---------- */
.shipping-calculator-button {
    font-size: 12px !important;
    color: rgba(19,62,35,0.55) !important;
    text-decoration: underline !important;
    cursor: pointer !important;
}
ul#shipping_method {
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
}
ul#shipping_method li {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: rgba(19,62,35,0.7);
    margin-bottom: 6px;
}
ul#shipping_method li input[type="radio"] {
    accent-color: #133E23;
    width: 15px;
    height: 15px;
    cursor: pointer;
}
ul#shipping_method li label {
    cursor: pointer;
    color: rgba(19,62,35,0.75) !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    text-transform: none !important;
    letter-spacing: 0 !important;
}

/* ---------- Account fields / Password ---------- */
.woocommerce-account-fields {
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid rgba(19,62,35,0.08);
}
.create-account {
    margin-top: 12px;
}
.create-account label {
    font-size: 13px !important;
    color: rgba(19,62,35,0.65) !important;
    text-transform: none !important;
    letter-spacing: 0 !important;
    font-weight: 400 !important;
}

/* ---------- Privacy Policy / Notices ---------- */
.woocommerce-privacy-policy-text {
    font-size: 12px;
    color: rgba(19,62,35,0.4);
    margin-top: 12px;
    line-height: 1.6;
}
.woocommerce-privacy-policy-text a {
    color: #133E23;
    text-decoration: underline;
}

/* ---------- Trust Badge ---------- */
.avw-trust-badge-checkout {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 20px;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(19,62,35,0.3);
}

/* ---------- Responsive ---------- */
@media (max-width: 768px) {
    .avw-checkout-card { padding: 24px 20px; }
    .woocommerce-billing-fields__field-wrapper,
    .woocommerce-shipping-fields__field-wrapper,
    .woocommerce-additional-fields__field-wrapper {
        grid-template-columns: 1fr;
    }
    .form-row-wide { grid-column: span 1; }
    #order_review { padding: 24px 20px; }
}
</style>

<div class="avw-checkout-container">

    <div class="avw-checkout-header">
        <h1><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></h1>
        <p><?php esc_html_e( 'Complete your order below', 'woocommerce' ); ?></p>
    </div>

    <form name="checkout" method="post" class="checkout woocommerce-checkout avw-checkout-layout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <!-- LEFT COLUMN -->
        <div class="avw-checkout-left">

            <?php if ( $checkout->get_checkout_fields() ) : ?>
                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                <div class="avw-checkout-card" id="customer_details">
                    <h3 class="avw-checkout-section-title"><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>

                    <div style="margin-top: 36px; border-top: 1px solid rgba(19,62,35,0.07); padding-top: 32px;">
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>
                </div>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
            <?php endif; ?>

            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
            <?php do_action( 'woocommerce_checkout_after_order_review_heading' ); ?>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="avw-checkout-right">
            <div class="avw-order-review-sidebar">

                <h3 class="avw-order-sidebar-heading"><?php esc_html_e( 'Your Order', 'woocommerce' ); ?></h3>

                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

                <div class="avw-trust-badge-checkout">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    <span><?php esc_html_e( 'Secure encrypted checkout', 'woocommerce' ); ?></span>
                </div>

            </div>
        </div>

    </form>

    <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

</div>

<script>
jQuery(function($) {

    // ── 1. Group Date Fields (Day/Month/Year) into a single inline row ──────────
    function groupDateFields() {
        // Look for any three consecutive form-rows whose IDs end in _day, _month, _year
        var patterns = [
            ['[id$="_day_field"]', '[id$="_month_field"]', '[id$="_year_field"]'],
            ['[id*="birth"][id$="_dd_field"]', '[id*="birth"][id$="_mm_field"]', '[id*="birth"][id$="_yyyy_field"]']
        ];

        patterns.forEach(function(group) {
            var $day   = $(group[0]);
            var $month = $(group[1]);
            var $year  = $(group[2]);

            if ($day.length && $month.length && $year.length) {
                // Only wrap once
                if ($day.parent('.avw-date-row').length) return;

                var $wrapper = $('<div class="avw-date-row"></div>');
                $day.before($wrapper);
                $wrapper.append($day).append($month).append($year);
            }
        });

        // Also handle adjacent form-rows that contain selects for day/month/year
        // by checking select options for numeric day values (1-31)
        $('.woocommerce-billing-fields__field-wrapper .form-row select, .woocommerce-shipping-fields__field-wrapper .form-row select').each(function() {
            var $sel = $(this);
            var $row = $sel.closest('.form-row');
            if ($row.parent('.avw-date-row').length) return;

            var opts = $sel.find('option').map(function(){ return $(this).val(); }).get();
            var isDayField   = opts.includes('1')  && opts.includes('31') && opts.length <= 33;
            var isMonthField = opts.includes('1')  && opts.includes('12') && opts.length <= 14;
            var isYearField  = opts.length > 50 && !isNaN(parseInt(opts[1])) && parseInt(opts[1]) > 1900;

            if (isDayField || isMonthField || isYearField) {
                $row.addClass('avw-date-candidate');
            }
        });

        // Group consecutive date candidates
        var $candidates = $('.avw-date-candidate');
        if ($candidates.length >= 2) {
            var $parent = $candidates.first().parent();
            var $wrapper = $('<div class="avw-date-row"></div>');
            $candidates.first().before($wrapper);
            $candidates.each(function() {
                $wrapper.append($(this));
            });
        }
    }

    groupDateFields();

    // ── 2. Force Select2 on ALL select fields in checkout form ──────────────────
    function initSelect2OnAll() {
        if (typeof $.fn.select2 === 'undefined') return;

        $('form.woocommerce-checkout select').each(function() {
            var $sel = $(this);
            // Skip if already select2, skip hidden inputs
            if ($sel.hasClass('select2-hidden-accessible')) return;
            if ($sel.attr('id') === 'billing_country' || $sel.attr('id') === 'shipping_country') return; // WC handles these
            if ($sel.attr('id') === 'billing_state'   || $sel.attr('id') === 'shipping_state')   return;

            // Check if it's a date-type field
            var opts   = $sel.find('option').map(function(){ return $(this).val(); }).get();
            var isDate = opts.length <= 34 || (opts.length <= 14 && opts.includes('12'));

            $sel.select2({
                minimumResultsForSearch: isDate ? Infinity : 5, // no search for small lists like day/month
                width: '100%',
                placeholder: $sel.find('option:first').text() || ''
            });
        });
    }

    initSelect2OnAll();

    // Re-run when WC updates checkout (e.g. shipping change)
    $(document.body).on('updated_checkout', function() {
        groupDateFields();
        initSelect2OnAll();
    });

});
</script>
