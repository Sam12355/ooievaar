<?php
/**
 * Template Name: Over de Producten
 *
 * @package avw-distillery
 */

get_header();
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
.avw-odp-quicknav ol {
    margin: 0; padding-left: 20px;
}
.avw-odp-quicknav ol li {
    font-family: 'DM Sans', sans-serif; font-size: 14px; margin-bottom: 4px;
}
.avw-odp-quicknav ol li a {
    color: #432B25; text-decoration: none;
}
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
.avw-odp-ul {
    list-style: none; padding: 0; margin: 0 0 20px;
}
.avw-odp-ul li {
    font-family: 'DM Sans', sans-serif; font-size: 15px; line-height: 1.7;
    color: rgba(54,34,29,0.78); padding: 8px 12px 8px 30px;
    position: relative; margin-bottom: 4px;
}
.avw-odp-ul li::before {
    content: '–'; position: absolute; left: 10px; color: #432B25; font-weight: 700;
}

/* ---- Full-width text block ---- */
.avw-odp-fullblock { margin-bottom: 56px; }

/* ---- Legal comparison block ---- */
.avw-odp-legal {
    display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 48px;
}
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
.avw-odp-divider {
    border: none; border-top: 1px solid rgba(54,34,29,0.08);
    margin: 56px 0;
}

/* ---- Full-width image (esprit) ---- */
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
    <img id="odp-hero-img" class="avw-odp-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="Over de Producten" />
    <div class="avw-odp-hero-overlay"></div>
    <div class="avw-odp-hero-content">
        <nav class="avw-odp-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <a href="<?php echo home_url('/assortiment'); ?>">Assortiment</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;">Over de Producten</span>
        </nav>
        <h1 id="odp-hero-title" class="avw-odp-hero-title">Over de Producten</h1>
    </div>
</section>

<!-- STICKY TABS -->
<div class="avw-odp-tabs-wrap">
    <nav class="avw-odp-tabs">
        <button class="avw-odp-tab active" data-tab="over">Over de producten</button>
        <button class="avw-odp-tab" data-tab="genever">Genever</button>
        <button class="avw-odp-tab" data-tab="likeur">Likeur</button>
        <button class="avw-odp-tab" data-tab="gin">Gin</button>
        <button class="avw-odp-tab" data-tab="esprit">Esprit</button>
    </nav>
</div>

<!-- TAB CONTENT -->
<div class="avw-odp-body">

    <!-- ====== TAB 1: OVER DE PRODUCTEN ====== -->
    <div class="avw-odp-section active" id="tab-over">

        <h2 class="avw-odp-h1">Over de producten</h2>

        <div class="avw-odp-quicknav">
            <p class="avw-odp-quicknav-title">Ga snel naar</p>
            <ol>
                <li><a href="#over-trad">Traditionele en nieuwe genevers en likeuren</a></li>
                <li><a href="#over-eetparfums">Verleidelijke eetparfums voor restaurateurs en hobbykoks</a></li>
                <li><a href="#over-assortiment">Ons Assortiment</a></li>
            </ol>
        </div>

        <!-- Two col: text + image -->
        <div class="avw-odp-2col img-right" id="over-trad">
            <div class="avw-odp-text">
                <h3 class="avw-odp-h2">Traditionele en nieuwe genevers en likeuren</h3>
                <p class="avw-odp-p">Door onze ambachtelijke manier van werken houden wij een traditie in stand die stamt uit de 16e eeuw. Met de grote kennis van distilleren die in ons bedrijf aanwezig is en de liefde voor een edel vak produceren wij Oudhollands gedistilleerd van unieke kwaliteit. Tegelijk ontwikkelen wij met oude kennis nieuwe producten zoals een groentenlikeur.</p>

                <h3 class="avw-odp-h2">Esprits voor patissiers, ijsbereiders, chocolatiers en chef-koks</h3>
                <p class="avw-odp-p">Tot onze overige creaties behoren de zogenaamde esprits, die wij exclusief leveren aan patissiers, ijsbereiders, chocolatiers en restaurants. Deze vloeistoffen bevatten de 'geest' van onze gestookte producten in geconcentreerde vorm. Het zijn smaakmakers in ijs, bonbons, gebak en andere delicatessen.</p>
                <p class="avw-odp-p">Esprits versterken het aroma op natuurlijke wijze. Ze zijn eenvoudig te doseren en te mengen. Door de hoge concentratie is in elk recept slechts een kleine hoeveelheid nodig. Gebak, ijs en chocola worden daardoor niet onnodig vochtig en behouden ook na diepvriezen hun kwaliteit.</p>
            </div>
            <div class="avw-odp-img-wrap">
                <img class="avw-odp-parallax-img" src="<?php echo get_template_directory_uri(); ?>/assets/odp-over.jpg" alt="Producten" />
            </div>
        </div>

        <!-- Full width: eetparfums -->
        <div class="avw-odp-fullblock" id="over-eetparfums">
            <h3 class="avw-odp-h2">Verleidelijke eetparfums</h3>
            <p class="avw-odp-p">Speciaal voor restaurateurs en hobbykoks ontwikkelden wij eetparfums: esprits in verstuivers, om aan tafel over spijs of drank te sprayen. Een waasje over een gerecht of koffie waarin esprit zit, versterkt de geur- en smaakbeleving. Stand-alone toepassing kan ook, bijvoorbeeld bij kaneelparfum over de cappuccino.</p>
        </div>

        <hr class="avw-odp-divider" />

        <!-- Two col: left text + right text -->
        <div class="avw-odp-2col" id="over-assortiment">
            <div class="avw-odp-text">
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
            </div>
            <div class="avw-odp-text">
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
            </div>
        </div>

    </div><!-- /tab-over -->


    <!-- ====== TAB 2: GENEVER ====== -->
    <div class="avw-odp-section" id="tab-genever">

        <h2 class="avw-odp-h1">Genever</h2>

        <div class="avw-odp-quicknav">
            <p class="avw-odp-quicknav-title">Ga snel naar</p>
            <ol>
                <li><a href="#gen-geschiedenis">Geschiedenis van genever</a></li>
                <li><a href="#gen-verschil">Het verschil tussen oud en jong</a></li>
                <li><a href="#gen-bereiding">Bereiding</a></li>
            </ol>
        </div>

        <!-- Two col: text + image -->
        <div class="avw-odp-2col img-right" id="gen-geschiedenis">
            <div class="avw-odp-text">
                <h3 class="avw-odp-h2">Wat is genever en hoe is het ontstaan?</h3>
                <p class="avw-odp-p">Genever is van origine een typisch Hollandse sterkedrank, die zijn naam dankt aan de jeneverbes. Ambachtelijke genevers worden volgens eeuwenoude, Hollandse receptuur, bereid uit granendistillaten, zoals moutwijn en geherdistilleerde moutwijn, met de jeneverbes (Juniperus) als prominent ingrediënt. Deze bessensoort (vroeger beien genoemd) werd meegestookt met de te herdistilleren moutwijn: enerzijds om de smaak te verrijken, anderzijds vanwege vermeend geneeskrachtige eigenschappen van de jeneverbes. Van oorsprong werd genever vooral gedronken als medicijn.</p>

                <h3 class="avw-odp-h2">Van geneesmiddel tot populaire borrel</h3>
                <p class="avw-odp-p">In de Gouden Eeuw was Amsterdam een belangrijke Europese doorvoerhaven. De overvloed aan kruiden en specerijen maakte de stad een walhalla voor stokers. Amsterdamse distillateurs produceerden als eersten moutwijnen uit graan. Op basis daarvan stookten zij genever (hiermee liepen zij een eeuw voor op hun Schiedamse vakgenoten!). Met nieuwe ingrediënten maakten zij de sterkedrank steeds lekkerder. Daardoor groeide genever in de 17e eeuw uit tot een populaire borrel.</p>

                <h3 class="avw-odp-h2">Herkenbare smaakeigenschappen</h3>
                <p class="avw-odp-p">Iedere stoker maakte zijn eigen graangenever: volgens de traditionele methode, maar geheel naar eigen inzicht. Dit leverde karakteristieke smaakeigenschappen op, plus een exclusieve klantenkring. De Verenigd Oost-Indische Compagnie (VOC) nam bijvoorbeeld uitsluitend genoegen met genever van geherdistilleerde moutwijn uit Weesp.</p>

                <h3 class="avw-odp-h2">Onvergelijkbaar</h3>
                <p class="avw-odp-p">De jonge jenever zoals we die nu kennen werd eind 19e eeuw ontwikkeld. Qua smaak en bereidingswijze is het onvergelijkbaar met de traditionele genever. De uitvinding van de kolommendistillatie en een overschot aan suikerbieten bracht de Nederlandse overheid op het idee om op een goedkope en efficiënte manier alcohol te maken.</p>
                <p class="avw-odp-p">Het resultaat was een nietszeggend, smaak- en reukloos product, dat al snel zijn intrede deed als vervanger van de moutwijn. Door zijn prijsstelling werd de borrel op basis van melasse alcohol voor iedereen bereikbaar. Door commercie en nieuwe technologieën is het oude ambacht hopeloos in de vergetelheid geraakt. Bijna niemand weet tegenwoordig nog hoe perfect een goed gemaakte genever kan smaken!</p>
            </div>
            <div class="avw-odp-img-wrap">
                <img class="avw-odp-parallax-img" src="<?php echo get_template_directory_uri(); ?>/assets/odp-genever.jpg" alt="Genever" />
                <div style="padding: 32px 0 0;">
                    <h3 class="avw-odp-h2" id="gen-bereiding">Onze bereiding van genever</h3>
                    <p class="avw-odp-p">Wij bereiden onze genevers op ambachtelijke wijze, dus van granendistillaten en kruiden. Hiermee houden we een traditie hoog die stamt uit de 16e eeuw. Bij de samenstelling van geneversoorten houden we rekening met verschillen in lagerperiodes van de distillaten. Zo creëren we een optimale smaakconsistentie per soort. Deze werkwijze is kostbaar en daarom uniek voor Nederlandse begrippen.</p>
                    <h3 class="avw-odp-h2">Zoet en fruitig</h3>
                    <p class="avw-odp-p"><strong>Tip:</strong> Houdt u van zoet en fruitig, probeer dan eens een van onze vruchtengenevers! Deze zijn niet bereid van genever maar van gedistilleerde vruchten.</p>
                </div>
            </div>
        </div>

        <hr class="avw-odp-divider" />

        <!-- Full width: verschil -->
        <div class="avw-odp-fullblock" id="gen-verschil">
            <h3 class="avw-odp-h2">Het verschil tussen oude en jonge genever</h3>
            <p class="avw-odp-p">Een echte oude genever wordt bereid volgens de ambachtelijke methode van vóór 1900, met geherdistilleerde moutwijn, jeneverbessen en kruiden. Na bereiding gaat de drank een tijd op fust om te rijpen: bij ons voor periodes van drie maanden tot twintig jaar (afhankelijk van het type genever).</p>
            <p class="avw-odp-p">Jonge genever is een recentere uitvinding, die zijn ontstaan dankt aan de introductie van neutrale industriële alcohol gestookt tot 96,2%. Het is een fabrieksproduct dat direct klaar is voor consumptie. Om de teloorgang van smaak te rechtvaardigen bedacht men de naam jonge jenever. Zo'n product past uiteraard niet bij de filosofie en principes van onze familie. Daarom bereiden wij onze jonge genevers op soortgelijke wijze als onze oude genevers. Dit betekent dat onze jonge genevers ook met moutwijn en geherdistilleerde moutwijn worden bereid.</p>
        </div>

        <!-- Two col: ambachtelijk + wet -->
        <div class="avw-odp-2col">
            <div class="avw-odp-text">
                <h3 class="avw-odp-h2">Ambachtelijke genever versus moderne jenever</h3>
                <p class="avw-odp-p">Wat is het verschil tussen ambachtelijke genever en moderne jenever? Het verschil zit hem zowel in de receptuur als in de bereidingswijze. Moderne – veelal industriële – producten bevatten zelden moutwijn, geherdistilleerde moutwijn laat staan gedistilleerde jeneverbessen en kruiden. Bovendien zien of ruiken ze nooit een houten vat; van rijping is dus geen sprake. Bij Van Wees en de Ooievaar bereiden we oude genever zoals het hoort: van moutwijn gedistilleerd met jeneverbessen en kruiden. Vervolgens lageren we de drank, zodat deze rijpt. Sommige van onze genevers liggen zeker twintig jaar op fust. Zij mogen daarom met recht Zeer Oud genoemd worden.</p>
            </div>
            <div class="avw-odp-text">
                <h3 class="avw-odp-h2">De wet en Van Wees</h3>
                <p class="avw-odp-p">Aanvankelijk bepaalde de Europese wetgeving summier waaraan genever moest voldoen om genever te mogen heten. In 2015 kwam er nieuwe regelgeving omtrent gedistilleerde dranken. Genever was daarin vervallen, door onenigheid tussen de vier genever producerende landen: Duitsland, Frankrijk, België en Nederland waren het niet eens over de eisen waaraan genever moet voldoen. Sindsdien is genever vogelvrij. Wilt u daar meer over weten? In ons boek gaan we er uitgebreid op in.</p>
            </div>
        </div>

        <!-- Legal comparison cards -->
        <div class="avw-odp-legal">
            <div class="avw-odp-legal-card">
                <h3 class="avw-odp-h3">Wettelijke eisen Jonge jenever</h3>
                <ul class="avw-odp-ul">
                    <li>Bereid uit ethylalcohol afkomstig van landbouwproducten met een maximum van 15% moutwijn</li>
                    <li>Maximaal 10 gram suiker per liter</li>
                    <li>Alcoholpercentage minimaal 35%</li>
                </ul>
            </div>
            <div class="avw-odp-legal-card brand">
                <h3 class="avw-odp-h3">A. van Wees Jonge Genever</h3>
                <ul class="avw-odp-ul">
                    <li>100% granendistillaten (w.o. moutwijn, gedistilleerde moutwijn)</li>
                    <li>Niet met suiker gezoet</li>
                    <li>Alcoholpercentage van 35%</li>
                </ul>
            </div>
        </div>

    </div><!-- /tab-genever -->


    <!-- ====== TAB 3: LIKEUR ====== -->
    <div class="avw-odp-section" id="tab-likeur">

        <h2 class="avw-odp-h1">Likeur</h2>

        <div class="avw-odp-fullblock">
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
        </div>

        <hr class="avw-odp-divider" />

        <!-- De wet en Van Wees — two col split -->
        <h3 class="avw-odp-h2">De wet en Van Wees</h3>
        <div class="avw-odp-2col">
            <div class="avw-odp-text">
                <p class="avw-odp-p">Tegenwoordig mag een product al likeur heten als het alcohol, aroma en suiker bevat. In ons bedrijf hanteren we hogere kwaliteitsnormen dan de wet voorschrijft. Daar zijn we nogal strikt in. Kunstmatige smaak- en kleurstoffen gebruiken we principieel niet. In plaats van gearomatiseerde alcohol gebruiken wij voor al onze likeuren</p>
            </div>
            <div class="avw-odp-text">
                <p class="avw-odp-p">uitsluitend distillaten: esprits van 100 procent natuurlijke ingrediënten die we zelf distilleren. Tja, over smaak valt niet te twisten maar over de echtheid van producten wel…</p>
            </div>
        </div>

    </div><!-- /tab-likeur -->


    <!-- ====== TAB 4: GIN ====== -->
    <div class="avw-odp-section" id="tab-gin">

        <h2 class="avw-odp-h1">Gin</h2>

        <div class="avw-odp-quicknav">
            <p class="avw-odp-quicknav-title">Ga snel naar</p>
            <ol>
                <li><a href="#gin-wat">Wat is gin?</a></li>
                <li><a href="#gin-ontstaan">De ontstaansgeschiedenis van gin</a></li>
                <li><a href="#gin-smaak">Herkenbare smaakeigenschappen</a></li>
            </ol>
        </div>

        <!-- Two col: text left + image right -->
        <div class="avw-odp-2col img-right" id="gin-wat">
            <div class="avw-odp-text">
                <h3 class="avw-odp-h2">Wat is Gin?</h3>
                <p class="avw-odp-p">Gin is een sterkedrank die ontstaan is uit het klassieke geneverrecept en haar naam is dan ook een afgeleide van genever. Ambachtelijke gins worden van granendistillaten op basis van een vaste samenstelling van kruiden gestookt.</p>

                <h3 class="avw-odp-h2" id="gin-ontstaan">De ontstaansgeschiedenis van Gin</h3>
                <p class="avw-odp-p">Toen Willem III van Oranje (1650-1702) de scepter zwaaide over Engeland, werd genever ook daar populair. Engelse distillateurs probeerden de sterkedrank na te maken omdat het zo'n succes was. Zij misten echter de juiste receptuur. Daarom ontwikkelden ze hun eigen versie van genever, die bekend werd onder de naam gin. Zij voegden onder andere citroen toe, een ingrediënt dat ze werkelijk overal voor gebruik(t)en. Daaraan danken de Britten hun bijnaam 'limeys'.</p>

                <h3 class="avw-odp-h2" id="gin-smaak">Herkenbare smaakeigenschappen</h3>
                <p class="avw-odp-p">Iedere stoker bepaalde de hoeveelheden per kruidentype naar eigen inzicht. Daarbij was het belangrijk dat de geur en smaak van de jeneverbes de boventoon voerde met daaronder direct de frisse, knisperende tonen van lime.</p>
            </div>
            <div class="avw-odp-img-wrap">
                <img class="avw-odp-parallax-img" src="<?php echo get_template_directory_uri(); ?>/assets/odp-gin-right.jpg" alt="Gin" />
            </div>
        </div>

        <!-- Two col: image left + text right -->
        <div class="avw-odp-2col img-left">
            <div class="avw-odp-img-wrap">
                <img class="avw-odp-parallax-img" src="<?php echo get_template_directory_uri(); ?>/assets/odp-gin-left.jpg" alt="Gin distilleren" />
            </div>
            <div class="avw-odp-text">
                <h3 class="avw-odp-h2">Onvergelijkbaar</h3>
                <p class="avw-odp-p">De traditionele gins zoals we die tot voor kort kenden zijn eind 19e eeuw ontwikkeld. Qua smaak en bereidingswijze zijn ze vaak onvergelijkbaar met de originele gin. De gins die sinds begin 21e eeuw op de markt zijn gekomen hebben nog weinig van doen met de traditionele versies. De één is dankzij moderne interpretaties van te gebruiken kruiden en planten qua smaak nog bonter dan de ander.</p>

                <h3 class="avw-odp-h2">Van Wees en gin</h3>
                <p class="avw-odp-p">Naast genevers maken wij sinds jaar en dag gin. Een product dat veertig jaar geleden bijna in elke bar verkrijgbaar was. Totdat ze uit de mode raakte. Tegenwoordig is gin weer hip en maken we nog steeds onze traditionele gin: Three Corners Dry gin Superior Quality. Daarnaast hebben wij in antwoord op de weinig doorzichtige informatie die door producenten over de productiewijze en samenstelling van hun gin wordt gegeven drie nieuwe moderne gins ontwikkeld. Uniek in hun soort, want alle drie 100% gedistilleerd, niet geblend zoals de meeste gins met graanalcohol, maar uitsluitend op basis van op drinksterkte gebrachte traditionele gindistillaten.</p>
            </div>
        </div>

    </div><!-- /tab-gin -->


    <!-- ====== TAB 5: ESPRIT ====== -->
    <div class="avw-odp-section" id="tab-esprit">

        <h2 class="avw-odp-h1">Esprit</h2>

        <div class="avw-odp-quicknav">
            <p class="avw-odp-quicknav-title">Ga snel naar</p>
            <ol>
                <li><a href="#esp-wat">Wat is esprit?</a></li>
                <li><a href="#esp-kooptekoop">Waar te koop</a></li>
            </ol>
        </div>

        <div class="avw-odp-fullblock" id="esp-wat">
            <h3 class="avw-odp-h2">Wat is esprit?</h3>
            <p class="avw-odp-p">Esprits zijn distillaten die het aroma van verse producten op natuurlijke manier versterken. Eind 19e eeuw werden ze al gebruikt bij de professionele bereiding van delicatessen – totdat de kunstmatige smaakstoffen in zwang kwamen. Artificiële aroma's waren veel goedkoper en daarom aantrekkelijker dan esprits, zeker in de tijden van armoede rondom WOI en WOII. Gedistilleerde smaken verdwenen daardoor bijna van het toneel. Gelukkig neemt de vraag naar esprits sinds 1980 weer toe, door de hernieuwde belangstelling voor pure producten.</p>
        </div>

        <!-- Full-width parallax photo -->
        <div class="avw-odp-img-full">
            <img class="avw-odp-parallax-img" src="<?php echo get_template_directory_uri(); ?>/assets/odp-esprit.jpg" alt="Esprit" />
        </div>

        <div class="avw-odp-fullblock" id="esp-kooptekoop">
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
        </div>

    </div><!-- /tab-esprit -->

</div><!-- /avw-odp-body -->

<script>
document.addEventListener('DOMContentLoaded', function() {

    // Hero parallax
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        gsap.fromTo('#odp-hero-img',
            { yPercent: -15 },
            { yPercent: 15, ease: 'none',
              scrollTrigger: { trigger: '#odp-hero-title', start: 'top bottom', end: 'bottom top', scrub: true } }
        );

        // Content image parallax
        function initParallax() {
            document.querySelectorAll('.avw-odp-parallax-img').forEach(function(img) {
                if (img._scrollTrigger) img._scrollTrigger.kill();
                var st = gsap.fromTo(img,
                    { yPercent: -10 },
                    { yPercent: 10, ease: 'none',
                      scrollTrigger: {
                          trigger: img.closest('.avw-odp-img-wrap, .avw-odp-img-full'),
                          start: 'top bottom', end: 'bottom top', scrub: true
                      }
                    }
                );
                img._scrollTrigger = st.scrollTrigger;
            });
        }

        initParallax();

        // Tab switching
        document.querySelectorAll('.avw-odp-tab').forEach(function(tab) {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.avw-odp-tab').forEach(function(t) { t.classList.remove('active'); });
                document.querySelectorAll('.avw-odp-section').forEach(function(s) { s.classList.remove('active'); });
                this.classList.add('active');
                document.getElementById('tab-' + this.dataset.tab).classList.add('active');
                ScrollTrigger.refresh();
            });
        });

        // Quick nav smooth scroll
        document.querySelectorAll('.avw-odp-quicknav a').forEach(function(a) {
            a.addEventListener('click', function(e) {
                var target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY - 140, behavior: 'smooth' });
                }
            });
        });
    }
});
</script>

<?php get_footer(); ?>
