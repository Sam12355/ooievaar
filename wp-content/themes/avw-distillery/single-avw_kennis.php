<?php
/**
 * Single Kennisartikel
 *
 * @package avw-distillery
 */

get_header();

$avw_lang = function_exists('pll_current_language') ? pll_current_language() : get_locale();
$is_en    = ( strpos( $avw_lang, 'en' ) === 0 ) || ( strpos( $_SERVER['REQUEST_URI'], '/en/' ) !== false );

// Link back to the kennisbank listing page
$kb_page = get_pages(array(
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'page-kennisbank.php',
    'number'     => 1,
));
$kb_url = ! empty($kb_page) ? get_permalink( $kb_page[0]->ID ) : home_url( $is_en ? '/en/kennisbank/' : '/nl/kennisbank/' );

$other_kennis = new WP_Query(array(
    'post_type'      => 'avw_kennis',
    'post_status'    => 'publish',
    'posts_per_page' => 8,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post__not_in'   => array( get_the_ID() ),
    'lang'           => $is_en ? 'en' : 'nl',
));
?>

<style>
/* ============================================================
   SINGLE KENNISARTIKEL
   ============================================================ */
.avw-skb-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-skb-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 40%; opacity: 0.45;
}
.avw-skb-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-skb-hero-content {
    position: relative; z-index: 10;
    max-width: 900px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-skb-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-skb-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-skb-breadcrumb a:hover { color: #fff; }
.avw-skb-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(32px, 5vw, 64px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.1em; font-weight: normal;
    margin: 0; line-height: 1.1; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* ---- Body ---- */
.avw-skb-body {
    width: 80%; max-width: 860px; margin: 0 auto; padding: 72px 0 80px;
}

/* ---- Article card ---- */
.avw-skb-card {
    background: #fff; border-radius: 20px;
    box-shadow: 0 4px 32px rgba(54,34,29,0.07); border: 1px solid rgba(54,34,29,0.06);
    overflow: hidden;
}
.avw-skb-featured-img {
    width: 100%; height: auto; display: block;
}
.avw-skb-content { padding: 44px 52px 52px; }
.avw-skb-meta {
    font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.12em; color: rgba(54,34,29,0.45);
    margin-bottom: 20px;
}
.avw-skb-body-text {
    font-family: 'DM Sans', sans-serif; font-size: 16px; line-height: 1.9;
    color: rgba(54,34,29,0.78);
}
.avw-skb-body-text p { margin-bottom: 18px; }
.avw-skb-body-text p:last-child { margin-bottom: 0; }
.avw-skb-body-text h2,
.avw-skb-body-text h3 {
    font-family: 'Kurversbrug', serif; font-weight: normal;
    text-transform: uppercase; letter-spacing: 0.08em; color: #36221d;
    margin: 32px 0 14px;
}
.avw-skb-body-text h2 { font-size: 22px; }
.avw-skb-body-text h3 { font-size: 18px; }
.avw-skb-body-text a { color: #432B25; }
.avw-skb-body-text img { max-width: 100%; border-radius: 12px; margin: 16px 0; }

/* ---- Back link ---- */
.avw-skb-back {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.1em; color: rgba(54,34,29,0.5);
    text-decoration: none; margin-bottom: 28px; transition: color 0.2s;
}
.avw-skb-back:hover { color: #36221d; }

/* ---- Other articles carousel ---- */
.avw-skb-other {
    width: 80%; max-width: 1200px; margin: 0 auto; padding: 0 0 100px;
}
.avw-skb-other-title {
    font-family: 'Kurversbrug', serif; font-size: 28px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.1em; font-weight: normal;
    margin: 0 0 32px;
}
.avw-skb-swiper { overflow: hidden; }
.avw-skb-slide {
    background: #fff; border-radius: 20px;
    box-shadow: 0 4px 32px rgba(54,34,29,0.07); border: 1px solid rgba(54,34,29,0.06);
    overflow: hidden; text-decoration: none; display: flex; flex-direction: column;
    height: auto;
}
.avw-skb-slide:hover .avw-skb-slide-title { color: #432B25; }
.avw-skb-slide-img {
    width: 100%; aspect-ratio: 16/9; object-fit: cover; display: block;
}
.avw-skb-slide-img-placeholder {
    width: 100%; aspect-ratio: 16/9; background: #f5ede3;
    display: flex; align-items: center; justify-content: center;
}
.avw-skb-slide-body { padding: 20px 24px 24px; flex: 1; }
.avw-skb-slide-date {
    font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.12em; color: rgba(54,34,29,0.4);
    margin-bottom: 8px;
}
.avw-skb-slide-title {
    font-family: 'Kurversbrug', serif; font-size: 17px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.07em; font-weight: normal;
    margin: 0; line-height: 1.3; transition: color 0.2s;
}

/* Swiper nav */
.avw-skb-nav {
    display: flex; align-items: center; justify-content: flex-end; gap: 12px;
    margin-bottom: 24px;
}
.avw-skb-btn {
    width: 40px; height: 40px; border-radius: 50%;
    background: #fff; border: 1.5px solid rgba(54,34,29,0.15);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: background 0.2s, border-color 0.2s;
}
.avw-skb-btn:hover { background: #36221d; border-color: #36221d; }
.avw-skb-btn:hover svg path { stroke: #fff; }
.avw-skb-btn.swiper-button-disabled { opacity: 0.35; pointer-events: none; }

@media (max-width: 960px) {
    .avw-skb-body, .avw-skb-other { width: 92%; }
}
@media (max-width: 600px) {
    .avw-skb-body, .avw-skb-other { width: 100%; padding-left: 16px; padding-right: 16px; }
    .avw-skb-content { padding: 28px 24px 32px; }
}
</style>

<?php while ( have_posts() ): the_post(); ?>

<!-- HERO -->
<section class="avw-skb-hero">
    <?php if ( has_post_thumbnail() ): ?>
        <img id="skb-hero-img" class="avw-skb-hero-img" src="<?php echo get_the_post_thumbnail_url(null, 'full'); ?>" alt="<?php the_title_attribute(); ?>" />
    <?php else: ?>
        <img id="skb-hero-img" class="avw-skb-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="<?php echo $is_en ? 'Knowledge Base' : 'Kennisbank'; ?>" />
    <?php endif; ?>
    <div class="avw-skb-hero-overlay"></div>
    <div class="avw-skb-hero-content">
        <nav class="avw-skb-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <a href="<?php echo esc_url($kb_url); ?>"><?php echo $is_en ? 'Knowledge Base' : 'Kennisbank'; ?></a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;"><?php the_title(); ?></span>
        </nav>
        <h1 id="skb-hero-title" class="avw-skb-hero-title"><?php the_title(); ?></h1>
    </div>
</section>

<!-- ARTICLE -->
<div class="avw-skb-body">
    <a class="avw-skb-back" href="<?php echo esc_url($kb_url); ?>">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path d="M19 12H5M5 12l7 7M5 12l7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <?php echo $is_en ? 'Back to Knowledge Base' : 'Terug naar Kennisbank'; ?>
    </a>

    <article class="avw-skb-card">
        <?php if ( has_post_thumbnail() ): ?>
            <img class="avw-skb-featured-img" src="<?php echo get_the_post_thumbnail_url(null, 'full'); ?>" alt="<?php the_title_attribute(); ?>" />
        <?php endif; ?>
        <div class="avw-skb-content">
            <div class="avw-skb-meta"><?php echo get_the_date('d F Y'); ?></div>
            <div class="avw-skb-body-text">
                <?php the_content(); ?>
            </div>
        </div>
    </article>
</div>

<?php endwhile; ?>

<?php if ( $other_kennis->have_posts() ): ?>
<!-- OTHER ARTICLES CAROUSEL -->
<div class="avw-skb-other">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
        <h2 class="avw-skb-other-title" style="margin:0;"><?php echo $is_en ? 'More Articles' : 'Meer Artikelen'; ?></h2>
        <div class="avw-skb-nav">
            <button class="avw-skb-btn" id="skb-prev" aria-label="<?php echo $is_en ? 'Previous' : 'Vorige'; ?>">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6" stroke="#36221d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button class="avw-skb-btn" id="skb-next" aria-label="<?php echo $is_en ? 'Next' : 'Volgende'; ?>">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6" stroke="#36221d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
    </div>

    <div class="swiper avw-skb-swiper" id="skb-swiper">
        <div class="swiper-wrapper">
            <?php while ( $other_kennis->have_posts() ): $other_kennis->the_post(); ?>
                <div class="swiper-slide" style="height:auto;">
                    <a class="avw-skb-slide" href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ): ?>
                            <img class="avw-skb-slide-img" src="<?php echo get_the_post_thumbnail_url(null, 'medium_large'); ?>" alt="<?php the_title_attribute(); ?>" />
                        <?php else: ?>
                            <div class="avw-skb-slide-img-placeholder">
                                <svg width="40" height="40" fill="none" viewBox="0 0 24 24"><rect width="24" height="24" rx="4" fill="#e8d8c8"/><path d="M6 4h12v16H6z" fill="none" stroke="#b89a7a" stroke-width="1.5"/><path d="M9 9h6M9 12h6M9 15h4" stroke="#b89a7a" stroke-width="1.5" stroke-linecap="round"/></svg>
                            </div>
                        <?php endif; ?>
                        <div class="avw-skb-slide-body">
                            <div class="avw-skb-slide-date"><?php echo get_the_date('d F Y'); ?></div>
                            <h3 class="avw-skb-slide-title"><?php the_title(); ?></h3>
                        </div>
                    </a>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.fromTo('#skb-hero-img',
            { yPercent: -15 },
            { yPercent: 15, ease: 'none',
              scrollTrigger: { trigger: '#skb-hero-title', start: 'top bottom', end: 'bottom top', scrub: true } }
        );
    }

    if (typeof Swiper !== 'undefined') {
        new Swiper('#skb-swiper', {
            slidesPerView: 1.2,
            spaceBetween: 20,
            navigation: {
                nextEl: '#skb-next',
                prevEl: '#skb-prev',
                disabledClass: 'swiper-button-disabled',
            },
            breakpoints: {
                600:  { slidesPerView: 2.2, spaceBetween: 20 },
                960:  { slidesPerView: 3.2, spaceBetween: 24 },
                1200: { slidesPerView: 4,   spaceBetween: 24 },
            }
        });
    }
});
</script>

<?php get_footer(); ?>
