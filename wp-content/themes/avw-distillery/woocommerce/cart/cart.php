<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="max-w-7xl mx-auto px-4 py-12 md:py-20 font-dm-sans">
    <h1 class="font-kurversbrug text-4xl md:text-5xl text-[#133E23] uppercase mb-12 tracking-widest text-center">Winkelmand</h1>

    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Main Cart Content -->
        <div class="flex-grow">
            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>

                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20">
                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents w-full text-left border-collapse" cellspacing="0">
                        <thead class="hidden md:table-header-group">
                            <tr class="bg-[#133E23]/5 border-b border-[#133E23]/10">
                                <th class="product-remove py-6 px-8">&nbsp;</th>
                                <th class="product-thumbnail py-6">&nbsp;</th>
                                <th class="product-name py-6 text-[14px] uppercase tracking-widest font-bold text-[#133E23]">Product</th>
                                <th class="product-price py-6 text-[14px] uppercase tracking-widest font-bold text-[#133E23]">Prijs</th>
                                <th class="product-quantity py-6 text-[14px] uppercase tracking-widest font-bold text-[#133E23]">Aantal</th>
                                <th class="product-subtotal py-6 px-8 text-[14px] uppercase tracking-widest font-bold text-[#133E23]">Totaal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                            <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    ?>
                                    <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> border-b border-gray-100 hover:bg-gray-50/50 transition-colors">

                                        <td class="product-remove py-6 px-8">
                                            <?php
                                                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a href="%s" class="remove text-red-400 hover:text-red-600 transition-colors text-2xl" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                        /* translators: %s is the product name */
                                                        esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), $product_name ) ),
                                                        esc_attr( $product_id ),
                                                        esc_attr( $_product->get_sku() )
                                                    ),
                                                    $cart_item_key
                                                );
                                            ?>
                                        </td>

                                        <td class="product-thumbnail py-6">
                                            <?php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                            if ( ! $product_permalink ) {
                                                echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            } else {
                                                printf( '<a href="%s" class="block w-20 h-20 overflow-hidden rounded-xl border border-gray-100">%s</a>', esc_url( $product_permalink ), $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            }
                                            ?>
                                        </td>

                                        <td class="product-name py-6" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                            <?php
                                            if ( ! $product_permalink ) {
                                                echo wp_kses_post( $product_name . '&nbsp;' );
                                            } else {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="text-[#133E23] font-bold hover:text-[#cdbca6] transition-colors">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                            }

                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                            // Meta data.
                                            echo wc_get_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                                            // Backorder notification.
                                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                            }
                                            ?>
                                        </td>

                                        <td class="product-price py-6 font-medium text-[#133E23]" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                            <?php
                                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            ?>
                                        </td>

                                        <td class="product-quantity py-6" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                            <?php
                                            if ( $_product->is_sold_individually() ) {
                                                $min_quantity = 1;
                                                $max_quantity = 1;
                                            } else {
                                                $min_quantity = 0;
                                                $max_quantity = $_product->get_max_purchase_quantity();
                                            }

                                            $product_quantity = woocommerce_quantity_input(
                                                array(
                                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                                    'input_value'  => $cart_item['quantity'],
                                                    'max_value'    => $max_quantity,
                                                    'min_value'    => $min_quantity,
                                                    'product_name' => $product_name,
                                                ),
                                                $_product,
                                                false
                                            );

                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            ?>
                                        </td>

                                        <td class="product-subtotal py-6 px-8 font-bold text-[#133E23]" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                            <?php
                                                echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            <?php do_action( 'woocommerce_cart_contents' ); ?>

                            <tr class="bg-gray-50/30">
                                <td colspan="6" class="actions py-8 px-8">
                                    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                                        <?php if ( wc_coupons_enabled() ) { ?>
                                            <div class="coupon flex w-full md:w-auto overflow-hidden rounded-full border border-gray-200">
                                                <input type="text" name="coupon_code" class="input-text px-6 py-3 flex-grow focus:outline-none" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Kortingscode', 'woocommerce' ); ?>" /> 
                                                <button type="submit" class="button px-8 py-3 bg-[#133E23] text-white uppercase tracking-widest font-bold text-xs hover:bg-black transition-colors" name="apply_coupon" value="<?php esc_attr_e( 'Activeren', 'woocommerce' ); ?>"><?php esc_attr_e( 'Activeren', 'woocommerce' ); ?></button>
                                                <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                            </div>
                                        <?php } ?>

                                        <button type="submit" class="button px-10 py-4 border-2 border-[#133E23] text-[#133E23] uppercase tracking-[0.2em] font-bold text-xs hover:bg-[#133E23] hover:text-white transition-all rounded-full" name="update_cart" value="<?php esc_attr_e( 'Bijwerken', 'woocommerce' ); ?>"><?php esc_html_e( 'Bijwerken', 'woocommerce' ); ?></button>

                                        <?php do_action( 'woocommerce_cart_actions' ); ?>

                                        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                    </div>
                                </td>
                            </tr>

                            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                        </tbody>
                    </table>
                </div>
                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </form>
        </div>

        <!-- Cart Sidebar -->
        <div class="lg:w-[400px] shrink-0">
            <div class="bg-[#133E23] text-white rounded-3xl p-8 md:p-10 shadow-2xl sticky top-24 border border-white/10">
                <h2 class="font-kurversbrug text-2xl uppercase tracking-widest mb-8 text-[#cdbca6]">Totaaloverzicht</h2>
                
                <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

                <div class="cart-collaterals">
                    <?php
                        /**
                         * Cart collaterals hook.
                         *
                         * @hooked woocommerce_cross_sell_display
                         * @hooked woocommerce_cart_totals - 10
                         */
                        do_action( 'woocommerce_cart_collaterals' );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
