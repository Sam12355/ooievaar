<?php
/**
 * Template Name: Over
 * Slug: over
 *
 * @package avw-distillery
 */

get_header();

$googtrans = isset($_COOKIE['googtrans']) ? $_COOKIE['googtrans'] : '';
$is_en    = ( strpos( $_SERVER['REQUEST_URI'], '/en/' ) !== false ) || ( strpos( $googtrans, '/en' ) !== false );
?>

<style>
.avw-over-hero {
    width: 100vw;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    background: #36221d;
    overflow: hidden;
    padding-top: 96px;
    padding-bottom: 56px;
}
.avw-over-hero-img {
    position: absolute;
    top: -30%;
    left: 0;
    width: 100%;
    height: 160%;
    object-fit: cover;
    object-position: center 25%;
    opacity: 0.45;
}
.avw-over-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-over-hero-content {
    position: relative;
    z-index: 10;
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
    padding: 0 24px;
}
.avw-over-breadcrumb {
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: rgba(238,223,203,0.7);
    margin-bottom: 20px;
}
.avw-over-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; transition: color 0.2s; }
.avw-over-breadcrumb a:hover { color: #fff; }
.avw-over-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(42px, 7vw, 80px);
    color: #eedfcb;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    font-weight: normal;
    margin: 0;
    line-height: 1.05;
    text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* ---- TABS ---- */
.avw-over-body {
    width: 80%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 60px 0 100px;
}

.avw-over-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 48px;
    border-bottom: 2px solid rgba(54,34,29,0.1);
}

.avw-over-tab-btn {
    background: none;
    border: none;
    padding: 16px 24px;
    font-family: 'Kurversbrug', serif;
    font-size: 16px;
    color: rgba(54,34,29,0.6);
    text-transform: uppercase;
    letter-spacing: 0.08em;
    cursor: pointer;
    transition: all 0.2s;
    border-bottom: 3px solid transparent;
    margin-bottom: -2px;
}

.avw-over-tab-btn:hover {
    color: #36221d;
}

.avw-over-tab-btn.active {
    color: #36221d;
    border-bottom-color: #432B25;
    font-weight: 600;
}

.avw-over-tab-content {
    display: none;
}

.avw-over-tab-content.active {
    display: block;
}

/* ---- CAROUSEL ---- */
.avw-over-carousel {
    position: relative;
    margin: 40px 0;
    background: #f5ede3;
    border-radius: 16px;
    padding: 16px;
}

.avw-over-carousel-track {
    display: flex;
    gap: 16px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.avw-over-carousel-track::-webkit-scrollbar {
    display: none;
}

.avw-over-carousel-slide {
    flex: 0 0 calc((100% - 32px) / 3);
    width: calc((100% - 32px) / 3);
    height: 280px;
    border-radius: 12px;
    object-fit: cover;
    background: #ddd;
}

.avw-over-carousel-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(54,34,29,0.7);
    color: white;
    border: none;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    transition: background 0.2s;
    z-index: 10;
}

.avw-over-carousel-nav:hover {
    background: rgba(54,34,29,0.9);
}

.avw-over-carousel-prev {
    left: 16px;
}

.avw-over-carousel-next {
    right: 16px;
}

/* ---- TWO COLUMN SECTIONS ---- */
.avw-over-two-col {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    margin: 60px 0;
}

.avw-over-section-title {
    font-family: 'Kurversbrug', serif;
    font-size: 20px;
    color: #36221d;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    font-weight: normal;
    margin: 0 0 24px;
}

.avw-over-subtitle {
    font-family: 'Kurversbrug', serif;
    font-size: 16px;
    color: #36221d;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-weight: normal;
    margin: 0 0 16px;
}

.avw-over-divider {
    width: 48px;
    height: 3px;
    background: linear-gradient(90deg, rgba(0,0,0,0.2), rgba(0,0,0,0.2)), #432B25;
    border-radius: 3px;
    margin: 0 0 24px;
}

.avw-over-text {
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    line-height: 1.8;
    color: rgba(54,34,29,0.8);
}

.avw-over-text p {
    margin-bottom: 16px;
}

.avw-over-text p:last-child {
    margin-bottom: 0;
}

.avw-over-text ul {
    margin: 16px 0;
    padding-left: 24px;
}

.avw-over-text li {
    margin-bottom: 8px;
}

/* ---- BORDER TITLE ---- */
.avw-over-bordered-title {
    font-family: 'Kurversbrug', serif;
    font-size: 24px;
    color: #36221d;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    font-weight: normal;
    margin: 60px 0 40px;
    padding-top: 40px;
    padding-bottom: 40px;
    border-top: 2px solid rgba(54,34,29,0.15);
    border-bottom: 2px solid rgba(54,34,29,0.15);
    text-align: center;
}

@media (max-width: 900px) {
    .avw-over-body { width: 92%; }
    .avw-over-tabs { flex-wrap: wrap; }
    .avw-over-tab-btn { padding: 12px 16px; font-size: 14px; }
    .avw-over-two-col { grid-template-columns: 1fr; gap: 32px; }
    .avw-over-carousel-nav { width: 40px; height: 40px; }
    .avw-over-carousel-slide {
        flex: 0 0 calc((100% - 16px) / 2);
        width: calc((100% - 16px) / 2);
        height: 220px;
    }
}
@media (max-width: 560px) {
    .avw-over-carousel-slide {
        flex: 0 0 100%;
        width: 100%;
        height: 200px;
    }
}
</style>

<!-- HERO -->
<section class="avw-over-hero">
    <img id="over-hero-img" class="avw-over-hero-img" src="<?php echo home_url('/wp-content/uploads/2026/05/d_Image_a6mnka6mnka6mnka.jpg'); ?>" alt="A. van Wees Distilleerderij De Ooievaar" />
    <div class="avw-over-hero-overlay"></div>
    <div class="avw-over-hero-content">
        <nav class="avw-over-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;">Over</span>
        </nav>
        <h1 id="over-hero-title" class="avw-over-hero-title">Over Ons</h1>
    </div>
</section>

<!-- TABS & CONTENT -->
<div class="avw-over-body">

    <!-- TAB BUTTONS -->
    <div class="avw-over-tabs">
        <button class="avw-over-tab-btn active" data-tab="distilleerderij">Distilleerderij</button>
        <button class="avw-over-tab-btn" data-tab="geschiedenis">Geschiedenis</button>
        <button class="avw-over-tab-btn" data-tab="distilleerproces">Distilleerproces</button>
        <button class="avw-over-tab-btn" data-tab="bottelarij">Bottelarij</button>
        <button class="avw-over-tab-btn" data-tab="lagerkelder">Lagerkelder</button>
    </div>

    <!-- TAB: DISTILLEERDERIJ -->
    <div class="avw-over-tab-content active" id="tab-distilleerderij">
        <h2 class="avw-over-section-title">Distilleerderij</h2>

        <div class="avw-over-text">
            <p><strong>A.van Wees anno 1883 distilleerderij de Ooievaar anno 1782</strong> omvat de enig overgebleven, ambachtelijke distilleerderij in Amsterdam. U vindt ons in de Driehoekstraat in het hart van de Jordaan. We distilleren producten met natuurlijke ingrediënten, op basis van oorspronkelijke receptuur – en dat proeft u. Onze specialiteiten? Tongstrelende Oudhollandse genevers en likeuren.</p>
        </div>

        <!-- CAROUSEL -->
        <div class="avw-over-carousel">
            <div class="avw-over-carousel-track" id="carousel-track">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/distilleerderij1.png" alt="Distilleerderij" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/distilleerderij2.png" alt="Distilleerderij" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/distilleerderij3.png" alt="Distilleerderij" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/distilleerderij4.png" alt="Distilleerderij" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/distilleerderij5.png" alt="Distilleerderij" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/distilleerderij6.png" alt="Distilleerderij" class="avw-over-carousel-slide" />
            </div>
            <button class="avw-over-carousel-nav avw-over-carousel-prev" onclick="scrollCarousel(-1)">‹</button>
            <button class="avw-over-carousel-nav avw-over-carousel-next" onclick="scrollCarousel(1)">›</button>
        </div>

        <!-- TWO COLUMN SECTION 1 -->
        <div class="avw-over-two-col">
            <div>
                <h3 class="avw-over-subtitle">Genevers en likeuren van uitzonderlijke kwaliteit</h3>
                <div class="avw-over-divider"></div>
                <div class="avw-over-text">
                    <p>Wij distilleren nog echt, wat een zeldzaamheid is in deze tijd. Weet u hoe de meeste jenevers, likeuren (en gins) tegenwoordig gefabriceerd worden? Door niet-gedistilleerde aroma's toe te voegen aan alcohol. Dit proces – ook wel 'koude methode' genoemd – heeft niets met distilleren te maken. In feite levert het surrogaten op. Bij Van Wees en de Ooievaar houden we het bij puur en onvervalst. Met onze producten bent u verzekerd van echtheid en topkwaliteit.</p>
                </div>
            </div>
            <div>
                <h3 class="avw-over-subtitle">Geestrijke vloeibare kunstwerkjes</h3>
                <div class="avw-over-divider"></div>
                <div class="avw-over-text">
                    <p>In de compositie van onze producten leggen we onze ziel en zaligheid. Onze passie gaat gepaard met kennis en kunde. We weten veel over de smaakeigenschappen van vruchten, bloemen, planten, wortels en zaden. Met deze kennis creëren we een uitgebalanceerde smaak zonder kunstmatige aroma's. We brengen onze dranken op het oog op kleur met natuurlijke kleurstoffen. Zo maken we geestrijke vloeibare kunstwerkjes.</p>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN STANDALONE -->
        <div style="margin: 60px 0;">
            <h3 class="avw-over-subtitle">Een uniek familiebedrijf met een rijke traditie</h3>
            <div class="avw-over-divider"></div>
            <div class="avw-over-text">
                <p>De kneepjes van het vak zijn overgedragen van vader op kinderen. Door de generaties heen hebben we onze kennis uitgebreid en verdiept. Zodoende verstaan we de kunst om smaken te verfijnen zonder concessies te doen aan de traditionele bereidingswijze. Typische kenmerken van onze familie zijn:</p>
                <ul>
                    <li>liefde voor puurheid</li>
                    <li>een voortreffelijke neus</li>
                    <li>gevoel voor timing en smaakbalans</li>
                    <li>uitgebreide vakkennis</li>
                    <li>hoge kwaliteitsnormen</li>
                </ul>
                <p>Deze kenmerken vindt u terug in al onze producten. U proeft de klasse en de finesse!</p>
            </div>
        </div>

        <!-- BORDERED TITLE -->
        <h2 class="avw-over-bordered-title">De ontwikkeling van het bedrijf</h2>

        <!-- TWO COLUMN SECTION 2 -->
        <div class="avw-over-two-col">
            <div>
                <h3 class="avw-over-subtitle">Amsterdams karakter en Haagse allure</h3>
                <div class="avw-over-divider"></div>
                <div class="avw-over-text">
                    <p><strong>A.van Wees anno 1883</strong> en <strong>de Ooievaar anno 1782</strong> is een samenvoeging van twee ambachtelijke bedrijven:</p>
                    <ul>
                        <li>de in 1883 in Amsterdam gevestigde distilleerderij, likeur- en brandewijnstokerij van de familie A. van Wees;</li>
                        <li>de in 1782 in Den Haag opgerichte Stokerij en Bitterfabriek De Ooievaar.</li>
                    </ul>
                </div>
            </div>
            <div>
                <h3 class="avw-over-subtitle">Van fust naar fles: B2B en B2C</h3>
                <div class="avw-over-divider"></div>
                <div class="avw-over-text">
                    <p>Aanvankelijk leverden wij uitsluitend dranken op fust aan horecabedrijven en handel. In de jaren 70 van de vorige eeuw kwam daar verandering in, toen vakslijters onze genevers en likeuren opnamen in hun assortiment.</p>
                </div>
            </div>
        </div>

        <!-- FULL WIDTH SECTION -->
        <div style="margin-top: 60px;">
            <h3 class="avw-over-subtitle">Stijgende omzet door groeiend aantal liefhebbers</h3>
            <div class="avw-over-divider"></div>
            <div class="avw-over-text">
                <p>Uit onze stijgende omzetcijfers blijkt dat de groep liefhebbers van het Oudhollandse distillaat nog steeds groeit. Niet alleen in Nederland maar ook in Groot-Brittanië vinden onze producten gretig aftrek. De Britten zijn lyrisch over onze genevers en gins en lusten wel pap van onze Yuzulikeur en Roosje zonder doornen.</p>
            </div>
        </div>
    </div>

    <!-- PLACEHOLDER TABS (can be filled with content later) -->
    <div class="avw-over-tab-content" id="tab-geschiedenis">
        <h2 class="avw-over-section-title">Geschiedenis</h2>
        <p style="font-family: 'DM Sans', sans-serif; line-height: 1.8; color: rgba(54,34,29,0.8);">Content coming soon...</p>
    </div>

    <div class="avw-over-tab-content" id="tab-distilleerproces">
        <h2 class="avw-over-section-title">Distilleerproces</h2>
        <p style="font-family: 'DM Sans', sans-serif; line-height: 1.8; color: rgba(54,34,29,0.8);">Content coming soon...</p>
    </div>

    <div class="avw-over-tab-content" id="tab-bottelarij">
        <h2 class="avw-over-section-title">Bottelarij</h2>
        <p style="font-family: 'DM Sans', sans-serif; line-height: 1.8; color: rgba(54,34,29,0.8);">Content coming soon...</p>
    </div>

    <div class="avw-over-tab-content" id="tab-lagerkelder">
        <h2 class="avw-over-section-title">Lagerkelder</h2>
        <p style="font-family: 'DM Sans', sans-serif; line-height: 1.8; color: rgba(54,34,29,0.8);">Content coming soon...</p>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabBtns = document.querySelectorAll('.avw-over-tab-btn');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');

            // Remove active from all
            tabBtns.forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.avw-over-tab-content').forEach(c => c.classList.remove('active'));

            // Add active to clicked
            this.classList.add('active');
            document.getElementById('tab-' + tabId).classList.add('active');
        });
    });
});

function getSlideWidth() {
    const track = document.getElementById('carousel-track');
    return track.querySelector('.avw-over-carousel-slide').offsetWidth + 16; // width + gap
}

function scrollCarousel(direction) {
    const track = document.getElementById('carousel-track');
    const slideWidth = getSlideWidth();
    const maxScroll = track.scrollWidth - track.clientWidth;

    if (direction > 0) {
        // Scrolling right — if at end, loop back to start
        if (track.scrollLeft >= maxScroll - 5) {
            track.scrollLeft = 0;
        } else {
            track.scrollLeft += slideWidth;
        }
    } else {
        // Scrolling left — if at start, loop to end
        if (track.scrollLeft <= 5) {
            track.scrollLeft = maxScroll;
        } else {
            track.scrollLeft -= slideWidth;
        }
    }
}

// Auto-scroll the carousel every 3 seconds
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.avw-over-carousel');
    let autoScroll = setInterval(function() {
        scrollCarousel(1);
    }, 3000);

    // Pause on hover
    if (carousel) {
        carousel.addEventListener('mouseenter', function() {
            clearInterval(autoScroll);
        });
        carousel.addEventListener('mouseleave', function() {
            autoScroll = setInterval(function() {
                scrollCarousel(1);
            }, 3000);
        });
    }
});
</script>

<?php get_footer(); ?>
