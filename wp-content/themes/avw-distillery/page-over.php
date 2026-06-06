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
/* ============================================================
   OVER PAGE
   ============================================================ */
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

/* ---- Articles Feed ---- */
.avw-over-body {
    width: 70%;
    margin: 0 auto;
    padding: 72px 0 100px;
}

/* Single white card wrapping all articles */
.avw-over-card {
    background: #fff;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 40px rgba(54,34,29,0.08);
    border: 1px solid rgba(54,34,29,0.06);
}

/* Japan photo — full height, no cap */
.avw-over-japan-img {
    width: 100%;
    height: 520px;
    object-fit: cover;
    object-position: center 20%;
    display: block;
}

.avw-over-article {
    padding: 40px 48px;
    border-bottom: 1px solid rgba(54,34,29,0.07);
}

.avw-over-article:last-child {
    border-bottom: none;
}

.avw-over-article-meta {
    font-family: 'DM Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: rgba(54,34,29,0.4);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.avw-over-article-meta .avw-tag {
    background: rgba(54,34,29,0.06);
    border-radius: 20px;
    padding: 3px 12px;
    color: rgba(54,34,29,0.5);
}

.avw-over-article h2 {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(18px, 2.5vw, 26px);
    color: #36221d;
    font-weight: normal;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin: 0 0 20px;
    line-height: 1.25;
}

.avw-over-article-img-inline {
    float: left;
    width: 180px;
    border-radius: 14px;
    margin: 0 28px 16px 0;
    object-fit: cover;
}

.avw-over-article-body {
    font-family: 'DM Sans', sans-serif;
    font-size: 16px;
    line-height: 1.8;
    color: rgba(54,34,29,0.8);
    overflow: hidden;
}

.avw-over-article-body p { margin-bottom: 16px; }
.avw-over-article-body p:last-child { margin-bottom: 0; }
.avw-over-article-body h1,
.avw-over-article-body h2,
.avw-over-article-body h3 {
    font-family: 'Kurversbrug', serif;
    font-weight: normal;
    color: #36221d;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin: 20px 0 12px;
}
.avw-over-article-body h1 { font-size: 22px; }
.avw-over-article-body h2 { font-size: 19px; }
.avw-over-article-body h3 { font-size: 16px; }
.avw-over-article-body a { color: #432B25; font-weight: 600; }
.avw-over-article-body strong { color: #36221d; }

.avw-over-divider {
    width: 48px;
    height: 3px;
    background: linear-gradient(90deg, rgba(0,0,0,0.2), rgba(0,0,0,0.2)), #432B25;
    border-radius: 3px;
    margin: 0 0 24px;
}

.avw-over-article-body::after { content: ''; display: table; clear: both; }

@media (max-width: 900px) {
    .avw-over-body { width: 92%; }
    .avw-over-article { padding: 28px 24px; }
    .avw-over-japan-img { height: 340px; }
    .avw-over-article-img-inline { float: none; width: 100%; margin: 0 0 20px; }
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
            <span style="color:#fff;"><?php echo $is_en ? 'About' : 'Over'; ?></span>
        </nav>
        <h1 id="over-hero-title" class="avw-over-hero-title"><?php echo $is_en ? 'Distillery' : 'Distilleerderij'; ?></h1>
    </div>
</section>

<!-- ARTICLES -->
<div class="avw-over-body">
<div class="avw-over-card">

    <!-- 1: Japan visit -->
    <article class="avw-over-article" style="padding: 0;">
        <img class="avw-over-japan-img" src="<?php echo home_url('/wp-content/uploads/2026/05/d_Image_a6mnka6mnka6mnka.jpg'); ?>" alt="<?php echo $is_en ? 'Working visit to Japan – Fenny van Wees' : 'Werkbezoek aan Japan – Fenny van Wees'; ?>" />
        <div style="padding: 40px 48px;">
            <div class="avw-over-article-meta">
                <span>28 <?php echo $is_en ? 'October' : 'oktober'; ?> 2025</span>
                <span class="avw-tag"><?php echo $is_en ? 'News' : 'Nieuwsbericht'; ?></span>
            </div>
            <h2><?php echo $is_en ? 'Working visit to Japan' : 'Werkbezoek aan Japan'; ?></h2>
            <div class="avw-over-divider"></div>
            <div class="avw-over-article-body">
                <?php if ( $is_en ): ?>
                <p>During an inspiring working visit to Japan, <strong>Fenny van Wees</strong> — as a participant in a delegation of 18 Dutch businesswomen — represented the rich <strong>Dutch distilling tradition</strong>. The trip took them to leading companies such as <strong>sake distillery Rairaku</strong> in Akashi, <strong>Panasonic Connects</strong>, <strong>SMBC Global</strong>, <strong>Intralink</strong> and the <strong>Dutch Embassy</strong> in Tokyo.</p>
                <p>As a symbol of craftsmanship and friendship between the Netherlands and Japan, our <strong>Zeer Oude Genever, aged 10 years</strong>, was presented on behalf of the delegation to <strong>CEO Toru Takakura</strong> and <strong>ambassador Gilles Beschoor Plug</strong>.</p>
                <p>This special encounter underlines the shared appreciation for <strong>craftsmanship, quality and cultural exchange</strong> — values that distillery <strong>A. van Wees / De Ooievaar</strong> has upheld for generations.</p>
                <?php else: ?>
                <p>Tijdens een inspirerend werkbezoek aan Japan vertegenwoordigde <strong>Fenny van Wees</strong> — als deelneemster bij een delegatie van 18 Nederlandse zakenvrouwen — de rijke <strong>Nederlandse distilleertraditie</strong>. De reis voerde langs toonaangevende bedrijven zoals <strong>Sake-distilleerderij Rairaku</strong> in Akashi, <strong>Panasonic Connects</strong>, <strong>SMBC Global</strong>, <strong>Intralink</strong> en de <strong>Nederlandse Ambassade</strong> in Tokio.</p>
                <p>Als symbool van vakmanschap en vriendschap tussen Nederland en Japan werd onze <strong>Zeer Oude Genever, 10 jaar gelagerd</strong>, namens de delegatie overhandigd aan <strong>CEO Toru Takakura</strong> en <strong>ambassadeur Gilles Beschoor Plug</strong>.</p>
                <p>Deze bijzondere ontmoeting benadrukt de gedeelde waardering voor <strong>ambacht, kwaliteit en culturele uitwisseling</strong> – waarden die de distilleerderij <strong>A. van Wees / De Ooievaar</strong> al generaties lang hooghoudt.</p>
                <?php endif; ?>
            </div>
        </div>
    </article>

    <!-- 2: Tour -->
    <article class="avw-over-article">
        <div class="avw-over-article-meta">
            <span>28 <?php echo $is_en ? 'October' : 'oktober'; ?> 2025</span>
            <span class="avw-tag"><?php echo $is_en ? 'Event' : 'Evenement'; ?></span>
        </div>
        <h2><?php echo $is_en ? 'Tour with exclusive tasting' : 'Rondleiding met bijzondere proeverij'; ?></h2>
        <div class="avw-over-divider"></div>
        <div class="avw-over-article-body">
            <?php if ( $is_en ): ?>
            <h2>At our location in the Jordaan…</h2>
            <h3>…Experience the craft of De Ooievaar distillery!</h3>
            <p>Curious about true Amsterdam craftsmanship? At <strong>Distillery De Ooievaar</strong> in the Jordaan, you get a unique behind-the-scenes look. Smell the aromatic scents of freshly distilled liqueurs, admire the gleaming copper stills and walk past the casks in our authentic maturation cellar. Our guide will tell you everything about the craft of distilling and the rich heritage of De Ooievaar.</p>
            <p>After the tour you can enjoy an <strong>exclusive tasting</strong> with matching snacks. Discover surprising flavour combinations that broaden your culinary horizon — from genevers to liqueurs, all lovingly distilled in Amsterdam.</p>
            <p>The next <strong>tour and tasting</strong> takes place on <strong>Friday 30 January 2026</strong>. Reserve in time, as places are limited.</p>
            <p><strong>More information and reservations for tours can be found <a href="<?php echo home_url('/en/rondleiding/'); ?>">here</a>.</strong></p>
            <?php else: ?>
            <h2>Bij ons in de Jordaan…</h2>
            <h3>…Beleeft u de ambacht van De Ooievaar – distilleerderij!</h3>
            <p>Nieuwsgierig naar het echte Amsterdamse vakmanschap? Bij <strong>Distilleerderij De Ooievaar</strong> in de Jordaan krijgt u een uniek kijkje achter de schermen. Ruik de kruidige geuren van vers gestookte likeuren, bewonder de glanzende koperen ketels en wandel langs de fusten in onze authentieke lagerkelder. Onze gids vertelt u alles over het ambacht van het distilleren en het rijke erfgoed van De Ooievaar.</p>
            <p>Na de rondleiding kunt u genieten van een <strong>exclusieve proeverij</strong> met bijpassende hapjes. Ontdek verrassende smaakcombinaties die uw culinaire horizon verbreden – van jenevers tot likeuren, allemaal met liefde gestookt in Amsterdam.</p>
            <p>De eerstvolgende <strong>rondleiding en proeverij</strong> vindt plaats op <strong>vrijdag 30 januari 2026</strong>. Reserveer op tijd, want het aantal plaatsen is beperkt.</p>
            <p><strong>Meer informatie en reserveren over rondleidingen vindt u <a href="<?php echo home_url('/nl/rondleiding/'); ?>">hier</a>.</strong></p>
            <?php endif; ?>
        </div>
    </article>

    <!-- 3: Corporate gifts / Relatiegeschenken -->
    <article class="avw-over-article">
        <div class="avw-over-article-meta">
            <span>27 <?php echo $is_en ? 'October' : 'oktober'; ?> 2025</span>
            <span class="avw-tag"><?php echo $is_en ? 'News' : 'Nieuws'; ?></span>
        </div>
        <h2><?php echo $is_en ? 'Corporate gifts' : 'Relatiegeschenken'; ?></h2>
        <div class="avw-over-divider"></div>
        <div class="avw-over-article-body">
            <img class="avw-over-article-img-inline" src="<?php echo get_template_directory_uri(); ?>/assets/over-relatiegeschenken.jpg" alt="<?php echo $is_en ? 'Corporate gifts A. van Wees' : 'Relatiegeschenken A. van Wees'; ?>" />
            <?php if ( $is_en ): ?>
            <p>Surprise your relations with our products created through artisan craftsmanship at the only remaining fine distillery in the Netherlands. From gin to genever to liqueurs in large and small packaging. At A. van Wees, products are distilled in copper fine stills with natural ingredients, matured in oak barrels and hand-drawn and packaged — all in the heart of the Jordaan.</p>
            <p>Taste and experience the old ambiance of Amsterdam and gift your colleagues, family, friends and/or partners a refined treat. Suitable as an aperitif, digestif or in dishes such as cake, stewed pears or ice cream. Also available in a wooden gift packaging with glasses.</p>
            <p>And to top it all off, you can surprise your relations with our artisanally made liqueur chocolates, in which 8 of our liqueurs reveal themselves as liquid delights against your palate! And don't forget our rum truffles either — a delicacy you can practically no longer find anywhere.</p>
            <?php else: ?>
            <p>Verras jouw relaties met onze producten gecreëerd door ambachtelijk vakmanschap in enig overgebleven fijn-distilleerderij van Nederland. Van gin tot genever tot likeuren in grote en kleine verpakkingen. Bij A. van Wees worden de producten gestookt in koperen fijnketels met natuurlijke ingrediënten, gelagerd in eikenhouten vaten en met de hand getapt en verpakt. Dit gebeurt allemaal in het hart van de Jordaan.</p>
            <p>Proef en ervaar de oude ambiance van Amsterdam en schenk jouw collega's, familie, vrienden en/of partners een verfijnde lekkernij. Geschikt als apéritief, digestief of door gerechten zoals taart, stoofpeertjes of ijs. Ook verkrijgbaar in houten cadeauverpakking met glazen.</p>
            <p>En als klap op de vuurpijl kunt u uw relaties verrassen met onze ambachtelijk gemaakte likeurbonbons, waarin 8 van onze likeuren zich als vloeibare bommetjes tegen uw verhemelte openbaren! En vergeet ook onze rumbonen niet, een delicatesse die u praktisch nergens meer aantreft.</p>
            <?php endif; ?>
        </div>
    </article>

    <!-- 4: 100 years -->
    <article class="avw-over-article">
        <div class="avw-over-article-meta">
            <span>1 <?php echo $is_en ? 'December' : 'december'; ?> 2022</span>
            <span class="avw-tag"><?php echo $is_en ? 'News' : 'Nieuwsbericht'; ?></span>
        </div>
        <h2><?php echo $is_en ? '"Distillery in the heart of the Jordaan celebrates one hundred years"' : '"Distilleerderij in hartje Jordaan bestaat honderd jaar"'; ?></h2>
        <div class="avw-over-divider"></div>
        <div class="avw-over-article-body">
            <?php if ( $is_en ): ?>
            <h2>Family business A. Van Wees – De Ooievaar turns 100 years</h2>
            <p>The Jordaan neighbourhood newspaper recently devoted a page to the centenary of our artisan distillery.</p>
            <p><a href="<?php echo get_template_directory_uri(); ?>/assets/Jordaankrant_100_jaar_van_wees.pdf" target="_blank">Read the interview here (p. 3)</a></p>
            <?php else: ?>
            <h2>Familiebedrijf A. Van Wees – De Ooievaar bestaat 100 jaar</h2>
            <p>De Jordaankrant heeft recent een pagina gewijd aan het 100-jarig bestaan van ons ambachtelijke distilleerderij.</p>
            <p><a href="<?php echo get_template_directory_uri(); ?>/assets/Jordaankrant_100_jaar_van_wees.pdf" target="_blank">Lees hier het interview (p. 3)</a></p>
            <?php endif; ?>
        </div>
    </article>

    <!-- 5: Guest blog -->
    <article class="avw-over-article">
        <div class="avw-over-article-meta">
            <span>27 <?php echo $is_en ? 'July' : 'juli'; ?> 2016</span>
            <span class="avw-tag"><?php echo $is_en ? 'Opinion' : 'Opinie'; ?></span>
        </div>
        <h2><?php echo $is_en ? 'Small distilleries – Guest blog Marketing Tribune' : 'Kleine distilleerderijen – Gastblog Marketing Tribune'; ?></h2>
        <div class="avw-over-divider"></div>
        <div class="avw-over-article-body">
            <?php if ( $is_en ): ?>
            <h3>Small distilleries: a sign of the times</h3>
            <p>Sometimes I need to get something off my chest. Almost daily someone asks me the question, immediately followed by the expected answer: 'What do you think of the rise of small breweries and distilleries — isn't that a huge boost for your trade?' I then bite my tongue to prevent the suddenly rising irritation from leading me into a cutting remark.</p>
            <p>Asking the question and more or less answering it yourself is, unfortunately, illustrative of both the image of and the lack of knowledge about the craft that has plagued our country since the early 20th century. The questioner effortlessly lumps brewery and distillery together.</p>
            <p>Craftsmanship exists as long as the public, society, recognises and acknowledges it. The moment a craft is no longer part of our shared values — the moment it is reduced to an action any layperson can perform — its right to exist has disappeared.</p>
            <blockquote style="border-left: 4px solid #432B25; padding-left: 20px; margin: 24px 0; font-style: italic; color: rgba(54,34,29,0.7);">
                'Craftsmanship stands for a sustainable, basic human drive — the desire to do work well for its own sake.' — Richard Sennett, The Craftsman
            </blockquote>
            <?php else: ?>
            <h3>Kleine distilleerderijen teken aan de wand</h3>
            <p>Soms moet me iets van het hart. Bijna dagelijks stelt men mij de vraag, direct gevolgd door het verwachte antwoord: 'wat denkt u van de opkomst van kleine brouwerijen en distilleerderijen, is dat geen enorme boost voor uw vak?' Ik bijt dan even op mijn tong om te voorkomen dat de accuut opkomende ergernis mij tot een venijnige uitspraak verleidt.</p>
            <p>De vraag stellen en hem zelf min of meer beantwoorden, is helaas illustratief voor zowel het imago van als het gebrek aan kennis over het ambacht dat ons land als sinds begin 20e eeuw teistert. Met het grootste gemak scheert de vraagsteller brouwerij en distilleerderij over één kam.</p>
            <p>Vakmanschap bestaat zolang het publiek, de maatschappij haar herkent en erkent. Zodra een ambacht geen deel meer uitmaakt van onze gedeelde waarden, ofwel zodra men het ambacht als zodanig terugbrengt tot een handeling die door elke leek kan worden verricht, is het bestaansrecht van een ambacht verdwenen.</p>
            <blockquote style="border-left: 4px solid #432B25; padding-left: 20px; margin: 24px 0; font-style: italic; color: rgba(54,34,29,0.7);">
                'Vakmanschap staat voor een duurzame, basale menselijke drijfveer, het verlangen om werk goed uit te voeren omwille van het werk zelf.' – Richard Sennett, de ambachtsman
            </blockquote>
            <?php endif; ?>
        </div>
    </article>

    <!-- 6: Parool -->
    <article class="avw-over-article">
        <div class="avw-over-article-meta">
            <span>8 <?php echo $is_en ? 'July' : 'juli'; ?> 2016</span>
            <span class="avw-tag"><?php echo $is_en ? 'News' : 'Nieuws'; ?></span>
        </div>
        <h2><?php echo $is_en ? 'Amsterdam fine distillation is now cultural heritage, according to Het Parool' : 'Amsterdamse fijndistillatie is nu cultureel erfgoed, aldus het Parool'; ?></h2>
        <div class="avw-over-divider"></div>
        <div class="avw-over-article-body">
            <?php if ( $is_en ): ?>
            <p>Laura Obdeijn of Het Parool asks us all about fine distillation following the listing of the craft of fine distilling in Amsterdam on the national inventory of intangible heritage.</p>
            <p><a href="http://www.parool.nl/amsterdam/amsterdamse-fijndistillatie-is-nu-cultureel-erfgoed~a4336062/" target="_blank">Read the full interview online</a></p>
            <?php else: ?>
            <p>Laura Obdeijn van Het Parool vraagt ons naar aanleiding van de plaatsing van het ambacht fijndistilleren te Amsterdam op de nationale inventaris immaterieel erfgoed honderduit over fijndistillatie.</p>
            <p><a href="http://www.parool.nl/amsterdam/amsterdamse-fijndistillatie-is-nu-cultureel-erfgoed~a4336062/" target="_blank">Lees het hele interview online</a></p>
            <?php endif; ?>
        </div>
    </article>

    <!-- 7: Intangible heritage -->
    <article class="avw-over-article">
        <div class="avw-over-article-meta">
            <span>6 <?php echo $is_en ? 'July' : 'juli'; ?> 2016</span>
            <span class="avw-tag"><?php echo $is_en ? 'Accolades' : 'Accolades'; ?></span>
        </div>
        <h2><?php echo $is_en ? 'Fine distillation of genevers and liqueur recognised as craft on the National Inventory of Intangible Heritage' : 'Fijndistilleren van Genevers en likeur als ambacht erkend op de nationale Inventaris Immaterieel Erfgoed'; ?></h2>
        <div class="avw-over-divider"></div>
        <div class="avw-over-article-body">
            <?php if ( $is_en ): ?>
            <p>Today it was announced that our beautiful craft of fine distillation has been recognised as such on the National Inventory of Intangible Heritage.</p>
            <h2>Fine distillation of genever and liqueur in Amsterdam</h2>
            <p>The artisan fine distillation of genever and liqueur is a delicate process — one that is fifty percent about scent and flavour, so much so that the craftsman says: 'To smell is to understand.' Genever was first distilled in Amsterdam after 1600. It was originally intended as medicine rather than a recreational drink.</p>
            <p>The tradition is carried forward by Van Wees Distillery De Ooievaar. Here Fenny van Wees, distiller, commits herself to giving the craft a future. She trains successors at the distillery itself and is busy documenting her knowledge.</p>
            <p><a href="http://immaterieelerfgoed.nl/nieuws/details/vier-nieuwe-ambachten-op-de-nationale-inventaris-immaterieel-cultureel-erfgoed-in-nederland/122" target="_blank">Read the full article here</a></p>
            <?php else: ?>
            <p>Vandaag is bekend geworden dat ons mooie ambacht fijndistillatie als zodanig erkend is op de Nationale Inventaris Immaterieel Erfgoed.</p>
            <h2>Fijndistillatie van genever en likeur in Amsterdam</h2>
            <p>De ambachtelijke fijndistillatie van genever en likeur is een delicaat proces, dat voor vijftig procent gaat om geur en smaak, zozeer, dat de ambachtsman zegt: 'Ruiken is begrijpen.' Jenever werd voor het eerst gestookt in Amsterdam na 1600. Het was eerder bedoeld als medicijn dan als genotsmiddel.</p>
            <p>De traditie wordt voorgedragen door Van Wees Distilleerderij De Ooievaar. Hier zet Fenny van Wees, distillateur, zich in om het ambacht toekomst te geven. Ze leidt opvolgers op in de eigen distilleerderij en is druk bezig om haar kennis te documenteren.</p>
            <p><a href="http://immaterieelerfgoed.nl/nieuws/details/vier-nieuwe-ambachten-op-de-nationale-inventaris-immaterieel-cultureel-erfgoed-in-nederland/122" target="_blank">Lees het volledige artikel hier</a></p>
            <?php endif; ?>
        </div>
    </article>

    <!-- 8: Yuzu -->
    <article class="avw-over-article">
        <div class="avw-over-article-meta">
            <span>4 <?php echo $is_en ? 'July' : 'juli'; ?> 2016</span>
            <span class="avw-tag"><?php echo $is_en ? 'News' : 'Nieuws'; ?></span>
        </div>
        <h2><?php echo $is_en ? 'First: Yuzu Distilled Gin and Yuzu Liqueur' : 'Primeur: Yuzu Distilled Gin en Yuzulikeur'; ?></h2>
        <div class="avw-over-divider"></div>
        <div class="avw-over-article-body">
            <?php if ( $is_en ): ?>
            <p>New in our range!</p>
            <p>The yuzu, a remarkable Japanese citrus fruit, comes directly from Japan. From the freshly flown-in fruits we immediately distil a beautifully fragrant distillate. The gin distillate for the Yuzu Distilled Gin is distilled according to an authentic gin recipe, with juniper berries, lemon, coriander, some angelica — and the rest we keep to ourselves.</p>
            <p>Our Yuzu Distilled Gin is a fifty/fifty blend of both distillates, 100% distilled together. The yuzu distillate is also used to make our Yuzu Liqueur. Both are delicious to drink neat.</p>
            <p>Cheers!</p>
            <?php else: ?>
            <p>Nieuw in ons assortiment!</p>
            <p>De yuzu, een bijzonder Japanse citrusvrucht, komt rechtstreeks uit Japan. Van de vers ingevlogen vruchtjes stoken wij direct een prachtig geurend distillaat. Het gin-distillaat voor de Yuzu distilled gin wordt gestookt volgens authentiek gin recept, met jeneverbessen, citroen, coriander, wat angelica en de rest houden we voor ons.</p>
            <p>Onze Yuzu distilled gin is een vijftig/vijftig blend van beide distillaten, samen 100% gedistilleerd. Van het yuzu distillaat wordt tevens onze Yuzu likeur gemaakt. Beide zijn verrukkelijk om puur te drinken.</p>
            <p>Proost!</p>
            <?php endif; ?>
        </div>
    </article>

    <!-- 9: Radio 1 -->
    <article class="avw-over-article">
        <div class="avw-over-article-meta">
            <span>14 <?php echo $is_en ? 'May' : 'mei'; ?> 2016</span>
            <span class="avw-tag"><?php echo $is_en ? 'Interview' : 'Interview'; ?></span>
        </div>
        <h2><?php echo $is_en ? 'On women, craft and fine distillation at Nieuwsshow' : 'Over vrouw, ambacht en fijndistillatie bij de Nieuwsshow'; ?></h2>
        <div class="avw-over-divider"></div>
        <div class="avw-over-article-body">
            <?php if ( $is_en ): ?>
            <p><strong>On women, craft and fine distillation at Nieuwsshow on Radio 1.</strong></p>
            <p>"Fenny van Wees is the owner of Amsterdam distillery De Ooievaar. A very old company, it has existed since 1782. Her grandfather and father were distillers there too. Over the past forty years, dozens of distilleries have disappeared — and with them much of the knowledge of the trade. Fenny van Wees has mastered this craft to perfection. She talks in our studio about the art of distilling."</p>
            <p><a href="http://www.nporadio1.nl/nieuwsshow/onderwerpen/356275-kleine-distilleerderijen-profiteren-van-de-hang-naar-lokaal-en-ambachtelijk" target="_blank">Listen to the broadcast here.</a></p>
            <?php else: ?>
            <p><strong>Over vrouw, ambacht en fijndistillatie bij de Nieuwsshow op Radio 1.</strong></p>
            <p>"Fenny van Wees is eigenaar van de Amsterdamse distilleerderij De Ooievaar. Een zeer oud bedrijf, het bestaat sinds 1782. Haar opa en haar vader waren er ook al stoker. De afgelopen veertig jaar verdwenen tientallen distilleerderijen. En daarmee veel van de kennis van het vak. Fenny van Wees beheerst dit ambacht tot in de puntjes. Ze vertelt in onze studio over de kunst van het distilleren."</p>
            <p><a href="http://www.nporadio1.nl/nieuwsshow/onderwerpen/356275-kleine-distilleerderijen-profiteren-van-de-hang-naar-lokaal-en-ambachtelijk" target="_blank">Luister hier naar de uitzending.</a></p>
            <?php endif; ?>
        </div>
    </article>

</div><!-- .avw-over-card -->
</div>

<?php get_footer(); ?>
