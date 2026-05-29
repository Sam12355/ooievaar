<?php
/**
 * Template Name: Registration
 */
get_header();

$avw_lang  = function_exists('pll_current_language') ? pll_current_language() : get_locale();
$is_en     = ( strpos($avw_lang, 'en') === 0 ) || ( strpos($_SERVER['REQUEST_URI'], '/en/') !== false );
$reg_form_id = $is_en ? 1 : 5;
?>


<style>
/* ============================================================
   BUSINESS REGISTRATION PAGE STYLES
   ============================================================ */
.avw-biz-reg {
    min-height: 80vh;
    padding: 80px 24px 120px;
    background: #fff;
    font-family: 'DM Sans', sans-serif;
}

.avw-biz-container {
    max-width: 1000px;
    margin: 0 auto;
}

.avw-biz-header {
    text-align: center;
    margin-bottom: 64px;
}

.avw-biz-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(2.5rem, 6vw, 4rem);
    color: #133E23;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    margin-bottom: 16px;
    font-weight: normal;
}

.avw-biz-subtitle {
    font-size: 16px;
    color: rgba(19,62,35,0.6);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.7;
}

.avw-biz-form-wrap {
    background: #fff;
    border: 1px solid rgba(19,62,35,0.08);
    border-radius: 32px;
    padding: 60px;
    box-shadow: 0 20px 80px rgba(0,0,0,0.04);
}

@media (max-width: 768px) {
    .avw-biz-form-wrap { padding: 40px 24px; }
    .avw-biz-reg { padding-top: 60px; }
}

/* ---- Gravity Forms brand overrides ---- */
.avw-biz-form-wrap .gform_wrapper { margin: 0; }
.avw-biz-form-wrap .gfield_label,
.avw-biz-form-wrap .gfield_label label {
    font-size: 11px !important; font-weight: 700 !important;
    text-transform: uppercase !important; letter-spacing: 0.12em !important;
    color: rgba(19,62,35,0.5) !important; margin-left: 4px !important;
}
.avw-biz-form-wrap .gfield_required { color: #c62828 !important; }
.avw-biz-form-wrap input[type="text"],
.avw-biz-form-wrap input[type="email"],
.avw-biz-form-wrap input[type="tel"],
.avw-biz-form-wrap input[type="url"],
.avw-biz-form-wrap input[type="number"],
.avw-biz-form-wrap select,
.avw-biz-form-wrap textarea {
    padding: 16px 20px !important; border: 1.5px solid rgba(19,62,35,0.12) !important;
    border-radius: 16px !important; font-size: 15px !important; color: #133E23 !important;
    background: #fafafa !important; width: 100% !important; box-sizing: border-box !important;
    outline: none !important; font-family: 'DM Sans', sans-serif !important;
    box-shadow: none !important; transition: all 0.25s ease !important;
}
.avw-biz-form-wrap input[type="text"]:focus,
.avw-biz-form-wrap input[type="email"]:focus,
.avw-biz-form-wrap input[type="tel"]:focus,
.avw-biz-form-wrap textarea:focus,
.avw-biz-form-wrap select:focus {
    border-color: #133E23 !important; background: #fff !important;
    box-shadow: 0 0 0 4px rgba(19,62,35,0.05) !important;
}
.avw-biz-form-wrap textarea { min-height: 120px !important; resize: vertical !important; }
.avw-biz-form-wrap .gform_footer,
.avw-biz-form-wrap .gform_page_footer { padding: 20px 0 0; border: none; }
.avw-biz-form-wrap .gform_footer input[type="submit"],
.avw-biz-form-wrap .gform_page_footer input[type="submit"],
.avw-biz-form-wrap .gform_footer button[type="submit"],
.avw-biz-form-wrap .gform_next_button {
    display: block !important; width: 100% !important;
    background: #133E23 !important; color: #cdbca6 !important;
    padding: 20px 32px !important; border-radius: 9999px !important;
    font-family: 'Kurversbrug', serif !important; font-size: 16px !important;
    text-transform: uppercase !important; letter-spacing: 0.2em !important;
    border: none !important; cursor: pointer !important;
    box-shadow: 0 10px 40px rgba(19,62,35,0.2) !important;
    transition: all 0.3s !important; text-align: center !important;
}
.avw-biz-form-wrap .gform_footer input[type="submit"]:hover,
.avw-biz-form-wrap .gform_footer button[type="submit"]:hover {
    background: #0a2415 !important; color: #fff !important;
}
.avw-biz-form-wrap .gform_confirmation_message {
    font-family: 'DM Sans', sans-serif; font-size: 15px; color: #133E23;
    background: #e8f5e9; border: 1px solid #a5d6a7; border-radius: 12px;
    padding: 18px 22px; line-height: 1.7; text-align: center;
}
.avw-biz-form-wrap .validation_error,
.avw-biz-form-wrap .gfield_description.validation_message {
    font-family: 'DM Sans', sans-serif !important; font-size: 13px !important;
    color: #c62828 !important; background: none !important;
    border: none !important; padding: 0 !important;
}
</style>

<div class="avw-biz-reg">
    <div class="avw-biz-container">
        
        <!-- Header -->
        <header class="avw-biz-header">
            <h1 class="avw-biz-title"><?php echo $is_en ? 'Business Registration' : 'Zakelijke Registratie'; ?></h1>
            <p class="avw-biz-subtitle">
                <?php echo $is_en
                    ? 'Become a wholesale partner. Complete the form below to apply for a business account and access our artisanal collection of genevers and liqueurs.'
                    : 'Word groothandelspartner. Vul het onderstaande formulier in om een zakelijk account aan te vragen en toegang te krijgen tot onze ambachtelijke collectie jenever en likeuren.'; ?>
            </p>
        </header>

        <!-- Application Form (Gravity Forms) -->
        <div class="avw-biz-form-wrap">
            <?php
            if ( function_exists('gravity_form') ) {
                gravity_form( $reg_form_id, false, false, false, null, true );
            } elseif ( class_exists('GFAPI') ) {
                echo do_shortcode( '[gravityforms id="' . intval($reg_form_id) . '"]' );
            } else {
                echo '<p style="font-family:\'DM Sans\',sans-serif;color:rgba(19,62,35,0.6);font-size:14px;text-align:center;">'
                   . ( $is_en ? 'Form is not available. Please install Gravity Forms.' : 'Formulier is niet beschikbaar.' )
                   . '</p>';
            }
            ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
