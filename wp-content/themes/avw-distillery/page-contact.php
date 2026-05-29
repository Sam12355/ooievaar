<?php
/**
 * Template Name: Contact
 *
 * @package avw-distillery
 */

get_header();

$avw_lang = function_exists('pll_current_language') ? pll_current_language() : get_locale();
$is_en    = ( strpos( $avw_lang, 'en' ) === 0 ) || ( strpos( $_SERVER['REQUEST_URI'], '/en/' ) !== false );
?>

<style>
/* ============================================================
   CONTACT PAGE
   ============================================================ */
.avw-con-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-con-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 40%; opacity: 0.45;
}
.avw-con-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-con-hero-content {
    position: relative; z-index: 10;
    max-width: 900px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-con-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-con-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-con-breadcrumb a:hover { color: #fff; }
.avw-con-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(42px, 7vw, 80px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.05; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* ---- Body ---- */
.avw-con-body {
    width: 80%; max-width: 1400px; margin: 0 auto; padding: 72px 0 100px;
}

.avw-con-layout {
    display: grid; grid-template-columns: 1fr 1.4fr; gap: 40px; align-items: start;
}

/* ---- Info card ---- */
.avw-con-info-card {
    background: #fff; border-radius: 24px;
    box-shadow: 0 4px 40px rgba(54,34,29,0.08); border: 1px solid rgba(54,34,29,0.06);
    padding: 44px 44px;
}
.avw-con-info-notice {
    font-family: 'DM Sans', sans-serif; font-size: 14px; line-height: 1.7;
    color: rgba(54,34,29,0.65); margin-bottom: 28px;
    padding: 14px 18px; background: #fdf8f1; border-radius: 12px;
    border-left: 3px solid rgba(67,43,37,0.25);
}
.avw-con-info-block { margin-bottom: 28px; }
.avw-con-info-block:last-child { margin-bottom: 0; }
.avw-con-info-label {
    font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.14em; color: rgba(54,34,29,0.45);
    margin-bottom: 8px;
}
.avw-con-info-value {
    font-family: 'DM Sans', sans-serif; font-size: 15px; color: #36221d; line-height: 1.75;
}
.avw-con-info-value a { color: #432B25; text-decoration: none; }
.avw-con-info-value a:hover { text-decoration: underline; }
.avw-con-divider {
    border: none; border-top: 1px solid rgba(54,34,29,0.08); margin: 24px 0;
}

/* ---- Form card ---- */
.avw-con-form-card {
    background: #fff; border-radius: 24px;
    box-shadow: 0 4px 40px rgba(54,34,29,0.08); border: 1px solid rgba(54,34,29,0.06);
    padding: 44px 48px;
}
.avw-con-form-title {
    font-family: 'Kurversbrug', serif; font-size: 22px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.1em; font-weight: normal;
    margin: 0 0 28px;
}

/* ---- Gravity Forms brand overrides ---- */
.avw-con-form-card .gform_wrapper { margin: 0; }
.avw-con-form-card .gform_body .gfield { margin-bottom: 18px; }
.avw-con-form-card .gfield_label,
.avw-con-form-card .gfield_label label {
    font-family: 'DM Sans', sans-serif !important; font-size: 11px !important; font-weight: 700 !important;
    text-transform: uppercase !important; letter-spacing: 0.12em !important;
    color: rgba(54,34,29,0.5) !important; margin-bottom: 6px !important;
}
.avw-con-form-card .gfield_required { color: #c62828 !important; }
.avw-con-form-card input[type="text"],
.avw-con-form-card input[type="email"],
.avw-con-form-card input[type="tel"],
.avw-con-form-card input[type="url"],
.avw-con-form-card input[type="number"],
.avw-con-form-card select,
.avw-con-form-card textarea {
    font-family: 'DM Sans', sans-serif !important; font-size: 14px !important; color: #36221d !important;
    border: 1.5px solid rgba(54,34,29,0.15) !important; border-radius: 12px !important;
    padding: 12px 16px !important; background: #fdf8f1 !important;
    width: 100% !important; box-sizing: border-box !important;
    outline: none !important; transition: border-color 0.2s !important;
    box-shadow: none !important;
}
.avw-con-form-card input[type="text"]:focus,
.avw-con-form-card input[type="email"]:focus,
.avw-con-form-card textarea:focus { border-color: #36221d !important; background: #fff !important; }
.avw-con-form-card textarea { resize: vertical !important; min-height: 140px !important; }
.avw-con-form-card .gform_footer,
.avw-con-form-card .gform_page_footer { padding: 8px 0 0; border: none; }
.avw-con-form-card .gform_footer input[type="submit"],
.avw-con-form-card .gform_page_footer input[type="submit"],
.avw-con-form-card .gform_footer button[type="submit"],
.avw-con-form-card .gform_next_button {
    background: linear-gradient(90deg, rgba(0,0,0,0.2), rgba(0,0,0,0.2)), #432B25 !important;
    color: #fff !important; font-family: 'Kurversbrug', serif !important; font-size: 17px !important;
    text-transform: uppercase !important; letter-spacing: 0.12em !important;
    padding: 14px 52px !important; border-radius: 34px !important; border: none !important;
    cursor: pointer !important; transition: opacity 0.2s !important; box-shadow: none !important;
}
.avw-con-form-card .gform_footer input[type="submit"]:hover,
.avw-con-form-card .gform_footer button[type="submit"]:hover { opacity: 0.88 !important; }
.avw-con-form-card .gform_confirmation_message {
    font-family: 'DM Sans', sans-serif; font-size: 15px; color: #36221d;
    background: #e8f5e9; border: 1px solid #a5d6a7; border-radius: 12px;
    padding: 18px 22px; line-height: 1.7;
}
.avw-con-form-card .validation_error,
.avw-con-form-card .gfield_description.validation_message {
    font-family: 'DM Sans', sans-serif !important; font-size: 13px !important;
    color: #c62828 !important; margin-top: 5px !important;
    background: none !important; border: none !important; padding: 0 !important;
}
/* Hide Gravity Forms honeypot / validation field */
.avw-con-form-card .gform_validation_container,
.avw-con-form-card .gform-validation-container,
.avw-con-form-card li.gfield--type-honeypot,
.avw-con-form-card .gfield_honeypot_wrapper { display: none !important; }

@media (max-width: 960px) {
    .avw-con-body { width: 92%; }
    .avw-con-layout { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .avw-con-body { width: 100%; padding-left: 16px; padding-right: 16px; }
    .avw-con-info-card, .avw-con-form-card { padding: 28px 24px; }
}
</style>

<!-- HERO -->
<section class="avw-con-hero">
    <img id="con-hero-img" class="avw-con-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="Contact" />
    <div class="avw-con-hero-overlay"></div>
    <div class="avw-con-hero-content">
        <nav class="avw-con-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;">Contact</span>
        </nav>
        <h1 id="con-hero-title" class="avw-con-hero-title">Contact</h1>
    </div>
</section>

<!-- CONTENT -->
<div class="avw-con-body">
    <div class="avw-con-layout">

        <!-- Info -->
        <div class="avw-con-info-card">
            <p class="avw-con-info-notice">
                <?php echo $is_en
                    ? 'The phone numbers below are exclusively for questions about our products.'
                    : 'De telefoonnummers hieronder zijn uitsluitend bedoeld voor vragen over onze producten.'; ?>
            </p>

            <div class="avw-con-info-block">
                <div class="avw-con-info-label"><?php echo $is_en ? 'Phone' : 'Telefoon'; ?></div>
                <div class="avw-con-info-value">
                    <a href="tel:+31206267753">020-6267753</a> <?php echo $is_en ? 'or' : 'of'; ?> <a href="tel:+31206264702">020-6264702</a>
                </div>
            </div>

            <hr class="avw-con-divider" />

            <div class="avw-con-info-block">
                <div class="avw-con-info-label"><?php echo $is_en ? 'Address' : 'Adres'; ?></div>
                <div class="avw-con-info-value">
                    Slijterij de Ooievaar<br>
                    Driehoekstraat 10<br>
                    1015 GL Amsterdam
                </div>
            </div>

            <hr class="avw-con-divider" />

            <div class="avw-con-info-block">
                <div class="avw-con-info-label"><?php echo $is_en ? 'Opening Hours' : 'Openingstijden'; ?></div>
                <div class="avw-con-info-value">
                    <?php if ( $is_en ): ?>
                    Monday to Friday: 1:00 PM – 5:00 PM<br>
                    Closed on weekends.
                    <?php else: ?>
                    Maandag t/m vrijdag: 13.00 – 17.00 uur<br>
                    Gesloten in het weekend.
                    <?php endif; ?>
                </div>
            </div>

            <hr class="avw-con-divider" />

            <div class="avw-con-info-block">
                <div class="avw-con-info-label"><?php echo $is_en ? 'Chamber of Commerce' : 'KvK-nummer'; ?></div>
                <div class="avw-con-info-value">33112761</div>
            </div>

            <div class="avw-con-info-block">
                <div class="avw-con-info-label"><?php echo $is_en ? 'VAT Number' : 'BTW-nummer'; ?></div>
                <div class="avw-con-info-value">NL0014 15 694 B.01.9110</div>
            </div>
        </div>

        <!-- Form (Gravity Forms) -->
        <div class="avw-con-form-card">
            <h2 class="avw-con-form-title"><?php echo $is_en ? 'Send us a message' : 'Stuur ons een bericht'; ?></h2>
            <?php
            // Set this to your Gravity Forms contact form ID (Forms → hover a form → note the ID).
            $avw_gf_id = get_option( 'avw_contact_form_id', 2 );
            if ( function_exists('gravity_form') ) {
                gravity_form( $avw_gf_id, false, false, false, null, true );
            } elseif ( class_exists('GFAPI') ) {
                echo do_shortcode( '[gravityforms id="' . intval($avw_gf_id) . '"]' );
            } else {
                echo '<p style="font-family:\'DM Sans\',sans-serif;color:rgba(54,34,29,0.6);font-size:14px;">'
                   . ( $is_en ? 'Contact form is not available.' : 'Contactformulier is niet beschikbaar.' )
                   . '</p>';
            }
            ?>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.fromTo('#con-hero-img',
            { yPercent: -15 },
            { yPercent: 15, ease: 'none',
              scrollTrigger: { trigger: '#con-hero-title', start: 'top bottom', end: 'bottom top', scrub: true } }
        );
    }
});
</script>

<?php get_footer(); ?>
