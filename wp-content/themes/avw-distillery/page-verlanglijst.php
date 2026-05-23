<?php
/**
 * Template Name: Verlanglijst
 *
 * @package avw-distillery
 */

get_header();

$fav_ids  = avw_get_favorites();
$has_favs = ! empty( $fav_ids );

if ( $has_favs ) {
    $products_query = new WP_Query( array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'post__in'       => array_map( 'intval', $fav_ids ),
        'orderby'        => 'post__in',
        'posts_per_page' => -1,
    ) );
}
?>

<style>
/* ============================================================
   VERLANGLIJST PAGE
   ============================================================ */
.avw-wl-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-wl-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 40%; opacity: 0.45;
}
.avw-wl-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-wl-hero-content {
    position: relative; z-index: 10;
    max-width: 900px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-wl-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-wl-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-wl-breadcrumb a:hover { color: #fff; }
.avw-wl-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(42px, 7vw, 80px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.05; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* ---- Body ---- */
.avw-wl-body {
    width: 88%; max-width: 1400px; margin: 0 auto; padding: 72px 0 100px;
}
.avw-wl-count {
    font-family: 'DM Sans', sans-serif; font-size: 14px; color: rgba(54,34,29,0.5);
    margin-bottom: 36px;
}
.avw-wl-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.avw-wl-card-wrap { transition: opacity 0.3s, transform 0.3s; }
.avw-wl-card-wrap.removing { opacity: 0; transform: scale(0.95); pointer-events: none; }

/* Empty state */
.avw-wl-empty {
    text-align: center; padding: 80px 0;
}
.avw-wl-empty-title {
    font-family: 'Kurversbrug', serif; font-size: 28px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.1em; font-weight: normal;
    margin: 0 0 16px;
}
.avw-wl-empty-text {
    font-family: 'DM Sans', sans-serif; font-size: 15px; color: rgba(54,34,29,0.55);
    margin: 0 0 32px;
}
.avw-wl-shop-btn {
    display: inline-block;
    background: linear-gradient(90deg, rgba(0,0,0,0.2), rgba(0,0,0,0.2)), #432B25;
    color: #fff; font-family: 'Kurversbrug', serif; font-size: 16px;
    text-transform: uppercase; letter-spacing: 0.12em;
    padding: 13px 44px; border-radius: 34px; text-decoration: none;
    transition: opacity 0.2s;
}
.avw-wl-shop-btn:hover { opacity: 0.88; }

@media (max-width: 1100px) { .avw-wl-grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 760px)  { .avw-wl-body { width: 94%; } .avw-wl-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px)  { .avw-wl-body { width: 100%; padding-left: 16px; padding-right: 16px; } .avw-wl-grid { grid-template-columns: 1fr; } }
</style>

<!-- HERO -->
<section class="avw-wl-hero">
    <img class="avw-wl-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="Verlanglijst" />
    <div class="avw-wl-hero-overlay"></div>
    <div class="avw-wl-hero-content">
        <nav class="avw-wl-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;">Verlanglijst</span>
        </nav>
        <h1 class="avw-wl-hero-title">Verlanglijst</h1>
    </div>
</section>

<!-- CONTENT -->
<div class="avw-wl-body">

    <?php if ( $has_favs && $products_query->have_posts() ): ?>

        <p class="avw-wl-count" id="avw-wl-count"><?php echo $products_query->post_count; ?> product<?php echo $products_query->post_count !== 1 ? 'en' : ''; ?> opgeslagen</p>

        <div class="avw-wl-grid" id="avw-wl-grid">
            <?php while ( $products_query->have_posts() ): $products_query->the_post();
                $product          = wc_get_product( get_the_ID() );
                $img_url          = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : wc_placeholder_img_src();
                $currency_symbol  = get_woocommerce_currency_symbol();
                $raw_price        = wc_get_price_to_display( $product );
                $formatted_price  = $raw_price ? number_format_i18n( $raw_price, 2 ) : '';
                $first_cat_name   = '';
                $terms = get_the_terms( get_the_ID(), 'product_cat' );
                if ( $terms && ! is_wp_error( $terms ) ) {
                    foreach ( $terms as $term ) {
                        if ( $term->slug !== 'uncategorized' ) { $first_cat_name = $term->name; break; }
                    }
                }
                $short_desc = $product->get_short_description();
                if ( empty( $short_desc ) ) $short_desc = get_the_excerpt();
            ?>
                <div class="avw-wl-card-wrap" data-product-id="<?php echo esc_attr( get_the_ID() ); ?>">
                    <div class="product-card bg-[#eedfcb] rounded-[24px] sm:rounded-[32px] p-3 sm:p-4 flex flex-col h-full">
                        <div class="relative rounded-[18px] sm:rounded-[24px] overflow-hidden mb-5 sm:mb-8 bg-white" style="aspect-ratio:289/203;">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform hover:scale-105 duration-500" />
                            </a>
                            <div class="absolute top-3 left-3 flex gap-2 z-20">
                                <!-- Add to cart -->
                                <a href="?add-to-cart=<?php echo esc_attr( $product->get_id() ); ?>" data-quantity="1"
                                   class="bg-[#eedfcb] rounded-full w-10 h-10 flex items-center justify-center hover:opacity-90 transition-all shadow-sm add_to_cart_button ajax_add_to_cart relative"
                                   data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
                                   data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
                                   aria-label="Voeg toe aan winkelmand">
                                    <div class="cart-icon-wrapper flex items-center justify-center">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path d="M15.1875 3.375H2.8125C2.50184 3.375 2.25 3.62684 2.25 3.9375V14.0625C2.25 14.3732 2.50184 14.625 2.8125 14.625H15.1875C15.4982 14.625 15.75 14.3732 15.75 14.0625V3.9375C15.75 3.62684 15.4982 3.375 15.1875 3.375Z" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M11.8125 6.1875C11.8125 6.93342 11.5162 7.64879 10.9887 8.17624C10.4613 8.70368 9.74592 9 9 9C8.25408 9 7.53871 8.70368 7.01126 8.17624C6.48382 7.64879 6.1875 6.93342 6.1875 6.1875" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="loading-spinner absolute inset-0 flex items-center justify-center hidden">
                                        <svg class="animate-spin h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    </div>
                                </a>
                                <!-- Heart (pre-filled — always in wishlist on this page) -->
                                <a href="#"
                                   class="bg-[#eedfcb] rounded-full w-10 h-10 flex items-center justify-center hover:opacity-90 transition-all shadow-sm wishlist-btn group/heart active filled"
                                   data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
                                   title="Verwijder uit verlanglijst">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="#36221d" class="heart-svg transition-transform group-active/heart:scale-125">
                                        <path d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col gap-3 flex-1">
                            <div class="flex items-center gap-4 flex-wrap">
                                <?php if ( $formatted_price ) : ?>
                                <div class="font-['DM_Sans',sans-serif] text-[#36221d]">
                                    <span class="text-[18px]"><?php echo esc_html( $currency_symbol ); ?> </span>
                                    <span class="text-[22px] font-medium"><?php echo esc_html( $formatted_price ); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if ( $first_cat_name ) : ?>
                                <div class="border border-[rgba(0,0,0,0.3)] rounded-full px-4 py-1.5">
                                    <span class="font-['DM_Sans',sans-serif] text-[#061406] text-[13px]"><?php echo esc_html( $first_cat_name ); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="hover:underline">
                                <h3 class="font-kurversbrug font-light text-[#061406] text-[18px] sm:text-[20px] leading-snug"><?php the_title(); ?></h3>
                            </a>
                            <p class="font-sans text-black text-[15px] leading-relaxed flex-1 line-clamp-2"><?php echo wp_trim_words( strip_tags( $short_desc ), 15, '...' ); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

    <?php else: ?>

        <div class="avw-wl-empty">
            <h2 class="avw-wl-empty-title">Je verlanglijst is leeg</h2>
            <p class="avw-wl-empty-text">Klik op het hartje op een product om het toe te voegen aan je verlanglijst.</p>
            <a class="avw-wl-shop-btn" href="<?php echo wc_get_page_permalink('shop'); ?>">Bekijk ons assortiment</a>
        </div>

    <?php endif; ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // When a product is unfavorited on the wishlist page, animate it out
    jQuery(document.body).on('avw_fav_removed', function(e, productId) {
        var $wrap = jQuery('.avw-wl-card-wrap[data-product-id="' + productId + '"]');
        if (!$wrap.length) return;
        $wrap.addClass('removing');
        setTimeout(function() {
            $wrap.remove();
            var remaining = jQuery('.avw-wl-card-wrap').length;
            var $count = jQuery('#avw-wl-count');
            if (remaining === 0) {
                jQuery('#avw-wl-grid').replaceWith(
                    '<div class="avw-wl-empty"><h2 class="avw-wl-empty-title">Je verlanglijst is leeg</h2>' +
                    '<p class="avw-wl-empty-text">Klik op het hartje op een product om het toe te voegen aan je verlanglijst.</p>' +
                    '<a class="avw-wl-shop-btn" href="<?php echo wc_get_page_permalink('shop'); ?>">Bekijk ons assortiment</a></div>'
                );
                $count.hide();
            } else {
                $count.text(remaining + ' product' + (remaining !== 1 ? 'en' : '') + ' opgeslagen');
            }
        }, 350);
    });
});
</script>

<?php get_footer(); ?>
