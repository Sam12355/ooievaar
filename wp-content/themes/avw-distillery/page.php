<?php
/**
 * Template Name: Default Page
 *
 * Standard WordPress page template for the AVW Distillery theme.
 * Renders any page with the branded header, content area, and footer.
 * Required for pages like: kluis, account, checkout, etc.
 *
 * @package avw-distillery
 */

get_header();
?>

<style>
/* ======================================================
   PAGE CONTENT — Boutique wrapper for standard WP pages
   ====================================================== */
.avw-page-wrap {
    min-height: 60vh;
    max-width: 900px;
    margin: 0 auto;
    padding: 64px 24px 100px;
    font-family: 'DM Sans', sans-serif;
}

.avw-page-wrap.avw-woo-page {
    max-width: 1400px;
    padding-left: 32px;
    padding-right: 32px;
    padding-top: 48px;
}

.avw-page-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(2rem, 5vw, 3.5rem);
    color: #133E23;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    text-align: center;
    margin: 0 0 48px;
    font-weight: normal;
}

.avw-page-content {
    color: #133E23;
    font-size: 16px;
    line-height: 1.8;
}

/* WooCommerce My Account styling */
.avw-page-content .woocommerce-MyAccount-navigation {
    width: 220px;
    float: left;
    margin-right: 40px;
    background: #fff;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.06);
}

.avw-page-content .woocommerce-MyAccount-navigation ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.avw-page-content .woocommerce-MyAccount-navigation ul li {
    border-bottom: 1px solid rgba(19,62,35,0.06);
    padding: 0;
}

.avw-page-content .woocommerce-MyAccount-navigation ul li:last-child {
    border-bottom: none;
}

.avw-page-content .woocommerce-MyAccount-navigation ul li a {
    display: block;
    padding: 12px 8px;
    color: #133E23;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    transition: all 0.2s;
}

.avw-page-content .woocommerce-MyAccount-navigation ul li a:hover,
.avw-page-content .woocommerce-MyAccount-navigation ul li.is-active a {
    color: #9c8a74;
}

.avw-page-content .woocommerce-MyAccount-content {
    overflow: hidden;
    background: #fff;
    border-radius: 20px;
    padding: 32px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.06);
}

/* Login / Register form styling */
.avw-page-content .woocommerce-form input[type="text"],
.avw-page-content .woocommerce-form input[type="email"],
.avw-page-content .woocommerce-form input[type="password"] {
    width: 100%;
    padding: 12px 18px;
    border: 1.5px solid rgba(19,62,35,0.2);
    border-radius: 9999px;
    font-size: 15px;
    color: #133E23;
    outline: none;
    transition: border-color 0.2s;
    font-family: 'DM Sans', sans-serif;
    display: block;
    box-sizing: border-box;
}

.avw-page-content .woocommerce-form input:focus {
    border-color: #133E23;
}

.avw-page-content .woocommerce-form label {
    display: block;
    margin-bottom: 6px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #133E23;
}

.avw-page-content .woocommerce-form .button,
.avw-page-content .woocommerce-Button {
    display: inline-block;
    background: #133E23;
    color: white !important;
    padding: 14px 32px;
    border-radius: 9999px;
    font-family: 'Kurversbrug', serif;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    border: none;
    cursor: pointer;
    transition: all 0.25s;
    text-decoration: none;
}

.avw-page-content .woocommerce-form .button:hover {
    background: #0a2415;
    transform: translateY(-1px);
}

.avw-page-content .woocommerce-privacy-policy-text {
    font-size: 12px;
    color: rgba(19,62,35,0.5);
    margin-top: 12px;
}

.avw-page-content .lost_password a {
    color: #9c8a74;
    font-size: 13px;
}

.avw-page-content h2 {
    font-family: 'Kurversbrug', serif;
    font-size: 22px;
    color: #133E23;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    font-weight: normal;
    margin-bottom: 24px;
}

/* WooCommerce notices */
.avw-page-content .woocommerce-error,
.avw-page-content .woocommerce-info,
.avw-page-content .woocommerce-message {
    border-radius: 12px;
    padding: 14px 20px;
    margin-bottom: 24px;
    list-style: none;
    font-size: 14px;
}

/* Clearfix */
.avw-page-content::after {
    content: '';
    display: table;
    clear: both;
}

/* Responsive */
@media (max-width: 700px) {
    .avw-page-content .woocommerce-MyAccount-navigation {
        width: 100%;
        float: none;
        margin-right: 0;
        margin-bottom: 24px;
    }
}
</style>

<div class="avw-page-wrap <?php echo (is_cart() || is_checkout() || is_account_page()) ? 'avw-woo-page' : ''; ?>">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <?php if ( ! is_cart() && ! is_checkout() && ! is_account_page() ) : ?>
            <h1 class="avw-page-title"><?php the_title(); ?></h1>
        <?php endif; ?>

        <div class="avw-page-content">
            <?php the_content(); ?>
        </div>

    <?php endwhile; ?>
</div>

<?php
get_footer();
?>
