<?php
/**
 * Template Name: Nieuws
 *
 * @package avw-distillery
 */

get_header();

$googtrans = isset($_COOKIE['googtrans']) ? $_COOKIE['googtrans'] : '';
$is_en    = ( strpos( $_SERVER['REQUEST_URI'], '/en/' ) !== false ) || ( strpos( $googtrans, '/en' ) !== false );

$nieuws = new WP_Query(array(
    'post_type'      => 'avw_nieuws',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
));
if ( ! $nieuws->have_posts() ) {
    $nieuws = new WP_Query(array(
        'post_type'      => 'avw_nieuws',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'lang'           => '',
    ));
}
?>

<style>
/* ============================================================
   NIEUWS PAGE
   ============================================================ */
.avw-news-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-news-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 40%; opacity: 0.45;
}
.avw-news-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-news-hero-content {
    position: relative; z-index: 10;
    max-width: 900px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-news-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-news-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-news-breadcrumb a:hover { color: #fff; }
.avw-news-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(42px, 7vw, 80px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.05; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* ---- Body ---- */
.avw-news-body {
    width: 80%; max-width: 1200px; margin: 0 auto; padding: 72px 0 100px;
}

/* ---- Grid ---- */
.avw-news-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
}
.avw-news-card {
    background: #fff; border-radius: 20px;
    box-shadow: 0 4px 32px rgba(54,34,29,0.07); border: 1px solid rgba(54,34,29,0.06);
    overflow: hidden; text-decoration: none; display: flex; flex-direction: column;
    transition: box-shadow 0.2s, transform 0.2s;
}
.avw-news-card:hover { box-shadow: 0 8px 40px rgba(54,34,29,0.13); transform: translateY(-3px); }
.avw-news-card-img {
    width: 100%; aspect-ratio: 16/9; object-fit: cover; display: block;
    background: #f5ede3;
}
.avw-news-card-img-placeholder {
    width: 100%; aspect-ratio: 16/9; background: #f5ede3;
    display: flex; align-items: center; justify-content: center;
}
.avw-news-card-body { padding: 24px 28px 28px; flex: 1; display: flex; flex-direction: column; }
.avw-news-card-date {
    font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.12em; color: rgba(54,34,29,0.45);
    margin-bottom: 10px;
}
.avw-news-card-title {
    font-family: 'Kurversbrug', serif; font-size: 19px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.07em; font-weight: normal;
    margin: 0 0 12px; line-height: 1.3;
}
.avw-news-card-excerpt {
    font-family: 'DM Sans', sans-serif; font-size: 14px; line-height: 1.75;
    color: rgba(54,34,29,0.68); flex: 1;
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
}
.avw-news-card-link {
    font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
    color: #432B25; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 18px;
}

/* ---- Empty state ---- */
.avw-news-empty {
    text-align: center; padding: 80px 0;
    font-family: 'DM Sans', sans-serif; font-size: 16px; color: rgba(54,34,29,0.5);
}

@media (max-width: 960px) {
    .avw-news-body { width: 92%; }
    .avw-news-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .avw-news-body { width: 100%; padding-left: 16px; padding-right: 16px; }
    .avw-news-grid { grid-template-columns: 1fr; }
}
</style>

<!-- HERO -->
<section class="avw-news-hero">
    <img id="news-hero-img" class="avw-news-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="<?php echo $is_en ? 'News' : 'Nieuws'; ?>" />
    <div class="avw-news-hero-overlay"></div>
    <div class="avw-news-hero-content">
        <nav class="avw-news-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;"><?php echo $is_en ? 'News' : 'Nieuws'; ?></span>
        </nav>
        <h1 id="news-hero-title" class="avw-news-hero-title"><?php echo $is_en ? 'News' : 'Nieuws'; ?></h1>
    </div>
</section>

<!-- CONTENT -->
<div class="avw-news-body">
    <?php if ( $nieuws->have_posts() ): ?>
        <div class="avw-news-grid">
            <?php while ( $nieuws->have_posts() ): $nieuws->the_post(); ?>
                <a class="avw-news-card" href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ): ?>
                        <img class="avw-news-card-img" src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" alt="<?php the_title_attribute(); ?>" />
                    <?php else: ?>
                        <div class="avw-news-card-img-placeholder">
                            <svg width="48" height="48" fill="none" viewBox="0 0 24 24"><rect width="24" height="24" rx="4" fill="#e8d8c8"/><path d="M4 17l4-4 3 3 4-5 5 6H4z" fill="#b89a7a"/></svg>
                        </div>
                    <?php endif; ?>
                    <div class="avw-news-card-body">
                        <div class="avw-news-card-date"><?php echo get_the_date('d F Y'); ?></div>
                        <h2 class="avw-news-card-title"><?php the_title(); ?></h2>
                        <p class="avw-news-card-excerpt"><?php echo get_the_excerpt() ?: wp_trim_words(get_the_content(), 25); ?></p>
                        <span class="avw-news-card-link"><?php echo $is_en ? 'Read more &rarr;' : 'Lees meer &rarr;'; ?></span>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    <?php else: ?>
        <div class="avw-news-empty">
            <p><?php echo $is_en ? 'No news articles published yet.' : 'Er zijn nog geen nieuwsberichten gepubliceerd.'; ?></p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
