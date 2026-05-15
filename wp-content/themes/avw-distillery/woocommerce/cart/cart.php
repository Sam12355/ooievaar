<?php
/**
 * Custom Boutique Cart Template — De Ooievaar Distillery
 * Works for ALL WPML language versions (Dutch, English, etc.)
 *
 * @package WooCommerce\Templates
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );
?>

<style>
/* ============================================================
   BOUTIQUE CART — Full Page Design System
   ============================================================ */

/* Page wrapper */
.avw-cart-page {
    font-family: 'DM Sans', sans-serif;
    padding: 60px 0 60px;
}

/* Two-column layout — one unified card */
.avw-cart-layout {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 0;
    align-items: start;
    background: #fff;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 40px rgba(0,0,0,0.07);
}

@media (max-width: 1024px) {
    .avw-cart-layout { grid-template-columns: 1fr; }
}

/* ---- Product Table — no standalone radius/shadow; card is on parent ---- */
.avw-cart-table {
    width: 100%;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    background: #fff;
    border-radius: 0;
    overflow: hidden;
    box-shadow: none;
}

.avw-cart-table thead th {
    background: rgba(19,62,35,0.03);
    border-bottom: 1px solid rgba(19,62,35,0.08);
    padding: 18px 24px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: rgba(19,62,35,0.5);
    text-align: left;
    white-space: nowrap;
}

.avw-cart-table td {
    padding: 20px 24px;
    border-bottom: 1px solid rgba(19,62,35,0.05);
    vertical-align: middle;
    background: #fff;
}

.avw-cart-table tbody tr:last-child td { border-bottom: none; }
.avw-cart-table tbody tr:hover td { background: rgba(19,62,35,0.01); }

/* Thumbnail */
.avw-cart-table td.product-thumbnail { width: 100px; }
.avw-cart-table td.product-thumbnail img {
    width: 80px !important;
    height: 80px !important;
    object-fit: cover !important;
    border-radius: 14px !important;
    border: 1px solid rgba(19,62,35,0.07) !important;
    display: block;
}

/* Remove button */
.avw-cart-table td.product-remove { width: 50px; }
.avw-cart-table td.product-remove a.remove {
    display: flex !important;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: rgba(239,68,68,0.07);
    color: rgba(239,68,68,0.7) !important;
    font-size: 18px;
    text-decoration: none !important;
    transition: all 0.2s;
    line-height: 1;
}
.avw-cart-table td.product-remove a.remove:hover {
    background: #ef4444;
    color: #fff !important;
}

/* Product name */
.avw-cart-table td.product-name a {
    font-weight: 600;
    color: #133E23 !important;
    text-decoration: none !important;
    font-size: 15px;
    transition: color 0.2s;
}
.avw-cart-table td.product-name a:hover { color: #9c8a74 !important; }

/* Price & subtotal */
.avw-cart-table td.product-price,
.avw-cart-table td.product-subtotal {
    font-weight: 700;
    color: #133E23;
    white-space: nowrap;
}
.avw-cart-table td.product-subtotal { color: #133E23; font-weight: 800; }

/* Quantity input */
.avw-cart-table .quantity input.qty {
    width: 60px !important;
    height: 38px;
    border-radius: 0;
    border: 1.5px solid rgba(19,62,35,0.18) !important;
    text-align: center;
    font-weight: 700;
    font-size: 14px;
    color: #133E23;
    background: transparent !important;
    outline: none;
    transition: border-color 0.2s;
}
.avw-cart-table .quantity input.qty:focus {
    border-color: #133E23 !important;
}

/* ---- Cart Actions Bar ---- */
.avw-cart-actions-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    padding: 18px 24px;
    background: rgba(19,62,35,0.025);
    border-top: 1px solid rgba(19,62,35,0.07);
    border-radius: 0 0 24px 24px;
}

.avw-continue-link {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: rgba(19,62,35,0.5);
    text-decoration: none;
    transition: color 0.2s;
}
.avw-continue-link:hover { color: #133E23; }

.avw-actions-right {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

/* Coupon pill */
.avw-coupon-wrap {
    display: flex;
    align-items: center;
    border: 1.5px solid rgba(19,62,35,0.15);
    border-radius: 9999px;
    overflow: hidden;
    background: #fff;
}
.avw-coupon-wrap input {
    padding: 9px 16px;
    border: none;
    outline: none;
    font-size: 13px;
    width: 140px;
    color: #133E23;
    font-family: 'DM Sans', sans-serif;
}
.avw-coupon-wrap button {
    background: #133E23;
    color: #fff;
    border: none;
    padding: 9px 18px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: background 0.2s;
    font-family: 'DM Sans', sans-serif;
}
.avw-coupon-wrap button:hover { background: #0a2415; }

/* Update cart button — Hidden as updates are automatic */
.avw-update-cart-btn { display: none !important; }

/* ---- Totals Panel — white, attached to the left column ---- */
.avw-totals-sidebar {
    background: rgba(19,62,35,0.03);
    border-left: 1px solid rgba(19,62,35,0.08);
    padding: 36px 32px;
    color: #133E23;
    position: sticky;
    top: 100px;
    box-shadow: none;
    border-radius: 0;
}

.avw-totals-sidebar-title {
    font-family: 'Kurversbrug', serif;
    font-size: 16px;
    color: #133E23;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    font-weight: normal;
    margin: 0 0 24px;
    padding-bottom: 18px;
    border-bottom: 1px solid rgba(19,62,35,0.1);
}

.avw-totals-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 13px 0;
    border-bottom: 1px solid rgba(19,62,35,0.06);
}
.avw-totals-row:last-of-type { border-bottom: none; }

.avw-totals-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: rgba(19,62,35,0.45);
}

.avw-totals-value {
    font-size: 15px;
    font-weight: 700;
    color: #133E23;
    text-align: right;
}

.avw-totals-total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0 0;
    margin-top: 8px;
    border-top: 1px solid rgba(19,62,35,0.12);
}

.avw-totals-total-label {
    font-family: 'Kurversbrug', serif;
    font-size: 17px;
    color: #133E23;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    font-weight: normal;
}

.avw-totals-total-amount {
    font-size: 26px;
    font-weight: 800;
    color: #133E23;
    text-align: right;
    line-height: 1;
}

/* Hide the inline WC tax notice — we render it separately below */
.avw-totals-total-amount small.includes_tax { display: none !important; }
.avw-totals-total-amount .woocommerce-Price-amount { color: #133E23 !important; }

.avw-totals-tax-note {
    font-size: 10px;
    font-weight: 500;
    color: rgba(19,62,35,0.4);
    margin-top: 8px;
    text-align: right;
    line-height: 1.6;
    letter-spacing: 0.03em;
}

/* Checkout button */
.avw-checkout-btn {
    display: block;
    margin-top: 24px;
    padding: 14px 40px;
    background: linear-gradient(90deg, rgba(0,0,0,0.2), rgba(0,0,0,0.2)), #432B25;
    color: #fff !important;
    text-align: center;
    border-radius: 34px;
    font-family: 'Kurversbrug', serif;
    font-size: 18px;
    font-weight: normal;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    text-decoration: none !important;
    transition: opacity 0.2s ease;
    border: none;
}
.avw-checkout-btn:hover {
    opacity: 0.88;
    color: #fff !important;
}

/* Security trust badge */
.avw-trust-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-top: 14px;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(19,62,35,0.3);
}

/* ---- Mobile responsive ---- */
@media (max-width: 768px) {
    .avw-cart-table thead { display: none; }
    .avw-cart-table, .avw-cart-table tbody,
    .avw-cart-table tr, .avw-cart-table td {
        display: block;
        width: 100%;
    }
    .avw-cart-table tr {
        margin-bottom: 16px;
        border: 1px solid rgba(19,62,35,0.08);
        border-radius: 18px;
        overflow: hidden;
        background: #fff;
    }
    .avw-cart-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px !important;
        border-bottom: 1px solid rgba(19,62,35,0.05) !important;
    }
    .avw-cart-table td::before {
        content: attr(data-title);
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: rgba(19,62,35,0.4);
    }
    .avw-cart-table td.product-remove,
    .avw-cart-table td.product-thumbnail { justify-content: flex-end; }
    .avw-cart-table td.product-remove::before,
    .avw-cart-table td.product-thumbnail::before { display: none; }

    .avw-cart-actions-bar { border-radius: 18px; }
    .avw-totals-sidebar { position: static; }
}
</style>

<div class="avw-cart-page">

    <?php do_action( 'woocommerce_before_cart_table' ); ?>

    <!-- Two-column layout -->
    <div class="avw-cart-layout">

        <!-- LEFT: Product Table + Actions -->
        <div>
            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

                <table class="avw-cart-table shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="product-remove">&nbsp;</th>
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                            <th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                            <th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                            <th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                        <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) :
                                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        ?>
                        <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                            <td class="product-remove" data-title="<?php esc_attr_e( 'Remove', 'woocommerce' ); ?>">
                                <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                    '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                    esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), $_product->get_name() ) ),
                                    esc_attr( $product_id ),
                                    esc_attr( $_product->get_sku() )
                                ), $cart_item_key ); ?>
                            </td>

                            <td class="product-thumbnail" data-title="<?php esc_attr_e( 'Image', 'woocommerce' ); ?>">
                                <?php $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                if ( ! $product_permalink ) {
                                    echo $thumbnail;
                                } else {
                                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                } ?>
                            </td>

                            <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                <?php if ( ! $product_permalink ) {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                } else {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                }
                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                                echo wc_get_formatted_cart_item_data( $cart_item );
                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                } ?>
                            </td>

                            <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                            </td>

                            <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                <?php if ( $_product->is_sold_individually() ) {
                                    $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                } else {
                                    $product_quantity = woocommerce_quantity_input( array(
                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                        'input_value'  => $cart_item['quantity'],
                                        'max_value'    => $_product->get_max_purchase_quantity(),
                                        'min_value'    => '0',
                                        'product_name' => $_product->get_name(),
                                    ), $_product, false );
                                }
                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); ?>
                            </td>

                            <td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                            </td>
                        </tr>
                        <?php endif; endforeach; ?>

                        <?php do_action( 'woocommerce_cart_contents' ); ?>
                        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                    </tbody>
                </table>

                <!-- Actions bar below table -->
                <div class="avw-cart-actions-bar">
                    <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="avw-continue-link">
                        &#8592; <?php esc_html_e( 'Continue shopping', 'woocommerce' ); ?>
                    </a>

                    <div class="avw-actions-right">
                        <?php if ( wc_coupons_enabled() ) : ?>
                            <div class="coupon avw-coupon-wrap">
                                <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
                                <input type="text" name="coupon_code" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
                                <button type="submit" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply', 'woocommerce' ); ?></button>
                            </div>
                        <?php endif; ?>

                        <button type="submit" class="avw-update-cart-btn" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
                            <?php esc_html_e( 'Update cart', 'woocommerce' ); ?>
                        </button>
                    </div>

                    <?php do_action( 'woocommerce_cart_actions' ); ?>
                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                </div>

            </form>
        </div>

        <!-- RIGHT: Order Summary Panel -->
        <div class="avw-totals-sidebar" id="avw-cart-totals-sidebar">
            <h2 class="avw-totals-sidebar-title"><?php esc_html_e( 'Order Summary', 'woocommerce' ); ?></h2>

            <!-- Subtotal -->
            <div class="avw-totals-row">
                <span class="avw-totals-label"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
                <span class="avw-totals-value"><?php wc_cart_totals_subtotal_html(); ?></span>
            </div>

            <!-- Coupons -->
            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <div class="avw-totals-row coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <span class="avw-totals-label"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
                    <span class="avw-totals-value"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
                </div>
            <?php endforeach; ?>

            <!-- Shipping -->
            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                <div class="avw-totals-row" style="flex-direction: column; align-items: flex-start; gap: 10px;">
                    <span class="avw-totals-label"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></span>
                    <div style="width:100%; font-size:12px; color: rgba(19,62,35,0.55);">
                        <?php woocommerce_shipping_calculator(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Fees -->
            <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                <div class="avw-totals-row">
                    <span class="avw-totals-label"><?php echo esc_html( $fee->name ); ?></span>
                    <span class="avw-totals-value"><?php wc_cart_totals_fee_html( $fee ); ?></span>
                </div>
            <?php endforeach; ?>

            <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

            <!-- Grand Total -->
            <div class="avw-totals-total-row">
                <span class="avw-totals-total-label"><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
                <div style="text-align: right;">
                    <?php
                    // Output ONLY the price amount — no inline tax clutter
                    $total_price = wc_price( WC()->cart->get_total( 'edit' ) );
                    ?>
                    <div class="avw-totals-total-amount"><?php echo $total_price; ?></div>
                    <?php if ( wc_tax_enabled() && WC()->cart->display_prices_including_tax() ) :
                        $tax_totals = WC()->cart->get_tax_totals();
                        if ( ! empty( $tax_totals ) ) : ?>
                        <div class="avw-totals-tax-note">
                            <?php if ( 'itemized' === get_option( 'woocommerce_tax_display_cart' ) ) :
                                foreach ( $tax_totals as $code => $tax ) :
                                    echo esc_html( $tax->label ) . ': ' . wp_kses_post( $tax->formatted_amount ) . '<br>';
                                endforeach;
                            else :
                                $tax_total_amount = wc_price( array_sum( wp_list_pluck( $tax_totals, 'amount' ) ) );
                                printf(
                                    /* translators: 1: tax label, 2: amount */
                                    esc_html__( 'incl. %1$s %2$s', 'woocommerce' ),
                                    WC()->countries->tax_or_vat(),
                                    $tax_total_amount
                                );
                            endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

            <!-- Checkout button -->
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="avw-checkout-btn wc-forward checkout-button">
                <?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?>
            </a>

            <!-- Trust badge -->
            <div class="avw-trust-badge">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <span><?php esc_html_e( 'Secure checkout', 'woocommerce' ); ?></span>
            </div>
        </div>

    </div><!-- .avw-cart-layout -->

    <?php do_action( 'woocommerce_after_cart_table' ); ?>

</div><!-- .avw-cart-page -->

<?php do_action( 'woocommerce_after_cart' ); ?>

<script>
jQuery(function($) {

    var updateTimer;

    // 1. Debounced Auto-Update on Quantity Change
    $(document.body).on('change input', '.woocommerce-cart-form input.qty', function() {
        var $form = $(this).closest('form');
        var $cartPage = $('.avw-cart-page');
        
        clearTimeout(updateTimer);
        
        updateTimer = setTimeout(function() {
            $cartPage.css('opacity', '0.5');

            $.ajax({
                type: 'POST',
                url: window.location.href,
                data: $form.serialize() + '&update_cart=1', 
                success: function(response) {
                    var $temp = $('<div>').append($.parseHTML(response));
                    
                    // Update Cart Page Content
                    var $newContent = $temp.find('.avw-cart-page');
                    if ($newContent.length) {
                        $cartPage.html($newContent.html());
                    }
                    
                    // Update Cart Badge in Header
                    var $newBadge = $temp.find('#cart-badge');
                    if ($newBadge.length) {
                        $('#cart-badge').replaceWith($newBadge);
                    }
                    
                    $cartPage.css('opacity', '1');
                    
                    $(document.body).trigger('wc_fragment_refresh');
                    $(document.body).trigger('updated_wc_div');
                },
                error: function() {
                    window.location.reload();
                }
            });
        }, 600); // 600ms debounce
    });

    // 2. Keep everything in sync after fragments update (item removal etc)
    $(document.body).on('wc_fragments_refreshed removed_from_cart updated_wc_div', function(e, fragments) {
        if (fragments) {
            $.each(fragments, function(key, value) {
                try { $(key).replaceWith(value); } catch(err) {}
            });
        }
    });

});
</script>
