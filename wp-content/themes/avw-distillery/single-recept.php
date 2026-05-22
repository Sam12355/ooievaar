<?php
/**
 * Single Recept Template
 *
 * @package avw-distillery
 */

get_header();

while ( have_posts() ) :
    the_post();

    $products     = get_the_terms( get_the_ID(), 'recept_product' );
    $soorten      = get_the_terms( get_the_ID(), 'recept_soort' );
    $gelegenheden = get_the_terms( get_the_ID(), 'recept_gelegenheid' );
    $img_url      = get_the_post_thumbnail_url( get_the_ID(), 'full' );
?>

<style>
/* ============================================================
   SINGLE RECEPT
   ============================================================ */
.avw-srec-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-srec-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 30%; opacity: 0.5;
}
.avw-srec-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55), rgba(0,0,0,0.2) 60%, rgba(54,34,29,0.75) 100%);
}
.avw-srec-hero-content {
    position: relative; z-index: 10;
    max-width: 800px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-srec-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-srec-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-srec-breadcrumb a:hover { color: #fff; }
.avw-srec-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(36px, 6vw, 70px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.1; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* Tags below title */
.avw-srec-hero-tags {
    display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin-top: 20px;
}
.avw-srec-hero-tag {
    font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.12em;
    background: rgba(255,255,255,0.15); color: #eedfcb;
    border: 1px solid rgba(238,223,203,0.3); border-radius: 20px; padding: 5px 14px;
}

/* ---- Content ---- */
.avw-srec-body {
    max-width: 760px; margin: 0 auto; padding: 64px 24px 100px;
}

.avw-srec-card {
    background: #fff; border-radius: 24px; overflow: hidden;
    box-shadow: 0 4px 40px rgba(54,34,29,0.08); border: 1px solid rgba(54,34,29,0.06);
}

.avw-srec-featured-img {
    width: 100%; max-height: 440px; object-fit: cover; object-position: center; display: block;
}

.avw-srec-content { padding: 44px 52px; }

.avw-srec-content-body {
    font-family: 'DM Sans', sans-serif; font-size: 16px; line-height: 1.85; color: rgba(54,34,29,0.82);
}
.avw-srec-content-body h2, .avw-srec-content-body h3 {
    font-family: 'Kurversbrug', serif; font-weight: normal; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.08em; margin: 32px 0 14px;
}
.avw-srec-content-body h2 { font-size: 22px; }
.avw-srec-content-body h3 { font-size: 17px; }
.avw-srec-content-body p { margin-bottom: 16px; }
.avw-srec-content-body ul, .avw-srec-content-body ol { padding-left: 20px; margin-bottom: 20px; }
.avw-srec-content-body li { margin-bottom: 8px; }
.avw-srec-content-body strong { color: #36221d; }

/* Back link */
.avw-srec-back {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.1em; color: rgba(54,34,29,0.5);
    text-decoration: none; margin-bottom: 32px; transition: color 0.2s;
}
.avw-srec-back:hover { color: #36221d; }

@media (max-width: 600px) {
    .avw-srec-content { padding: 28px 24px; }
}
</style>

<!-- HERO -->
<section class="avw-srec-hero">
    <?php if ($img_url): ?>
        <img id="srec-hero-img" class="avw-srec-hero-img" src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" />
    <?php else: ?>
        <img id="srec-hero-img" class="avw-srec-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="Recept" />
    <?php endif; ?>
    <div class="avw-srec-hero-overlay"></div>
    <div class="avw-srec-hero-content">
        <nav class="avw-srec-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <a href="<?php echo get_permalink(get_page_by_path('recepten')); ?>">Recepten</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;"><?php the_title(); ?></span>
        </nav>
        <h1 id="srec-hero-title" class="avw-srec-hero-title"><?php the_title(); ?></h1>
        <div class="avw-srec-hero-tags">
            <?php if ($products && !is_wp_error($products)): foreach ($products as $t): ?>
                <span class="avw-srec-hero-tag"><?php echo esc_html($t->name); ?></span>
            <?php endforeach; endif; ?>
            <?php if ($soorten && !is_wp_error($soorten)): foreach ($soorten as $t): ?>
                <span class="avw-srec-hero-tag"><?php echo esc_html($t->name); ?></span>
            <?php endforeach; endif; ?>
            <?php if ($gelegenheden && !is_wp_error($gelegenheden)): foreach ($gelegenheden as $t): ?>
                <span class="avw-srec-hero-tag"><?php echo esc_html($t->name); ?></span>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>

<!-- CONTENT -->
<div class="avw-srec-body">
    <a class="avw-srec-back" href="<?php echo get_permalink(get_page_by_path('recepten')); ?>">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
        Alle recepten
    </a>

    <div class="avw-srec-card">
        <?php if ($img_url): ?>
            <img class="avw-srec-featured-img" src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" />
        <?php endif; ?>
        <div class="avw-srec-content">
            <div class="avw-srec-content-body">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.fromTo('#srec-hero-img',
            { yPercent: -15 },
            { yPercent: 15, ease: 'none',
              scrollTrigger: { trigger: '#srec-hero-title', start: 'top bottom', end: 'bottom top', scrub: true } }
        );
    }
});
</script>

<?php endwhile; ?>

<?php get_footer(); ?>
