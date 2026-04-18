<?php
header('X-AVW-Template: archive-product');
defined( 'ABSPATH' ) || exit;
?>
<?php get_header(); ?>

<!-- ASSORTMENT HERO -->
<section class="relative bg-black pt-28 pb-16 sm:pt-36 sm:pb-20 px-4 sm:px-6">
    <div class="max-w-[800px] mx-auto text-center relative z-10">
        <h1 id="ajax-page-title" class="font-kurversbrug text-[#eedfcb] text-[36px] sm:text-[48px] md:text-[56px] mb-4 sm:mb-6"><?php woocommerce_page_title(); ?></h1>
        <p id="ajax-page-description" class="font-sans text-white text-[16px] sm:text-[18px] md:text-[20px] leading-relaxed opacity-90">
            Ontdek onze uitgebreide collectie ambachtelijk gedistilleerde Oudhollandse genevers, likeuren, bitters en esprits. Gemaakt in het hart van Amsterdam volgens authentieke receptuur.
        </p>
    </div>
</section>

<!-- PRODUCTS SECTION -->
<section class="bg-[#e0cbb0] py-12 sm:py-16 md:py-20 px-4 sm:px-6 min-h-[50vh]">
    <div class="max-w-[1400px] mx-auto flex flex-col lg:flex-row gap-8 lg:gap-12">
        
        <!-- SIDEBAR -->
        <div class="w-full lg:w-[320px] flex-shrink-0">
            <div class="bg-[#eedfcb] rounded-[32px] p-6 sm:p-8 woo-custom-sidebar">
                
                <!-- Custom Search -->
                <div class="widget mb-6 lg:mb-8 pb-6 lg:pb-8 border-b border-[#36221d]/10">
                    <h3 class="font-kurversbrug text-[22px] sm:text-[26px] text-[#36221d] mb-4 lg:mb-5">Zoeken</h3>
                    <div id="ajax-search-container" class="flex w-full relative">
                        <input type="text" id="ajax-search-input" class="w-full bg-white/50 border border-[#36221d]/20 rounded-[20px] py-3 pl-5 pr-12 outline-none font-sans text-black focus:border-[#36221d] transition-colors" placeholder="Zoek producten&hellip;" value="<?php echo get_search_query(); ?>" autocomplete="off" />
                        <div id="ajax-search-btn" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-[#36221d] hover:opacity-70 transition-opacity cursor-pointer">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </div>
                    </div>
                </div>

                <!-- Custom Categories -->
                <div class="widget mb-6 lg:mb-8 pb-6 lg:pb-8 border-b border-[#36221d]/10">
                    <h3 class="font-kurversbrug text-[22px] sm:text-[26px] text-[#36221d] mb-4 lg:mb-5">Categorieën</h3>
                    <div id="ajax-categories-container">
                    <?php
                    if (!function_exists('avw_render_category_tree')) {
                        function avw_render_category_tree($parent_id = 0, $depth = 0) {
                            $terms = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true, 'parent' => $parent_id ) );
                            if ( empty($terms) || is_wp_error($terms) ) return;

                            echo '<ul class="flex flex-col gap-2 m-0 p-0 ' . ($depth > 0 ? 'ml-6 mt-2' : '') . '" style="list-style:none;">';
                            foreach ( $terms as $term ) {
                                if ( $term->term_id == get_option('default_product_cat') ) continue;
                                
                                $children = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true, 'parent' => $term->term_id ) );
                                $has_children = ! empty($children) && ! is_wp_error($children);
                                
                                $link = get_term_link( $term );
                                $is_active = ( is_product_category( $term->term_id ) || (is_product() && has_term($term->term_id, 'product_cat')) ) ? 'bg-[#36221d] text-white border-transparent' : 'bg-white/40 hover:bg-white text-[#36221d] border border-transparent';
                                
                                echo '<li style="margin:0;" class="relative">';
                                echo '<div class="flex items-center gap-1">';
                                echo '<a href="' . esc_url( $link ) . '" class="ajax-link block rounded-[16px] px-5 py-3 font-sans text-[15px] font-medium transition-colors flex-1 ' . $is_active . '" style="text-decoration:none;">' . esc_html( $term->name ) . '</a>';
                                
                                if ( $has_children ) {
                                    echo '<button type="button" class="cat-toggle p-2 hover:bg-black/5 rounded-full transition-colors" data-target="cat-' . $term->term_id . '">';
                                    echo '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="transition-transform duration-300" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
                                    echo '</button>';
                                }
                                echo '</div>';
                                
                                if ( $has_children ) {
                                    $expanded = false;
                                    $current_obj = get_queried_object();
                                    if ( is_a($current_obj, 'WP_Term') ) {
                                        $ancestors = get_ancestors( $current_obj->term_id, 'product_cat' );
                                        if ( in_array( $term->term_id, $ancestors ) || $current_obj->term_id == $term->term_id ) {
                                            $expanded = true;
                                        }
                                    }
                                    echo '<div id="cat-' . $term->term_id . '" class="' . ($expanded ? '' : 'hidden') . '">';
                                    avw_render_category_tree( $term->term_id, $depth + 1 );
                                    echo '</div>';
                                }
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                    }
                    avw_render_category_tree();
                    ?>
                    </div>
                </div>

                <!-- Price Filter (Custom AJAX) -->
                <div class="widget">
                    <h3 class="font-kurversbrug text-[22px] sm:text-[26px] text-[#36221d] mb-4 lg:mb-5">Filter op prijs</h3>
                    <div class="price-filter-wrapper space-y-4" data-v="2.0">
                        <div class="flex items-center gap-4">
                            <div class="relative flex-1">
                                <label for="min_price_input" class="block text-[11px] uppercase tracking-widest text-[#36221d]/60 mb-1.5 ml-1 font-bold">Vanaf</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[#36221d]/50 text-sm">€</span>
                                    <input type="number" id="min_price_input" class="ajax-price-input w-full bg-white border border-[#36221d]/10 rounded-[12px] py-3 pl-8 pr-3 outline-none font-sans text-[16px] focus:border-[#36221d] focus:ring-1 focus:ring-[#36221d]/20 transition-all shadow-sm" placeholder="0" value="<?php echo isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : ''; ?>" />
                                </div>
                            </div>
                            <div class="relative flex-1">
                                <label for="max_price_input" class="block text-[11px] uppercase tracking-widest text-[#36221d]/60 mb-1.5 ml-1 font-bold">Tot</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[#36221d]/50 text-sm">€</span>
                                    <input type="number" id="max_price_input" class="ajax-price-input w-full bg-white border border-[#36221d]/10 rounded-[12px] py-3 pl-8 pr-3 outline-none font-sans text-[16px] focus:border-[#36221d] focus:ring-1 focus:ring-[#36221d]/20 transition-all shadow-sm" placeholder="1000" value="<?php echo isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : ''; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                .price_slider_amount button.button {
                    display: none !important;
                }
                .price_slider_amount .price_label {
                    font-size: 15px !important;
                    font-weight: 500;
                    color: #36221d;
                }
                input[type="text"]::-webkit-search-cancel-button {
                    display: none;
                }
                </style>
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function doAjaxLoad(url, pushHistory = true) {
                        let grid = document.getElementById('ajax-products-container');
                        if (grid) grid.style.opacity = '0.5';

                        if (pushHistory) window.history.pushState(null, '', url);

                        fetch(url)
                            .then(r => {
                                console.log('Response Header X-AVW-Template:', r.headers.get('X-AVW-Template'));
                                return r.text();
                            })
                            .then(html => {
                                let parser = new DOMParser();
                                let doc = parser.parseFromString(html, 'text/html');

                                console.log('========== AVW SEARCH DEBUG ==========');
                                console.log('1. Fetched URL:', url.toString());

                                let docGrid = doc.getElementById('ajax-products-container');
                                if (!docGrid) {
                                    console.error('2. ERROR: The server did not return #ajax-products-container! It might be loading the wrong template.');
                                    console.log('First 500 chars of response:', html.substring(0, 500));
                                } else {
                                    let productTitles = docGrid.querySelectorAll('.product-card h3');
                                    console.log('2. SUCCESS: Server returned', productTitles.length, 'products for this search.');
                                    let titleArray = [];
                                    productTitles.forEach(t => titleArray.push(t.innerText.trim()));
                                    console.log('3. Product Names Returned:', titleArray);

                                    let testSqlEncoded = docGrid.getAttribute('data-sql');
                                    try {
                                        console.log('4. SERVER EXECUTED SQL:', atob(testSqlEncoded));
                                    } catch(e) {
                                        console.log('4. SERVER EXECUTED SQL (Raw):', testSqlEncoded);
                                    }

                                    if (grid) {
                                        grid.innerHTML = docGrid.innerHTML;
                                        grid.setAttribute('data-sql', testSqlEncoded);
                                    }
                                }

                                let pagination = document.getElementById('ajax-pagination-container');
                                let docPagination = doc.getElementById('ajax-pagination-container');
                                if (pagination && docPagination) pagination.innerHTML = docPagination.innerHTML;

                                let categories = document.getElementById('ajax-categories-container');
                                let docCategories = doc.getElementById('ajax-categories-container');
                                if (categories && docCategories) categories.innerHTML = docCategories.innerHTML;

                                let pageTitle = document.getElementById('ajax-page-title');
                                let docPageTitle = doc.getElementById('ajax-page-title');
                                if (pageTitle && docPageTitle) pageTitle.innerHTML = docPageTitle.innerHTML;

                                let pageDesc = document.getElementById('ajax-page-description');
                                let docPageDesc = doc.getElementById('ajax-page-description');
                                if (pageDesc && docPageDesc) pageDesc.innerHTML = docPageDesc.innerHTML;

                                if (grid) grid.style.opacity = '1';

                                rebindDynamicEvents();
                            })
                            .catch(err => {
                                console.error('AJAX Error:', err);
                                if (grid) grid.style.opacity = '1';
                            });
                    }

                    function rebindDynamicEvents() {
                        document.querySelectorAll('a.ajax-link, #ajax-pagination-container a').forEach(el => {
                            el.addEventListener('click', e => {
                                e.preventDefault();
                                doAjaxLoad(el.href);
                            });
                        });

                        document.querySelectorAll('.cat-toggle').forEach(btn => {
                            btn.addEventListener('click', e => {
                                e.preventDefault();
                                e.stopPropagation();
                                let targetId = btn.getAttribute('data-target');
                                let target = document.getElementById(targetId);
                                let svg = btn.querySelector('svg');
                                if(target) {
                                    target.classList.toggle('hidden');
                                    if(svg) {
                                        svg.style.transform = target.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
                                    }
                                }
                            });
                        });
                        
                        let searchCont = document.getElementById('ajax-search-container');
                        if(searchCont && !searchCont.dataset.bound) {
                            
                            function triggerSearch() {
                                let url = new URL(window.location.href.split('?')[0] + window.location.search);
                                url.search = ''; // wipe current query params
                                let searchVal = document.getElementById('ajax-search-input').value;
                                if(searchVal) {
                                    url.searchParams.set('s', searchVal);
                                    url.searchParams.set('post_type', 'product');
                                    url.searchParams.set('avw_ajax', '1');
                                }
                                doAjaxLoad(url.toString(), false);
                            }

                            let searchBtn = document.getElementById('ajax-search-btn');
                            if(searchBtn) {
                                searchBtn.addEventListener('click', triggerSearch);
                            }

                            let searchInput = document.getElementById('ajax-search-input');
                            if (searchInput) {
                                let searchTimeout;
                                searchInput.addEventListener('input', function() {
                                    clearTimeout(searchTimeout);
                                    searchTimeout = setTimeout(triggerSearch, 500);
                                });
                                // Handle Enter key manually
                                searchInput.addEventListener('keydown', function(e) {
                                    if(e.key === 'Enter') {
                                        e.preventDefault();
                                        triggerSearch();
                                    }
                                });
                            }

                            searchCont.dataset.bound = "true";
                        }
                    }

                    window.addEventListener('popstate', (e) => {
                        // If we are currently in an AJax search, don't let popstate trigger a reload
                        if (window.location.search.includes('s=')) {
                            doAjaxLoad(window.location.href, false);
                        } else {
                            doAjaxLoad(window.location.href, false);
                        }
                    });

                    // DEBUG RELOAD HIJACKER
                    window.addEventListener('beforeunload', (e) => {
                        if (document.activeElement && document.activeElement.id === 'ajax-search-input') {
                           console.log('RELOAD ATTEMPTED BY EXTERNAL SCRIPT');
                           // e.preventDefault(); // Uncomment only if desperately needed as it shows a browser popup
                        }
                    });

                    rebindDynamicEvents();

                    if (typeof jQuery !== 'undefined') {
                        jQuery(document.body).on('price_slider_change', function(event, min, max) {
                            var form = jQuery('.price-filter-wrapper form');
                            if(form.length) {
                                clearTimeout(window.wooPriceFilterTimeout);
                                window.wooPriceFilterTimeout = setTimeout(function() {
                                    let url = new URL(window.location.href);
                                    url.searchParams.set('min_price', jQuery(form).find('input[name="min_price"]').val());
                                    url.searchParams.set('max_price', jQuery(form).find('input[name="max_price"]').val());
                                    doAjaxLoad(url.toString());
                                }, 600);
                            }
                        });
                    }

                    // Handle Manual Price Inputs
                    let priceInputs = document.querySelectorAll('.ajax-price-input');
                    let priceTimeout;
                    priceInputs.forEach(input => {
                        input.addEventListener('input', () => {
                            clearTimeout(priceTimeout);
                            priceTimeout = setTimeout(() => {
                                let url = new URL(window.location.href);
                                let min = document.getElementById('min_price_input').value;
                                let max = document.getElementById('max_price_input').value;
                                if (min) url.searchParams.set('min_price', min); else url.searchParams.delete('min_price');
                                if (max) url.searchParams.set('max_price', max); else url.searchParams.delete('max_price');
                                doAjaxLoad(url.toString());
                            }, 800);
                        });
                    });
                });
                </script>

            </div>
        </div>

        <!-- PRODUCTS GRID -->
        <div class="flex-1">
            <div id="ajax-products-container" data-sql="<?php global $wp_query; echo base64_encode(isset($wp_query->request) ? $wp_query->request : 'no query'); ?>" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 sm:gap-8 mb-12 transition-opacity duration-300">
                <?php
                if ( have_posts() ) {
                    while ( have_posts() ) : the_post();
                        $product = wc_get_product( get_the_ID() );
                        if ( ! $product ) continue;
                        
                        $terms = get_the_terms( get_the_ID(), 'product_cat' );
                        $first_cat_name = '';

                        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                            foreach ( $terms as $term ) {
                                if ( $term->term_id != get_option('default_product_cat') ) {
                                    if ( empty( $first_cat_name ) ) {
                                        $first_cat_name = $term->name;
                                    }
                                }
                            }
                        }
                        
                        $img_url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : wc_placeholder_img_src();
                        $currency_symbol = get_woocommerce_currency_symbol();
                        $raw_price = wc_get_price_to_display( $product );
                        $formatted_price = $raw_price ? number_format_i18n( $raw_price, 2 ) : '';
                        ?>
                        <div class="product-card bg-[#eedfcb] rounded-[24px] sm:rounded-[32px] p-5 sm:p-8 flex flex-col">
                            <div class="relative rounded-[18px] sm:rounded-[24px] overflow-hidden mb-5 sm:mb-8 bg-white" style="aspect-ratio:289/203;">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform hover:scale-105 duration-500" />
                                </a>
                                <div class="absolute top-3 left-3 flex gap-2">
                                    <a href="<?php the_permalink(); ?>" class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm" title="Bekijk details">
                                        <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                            <path d="M15.1875 3.375H2.8125C2.50184 3.375 2.25 3.62684 2.25 3.9375V14.0625C2.25 14.3732 2.50184 14.625 2.8125 14.625H15.1875C15.4982 14.625 15.75 14.3732 15.75 14.0625V3.9375C15.75 3.62684 15.4982 3.375 15.1875 3.375Z" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M11.8125 6.1875C11.8125 6.93342 11.5162 7.64879 10.9887 8.17624C10.4613 8.70368 9.74592 9 9 9C8.25408 9 7.53871 8.70368 7.01126 8.17624C6.48382 7.64879 6.1875 6.93342 6.1875 6.1875" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
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
                } else {
                    echo '<p class="text-center w-full col-span-full font-sans text-lg">Geen producten gevonden die aan uw criteria voldoen.</p>';
                }
                ?>
            </div>
            
            <!-- PAGINATION -->
            <div id="ajax-pagination-container">
            <?php if ( have_posts() ) : ?>
            <div class="flex justify-center woo-pagination mt-10 font-sans">
                <?php
                echo paginate_links( array(
                    'prev_text' => '&larr; Vorige',
                    'next_text' => 'Volgende &rarr;',
                    'type'      => 'list',
                ) );
                ?>
            </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
