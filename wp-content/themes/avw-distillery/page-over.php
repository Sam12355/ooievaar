<?php
/**
 * Template Name: Over
 * Slug: over
 *
 * @package avw-distillery
 */

get_header();
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
    max-width: 860px;
    margin: 0 auto;
    padding: 72px 24px 100px;
}

.avw-over-article {
    background: #fff;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 32px rgba(54,34,29,0.07);
    margin-bottom: 48px;
    border: 1px solid rgba(54,34,29,0.06);
}

.avw-over-article-inner {
    padding: 40px 44px;
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
    font-size: clamp(20px, 3vw, 28px);
    color: #36221d;
    font-weight: normal;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin: 0 0 24px;
    line-height: 1.25;
}

.avw-over-article-img {
    width: 100%;
    max-height: 420px;
    object-fit: cover;
    object-position: center top;
    display: block;
    margin-bottom: 0;
}

.avw-over-article-img-inline {
    float: left;
    width: 200px;
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
    margin: 0 0 28px;
}

/* clearfix for floated images */
.avw-over-article-body::after { content: ''; display: table; clear: both; }

@media (max-width: 600px) {
    .avw-over-article-inner { padding: 28px 24px; }
    .avw-over-article-img-inline { float: none; width: 100%; margin: 0 0 20px; }
}
</style>

<!-- HERO -->
<section class="avw-over-hero">
    <img id="over-hero-img" class="avw-over-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/over-japan.jpg" alt="A. van Wees Distilleerderij De Ooievaar" />
    <div class="avw-over-hero-overlay"></div>
    <div class="avw-over-hero-content">
        <nav class="avw-over-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;">Over</span>
        </nav>
        <h1 id="over-hero-title" class="avw-over-hero-title">Distilleerderij</h1>
    </div>
</section>

<!-- ARTICLES -->
<div class="avw-over-body">

    <!-- 1: Werkbezoek aan Japan -->
    <article class="avw-over-article">
        <img class="avw-over-article-img" src="<?php echo get_template_directory_uri(); ?>/assets/over-japan.jpg" alt="Werkbezoek aan Japan – Fenny van Wees" />
        <div class="avw-over-article-inner">
            <div class="avw-over-article-meta">
                <span>28 oktober 2025</span>
                <span class="avw-tag">Nieuwsbericht</span>
            </div>
            <h2>Werkbezoek aan Japan</h2>
            <div class="avw-over-divider"></div>
            <div class="avw-over-article-body">
                <p>Tijdens een inspirerend werkbezoek aan Japan vertegenwoordigde <strong>Fenny van Wees</strong> — als deelneemster bij een delegatie van 18 Nederlandse zakenvrouwen — de rijke <strong>Nederlandse distilleertraditie</strong>. De reis voerde langs toonaangevende bedrijven zoals <strong>Sake-distilleerderij Rairaku</strong> in Akashi, <strong>Panasonic Connects</strong>, <strong>SMBC Global</strong>, <strong>Intralink</strong> en de <strong>Nederlandse Ambassade</strong> in Tokio.</p>
                <p>Als symbool van vakmanschap en vriendschap tussen Nederland en Japan werd onze <strong>Zeer Oude Genever, 10 jaar gelagerd</strong>, namens de delegatie overhandigd aan <strong>CEO Toru Takakura</strong> en <strong>ambassadeur Gilles Beschoor Plug</strong>.</p>
                <p>Deze bijzondere ontmoeting benadrukt de gedeelde waardering voor <strong>ambacht, kwaliteit en culturele uitwisseling</strong> – waarden die de distilleerderij <strong>A. van Wees / De Ooievaar</strong> al generaties lang hooghoudt.</p>
            </div>
        </div>
    </article>

    <!-- 2: Rondleiding -->
    <article class="avw-over-article">
        <div class="avw-over-article-inner">
            <div class="avw-over-article-meta">
                <span>28 oktober 2025</span>
                <span class="avw-tag">Evenement</span>
            </div>
            <h2>Rondleiding met bijzondere proeverij</h2>
            <div class="avw-over-divider"></div>
            <div class="avw-over-article-body">
                <h2>Bij ons in de Jordaan…</h2>
                <h3>…Beleeft u de ambacht van De Ooievaar – distilleerderij!</h3>
                <p>Nieuwsgierig naar het echte Amsterdamse vakmanschap? Bij <strong>Distilleerderij De Ooievaar</strong> in de Jordaan krijgt u een uniek kijkje achter de schermen. Ruik de kruidige geuren van vers gestookte likeuren, bewonder de glanzende koperen ketels en wandel langs de fusten in onze authentieke lagerkelder. Onze gids vertelt u alles over het ambacht van het distilleren en het rijke erfgoed van De Ooievaar.</p>
                <p>Na de rondleiding kunt u genieten van een <strong>exclusieve proeverij</strong> met bijpassende hapjes. Ontdek verrassende smaakcombinaties die uw culinaire horizon verbreden – van jenevers tot likeuren, allemaal met liefde gestookt in Amsterdam.</p>
                <p>De eerstvolgende <strong>rondleiding en proeverij</strong> vindt plaats op <strong>vrijdag 30 januari 2026</strong>. Reserveer op tijd, want het aantal plaatsen is beperkt.</p>
                <p><strong>Meer informatie en reserveren over rondleidingen vindt u <a href="<?php echo home_url('/nl/rondleiding/'); ?>">hier</a>.</strong></p>
            </div>
        </div>
    </article>

    <!-- 3: Relatiegeschenken -->
    <article class="avw-over-article">
        <div class="avw-over-article-inner">
            <div class="avw-over-article-meta">
                <span>27 oktober 2025</span>
                <span class="avw-tag">Nieuws</span>
            </div>
            <h2>Relatiegeschenken</h2>
            <div class="avw-over-divider"></div>
            <div class="avw-over-article-body">
                <img class="avw-over-article-img-inline" src="<?php echo get_template_directory_uri(); ?>/assets/over-relatiegeschenken.jpg" alt="Relatiegeschenken A. van Wees" />
                <p>Verras jouw relaties met onze producten gecreëerd door ambachtelijk vakmanschap in enig overgebleven fijn-distilleerderij van Nederland. Van gin tot genever tot likeuren in grote en kleine verpakkingen. Bij A. van Wees worden de producten gestookt in koperen fijnketels met natuurlijke ingrediënten, gelagerd in eikenhouten vaten en met de hand getapt en verpakt. Dit gebeurt allemaal in het hart van de Jordaan.</p>
                <p>Proef en ervaar de oude ambiance van Amsterdam en schenk jouw collega's, familie, vrienden en/of partners een verfijnde lekkernij. Geschikt als apéritief, digestief of door gerechten zoals taart, stoofpeertjes of ijs. Ook verkrijgbaar in houten cadeauverpakking met glazen.</p>
                <p>En als klap op de vuurpijl kunt u uw relaties verrassen met onze ambachtelijk gemaakte likeurbonbons, waarin 8 van onze likeuren zich als vloeibare bommetjes tegen uw verhemelte openbaren! En vergeet ook onze rumbonen niet, een delicatesse die u praktisch nergens meer aantreft.</p>
            </div>
        </div>
    </article>

    <!-- 4: 100 jaar -->
    <article class="avw-over-article">
        <div class="avw-over-article-inner">
            <div class="avw-over-article-meta">
                <span>1 december 2022</span>
                <span class="avw-tag">Nieuwsbericht</span>
            </div>
            <h2>"Distilleerderij in hartje Jordaan bestaat honderd jaar"</h2>
            <div class="avw-over-divider"></div>
            <div class="avw-over-article-body">
                <h2>Familiebedrijf A. Van Wees – De Ooievaar bestaat 100 jaar</h2>
                <p>De Jordaankrant heeft recent een pagina gewijd aan het 100-jarig bestaan van ons ambachtelijke distilleerderij.</p>
                <p><a href="<?php echo get_template_directory_uri(); ?>/assets/Jordaankrant_100_jaar_van_wees.pdf" target="_blank">Lees hier het interview (p. 3)</a></p>
            </div>
        </div>
    </article>

    <!-- 5: Gastblog -->
    <article class="avw-over-article">
        <div class="avw-over-article-inner">
            <div class="avw-over-article-meta">
                <span>27 juli 2016</span>
                <span class="avw-tag">Opinie</span>
            </div>
            <h2>Kleine distilleerderijen – Gastblog Marketing Tribune</h2>
            <div class="avw-over-divider"></div>
            <div class="avw-over-article-body">
                <h3>Kleine distilleerderijen teken aan de wand</h3>
                <p>Soms moet me iets van het hart. Bijna dagelijks stelt men mij de vraag, direct gevolgd door het verwachte antwoord: 'wat denkt u van de opkomst van kleine brouwerijen en distilleerderijen, is dat geen enorme boost voor uw vak?' Ik bijt dan even op mijn tong om te voorkomen dat de accuut opkomende ergernis mij tot een venijnige uitspraak verleidt.</p>
                <p>De vraag stellen en hem zelf min of meer beantwoorden, is helaas illustratief voor zowel het imago van als het gebrek aan kennis over het ambacht dat ons land als sinds begin 20e eeuw teistert. Met het grootste gemak scheert de vraagsteller brouwerij en distilleerderij over één kam.</p>
                <p>Vakmanschap bestaat zolang het publiek, de maatschappij haar herkent en erkent. Zodra een ambacht geen deel meer uitmaakt van onze gedeelde waarden, ofwel zodra men het ambacht als zodanig terugbrengt tot een handeling die door elke leek kan worden verricht, is het bestaansrecht van een ambacht verdwenen.</p>
                <blockquote style="border-left: 4px solid #432B25; padding-left: 20px; margin: 24px 0; font-style: italic; color: rgba(54,34,29,0.7);">
                    'Vakmanschap staat voor een duurzame, basale menselijke drijfveer, het verlangen om werk goed uit te voeren omwille van het werk zelf.' – Richard Sennett, de ambachtsman
                </blockquote>
            </div>
        </div>
    </article>

    <!-- 6: Parool -->
    <article class="avw-over-article">
        <div class="avw-over-article-inner">
            <div class="avw-over-article-meta">
                <span>8 juli 2016</span>
                <span class="avw-tag">Nieuws</span>
            </div>
            <h2>Amsterdamse fijndistillatie is nu cultureel erfgoed, aldus het Parool</h2>
            <div class="avw-over-divider"></div>
            <div class="avw-over-article-body">
                <p>Laura Obdeijn van Het Parool vraagt ons naar aanleiding van de plaatsing van het ambacht fijndistilleren te Amsterdam op de nationale inventaris immaterieel erfgoed honderduit over fijndistillatie.</p>
                <p><a href="http://www.parool.nl/amsterdam/amsterdamse-fijndistillatie-is-nu-cultureel-erfgoed~a4336062/" target="_blank">Lees het hele interview online</a></p>
            </div>
        </div>
    </article>

    <!-- 7: Immaterieel Erfgoed -->
    <article class="avw-over-article">
        <div class="avw-over-article-inner">
            <div class="avw-over-article-meta">
                <span>6 juli 2016</span>
                <span class="avw-tag">Accolades</span>
            </div>
            <h2>Fijndistilleren van Genevers en likeur als ambacht erkend op de nationale Inventaris Immaterieel Erfgoed</h2>
            <div class="avw-over-divider"></div>
            <div class="avw-over-article-body">
                <p>Vandaag is bekend geworden dat ons mooie ambacht fijndistillatie als zodanig erkend is op de Nationale Inventaris Immaterieel Erfgoed.</p>
                <h2>Fijndistillatie van genever en likeur in Amsterdam</h2>
                <p>De ambachtelijke fijndistillatie van genever en likeur is een delicaat proces, dat voor vijftig procent gaat om geur en smaak, zozeer, dat de ambachtsman zegt: 'Ruiken is begrijpen.' Jenever werd voor het eerst gestookt in Amsterdam na 1600. Het was eerder bedoeld als medicijn dan als genotsmiddel.</p>
                <p>De traditie wordt voorgedragen door Van Wees Distilleerderij De Ooievaar. Hier zet Fenny van Wees, distillateur, zich in om het ambacht toekomst te geven. Ze leidt opvolgers op in de eigen distilleerderij en is druk bezig om haar kennis te documenteren.</p>
                <p><a href="http://immaterieelerfgoed.nl/nieuws/details/vier-nieuwe-ambachten-op-de-nationale-inventaris-immaterieel-cultureel-erfgoed-in-nederland/122" target="_blank">Lees het volledige artikel hier</a></p>
            </div>
        </div>
    </article>

    <!-- 8: Yuzu -->
    <article class="avw-over-article">
        <div class="avw-over-article-inner">
            <div class="avw-over-article-meta">
                <span>4 juli 2016</span>
                <span class="avw-tag">Nieuws</span>
            </div>
            <h2>Primeur: Yuzu Distilled Gin en Yuzulikeur</h2>
            <div class="avw-over-divider"></div>
            <div class="avw-over-article-body">
                <p>Nieuw in ons assortiment!</p>
                <p>De yuzu, een bijzonder Japanse citrusvrucht, komt rechtstreeks uit Japan. Van de vers ingevlogen vruchtjes stoken wij direct een prachtig geurend distillaat. Het gin-distillaat voor de Yuzu distilled gin wordt gestookt volgens authentiek gin recept, met jeneverbessen, citroen, coriander, wat angelica en de rest houden we voor ons.</p>
                <p>Onze Yuzu distilled gin is een vijftig/vijftig blend van beide distillaten, samen 100% gedistilleerd. Van het yuzu distillaat wordt tevens onze Yuzu likeur gemaakt. Beide zijn verrukkelijk om puur te drinken.</p>
                <p>Proost!</p>
            </div>
        </div>
    </article>

    <!-- 9: Radio 1 -->
    <article class="avw-over-article">
        <div class="avw-over-article-inner">
            <div class="avw-over-article-meta">
                <span>14 mei 2016</span>
                <span class="avw-tag">Interview</span>
            </div>
            <h2>Over vrouw, ambacht en fijndistillatie bij de Nieuwsshow</h2>
            <div class="avw-over-divider"></div>
            <div class="avw-over-article-body">
                <p><strong>Over vrouw, ambacht en fijndistillatie bij de Nieuwsshow op Radio 1.</strong></p>
                <p>"Fenny van Wees is eigenaar van de Amsterdamse distilleerderij De Ooievaar. Een zeer oud bedrijf, het bestaat sinds 1782. Haar opa en haar vader waren er ook al stoker. De afgelopen veertig jaar verdwenen tientallen distilleerderijen. En daarmee veel van de kennis van het vak. Fenny van Wees beheerst dit ambacht tot in de puntjes. Ze vertelt in onze studio over de kunst van het distilleren."</p>
                <p><a href="http://www.nporadio1.nl/nieuwsshow/onderwerpen/356275-kleine-distilleerderijen-profiteren-van-de-hang-naar-lokaal-en-ambachtelijk" target="_blank">Luister hier naar de uitzending.</a></p>
            </div>
        </div>
    </article>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.fromTo('#over-hero-img',
            { yPercent: -15 },
            {
                yPercent: 15,
                ease: 'none',
                scrollTrigger: {
                    trigger: '#over-hero-title',
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true
                }
            }
        );
    }
});
</script>

<?php get_footer(); ?>
