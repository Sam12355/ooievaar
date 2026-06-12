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
    height: 400px !important;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    background: #36221d;
    overflow: hidden;
    padding-top: 96px;
    padding-bottom: 56px;
    display: flex;
    align-items: center;
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
            <button class="avw-over-carousel-nav avw-over-carousel-prev" onclick="scrollCarouselById('carousel-track', -1)">‹</button>
            <button class="avw-over-carousel-nav avw-over-carousel-next" onclick="scrollCarouselById('carousel-track', 1)">›</button>
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

    <!-- TAB: GESCHIEDENIS -->
    <div class="avw-over-tab-content" id="tab-geschiedenis">
        <h2 class="avw-over-section-title">Geschiedenis</h2>

        <div class="avw-over-text">
            <p>'A.van Wees distilleerderij de Ooievaar' stamt uit 1782. Adriaan van Wees, neemt in 1922 distilleerderij en wijnkoperij Henri Matveld anno 1883 over. Hij vestigt zich in de Driehoekstraat. Tot 1970 leverden wij onze producten in vaten en mandflessen aan cafés en restaurants door heel Nederland. Eind jaren zeventig kiest Cees van Wees voor de corebusiness: ambachtelijk distilleren. Hij stoot alle andere activiteiten af. Kleindochter Fenny van Wees heeft het stokje overgenomen. Achterkleindochter Nikki leert inmiddels ook het ambacht.</p>
            <p>De reputatie van onze distilleerderij is gebaseerd op het verleden. Deze oorsprong, onze betrokkenheid bij de producten en extreme interesse in ons vak, houdt ons verre van massaproductie. Niet voor niets is ons ambacht fijndistillatie op de Nationale Inventaris Immaterieel Erfgoed geplaatst. Als hoeder van dit ooit zo befaamde Nederlands vakmanschap hebben wij ons verplicht het ambacht in stand te houden en uit te dragen.</p>
            <p>Maar weinig mensen weten dat Nederland toonaangevend is geweest op het gebied van gedistilleerd. Nederlanders beheersten als eersten de kunst om uitstekende gedistilleerde producten te maken van landbouwproducten. Hun distilleertechnieken werden wereldwijd overgenomen.</p>
        </div>

        <!-- CAROUSEL -->
        <div class="avw-over-carousel">
            <div class="avw-over-carousel-track" id="carousel-track-geschiedenis">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/geschiedenis1.png" alt="Geschiedenis" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/geschiedenis2.png" alt="Geschiedenis" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/geschiedenis3.png" alt="Geschiedenis" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/geschiedenis4.png" alt="Geschiedenis" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/geschiedenis5.png" alt="Geschiedenis" class="avw-over-carousel-slide" />
            </div>
            <button class="avw-over-carousel-nav avw-over-carousel-prev" onclick="scrollCarouselById('carousel-track-geschiedenis', -1)">‹</button>
            <button class="avw-over-carousel-nav avw-over-carousel-next" onclick="scrollCarouselById('carousel-track-geschiedenis', 1)">›</button>
        </div>
    </div>

    <!-- TAB: DISTILLEERPROCES -->
    <div class="avw-over-tab-content" id="tab-distilleerproces">
        <h2 class="avw-over-section-title">Distilleerproces</h2>

        <h3 class="avw-over-subtitle">Subtiele geur en smaak dankzij vakkundig distilleren</h3>
        <div class="avw-over-divider"></div>
        <div class="avw-over-text">
            <p>Bij Van Wees stoken we in koperen fijnketels tot 240 liter. Door vakkundig distilleren van de fijnste grondstoffen ontstaan producten met een subtiele geur en smaak. Brandewijn en moutwijn dienen als dragers van smaak. Brandewijn stoken we zelf. Moutwijn kopen wij bij branders (moutwijnstokers). We distilleren ze met jeneverbessen en kruiden nog een 4e en 5e keer. Zoals eeuwen geleden toen Amsterdamse fijndistillateurs moutwijn uit Weesp en Schiedam kochten en verfijnden. Fijndistillateurs zijn geen branders. Branders zijn geen fijndistillateurs. Ieder zijn vak.</p>
        </div>

        <!-- TWO COLUMN: text left, image right -->
        <div class="avw-over-two-col" style="align-items: start;">
            <div>
                <h3 class="avw-over-subtitle">Alle ingrediënten zijn puur natuur</h3>
                <div class="avw-over-divider"></div>
                <div class="avw-over-text">
                    <p>Onze producten worden gemaakt van distillaten. Creatieve composities van natuurlijke ingrediënten en dat proeft u. Dankzij onze kennis van vruchten, bloemen, planten, wortels, noten en zaden kunnen we een uitgebalanceerde smaak creëren zonder kunstmatige aroma's. Elk product is puur natuur, verkregen via het aloude proces van distilleren. Een techniek die zich eind 14e eeuw ontwikkelt. Eind 15e eeuw stookt men hoofdzakelijk brandewijn van wijnen. In de eeuwen erna worden graandistillaten ontwikkeld: moutwijn, ook wel Corenwijn genoemd. Pas in de 19e eeuw komt de techniek van fijndistillatie met name in Amsterdam tot volle wasdom en ontstaat de genever die wij nog steeds stoken. Dubbele Amsterdamse genevers en likeuren gestookt in ketels met een rectificatiebol verwerven wereldfaam.</p>

                    <h3 class="avw-over-subtitle" style="margin-top: 32px;">Onze werkwijze</h3>
                    <div class="avw-over-divider"></div>
                    <ul>
                        <li>Voor we gaan stoken vullen we de ketel met vaste en vloeibare ingrediënten.</li>
                        <li>Dan verhitten we de ketel tot een temperatuur van ongeveer 78°C.</li>
                        <li>De brandewijn (voor esprit) of moutwijn (genever) en de daarin opgeloste etherische oliën scheidt zich door verdamping af van het water en trekt via de helm van de ketel naar de rectificeerbol.</li>
                        <li>Door het koelwater dat over de buitenkant van de rectificeerbol loopt, condenseert de damp. De condens belandt vervolgens via een serpentine in het koelvat eronder, waar het verder afkoelt.</li>
                        <li>De geconcentreerde condens verlaat het koelvat via de uitloop en wordt daar opgevangen. Zo ontstaan de zogenaamde 'esprits' en geneverdistillaten die de basis vormen voor al onze producten.</li>
                        <li>De laatste stap is het bepalen van het alcoholpercentage van de distillaten, waarna ze in vaten, stenen pot of RVS-tanks worden opgeslagen.</li>
                    </ul>
                </div>
            </div>
            <div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/distilleerproces.png" alt="Distilleerproces" style="width: 100%; border-radius: 16px; display: block;" />
            </div>
        </div>

        <!-- FULL WIDTH IMAGE -->
        <div style="margin-top: 40px;">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/distilleerproces2.png" alt="Distilleerproces" style="width: 100%; border-radius: 16px; display: block;" />
        </div>
    </div>

    <!-- TAB: BOTTELARIJ -->
    <div class="avw-over-tab-content" id="tab-bottelarij">
        <h2 class="avw-over-section-title">Bottelarij</h2>

        <div class="avw-over-text">
            <p>We bottelen al onze producten handmatig of halfautomatisch. Ook de afwerking van de kruiken en flessen – met kurk- en schroefdoppen, linten, krimpcapsules, etiketten en lakzegels – doen we voornamelijk met de hand.</p>
        </div>

        <!-- CAROUSEL -->
        <div class="avw-over-carousel">
            <div class="avw-over-carousel-track" id="carousel-track-bottelarij">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/bottelarij1.png" alt="Bottelarij" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/bottelarij2.png" alt="Bottelarij" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/bottelarij3.png" alt="Bottelarij" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/bottelarij4.png" alt="Bottelarij" class="avw-over-carousel-slide" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/bottelarij5.png" alt="Bottelarij" class="avw-over-carousel-slide" />
            </div>
            <button class="avw-over-carousel-nav avw-over-carousel-prev" onclick="scrollCarouselById('carousel-track-bottelarij', -1)">‹</button>
            <button class="avw-over-carousel-nav avw-over-carousel-next" onclick="scrollCarouselById('carousel-track-bottelarij', 1)">›</button>
        </div>
    </div>

    <!-- TAB: LAGERKELDER -->
    <div class="avw-over-tab-content" id="tab-lagerkelder">
        <h2 class="avw-over-section-title">Lagerkelder</h2>

        <div class="avw-over-text">
            <p>Afhankelijk van het type worden onze genevers op eikenhouten fusten bewaard, gerijpt of gelagerd. Naarmate ze langer op vat liggen, ontwikkelt zich een zachte, rijkgeschakeerde smaak. De kunst is om de genevers te bottelen wanneer de smaakbalans perfect is. Naast genevers lageren we meer producten. Zo bewaren we onze Kaneellikeur bijvoorbeeld tien jaar op vat en onze rums twee tot minimaal 15 jaar.</p>
        </div>

        <div style="margin-top: 40px;">
            <h3 class="avw-over-subtitle">Echte oude genever</h3>
            <div class="avw-over-divider"></div>
            <div class="avw-over-text">
                <p>Onze oude genever is écht oud; de oudste wordt maar liefst twintig jaar gelagerd. Een groot verschil met de zogenaamde 'oude' jenevers uit fabrieken: die worden direct na aanmaak gebotteld voor distributie en consumptie. Fabrieksjenevers zijn dus niet gerijpt.</p>
            </div>
        </div>

        <!-- IMAGE -->
        <div style="margin-top: 40px;">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/lagerkelder.png" alt="Lagerkelder" style="width: 100%; border-radius: 16px; display: block;" />
        </div>
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

function scrollCarouselById(trackId, direction) {
    const track = document.getElementById(trackId);
    if (!track) return;
    const slideWidth = track.querySelector('.avw-over-carousel-slide').offsetWidth + 16; // width + gap
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

// Auto-scroll all carousels every 3 seconds
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.avw-over-carousel').forEach(function(carousel) {
        const track = carousel.querySelector('.avw-over-carousel-track');
        if (!track || !track.id) return;
        const trackId = track.id;

        let autoScroll = setInterval(function() {
            scrollCarouselById(trackId, 1);
        }, 3000);

        // Pause on hover
        carousel.addEventListener('mouseenter', function() {
            clearInterval(autoScroll);
        });
        carousel.addEventListener('mouseleave', function() {
            autoScroll = setInterval(function() {
                scrollCarouselById(trackId, 1);
            }, 3000);
        });
    });
});
</script>

<?php get_footer(); ?>
