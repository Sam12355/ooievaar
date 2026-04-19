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
/* ======================================================
   BOUTIQUE CART — Embedded styles (language-agnostic)
   ====================================================== */
.avw-cart-wrap {
    max-width: 1100px;
    margin: 0 auto;
    padding: 48px 24px 100px;
    font-family: 'DM Sans', sans-serif;
}
.avw-cart-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(2rem, 5vw, 3.5rem);
    color: #133E23;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    text-align: center;
    margin: 0 0 48px;
}
/* Table */
.avw-cart-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.07);
    overflow: hidden;
    margin-bottom: 12px;
}
.avw-cart-table thead th {
    background: rgba(19,62,35,0.04);
    border-bottom: 1px solid rgba(19,62,35,0.08);
    padding: 18px 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: #133E23;
    text-align: left;
    border-top: none !important;
}
.avw-cart-table tbody tr {
    border-bottom: 1px solid rgba(19,62,35,0.05);
    transition: background 0.15s;
}
.avw-cart-table tbody tr:last-child { border-bottom: none; }
.avw-cart-table tbody tr:hover { background: rgba(19,62,35,0.015); }
.avw-cart-table td {
    padding: 18px 20px;
    vertical-align: middle;
    border: none !important;
    font-size: 15px;
    color: #133E23;
}
/* Thumbnail */
.avw-cart-table td.product-thumbnail img {
    width: 76px !important;
    height: 76px !important;
    object-fit: cover;
    border-radius: 14px;
    border: 1px solid rgba(19,62,35,0.08);
    display: block;
}
/* Product name */
.avw-cart-table td.product-name a {
    font-weight: 700;
    color: #133E23 !important;
    text-decoration: none !important;
}
.avw-cart-table td.product-name a:hover { color: #9c8a74 !important; }
/* Price & subtotal */
.avw-cart-table td.product-price,
.avw-cart-table td.product-subtotal {
    font-weight: 700;
    color: #133E23 !important;
}
.avw-cart-table td.product-price *,
.avw-cart-table td.product-subtotal * {
    color: #133E23 !important;
}
/* Remove button */
.avw-cart-table td.product-remove { width: 48px; }
.avw-cart-table td.product-remove a.remove {
    display: flex !important;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(239,68,68,0.08);
    color: #ef4444 !important;
    font-size: 20px;
    text-decoration: none !important;
    transition: all 0.2s;
    border: none;
    line-height: 1;
}
.avw-cart-table td.product-remove a.remove:hover {
    background: #ef4444;
    color: #fff !important;
}
/* Quantity */
.avw-cart-table .quantity input.qty {
    width: 60px !important;
    height: 40px;
    border-radius: 9999px;
    border: 1.5px solid rgba(19,62,35,0.2) !important;
    text-align: center;
    font-weight: 700;
    font-size: 15px;
    color: #133E23;
    background: transparent !important;
    outline: none;
    padding: 0;
}
/* Actions */
.avw-cart-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    background: rgba(19,62,35,0.015);
    padding: 20px;
    border-radius: 0 0 20px 20px;
}
/* Coupon */
.avw-coupon {
    display: flex;
    border-radius: 9999px;
    border: 1.5px solid rgba(19,62,35,0.15);
    overflow: hidden;
    background: white;
}
.avw-coupon input[type="text"] {
    padding: 10px 18px;
    border: none;
    outline: none;
    font-size: 14px;
    min-width: 160px;
    background: transparent;
    font-family: 'DM Sans', sans-serif;
}
.avw-coupon-btn,
.avw-update-btn {
    padding: 11px 22px;
    border: none;
    font-family: 'DM Sans', sans-serif;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s;
}
.avw-coupon-btn {
    background: #133E23;
    color: white;
}
.avw-coupon-btn:hover { background: #0a2415; }
.avw-update-btn {
    padding: 12px 26px;
    border: 2px solid #133E23;
    border-radius: 9999px;
    background: transparent;
    color: #133E23;
}
.avw-update-btn:hover {
    background: #133E23;
    color: white;
}
/* Continue link */
.avw-continue {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #133E23;
    text-decoration: none;
    border-bottom: 1px solid #133E23;
    padding-bottom: 2px;
    transition: opacity 0.2s;
}
.avw-continue:hover { opacity: 0.6; }
/* Totals panel */
.avw-totals-panel {
    background: #133E23;
    border-radius: 24px;
    padding: 36px;
    margin-top: 32px;
    margin-left: auto;
    max-width: 460px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12);
}
.avw-totals-panel .cart_totals h2 {
    font-family: 'Kurversbrug', serif !important;
    font-size: 20px !important;
    color: #cdbca6 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.2em !important;
    margin-bottom: 28px !important;
    padding-bottom: 18px !important;
    border-bottom: 1px solid rgba(255,255,255,0.1) !important;
    display: block !important;
}
.avw-totals-panel table { width: 100%; background: transparent !important; }
.avw-totals-panel table th,
.avw-totals-panel table td {
    padding: 12px 0 !important;
    border: none !important;
    border-top: 1px solid rgba(255,255,255,0.07) !important;
    font-family: 'DM Sans', sans-serif !important;
    color: rgba(255,255,255,0.8) !important;
    font-size: 14px !important;
    background: transparent !important;
}
.avw-totals-panel table th {
    font-size: 11px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    font-weight: 600 !important;
    width: 40% !important;
}
.avw-totals-panel table .order-total th,
.avw-totals-panel table .order-total td {
    padding-top: 22px !important;
    border-top: 1px solid rgba(255,255,255,0.15) !important;
}
.avw-totals-panel table .order-total th {
    font-family: 'Kurversbrug', serif !important;
    font-size: 16px !important;
    color: white !important;
}
.avw-totals-panel table .order-total td {
    font-size: 28px !important;
    font-weight: 800 !important;
    color: #cdbca6 !important;
    text-align: right !important;
}
.avw-totals-panel .woocommerce-Price-amount,
.avw-totals-panel .woocommerce-Price-amount bdi,
.avw-totals-panel .order-total .woocommerce-Price-amount {
    color: #cdbca6 !important;
}
/* Checkout button */
.avw-totals-panel .wc-proceed-to-checkout { margin-top: 28px !important; }
.avw-totals-panel .wc-proceed-to-checkout a.button,
.avw-totals-panel a.checkout-button {
    display: block !important;
    width: 100% !important;
    background: #cdbca6 !important;
    color: #133E23 !important;
    padding: 18px !important;
    border-radius: 9999px !important;
    font-family: 'Kurversbrug', serif !important;
    font-size: 16px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.2em !important;
    text-align: center !important;
    text-decoration: none !important;
    transition: all 0.3s !important;
    box-shadow: 0 8px 24px rgba(0,0,0,0.18) !important;
    border: none !important;
}
.avw-totals-panel .wc-proceed-to-checkout a.button:hover,
.avw-totals-panel a.checkout-button:hover {
    background: #fff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 16px 36px rgba(0,0,0,0.2) !important;
}
/* Shipping calc link */
.avw-totals-panel .shipping-calculator-button {
    color: rgba(205,188,166,0.8) !important;
    font-size: 11px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    font-weight: 700 !important;
    text-decoration: none !important;
}
/* Mobile */
@media (max-width: 700px) {
    .avw-cart-table thead { display: none; }
    .avw-cart-table, .avw-cart-table tbody,
    .avw-cart-table tr, .avw-cart-table td { display: block; width: 100%; }
    .avw-cart-table tr.cart_item {
        background: white;
        border-radius: 16px;
        margin-bottom: 12px;
        padding: 12px;
        box-shadow: 0 3px 16px rgba(0,0,0,0.06);
        border: none;
    }
    .avw-cart-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 9px 8px;
        border-bottom: 1px solid rgba(0,0,0,0.04) !important;
    }
    .avw-cart-table td::before {
        content: attr(data-title);
        font-weight: 700; font-size: 11px;
        text-transform: uppercase; color: #133E23; opacity: 0.5;
    }
    .avw-cart-table td.product-remove { justify-content: flex-end; }
    .avw-cart-table td.product-thumbnail::before { display: none; }
    .avw-totals-panel { max-width: 100%; padding: 24px; }
    .avw-cart-actions { flex-direction: column; }
}
</style>

<div class="avw-cart-wrap">
    <h1 class="avw-cart-title">Winkelmand</h1>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>

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

                <!-- DEBUG: Cart has <?php echo (isset(WC()->cart) && WC()->cart) ? count( WC()->cart->get_cart() ) : '0 (not initialized)'; ?> items -->
                <?php if (isset(WC()->cart) && WC()->cart) : ?>
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
                <?php endif; ?>

                <?php do_action( 'woocommerce_cart_contents' ); ?>

                <tr>
                    <td colspan="6" class="actions" style="padding: 0 !important; border: none !important;">
                        <div class="avw-cart-actions">
                            <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="avw-continue">
                                &#8592; <?php esc_html_e( 'Continue shopping', 'woocommerce' ); ?>
                            </a>

                            <div style="display:flex; gap:12px; align-items:center; flex-wrap:wrap;">
                                <?php if ( wc_coupons_enabled() ) : ?>
                                <div class="coupon avw-coupon">
                                    <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
                                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
                                    <button type="submit" class="button avw-coupon-btn" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply', 'woocommerce' ); ?></button>
                                </div>
                                <?php endif; ?>

                                <button type="submit" class="button avw-update-btn" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                            </div>

                            <?php do_action( 'woocommerce_cart_actions' ); ?>
                            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                        </div>
                    </td>
                </tr>

                <?php do_action( 'woocommerce_after_cart_contents' ); ?>
            </tbody>
        </table>

        <?php do_action( 'woocommerce_after_cart_table' ); ?>
    </form>

    <!-- Totals Panel -->
    <div class="cart-collaterals avw-totals-panel">
        <?php do_action( 'woocommerce_cart_collaterals' ); ?>
    </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
