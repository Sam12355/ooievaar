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

/* ---- Branded hero (non-WooCommerce pages) ---- */
.avw-cp-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-cp-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 40%; opacity: 0.35;
}
.avw-cp-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.2) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-cp-hero-content {
    position: relative; z-index: 10;
    max-width: 900px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-cp-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-cp-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-cp-breadcrumb a:hover { color: #fff; }
.avw-cp-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(36px, 6vw, 72px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.05; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* ---- Content body (non-WooCommerce pages) ---- */
.avw-cp-body {
    width: 80%; max-width: 1200px; margin: 0 auto; padding: 72px 0 100px;
}
.avw-cp-card {
    background: #fff; border-radius: 24px;
    box-shadow: 0 4px 40px rgba(54,34,29,0.08); border: 1px solid rgba(54,34,29,0.06);
    padding: 48px 56px;
}
.avw-cp-card h1, .avw-cp-card h2, .avw-cp-card h3, .avw-cp-card h4 {
    font-family: 'Kurversbrug', serif; font-weight: normal; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.08em; margin: 28px 0 12px;
}
.avw-cp-card h1 { font-size: clamp(22px, 3vw, 30px); margin-top: 0; }
.avw-cp-card h2 { font-size: clamp(18px, 2.5vw, 24px); }
.avw-cp-card h3 { font-size: 18px; }
.avw-cp-card h4 { font-size: 15px; }
.avw-cp-card p {
    font-family: 'DM Sans', sans-serif; font-size: 15px; line-height: 1.85;
    color: rgba(54,34,29,0.8); margin-bottom: 16px;
}
.avw-cp-card ul, .avw-cp-card ol {
    font-family: 'DM Sans', sans-serif; font-size: 15px; line-height: 1.8;
    color: rgba(54,34,29,0.8); padding-left: 24px; margin-bottom: 20px;
}
.avw-cp-card li { margin-bottom: 6px; }
.avw-cp-card a { color: #432B25; font-weight: 600; }
.avw-cp-card a:hover { text-decoration: underline; }
.avw-cp-card strong { color: #36221d; }
.avw-cp-card hr {
    border: none; border-top: 1px solid rgba(54,34,29,0.1); margin: 32px 0;
}
.avw-cp-card blockquote {
    border-left: 4px solid #432B25; padding-left: 20px; margin: 24px 0;
    font-style: italic; color: rgba(54,34,29,0.65);
}
@media (max-width: 900px) { .avw-cp-body { width: 92%; } .avw-cp-card { padding: 32px 28px; } }
@media (max-width: 600px) { .avw-cp-body { width: 100%; padding-left: 16px; padding-right: 16px; } .avw-cp-card { padding: 24px 20px; } }

/* ---- WooCommerce pages (cart / checkout / account) ---- */
.avw-page-wrap {
    min-height: 60vh;
    max-width: 900px;
    margin: 0 auto;
    padding: 64px 24px 0;
    font-family: 'DM Sans', sans-serif;
}

.avw-page-wrap.avw-woo-page {
    max-width: 1400px;
    padding-left: 32px;
    padding-right: 32px;
    padding-top: 0;
    min-height: 0;
    margin-top: -40px;
}

/* Login page: zero out all wrapper spacing */
.avw-page-wrap.avw-login-wrap-page {
    padding: 0 !important;
    max-width: 100% !important;
    min-height: 0 !important;
}
.avw-login-wrap-page .avw-page-content {
    padding: 0 !important;
    margin: 0 !important;
}
.avw-login-wrap-page .woocommerce-breadcrumb,
.avw-login-wrap-page .woocommerce-notices-wrapper:empty {
    display: none !important;
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
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
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

<?php
$is_woo_page = is_cart() || is_checkout() || is_account_page();
while ( have_posts() ) : the_post();

if ( $is_woo_page ) :
    // ── WooCommerce pages: existing layout ──
    ?>
    <div class="avw-page-wrap avw-woo-page<?php echo ( is_account_page() && ! is_user_logged_in() ) ? ' avw-login-wrap-page' : ''; ?>">
        <div class="avw-page-content">
            <?php
            if ( is_page('business-registration') || is_page('zakelijke-registratie') || is_page('business-registration-en') ) {
                include get_template_directory() . '/template-registration.php';
            } else {
                the_content();
            }
            ?>
        </div>
    </div>
    <?php
else :
    // ── Regular content pages: hero + card layout ──
    $thumb = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    if ( ! $thumb ) $thumb = get_template_directory_uri() . '/assets/assortment-hero-v2.png';
    ?>
    <section class="avw-cp-hero">
        <img class="avw-cp-hero-img" src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" />
        <div class="avw-cp-hero-overlay"></div>
        <div class="avw-cp-hero-content">
            <nav class="avw-cp-breadcrumb">
                <a href="<?php echo home_url(); ?>">Home</a>
                <span style="margin:0 10px;">&bull;</span>
                <span style="color:#fff;"><?php the_title(); ?></span>
            </nav>
            <h1 class="avw-cp-hero-title"><?php the_title(); ?></h1>
        </div>
    </section>

    <div class="avw-cp-body">
        <div class="avw-cp-card">
            <?php the_content(); ?>
        </div>
    </div>
    <?php
endif;

endwhile;

get_footer();
?>
