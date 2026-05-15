<?php
defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) { ?>
    <div class="quantity hidden">
        <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
    </div>
<?php } else {
    $label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );
    ?>
    <div class="quantity avw-quantity-wrapper flex items-center gap-0">
        <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_html( $label ); ?></label>

        <button type="button" class="avw-qty-btn avw-qty-minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'woocommerce' ); ?>">−</button>

        <input
            type="number"
            id="<?php echo esc_attr( $input_id ); ?>"
            class="input-text qty text <?php echo esc_attr( $classes ); ?> avw-qty-input"
            step="<?php echo esc_attr( $step ); ?>"
            min="<?php echo esc_attr( $min_value ); ?>"
            max="<?php echo esc_attr( $max_value ? $max_value : '' ); ?>"
            name="<?php echo esc_attr( $input_name ); ?>"
            value="<?php echo esc_attr( $input_value ); ?>"
            title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ); ?>"
            size="4"
            inputmode="numeric" />

        <button type="button" class="avw-qty-btn avw-qty-plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'woocommerce' ); ?>">+</button>
    </div>

    <style>
        .avw-quantity-wrapper { display: inline-flex; }
        .avw-qty-input {
            -moz-appearance: textfield;
            text-align: center;
            width: 56px;
            height: 48px;
            border: 1px solid rgba(54,34,29,0.2);
            border-left: none;
            border-right: none;
            background: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            color: #36221d;
            outline: none;
        }
        .avw-qty-input::-webkit-inner-spin-button,
        .avw-qty-input::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        .avw-qty-btn {
            width: 48px;
            height: 48px;
            background: #fff;
            border: 1px solid rgba(54,34,29,0.2);
            color: #36221d;
            font-size: 22px;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, color 0.2s;
            user-select: none;
        }
        .avw-qty-minus { border-radius: 8px 0 0 8px; }
        .avw-qty-plus  { border-radius: 0 8px 8px 0; }
        .avw-qty-btn:hover { background: #36221d; color: #eedfcb; }
    </style>

    <script>
    (function() {
        document.addEventListener('click', function(e) {
            if ( e.target.classList.contains('avw-qty-minus') ) {
                var input = e.target.nextElementSibling;
                var val = parseInt(input.value, 10);
                var min = parseInt(input.min, 10) || 1;
                if ( val > min ) { input.value = val - 1; input.dispatchEvent(new Event('change', {bubbles:true})); }
            }
            if ( e.target.classList.contains('avw-qty-plus') ) {
                var input = e.target.previousElementSibling;
                var val = parseInt(input.value, 10);
                var max = parseInt(input.max, 10);
                if ( !max || val < max ) { input.value = val + 1; input.dispatchEvent(new Event('change', {bubbles:true})); }
            }
        });
    })();
    </script>
<?php } ?>
