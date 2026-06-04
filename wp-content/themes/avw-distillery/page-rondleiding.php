<?php
/**
 * Template Name: Rondleiding
 *
 * @package avw-distillery
 */

get_header();
?>

<style>
/* ============================================================
   RONDLEIDING PAGE
   ============================================================ */
.avw-rond-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-rond-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 40%; opacity: 0.45;
}
.avw-rond-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-rond-hero-content {
    position: relative; z-index: 10;
    max-width: 900px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-rond-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-rond-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-rond-breadcrumb a:hover { color: #fff; }
.avw-rond-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(42px, 7vw, 80px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.05; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* ---- Body ---- */
.avw-rond-body {
    width: 80%; max-width: 1200px; margin: 0 auto; padding: 72px 0 100px;
}

/* ---- Single white container ---- */
.avw-rond-main-card {
    background: #fff; border-radius: 20px;
    box-shadow: 0 4px 32px rgba(54,34,29,0.07); border: 1px solid rgba(54,34,29,0.06);
    overflow: hidden;
}
.avw-rond-section {
    padding: 40px 48px;
    border-bottom: 1px solid rgba(54,34,29,0.08);
}
.avw-rond-section:last-of-type { border-bottom: none; }

/* ---- Section headings ---- */
.avw-rond-card-title {
    font-family: 'Kurversbrug', serif; font-size: 22px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.09em; font-weight: normal;
    margin: 0 0 18px; padding-bottom: 14px;
    border-bottom: 2px solid rgba(54,34,29,0.1);
}
.avw-rond-card-title.green { color: #2d5a3d; border-bottom-color: rgba(45,90,61,0.15); }
.avw-rond-card-text {
    font-family: 'DM Sans', sans-serif; font-size: 15px; line-height: 1.85;
    color: rgba(54,34,29,0.78);
}
.avw-rond-card-text p { margin-bottom: 14px; }
.avw-rond-card-text p:last-child { margin-bottom: 0; }
.avw-rond-card-text a { color: #432B25; }

/* ---- Badges ---- */
.avw-rond-badge-row {
    display: flex; flex-wrap: wrap; gap: 12px; margin-top: 20px;
}
.avw-rond-badge {
    font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
    background: #fdf8f1; color: #36221d;
    border: 1.5px solid rgba(54,34,29,0.15); border-radius: 20px;
    padding: 7px 18px;
}
.avw-rond-badge.highlight {
    background: #432B25; color: #eedfcb; border-color: #432B25;
}

/* ---- Proeflokaal sub-item headings ---- */
.avw-rond-proef-item-title {
    font-family: 'Kurversbrug', serif; font-size: 18px; color: #2d5a3d;
    text-transform: uppercase; letter-spacing: 0.09em; font-weight: normal;
    margin: 0 0 10px;
}
.avw-rond-proef-item-text {
    font-family: 'DM Sans', sans-serif; font-size: 15px; line-height: 1.8;
    color: rgba(54,34,29,0.75); margin: 0;
}
.avw-rond-proef-item-text a { color: #2d5a3d; }

/* ---- CTA ---- */
.avw-rond-cta-wrap {
    padding: 32px 48px 40px;
    border-top: 1px solid rgba(54,34,29,0.08);
    background: #fff;
}
.avw-rond-cta-btn {
    display: inline-block;
    background: linear-gradient(90deg, rgba(0,0,0,0.2), rgba(0,0,0,0.2)), #432B25;
    color: #fff; font-family: 'Kurversbrug', serif; font-size: 17px;
    text-transform: uppercase; letter-spacing: 0.12em;
    padding: 14px 48px; border-radius: 34px;
    text-decoration: none; transition: opacity 0.2s;
}
.avw-rond-cta-btn:hover { opacity: 0.88; }

@media (max-width: 900px) {
    .avw-rond-body { width: 92%; }
    .avw-rond-section, .avw-rond-cta-wrap { padding-left: 28px; padding-right: 28px; }
}
@media (max-width: 600px) {
    .avw-rond-body { width: 100%; padding-left: 16px; padding-right: 16px; }
    .avw-rond-section, .avw-rond-cta-wrap { padding-left: 20px; padding-right: 20px; }
}
</style>

<!-- HERO -->
<section class="avw-rond-hero">
    <img id="rond-hero-img" class="avw-rond-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="Rondleiding" />
    <div class="avw-rond-hero-overlay"></div>
    <div class="avw-rond-hero-content">
        <nav class="avw-rond-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;">Rondleiding</span>
        </nav>
        <h1 id="rond-hero-title" class="avw-rond-hero-title">Rondleiding</h1>
    </div>
</section>

<!-- CONTENT -->
<div class="avw-rond-body">
    <div class="avw-rond-main-card">

        <!-- Intro -->
        <div class="avw-rond-section">
            <h2 class="avw-rond-card-title">Reserveer een rondleiding met bijzondere proeverij bij onze distilleerderij.</h2>
            <div class="avw-rond-card-text">
                <p>Wilt u graag eens een kijkje nemen achter de schermen? De sfeer en de geur in de distilleerderij opsnuiven, de ketels van dichtbij bewonderen, een rondgang maken langs de fusten in de lagerkelder en het verhaal achter gedistilleerd horen? Dat kan!</p>
                <p>Als u in de distilleerderij ziet hoe al dat lekkers wordt gemaakt, wilt u het ongetwijfeld ook proeven. Dat kan aansluitend, tijdens een bijzondere proeverij in combinatie met wat bijpassende hapjes. Verrassende combinaties, die uw culinaire grenzen verleggen.</p>
            </div>
        </div>

        <!-- Hoe werkt het -->
        <div class="avw-rond-section">
            <h2 class="avw-rond-card-title">Hoe werkt het?</h2>
            <div class="avw-rond-card-text">
                <p>Aangezien er volop bedrijvigheid is in en rondom de distilleerderij, is tijd om rondleidingen te geven schaars. Wij zijn geen museum of toeristische attractie, maar willen u toch de mogelijkheid bieden om te laten zien "where the magic happens". Daarom organiseren wij de rondleidingen sporadisch en plannen we ze meestal kort van tevoren op een vrijdagmiddag om 15.00 uur in.</p>
                <p>De combinatie rondleiding in de distilleerderij en proeverij duurt in totaal twee uur. Deelnemen kan alleen op basis van inschrijving vooraf. U kunt zich met één of meer personen aanmelden, zodra wij een datum inplannen ontvangt iedere geïnteresseerde een uitnodiging. Heeft u interesse? Meld u dan aan via <a href="mailto:contact@de-ooievaar.nl">contact@de-ooievaar.nl</a>.</p>
            </div>
            <div class="avw-rond-badge-row">
                <span class="avw-rond-badge highlight">€ 40,50 per persoon</span>
                <span class="avw-rond-badge">Inclusief proeverij &amp; hapjes</span>
                <span class="avw-rond-badge">2 uur</span>
                <span class="avw-rond-badge highlight">Eerstvolgende: vrijdag 5 juni 2026 om 15.00 uur</span>
            </div>
        </div>

        <!-- Bedrijfsuitje -->
        <div class="avw-rond-section">
            <h2 class="avw-rond-card-title">Trakteer uw personeel op een uniek bedrijfsuitje</h2>
            <div class="avw-rond-card-text">
                <p>U kunt ook uw personeel trakteren op een uniek bedrijfsuitje. Dit kan voor een gezelschap van minimaal twaalf en maximaal twintig personen. Informeer naar de mogelijkheden via <a href="mailto:contact@de-ooievaar.nl">contact@de-ooievaar.nl</a>.</p>
                <p>Tijdens weekenden en feestdagen is de distilleerderij gesloten. Probeer minstens 3 tot 4 weken van tevoren te reserveren — die tijd hebben wij nodig om een rondleiding in te plannen.</p>
            </div>
            <div class="avw-rond-badge-row">
                <span class="avw-rond-badge">12 – 20 personen</span>
                <span class="avw-rond-badge">Min. 3–4 weken van tevoren reserveren</span>
            </div>
        </div>

        <!-- Cadeau -->
        <div class="avw-rond-section" style="border-bottom: none;">
            <h2 class="avw-rond-card-title">Geef een rondleiding cadeau aan een liefhebber</h2>
            <div class="avw-rond-card-text">
                <p>Bent u op zoek naar een bijzonder cadeau? Sinds kort bieden wij de mogelijkheid tot het bestellen van een rondleiding per persoon. U bestelt een of meerdere rondleidingen via onze webshop en geeft bij de bijzonderheden aan voor wie de rondleiding bestemd is. Zodra er een rondleiding wordt ingepland sturen wij hem of haar per e-mail een uitnodiging voor de eerstvolgende rondleiding. Mocht deze datum niet schikken, dan schuift hij of zij op naar de volgende datum, enzovoort.</p>
                <p>Het cadeau is voor onbeperkte duur geldig.</p>
            </div>
        </div>

        <!-- Proeflokaal intro -->
        <div class="avw-rond-section">
            <h2 class="avw-rond-card-title">Proeflokaal A. van Wees</h2>
            <div class="avw-rond-card-text">
                <p>Proef onze specialiteiten in Proeflokaal A. van Wees — volop genieten van al uw favorieten op de Herengracht in Amsterdam. Wilt u liever alleen proeven? De barmannen en barvrouwen geven deskundige voorlichting en schenken u een glas afgestemd op uw smaak en stemming. Van maandag tot en met zondag kunt u zelf uw favorieten uit ons assortiment kiezen.</p>
            </div>
        </div>

        <!-- Proeflokaal sub-items -->
        <div class="avw-rond-section">
            <h3 class="avw-rond-proef-item-title">Ideale locatie voor een proeverij, feestje of receptie</h3>
            <p class="avw-rond-proef-item-text">Proeflokaal A. van Wees is een prima plek om rustig van een borrel te genieten. Voor meer informatie over likeur- en jeneverproeverijen verzoeken wij u rechtstreeks contact op te nemen met het proeflokaal. Een origineel idee als u echt eens iets bijzonders wilt doen met vrienden, familie of zakelijke relaties.</p>
        </div>

        <div class="avw-rond-section">
            <h3 class="avw-rond-proef-item-title">Oudhollandse ambiance</h3>
            <p class="avw-rond-proef-item-text">U ontmoet elkaar in een unieke nostalgische setting: u waant zich in de glorietijd van de VOC. Proeflokaal A. van Wees is één van de mooiste, authentiek ingerichte proeflokalen in Amsterdam. Behalve heerlijke genevers en likeuren proeft u hier ook nog de sfeer van weleer.</p>
        </div>

        <div class="avw-rond-section">
            <h3 class="avw-rond-proef-item-title">(H)eerlijke dagverse gerechten</h3>
            <p class="avw-rond-proef-item-text">Naast de uitgebreide keuze aan Amsterdamse en Oudhollandse likeuren, genevers en bitters kunt u er ook genieten van een simpele maaltijd. De chef zet eerlijke gerechten van dagverse producten op het menu. Het hele jaar door serveren zij ook op het (binnen)terras aan de gracht.</p>
        </div>

        <div class="avw-rond-section">
            <h3 class="avw-rond-proef-item-title">Openingstijden</h3>
            <p class="avw-rond-proef-item-text">Van maandag tot en met zondag bent u van harte welkom tussen 12.00 en 24.00 uur.</p>
        </div>

        <div class="avw-rond-section">
            <h3 class="avw-rond-proef-item-title">Reserveren</h3>
            <p class="avw-rond-proef-item-text">Wij verzoeken u vriendelijk telefonisch te reserveren: <a href="tel:+31206254334">020 – 625 43 34</a> (ma. t/m vr. van 10.00 – 23.00 uur), of per e-mail: <a href="mailto:jenever@proeflokaalvanwees.nl">jenever@proeflokaalvanwees.nl</a></p>
        </div>

        <div class="avw-rond-cta-wrap">
            <a class="avw-rond-cta-btn" href="https://proeflokaalvanwees.nl" target="_blank" rel="noopener">
                Bezoek de website van ons proeflokaal
            </a>
        </div>

    </div>
</div>

<?php get_footer(); ?>
