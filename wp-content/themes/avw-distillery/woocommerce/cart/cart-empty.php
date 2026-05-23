<?php
/**
 * Empty cart page — De Ooievaar Distillery
 *
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;
?>

<style>
.avw-empty-cart {
    text-align: center;
    padding: 80px 24px 100px;
    max-width: 520px;
    margin: 0 auto;
}
.avw-empty-cart-icon {
    width: 72px; height: 72px;
    background: #f5ede3; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 28px;
}
.avw-empty-cart-title {
    font-family: 'Kurversbrug', serif;
    font-size: 28px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.1em; font-weight: normal;
    margin: 0 0 14px;
}
.avw-empty-cart-text {
    font-family: 'DM Sans', sans-serif;
    font-size: 15px; line-height: 1.75; color: rgba(54,34,29,0.58);
    margin: 0 0 36px;
}
.avw-empty-cart-btn {
    display: inline-block;
    background: linear-gradient(90deg, rgba(0,0,0,0.2), rgba(0,0,0,0.2)), #432B25;
    color: #fff; font-family: 'Kurversbrug', serif; font-size: 16px;
    text-transform: uppercase; letter-spacing: 0.12em;
    padding: 14px 48px; border-radius: 34px;
    text-decoration: none; transition: opacity 0.2s;
}
.avw-empty-cart-btn:hover { opacity: 0.88; color: #fff; }
</style>

<div class="avw-empty-cart">
    <div class="avw-empty-cart-icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke="#36221d" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <line x1="3" y1="6" x2="21" y2="6" stroke="#36221d" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M16 10a4 4 0 01-8 0" stroke="#36221d" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>

    <h2 class="avw-empty-cart-title">Uw mandje is leeg</h2>
    <p class="avw-empty-cart-text">U heeft nog geen producten toegevoegd aan uw winkelmandje. Ontdek ons assortiment en voeg uw favorieten toe.</p>

    <?php if ( wc_get_page_id('shop') > 0 ) : ?>
        <a class="avw-empty-cart-btn" href="<?php echo esc_url( apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop')) ); ?>">
            <?php echo esc_html( apply_filters('woocommerce_return_to_shop_text', __('Bekijk ons assortiment', 'woocommerce')) ); ?>
        </a>
    <?php endif; ?>
</div>
