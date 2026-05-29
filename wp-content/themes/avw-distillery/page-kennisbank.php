<?php
/**
 * Template Name: Kennisbank
 *
 * @package avw-distillery
 */

get_header();

$avw_lang = function_exists('pll_current_language') ? pll_current_language() : get_locale();
$is_en    = ( strpos( $avw_lang, 'en' ) === 0 ) || ( strpos( $_SERVER['REQUEST_URI'], '/en/' ) !== false );

// Static pages use 'page', archives use 'paged'
$paged  = max( 1, (int) get_query_var('page') ?: (int) get_query_var('paged') ?: 1 );
$kennis = new WP_Query(array(
    'post_type'      => 'avw_kennis',
    'post_status'    => 'publish',
    'posts_per_page' => 1,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'lang'           => function_exists('pll_current_language') ? pll_current_language() : '',
));
?>

<style>
/* ============================================================
   KENNISBANK PAGE
   ============================================================ */
.avw-kb-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-kb-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 40%; opacity: 0.45;
}
.avw-kb-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-kb-hero-content {
    position: relative; z-index: 10;
    max-width: 900px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-kb-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-kb-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-kb-breadcrumb a:hover { color: #fff; }
.avw-kb-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(42px, 7vw, 80px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.05; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* ---- Body ---- */
.avw-kb-body {
    width: 80%; max-width: 1200px; margin: 0 auto; padding: 72px 0 100px;
}

/* ---- Grid ---- */
.avw-kb-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
}
.avw-kb-card {
    background: #fff; border-radius: 20px;
    box-shadow: 0 4px 32px rgba(54,34,29,0.07); border: 1px solid rgba(54,34,29,0.06);
    overflow: hidden; text-decoration: none; display: flex; flex-direction: column;
    transition: box-shadow 0.2s, transform 0.2s;
}
.avw-kb-card:hover { box-shadow: 0 8px 40px rgba(54,34,29,0.13); transform: translateY(-3px); }
.avw-kb-card-img {
    width: 100%; aspect-ratio: 16/9; object-fit: cover; display: block;
    background: #f5ede3;
}
.avw-kb-card-img-placeholder {
    width: 100%; aspect-ratio: 16/9; background: #f5ede3;
    display: flex; align-items: center; justify-content: center;
}
.avw-kb-card-body { padding: 24px 28px 28px; flex: 1; display: flex; flex-direction: column; }
.avw-kb-card-date {
    font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.12em; color: rgba(54,34,29,0.45);
    margin-bottom: 10px;
}
.avw-kb-card-title {
    font-family: 'Kurversbrug', serif; font-size: 19px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.07em; font-weight: normal;
    margin: 0 0 12px; line-height: 1.3;
}
.avw-kb-card-excerpt {
    font-family: 'DM Sans', sans-serif; font-size: 14px; line-height: 1.75;
    color: rgba(54,34,29,0.68); flex: 1;
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
}
.avw-kb-card-link {
    font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
    color: #432B25; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 18px;
}

/* ---- Empty state ---- */
.avw-kb-empty {
    text-align: center; padding: 80px 0;
    font-family: 'DM Sans', sans-serif; font-size: 16px; color: rgba(54,34,29,0.5);
}

/* ---- Pagination ---- */
.avw-kb-pagination {
    display: flex; align-items: center; justify-content: center;
    gap: 8px; margin-top: 56px; flex-wrap: wrap;
}
.avw-kb-pagination a,
.avw-kb-pagination span {
    font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600;
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 42px; height: 42px; padding: 0 14px;
    border-radius: 999px; text-decoration: none; transition: all 0.2s;
    border: 1.5px solid rgba(54,34,29,0.15); color: rgba(54,34,29,0.65);
    background: #fff;
}
.avw-kb-pagination a:hover {
    background: #36221d; color: #eedfcb; border-color: #36221d;
}
.avw-kb-pagination span.current {
    background: #36221d; color: #eedfcb; border-color: #36221d;
}
.avw-kb-pagination span.dots {
    border: none; background: none; color: rgba(54,34,29,0.35);
}

@media (max-width: 960px) {
    .avw-kb-body { width: 92%; }
    .avw-kb-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .avw-kb-body { width: 100%; padding-left: 16px; padding-right: 16px; }
    .avw-kb-grid { grid-template-columns: 1fr; }
}
</style>

<!-- HERO -->
<section class="avw-kb-hero">
    <img id="kb-hero-img" class="avw-kb-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="<?php echo $is_en ? 'Knowledge Base' : 'Kennisbank'; ?>" />
    <div class="avw-kb-hero-overlay"></div>
    <div class="avw-kb-hero-content">
        <nav class="avw-kb-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;"><?php echo $is_en ? 'Knowledge Base' : 'Kennisbank'; ?></span>
        </nav>
        <h1 id="kb-hero-title" class="avw-kb-hero-title"><?php echo $is_en ? 'Knowledge Base' : 'Kennisbank'; ?></h1>
    </div>
</section>

<!-- CONTENT -->
<div class="avw-kb-body">
    <?php if ( $kennis->have_posts() ): ?>
        <div class="avw-kb-grid">
            <?php while ( $kennis->have_posts() ): $kennis->the_post(); ?>
                <a class="avw-kb-card" href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ): ?>
                        <img class="avw-kb-card-img" src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" alt="<?php the_title_attribute(); ?>" />
                    <?php else: ?>
                        <div class="avw-kb-card-img-placeholder">
                            <svg width="48" height="48" fill="none" viewBox="0 0 24 24"><rect width="24" height="24" rx="4" fill="#e8d8c8"/><path d="M6 4h12v16H6z" fill="none" stroke="#b89a7a" stroke-width="1.5"/><path d="M9 9h6M9 12h6M9 15h4" stroke="#b89a7a" stroke-width="1.5" stroke-linecap="round"/></svg>
                        </div>
                    <?php endif; ?>
                    <div class="avw-kb-card-body">
                        <div class="avw-kb-card-date"><?php echo get_the_date('d F Y'); ?></div>
                        <h2 class="avw-kb-card-title"><?php the_title(); ?></h2>
                        <p class="avw-kb-card-excerpt"><?php echo get_the_excerpt() ?: wp_trim_words(get_the_content(), 25); ?></p>
                        <span class="avw-kb-card-link"><?php echo $is_en ? 'Read more &rarr;' : 'Lees meer &rarr;'; ?></span>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

    <?php else: ?>
        <div class="avw-kb-empty">
            <p><?php echo $is_en ? 'No articles published yet.' : 'Er zijn nog geen artikelen gepubliceerd.'; ?></p>
        </div>
    <?php endif; ?>

    <?php
    // Pagination — always rendered so the UI is always visible
    $total_pages = max( 1, $kennis->max_num_pages );
    $kb_base     = trailingslashit( get_permalink( get_queried_object_id() ) );
    $links       = paginate_links(array(
        'base'      => $kb_base . '%_%',
        'format'    => 'page/%#%/',
        'current'   => $paged,
        'total'     => $total_pages,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
        'type'      => 'plain',
        'mid_size'  => 2,
        'end_size'  => 1,
    ));
    echo '<div class="avw-kb-pagination">';
    // paginate_links returns empty when there is only 1 page — show page 1 manually
    echo $links ?: '<span class="current">1</span>';
    echo '</div>';
    ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.fromTo('#kb-hero-img',
            { yPercent: -15 },
            { yPercent: 15, ease: 'none',
              scrollTrigger: { trigger: '#kb-hero-title', start: 'top bottom', end: 'bottom top', scrub: true } }
        );
    }
});
</script>

<?php get_footer(); ?>
