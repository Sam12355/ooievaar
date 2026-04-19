<?php get_header(); ?>

    <!-- HERO SECTION -->
    <section id="hero" class="relative bg-black overflow-hidden" style="min-height:100vh;">
        <div class="hero-parallax-bg absolute">
                <img id="hero-parallax-img" src="<?php echo get_template_directory_uri(); ?>/assets/6addceefab5229029d4dc788a8a17c10ef6ba492.png"
                alt="Distilleerderij ketels" class="w-full h-full object-cover" style="opacity: 0.85; object-position: center 30%;" />
            <div class="absolute inset-0"
                style="background:linear-gradient(to bottom,rgba(0,0,0,0.3),rgba(0,0,0,0.1),rgba(0,0,0,0.4));">
            </div>
        </div>
        <div class="relative z-10 flex flex-col items-center justify-center px-4 sm:px-6 py-16 sm:py-24 text-center"
            style="min-height:100vh;">
            <div id="hero-logo" class="mb-6 sm:mb-8 flex flex-col items-center gap-4 sm:gap-6">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/e81e9bb1c2cefc530a3a2984d4da5347ec6b79d2.png" alt="A. van Wees Logo"
                    class="h-20 sm:h-28 md:h-30 w-auto object-contain" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/1ff51b370c5de41a1117b63b24aafe29f6ea1180.png"
                    alt="A. van Wees Distilleerderij De Ooievaar" class="h-28 sm:h-36 md:h-44 w-auto object-contain" />
            </div>
            <div class="max-w-[460px] px-2">
                <div id="hero-text-set">
                    <p class="font-sans text-white text-[16px] sm:text-[18px] md:text-[20px] leading-relaxed mb-4">
                        A. van Wees distilleerderij <br />'De Ooievaar' is de enig overgebleven, ambachtelijke
                        distilleerderij in Amsterdam.
                    </p>
                    <p class="font-sans text-white text-[16px] sm:text-[18px] md:text-[20px] leading-relaxed">
                        Gevestigd in het hart van de Jordaan, distilleren wij volgens authentieke receptuur.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCTS SECTION -->
    <section class="bg-[#e0cbb0] py-12 sm:py-16 md:py-20 px-4 sm:px-6">
        <div class="max-w-[1290px] mx-auto">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="font-kurversbrug text-[#36221d] text-[28px] sm:text-[36px] md:text-[42px] mb-4 sm:mb-6">Een Greep uit ons assortiment</h2>
                <p class="font-sans text-black text-[16px] sm:text-[18px] md:text-[20px] max-w-[810px] mx-auto leading-relaxed">
                    Door onze ambachtelijke manier van werken houden wij een traditie in stand die stamt uit de 16e
                    eeuw. Met de grote kennis van distilleren die in ons bedrijf aanwezig is en de liefde voor een edel
                    vak produceren wij Oudhollands gedistilleerd van unieke kwaliteit. Tegelijk ontwikkelen wij met oude
                    kennis nieuwe producten zoals een groentenlikeur.
                </p>
            </div>

            <!-- Fetch Products First -->
            <?php
            $found_categories = array();
            $loop = null;
            if ( class_exists( 'WooCommerce' ) ) {
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 6,
                    'post_status'    => 'publish',
                );
                $loop = new WP_Query( $args );

                if ( $loop->have_posts() ) {
                    foreach ( $loop->posts as $post ) {
                        $terms = get_the_terms( $post->ID, 'product_cat' );
                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                            foreach ( $terms as $term ) {
                                // Exclude 'uncategorized'
                                if ( $term->term_id != get_option('default_product_cat') ) {
                                    $found_categories[$term->term_id] = $term->name;
                                }
                            }
                        }
                    }
                }
                // Sort categories alphabetically
                asort($found_categories);
            }
            ?>

            <!-- Category filter – auto generated from the 6 products only -->
            <div class="flex justify-center mb-8 sm:mb-12">
                <div class="flex items-center justify-center flex-wrap border border-[#eedfcb] rounded-[32px] p-1.5 gap-1.5 max-w-full">
                    <button
                        class="category-btn px-4 sm:px-6 py-2 rounded-full text-[14px] sm:text-[16px] font-['DM_Sans',sans-serif] transition-all bg-[#eedfcb] text-[#031509] whitespace-nowrap"
                        data-category="Toon Alles">Toon Alles</button>
                    
                    <?php if ( ! empty( $found_categories ) ) : ?>
                        <?php foreach ( $found_categories as $cat_name ) : ?>
                            <button
                                class="category-btn px-4 sm:px-6 py-2 rounded-full text-[14px] sm:text-[16px] font-['DM_Sans',sans-serif] transition-all text-black whitespace-nowrap"
                                data-category="<?php echo esc_attr( $cat_name ); ?>"><?php echo esc_html( $cat_name ); ?></button>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Products grid (Dynamic from WooCommerce) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <?php
                if ( $loop && $loop->have_posts() ) {
                    while ( $loop->have_posts() ) : $loop->the_post();
                        $product = wc_get_product( get_the_ID() );
                        if ( ! $product ) continue;
                        
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
                                    <div class="absolute top-3 left-3 flex gap-2 z-20">
                                        <!-- Add to cart (Using original Bag Icon) -->
                                        <a href="?add-to-cart=<?php echo esc_attr( $product->get_id() ); ?>" data-quantity="1" class="bg-[#eedfcb] rounded-full w-10 h-10 flex items-center justify-center hover:opacity-90 transition-all shadow-sm add_to_cart_button ajax_add_to_cart relative" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" aria-label="Voeg toe aan winkelmand">
                                            <div class="cart-icon-wrapper flex items-center justify-center">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" class="cart-svg">
                                                    <path d="M15.1875 3.375H2.8125C2.50184 3.375 2.25 3.62684 2.25 3.9375V14.0625C2.25 14.3732 2.50184 14.625 2.8125 14.625H15.1875C15.4982 14.625 15.75 14.3732 15.75 14.0625V3.9375C15.75 3.62684 15.4982 3.375 15.1875 3.375Z" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M11.8125 6.1875C11.8125 6.93342 11.5162 7.64879 10.9887 8.17624C10.4613 8.70368 9.74592 9 9 9C8.25408 9 7.53871 8.70368 7.01126 8.17624C6.48382 7.64879 6.1875 6.93342 6.1875 6.1875" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <div class="loading-spinner absolute inset-0 flex items-center justify-center hidden">
                                                <svg class="animate-spin h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                            </div>
                                        </a>
                                        <!-- Heart Icon (Favorieten) -->
                                        <?php $is_fav = avw_is_favorited(get_the_ID()); ?>
                                        <a href="#" class="bg-[#eedfcb] rounded-full w-10 h-10 flex items-center justify-center hover:opacity-90 transition-all shadow-sm wishlist-btn group/heart <?php echo $is_fav ? 'active filled' : ''; ?>" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" title="Voeg toe aan favorieten">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" class="heart-svg transition-transform group-active/heart:scale-125" style="<?php echo $is_fav ? 'fill:#36221d;' : ''; ?>">
                                                <path d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
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
                ?>
            </div>

            <div class="flex justify-center mt-10 sm:mt-14">
                <a href="<?php echo esc_url( home_url( '/assortment/' ) ); ?>"
                    class="rounded-[34px] px-8 sm:px-10 py-3 sm:py-4 text-white font-kurversbrug text-[16px] sm:text-[18px] hover:opacity-90 transition-opacity"
                    style="background:linear-gradient(90deg,rgba(0,0,0,0.2),rgba(0,0,0,0.2)),#432B25; display:inline-block;">
                    Naar de WEBWINKEL
                </a>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="bg-[#eedfcb] py-12 sm:py-16 md:py-20 px-4 sm:px-6 overflow-hidden">
        <div class="max-w-[1440px] mx-auto">
            <!-- Mobile: stacked images + text -->
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 md:gap-12">
                <!-- Left Image -->
                <div class="w-full sm:w-3/4 mx-auto lg:mx-0 lg:w-1/4 lg:pt-32">
                    <!-- Mobile: image moves inside frame -->
                    <div class="lg:hidden w-full h-[280px] sm:h-[360px] overflow-hidden rounded-[32px] sm:rounded-[40px] shadow-2xl relative">
                        <img id="about-img-left-mobile" src="<?php echo get_template_directory_uri(); ?>/assets/50e5b20ef3bab8e3ecb95301d6e6a59cb7610770.png" alt="Distilleerderij"
                            class="absolute left-0 right-0 w-full h-[130%] object-cover" style="top:-15%;" />
                    </div>
                    <!-- Desktop: original free-moving parallax -->
                    <img id="about-img-left" src="<?php echo get_template_directory_uri(); ?>/assets/50e5b20ef3bab8e3ecb95301d6e6a59cb7610770.png" alt="Distilleerderij"
                        class="hidden lg:block w-full h-[450px] object-cover rounded-[40px] shadow-2xl" />
                </div>

                <!-- Center Content -->
                <div class="w-full lg:w-1/2 flex flex-col items-center text-center gap-6 sm:gap-10">
                    <h2 class="font-kurversbrug font-light text-[#36221d] text-[28px] sm:text-[36px] md:text-[42px] lg:text-[48px] leading-[1.1] uppercase tracking-tight">
                        Honderden ambachtelijke dranken rechtstreeks uit onze Amsterdamse distilleerderij
                    </h2>
                    <div class="font-sans text-black text-[16px] sm:text-[18px] md:text-[20px] leading-relaxed max-w-[620px]">
                        <p class="mb-4">
                            A.van Wees anno 1883 distilleerderij de Ooievaar anno 1782 omvat de enig overgebleven,
                            ambachtelijke distilleerderij in Amsterdam. U vindt ons in de Driehoekstraat in het hart van de Jordaan.
                        </p>
                        <p>
                            We distilleren producten met natuurlijke ingrediënten, op basis van oorspronkelijke receptuur – en dat proeft u.
                            Onze specialiteiten? Tongstrelende Oudhollandse genevers en likeuren.
                        </p>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="w-full sm:w-3/4 mx-auto lg:mx-0 lg:w-1/4 lg:pt-0">
                    <!-- Mobile: image moves inside frame -->
                    <div class="lg:hidden w-full h-[280px] sm:h-[360px] overflow-hidden rounded-[32px] sm:rounded-[40px] shadow-2xl relative">
                        <img id="about-img-right-mobile" src="<?php echo get_template_directory_uri(); ?>/assets/2598b498148e6540a6572d998fa86bee0e7a8b8e.png" alt="Distilleerderij Amsterdam"
                            class="absolute left-0 right-0 w-full h-[130%] object-cover" style="top:-15%;" />
                    </div>
                    <!-- Desktop: original free-moving parallax -->
                    <img id="about-img-right" src="<?php echo get_template_directory_uri(); ?>/assets/2598b498148e6540a6572d998fa86bee0e7a8b8e.png" alt="Distilleerderij Amsterdam"
                        class="hidden lg:block w-full h-[450px] object-cover rounded-[40px] shadow-2xl" />
                </div>
            </div>

            <!-- Button Row -->
            <div class="flex justify-center mt-10 sm:mt-12">
                <button
                    class="rounded-full px-8 sm:px-12 py-4 sm:py-5 text-white font-kurversbrug text-[14px] sm:text-[16px] uppercase tracking-widest hover:brightness-110 transition-all shadow-lg"
                    style="background-color: #36221d;">
                    Lees meer over de distilleerderij
                </button>
            </div>
        </div>
    </section>

    <!-- NEWS SECTION -->
    <section class="bg-[#e0cbb0] py-12 sm:py-16 md:py-20 px-4 sm:px-6">
        <div class="max-w-[1290px] mx-auto">
            <div class="text-center mb-10 sm:mb-14">
                <h2 class="font-kurversbrug text-[#36221d] text-[28px] sm:text-[36px] md:text-[42px] lg:text-[46px] mb-3 sm:mb-4">Laatste Nieuws</h2>
                <p class="font-sans text-black text-[16px] sm:text-[18px] md:text-[20px] leading-relaxed">Lees hier de laatste nieuwtjes over de oudste distillerderij van Amsterdam</p>
            </div>
            <div class="flex flex-col md:flex-row gap-6 sm:gap-8 mb-10 sm:mb-14">
                <!-- News card 1 -->
                <div class="rounded-[20px] overflow-hidden relative cursor-pointer group flex-1">
                    <div class="relative overflow-hidden" style="height:260px; min-height:220px;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/2598b498148e6540a6572d998fa86bee0e7a8b8e.png" alt="Kleine distilleerderijen"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <div class="absolute inset-0"
                            style="background:linear-gradient(to bottom,rgba(21,27,49,0.15),rgba(28,63,58,0.4));"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="font-kurversbrug text-white text-[18px] sm:text-[20px] leading-snug mb-4 sm:mb-6">Kleine distilleerderijen – Gastblog Marketing Tribune</h3>
                            <div class="flex items-center gap-2">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <circle cx="6" cy="6" r="5.8125" stroke="rgba(255,255,255,0.68)" stroke-width="0.375" />
                                    <path d="M6 2.625V6L8.10938 6.99609" stroke="rgba(255,255,255,0.68)" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span class="font-['DM_Sans',sans-serif] text-[rgba(255,255,255,0.68)] text-[13px]">15/08/2023</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- News card 2 -->
                <div class="rounded-[20px] overflow-hidden relative cursor-pointer group flex-1">
                    <div class="relative overflow-hidden" style="height:260px; min-height:220px;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/409a5a74866028f1506810bb78de0eda68ebce8e.png" alt="Werkbezoek aan Japan"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <div class="absolute inset-0"
                            style="background:linear-gradient(to bottom,rgba(21,27,49,0.15),rgba(28,63,58,0.4));"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="font-kurversbrug text-white text-[18px] sm:text-[20px] leading-snug mb-4 sm:mb-6">Werkbezoek aan Japan</h3>
                            <div class="flex items-center gap-2">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <circle cx="6" cy="6" r="5.8125" stroke="rgba(255,255,255,0.68)" stroke-width="0.375" />
                                    <path d="M6 2.625V6L8.10938 6.99609" stroke="rgba(255,255,255,0.68)" stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span class="font-['DM_Sans',sans-serif] text-[rgba(255,255,255,0.68)] text-[13px]">15/08/2023</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <button
                    class="rounded-[121px] px-6 sm:px-8 py-3 sm:py-4 text-white font-kurversbrug text-[16px] sm:text-[18px] hover:opacity-90 transition-opacity"
                    style="background:linear-gradient(90deg,rgba(0,0,0,0.2),rgba(0,0,0,0.2)),#432B25;">
                    Lees Alle nieuwsartikelen
                </button>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
