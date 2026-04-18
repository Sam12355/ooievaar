<?php
/* Template Name: Assortment Page */
get_header(); ?>

<!-- ASSORTMENT HERO -->
<section class="relative bg-black pt-28 pb-16 sm:pt-36 sm:pb-20 px-4 sm:px-6">
    <div class="max-w-[800px] mx-auto text-center relative z-10">
        <h1 class="font-kurversbrug text-[#eedfcb] text-[36px] sm:text-[48px] md:text-[56px] mb-4 sm:mb-6">Ons Assortiment</h1>
        <p class="font-sans text-white text-[16px] sm:text-[18px] md:text-[20px] leading-relaxed opacity-90">
            Ontdek onze uitgebreide collectie ambachtelijk gedistilleerde Oudhollandse genevers, likeuren, bitters en esprits. Gemaakt in het hart van Amsterdam volgens authentieke receptuur.
        </p>
    </div>
</section>

<!-- PRODUCTS SECTION -->
<section class="bg-[#e0cbb0] py-12 sm:py-16 md:py-20 px-4 sm:px-6 min-h-[50vh]">
    <div class="max-w-[1290px] mx-auto">
        <!-- Category filter – scrollable on mobile -->
        <?php
        $categories = get_terms( array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'exclude'    => array( get_option( 'default_product_cat' ) )
        ) );
        ?>
        <div class="flex justify-center mb-10 sm:mb-16">
            <div class="flex items-center justify-center flex-wrap border border-[#eedfcb] rounded-[32px] p-1.5 gap-1.5 max-w-full">
                <button
                    class="category-btn px-4 sm:px-6 py-2 rounded-full text-[14px] sm:text-[16px] font-['DM_Sans',sans-serif] transition-all bg-[#eedfcb] text-[#031509] whitespace-nowrap"
                    data-category="Toon Alles">Toon Alles</button>
                
                <?php if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) : ?>
                    <?php foreach ( $categories as $category ) : ?>
                        <button
                            class="category-btn px-4 sm:px-6 py-2 rounded-full text-[14px] sm:text-[16px] font-['DM_Sans',sans-serif] transition-all text-black whitespace-nowrap"
                            data-category="<?php echo esc_attr( $category->name ); ?>"><?php echo esc_html( $category->name ); ?></button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Products grid (Dynamic from WooCommerce, all products) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <?php
            if ( class_exists( 'WooCommerce' ) ) {
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => -1, // No limit on the assortment page
                    'post_status'    => 'publish',
                    'orderby'        => 'title',
                    'order'          => 'ASC'
                );
                $loop = new WP_Query( $args );

                if ( $loop->have_posts() ) {
                    while ( $loop->have_posts() ) : $loop->the_post();
                        global $product;
                        
                        $terms = get_the_terms( get_the_ID(), 'product_cat' );
                        $cat_names = array();
                        $first_cat_name = '';

                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                            foreach ( $terms as $term ) {
                                if ( $term->term_id != get_option('default_product_cat') ) {
                                    $cat_names[] = $term->name;
                                    if ( empty( $first_cat_name ) ) {
                                        $first_cat_name = $term->name;
                                    }
                                }
                            }
                        }
                        $cat_list_str = implode(',', $cat_names);
                        
                        $img_url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : wc_placeholder_img_src();
                        $currency_symbol = get_woocommerce_currency_symbol();
                        $raw_price = wc_get_price_to_display( $product );
                        $formatted_price = $raw_price ? number_format_i18n( $raw_price, 2 ) : '';
                        ?>
                        <div class="product-card bg-[#eedfcb] rounded-[24px] sm:rounded-[32px] p-5 sm:p-8 flex flex-col" data-category="<?php echo esc_attr( $cat_list_str ); ?>">
                            <div class="relative rounded-[18px] sm:rounded-[24px] overflow-hidden mb-5 sm:mb-8 bg-white" style="aspect-ratio:289/203;">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform hover:scale-105 duration-500" />
                                </a>
                                <div class="absolute top-3 left-3 flex gap-2">
                                    <!-- View product icon -->
                                    <a href="<?php the_permalink(); ?>" class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm" title="Bekijk details">
                                        <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                            <path d="M15.1875 3.375H2.8125C2.50184 3.375 2.25 3.62684 2.25 3.9375V14.0625C2.25 14.3732 2.50184 14.625 2.8125 14.625H15.1875C15.4982 14.625 15.75 14.3732 15.75 14.0625V3.9375C15.75 3.62684 15.4982 3.375 15.1875 3.375Z" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M11.8125 6.1875C11.8125 6.93342 11.5162 7.64879 10.9887 8.17624C10.4613 8.70368 9.74592 9 9 9C8.25408 9 7.53871 8.70368 7.01126 8.17624C6.48382 7.64879 6.1875 6.93342 6.1875 6.1875" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <!-- Add to cart -->
                                    <a href="?add-to-cart=<?php echo esc_attr( $product->get_id() ); ?>" data-quantity="1" class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" title="In winkelmand">
                                        <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                            <path d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="flex flex-col gap-3 flex-1">
                                <div class="flex items-center gap-4 flex-wrap">
                                    <?php if ( $formatted_price ) : ?>
                                    <div class="font-['DM_Sans',sans-serif] text-[#36221d]"><span class="text-[18px]"><?php echo esc_html( $currency_symbol ); ?> </span><span class="text-[22px] font-medium"><?php echo esc_html( $formatted_price ); ?></span></div>
                                    <?php endif; ?>
                                    <?php if ( $first_cat_name ) : ?>
                                    <div class="border border-[rgba(0,0,0,0.3)] rounded-full px-4 py-1.5"><span class="font-['DM_Sans',sans-serif] text-[#061406] text-[13px]"><?php echo esc_html( $first_cat_name ); ?></span></div>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="hover:underline">
                                    <h3 class="font-kurversbrug font-light text-[#061406] text-[18px] sm:text-[20px] leading-snug"><?php the_title(); ?></h3>
                                </a>
                                <?php 
                                $desc = $product->get_short_description();
                                if ( empty( $desc ) ) $desc = get_the_excerpt();
                                ?>
                                <p class="font-sans text-black text-[15px] leading-relaxed flex-1 line-clamp-2"><?php echo wp_trim_words( strip_tags( $desc ), 15, '...' ); ?></p>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                } else {
                    echo '<p class="text-center w-full col-span-full">Geen producten gevonden.</p>';
                }
            } else {
                echo '<p class="text-center w-full col-span-full">WooCommerce is niet geactiveerd.</p>';
            }
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
