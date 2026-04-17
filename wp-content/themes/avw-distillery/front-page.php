<?php get_header(); ?>

    <!-- HERO SECTION -->
    <section id="hero" class="relative bg-black overflow-hidden" style="min-height:100vh;">
        <div class="absolute inset-0" style="top:-40%; bottom:-40%;">
            <img id="hero-parallax-img" src="<?php echo get_template_directory_uri(); ?>/assets/6addceefab5229029d4dc788a8a17c10ef6ba492.png"
                alt="Distilleerderij ketels" class="w-full h-full object-cover object-center" style="opacity: 0.85;" />
            <div class="absolute inset-0"
                style="background:linear-gradient(to bottom,rgba(0,0,0,0.3),rgba(0,0,0,0.1),rgba(0,0,0,0.4));">
            </div>
        </div>
        <div class="relative z-10 flex flex-col items-center justify-center px-6 py-24 text-center"
            style="min-height:100vh;">
            <div id="hero-logo" class="mb-8 flex flex-col items-center gap-6">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/e81e9bb1c2cefc530a3a2984d4da5347ec6b79d2.png" alt="A. van Wees Logo"
                    class="h-30 w-auto object-contain" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/1ff51b370c5de41a1117b63b24aafe29f6ea1180.png"
                    alt="A. van Wees Distilleerderij De Ooievaar" class="h-44 w-auto object-contain" />
            </div>
            <div class="max-w-[460px]">
                <div id="hero-text-set">
                    <p class="font-sans text-white text-[20px] leading-relaxed mb-4">
                        A. van Wees distilleerderij <br />'De Ooievaar' is de enig overgebleven, ambachtelijke
                        distilleerderij in Amsterdam.
                    </p>
                    <p class="font-sans text-white text-[20px] leading-relaxed">
                        Gevestigd in het hart van de Jordaan, distilleren wij volgens authentieke receptuur.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCTS SECTION -->
    <section class="bg-[#e0cbb0] py-20 px-6">
        <div class="max-w-[1290px] mx-auto">
            <div class="text-center mb-12">
                <h2 class="font-kurversbrug text-[#36221d] text-[42px] mb-6">Een Greep uit ons
                    assortiment</h2>
                <p class="font-sans text-black text-[20px] max-w-[810px] mx-auto leading-relaxed">
                    Door onze ambachtelijke manier van werken houden wij een traditie in stand die stamt uit de 16e
                    eeuw. Met de grote kennis van distilleren die in ons bedrijf aanwezig is en de liefde voor een edel
                    vak produceren wij Oudhollands gedistilleerd van unieke kwaliteit. Tegelijk ontwikkelen wij met oude
                    kennis nieuwe producten zoals een groentenlikeur.
                </p>
            </div>

            <!-- Category filter -->
            <div class="flex justify-center mb-12">
                <div class="flex items-center border border-[#eedfcb] rounded-full px-2 py-1.5 gap-1">
                    <button
                        class="category-btn px-6 py-2 rounded-full text-[16px] font-['DM_Sans',sans-serif] transition-all bg-[#eedfcb] text-[#031509]"
                        data-category="Toon Alles">Toon Alles</button>
                    <button
                        class="category-btn px-6 py-2 rounded-full text-[16px] font-['DM_Sans',sans-serif] transition-all text-black"
                        data-category="Bitters">Bitters</button>
                    <button
                        class="category-btn px-6 py-2 rounded-full text-[16px] font-['DM_Sans',sans-serif] transition-all text-black"
                        data-category="Esprits">Esprits</button>
                    <button
                        class="category-btn px-6 py-2 rounded-full text-[16px] font-['DM_Sans',sans-serif] transition-all text-black"
                        data-category="Genever">Genever</button>
                </div>
            </div>

            <!-- Products grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Card 1 -->
                <div class="product-card bg-[#eedfcb] rounded-[32px] p-8 flex flex-col" data-category="Esprits">
                    <div class="relative rounded-[24px] overflow-hidden mb-8" style="aspect-ratio:289/203;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/66425d6bde8a37b4cef53e3393e9cda24b1586e8.png"
                            alt="Bourbon vanille Stokjes esprit" class="w-full h-full object-cover" />
                        <div class="absolute top-3 left-3 flex gap-2">
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M15.1875 3.375H2.8125C2.50184 3.375 2.25 3.62684 2.25 3.9375V14.0625C2.25 14.3732 2.50184 14.625 2.8125 14.625H15.1875C15.4982 14.625 15.75 14.3732 15.75 14.0625V3.9375C15.75 3.62684 15.4982 3.375 15.1875 3.375Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M11.8125 6.1875C11.8125 6.93342 11.5162 7.64879 10.9887 8.17624C10.4613 8.70368 9.74592 9 9 9C8.25408 9 7.53871 8.70368 7.01126 8.17624C6.48382 7.64879 6.1875 6.93342 6.1875 6.1875"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 flex-1">
                        <div class="flex items-center gap-6">
                            <div class="font-['DM_Sans',sans-serif] text-[#36221d]"><span class="text-[20px]">€
                                </span><span class="text-[24px] font-medium">14,50</span></div>
                            <div class="border border-[rgba(0,0,0,0.3)] rounded-full px-5 py-2"><span
                                    class="font-['DM_Sans',sans-serif] text-[#061406] text-[14px]">Esprits</span></div>
                        </div>
                        <h3 class="font-kurversbrug font-light text-[#061406] text-[20px] leading-snug">Bourbon
                            vanille Stokjes esprit</h3>
                        <p class="font-sans text-black text-[16px] leading-relaxed flex-1">De handmatig
                            opengesneden stokjes worden langdurig getrokken en gestookt...</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="product-card bg-[#eedfcb] rounded-[32px] p-8 flex flex-col" data-category="Bitters">
                    <div class="relative rounded-[24px] overflow-hidden mb-8" style="aspect-ratio:289/203;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/94787958ec02fbb7ba0b52ea3fc5af37501ce581.png" alt="Angostura Bitter"
                            class="w-full h-full object-cover" />
                        <div class="absolute top-3 left-3 flex gap-2">
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M15.1875 3.375H2.8125C2.50184 3.375 2.25 3.62684 2.25 3.9375V14.0625C2.25 14.3732 2.50184 14.625 2.8125 14.625H15.1875C15.4982 14.625 15.75 14.3732 15.75 14.0625V3.9375C15.75 3.62684 15.4982 3.375 15.1875 3.375Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M11.8125 6.1875C11.8125 6.93342 11.5162 7.64879 10.9887 8.17624C10.4613 8.70368 9.74592 9 9 9C8.25408 9 7.53871 8.70368 7.01126 8.17624C6.48382 7.64879 6.1875 6.93342 6.1875 6.1875"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 flex-1">
                        <div class="flex items-center gap-6">
                            <div class="font-['DM_Sans',sans-serif] text-[#36221d]"><span class="text-[20px]">€
                                </span><span class="text-[24px] font-medium">24,50</span></div>
                            <div class="border border-[rgba(0,0,0,0.3)] rounded-full px-5 py-2"><span
                                    class="font-['DM_Sans',sans-serif] text-[#061406] text-[14px]">Bitters</span></div>
                        </div>
                        <h3 class="font-kurversbrug font-light text-[#061406] text-[20px] leading-snug">Angostura
                            Bitter</h3>
                        <p class="font-sans text-black text-[16px] leading-relaxed flex-1">Onze Angostura
                            wordt bereid volgens ons oude recept, dat dateert uit de tijd van de VOC.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="product-card bg-[#eedfcb] rounded-[32px] p-8 flex flex-col" data-category="Genever">
                    <div class="relative rounded-[24px] overflow-hidden mb-8" style="aspect-ratio:289/203;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/71eb91f13a28ddb2451da8ca40f42ac9b9e68ada.png" alt="Mirakel van Amsterdam"
                            class="w-full h-full object-cover" />
                        <div class="absolute top-3 left-3 flex gap-2">
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M15.1875 3.375H2.8125C2.50184 3.375 2.25 3.62684 2.25 3.9375V14.0625C2.25 14.3732 2.50184 14.625 2.8125 14.625H15.1875C15.4982 14.625 15.75 14.3732 15.75 14.0625V3.9375C15.75 3.62684 15.4982 3.375 15.1875 3.375Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M11.8125 6.1875C11.8125 6.93342 11.5162 7.64879 10.9887 8.17624C10.4613 8.70368 9.74592 9 9 9C8.25408 9 7.53871 8.70368 7.01126 8.17624C6.48382 7.64879 6.1875 6.93342 6.1875 6.1875"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 flex-1">
                        <div class="flex items-center gap-6">
                            <div class="font-['DM_Sans',sans-serif] text-[#36221d]"><span class="text-[20px]">€
                                </span><span class="text-[24px] font-medium">43,15</span></div>
                            <div class="border border-[rgba(0,0,0,0.3)] rounded-full px-5 py-2"><span
                                    class="font-['DM_Sans',sans-serif] text-[#061406] text-[14px]">Genever</span></div>
                        </div>
                        <h3 class="font-kurversbrug font-light text-[#061406] text-[20px] leading-snug">Mirakel van
                            Amsterdam</h3>
                        <p class="font-sans text-black text-[16px] leading-relaxed flex-1">De Zeer Oude
                            Genever wordt gemaakt van pure moutwijn en zeven verschillende geherdistilleerde
                            moutwijnen...</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="product-card bg-[#eedfcb] rounded-[32px] p-8 flex flex-col" data-category="Esprits">
                    <div class="relative rounded-[24px] overflow-hidden mb-8" style="aspect-ratio:289/203;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/66425d6bde8a37b4cef53e3393e9cda24b1586e8.png"
                            alt="Bourbon vanille Stokjes esprit" class="w-full h-full object-cover" />
                        <div class="absolute top-3 left-3 flex gap-2">
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M15.1875 3.375H2.8125C2.50184 3.375 2.25 3.62684 2.25 3.9375V14.0625C2.25 14.3732 2.50184 14.625 2.8125 14.625H15.1875C15.4982 14.625 15.75 14.3732 15.75 14.0625V3.9375C15.75 3.62684 15.4982 3.375 15.1875 3.375Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M11.8125 6.1875C11.8125 6.93342 11.5162 7.64879 10.9887 8.17624C10.4613 8.70368 9.74592 9 9 9C8.25408 9 7.53871 8.70368 7.01126 8.17624C6.48382 7.64879 6.1875 6.93342 6.1875 6.1875"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 flex-1">
                        <div class="flex items-center gap-6">
                            <div class="font-['DM_Sans',sans-serif] text-[#36221d]"><span class="text-[20px]">€
                                </span><span class="text-[24px] font-medium">14,50</span></div>
                            <div class="border border-[rgba(0,0,0,0.3)] rounded-full px-5 py-2"><span
                                    class="font-['DM_Sans',sans-serif] text-[#061406] text-[14px]">Esprits</span></div>
                        </div>
                        <h3 class="font-kurversbrug font-light text-[#061406] text-[20px] leading-snug">Bourbon
                            vanille Stokjes esprit</h3>
                        <p class="font-sans text-black text-[16px] leading-relaxed flex-1">De handmatig
                            opengesneden stokjes worden langdurig getrokken en gestookt...</p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="product-card bg-[#eedfcb] rounded-[32px] p-8 flex flex-col" data-category="Bitters">
                    <div class="relative rounded-[24px] overflow-hidden mb-8" style="aspect-ratio:289/203;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/94787958ec02fbb7ba0b52ea3fc5af37501ce581.png" alt="Angostura Bitter"
                            class="w-full h-full object-cover" />
                        <div class="absolute top-3 left-3 flex gap-2">
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M15.1875 3.375H2.8125C2.50184 3.375 2.25 3.62684 2.25 3.9375V14.0625C2.25 14.3732 2.50184 14.625 2.8125 14.625H15.1875C15.4982 14.625 15.75 14.3732 15.75 14.0625V3.9375C15.75 3.62684 15.4982 3.375 15.1875 3.375Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M11.8125 6.1875C11.8125 6.93342 11.5162 7.64879 10.9887 8.17624C10.4613 8.70368 9.74592 9 9 9C8.25408 9 7.53871 8.70368 7.01126 8.17624C6.48382 7.64879 6.1875 6.93342 6.1875 6.1875"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 flex-1">
                        <div class="flex items-center gap-6">
                            <div class="font-['DM_Sans',sans-serif] text-[#36221d]"><span class="text-[20px]">€
                                </span><span class="text-[24px] font-medium">24,50</span></div>
                            <div class="border border-[rgba(0,0,0,0.3)] rounded-full px-5 py-2"><span
                                    class="font-['DM_Sans',sans-serif] text-[#061406] text-[14px]">Bitters</span></div>
                        </div>
                        <h3 class="font-kurversbrug font-light text-[#061406] text-[20px] leading-snug">Angostura
                            Bitter</h3>
                        <p class="font-sans text-black text-[16px] leading-relaxed flex-1">Onze Angostura
                            wordt bereid volgens ons oude recept, dat dateert uit de tijd van de VOC.</p>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="product-card bg-[#eedfcb] rounded-[32px] p-8 flex flex-col" data-category="Genever">
                    <div class="relative rounded-[24px] overflow-hidden mb-8" style="aspect-ratio:289/203;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/71eb91f13a28ddb2451da8ca40f42ac9b9e68ada.png" alt="Mirakel van Amsterdam"
                            class="w-full h-full object-cover" />
                        <div class="absolute top-3 left-3 flex gap-2">
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M15.1875 3.375H2.8125C2.50184 3.375 2.25 3.62684 2.25 3.9375V14.0625C2.25 14.3732 2.50184 14.625 2.8125 14.625H15.1875C15.4982 14.625 15.75 14.3732 15.75 14.0625V3.9375C15.75 3.62684 15.4982 3.375 15.1875 3.375Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M11.8125 6.1875C11.8125 6.93342 11.5162 7.64879 10.9887 8.17624C10.4613 8.70368 9.74592 9 9 9C8.25408 9 7.53871 8.70368 7.01126 8.17624C6.48382 7.64879 6.1875 6.93342 6.1875 6.1875"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button class="bg-[#eedfcb] rounded-full p-2 hover:opacity-90 transition-opacity shadow-sm">
                                <svg width="16" height="16" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z"
                                        stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 flex-1">
                        <div class="flex items-center gap-6">
                            <div class="font-['DM_Sans',sans-serif] text-[#36221d]"><span class="text-[20px]">€
                                </span><span class="text-[24px] font-medium">43,15</span></div>
                            <div class="border border-[rgba(0,0,0,0.3)] rounded-full px-5 py-2"><span
                                    class="font-['DM_Sans',sans-serif] text-[#061406] text-[14px]">Genever</span></div>
                        </div>
                        <h3 class="font-kurversbrug font-light text-[#061406] text-[20px] leading-snug">Mirakel van
                            Amsterdam</h3>
                        <p class="font-sans text-black text-[16px] leading-relaxed flex-1">De Zeer Oude
                            Genever wordt gemaakt van pure moutwijn en zeven verschillende geherdistilleerde
                            moutwijnen...</p>
                    </div>
                </div>

            </div>

            <div class="flex justify-center mt-14">
                <button
                    class="rounded-[34px] px-10 py-4 text-white font-kurversbrug text-[18px] hover:opacity-90 transition-opacity"
                    style="background:linear-gradient(90deg,rgba(0,0,0,0.2),rgba(0,0,0,0.2)),#432B25;">
                    Naar de WEBWINKEL
                </button>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="bg-[#eedfcb] py-20 px-6 overflow-hidden">
        <div class="max-w-[1440px] mx-auto">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <!-- Left Image -->
                <div class="hidden lg:block w-full lg:w-1/4 pt-32">
                    <img id="about-img-left" src="<?php echo get_template_directory_uri(); ?>/assets/50e5b20ef3bab8e3ecb95301d6e6a59cb7610770.png" alt="Distilleerderij"
                        class="w-full h-[450px] object-cover rounded-[40px] shadow-2xl" />
                </div>

                <!-- Center Content -->
                <div class="w-full lg:w-1/2 flex flex-col items-center text-center gap-10">
                    <h2 class="font-kurversbrug font-light text-[#36221d] text-[36px] md:text-[48px] leading-[1.1] uppercase tracking-tight">
                        Honderden ambachtelijke dranken rechtstreeks uit onze Amsterdamse distilleerderij
                    </h2>
                    <div class="font-sans text-black text-[18px] md:text-[20px] leading-relaxed max-w-[620px]">
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
                <div class="hidden lg:block w-full lg:w-1/4 pt-0">
                    <img id="about-img-right" src="<?php echo get_template_directory_uri(); ?>/assets/2598b498148e6540a6572d998fa86bee0e7a8b8e.png" alt="Distilleerderij Amsterdam"
                        class="w-full h-[450px] object-cover rounded-[40px] shadow-2xl" />
                </div>
            </div>

            <!-- Button Row (Always centered) -->
            <div class="flex justify-center mt-12">
                <button
                    class="rounded-full px-12 py-5 text-white font-kurversbrug text-[16px] uppercase tracking-widest hover:brightness-110 transition-all shadow-lg"
                    style="background-color: #36221d;">
                    Lees meer over de distilleerderij
                </button>
            </div>
        </div>
    </section>

    <!-- NEWS SECTION -->
    <section class="bg-[#e0cbb0] py-20 px-6">
        <div class="max-w-[1290px] mx-auto">
            <div class="text-center mb-14">
                <h2 class="font-kurversbrug text-[#36221d] text-[42px] md:text-[46px] mb-4">Laatste
                    Nieuws</h2>
                <p class="font-sans text-black text-[18px] md:text-[20px] leading-relaxed">Lees hier de
                    laatste nieuwtjes over de oudste distillerderij van Amsterdam</p>
            </div>
            <div class="flex flex-col md:flex-row gap-8 mb-14">
                <!-- News card 1 -->
                <div class="rounded-[20px] overflow-hidden relative cursor-pointer group flex-1">
                    <div class="relative overflow-hidden" style="height:320px;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/2598b498148e6540a6572d998fa86bee0e7a8b8e.png" alt="Kleine distilleerderijen"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <div class="absolute inset-0"
                            style="background:linear-gradient(to bottom,rgba(21,27,49,0.15),rgba(28,63,58,0.4));"></div>
                        <div class="absolute bottom-8 left-7 right-7">
                            <h3 class="font-kurversbrug text-white text-[20px] leading-snug mb-6">Kleine
                                distilleerderijen – Gastblog Marketing Tribune</h3>
                            <div class="flex items-center gap-2">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <circle cx="6" cy="6" r="5.8125" stroke="rgba(255,255,255,0.68)"
                                        stroke-width="0.375" />
                                    <path d="M6 2.625V6L8.10938 6.99609" stroke="rgba(255,255,255,0.68)"
                                        stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span
                                    class="font-['DM_Sans',sans-serif] text-[rgba(255,255,255,0.68)] text-[13px]">15/08/2023</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- News card 2 -->
                <div class="rounded-[20px] overflow-hidden relative cursor-pointer group flex-1">
                    <div class="relative overflow-hidden" style="height:320px;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/409a5a74866028f1506810bb78de0eda68ebce8e.png" alt="Werkbezoek aan Japan"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <div class="absolute inset-0"
                            style="background:linear-gradient(to bottom,rgba(21,27,49,0.15),rgba(28,63,58,0.4));"></div>
                        <div class="absolute bottom-8 left-7 right-7">
                            <h3 class="font-kurversbrug text-white text-[20px] leading-snug mb-6">
                                Werkbezoek aan Japan</h3>
                            <div class="flex items-center gap-2">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <circle cx="6" cy="6" r="5.8125" stroke="rgba(255,255,255,0.68)"
                                        stroke-width="0.375" />
                                    <path d="M6 2.625V6L8.10938 6.99609" stroke="rgba(255,255,255,0.68)"
                                        stroke-width="0.75" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span
                                    class="font-['DM_Sans',sans-serif] text-[rgba(255,255,255,0.68)] text-[13px]">15/08/2023</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <button
                    class="rounded-[121px] px-8 py-4 text-white font-kurversbrug text-[18px] hover:opacity-90 transition-opacity"
                    style="background:linear-gradient(90deg,rgba(0,0,0,0.2),rgba(0,0,0,0.2)),#432B25;">
                    Lees Alle nieuwsartikelen
                </button>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
