<?php
/**
 * Template Name: Vacatures
 *
 * @package avw-distillery
 */

get_header();

$googtrans = isset($_COOKIE['googtrans']) ? $_COOKIE['googtrans'] : '';
$is_en    = ( strpos( $_SERVER['REQUEST_URI'], '/en/' ) !== false ) || ( strpos( $googtrans, '/en' ) !== false );

$vacatures = new WP_Query(array(
    'post_type'      => 'vacature',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
));
?>

<style>
/* ============================================================
   VACATURES PAGE
   ============================================================ */
.avw-vac-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-vac-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 40%; opacity: 0.45;
}
.avw-vac-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-vac-hero-content {
    position: relative; z-index: 10;
    max-width: 900px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-vac-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-vac-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-vac-breadcrumb a:hover { color: #fff; }
.avw-vac-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(42px, 7vw, 80px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.05; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}
.avw-vac-hero-sub {
    font-family: 'DM Sans', sans-serif; font-size: 16px; color: rgba(238,223,203,0.75);
    margin-top: 16px; letter-spacing: 0.02em;
}

/* ---- Body ---- */
.avw-vac-body {
    width: 80%; max-width: 1400px; margin: 0 auto; padding: 72px 0 100px;
}

/* ---- Vacancy cards ---- */
.avw-vac-list { display: flex; flex-direction: column; gap: 20px; }

.avw-vac-card {
    background: #fff; border-radius: 20px;
    box-shadow: 0 4px 24px rgba(54,34,29,0.07); border: 1px solid rgba(54,34,29,0.06);
    text-decoration: none; color: inherit;
    display: flex; align-items: center; gap: 32px;
    padding: 32px 40px;
    transition: box-shadow 0.25s, transform 0.25s;
}
.avw-vac-card:hover { box-shadow: 0 12px 40px rgba(54,34,29,0.13); transform: translateY(-2px); }

.avw-vac-card-main { flex: 1; }

.avw-vac-card-title {
    font-family: 'Kurversbrug', serif; font-size: 22px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.08em; font-weight: normal;
    margin: 0 0 10px;
}

.avw-vac-card-excerpt {
    font-family: 'DM Sans', sans-serif; font-size: 14px; color: rgba(54,34,29,0.65);
    line-height: 1.65; margin: 0 0 16px;
}

.avw-vac-card-meta {
    display: flex; flex-wrap: wrap; gap: 10px;
}

.avw-vac-meta-tag {
    font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.1em;
    background: #fdf8f1; color: rgba(54,34,29,0.6);
    border: 1px solid rgba(54,34,29,0.1); border-radius: 20px;
    padding: 5px 14px;
}

.avw-vac-card-arrow {
    flex-shrink: 0; width: 44px; height: 44px;
    background: linear-gradient(90deg, rgba(0,0,0,0.2), rgba(0,0,0,0.2)), #432B25;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    color: #eedfcb; transition: opacity 0.2s;
}
.avw-vac-card:hover .avw-vac-card-arrow { opacity: 0.85; }

/* ---- Empty state ---- */
.avw-vac-empty {
    text-align: center; padding: 80px 24px;
    background: #fff; border-radius: 20px;
    box-shadow: 0 4px 24px rgba(54,34,29,0.07);
}
.avw-vac-empty-title {
    font-family: 'Kurversbrug', serif; font-size: 26px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.1em; font-weight: normal;
    margin: 0 0 12px;
}
.avw-vac-empty-text {
    font-family: 'DM Sans', sans-serif; font-size: 15px; color: rgba(54,34,29,0.5);
}

@media (max-width: 900px) { .avw-vac-body { width: 92%; } }
@media (max-width: 640px) {
    .avw-vac-body { width: 100%; padding-left: 16px; padding-right: 16px; }
    .avw-vac-card { flex-direction: column; align-items: flex-start; gap: 16px; padding: 24px; }
    .avw-vac-card-arrow { display: none; }
}
</style>

<!-- HERO -->
<section class="avw-vac-hero">
    <img id="vac-hero-img" class="avw-vac-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="Vacatures" />
    <div class="avw-vac-hero-overlay"></div>
    <div class="avw-vac-hero-content">
        <nav class="avw-vac-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;"><?php echo $is_en ? 'Vacancies' : 'Vacatures'; ?></span>
        </nav>
        <h1 id="vac-hero-title" class="avw-vac-hero-title"><?php echo $is_en ? 'Vacancies' : 'Vacatures'; ?></h1>
        <p class="avw-vac-hero-sub"><?php echo $is_en ? 'Work with us at A. van Wees Distillery De Ooievaar' : 'Kom werken bij A. van Wees Distilleerderij De Ooievaar'; ?></p>
    </div>
</section>

<!-- VACATURES LIST -->
<div class="avw-vac-body">
    <?php if ( $vacatures->have_posts() ): ?>
        <div class="avw-vac-list">
            <?php while ( $vacatures->have_posts() ) : $vacatures->the_post();
                $afdeling     = get_post_meta( get_the_ID(), '_vacature_afdeling',     true );
                $locatie      = get_post_meta( get_the_ID(), '_vacature_locatie',      true );
                $uren         = get_post_meta( get_the_ID(), '_vacature_uren',         true );
                $contracttype = get_post_meta( get_the_ID(), '_vacature_contracttype', true );
            ?>
            <a href="<?php the_permalink(); ?>" class="avw-vac-card">
                <div class="avw-vac-card-main">
                    <h2 class="avw-vac-card-title"><?php the_title(); ?></h2>
                    <?php if ( has_excerpt() ): ?>
                        <p class="avw-vac-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                    <?php endif; ?>
                    <div class="avw-vac-card-meta">
                        <?php if ($afdeling):     ?><span class="avw-vac-meta-tag"><?php echo esc_html($afdeling); ?></span><?php endif; ?>
                        <?php if ($locatie):      ?><span class="avw-vac-meta-tag">📍 <?php echo esc_html($locatie); ?></span><?php endif; ?>
                        <?php if ($uren):         ?><span class="avw-vac-meta-tag">⏱ <?php echo esc_html($uren); ?></span><?php endif; ?>
                        <?php if ($contracttype): ?><span class="avw-vac-meta-tag"><?php echo esc_html($contracttype); ?></span><?php endif; ?>
                    </div>
                </div>
                <div class="avw-vac-card-arrow">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    <?php else: ?>
        <div class="avw-vac-empty">
            <p class="avw-vac-empty-title"><?php echo $is_en ? 'No vacancies at the moment' : 'Momenteel geen vacatures'; ?></p>
            <p class="avw-vac-empty-text"><?php echo $is_en ? 'There are currently no open positions. Feel free to send an open application.' : 'Er zijn op dit moment geen openstaande vacatures. Stuur gerust een open sollicitatie.'; ?></p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
