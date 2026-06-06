<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <!-- Clear Google Translate only if user hasn't chosen English -->
    <script>
    var hasEnChosen = document.cookie.match(/avw_lang=en/);
    if (!hasEnChosen) {
      // Only clear if user wants Dutch (default)
      document.cookie = 'googtrans=;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;';
      document.cookie = 'googtrans=;domain=' + location.hostname + ';path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;';
    }
    </script>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>A. van Wees – Distilleerderij De Ooievaar</title>
    <meta name="description"
        content="A. van Wees distilleerderij De Ooievaar – de enig overgebleven ambachtelijke distilleerderij in Amsterdam." />
    <style>
        @font-face {
            font-family: 'Kurversbrug';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/Kurversbrug-Regular.ttf') format('truetype');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Kurversbrug';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/Kurversbrug-Light.ttf') format('truetype');
            font-weight: 300;
            font-style: normal;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background-color: #e0cbb0;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: normal !important;
        }

        .font-kurversbrug {
            font-weight: normal !important;
        }

        .font-light {
            font-weight: 300 !important;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        #mobile-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 40;
            background: #111;
            border-top: 1px solid rgba(205,188,166,0.15);
            box-shadow: 0 16px 48px rgba(0,0,0,0.65);
            max-height: 80vh;
            overflow-y: auto;
        }
        #mobile-menu.open {
            display: block;
            animation: avwMenuIn 0.22s ease forwards;
        }
        @keyframes avwMenuIn {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .avw-mob-parent {
            display: block;
            font-family: 'Kurversbrug', serif;
            font-weight: 300;
            color: #cdbca6;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            text-decoration: none;
            padding: 14px 0;
            border-bottom: 1px solid rgba(205,188,166,0.1);
            transition: color 0.2s;
        }
        .avw-mob-parent:hover { color: #fff; }
        .avw-mob-children {
            padding: 6px 0 10px 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .avw-mob-child {
            font-family: 'Kurversbrug', serif;
            font-size: 14px;
            color: rgba(205,188,166,0.65);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-decoration: none;
            transition: color 0.2s;
        }
        .avw-mob-child:hover { color: #cdbca6; }
        .avw-mob-util {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            padding: 16px 0 4px;
        }
        .avw-mob-util a {
            display: flex;
            align-items: center;
            gap: 7px;
            font-family: 'Kurversbrug', serif;
            font-size: 13px;
            color: rgba(205,188,166,0.7);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-decoration: none;
            transition: color 0.2s;
        }
        .avw-mob-util a:hover { color: #fff; }
        .avw-mob-lang { font-size: 13px; font-weight: 700; }
        .avw-mob-lang.active { color: #fff; }

        /* Hamburger icon animation */
        #hamburger-btn .bar {
            display: block;
            width: 15px;
            height: 1.5px;
            background: #000;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            transform-origin: center;
        }

        #hamburger-btn.open .bar:nth-child(1) {
            transform: translateY(4.5px) rotate(45deg);
        }
        #hamburger-btn.open .bar:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }
        #hamburger-btn.open .bar:nth-child(3) {
            transform: translateY(-4.5px) rotate(-45deg);
        }

        /* Hide desktop nav on small screens */
        @media (max-width: 900px) {
            #desktop-nav-links {
                display: none !important;
            }
            #hamburger-btn {
                display: flex !important;
            }
        }

        @media (min-width: 901px) {
            #hamburger-btn {
                display: none !important;
            }
            #mobile-menu {
                display: none !important; /* overrides .open on desktop */
            }
        }

        /* ---- Desktop dropdown (replaces Tailwind group-hover) ---- */
        .avw-dropdown {
            position: absolute;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
            pointer-events: none;
        }
        .avw-drop-down {
            top: 100%; left: 0;
            padding-top: 16px;
            transform: translateY(6px);
        }
        .avw-drop-right {
            top: 0; left: 100%;
            padding-left: 12px;
            transform: translateX(6px);
        }
        .avw-has-drop:hover > .avw-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translate(0, 0);
            pointer-events: auto;
        }

        /* ---- Search overlay ---- */
        #avw-search-backdrop {
            display: none;
            position: fixed; inset: 0; z-index: 48;
            background: rgba(0,0,0,0.35);
            backdrop-filter: blur(2px);
        }
        #avw-search-backdrop.open { display: block; }

        #avw-search-panel {
            position: fixed; left: 0; right: 0; z-index: 49;
            background: #fff;
            box-shadow: 0 12px 48px rgba(0,0,0,0.18);
            transform: translateY(-8px);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }
        #avw-search-panel.open {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }
        #avw-search-inner {
            max-width: 860px; margin: 0 auto; padding: 28px 24px 24px;
        }
        #avw-search-form {
            display: flex; align-items: center;
            border: 2px solid #36221d; border-radius: 40px;
            overflow: hidden; background: #fdf8f1;
            margin-bottom: 20px;
        }
        #avw-search-input {
            flex: 1; border: none; background: transparent;
            font-family: 'DM Sans', sans-serif; font-size: 16px; color: #36221d;
            padding: 14px 20px; outline: none;
            appearance: none; -webkit-appearance: none;
            line-height: 1.2; display: block; margin: 0;
        }
        #avw-search-input::placeholder { color: rgba(54,34,29,0.4); }
        #avw-search-submit {
            border: none; background: #36221d; color: #eedfcb;
            font-family: 'Kurversbrug', serif; font-size: 14px;
            text-transform: uppercase; letter-spacing: 0.1em;
            padding: 14px 28px; cursor: pointer; transition: opacity 0.2s;
            white-space: nowrap;
        }
        #avw-search-submit:hover { opacity: 0.85; }

        /* Results */
        #avw-search-results { min-height: 0; }
        .avw-sr-loading {
            text-align: center; padding: 24px 0;
            font-family: 'DM Sans', sans-serif; font-size: 14px; color: rgba(54,34,29,0.45);
        }
        .avw-sr-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;
            margin-bottom: 16px;
        }
        @media (max-width: 600px) { .avw-sr-grid { grid-template-columns: repeat(2, 1fr); } }
        .avw-sr-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px; border-radius: 12px; text-decoration: none;
            transition: background 0.15s;
        }
        .avw-sr-item:hover { background: #fdf8f1; }
        .avw-sr-item img {
            width: 52px; height: 52px; object-fit: cover;
            border-radius: 8px; flex-shrink: 0; background: #f0e8de;
        }
        .avw-sr-info { min-width: 0; }
        .avw-sr-title {
            display: block; font-family: 'DM Sans', sans-serif; font-size: 13px;
            font-weight: 600; color: #36221d;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .avw-sr-price {
            display: block; font-family: 'DM Sans', sans-serif; font-size: 12px;
            color: rgba(54,34,29,0.55); margin-top: 2px;
        }
        .avw-sr-footer {
            border-top: 1px solid rgba(54,34,29,0.08); padding-top: 14px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .avw-sr-footer-count {
            font-family: 'DM Sans', sans-serif; font-size: 13px; color: rgba(54,34,29,0.45);
        }
        .avw-sr-all-link {
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
            color: #432B25; text-decoration: none; text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .avw-sr-all-link:hover { text-decoration: underline; }
        .avw-sr-empty {
            padding: 24px 0; text-align: center;
            font-family: 'DM Sans', sans-serif; font-size: 14px; color: rgba(54,34,29,0.45);
        }

        /* Add to cart: stack quantity above button on mobile */
        @media (max-width: 768px) {
            .woocommerce form.cart {
                display: flex !important;
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 14px !important;
            }
            .woocommerce form.cart .quantity {
                width: 100% !important;
            }
            .woocommerce form.cart .quantity input.qty {
                width: 100% !important;
                text-align: center !important;
                box-sizing: border-box !important;
            }
            .woocommerce form.cart .single_add_to_cart_button {
                width: 100% !important;
            }
        }
    </style>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <nav class="bg-black shadow-[0px_4px_4px_0px_rgba(0,0,0,0.13)] sticky top-0 z-50">
        <div class="max-w-[1440px] mx-auto px-4 py-4 flex items-center justify-between gap-4">
            
            <!-- Dynamic Nav Menu Logic (Hierarchy Aware) -->
            <?php
            $locations  = get_nav_menu_locations();
            $menu_items = false;

            // 1. Primary menu location
            if ( has_nav_menu('primary') ) {
                $menu_items = wp_get_nav_menu_items( $locations['primary'] );
            }

            // 2. Fallback to named menus
            if ( ! $menu_items || empty($menu_items) ) {
                foreach ( array('Supreme Boutique Menu', 'Premium Boutique Menu') as $name ) {
                    $obj = wp_get_nav_menu_object( $name );
                    if ( $obj ) {
                        $menu_items = wp_get_nav_menu_items( $obj->term_id );
                        if ( $menu_items ) break;
                    }
                }
            }

            // Tree construction logic
            $menu_tree = array();
            if ($menu_items) {
                $items_by_id = array();
                foreach($menu_items as $item) {
                    $item->children = array();
                    $items_by_id[$item->ID] = $item;
                }
                foreach($items_by_id as $item) {
                    if ($item->menu_item_parent == 0) {
                        $menu_tree[] = $item;
                    } else {
                        if (isset($items_by_id[$item->menu_item_parent])) {
                            $items_by_id[$item->menu_item_parent]->children[] = $item;
                        }
                    }
                }
            }
            ?>

            <!-- Left: Nav links (desktop only) -->
            <div id="desktop-nav-links" class="flex items-center gap-5 flex-wrap">
                <?php if (!empty($menu_tree)) : ?>
                    <?php foreach ($menu_tree as $parent) : ?>
                        <div class="avw-has-drop relative py-2">
                            <a href="<?php echo esc_url($parent->url); ?>" class="font-kurversbrug font-light text-[#cdbca6] text-[13px] uppercase tracking-wide hover:text-white transition-colors whitespace-nowrap flex items-center gap-1" style="text-decoration:none;">
                                <?php echo esc_html($parent->title); ?>
                                <?php if (!empty($parent->children)) : ?>
                                    <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                <?php endif; ?>
                            </a>
                            <?php if (!empty($parent->children) && function_exists('avw_render_dropdown')) avw_render_dropdown($parent->children, 1); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Right: Action buttons -->
            <div class="flex items-center gap-3 flex-shrink-0 ml-auto">
                <!-- Wishlist (Heart) — hidden on mobile, shown on desktop -->
                <?php
                $wl_page = get_page_by_path('verlanglijst');
                $wl_url  = $wl_page ? get_permalink($wl_page->ID) : home_url('/verlanglijst/');
                $fav_count = count(avw_get_favorites());
                ?>
                <a href="<?php echo esc_url($wl_url); ?>" class="hidden md:flex bg-white rounded-full p-2.5 items-center justify-center hover:opacity-90 transition-all active:scale-95 shadow-sm relative group/fav">
                    <svg width="20" height="20" viewBox="0 0 18 18" fill="none">
                        <path d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div id="fav-badge" class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-md transition-all <?php echo $fav_count > 0 ? 'scale-100 opacity-100' : 'scale-0 opacity-0'; ?>">
                        <?php echo $fav_count; ?>
                    </div>
                </a>
                <!-- Cart -->
                <a href="<?php echo wc_get_cart_url(); ?>" class="bg-white rounded-full p-2.5 flex items-center justify-center hover:opacity-90 transition-all active:scale-95 shadow-sm relative group/cart">
                    <svg width="20" height="20" viewBox="0 0 18 18" fill="none">
                        <path d="M15.1875 3.375H2.8125C2.50184 3.375 2.25 3.62684 2.25 3.9375V14.0625C2.25 14.3732 2.50184 14.625 2.8125 14.625H15.1875C15.4982 14.625 15.75 14.3732 15.75 14.0625V3.9375C15.75 3.62684 15.4982 3.375 15.1875 3.375Z" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.8125 6.1875C11.8125 6.93342 11.5162 7.64879 10.9887 8.17624C10.4613 8.70368 9.74592 9 9 9C8.25408 9 7.53871 8.70368 7.01126 8.17624C6.48382 7.64879 6.1875 6.93342 6.1875 6.1875" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <?php
                    $cart_count = ( isset(WC()->cart) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
                    ?>
                    <div id="cart-badge" class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-md transition-all <?php echo $cart_count > 0 ? 'scale-100 opacity-100' : 'scale-0 opacity-0'; ?>">
                        <?php echo $cart_count; ?>
                    </div>
                </a>
                <!-- User — hidden on mobile -->
                <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>"
                   aria-label="<?php echo is_user_logged_in() ? esc_attr__( 'My Account', 'woocommerce' ) : esc_attr__( 'Sign In', 'woocommerce' ); ?>"
                   class="hidden md:flex bg-[#cdbca6] rounded-full p-2.5 items-center justify-center hover:opacity-90 transition-all active:scale-95 shadow-sm">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1a2e1a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </a>
                <!-- Search -->
                <button id="avw-search-btn" class="bg-white rounded-full p-2.5 md:px-4 md:py-2 flex items-center gap-2 hover:bg-gray-100 transition-all active:scale-95 shadow-sm">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M7.875 13.5C10.9816 13.5 13.5 10.9816 13.5 7.875C13.5 4.7684 10.9816 2.25 7.875 2.25C4.7684 2.25 2.25 4.7684 2.25 7.875C2.25 10.9816 4.7684 13.5 7.875 13.5Z" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.8526 11.8526L15.75 15.75" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-black text-[14px] font-bold hidden md:inline">Zoek</span>
                </button>
                <!-- Language switcher — branded pill, uses GTranslate JS API -->
                <div class="relative hidden md:block" id="avw-lang-switcher">
                    <button id="avw-lang-btn" class="bg-white rounded-full px-3 py-2 flex items-center gap-1.5 hover:bg-gray-100 transition-all active:scale-95 shadow-sm" aria-label="Taal wisselen">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M2 12h20"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                        <span id="avw-lang-label" class="text-black text-[13px] font-bold uppercase tracking-wider">NL</span>
                        <svg id="avw-lang-chevron" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition:transform 0.2s">
                            <path d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="avw-lang-dropdown" style="display:none;position:absolute;top:calc(100% + 8px);right:0;background:#fff;border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,0.14);overflow:hidden;min-width:72px;z-index:200;">
                        <a href="#" id="avw-lang-nl" onclick="avwSwitchLang('nl');return false;"
                           style="display:flex;align-items:center;padding:10px 16px;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:700;color:#36221d;text-transform:uppercase;text-decoration:none;letter-spacing:0.06em;transition:background 0.15s;"
                           onmouseover="this.style.background='#f5ede3'" onmouseout="this.style.background=''">NL</a>
                        <a href="#" id="avw-lang-en" onclick="avwSwitchLang('en');return false;"
                           style="display:flex;align-items:center;padding:10px 16px;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:700;color:#36221d;text-transform:uppercase;text-decoration:none;letter-spacing:0.06em;transition:background 0.15s;"
                           onmouseover="this.style.background='#f5ede3'" onmouseout="this.style.background=''">EN</a>
                    </div>
                </div>

                <!-- Hamburger (mobile only) -->
                <button id="hamburger-btn" aria-label="Menu" class="bg-[#cdbca6] rounded-full p-2.5 flex items-center justify-center hover:opacity-90 transition-opacity">
                    <span class="flex flex-col gap-[4px] justify-center items-center w-5 h-5">
                        <span class="bar h-[2px]"></span>
                        <span class="bar h-[2px]"></span>
                        <span class="bar h-[2px]"></span>
                    </span>
                </button>
            </div>
        </div>

        <!-- Search backdrop -->
        <div id="avw-search-backdrop"></div>

        <!-- Search panel -->
        <div id="avw-search-panel">
            <div id="avw-search-inner">
                <form id="avw-search-form" action="<?php echo home_url('/'); ?>" method="get">
                    <input type="hidden" name="post_type" value="product" />
                    <input type="search" id="avw-search-input" name="s" placeholder="Zoek producten…" autocomplete="off" />
                    <button type="submit" id="avw-search-submit">Zoeken</button>
                </form>
                <div id="avw-search-results"></div>
            </div>
        </div>

        <script>
        (function() {
            var btn      = document.getElementById('avw-search-btn');
            var panel    = document.getElementById('avw-search-panel');
            var backdrop = document.getElementById('avw-search-backdrop');
            var input    = document.getElementById('avw-search-input');
            var results  = document.getElementById('avw-search-results');
            var nav      = btn.closest('nav');
            var debounce, lastQuery = '';

            function openSearch() {
                var navH = nav.getBoundingClientRect().bottom;
                panel.style.top = navH + 'px';
                panel.classList.add('open');
                backdrop.classList.add('open');
                input.focus();
            }
            function closeSearch() {
                panel.classList.remove('open');
                backdrop.classList.remove('open');
                results.innerHTML = '';
                lastQuery = '';
            }

            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                panel.classList.contains('open') ? closeSearch() : openSearch();
            });
            backdrop.addEventListener('click', closeSearch);
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeSearch();
            });

            input.addEventListener('input', function() {
                var q = this.value.trim();
                if (q === lastQuery) return;
                lastQuery = q;
                clearTimeout(debounce);
                if (q.length < 2) { results.innerHTML = ''; return; }
                results.innerHTML = '<div class="avw-sr-loading">Zoeken…</div>';
                debounce = setTimeout(function() { doSearch(q); }, 280);
            });

            function doSearch(q) {
                var fd = new FormData();
                fd.append('action', 'avw_live_search');
                fd.append('query', q);
                fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: fd })
                    .then(function(r) { return r.json(); })
                    .then(function(res) {
                        if (!res.success) { results.innerHTML = ''; return; }
                        if (!res.data.html) {
                            results.innerHTML = '<div class="avw-sr-empty">Geen producten gevonden voor "<strong>' + q + '</strong>".</div>';
                            return;
                        }
                        results.innerHTML =
                            '<div class="avw-sr-grid">' + res.data.html + '</div>' +
                            '<div class="avw-sr-footer">' +
                                '<span class="avw-sr-footer-count">' + res.data.count + ' resultaten</span>' +
                                '<a class="avw-sr-all-link" href="' + res.data.url + '">Bekijk alle resultaten &rarr;</a>' +
                            '</div>';
                    })
                    .catch(function() { results.innerHTML = ''; });
            }
        })();

        // Language switcher
        function avwSwitchLang(lang) {
            // Store language choice
            document.cookie = 'avw_lang=' + lang + ';path=/;max-age=31536000';

            if (lang === 'nl') {
                // Reload to reset to original Dutch
                window.location.reload();
            } else if (lang === 'en') {
                // Translate to English
                if (typeof doGTranslate === 'function') {
                    doGTranslate('nl|en');
                } else {
                    window.location.reload();
                }
            }
        }

        // On page load, update button labels to match stored language
        (function() {
            var stored = document.cookie.match(/avw_lang=([a-z]{2})/);
            var cur = stored ? stored[1] : 'nl';

            var label = document.getElementById('avw-lang-label');
            if (label) label.textContent = cur.toUpperCase();
            var mob = document.getElementById('avw-mob-lang-' + cur);
            if (mob) mob.classList.add('active');
        })();

        // Dropdown open/close
        (function() {
            var langBtn  = document.getElementById('avw-lang-btn');
            var langDrop = document.getElementById('avw-lang-dropdown');
            var langChev = document.getElementById('avw-lang-chevron');
            if (!langBtn || !langDrop) return;
            langBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                var open = langDrop.style.display !== 'none';
                langDrop.style.display = open ? 'none' : 'block';
                if (langChev) langChev.style.transform = open ? 'rotate(0deg)' : 'rotate(180deg)';
            });
            document.addEventListener('click', function() {
                langDrop.style.display = 'none';
                if (langChev) langChev.style.transform = 'rotate(0deg)';
            });
        })();
        </script>

        <!-- Mobile dropdown menu -->
        <div id="mobile-menu">
            <div style="padding: 8px 24px 24px;">

                <!-- Nav items -->
                <?php if (!empty($menu_tree)) : ?>
                    <?php foreach ($menu_tree as $parent) : ?>
                        <a href="<?php echo esc_url($parent->url); ?>" class="avw-mob-parent">
                            <?php echo esc_html($parent->title); ?>
                        </a>
                        <?php if (!empty($parent->children)) : ?>
                            <div class="avw-mob-children">
                                <?php foreach ($parent->children as $child) : ?>
                                    <a href="<?php echo esc_url($child->url); ?>" class="avw-mob-child">
                                        <?php echo esc_html($child->title); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Utility row -->
                <div class="avw-mob-util">
                    <a href="<?php echo esc_url($wl_url); ?>">
                        <svg width="15" height="15" viewBox="0 0 18 18" fill="none"><path d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Verlanglijst
                    </a>
                    <a href="<?php echo esc_url(wc_get_account_endpoint_url('dashboard')); ?>">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Account
                    </a>
                    <!-- Language — GTranslate -->
                    <span style="width:1px;height:16px;background:rgba(205,188,166,0.2);display:inline-block;"></span>
                    <a href="#" onclick="avwSwitchLang('nl');return false;" class="avw-mob-lang" id="avw-mob-lang-nl">NL</a>
                    <a href="#" onclick="avwSwitchLang('en');return false;" class="avw-mob-lang" id="avw-mob-lang-en">EN</a>
                </div>

            </div>
        </div>
    </nav>

