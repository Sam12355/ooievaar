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
            
            <!-- Dynamic Nav Menu Logic (Language Aware) -->
            <?php
            $menu_items = false;
            $locations = get_nav_menu_locations();
            
            // For Multi-language (Polylang/WPML), the current location is filtered by WP automatically
            if (has_nav_menu('primary')) {
                // This call is filtered by translations plugins
                $menu_items = wp_get_nav_menu_items(wp_get_nav_menu_object($locations['primary'])->term_id);
            }
            ?>

            <!-- Left: Nav links (desktop only) -->
            <div id="desktop-nav-links" class="flex items-center gap-6">
                <?php if ($menu_items) : ?>
                    <?php foreach ($menu_items as $item) : ?>
                        <a href="<?php echo esc_url($item->url); ?>" class="font-kurversbrug font-light text-[#cdbca6] text-[14px] uppercase tracking-wider hover:text-white transition-colors whitespace-nowrap">
                            <?php echo esc_html($item->title); ?>
                        </a>
                    <?php endforeach; ?>
                <?php else : ?>
                    <!-- Fallback: Instructions for user -->
                    <span class="text-[#cdbca6] text-[10px] uppercase opacity-50">Please assign a menu to "Primary Menu" in Menus -> Manage Locations</span>
                <?php endif; ?>
            </div>

            <!-- Right: Action buttons -->
            <div class="flex items-center gap-3 flex-shrink-0 ml-auto">
                <!-- Heart -->
                <button class="bg-[#cdbca6] rounded-full p-2 flex items-center justify-center hover:opacity-90 transition-opacity">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M9 15.75C9 15.75 1.6875 11.8125 1.6875 7.17188C1.6875 6.16488 2.08753 5.19913 2.79958 4.48708C3.51163 3.77503 4.47738 3.375 5.48438 3.375C7.07273 3.375 8.43328 4.24055 9 5.625C9.56672 4.24055 10.9273 3.375 12.5156 3.375C13.5226 3.375 14.4884 3.77503 15.2004 4.48708C15.9125 5.19913 16.3125 6.16488 16.3125 7.17188C16.3125 11.8125 9 15.75 9 15.75Z" stroke="#133E23" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <!-- User -->
                <button class="bg-[#cdbca6] rounded-full p-2 flex items-center justify-center hover:opacity-90 transition-opacity">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M18.0414 17.1875C17.9865 17.2825 17.9076 17.3614 17.8126 17.4163C17.7175 17.4712 17.6097 17.5 17.5 17.5H2.5C2.39034 17.4999 2.28265 17.4709 2.18772 17.416C2.0928 17.3611 2.01399 17.2822 1.95921 17.1872C1.90444 17.0922 1.87561 16.9845 1.87564 16.8748C1.87567 16.7652 1.90455 16.6575 1.95938 16.5625C3.14922 14.5055 4.98281 13.0305 7.12266 12.3312C6.06419 11.7011 5.24183 10.741 4.78186 9.59828C4.3219 8.45556 4.24975 7.19344 4.57652 6.00575C4.90328 4.81806 5.61088 3.77046 6.59064 3.02385C7.57041 2.27723 8.76818 1.87287 10 1.87287C11.2318 1.87287 12.4296 2.27723 13.4094 3.02385C14.3891 3.02385 15.0967 4.81806 15.4235 6.00575C15.7502 7.19344 15.6781 8.45556 15.2181 9.59828C14.7582 10.741 13.9358 11.7011 12.8773 12.3312C15.0172 13.0305 16.8508 14.5055 18.0406 16.5625C18.0956 16.6574 18.1246 16.7652 18.1247 16.8749C18.1249 16.9846 18.0961 17.0924 18.0414 17.1875Z" fill="#000000" />
                    </svg>
                </button>
                <!-- Search -->
                <button class="bg-white rounded-full px-3 py-2 flex items-center gap-2 hover:bg-gray-100 transition-colors shadow-sm">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M7.875 13.5C10.9816 13.5 13.5 10.9816 13.5 7.875C13.5 4.7684 10.9816 2.25 7.875 2.25C4.7684 2.25 2.25 4.7684 2.25 7.875C2.25 10.9816 4.7684 13.5 7.875 13.5Z" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M11.8526 11.8526L15.75 15.75" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-black text-[14px] font-['DM_Sans',sans-serif] font-medium hidden sm:inline">Zoek</span>
                </button>
                <!-- Language -->
                <div class="hidden sm:flex items-center gap-1 cursor-pointer group">
                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none">
                        <path d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z" stroke="#cdbca6" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M10.5 8C10.5 12 8 14 8 14C8 14 5.5 12 5.5 8C5.5 4 8 2 8 2C8 2 10.5 4 10.5 8Z" stroke="#cdbca6" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2.34125 6H13.6587" stroke="#cdbca6" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2.34125 10H13.6587" stroke="#cdbca6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-[#cdbca6] text-[14px] font-['DM_Sans',sans-serif] font-bold">NL</span>
                </div>
                <!-- Hamburger (mobile only) -->
                <button id="hamburger-btn" aria-label="Menu" class="bg-[#cdbca6] rounded-full p-2 flex items-center justify-center hover:opacity-90 transition-opacity">
                    <span class="flex flex-col gap-[3px] justify-center items-center w-5 h-5">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </span>
                </button>
            </div>
        </div>

        <!-- Mobile dropdown menu -->
        <div id="mobile-menu">
            <?php if ($menu_items) : ?>
                <?php foreach ($menu_items as $item) : ?>
                    <a href="<?php echo esc_url($item->url); ?>">
                        <?php echo esc_html($item->title); ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </nav>
