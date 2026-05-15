    <!-- FOOTER -->
    <footer class="bg-black py-10 sm:py-14 px-4 sm:px-6">
        <div class="max-w-[1380px] mx-auto">
            <!-- Top Row: responsive grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 sm:gap-10 mb-10 sm:mb-12">
                <!-- Col 1: Snelle Links -->
                <div>
                    <h4 class="font-kurversbrug font-light text-[#cdbca6] text-[14px] sm:text-[16px] uppercase tracking-wider mb-4 sm:mb-6">Snelle Links</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2"><span class="text-white text-[10px]">•</span><a href="#" class="font-kurversbrug font-light text-white text-[14px] sm:text-[16px] hover:text-[#cdbca6] transition-colors">De Distilleerderij</a></li>
                        <li class="flex items-center gap-2"><span class="text-white text-[10px]">•</span><a href="#" class="font-kurversbrug font-light text-white text-[14px] sm:text-[16px] hover:text-[#cdbca6] transition-colors">Producten</a></li>
                        <li class="flex items-center gap-2"><span class="text-white text-[10px]">•</span><a href="#" class="font-kurversbrug font-light text-white text-[14px] sm:text-[16px] hover:text-[#cdbca6] transition-colors">Beleef</a></li>
                        <li class="flex items-center gap-2"><span class="text-white text-[10px]">•</span><a href="#" class="font-kurversbrug font-light text-white text-[14px] sm:text-[16px] hover:text-[#cdbca6] transition-colors">Kennis</a></li>
                        <li class="flex items-center gap-2"><span class="text-white text-[10px]">•</span><a href="#" class="font-kurversbrug font-light text-white text-[14px] sm:text-[16px] hover:text-[#cdbca6] transition-colors">Webwinkel</a></li>
                        <li class="flex items-center gap-2"><span class="text-white text-[10px]">•</span><a href="#" class="font-kurversbrug font-light text-white text-[14px] sm:text-[16px] hover:text-[#cdbca6] transition-colors">Blog &amp; Nieuws</a></li>
                    </ul>
                </div>

                <!-- Col 2: Secondary Links -->
                <div>
                    <h4 class="font-kurversbrug font-light text-[#cdbca6] text-[14px] sm:text-[16px] uppercase tracking-wider mb-4 sm:mb-6">Mijn Account</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2"><span class="text-white text-[10px]">•</span><a href="#" class="font-kurversbrug font-light text-white text-[14px] sm:text-[16px] hover:text-[#cdbca6] transition-colors">Mijn Account</a></li>
                        <li class="flex items-center gap-2"><span class="text-white text-[10px]">•</span><a href="#" class="font-kurversbrug font-light text-white text-[14px] sm:text-[16px] hover:text-[#cdbca6] transition-colors">Mijn Mandje</a></li>
                        <li class="flex items-center gap-2"><span class="text-white text-[10px]">•</span><a href="#" class="font-kurversbrug font-light text-white text-[14px] sm:text-[16px] hover:text-[#cdbca6] transition-colors">Veelgestelde Vragen</a></li>
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
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden border border-[#e0cbb0] cursor-pointer hover:opacity-80 transition-opacity">
                        <svg viewBox="0 0 48 49.2" fill="none" class="w-full h-full">
                            <path d="M33.366 0.58629H14.4C6.4471 0.58629 0 7.03339 0 14.9863V33.9523C0 41.9052 6.4471 48.3523 14.4 48.3523H33.366C41.3189 48.3523 47.766 41.9052 47.766 33.9523V14.9863C47.766 7.03339 41.3189 0.58629 33.366 0.58629Z" fill="#E0CBB0" />
                            <path d="M26.4901 36.4123V27.1255H29.7433L30.3625 23.2831H26.4901V20.7907C26.4901 19.7383 27.0313 18.7147 28.7653 18.7147H30.5245V15.4435C30.5245 15.4435 28.9273 15.1831 27.4009 15.1831C24.2113 15.1831 22.1281 17.0239 22.1281 20.3539V23.2819H18.5833V27.1243H22.1281V36.4123H26.4901Z" fill="#432B25" />
                        </svg>
                    </div>
                    <!-- Twitter -->
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden border border-[#e0cbb0] cursor-pointer hover:opacity-80 transition-opacity">
                        <svg viewBox="0 0 48 48" fill="none" class="w-full h-full">
                            <path d="M33.4093 0.572618H14.9058C7.14692 0.572618 0.857067 6.86247 0.857067 14.6214V33.1248C0.857067 40.8837 7.14692 47.1736 14.9058 47.1736H33.4093C41.1682 47.1736 47.458 40.8837 47.458 33.1248V14.6214C47.458 6.86247 41.1682 0.572618 33.4093 0.572618Z" fill="#E0CBB0" />
                            <path d="M31.364 19.9751C31.3745 20.1425 31.3745 20.3123 31.3745 20.4809C31.3745 25.6649 27.6329 31.6415 20.7946 31.6415V31.638C18.762 31.6372 16.7766 31.025 15.0967 29.8807C15.3894 29.9182 15.6856 29.9357 15.9806 29.9369C17.6691 29.9335 19.303 29.3382 20.5979 28.2545C19.0081 28.2229 17.6126 27.1283 17.1256 25.5303C17.6828 25.6438 18.2565 25.6204 18.8032 25.4635C17.0682 25.0936 15.8214 23.485 15.8214 21.6177V21.5685C16.3388 21.8729 16.9172 22.0415 17.5084 22.0602C15.874 20.9082 15.3706 18.6159 16.3576 16.8235C18.2448 19.2739 21.0311 20.763 24.02 20.9211C23.7203 19.5595 24.13 18.1324 25.0947 17.1747C26.5933 15.6879 28.9476 15.7652 30.356 17.3445C31.1933 17.1696 31.9928 16.8473 32.7174 16.3927C32.449 17.2881 31.8688 18.0577 31.0819 18.5621C31.8219 18.4684 32.5427 18.2599 33.2184 17.9439C32.7255 18.7255 32.0976 19.4132 31.364 19.9751Z" fill="#432B25" />
                        </svg>
                    </div>
                    <!-- Instagram -->
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden border border-[#e0cbb0] cursor-pointer hover:opacity-80 transition-opacity">
                        <svg viewBox="0 0 48 48" fill="none" class="w-full h-full">
                            <path d="M33.0942 0.572618H14.5908C6.83185 0.572618 0.541992 6.86247 0.541992 14.6214V33.1248C0.541992 40.8837 6.83185 47.1736 14.5908 47.1736H33.0942C40.8531 47.1736 47.143 40.8837 47.143 33.1248V14.6214C47.143 6.86247 40.8531 0.572618 33.0942 0.572618Z" fill="#E0CBB0" />
                            <!-- Camera body outline (evenodd cuts inner rect as hole) -->
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.5 13.5L18.5 13.5C15.46 13.5 13 15.96 13 19L13 29C13 32.04 15.46 34.5 18.5 34.5L29.5 34.5C32.54 34.5 35 32.04 35 29L35 19C35 15.96 32.54 13.5 29.5 13.5ZM18.5 16L29.5 16C31.16 16 32.5 17.34 32.5 19L32.5 29C32.5 30.66 31.16 32 29.5 32L18.5 32C16.84 32 15.5 30.66 15.5 29L15.5 19C15.5 17.34 16.84 16 18.5 16Z" fill="#432B25" />
                            <!-- Lens outline (evenodd cuts inner circle as hole) -->
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24 18.5C21.01 18.5 18.5 21.01 18.5 24C18.5 26.99 21.01 29.5 24 29.5C26.99 29.5 29.5 26.99 29.5 24C29.5 21.01 26.99 18.5 24 18.5ZM24 21C25.66 21 27 22.34 27 24C27 25.66 25.66 27 24 27C22.34 27 21 25.66 21 24C21 22.34 22.34 21 24 21Z" fill="#432B25" />
                            <!-- Flash dot -->
                            <circle cx="31.5" cy="16.5" r="1.5" fill="#432B25" />
                        </svg>
                    </div>
                    <!-- YouTube -->
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden border border-[#e0cbb0] cursor-pointer hover:opacity-80 transition-opacity">
                        <svg viewBox="0 0 48 48" fill="none" class="w-full h-full">
                            <path d="M33.366 0H14.4C6.4471 0 0 6.4471 0 14.4V33.366C0 41.3189 6.4471 47.766 14.4 47.766H33.366C41.3189 47.766 47.766 41.3189 47.766 33.366V14.4C47.766 6.4471 41.3189 0 33.366 0Z" fill="#E0CBB0" />
                            <!-- YouTube play button (rounded rect + triangle) -->
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M36.8 18.3C36.4 16.8 35.2 15.6 33.7 15.2C31 14.5 24 14.5 24 14.5C24 14.5 17 14.5 14.3 15.2C12.8 15.6 11.6 16.8 11.2 18.3C10.5 21 10.5 24.2 10.5 24.2C10.5 24.2 10.5 27.4 11.2 30.1C11.6 31.6 12.8 32.7 14.3 33.1C17 33.8 24 33.8 24 33.8C24 33.8 31 33.8 33.7 33.1C35.2 32.7 36.4 31.6 36.8 30.1C37.5 27.4 37.5 24.2 37.5 24.2C37.5 24.2 37.5 21 36.8 18.3ZM21.5 28.2V20.2L28.5 24.2L21.5 28.2Z" fill="#432B25" />
                        </svg>
                    </div>
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
    <?php wp_footer(); ?>
</body>

</html>
