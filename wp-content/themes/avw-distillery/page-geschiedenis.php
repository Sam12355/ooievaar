<?php
/**
 * Template Name: Geschiedenis
 * Slug: geschiedenis
 *
 * @package avw-distillery
 */

get_header();
?>

<style>
/* ============================================================
   GESCHIEDENIS PAGE
   ============================================================ */
.avw-gesch-hero {
    width: 100vw;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    background: #36221d;
    overflow: hidden;
    padding-top: 96px;
    padding-bottom: 56px;
}

.avw-gesch-hero-img {
    position: absolute;
    top: -30%;
    left: 0;
    width: 100%;
    height: 160%;
    object-fit: cover;
    object-position: center 30%;
    opacity: 0.45;
}

.avw-gesch-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}

.avw-gesch-hero-content {
    position: relative;
    z-index: 10;
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
    padding: 0 24px;
}

.avw-gesch-breadcrumb {
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: rgba(238,223,203,0.7);
    margin-bottom: 20px;
}

.avw-gesch-breadcrumb a {
    color: rgba(238,223,203,0.7);
    text-decoration: none;
    transition: color 0.2s;
}

.avw-gesch-breadcrumb a:hover {
    color: #fff;
}

.avw-gesch-hero-title {
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

/* ---- Content ---- */
.avw-gesch-body {
    max-width: 900px;
    margin: 0 auto;
    padding: 72px 24px 100px;
}

.avw-gesch-photo {
    width: 100%;
    border-radius: 24px;
    overflow: hidden;
    margin-bottom: 56px;
    box-shadow: 0 20px 60px rgba(54,34,29,0.15);
}

.avw-gesch-photo img {
    width: 100%;
    height: 480px;
    object-fit: cover;
    object-position: center 30%;
    display: block;
}

.avw-gesch-text {
    font-family: 'DM Sans', sans-serif;
    color: #36221d;
}

.avw-gesch-text p {
    font-size: 17px;
    line-height: 1.85;
    margin-bottom: 28px;
    color: rgba(54,34,29,0.85);
}

.avw-gesch-text p:last-child {
    margin-bottom: 0;
}

.avw-gesch-pull {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(20px, 3vw, 28px);
    color: #36221d;
    line-height: 1.4;
    border-left: 4px solid #432B25;
    padding-left: 28px;
    margin: 48px 0;
    font-weight: normal;
}
</style>

<!-- HERO -->
<section class="avw-gesch-hero">
    <img id="gesch-hero-img" class="avw-gesch-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/geschiedenis-hero.jpg" alt="A. van Wees Distilleerderij De Ooievaar" />
    <div class="avw-gesch-hero-overlay"></div>
    <div class="avw-gesch-hero-content">
        <nav class="avw-gesch-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;">Geschiedenis</span>
        </nav>
        <h1 id="gesch-hero-title" class="avw-gesch-hero-title">Geschiedenis</h1>
    </div>
</section>

<!-- CONTENT -->
<div class="avw-gesch-body">

    <div class="avw-gesch-photo">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/geschiedenis-hero.jpg" alt="Het team van A. van Wees Distilleerderij De Ooievaar" />
    </div>

    <div class="avw-gesch-text">

        <blockquote class="avw-gesch-pull">
            Ambachtelijk distilleren sinds 1782 — een erfgoed dat generaties lang bewaard is gebleven.
        </blockquote>

        <p>'A.van Wees distilleerderij de Ooievaar' stamt uit 1782. Adriaan van Wees, neemt in 1922 distilleerderij en wijnkoperij Henri Matveld anno 1883 over. Hij vestigt zich in de Driehoekstraat. Tot 1970 leverden wij onze producten in vaten en mandflessen aan cafés en restaurants door heel Nederland. Eind jaren zeventig kiest Cees van Wees voor de corebusiness: ambachtelijk distilleren. Hij stoot alle andere activiteiten af. Kleindochter Fenny van Wees heeft het stokje overgenomen. Achterkleindochter Nikki leert inmiddels ook het ambacht.</p>

        <p>De reputatie van onze distilleerderij is gebaseerd op het verleden. Deze oorsprong, onze betrokkenheid bij de producten en extreme interesse in ons vak, houdt ons verre van massaproductie. Niet voor niets is ons ambacht fijndistillatie op de Nationale Inventaris Immaterieel Erfgoed geplaatst. Als hoeder van dit ooit zo befaamde Nederlands vakmanschap hebben wij ons verplicht het ambacht in stand te houden en uit te dragen.</p>

        <p>Maar weinig mensen weten dat Nederland toonaangevend is geweest op het gebied van gedistilleerd. Nederlanders beheersten als eersten de kunst om uitstekende gedistilleerde producten te maken van landbouwproducten. Hun distilleertechnieken werden wereldwijd overgenomen.</p>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.fromTo('#gesch-hero-img',
            { yPercent: -15 },
            {
                yPercent: 15,
                ease: 'none',
                scrollTrigger: {
                    trigger: '#gesch-hero-title',
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
