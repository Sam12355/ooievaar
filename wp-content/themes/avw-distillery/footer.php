    <!-- FOOTER -->
    <footer class="bg-black py-10 sm:py-14 px-4 sm:px-6">
        <div class="max-w-[1380px] mx-auto">
            <!-- Top Row: responsive grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 sm:gap-10 mb-10 sm:mb-12">
                <?php
                // Helper: resolve a page URL by trying multiple slug candidates
                function avw_page_url( $slugs, $fallback = '' ) {
                    foreach ( (array) $slugs as $slug ) {
                        $page = get_page_by_path( $slug );
                        if ( $page ) return get_permalink( $page->ID );
                    }
                    return $fallback ?: home_url( '/' );
                }
                $footer_links = array(
                    'De Distilleerderij' => avw_page_url( array('distilleerderij','de-distilleerderij') ),
                    'Producten'          => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/nl/assortiment/'),
                    'Beleef'             => avw_page_url( array('beleef') ),
                    'Kennis'             => avw_page_url( array('kennis') ),
                    'Webwinkel'          => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/nl/assortiment/'),
                    'Blog &amp; Nieuws'  => get_post_type_archive_link('avw_nieuws') ?: avw_page_url( array('nieuws') ),
                );
                $account_links = array(
                    'Mijn Account'       => function_exists('wc_get_account_endpoint_url') ? wc_get_account_endpoint_url('dashboard') : home_url('/mijn-account/'),
                    'Mijn Mandje'        => function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/mandje/'),
                    'Veelgestelde Vragen'=> avw_page_url( array('veelgestelde-vragen','faq') ),
                );
                ?>
                <!-- Col 1: Snelle Links -->
                <div>
                    <h4 class="font-kurversbrug font-light text-[#cdbca6] text-[14px] sm:text-[16px] uppercase tracking-wider mb-4 sm:mb-6">Snelle Links</h4>
                    <ul class="space-y-2">
                        <?php foreach ( $footer_links as $label => $url ) : ?>
                        <li class="flex items-center gap-2"><span class="text-white text-[10px]">•</span><a href="<?php echo esc_url( $url ); ?>" class="font-kurversbrug font-light text-white text-[14px] sm:text-[16px] hover:text-[#cdbca6] transition-colors"><?php echo $label; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Col 2: Secondary Links -->
                <div>
                    <h4 class="font-kurversbrug font-light text-[#cdbca6] text-[14px] sm:text-[16px] uppercase tracking-wider mb-4 sm:mb-6">Mijn Account</h4>
                    <ul class="space-y-2">
                        <?php foreach ( $account_links as $label => $url ) : ?>
                        <li class="flex items-center gap-2"><span class="text-white text-[10px]">•</span><a href="<?php echo esc_url( $url ); ?>" class="font-kurversbrug font-light text-white text-[14px] sm:text-[16px] hover:text-[#cdbca6] transition-colors"><?php echo esc_html( $label ); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Col 3: Center Coat of Arms – hidden on smallest screens, shown from md -->
                <div class="hidden md:flex flex-col items-center justify-center col-span-1">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/590ed2894b8d6991ed96b73ae5ac054c171d6896.png" alt="Wapen van Amsterdam"
                        class="h-36 sm:h-44 w-auto object-contain" />
                </div>

                <!-- Col 4: Contact Info -->
                <div>
                    <h4 class="font-kurversbrug font-light text-[#cdbca6] text-[14px] sm:text-[16px] uppercase tracking-wider mb-4 sm:mb-6">Contact Info</h4>
                    <address class="font-sans text-white text-[14px] sm:text-[15px] not-italic leading-relaxed">
                        Slijterij de Ooievaar<br />
                        Driehoekstraat 10<br />
                        1015 GL Amsterdam<br />
                        Tel: +3120-626 77 52
                    </address>
                </div>

                <!-- Col 5: Newsletter -->
                <div class="col-span-2 md:col-span-1">
                    <h4 class="font-kurversbrug font-light text-[#cdbca6] text-[14px] sm:text-[16px] uppercase tracking-wider mb-4 sm:mb-6">Abonneer op onze nieuwsbrief</h4>
                    <div class="flex flex-col gap-3">
                        <div class="border border-white rounded-full px-5 py-3 flex items-center">
                            <input type="email" id="newsletter-email" placeholder="Email"
                                class="bg-transparent text-white text-[14px] sm:text-[15px] font-sans outline-none w-full" />
                        </div>
                        <button
                            class="border border-white rounded-full px-6 py-3 text-white font-kurversbrug font-light text-[14px] sm:text-[15px] uppercase tracking-wider hover:bg-white hover:text-black transition-all">
                            Abonneer
                        </button>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-[rgba(224,203,176,0.2)] my-6 sm:my-8"></div>

            <!-- Bottom Row: Social + Copyright -->
            <div class="flex flex-col items-center gap-5 sm:gap-6">
                <div class="flex items-center gap-3 sm:gap-4">
                    <!-- Facebook -->
                    <a href="#" aria-label="Facebook" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#e0cbb0] flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#432B25">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    <!-- Twitter / X -->
                    <a href="#" aria-label="Twitter" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#e0cbb0] flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#432B25">
                            <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="#" aria-label="Instagram" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#e0cbb0] flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#432B25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                    </a>
                    <!-- YouTube -->
                    <a href="#" aria-label="YouTube" class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-[#e0cbb0] flex items-center justify-center hover:opacity-80 transition-opacity">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                            <path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z" fill="#432B25"/>
                            <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#e0cbb0"/>
                        </svg>
                    </a>
                </div>
                <p class="font-sans text-white text-[13px] sm:text-[14px] opacity-70 text-center">© Copyright 2026. All Rights Reserved by AvW</p>
            </div>
        </div>
    </footer>
    <!-- Premium AJAX Cart Feedback & Toast System -->
    <div id="avw-toast-container" class="fixed top-24 right-6 z-[1000] flex flex-col gap-4 pointer-events-none"></div>

    <style>
    .avw-toast {
        background: rgba(0, 0, 0, 0.9);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(205, 188, 166, 0.3);
        color: #cdbca6;
        padding: 16px 24px;
        border-radius: 16px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        transform: translateX(120%);
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        pointer-events: auto;
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 250px;
    }
    .avw-toast.show { transform: translateX(0); }
    .avw-toast.error { border-left: 4px solid #ef4444; }
    .avw-toast a { color: #fff; text-decoration: underline; font-weight: 600; }
    
    /* Hide WooCommerce default AJAX labels */
    .added_to_cart.wc-forward { display: none !important; }

    /* Spinner Animation */
    @keyframes avw-spin {
        to { transform: rotate(360deg); }
    }
    .animate-spin-fast { animation: avw-spin 0.6s linear infinite; }
    </style>

    <script>
    function showAvwToast(message, isError = false, link = '') {
        const toastId = 'toast-' + Date.now();
        const icon = isError 
            ? '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>'
            : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#cdbca6" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>';

        let content = `<span>${message}</span>`;
        if (link) {
            content = `<span>${message} <a href="${link}">Bekijk</a></span>`;
        }

        const toastHtml = `
            <div id="${toastId}" class="avw-toast ${isError ? 'error' : ''}">
                ${icon}
                ${content}
            </div>
        `;
        
        jQuery('#avw-toast-container').append(toastHtml);
        setTimeout(() => { jQuery('#' + toastId).addClass('show'); }, 100);
        
        setTimeout(() => {
            jQuery('#' + toastId).removeClass('show');
            setTimeout(() => { jQuery('#' + toastId).remove(); }, 600);
        }, 7000);
    }

    jQuery(document).ready(function($) {
        // Show Spinner on click (Archives)
        $(document.body).on('adding_to_cart', function(e, $btn, data) {
            $btn.find('.cart-icon-wrapper').addClass('hidden');
            $btn.find('.loading-spinner').removeClass('hidden').addClass('flex');
        });

        // single product AJAX add to cart
        $(document).on('submit', 'form.cart', function(e) {
            var $form = $(this);
            
            // If it's a single product page and not some other cart form
            if (!$form.closest('.product').length) return; 

            e.preventDefault();

            var $btn = $form.find('.single_add_to_cart_button');
            var originalHtml = $btn.html();

            // Add spinner to the button if not already there
            $btn.html('<span class="flex items-center justify-center gap-2"><svg class="animate-spin h-5 w-5 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> <span>Laden...</span></span>');
            $btn.addClass('opacity-75 pointer-events-none');

            var formData = new FormData($form[0]);
            formData.append('action', 'avw_ajax_add_to_cart');

            // CRITICAL FIX: To prevent WooCommerce core from ALSO adding to cart during this AJAX request,
            // we send "product_id" instead of "add-to-cart", and explicitly remove "add-to-cart" if it exists.
            var productId = $btn.val() || $form.find('input[name="add-to-cart"]').val();
            if (productId) {
                formData.append('product_id', productId);
            }
            if (formData.delete) {
                formData.delete('add-to-cart');
            }

            // Handle variations
            if ($form.find('input[name="variation_id"]').val()) {
                formData.append('variation_id', $form.find('input[name="variation_id"]').val());
            }

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $btn.html(originalHtml);
                    $btn.removeClass('opacity-75 pointer-events-none');

                    if (response.error && response.product_url) {
                        window.location.href = response.product_url;
                        return;
                    }

                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $btn]);
                },
                error: function() {
                    $btn.html(originalHtml);
                    $btn.removeClass('opacity-75 pointer-events-none');
                    showAvwToast('Fout bij toevoegen. Probeer opnieuw.', true);
                }
            });
        });

        // Show Toast on Success Add to Cart
        $(document.body).on('added_to_cart', function(e, fragments, cart_hash, $btn) {
            // Update fragments (badge etc)
            if (fragments) {
                $.each(fragments, function(key, value) {
                    $(key).replaceWith(value);
                });
            }

            if ($btn) {
                $btn.find('.loading-spinner').addClass('hidden').removeClass('flex');
                $btn.find('.cart-icon-wrapper').removeClass('hidden');
            }
            showAvwToast('Product toegevoegd aan mandje!', false, '<?php echo wc_get_cart_url(); ?>');
        });

        // Wishlist / Favorite Interaction
        $(document.body).on('click', '.wishlist-btn', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const $svg = $btn.find('svg');
            const productId = $btn.data('product_id');
            const $badge = $('#fav-badge');
            
            // 1. INSTANT FEEDBACK
            const isAdding = !$btn.hasClass('filled');
            let currentCount = parseInt($badge.text()) || 0;

            $svg.css('transform', 'scale(1.3)');
            setTimeout(() => { $svg.css('transform', 'scale(1)'); }, 200);

            if (isAdding) {
                $btn.addClass('active filled');
                $svg.css('fill', '#36221d');
                currentCount++;
                showAvwToast('Toegevoegd aan favorieten! ❤️');
            } else {
                $btn.removeClass('active filled');
                $svg.css('fill', 'none');
                currentCount = Math.max(0, currentCount - 1);
                showAvwToast('Verwijderd uit favorieten');
                $(document.body).trigger('avw_fav_removed', [productId]);
            }

            $badge.text(currentCount);
            if (currentCount > 0) {
                $badge.removeClass('scale-0 opacity-0').addClass('scale-100 opacity-100');
            } else {
                $badge.addClass('scale-0 opacity-0').removeClass('scale-100 opacity-100');
            }

            // 2. SILENT BACKGROUND SAVE
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'avw_v3_toggle_fav',
                    product_id: productId
                },
                success: function(response) {
                    // Sync badge count with server reality silently
                    if (response && response.success && response.data) {
                        const serverCount = response.data.count;
                        $badge.text(serverCount);
                        if (serverCount > 0) {
                            $badge.removeClass('scale-0 opacity-0').addClass('scale-100 opacity-100');
                        } else {
                            $badge.addClass('scale-0 opacity-0').removeClass('scale-100 opacity-100');
                        }
                    }
                    // No error toast — saving works, JSON parse may vary by server
                },
                error: function() {
                    // Only show toast on actual network error
                    showAvwToast('Netwerk fout. Probeer het later opnieuw.', true);
                }
            });
        });
    });
    </script>
    <!-- Google Translate — hidden element, controlled by custom switcher button -->
    <div id="avw_google_translate_el" style="position:fixed;top:-9999px;left:-9999px;width:200px;"></div>
    <style>
    .goog-te-banner-frame { display: none !important; }
    .goog-te-banner-frame.skiptranslate { display: none !important; }
    body { top: 0 !important; }
    </style>
    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'nl',
            includedLanguages: 'en',
            autoDisplay: false
        }, 'avw_google_translate_el');
    }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" defer></script>
    <?php wp_footer(); ?>
</body>

</html>
