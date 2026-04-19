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
                            <path d="M23.842 16.4462C26.2607 16.4462 26.5487 16.4556 27.5029 16.4989C28.491 16.5445 29.5083 16.7682 30.2283 17.4882C30.9542 18.2152 31.172 19.222 31.2176 20.2136C31.2621 21.1689 31.2703 21.4546 31.2703 23.8745C31.2703 26.2944 31.2609 26.5812 31.2176 27.5365C31.1731 28.5188 30.9425 29.5455 30.2283 30.2608C29.5013 30.9867 28.4957 31.2056 27.5029 31.2501C26.5476 31.2946 26.2619 31.3028 23.842 31.3028C21.4221 31.3028 21.1353 31.2946 20.18 31.2501C19.2059 31.2056 18.1651 30.9703 17.4557 30.2608C16.7333 29.5385 16.5109 28.5211 16.4664 27.5365C16.4219 26.5812 16.4137 26.2944 16.4137 23.8745C16.4137 21.4558 16.4219 21.1678 16.4664 20.2136C16.5109 19.2349 16.7427 18.2011 17.4557 17.4893C18.1815 16.7635 19.1919 16.5445 20.18 16.4989C21.1353 16.4556 21.4221 16.4462 23.842 16.4462Z" fill="#432B25" />
                            <path d="M23.8514 19.2172C21.3996 19.2172 19.4121 21.2047 19.4121 23.6565C19.4121 26.1083 21.3996 28.0958 23.8514 28.0958C26.3032 28.0958 28.2907 26.1083 28.2907 23.6565C28.2907 21.2047 26.3032 19.2172 23.8514 19.2172Z" fill="#432B25" />
                        </svg>
                    </div>
                    <!-- Dribbble -->
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full overflow-hidden border border-[#e0cbb0] cursor-pointer hover:opacity-80 transition-opacity">
                        <svg viewBox="0 0 48 49.2" fill="none" class="w-full h-full">
                            <path d="M33.6001 0.58629H14.6341C6.68121 0.58629 0.234109 7.03339 0.234109 14.9863V33.9523C0.234109 41.9052 6.68121 48.3523 14.6341 48.3523H33.6001C41.553 48.3523 48.0001 41.9052 48.0001 33.9523V14.9863C48.0001 7.03339 41.553 0.58629 33.6001 0.58629Z" fill="#E0CBB0" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.1162 15.1793C18.9982 15.1793 14.8282 19.3409 14.8282 24.4673C14.8282 29.5937 18.9982 33.7553 24.1162 33.7553C29.2342 33.7553 33.4042 29.5937 33.4042 24.4673C33.4042 19.3409 29.2342 15.1793 24.1162 15.1793Z" fill="#432B25" />
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
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(205, 188, 166, 0.2);
        color: #cdbca6;
        padding: 16px 24px;
        border-radius: 16px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        transform: translateX(120%);
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        pointer-events: auto;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .avw-toast.show { transform: translateX(0); }
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
    jQuery(document).ready(function($) {
        // Show Spinner on click
        $(document.body).on('adding_to_cart', function(e, $btn, data) {
            $btn.find('.cart-icon-wrapper').addClass('hidden');
            $btn.find('.loading-spinner').removeClass('hidden').addClass('flex');
        });

        // Show Toast on Success
        $(document.body).on('added_to_cart', function(e, fragments, cart_hash, $btn) {
            // Restore button icon
            $btn.find('.loading-spinner').addClass('hidden').removeClass('flex');
            $btn.find('.cart-icon-wrapper').removeClass('hidden');

            // Show Toast
            const toastId = 'toast-' + Date.now();
            const toastHtml = `
                <div id="${toastId}" class="avw-toast">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#cdbca6" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <span>Product toegevoegd! <a href="<?php echo wc_get_cart_url(); ?>">Bekijk mandje</a></span>
                </div>
            `;
            
            $('#avw-toast-container').append(toastHtml);
            
            // Slide in
            setTimeout(() => { $('#' + toastId).addClass('show'); }, 100);
            
            // Remove after 7 seconds
            setTimeout(() => {
                $('#' + toastId).removeClass('show');
                setTimeout(() => { $('#' + toastId).remove(); }, 600);
            }, 7000);
        });

        // Wishlist / Favorite Interaction
        $(document.body).on('click', '.wishlist-btn', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const $svg = $btn.find('svg');
            const productId = $btn.data('product_id');
            const $badge = $('#fav-badge');
            
            // 1. INSTANT FEEDBACK (Optimistic UI)
            const isAdding = !$btn.hasClass('filled');
            let currentCount = parseInt($badge.text()) || 0;

            // Animate Heart
            $svg.css('transform', 'scale(1.3)');
            setTimeout(() => { $svg.css('transform', 'scale(1)'); }, 200);

            if (isAdding) {
                $btn.addClass('active filled');
                $svg.css('fill', '#36221d');
                currentCount++;
            } else {
                $btn.removeClass('active filled');
                $svg.css('fill', 'none');
                currentCount = Math.max(0, currentCount - 1);
            }

            // Update Badge Instantly
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
                    action: 'avw_toggle_favorite',
                    product_id: productId
                },
                success: function(response) {
                    if (response.success) {
                        // Double check count with server reality
                        const serverCount = response.data.count;
                        $badge.text(serverCount);
                        if (serverCount > 0) {
                            $badge.removeClass('scale-0 opacity-0').addClass('scale-100 opacity-100');
                        } else {
                            $badge.addClass('scale-0 opacity-0').removeClass('scale-100 opacity-100');
                        }
                    } else {
                        // Revert on serious failure
                        alert('Er ging iets mis bij het opslaan van uw favoriet.');
                        location.reload(); 
                    }
                }
            });
        });
    });
    </script>
    <?php wp_footer(); ?>
</body>

</html>
