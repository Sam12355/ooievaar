<?php
/**
 * Template Name: Assortiment / Over de Producten
 *
 * @package avw-distillery
 */

get_header();

$googtrans = isset($_COOKIE['googtrans']) ? $_COOKIE['googtrans'] : '';
$is_en    = ( strpos( $_SERVER['REQUEST_URI'], '/en/' ) !== false ) || ( strpos( $googtrans, '/en' ) !== false );
?>

<style>
/* ============================================================
   OVER DE PRODUCTEN
   ============================================================ */
.avw-odp-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-odp-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 40%; opacity: 0.45;
}
.avw-odp-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-odp-hero-content {
    position: relative; z-index: 10;
    max-width: 900px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-odp-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-odp-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-odp-breadcrumb a:hover { color: #fff; }
.avw-odp-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(36px, 6vw, 72px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.05; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* ---- Sticky tabs ---- */
.avw-odp-tabs-wrap {
    position: sticky; top: 80px; z-index: 50;
    background: #fff; border-bottom: 2px solid rgba(54,34,29,0.08);
    width: 100vw; position: sticky; left: 50%; transform: none;
    box-shadow: 0 2px 16px rgba(54,34,29,0.06);
}
.avw-odp-tabs {
    display: flex; align-items: center; justify-content: center;
    gap: 0; max-width: 900px; margin: 0 auto; padding: 0 24px;
    overflow-x: auto; scrollbar-width: none;
}
.avw-odp-tabs::-webkit-scrollbar { display: none; }
.avw-odp-tab {
    font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.1em; color: rgba(54,34,29,0.5);
    background: none; border: none; cursor: pointer;
    padding: 18px 22px; border-bottom: 3px solid transparent;
    white-space: nowrap; transition: color 0.2s, border-color 0.2s;
    margin-bottom: -2px;
}
.avw-odp-tab:hover { color: #36221d; }
.avw-odp-tab.active { color: #36221d; border-bottom-color: #432B25; }

/* ---- Body ---- */
.avw-odp-body { width: 80%; max-width: 1400px; margin: 0 auto; padding: 72px 0 100px; }

/* ---- Tab sections ---- */
.avw-odp-section { display: none; }
.avw-odp-section.active { display: block; }

/* ---- Quick nav ---- */
.avw-odp-quicknav {
    background: #fdf8f1; border-radius: 16px; padding: 20px 28px;
    margin-bottom: 52px; border-left: 4px solid #432B25;
}
.avw-odp-quicknav-title {
    font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.14em; color: rgba(54,34,29,0.45);
    margin: 0 0 10px;
}
.avw-odp-quicknav ol { margin: 0; padding-left: 20px; }
.avw-odp-quicknav ol li { font-family: 'DM Sans', sans-serif; font-size: 14px; margin-bottom: 4px; }
.avw-odp-quicknav ol li a { color: #432B25; text-decoration: none; }
.avw-odp-quicknav ol li a:hover { text-decoration: underline; }

/* ---- Two column layout ---- */
.avw-odp-2col {
    display: grid; grid-template-columns: 1fr 1fr; gap: 48px;
    align-items: start; margin-bottom: 64px;
}
.avw-odp-2col.img-right .avw-odp-img-wrap { order: 2; }
.avw-odp-2col.img-left .avw-odp-img-wrap { order: 1; }
.avw-odp-2col.img-left .avw-odp-text { order: 2; }

/* ---- Image parallax wrapper ---- */
.avw-odp-img-wrap {
    border-radius: 20px; overflow: hidden;
    position: relative; height: 520px;
    box-shadow: 0 8px 40px rgba(54,34,29,0.12);
}
.avw-odp-img-wrap img {
    width: 100%; height: 140%; object-fit: cover; object-position: center;
    position: absolute; top: -20%; left: 0;
}

/* ---- Headings and text ---- */
.avw-odp-h1 {
    font-family: 'Kurversbrug', serif; font-size: 32px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.1em; font-weight: normal;
    margin: 0 0 40px; padding-bottom: 16px;
    border-bottom: 2px solid rgba(54,34,29,0.12);
}
.avw-odp-h2 {
    font-family: 'Kurversbrug', serif; font-size: 22px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.08em; font-weight: normal;
    margin: 36px 0 14px;
}
.avw-odp-h2:first-child { margin-top: 0; }
.avw-odp-h3 {
    font-family: 'Kurversbrug', serif; font-size: 17px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.08em; font-weight: normal;
    margin: 28px 0 10px;
}
.avw-odp-p {
    font-family: 'DM Sans', sans-serif; font-size: 15px; line-height: 1.85;
    color: rgba(54,34,29,0.78); margin-bottom: 16px;
}
.avw-odp-ul { list-style: none; padding: 0; margin: 0 0 20px; }
.avw-odp-ul li {
    font-family: 'DM Sans', sans-serif; font-size: 15px; line-height: 1.7;
    color: rgba(54,34,29,0.78); padding: 8px 12px 8px 30px;
    position: relative; margin-bottom: 4px;
}
.avw-odp-ul li::before { content: '–'; position: absolute; left: 10px; color: #432B25; font-weight: 700; }

/* ---- Full-width text block ---- */
.avw-odp-fullblock { margin-bottom: 56px; }

/* ---- Legal comparison block ---- */
.avw-odp-legal { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 48px; }
.avw-odp-legal-card {
    background: #fdf8f1; border-radius: 16px; padding: 28px 28px;
    border: 1px solid rgba(54,34,29,0.08);
}
.avw-odp-legal-card.brand { background: #36221d; }
.avw-odp-legal-card.brand .avw-odp-h3 { color: #eedfcb; }
.avw-odp-legal-card.brand .avw-odp-p,
.avw-odp-legal-card.brand .avw-odp-ul li { color: rgba(238,223,203,0.85); }
.avw-odp-legal-card.brand .avw-odp-ul li::before { color: #eedfcb; }

/* ---- Divider ---- */
.avw-odp-divider { border: none; border-top: 1px solid rgba(54,34,29,0.08); margin: 56px 0; }

/* ---- Full-width image ---- */
.avw-odp-img-full {
    border-radius: 20px; overflow: hidden;
    position: relative; height: 440px; margin-bottom: 56px;
    box-shadow: 0 8px 40px rgba(54,34,29,0.12);
}
.avw-odp-img-full img {
    width: 100%; height: 140%; object-fit: cover; object-position: center;
    position: absolute; top: -20%; left: 0;
}

@media (max-width: 960px) {
    .avw-odp-body { width: 92%; }
    .avw-odp-2col { grid-template-columns: 1fr; gap: 32px; }
    .avw-odp-2col.img-right .avw-odp-img-wrap,
    .avw-odp-2col.img-left .avw-odp-img-wrap { order: 0; }
    .avw-odp-2col.img-left .avw-odp-text { order: 0; }
    .avw-odp-img-wrap { height: 320px; }
    .avw-odp-legal { grid-template-columns: 1fr; }
    .avw-odp-tabs { justify-content: flex-start; }
}
@media (max-width: 600px) {
    .avw-odp-body { width: 100%; padding-left: 16px; padding-right: 16px; }
    .avw-odp-tab { padding: 14px 14px; font-size: 11px; }
}
</style>

<!-- HERO -->
<section class="avw-odp-hero">
    <img id="odp-hero-img" class="avw-odp-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="<?php echo $is_en ? 'About the Products' : 'Over de Producten'; ?>" />
    <div class="avw-odp-hero-overlay"></div>
    <div class="avw-odp-hero-content">
        <nav class="avw-odp-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <a href="<?php echo $is_en ? home_url('/en/assortiment') : home_url('/assortiment'); ?>"><?php echo $is_en ? 'Assortment' : 'Assortiment'; ?></a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;"><?php echo $is_en ? 'About the Products' : 'Over de Producten'; ?></span>
        </nav>
        <h1 id="odp-hero-title" class="avw-odp-hero-title"><?php echo $is_en ? 'About the Products' : 'Over de Producten'; ?></h1>
    </div>
</section>

<!-- STICKY TABS -->
<div class="avw-odp-tabs-wrap">
    <nav class="avw-odp-tabs">
        <button class="avw-odp-tab active" data-tab="over"><?php echo $is_en ? 'About the products' : 'Over de producten'; ?></button>
        <button class="avw-odp-tab" data-tab="genever">Genever</button>
        <button class="avw-odp-tab" data-tab="likeur"><?php echo $is_en ? 'Liqueur' : 'Likeur'; ?></button>
        <button class="avw-odp-tab" data-tab="gin">Gin</button>
        <button class="avw-odp-tab" data-tab="esprit">Esprit</button>
    </nav>
</div>

<!-- TAB CONTENT -->
<div class="avw-odp-body">

    <!-- ====== TAB 1: ABOUT THE PRODUCTS ====== -->
    <div class="avw-odp-section active" id="tab-over">

        <h2 class="avw-odp-h1"><?php echo $is_en ? 'About the products' : 'Over de producten'; ?></h2>


        <div class="avw-odp-2col img-right" id="over-trad">
            <div class="avw-odp-text">
                <?php if ( $is_en ): ?>
                <h3 class="avw-odp-h2">Traditional and new genevers and liqueurs</h3>
                <p class="avw-odp-p">Through our artisan way of working we uphold a tradition dating back to the 16th century. With the deep distilling knowledge present in our company and a love for a noble craft, we produce Old Dutch spirits of unique quality. At the same time, we use old knowledge to develop new products such as a vegetable liqueur.</p>

                <h3 class="avw-odp-h2">Esprits for patissiers, ice cream makers, chocolatiers and chefs</h3>
                <p class="avw-odp-p">Among our other creations are the so-called esprits, which we supply exclusively to patissiers, ice cream makers, chocolatiers and restaurants. These liquids contain the 'spirit' of our distilled products in concentrated form. They are flavour agents in ice cream, chocolates, pastries and other delicacies.</p>
                <p class="avw-odp-p">Esprits enhance aroma in a natural way. They are easy to measure and blend. Due to their high concentration, only a small amount is needed in any recipe. Pastries, ice cream and chocolates are therefore not unnecessarily moist and retain their quality even after freezing.</p>
                <?php else: ?>
                <h3 class="avw-odp-h2">Traditionele en nieuwe genevers en likeuren</h3>
                <p class="avw-odp-p">Door onze ambachtelijke manier van werken houden wij een traditie in stand die stamt uit de 16e eeuw. Met de grote kennis van distilleren die in ons bedrijf aanwezig is en de liefde voor een edel vak produceren wij Oudhollands gedistilleerd van unieke kwaliteit. Tegelijk ontwikkelen wij met oude kennis nieuwe producten zoals een groentenlikeur.</p>

                <h3 class="avw-odp-h2">Esprits voor patissiers, ijsbereiders, chocolatiers en chef-koks</h3>
                <p class="avw-odp-p">Tot onze overige creaties behoren de zogenaamde esprits, die wij exclusief leveren aan patissiers, ijsbereiders, chocolatiers en restaurants. Deze vloeistoffen bevatten de 'geest' van onze gestookte producten in geconcentreerde vorm. Het zijn smaakmakers in ijs, bonbons, gebak en andere delicatessen.</p>
                <p class="avw-odp-p">Esprits versterken het aroma op natuurlijke wijze. Ze zijn eenvoudig te doseren en te mengen. Door de hoge concentratie is in elk recept slechts een kleine hoeveelheid nodig. Gebak, ijs en chocola worden daardoor niet onnodig vochtig en behouden ook na diepvriezen hun kwaliteit.</p>
                <?php endif; ?>
            </div>
            <div class="avw-odp-img-wrap">
                <img class="avw-odp-parallax-img" src="<?php echo content_url('/uploads/2026/05/odp-over.jpg'); ?>" alt="<?php echo $is_en ? 'Products' : 'Producten'; ?>" />
            </div>
        </div>

        <div class="avw-odp-fullblock" id="over-eetparfums">
            <?php if ( $is_en ): ?>
            <h3 class="avw-odp-h2">Tempting eating perfumes</h3>
            <p class="avw-odp-p">Specially for restaurateurs and home cooks we developed eating perfumes: esprits in atomisers, to spray over food or drinks at the table. A mist over a dish or coffee containing esprit enhances the scent and taste experience. Stand-alone application is also possible — for example cinnamon perfume over a cappuccino.</p>
            <?php else: ?>
            <h3 class="avw-odp-h2">Verleidelijke eetparfums</h3>
            <p class="avw-odp-p">Speciaal voor restaurateurs en hobbykoks ontwikkelden wij eetparfums: esprits in verstuivers, om aan tafel over spijs of drank te sprayen. Een waasje over een gerecht of koffie waarin esprit zit, versterkt de geur- en smaakbeleving. Stand-alone toepassing kan ook, bijvoorbeeld bij kaneelparfum over de cappuccino.</p>
            <?php endif; ?>
        </div>

        <hr class="avw-odp-divider" />

        <div class="avw-odp-2col" id="over-assortiment">
            <div class="avw-odp-text">
                <?php if ( $is_en ): ?>
                <h3 class="avw-odp-h2">Advocaat, Boerenjongens and other Dutch spirits</h3>
                <p class="avw-odp-p">Other traditional products we make include:</p>
                <ul class="avw-odp-ul">
                    <li>Brandy according to authentic recipe</li>
                    <li>Egg liqueurs (Advocaat and Kandeel)</li>
                    <li>Bitters and Herbal bitters (incl. Orange bitters and Beerenburgh)</li>
                    <li>Fruits in brandy (incl. Boerenjongens and Maraschino cherries)</li>
                    <li>Fruit genevers (Lemon genever and Blackcurrant genever)</li>
                    <li>Eaux de vie (incl. Jordaan Pommes and Jordaan Framboises)</li>
                    <li>Gin, whisky and other foreign spirits</li>
                </ul>
                <p class="avw-odp-p">In our range of foreign spirits we carry cask-matured rum, whisky and house-made gin and vodka. Newcomers are the Three Corners Yuzu Distilled Dry Gin and the Three Corners Premium Distilled Dry Gin. We also stock tonic.</p>

                <h3 class="avw-odp-h2">Miniatures</h3>
                <p class="avw-odp-p">Almost all of our products are available as miniatures. Some are very special, such as the Bruidstranen (Bride's Tears). We wrap the Bruidstranen miniatures in tulle, finished with a gold ribbon and a card containing a product description and a blank side for a personal message from the couple to their guests.</p>
                <?php else: ?>
                <h3 class="avw-odp-h2">Advocaat, Boerenjongens en overig Hollands gedistilleerd</h3>
                <p class="avw-odp-p">Andere traditionele producten die we maken zijn:</p>
                <ul class="avw-odp-ul">
                    <li>Brandewijn volgens authentiek recept</li>
                    <li>Eierlikeuren (Advocaat en Kandeel)</li>
                    <li>Bitters en Kruidenbitters (o.a. Oranjebitter en Beerenburgh)</li>
                    <li>Vruchten op brandewijn (o.a. Boerenjongens en Marasquinkersen)</li>
                    <li>Vruchtenjenevers (Citroenjenever en Bessenjenever)</li>
                    <li>Eaux de vie (o.a. Jordaan Pommes en Jordaan Framboises)</li>
                    <li>Gin, whisky en overig buitenlands gedistilleerd</li>
                </ul>
                <p class="avw-odp-p">In ons assortiment buitenlands gedistilleerd voeren we fustgerijpte rum, whisky en huisgemaakte gin en wodka. Nieuwkomers aan het firmament zijn de Three Corners Yuzu Distilled Dry Gin en de Three Corners Premium Distilled Dry Gin. Ook voor tonic kunt u bij ons terecht.</p>

                <h3 class="avw-odp-h2">Miniaturen</h3>
                <p class="avw-odp-p">Vrijwel al onze producten zijn verkrijgbaar als miniaturen. Een aantal daarvan is heel speciaal, zoals de Bruidstranen. We hullen de Bruidstraanminiaturen in tule. Daaromheen doen we een goudkleurig striklint met een kaartje. Dit kaartje bevat een productbeschrijving en een blanco zijde voor een speciale groet van het bruidspaar aan de gasten.</p>
                <?php endif; ?>
            </div>
            <div class="avw-odp-text">
                <?php if ( $is_en ): ?>
                <h3 class="avw-odp-h2">Liqueur chocolates and rum truffles</h3>
                <p class="avw-odp-p">A wonderful combination of Old Dutch and Belgian craftsmanship: liqueur chocolates filled with Old Dutch liqueur from Van Wees and De Ooievaar. Thanks to the crispy sugar shell in which our esprit is incorporated, they taste extra delicious. Needless to say, we use only the finest chocolate — also for our divine rum truffles (filled with Bali Rhum esprit). A truly delightful treat!</p>

                <h3 class="avw-odp-h2">Glassware, Delft blue, porcelain and other gift items</h3>
                <p class="avw-odp-p">In the past it was customary to have commemorative crocks designed for special occasions of the Royal House. At Van Wees and De Ooievaar we cherish this heartwarming tradition. Alongside commemorative crocks we offer a fine selection of collector's items and gift articles. In our webshop you will find:</p>
                <ul class="avw-odp-ul">
                    <li>Commemorative crocks (incl. Coronation crock, Wedding crock and Birth crocks)</li>
                    <li>Delft blue (incl. Dakota, Weesopper VOC Crock, Amsterdam houses)</li>
                    <li>Glassware (engraved liqueur and genever glasses)</li>
                    <li>Corporate gifts (incl. Christmas packages)</li>
                    <li>Gift packaging (incl. wooden boxes)</li>
                </ul>
                <?php else: ?>
                <h3 class="avw-odp-h2">Likeurbonbons en rumbonen</h3>
                <p class="avw-odp-p">Een prachtige combinatie van Oudhollands en Belgisch vakmanschap: likeurbonbons, gevuld met Oudhollandse likeur van Van Wees en de Ooievaar. Dankzij het knapperige suikerlaagje waarin onze esprit is verwerkt, smaken ze extra lekker. Het spreekt voor zich dat we de beste chocolade gebruiken, ook voor onze overheerlijke rumbonen (gevuld met Bali Rhum esprit). Een verrukkelijke traktatie!</p>

                <h3 class="avw-odp-h2">Glaswerk, Delfts blauw, porselein en overige geschenkartikelen</h3>
                <p class="avw-odp-p">Vroeger was het gebruikelijk om herinneringskruiken te laten ontwerpen bij feestelijke gebeurtenissen van het Koninklijk Huis. Bij Van Wees en de Ooievaar houden we deze hartverwarmende traditie in ere. Naast herinneringskruiken bieden we u een keur aan andere collector's items en geschenkartikelen. In onze webshop vindt u:</p>
                <ul class="avw-odp-ul">
                    <li>Herinneringskruiken (o.a. Kroningskruik, Trouwkruik en Geboortekruiken)</li>
                    <li>Delfts blauw (o.a. Dakota, Weesopper VOC-Kruik, Amsterdamse huisjes)</li>
                    <li>Glaswerk (gegraveerde likeur- en geneverglaasjes)</li>
                    <li>Relatiegeschenken (o.a. kerstpakketten)</li>
                    <li>Cadeauverpakkingen (o.a. houten kistjes)</li>
                </ul>
                <?php endif; ?>
            </div>
        </div>

    </div><!-- /tab-over -->


    <!-- ====== TAB 2: GENEVER ====== -->
    <div class="avw-odp-section" id="tab-genever">

        <h2 class="avw-odp-h1">Genever</h2>


        <div class="avw-odp-2col img-right" id="gen-geschiedenis">
            <div class="avw-odp-text">
                <?php if ( $is_en ): ?>
                <h3 class="avw-odp-h2">What is genever and how did it originate?</h3>
                <p class="avw-odp-p">Genever is originally a typical Dutch spirit that owes its name to the juniper berry. Artisan genevers are prepared according to centuries-old Dutch recipes from grain distillates such as malt wine and redistilled malt wine, with the juniper berry (Juniperus) as the prominent ingredient. This berry (formerly called 'beien') was distilled together with the malt wine to be redistilled — both to enrich the flavour and because of the supposedly medicinal properties of the juniper berry. Originally genever was drunk mainly as medicine.</p>

                <h3 class="avw-odp-h2">From medicine to popular drink</h3>
                <p class="avw-odp-p">During the Golden Age Amsterdam was a major European transit port. The abundance of herbs and spices made the city a paradise for distillers. Amsterdam distillers were the first to produce malt wines from grain — and on that basis they distilled genever (running a century ahead of their Schiedam counterparts!). With new ingredients they made the spirit ever more enjoyable, and genever grew into a popular drink in the 17th century.</p>

                <h3 class="avw-odp-h2">Recognisable taste characteristics</h3>
                <p class="avw-odp-p">Every distiller made his own grain genever: according to the traditional method but entirely to his own judgement. This produced characteristic flavour profiles and an exclusive clientele. The Dutch East India Company (VOC), for example, accepted only genever made from redistilled malt wine from Weesp.</p>

                <h3 class="avw-odp-h2">Incomparable</h3>
                <p class="avw-odp-p">The young jenever as we know it today was developed at the end of the 19th century. In terms of flavour and preparation it is incomparable to traditional genever. The invention of column distillation and a surplus of sugar beets gave the Dutch government the idea to produce alcohol cheaply and efficiently.</p>
                <p class="avw-odp-p">The result was an insignificant, flavourless and odourless product that quickly established itself as a replacement for malt wine. Due to its price, the spirit based on molasses alcohol became accessible to everyone. Commerce and new technologies have hopelessly consigned the old craft to oblivion. Almost nobody today knows how perfectly a well-made genever can taste!</p>
                <?php else: ?>
                <h3 class="avw-odp-h2">Wat is genever en hoe is het ontstaan?</h3>
                <p class="avw-odp-p">Genever is van origine een typisch Hollandse sterkedrank, die zijn naam dankt aan de jeneverbes. Ambachtelijke genevers worden volgens eeuwenoude, Hollandse receptuur, bereid uit granendistillaten, zoals moutwijn en geherdistilleerde moutwijn, met de jeneverbes (Juniperus) als prominent ingrediënt. Deze bessensoort (vroeger beien genoemd) werd meegestookt met de te herdistilleren moutwijn: enerzijds om de smaak te verrijken, anderzijds vanwege vermeend geneeskrachtige eigenschappen van de jeneverbes. Van oorsprong werd genever vooral gedronken als medicijn.</p>

                <h3 class="avw-odp-h2">Van geneesmiddel tot populaire borrel</h3>
                <p class="avw-odp-p">In de Gouden Eeuw was Amsterdam een belangrijke Europese doorvoerhaven. De overvloed aan kruiden en specerijen maakte de stad een walhalla voor stokers. Amsterdamse distillateurs produceerden als eersten moutwijnen uit graan. Op basis daarvan stookten zij genever (hiermee liepen zij een eeuw voor op hun Schiedamse vakgenoten!). Met nieuwe ingrediënten maakten zij de sterkedrank steeds lekkerder. Daardoor groeide genever in de 17e eeuw uit tot een populaire borrel.</p>

                <h3 class="avw-odp-h2">Herkenbare smaakeigenschappen</h3>
                <p class="avw-odp-p">Iedere stoker maakte zijn eigen graangenever: volgens de traditionele methode, maar geheel naar eigen inzicht. Dit leverde karakteristieke smaakeigenschappen op, plus een exclusieve klantenkring. De Verenigd Oost-Indische Compagnie (VOC) nam bijvoorbeeld uitsluitend genoegen met genever van geherdistilleerde moutwijn uit Weesp.</p>

                <h3 class="avw-odp-h2">Onvergelijkbaar</h3>
                <p class="avw-odp-p">De jonge jenever zoals we die nu kennen werd eind 19e eeuw ontwikkeld. Qua smaak en bereidingswijze is het onvergelijkbaar met de traditionele genever. De uitvinding van de kolommendistillatie en een overschot aan suikerbieten bracht de Nederlandse overheid op het idee om op een goedkope en efficiënte manier alcohol te maken.</p>
                <p class="avw-odp-p">Het resultaat was een nietszeggend, smaak- en reukloos product, dat al snel zijn intrede deed als vervanger van de moutwijn. Door zijn prijsstelling werd de borrel op basis van melasse alcohol voor iedereen bereikbaar. Door commercie en nieuwe technologieën is het oude ambacht hopeloos in de vergetelheid geraakt. Bijna niemand weet tegenwoordig nog hoe perfect een goed gemaakte genever kan smaken!</p>
                <?php endif; ?>
            </div>
            <div class="avw-odp-img-wrap">
                <img class="avw-odp-parallax-img" src="<?php echo content_url('/uploads/2026/05/odp-genever.jpg'); ?>" alt="Genever" />
                <div style="padding: 32px 0 0;">
                    <?php if ( $is_en ): ?>
                    <h3 class="avw-odp-h2" id="gen-bereiding">Our preparation of genever</h3>
                    <p class="avw-odp-p">We prepare our genevers the artisan way — from grain distillates and botanicals — upholding a tradition dating back to the 16th century. When composing genever types we take into account the different maturation periods of the distillates, creating optimal flavour consistency per type. This method is costly and therefore unique by Dutch standards.</p>
                    <h3 class="avw-odp-h2">Sweet and fruity</h3>
                    <p class="avw-odp-p"><strong>Tip:</strong> If you prefer something sweet and fruity, try one of our fruit genevers! These are not made from genever but from distilled fruits.</p>
                    <?php else: ?>
                    <h3 class="avw-odp-h2" id="gen-bereiding">Onze bereiding van genever</h3>
                    <p class="avw-odp-p">Wij bereiden onze genevers op ambachtelijke wijze, dus van granendistillaten en kruiden. Hiermee houden we een traditie hoog die stamt uit de 16e eeuw. Bij de samenstelling van geneversoorten houden we rekening met verschillen in lagerperiodes van de distillaten. Zo creëren we een optimale smaakconsistentie per soort. Deze werkwijze is kostbaar en daarom uniek voor Nederlandse begrippen.</p>
                    <h3 class="avw-odp-h2">Zoet en fruitig</h3>
                    <p class="avw-odp-p"><strong>Tip:</strong> Houdt u van zoet en fruitig, probeer dan eens een van onze vruchtengenevers! Deze zijn niet bereid van genever maar van gedistilleerde vruchten.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <hr class="avw-odp-divider" />

        <div class="avw-odp-fullblock" id="gen-verschil">
            <?php if ( $is_en ): ?>
            <h3 class="avw-odp-h2">The difference between old and young genever</h3>
            <p class="avw-odp-p">A true old genever is prepared according to the artisan method of before 1900, using redistilled malt wine, juniper berries and botanicals. After preparation the spirit is matured in casks for periods ranging from three months to twenty years (depending on the type of genever).</p>
            <p class="avw-odp-p">Young genever is a more recent invention, owing its existence to the introduction of neutral industrial alcohol distilled to 96.2%. It is a factory product ready immediately for consumption. To justify the loss of flavour the name 'young jenever' was invented. Such a product naturally does not fit the philosophy and principles of our family. That is why we prepare our young genevers in a similar way to our old ones — meaning our young genevers are also made with malt wine and redistilled malt wine.</p>
            <?php else: ?>
            <h3 class="avw-odp-h2">Het verschil tussen oude en jonge genever</h3>
            <p class="avw-odp-p">Een echte oude genever wordt bereid volgens de ambachtelijke methode van vóór 1900, met geherdistilleerde moutwijn, jeneverbessen en kruiden. Na bereiding gaat de drank een tijd op fust om te rijpen: bij ons voor periodes van drie maanden tot twintig jaar (afhankelijk van het type genever).</p>
            <p class="avw-odp-p">Jonge genever is een recentere uitvinding, die zijn ontstaan dankt aan de introductie van neutrale industriële alcohol gestookt tot 96,2%. Het is een fabrieksproduct dat direct klaar is voor consumptie. Om de teloorgang van smaak te rechtvaardigen bedacht men de naam jonge jenever. Zo'n product past uiteraard niet bij de filosofie en principes van onze familie. Daarom bereiden wij onze jonge genevers op soortgelijke wijze als onze oude genevers. Dit betekent dat onze jonge genevers ook met moutwijn en geherdistilleerde moutwijn worden bereid.</p>
            <?php endif; ?>
        </div>

        <div class="avw-odp-2col">
            <div class="avw-odp-text">
                <?php if ( $is_en ): ?>
                <h3 class="avw-odp-h2">Artisan genever versus modern jenever</h3>
                <p class="avw-odp-p">What is the difference between artisan genever and modern jenever? The difference lies in both the recipe and the preparation. Modern — mostly industrial — products rarely contain malt wine, let alone redistilled malt wine or distilled juniper berries and botanicals. Moreover, they never see or smell a wooden cask — so there is no question of maturation. At Van Wees and De Ooievaar we prepare old genever as it should be: from malt wine distilled with juniper berries and botanicals, then matured in casks. Some of our genevers lie on cask for twenty years, and may rightfully be called Zeer Oud (Very Old).</p>
                <?php else: ?>
                <h3 class="avw-odp-h2">Ambachtelijke genever versus moderne jenever</h3>
                <p class="avw-odp-p">Wat is het verschil tussen ambachtelijke genever en moderne jenever? Het verschil zit hem zowel in de receptuur als in de bereidingswijze. Moderne – veelal industriële – producten bevatten zelden moutwijn, geherdistilleerde moutwijn laat staan gedistilleerde jeneverbessen en kruiden. Bovendien zien of ruiken ze nooit een houten vat; van rijping is dus geen sprake. Bij Van Wees en de Ooievaar bereiden we oude genever zoals het hoort: van moutwijn gedistilleerd met jeneverbessen en kruiden. Vervolgens lageren we de drank, zodat deze rijpt. Sommige van onze genevers liggen zeker twintig jaar op fust. Zij mogen daarom met recht Zeer Oud genoemd worden.</p>
                <?php endif; ?>
            </div>
            <div class="avw-odp-text">
                <?php if ( $is_en ): ?>
                <h3 class="avw-odp-h2">The law and Van Wees</h3>
                <p class="avw-odp-p">Initially European legislation set only brief requirements for what genever had to meet in order to be called genever. In 2015 new regulations on distilled beverages came into force, but genever had been dropped due to disagreements between the four genever-producing countries: Germany, France, Belgium and the Netherlands could not agree on the requirements. Since then, genever has been unregulated. If you would like to know more, our book covers this in depth.</p>
                <?php else: ?>
                <h3 class="avw-odp-h2">De wet en Van Wees</h3>
                <p class="avw-odp-p">Aanvankelijk bepaalde de Europese wetgeving summier waaraan genever moest voldoen om genever te mogen heten. In 2015 kwam er nieuwe regelgeving omtrent gedistilleerde dranken. Genever was daarin vervallen, door onenigheid tussen de vier genever producerende landen: Duitsland, Frankrijk, België en Nederland waren het niet eens over de eisen waaraan genever moet voldoen. Sindsdien is genever vogelvrij. Wilt u daar meer over weten? In ons boek gaan we er uitgebreid op in.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="avw-odp-legal">
            <div class="avw-odp-legal-card">
                <?php if ( $is_en ): ?>
                <h3 class="avw-odp-h3">Legal requirements — Young jenever</h3>
                <ul class="avw-odp-ul">
                    <li>Prepared from ethyl alcohol of agricultural origin with a maximum of 15% malt wine</li>
                    <li>Maximum 10 grams of sugar per litre</li>
                    <li>Minimum alcohol content 35%</li>
                </ul>
                <?php else: ?>
                <h3 class="avw-odp-h3">Wettelijke eisen Jonge jenever</h3>
                <ul class="avw-odp-ul">
                    <li>Bereid uit ethylalcohol afkomstig van landbouwproducten met een maximum van 15% moutwijn</li>
                    <li>Maximaal 10 gram suiker per liter</li>
                    <li>Alcoholpercentage minimaal 35%</li>
                </ul>
                <?php endif; ?>
            </div>
            <div class="avw-odp-legal-card brand">
                <?php if ( $is_en ): ?>
                <h3 class="avw-odp-h3">A. van Wees Young Genever</h3>
                <ul class="avw-odp-ul">
                    <li>100% grain distillates (incl. malt wine, redistilled malt wine)</li>
                    <li>Not sweetened with sugar</li>
                    <li>Alcohol content 35%</li>
                </ul>
                <?php else: ?>
                <h3 class="avw-odp-h3">A. van Wees Jonge Genever</h3>
                <ul class="avw-odp-ul">
                    <li>100% granendistillaten (w.o. moutwijn, gedistilleerde moutwijn)</li>
                    <li>Niet met suiker gezoet</li>
                    <li>Alcoholpercentage van 35%</li>
                </ul>
                <?php endif; ?>
            </div>
        </div>

    </div><!-- /tab-genever -->


    <!-- ====== TAB 3: LIQUEUR ====== -->
    <div class="avw-odp-section" id="tab-likeur">

        <h2 class="avw-odp-h1"><?php echo $is_en ? 'Liqueur' : 'Likeur'; ?></h2>

        <div class="avw-odp-fullblock">
            <?php if ( $is_en ): ?>
            <h3 class="avw-odp-h2">What is liqueur?</h3>
            <p class="avw-odp-p">Liqueur is a sweet spirit with a long history and a high alcohol content — like genever, originally developed as medicine and later evolved into a pleasure drink.</p>

            <h3 class="avw-odp-h2">The history of liqueur</h3>
            <p class="avw-odp-p">Centuries ago monks fulfilled the roles of family doctor and pharmacist — so too in Amsterdam. The monks experimented extensively with tinctures and elixirs based on herbs and brandies available at the time. Their medicinal drinks did not taste pleasant but were effective, and had a beneficial effect on Amsterdam's sick-leave rates.</p>

            <h3 class="avw-odp-h2">From medicine to pleasure drink</h3>
            <p class="avw-odp-p">Around 1600 Dutch merchants brought sugar, exotic herbs and spices to Amsterdam. This created new possibilities for the monks: with honey and sugar they transformed their brews into palatable drinks that quickly gained popularity as a pleasure drink. After the Alteratie in 1578 monks were expelled from the city. The commerce of the time took over drink production. During the VOC era the famous Dutch liqueur distilleries emerged — particularly in Amsterdam.</p>

            <h3 class="avw-odp-h2">A glorious tradition</h3>
            <p class="avw-odp-p">With a fine range of liqueurs the Dutch distillers conquered the national and international market. The names of those drinks still fire the imagination: from Guldenwater and Hempje licht op to Bruidstranen and Hoe langer hoe liever. At the end of the 19th century production reached its peak when confectioners began using the exquisite distillates as flavourings (esprits). At Van Wees and De Ooievaar we honour the traditional preparation method and original recipes to this day.</p>

            <h3 class="avw-odp-h2">Our preparation of liqueur</h3>
            <p class="avw-odp-p">Every liqueur distiller has his own views on liqueur. We are proud of our rich cultural heritage and like to preserve it. We also place great importance on authenticity and quality — which is why we choose a traditional preparation for our liqueurs. The alcohol content of our liqueurs is a minimum of 24 and a maximum of 45 percent.</p>

            <h3 class="avw-odp-h2">Method</h3>
            <p class="avw-odp-p">First we distil esprit from brandy and fruit, flowers, nuts, herbs or spices. Depending on the intended result we process the various ingredients separately or together. During distillation we remove all fusel oils (impurities) — a process that requires talent, acuity and a great deal of experience. Only the finest distillers achieve the optimal balance between water (for cooling) and fire.</p>

            <h3 class="avw-odp-h2">The right balance</h3>
            <p class="avw-odp-p">We bring our liqueurs into balance by processing various raw materials in different ways: such as distilling, hot or cold maceration, and so on. The art of making a good liqueur is, in our view, greatly underestimated. Well-distilled esprit requires true craftsmanship.</p>
            <p class="avw-odp-p">The quality of a liqueur stands or falls with the quality of the esprits and types of sugar used. Taste our liqueurs next to a factory product and the difference between a good and a bad liqueur quickly becomes clear!</p>

            <h3 class="avw-odp-h2">Double Amsterdam liqueurs</h3>
            <p class="avw-odp-p">Traditionally the designation 'Amsterdamsche likeur' guaranteed a certain quality. The addition 'Dubbele' (Double) guaranteed a base of the finest raw materials and the finest brandies, and indicated that all ingredients had been processed according to the original method in fine stills. These stills have a rectifying bulb, distinguishing them from coarse stills. The rectifying bulb gives the distillates a finer refinement. Van Wees Distillery De Ooievaar still follows this process today.</p>

            <h3 class="avw-odp-h2">Old Dutch and Jordaan liqueurs</h3>
            <p class="avw-odp-p">Old Dutch liqueurs are special if only for their names — each liqueur has its own history. The name usually refers to the occasion for which it was drunk. Striking examples are Bruidstranen (Bride's Tears), Kraamanijs (Christening aniseed) and Kwartier na vijven (Quarter past five). Even today such a product makes a special gift for a special occasion.</p>
            <p class="avw-odp-p">Jordaan liqueurs are contemporary creations developed here in the Jordaan — not centuries-old recipes but original discoveries with new exotic ingredients, such as the yuzu, a citrus fruit we source from Japan. We prepare the Jordaan liqueurs the artisan way, just like the Old Dutch and Double Amsterdam liqueurs.</p>
            <?php else: ?>
            <h3 class="avw-odp-h2">Wat is likeur?</h3>
            <p class="avw-odp-p">Likeur is een zoete sterkedrank met een lange geschiedenis en een hoog alcoholpercentage. Net als genever aanvankelijk ontwikkeld als medicijn en later uitgegroeid tot genotsmiddel.</p>

            <h3 class="avw-odp-h2">De ontstaansgeschiedenis van likeur</h3>
            <p class="avw-odp-p">Eeuwen geleden vervulden monniken de rollen van huisarts en apotheker. Zo ook in Amsterdam. De kloosterlingen experimenteerden uitvoerig met tincturen en elixers op basis van destijds verkrijgbare kruiden en brandewijnen. Hun medicinale dranken smaakten niet lekker maar waren wel effectief. De middeltjes hadden een gunstige uitwerking op het Amsterdamse ziekteverzuimpercentage.</p>

            <h3 class="avw-odp-h2">Van medicijn tot genotsmiddel</h3>
            <p class="avw-odp-p">Rond 1600 brachten Hollandse kooplieden suiker, exotische kruiden en specerijen mee naar Amsterdam. Dit schiep nieuwe mogelijkheden voor de monniken: met honing en suiker toverden ze hun brouwsels om tot smakelijke dranken, die al snel populariteit wonnen als genotsmiddel. Na de Alteratie in 1578 werden monniken uit de stad verjaagd. De toenmalige commercie nam de drankproductie over. Zo ontstonden tijdens de VOC-tijd de befaamde Nederlandse likeurstokerijen, met name in Amsterdam.</p>

            <h3 class="avw-odp-h2">Roemrijke traditie</h3>
            <p class="avw-odp-p">Met een keur aan likeuren veroverden de Nederlandse stokers de nationale en internationale markt. De namen van die dranken spreken nog steeds tot de verbeelding: van Guldenwater en Hempje licht op tot Bruidstranen en Hoe langer hoe liever. Eind 19e bereikte de productie haar hoogtepunt, toen banketbakkers de exquise distillaten gingen gebruiken als aroma's (esprits). Bij Van Wees en de Ooievaar houden we de traditionele bereidingswijze en oorspronkelijke receptuur in ere, tot op de dag van vandaag.</p>

            <h3 class="avw-odp-h2">Onze bereiding van likeur</h3>
            <p class="avw-odp-p">Iedere likeurstoker heeft zo zijn eigen opvattingen over likeur. Wij zijn trots op ons rijke cultuurgoed en houden dat graag in stand. Daarnaast vinden wij authenticiteit en kwaliteit erg belangrijk. Daarom kiezen wij voor een traditionele bereiding van onze likeuren. Het alcoholgehalte van onze likeuren bedraagt minimaal 24 en maximaal 45 procent.</p>

            <h3 class="avw-odp-h2">Werkwijze</h3>
            <p class="avw-odp-p">Eerst stoken we esprit van brandewijn en fruit, bloemen, noten, kruiden of specerijen. Afhankelijk van het beoogde resultaat bewerken we de verschillende ingrediënten afzonderlijk of samen. Tijdens het stoken verwijderen we alle foezels (onzuiverheden): een proces dat aanleg, scherpte en veel ervaring vereist. Alleen de beste stokers bereiken het optimale evenwicht tussen water (voor de koeling) en vuur.</p>

            <h3 class="avw-odp-h2">De juiste balans</h3>
            <p class="avw-odp-p">We brengen onze likeuren in balans door diverse grondstoffen op verschillende manieren te bewerken: zoals stoken, warm of koud trekken, et cetera. De kunst van een goede likeur maken wordt naar ons idee danig onderschat. Goed gestookte esprit vereist vakmanschap.</p>
            <p class="avw-odp-p">De assemblage van een likeur staat of valt met de kwaliteit van de gebruikte esprits en typen suiker. Proef onze likeuren eens naast een fabrieksproduct en het verschil tussen een goede en een slechte likeur wordt al snel duidelijk!</p>

            <h3 class="avw-odp-h2">Dubbele Amsterdamse likeuren</h3>
            <p class="avw-odp-p">Vanouds waarborgde de aanduiding 'Amsterdamsche likeur' een bepaalde kwaliteit. De toevoeging 'Dubbele' garandeerde een basis van de beste grondstoffen en de fijnste brandewijnen. Daarnaast gaf het aan dat alle ingrediënten volgens de oorspronkelijke methode waren verwerkt in fijnketels. Deze ketels hebben een rectificeerbol en onderscheiden zich daarmee van ruwketels. Door de rectificeerbol krijgen de distillaten een fijnere bewerking. Van Wees distilleerderij de Ooievaar volgt dit procedé nog steeds.</p>

            <h3 class="avw-odp-h2">Oudhollandse en Jordaanse likeuren</h3>
            <p class="avw-odp-p">Oudhollandse likeuren zijn alleen al bijzonder vanwege hun namen. Elke likeur heeft een eigen geschiedenis. De naam verwijst meestal naar de gelegenheid waarbij de likeur werd gedronken. Treffende voorbeelden hiervan zijn Bruidstranen, Kraamanijs en Kwartier na vijven. Ook tegenwoordig is zo'n product een speciaal cadeau bij een bijzondere gebeurtenis.</p>
            <p class="avw-odp-p">Jordaanse likeuren zijn eigentijdse creaties ontwikkeld bij ons in de Jordaan. Geen eeuwenoude recepten maar originele vondsten met nieuwe exotische bestanddelen, zoals de yuzu, een citrusvrucht die we uit Japan halen. We bereiden de Jordaanse likeuren uiteraard ambachtelijk, net als de Oudhollandse en dubbele Amsterdamse likeuren.</p>
            <?php endif; ?>
        </div>

        <hr class="avw-odp-divider" />

        <h3 class="avw-odp-h2"><?php echo $is_en ? 'The law and Van Wees' : 'De wet en Van Wees'; ?></h3>
        <div class="avw-odp-2col">
            <div class="avw-odp-text">
                <?php if ( $is_en ): ?>
                <p class="avw-odp-p">Today a product may already be called liqueur if it contains alcohol, flavouring and sugar. In our company we apply higher quality standards than the law prescribes — we are quite strict about this. We do not use artificial flavourings or colourings as a matter of principle. Instead of flavoured alcohol we use for all our liqueurs</p>
                <?php else: ?>
                <p class="avw-odp-p">Tegenwoordig mag een product al likeur heten als het alcohol, aroma en suiker bevat. In ons bedrijf hanteren we hogere kwaliteitsnormen dan de wet voorschrijft. Daar zijn we nogal strikt in. Kunstmatige smaak- en kleurstoffen gebruiken we principieel niet. In plaats van gearomatiseerde alcohol gebruiken wij voor al onze likeuren</p>
                <?php endif; ?>
            </div>
            <div class="avw-odp-text">
                <?php if ( $is_en ): ?>
                <p class="avw-odp-p">exclusively distillates: esprits of 100% natural ingredients that we distil ourselves. Well, tastes differ — but the authenticity of products is another matter entirely…</p>
                <?php else: ?>
                <p class="avw-odp-p">uitsluitend distillaten: esprits van 100 procent natuurlijke ingrediënten die we zelf distilleren. Tja, over smaak valt niet te twisten maar over de echtheid van producten wel…</p>
                <?php endif; ?>
            </div>
        </div>

    </div><!-- /tab-likeur -->


    <!-- ====== TAB 4: GIN ====== -->
    <div class="avw-odp-section" id="tab-gin">

        <h2 class="avw-odp-h1">Gin</h2>


        <div class="avw-odp-2col img-right" id="gin-wat">
            <div class="avw-odp-text">
                <?php if ( $is_en ): ?>
                <h3 class="avw-odp-h2">What is Gin?</h3>
                <p class="avw-odp-p">Gin is a spirit that originated from the classic genever recipe — its name is in fact derived from genever. Artisan gins are distilled from grain distillates on the basis of a fixed combination of botanicals.</p>

                <h3 class="avw-odp-h2" id="gin-ontstaan">The history of Gin</h3>
                <p class="avw-odp-p">When William III of Orange (1650–1702) held sway over England, genever became popular there too. English distillers tried to copy the spirit because of its success. However, they lacked the correct recipe, so they developed their own version of genever, which became known as gin. They added lemon, among other things — an ingredient they used for practically everything — and thereby earned the British the nickname 'limeys'.</p>

                <h3 class="avw-odp-h2" id="gin-smaak">Recognisable taste characteristics</h3>
                <p class="avw-odp-p">Every distiller determined the quantities per botanical type according to his own judgement. It was important that the scent and flavour of the juniper berry led, underpinned by the fresh, crisp tones of lime.</p>
                <?php else: ?>
                <h3 class="avw-odp-h2">Wat is Gin?</h3>
                <p class="avw-odp-p">Gin is een sterkedrank die ontstaan is uit het klassieke geneverrecept en haar naam is dan ook een afgeleide van genever. Ambachtelijke gins worden van granendistillaten op basis van een vaste samenstelling van kruiden gestookt.</p>

                <h3 class="avw-odp-h2" id="gin-ontstaan">De ontstaansgeschiedenis van Gin</h3>
                <p class="avw-odp-p">Toen Willem III van Oranje (1650-1702) de scepter zwaaide over Engeland, werd genever ook daar populair. Engelse distillateurs probeerden de sterkedrank na te maken omdat het zo'n succes was. Zij misten echter de juiste receptuur. Daarom ontwikkelden ze hun eigen versie van genever, die bekend werd onder de naam gin. Zij voegden onder andere citroen toe, een ingrediënt dat ze werkelijk overal voor gebruik(t)en. Daaraan danken de Britten hun bijnaam 'limeys'.</p>

                <h3 class="avw-odp-h2" id="gin-smaak">Herkenbare smaakeigenschappen</h3>
                <p class="avw-odp-p">Iedere stoker bepaalde de hoeveelheden per kruidentype naar eigen inzicht. Daarbij was het belangrijk dat de geur en smaak van de jeneverbes de boventoon voerde met daaronder direct de frisse, knisperende tonen van lime.</p>
                <?php endif; ?>
            </div>
            <div class="avw-odp-img-wrap">
                <img class="avw-odp-parallax-img" src="<?php echo content_url('/uploads/2026/05/odp-gin-right.jpg'); ?>" alt="Gin" />
            </div>
        </div>

        <div class="avw-odp-2col img-left">
            <div class="avw-odp-img-wrap">
                <img class="avw-odp-parallax-img" src="<?php echo content_url('/uploads/2026/05/odp-gin-left.jpg'); ?>" alt="<?php echo $is_en ? 'Distilling Gin' : 'Gin distilleren'; ?>" />
            </div>
            <div class="avw-odp-text">
                <?php if ( $is_en ): ?>
                <h3 class="avw-odp-h2">Incomparable</h3>
                <p class="avw-odp-p">The traditional gins as we knew them until recently were developed at the end of the 19th century. In terms of flavour and preparation they are often incomparable with the original gin. The gins that have come to market since the early 21st century have little to do with the traditional versions. One is more outlandish in flavour than the next, thanks to modern interpretations of herbs and botanicals.</p>

                <h3 class="avw-odp-h2">Van Wees and gin</h3>
                <p class="avw-odp-p">Alongside genevers we have been making gin for many years — a product that forty years ago was available in almost every bar, until it fell out of fashion. Today gin is popular again, and we still make our traditional gin: Three Corners Dry Gin Superior Quality. In addition, in response to the lack of transparency provided by producers about the production method and composition of their gin, we have developed three new modern gins. Unique in their kind, as all three are 100% distilled — not blended like most gins with grain alcohol, but based solely on traditional gin distillates brought to drinking strength.</p>
                <?php else: ?>
                <h3 class="avw-odp-h2">Onvergelijkbaar</h3>
                <p class="avw-odp-p">De traditionele gins zoals we die tot voor kort kenden zijn eind 19e eeuw ontwikkeld. Qua smaak en bereidingswijze zijn ze vaak onvergelijkbaar met de originele gin. De gins die sinds begin 21e eeuw op de markt zijn gekomen hebben nog weinig van doen met de traditionele versies. De één is dankzij moderne interpretaties van te gebruiken kruiden en planten qua smaak nog bonter dan de ander.</p>

                <h3 class="avw-odp-h2">Van Wees en gin</h3>
                <p class="avw-odp-p">Naast genevers maken wij sinds jaar en dag gin. Een product dat veertig jaar geleden bijna in elke bar verkrijgbaar was. Totdat ze uit de mode raakte. Tegenwoordig is gin weer hip en maken we nog steeds onze traditionele gin: Three Corners Dry gin Superior Quality. Daarnaast hebben wij in antwoord op de weinig doorzichtige informatie die door producenten over de productiewijze en samenstelling van hun gin wordt gegeven drie nieuwe moderne gins ontwikkeld. Uniek in hun soort, want alle drie 100% gedistilleerd, niet geblend zoals de meeste gins met graanalcohol, maar uitsluitend op basis van op drinksterkte gebrachte traditionele gindistillaten.</p>
                <?php endif; ?>
            </div>
        </div>

    </div><!-- /tab-gin -->


    <!-- ====== TAB 5: ESPRIT ====== -->
    <div class="avw-odp-section" id="tab-esprit">

        <h2 class="avw-odp-h1">Esprit</h2>


        <div class="avw-odp-fullblock" id="esp-wat">
            <?php if ( $is_en ): ?>
            <h3 class="avw-odp-h2">What is esprit?</h3>
            <p class="avw-odp-p">Esprits are distillates that enhance the aroma of fresh products in a natural way. They were already used in the professional preparation of delicacies at the end of the 19th century — until artificial flavourings came into vogue. Artificial aromas were much cheaper and therefore more attractive than esprits, especially during the poverty of WWI and WWII. Distilled flavours almost disappeared from the scene as a result. Fortunately, demand for esprits has been growing again since 1980, driven by renewed interest in pure products.</p>
            <?php else: ?>
            <h3 class="avw-odp-h2">Wat is esprit?</h3>
            <p class="avw-odp-p">Esprits zijn distillaten die het aroma van verse producten op natuurlijke manier versterken. Eind 19e eeuw werden ze al gebruikt bij de professionele bereiding van delicatessen – totdat de kunstmatige smaakstoffen in zwang kwamen. Artificiële aroma's waren veel goedkoper en daarom aantrekkelijker dan esprits, zeker in de tijden van armoede rondom WOI en WOII. Gedistilleerde smaken verdwenen daardoor bijna van het toneel. Gelukkig neemt de vraag naar esprits sinds 1980 weer toe, door de hernieuwde belangstelling voor pure producten.</p>
            <?php endif; ?>
        </div>

        <div class="avw-odp-img-full">
            <img class="avw-odp-parallax-img" src="<?php echo content_url('/uploads/2026/05/odp-esprit.jpg'); ?>" alt="Esprit" />
        </div>

        <div class="avw-odp-fullblock" id="esp-kooptekoop">
            <?php if ( $is_en ): ?>
            <h3 class="avw-odp-h2">For the professional market</h3>
            <p class="avw-odp-p">For the professional market, Van Wees and De Ooievaar supplies a range of approximately sixty esprits based on pure ingredients.</p>

            <h3 class="avw-odp-h2">For private customers</h3>
            <p class="avw-odp-p">Specially for restaurateurs and home cooks we also offer esprit in atomisers — a mist over coffee or a dish enhances the scent and taste experience.</p>

            <h3 class="avw-odp-h2">Purer than essential oils</h3>
            <p class="avw-odp-p">Thanks to the distillation process with rectifying bulb, esprits are purer than essential oils. Esprits contain only the finest scents and flavours because the coarser components (including the fatty ones) remain behind in the still. They are also easy to measure and blend.</p>

            <h3 class="avw-odp-h2">Natural flavour enhancers of exceptional quality</h3>
            <p class="avw-odp-p">The exceptional quality of our esprits amplifies the flavour effect. Due to their high concentration, only a small amount is needed. Patissiers, ice cream makers and chocolatiers achieve great results with just a few drops of Van Wees Esprits. Pastries, ice cream and chocolates are therefore not unnecessarily moist and retain their quality even after freezing.</p>

            <h3 class="avw-odp-h2">Where to buy</h3>
            <p class="avw-odp-p">Litre bottles for professional use are available through various wholesalers. Esprits for small-scale use in 200 ml pocket flasks can be purchased at most Hanos branches. Email us for the supplier in your area. Private customers can order esprits exclusively through the webshop.</p>
            <?php else: ?>
            <h3 class="avw-odp-h2">Voor de professionele markt</h3>
            <p class="avw-odp-p">Voor de professionele markt levert Van Wees en de Ooievaar een serie van circa zestig esprits op basis van pure ingrediënten.</p>

            <h3 class="avw-odp-h2">Voor particulieren</h3>
            <p class="avw-odp-p">Speciaal voor restaurateurs en hobbykoks hebben wij ook esprit in verstuivers: een waasje over koffie of gerecht versterkt de geur- en smaakbeleving.</p>

            <h3 class="avw-odp-h2">Zuiverder dan etherische oliën</h3>
            <p class="avw-odp-p">Dankzij het distillatieproces met rectificeerbol zijn esprits zuiverder dan etherische oliën. Esprits bevatten uitsluitend de allerfijnste geuren en smaken omdat de grovere bestanddelen (waaronder de vettige) achterblijven in de distilleerketel. Ze zijn bovendien eenvoudig te doseren en te mengen.</p>

            <h3 class="avw-odp-h2">Natuurlijke smaakversterkers van uitzonderlijke kwaliteit</h3>
            <p class="avw-odp-p">De uitzonderlijke kwaliteit van onze esprits versterkt het smaakeffect. Door de hoge concentratie is slechts een kleine hoeveelheid nodig. Patissiers, ijsbereiders of chocolatiers bereiken met enkele druppels van Van Wees Esprits grootse effecten. Gebak, ijs en chocola worden daardoor niet onnodig vochtig en behouden ook na invriezen hun kwaliteit.</p>

            <h3 class="avw-odp-h2">Waar te koop</h3>
            <p class="avw-odp-p">Literflessen voor professioneel gebruik zijn verkrijgbaar via diverse grossiers. Esprits voor kleingebruik in 200 ml zakflacons kunt u aanschaffen bij de meeste Hanos filialen. Mail ons voor de leverancier in uw buurt. Als particulier kunt u esprits uitsluitend bestellen via de webshop.</p>
            <?php endif; ?>
        </div>

    </div><!-- /tab-esprit -->

</div><!-- /avw-odp-body -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.avw-odp-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.avw-odp-tab').forEach(function(t) { t.classList.remove('active'); });
            document.querySelectorAll('.avw-odp-section').forEach(function(s) { s.classList.remove('active'); });
            this.classList.add('active');
            document.getElementById('tab-' + this.dataset.tab).classList.add('active');
        });
    });

    document.querySelectorAll('.avw-odp-quicknav a').forEach(function(a) {
        a.addEventListener('click', function(e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY - 140, behavior: 'smooth' });
            }
        });
    });
});
</script>

<?php get_footer(); ?>
