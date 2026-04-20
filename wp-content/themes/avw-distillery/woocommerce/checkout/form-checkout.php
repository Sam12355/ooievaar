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
   BOUTIQUE CHECKOUT — Advanced Design System
   ============================================================ */

.avw-checkout-container {
    font-family: 'DM Sans', sans-serif;
    color: #133E23;
    padding-bottom: 100px;
    overflow-x: hidden; /* Prevent horizontal scroll */
}

/* Force hiding horizontal scroll on checkout page */
body.woocommerce-checkout {
    overflow-x: hidden !important;
}

.woocommerce table.shop_table {
    padding: 20px !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
}

/* Page Header */
.avw-checkout-header {
    margin-bottom: 64px;
    text-align: center;
}
.avw-checkout-header h1 {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(32px, 6vw, 48px);
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #133E23;
    margin: 0 0 12px;
    font-weight: normal;
}
.avw-checkout-header p {
    font-size: 15px;
    color: rgba(19,62,35,0.5);
    letter-spacing: 0.05em;
}

/* Two-column layout */
.avw-checkout-layout {
    display: grid;
    grid-template-columns: 1fr 440px;
    gap: 40px;
    align-items: start;
}
@media (max-width: 1100px) {
    .avw-checkout-layout { grid-template-columns: 1fr; gap: 32px; }
}

/* ---- PREMIUM CARDS ---- */
.avw-checkout-card {
    background: #fff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 12px 60px rgba(0,0,0,0.04);
    border: 1px solid rgba(19,62,35,0.06);
    margin-bottom: 24px;
}

.avw-checkout-section-title {
    font-family: 'Kurversbrug', serif;
    font-size: 20px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    margin: 0 0 32px;
    padding-bottom: 18px;
    border-bottom: 1.5px solid rgba(19,62,35,0.08);
    color: #133E23;
}

/* ---- FORM FIELDS REFINEMENT ---- */
.form-row {
    margin-bottom: 24px !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-start !important;
}

/* Outer field description label — full width, stacked on top */
.form-row > label:first-child,
.form-row > label.avw-outer-label {
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.08em !important;
    color: #133E23 !important;
    margin-bottom: 8px !important;
    display: block !important;
    width: 100% !important;
}

/* Radio/Checkbox labels INSIDE woocommerce-input-wrapper must NOT be block */
.woocommerce-input-wrapper label,
.form-row label.radio,
.form-row label.checkbox {
    font-size: 14px !important;
    font-weight: 500 !important;
    text-transform: none !important;
    letter-spacing: 0 !important;
    color: #133E23 !important;
    margin-bottom: 0 !important;
    display: inline !important;
    cursor: pointer !important;
}

.form-row input[type="text"],
.form-row input[type="email"],
.form-row input[type="tel"],
.form-row input[type="number"],
.form-row input[type="password"],
.form-row textarea {
    padding: 15px 20px !important;
    border: 1.5px solid rgba(19,62,35,0.12) !important;
    border-radius: 12px !important;
    font-size: 15px !important;
    color: #133E23 !important;
    background: #fdfdfd !important;
    transition: all 0.25s ease !important;
    width: 100% !important;
}

.form-row input:focus,
.form-row textarea:focus {
    border-color: #133E23 !important;
    background: #fff !important;
    box-shadow: 0 0 0 4px rgba(19,62,35,0.06) !important;
    outline: none !important;
}

/* ---- DATE FIELDS (Day / Month / Year) IN ONE LINE ---- */
.avw-date-row {
    display: flex !important;
    gap: 15px !important;
    width: 100% !important;
    margin-bottom: 24px !important;
}
.avw-date-row .form-row {
    flex: 1 !important;
    margin-bottom: 0 !important;
}
.avw-date-row .form-row-wide { width: auto !important; flex: 1 !important; }

/* ---- SELECT2 CUSTOM STYLING (ALWAYS SEARCHABLE) ---- */
.select2-container--default .select2-selection--single {
    height: 52px !important;
    border: 1.5px solid rgba(19,62,35,0.12) !important;
    border-radius: 12px !important;
    background: #fdfdfd !important;
    display: flex !important;
    align-items: center !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: normal !important;
    padding-left: 20px !important;
    color: #133E23 !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 50px !important;
}

/* ---- RADIO BUTTON & CHECKBOX ALIGNMENT ---- */

/* For VAT / shipping options: input + label are inside .woocommerce-input-wrapper */
.woocommerce-input-wrapper {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    line-height: 1 !important;
}
.woocommerce-input-wrapper input[type="radio"],
.woocommerce-input-wrapper input[type="checkbox"] {
    flex-shrink: 0 !important;
    width: 16px !important;
    height: 16px !important;
    margin: 0 !important;
    vertical-align: middle !important;
}
.woocommerce-input-wrapper label {
    margin: 0 !important;
    line-height: 1.3 !important;
    cursor: pointer !important;
}

/* For Payment Methods: input + label are siblings inside <li>, so the <li> must be the flex parent */
#payment ul.payment_methods li {
    display: flex !important;
    flex-wrap: wrap !important;
    align-items: center !important;
    gap: 0 !important;
    padding: 0 !important;
}
#payment ul.payment_methods li > input[type="radio"] {
    flex-shrink: 0 !important;
    order: 0 !important;
    width: 18px !important;
    height: 18px !important;
    margin: 0 0 0 16px !important;
    cursor: pointer !important;
}
#payment ul.payment_methods li > label {
    flex: 1 !important;
    order: 1 !important;
    display: flex !important;
    align-items: center !important;
    padding: 18px 16px !important;
    margin: 0 !important;
    cursor: pointer !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    color: #133E23 !important;
    line-height: 1 !important;
}
/* Payment box spans full width on its own row */
#payment ul.payment_methods li > .payment_box,
#payment div.payment_box {
    order: 2 !important;
    width: 100% !important;
    flex-basis: 100% !important;
    margin: 0 16px 16px 16px !important;
    background: rgba(19,62,35,0.04) !important;
    padding: 14px !important;
    border-radius: 8px !important;
    font-size: 13px !important;
}

/* ---- RIGHT SECTION: ORDER SUMMARY WHITE BACKGROUND ---- */
#order_review {
    background: #fff !important;
    border-radius: 20px !important;
    padding: 40px !important;
    border: 1px solid rgba(19,62,35,0.08) !important;
    box-shadow: 0 15px 50px rgba(0,0,0,0.05) !important;
}

.avw-order-sidebar-heading {
    text-align: left !important;
    border-bottom: 2px solid #133E23 !important;
    margin-bottom: 25px !important;
    padding-bottom: 12px !important;
}

/* Order Table */
table.woocommerce-checkout-review-order-table tr td,
table.woocommerce-checkout-review-order-table tr th {
    padding: 15px 0 !important;
    border-bottom: 1px solid rgba(19,62,35,0.06) !important;
}
</style>

<div class="avw-checkout-container">

    <div class="avw-checkout-header">
        <h1><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></h1>
        <p><?php esc_html_e( 'Secure your order of fine Dutch spirits', 'woocommerce' ); ?></p>
    </div>

    <form name="checkout" method="post" class="checkout woocommerce-checkout avw-checkout-layout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <!-- LEFT COLUMN -->
        <div class="avw-checkout-left">
            
            <?php if ( $checkout->get_checkout_fields() ) : ?>
                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                <div class="avw-checkout-card" id="customer_details">
                    <h3 class="avw-checkout-section-title"><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>

                    <div style="margin-top: 40px; border-top: 1px solid rgba(19,62,35,0.08); padding-top: 35px;">
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>
                </div>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
            <?php endif; ?>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="avw-checkout-right">
            <div class="avw-order-review-sidebar">
                
                <div id="order_review" class="woocommerce-checkout-review-order">
                    <h3 class="avw-checkout-section-title avw-order-sidebar-heading"><?php esc_html_e( 'Your Order', 'woocommerce' ); ?></h3>
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

                <div class="avw-trust-badge-checkout" style="margin-top: 20px; text-align:center; font-size: 11px; opacity: 0.4;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block; vertical-align:middle; margin-right:5px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    <span>Secure Encrypted Payment</span>
                </div>
            </div>
        </div>

    </form>

    <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

</div>

<script>
jQuery(function($) {

    // ── 1. TRANSFORM NUMBER INPUTS INTO SELECTS AND GROUP THEM ──────────────────
    function transformAndGroupDates() {
        var $dayInput   = $('#min_age_woo_dob_day');
        var $monthInput = $('#min_age_woo_dob_month');
        var $yearInput  = $('#min_age_woo_dob_year');

        // Helper to convert input to select
        function convertToSelect($input, start, end, placeholder) {
            if (!$input.length) return;
            
            var id = $input.attr('id');
            var selectId = id + '_select';
            
            // If the select already exists, don't create it again
            if ($('#' + selectId).length) return $('#' + selectId);
            
            var val = $input.val();
            var $select = $('<select id="' + selectId + '" class="avw-transformed-date-select"></select>');
            
            $select.append('<option value="">' + placeholder + '</option>');
            if (start < end) {
                for (var i = start; i <= end; i++) {
                    $select.append('<option value="' + i + '" ' + (val == i ? 'selected' : '') + '>' + i + '</option>');
                }
            } else {
                for (var i = start; i >= end; i--) {
                    $select.append('<option value="' + i + '" ' + (val == i ? 'selected' : '') + '>' + i + '</option>');
                }
            }

            // Hide original and add select
            $input.hide().after($select);
            
            $select.on('change', function() {
                $input.val($(this).val()).trigger('change');
            });

            return $select;
        }

        if ($dayInput.length) {
            convertToSelect($dayInput, 1, 31, 'Day');
            convertToSelect($monthInput, 1, 12, 'Month');
            convertToSelect($yearInput, new Date().getFullYear(), 1900, 'Year');

            // Group into Row
            var $dayRow = $dayInput.closest('.form-row');
            var $monthRow = $monthInput.closest('.form-row');
            var $yearRow = $yearInput.closest('.form-row');

            if ($dayRow.length && $monthRow.length && $yearRow.length) {
                if (!$dayRow.parent('.avw-date-row').length) {
                    var $row = $('<div class="avw-date-row"></div>');
                    $dayRow.before($row);
                    $row.append($dayRow).append($monthRow).append($yearRow);
                }
                // Ensure they stay visible regardless of plugin toggle logic
                $dayRow.show(); $monthRow.show(); $yearRow.show();
            }
        }
    }

    // ── 2. INITIALIZE SELECT2 ON ALL (INCLUDING TRANSFORMED) ────────────────────
    function initPerfectSelect2() {
        if (typeof $.fn.select2 === 'undefined') return;

        // Target all selects, including our new ones
        $('form.woocommerce-checkout select, .avw-transformed-date-select').each(function() {
            var $sel = $(this);
            
            // If already initialized, skip
            if ($sel.data('select2')) return;
            
            $sel.select2({
                width: '100%',
                minimumResultsForSearch: 0 // FORCE SEARCH BOX
            });
        });
    }

    // Run on initial load
    transformAndGroupDates();
    initPerfectSelect2();

    // Re-run when WC triggers updates (like changing shipping)
    $(document.body).on('updated_checkout', function() {
        transformAndGroupDates();
        initPerfectSelect2();
    });

    // ── 3. Clear prefilled email ───────────────────────────────────────────────
    $('#billing_email').val('');

});
</script>
