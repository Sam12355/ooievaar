<?php
/**
 * Cart Page (Boutique Restoration)
 * 
 * We are keeping all standard WooCommerce hooks and features while wrapping them
 * in our premium distillery design system.
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="max-w-7xl mx-auto px-4 py-12 md:py-20 font-dm-sans">
    <h1 class="font-kurversbrug text-4xl md:text-5xl text-[#133E23] uppercase mb-12 tracking-widest text-center">Winkelmand</h1>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Left Side: Product Table -->
            <div class="flex-grow">
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20">
                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents w-full text-left" cellspacing="0">
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
                                    <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> border-b border-gray-100">

                                        <td class="product-remove py-6 px-8">
                                            <?php
                                                echo apply_filters( 
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a href="%s" class="remove text-red-400 hover:text-red-600 transition-colors text-2xl" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
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
                                                echo $thumbnail; 
                                            } else {
                                                printf( '<a href="%s" class="block w-20 h-20 overflow-hidden rounded-xl border border-gray-100">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                            }
                                            ?>
                                        </td>

                                        <td class="product-name py-6" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                            <?php
                                            if ( ! $product_permalink ) {
                                                echo wp_kses_post( $product_name . '&nbsp;' );
                                            } else {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="text-[#133E23] font-bold hover:text-[#cdbca6]">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                            }
                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                                            echo wc_get_item_data( $cart_item );
                                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                            }
                                            ?>
                                        </td>

                                        <td class="product-price py-6" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                            <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                                        </td>

                                        <td class="product-quantity py-6" data-title="<?php esc_attr_e( 'Aantal', 'woocommerce' ); ?>">
                                            <?php
                                            if ( $_product->is_sold_individually() ) {
                                                $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                            } else {
                                                $product_quantity = woocommerce_quantity_input(
                                                    array(
                                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                                        'input_value'  => $cart_item['quantity'],
                                                        'max_value'    => $_product->get_max_purchase_quantity(),
                                                        'min_value'    => '0',
                                                        'product_name' => $_product->get_name(),
                                                    ),
                                                    $_product,
                                                    false
                                                );
                                            }
                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                            ?>
                                        </td>

                                        <td class="product-subtotal py-6 px-8 font-bold" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            <?php do_action( 'woocommerce_cart_contents' ); ?>

                            <tr class="bg-gray-50/50">
                                <td colspan="6" class="actions pt-8 pb-10 px-8">
                                    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                                        <?php if ( wc_coupons_enabled() ) { ?>
                                            <div class="coupon flex items-center border border-gray-200 rounded-full overflow-hidden bg-white">
                                                <input type="text" name="coupon_code" class="input-text px-6 py-2 outline-none" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Kortingscode', 'woocommerce' ); ?>" />
                                                <button type="submit" class="button px-6 py-3 bg-[#133E23] text-white text-xs uppercase tracking-widest hover:bg-black font-bold" name="apply_coupon" value="<?php esc_attr_e( 'Activeren', 'woocommerce' ); ?>"><?php esc_attr_e( 'Activeren', 'woocommerce' ); ?></button>
                                            </div>
                                        <?php } ?>

                                        <div class="flex items-center gap-4">
                                            <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="text-[13px] uppercase tracking-widest font-bold border-b border-[#133E23] pb-1 mr-4 hover:opacity-70 transition-opacity">
                                                ← Verder Winkelen
                                            </a>
                                            <button type="submit" class="button px-10 py-4 border-2 border-[#133E23] text-[#133E23] rounded-full text-xs uppercase tracking-widest font-bold hover:bg-[#133E23] hover:text-white transition-all" name="update_cart" value="<?php esc_attr_e( 'Bijwerken', 'woocommerce' ); ?>"><?php esc_html_e( 'Bijwerken', 'woocommerce' ); ?></button>
                                        </div>

                                        <?php do_action( 'woocommerce_cart_actions' ); ?>
                                        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                    </div>
                                </td>
                            </tr>

                            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right Side: Totals -->
            <div class="lg:w-[400px]">
                <div class="bg-[#133E23] text-white rounded-3xl p-8 md:p-10 shadow-2xl sticky top-24 border border-white/10">
                    <h2 class="font-kurversbrug text-2xl uppercase tracking-widest mb-8 text-[#cdbca6]">Overzicht</h2>
                    <div class="cart-collaterals">
                        <?php
                            /**
                             * Cart collaterals hook.
                             * @hooked woocommerce_cross_sell_display
                             * @hooked woocommerce_cart_totals - 10
                             */
                            do_action( 'woocommerce_cart_collaterals' );
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php do_action( 'woocommerce_after_cart_table' ); ?>
    </form>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
