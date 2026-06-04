<?php
/**
 * Single Vacature Template
 *
 * @package avw-distillery
 */

get_header();

$avw_lang = function_exists('pll_current_language') ? pll_current_language() : get_locale();
$is_en    = ( strpos( $avw_lang, 'en' ) === 0 ) || ( strpos( $_SERVER['REQUEST_URI'], '/en/' ) !== false );

while ( have_posts() ) :
    the_post();
    $afdeling     = get_post_meta( get_the_ID(), '_vacature_afdeling',     true );
    $locatie      = get_post_meta( get_the_ID(), '_vacature_locatie',      true );
    $uren         = get_post_meta( get_the_ID(), '_vacature_uren',         true );
    $contracttype = get_post_meta( get_the_ID(), '_vacature_contracttype', true );
?>

<style>
/* ============================================================
   SINGLE VACATURE
   ============================================================ */
.avw-svac-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-svac-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 30%; opacity: 0.5;
}
.avw-svac-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55), rgba(0,0,0,0.2) 60%, rgba(54,34,29,0.75) 100%);
}
.avw-svac-hero-content {
    position: relative; z-index: 10;
    max-width: 800px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-svac-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-svac-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-svac-breadcrumb a:hover { color: #fff; }
.avw-svac-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(32px, 5vw, 64px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.1; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}
.avw-svac-hero-meta {
    display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin-top: 20px;
}
.avw-svac-hero-tag {
    font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.12em;
    background: rgba(255,255,255,0.15); color: #eedfcb;
    border: 1px solid rgba(238,223,203,0.3); border-radius: 20px; padding: 5px 14px;
}

/* ---- Body ---- */
.avw-svac-body {
    width: 80%; max-width: 1400px; margin: 0 auto; padding: 64px 0 100px;
}

.avw-svac-back {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.1em; color: rgba(54,34,29,0.5);
    text-decoration: none; margin-bottom: 32px; transition: color 0.2s;
}
.avw-svac-back:hover { color: #36221d; }

.avw-svac-layout {
    display: grid; grid-template-columns: 1fr 320px; gap: 32px; align-items: start;
}

/* Main content */
.avw-svac-card {
    background: #fff; border-radius: 24px; overflow: hidden;
    box-shadow: 0 4px 40px rgba(54,34,29,0.08); border: 1px solid rgba(54,34,29,0.06);
    padding: 48px 52px;
}
.avw-svac-content-body {
    font-family: 'DM Sans', sans-serif; font-size: 16px; line-height: 1.9; color: rgba(54,34,29,0.82);
}
.avw-svac-content-body h2,
.avw-svac-content-body h3,
.avw-svac-content-body h4 {
    font-family: 'Kurversbrug', serif; font-weight: normal; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.1em;
    font-size: 20px; margin: 36px 0 14px; padding-bottom: 10px;
    border-bottom: 2px solid rgba(54,34,29,0.12);
}
.avw-svac-content-body h2 { font-size: 24px; }
.avw-svac-content-body p { margin-bottom: 16px; }
.avw-svac-content-body ul { padding-left: 20px; margin-bottom: 20px; }
.avw-svac-content-body ul li { margin-bottom: 8px; }
.avw-svac-content-body strong { color: #36221d; font-weight: 700; }

/* Sidebar */
.avw-svac-sidebar { display: flex; flex-direction: column; gap: 20px; }

.avw-svac-detail-card {
    background: #fff; border-radius: 20px;
    box-shadow: 0 4px 24px rgba(54,34,29,0.07); border: 1px solid rgba(54,34,29,0.06);
    padding: 28px 28px;
}
.avw-svac-detail-title {
    font-family: 'Kurversbrug', serif; font-size: 16px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.1em; font-weight: normal;
    margin: 0 0 18px; padding-bottom: 10px; border-bottom: 1px solid rgba(54,34,29,0.1);
}
.avw-svac-detail-row {
    display: flex; flex-direction: column; gap: 12px;
}
.avw-svac-detail-item {
    display: flex; flex-direction: column; gap: 2px;
}
.avw-svac-detail-label {
    font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.12em; color: rgba(54,34,29,0.45);
}
.avw-svac-detail-value {
    font-family: 'DM Sans', sans-serif; font-size: 15px; color: #36221d; font-weight: 500;
}

.avw-svac-apply-card {
    background: linear-gradient(135deg, #432B25, #36221d);
    border-radius: 20px; padding: 28px; text-align: center;
}
.avw-svac-apply-title {
    font-family: 'Kurversbrug', serif; font-size: 20px; color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.1em; font-weight: normal;
    margin: 0 0 8px;
}
.avw-svac-apply-sub {
    font-family: 'DM Sans', sans-serif; font-size: 13px; color: rgba(238,223,203,0.7);
    margin: 0 0 20px;
}
.avw-svac-apply-btn {
    display: block; width: 100%;
    background: #eedfcb; color: #36221d;
    font-family: 'Kurversbrug', serif; font-size: 16px;
    text-transform: uppercase; letter-spacing: 0.1em;
    padding: 13px 20px; border-radius: 34px;
    text-decoration: none; transition: opacity 0.2s;
}
.avw-svac-apply-btn:hover { opacity: 0.88; }

@media (max-width: 900px) {
    .avw-svac-body { width: 92%; }
    .avw-svac-layout { grid-template-columns: 1fr; }
    .avw-svac-sidebar { order: -1; }
}
@media (max-width: 600px) {
    .avw-svac-body { width: 100%; padding-left: 16px; padding-right: 16px; }
    .avw-svac-card { padding: 28px 20px; }
}
</style>

<!-- HERO -->
<section class="avw-svac-hero">
    <img id="svac-hero-img" class="avw-svac-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="<?php the_title_attribute(); ?>" />
    <div class="avw-svac-hero-overlay"></div>
    <div class="avw-svac-hero-content">
        <nav class="avw-svac-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <a href="<?php echo get_permalink(get_page_by_path('vacatures')); ?>"><?php echo $is_en ? 'Vacancies' : 'Vacatures'; ?></a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;"><?php the_title(); ?></span>
        </nav>
        <h1 id="svac-hero-title" class="avw-svac-hero-title"><?php the_title(); ?></h1>
        <div class="avw-svac-hero-meta">
            <?php if ($afdeling):     ?><span class="avw-svac-hero-tag"><?php echo esc_html($afdeling); ?></span><?php endif; ?>
            <?php if ($locatie):      ?><span class="avw-svac-hero-tag"><?php echo esc_html($locatie); ?></span><?php endif; ?>
            <?php if ($uren):         ?><span class="avw-svac-hero-tag"><?php echo esc_html($uren); ?></span><?php endif; ?>
            <?php if ($contracttype): ?><span class="avw-svac-hero-tag"><?php echo esc_html($contracttype); ?></span><?php endif; ?>
        </div>
    </div>
</section>

<!-- CONTENT -->
<div class="avw-svac-body">
    <a class="avw-svac-back" href="<?php echo get_permalink(get_page_by_path('vacatures')); ?>">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
        <?php echo $is_en ? 'All vacancies' : 'Alle vacatures'; ?>
    </a>

    <div class="avw-svac-layout">
        <div class="avw-svac-card">
            <div class="avw-svac-content-body">
                <?php the_content(); ?>
            </div>
        </div>

        <aside class="avw-svac-sidebar">
            <?php if ($afdeling || $locatie || $uren || $contracttype): ?>
            <div class="avw-svac-detail-card">
                <h3 class="avw-svac-detail-title">Details</h3>
                <div class="avw-svac-detail-row">
                    <?php if ($afdeling): ?>
                    <div class="avw-svac-detail-item">
                        <span class="avw-svac-detail-label"><?php echo $is_en ? 'Department' : 'Afdeling'; ?></span>
                        <span class="avw-svac-detail-value"><?php echo esc_html($afdeling); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ($locatie): ?>
                    <div class="avw-svac-detail-item">
                        <span class="avw-svac-detail-label"><?php echo $is_en ? 'Location' : 'Locatie'; ?></span>
                        <span class="avw-svac-detail-value"><?php echo esc_html($locatie); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ($uren): ?>
                    <div class="avw-svac-detail-item">
                        <span class="avw-svac-detail-label"><?php echo $is_en ? 'Hours per week' : 'Uren per week'; ?></span>
                        <span class="avw-svac-detail-value"><?php echo esc_html($uren); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ($contracttype): ?>
                    <div class="avw-svac-detail-item">
                        <span class="avw-svac-detail-label"><?php echo $is_en ? 'Contract type' : 'Contracttype'; ?></span>
                        <span class="avw-svac-detail-value"><?php echo esc_html($contracttype); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="avw-svac-apply-card">
                <p class="avw-svac-apply-title"><?php echo $is_en ? 'Apply' : 'Solliciteer'; ?></p>
                <p class="avw-svac-apply-sub"><?php echo $is_en ? 'Send us your motivation and CV' : 'Stuur je motivatie en CV naar ons toe'; ?></p>
                <a class="avw-svac-apply-btn" href="mailto:info@de-ooievaar.nl?subject=<?php echo $is_en ? 'Application' : 'Sollicitatie'; ?>: <?php the_title_attribute(); ?>">
                    <?php echo $is_en ? 'Send your application' : 'Stuur je sollicitatie'; ?>
                </a>
            </div>
        </aside>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
