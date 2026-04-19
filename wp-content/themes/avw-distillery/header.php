<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
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

        /* Hero parallax wrapper – full image on mobile, extended for parallax on desktop */
        .hero-parallax-bg {
            left: 0; right: 0;
            top: -40%; bottom: -40%;
        }

        @media (max-width: 768px) {
            .hero-parallax-bg {
                top: 0; bottom: 0;
            }
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            flex-direction: column;
            background: #000;
            padding: 0 1.5rem;
            gap: 0;
            border-top: 0px solid rgba(205,188,166,0.3);
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            z-index: 40;
            box-shadow: none;
            transition:
                max-height 0.4s cubic-bezier(0.4,0,0.2,1),
                padding 0.4s ease,
                gap 0.4s ease,
                border-top-width 0.4s ease,
                box-shadow 0.4s ease;
            display: flex;
        }

        #mobile-menu.open {
            max-height: 400px;
            padding: 1.2rem 1.5rem 2rem;
            gap: 1.5rem;
            border-top-width: 1px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
        }

        #mobile-menu a {
            font-family: 'Kurversbrug', serif;
            font-weight: 300;
            color: #cdbca6;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-decoration: none;
            border-bottom: 1px solid rgba(205,188,166,0.1);
            padding-bottom: 0.5rem;
            transition: color 0.3s ease;
            opacity: 0;
            transform: translateY(-8px);
            transition: opacity 0.3s ease, transform 0.3s ease, color 0.2s ease;
        }

        #mobile-menu.open a {
            opacity: 1;
            transform: translateY(0);
        }

        #mobile-menu a:last-child {
            border-bottom: none;
        }

        #mobile-menu a:hover {
            color: #fff;
        }

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
                display: none !important;
            }
        }
    </style>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <nav class="bg-black shadow-[0px_4px_4px_0px_rgba(0,0,0,0.13)] sticky top-0 z-50">
        <div class="max-w-[1440px] mx-auto px-4 py-3 flex items-center justify-between gap-4">
            
            <!-- Double-Safety Nav Links -->
            <div id="desktop-nav-links" class="flex items-center gap-6">
                <?php
                // 1. Try to get items from the native PRIMARY location (Filtered by Polylang)
                $locations = get_nav_menu_locations();
                $menu_items = false;

                if (isset($locations['primary'])) {
                    $menu_items = wp_get_nav_menu_items($locations['primary']);
                }

                // 2. If blank, try searching manually for "AVW Main Menu"
                if (!$menu_items) {
                    $fallback_menu = wp_get_nav_menu_object('AVW Main Menu');
                    if ($fallback_menu) {
                        $menu_items = wp_get_nav_menu_items($fallback_menu->term_id);
                    }
                }

                // 3. If STILL blank, just get the first created menu so it's never empty
                if (!$menu_items) {
                    $all_menus = wp_get_nav_menus();
                    if (!empty($all_menus)) {
                        $menu_items = wp_get_nav_menu_items($all_menus[0]->term_id);
                    }
                }

                if ($menu_items) :
                    foreach ($menu_items as $item) : ?>
                        <a href="<?php echo esc_url($item->url); ?>" class="font-kurversbrug font-light text-[#cdbca6] text-[14px] uppercase tracking-wider hover:text-white transition-colors whitespace-nowrap">
            <!-- Dynamic Nav Menu Logic (Hierarchy Aware) -->
            <?php
            $locations = get_nav_menu_locations();
            $menu_items = false;

            if (isset($locations['primary'])) {
                $menu_items = wp_get_nav_menu_items($locations['primary']);
            }

            // Organize items into a tree
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
            <div id="desktop-nav-links" class="flex items-center gap-8">
                <?php if (!empty($menu_tree)) : ?>
                    <?php foreach ($menu_tree as $parent) : ?>
                        <div class="group relative py-2">
                            <a href="<?php echo esc_url($parent->url); ?>" class="font-kurversbrug font-light text-[#cdbca6] text-[14px] uppercase tracking-widest hover:text-white transition-colors whitespace-nowrap flex items-center gap-1">
                                <?php echo esc_html($parent->title); ?>
                                <?php if (!empty($parent->children)) : ?>
                                    <svg class="w-3 h-3 opacity-50 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                <?php endif; ?>
                            </a>
                            
                            <?php if (!empty($parent->children)) : ?>
                                <!-- Dropdown Panel -->
                                <div class="dropdown-panel absolute top-full left-0 pt-4 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 z-[100]">
                                    <div class="bg-black border border-[#cdbca6]/10 rounded-xl shadow-2xl p-6 min-w-[240px]">
                                        <div class="flex flex-col gap-4">
                                            <?php foreach ($parent->children as $child) : ?>
                                                <div class="relative group/sub">
                                                    <a href="<?php echo esc_url($child->url); ?>" class="font-kurversbrug text-[#cdbca6]/80 text-[13px] uppercase tracking-wider hover:text-white flex items-center justify-between">
                                                        <?php echo esc_html($child->title); ?>
                                                        <?php if (!empty($child->children)) : ?>
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                                        <?php endif; ?>
                                                    </a>
                                                    
                                                    <?php if (!empty($child->children)) : ?>
                                                        <!-- Nested Grandchild Dropdown -->
                                                        <div class="absolute left-full top-0 ml-4 opacity-0 invisible translate-x-2 group-hover/sub:opacity-100 group-hover/sub:visible group-hover/sub:translate-x-0 transition-all duration-300">
                                                            <div class="bg-black border border-[#cdbca6]/10 rounded-xl shadow-2xl p-6 min-w-[200px]">
                                                                <div class="flex flex-col gap-3">
                                                                    <?php foreach ($child->children as $grandchild) : ?>
                                                                        <a href="<?php echo esc_url($grandchild->url); ?>" class="font-kurversbrug text-[#cdbca6]/60 text-[12px] uppercase tracking-wider hover:text-white">
                                                                            <?php echo esc_html($grandchild->title); ?>
                                                                        </a>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <span class="text-[#cdbca6] text-[10px] uppercase opacity-50 italic">Admin: Setup your menu in Appearance -> Menus</span>
                <?php endif; ?>
            </div>

            <!-- Right: Action buttons -->
            <div class="flex items-center gap-3 flex-shrink-0 ml-auto">
                <!-- Heart -->
                <button class="bg-[#cdbca6] rounded-full p-2.5 flex items-center justify-center hover:opacity-90 transition-all active:scale-95 shadow-sm">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z" stroke="#133E23" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <!-- User -->
                <button class="bg-[#cdbca6] rounded-full p-2.5 flex items-center justify-center hover:opacity-90 transition-all active:scale-95 shadow-sm">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M18.0414 17.1875C17.9865 17.2825 17.9076 17.3614 17.8126 17.4163C17.7175 17.4712 17.6097 17.5 17.5 17.5H2.5C2.39034 17.4999 2.28265 17.4709 2.18772 17.416C2.0928 17.3611 2.01399 17.2822 1.95921 17.1872C1.90444 17.0922 1.87561 16.9845 1.87564 16.8748C1.87564 16.9845 1.90455 16.8767 1.87564 16.8748C1.87564 16.8748 1.87564 16.8748 1.87564 16.8748C1.87564 16.8748 1.87564 16.8748 1.87564 16.8748Z" fill="#000000" />
                    </svg>
                </button>
                <!-- Search -->
                <button class="bg-white rounded-full px-4 py-2 flex items-center gap-2 hover:bg-gray-100 transition-all active:scale-95 shadow-sm">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M7.875 13.5C10.9816 13.5 13.5 10.9816 13.5 7.875C13.5 4.7684 10.9816 2.25 7.875 2.25C4.7684 2.25 2.25 4.7684 2.25 7.875C2.25 10.9816 4.7684 13.5 7.875 13.5Z" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.8526 11.8526L15.75 15.75" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-black text-[14px] font-bold hidden sm:inline">Zoek</span>
                </button>
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

        <!-- Mobile dropdown menu -->
        <div id="mobile-menu">
            <div class="flex flex-col gap-6 py-8">
                <?php if (!empty($menu_tree)) : ?>
                    <?php foreach ($menu_tree as $parent) : ?>
                        <div class="flex flex-col gap-2">
                            <a href="<?php echo esc_url($parent->url); ?>" class="font-kurversbrug text-[#cdbca6] text-[20px] uppercase tracking-widest border-b border-[#cdbca6]/10 pb-2">
                                <?php echo esc_html($parent->title); ?>
                            </a>
                            <?php if (!empty($parent->children)) : ?>
                                <div class="flex flex-col gap-3 pl-4 mt-2">
                                    <?php foreach ($parent->children as $child) : ?>
                                        <a href="<?php echo esc_url($child->url); ?>" class="text-[#cdbca6]/80 text-[14px] uppercase tracking-wider font-kurversbrug">
                                            <?php echo esc_html($child->title); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </nav>

