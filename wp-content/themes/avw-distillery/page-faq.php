<?php
/**
 * Template Name: FAQ
 *
 * @package avw-distillery
 */

get_header();
?>

<style>
/* ============================================================
   FAQ PAGE
   ============================================================ */

/* ── Hero ── */
.avw-faq-hero {
    background: #36221d;
    padding: 80px 24px 64px;
    text-align: center;
}
.avw-faq-hero-eyebrow {
    font-family: 'Kurversbrug', serif;
    font-size: 11px;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: rgba(238,223,203,0.45);
    margin-bottom: 20px;
}
.avw-faq-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(2.2rem, 6vw, 4rem);
    font-weight: 300;
    color: #eedfcb;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    line-height: 1.1;
    margin: 0 0 20px;
}
.avw-faq-hero-sub {
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    color: rgba(238,223,203,0.5);
    max-width: 480px;
    margin: 0 auto;
    line-height: 1.7;
}

/* ── Body ── */
.avw-faq-body {
    background: #e0cbb0;
    padding: 72px 24px 96px;
}
.avw-faq-wrap {
    max-width: 760px;
    margin: 0 auto;
}

/* ── Accordion ── */
.avw-faq-item {
    background: #fff;
    border-radius: 16px;
    margin-bottom: 12px;
    overflow: hidden;
    box-shadow: 0 2px 16px rgba(54,34,29,0.06);
    transition: box-shadow 0.2s;
}
.avw-faq-item.open {
    box-shadow: 0 4px 28px rgba(54,34,29,0.12);
}

.avw-faq-q {
    width: 100%;
    background: none;
    border: none;
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    cursor: pointer;
    text-align: left;
    transition: background 0.2s;
}
.avw-faq-q:hover { background: rgba(54,34,29,0.02); }

.avw-faq-q-text {
    font-family: 'Kurversbrug', serif;
    font-size: 16px;
    font-weight: 400;
    color: #36221d;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    line-height: 1.35;
}
.avw-faq-icon {
    flex-shrink: 0;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #eedfcb;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s, transform 0.3s;
}
.avw-faq-item.open .avw-faq-icon {
    background: #36221d;
    transform: rotate(45deg);
}
.avw-faq-icon svg { display: block; }
.avw-faq-item.open .avw-faq-icon svg { stroke: #eedfcb; }

.avw-faq-a {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.38s ease;
}
.avw-faq-a-inner {
    padding: 0 28px 28px;
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    color: rgba(54,34,29,0.75);
    line-height: 1.8;
    border-top: 1px solid rgba(54,34,29,0.06);
    padding-top: 20px;
}
.avw-faq-a-inner p { margin: 0 0 14px; }
.avw-faq-a-inner p:last-child { margin-bottom: 0; }
.avw-faq-a-inner strong { color: #36221d; font-weight: 600; }
.avw-faq-a-inner .avw-notice {
    margin-top: 16px;
    padding: 12px 16px;
    background: rgba(54,34,29,0.05);
    border-left: 3px solid #36221d;
    border-radius: 0 8px 8px 0;
    font-size: 13px;
    color: rgba(54,34,29,0.7);
}

/* ── Responsive ── */
@media (max-width: 600px) {
    .avw-faq-hero { padding: 60px 20px 48px; }
    .avw-faq-body { padding: 48px 16px 72px; }
    .avw-faq-q { padding: 20px 20px; }
    .avw-faq-q-text { font-size: 14px; }
    .avw-faq-a-inner { padding: 0 20px 24px; padding-top: 16px; }
}
</style>

<!-- Hero -->
<?php
$googtrans = isset($_COOKIE['googtrans']) ? $_COOKIE['googtrans'] : '';
$is_en = ( strpos( $_SERVER['REQUEST_URI'], '/en/' ) !== false ) || ( strpos( $googtrans, '/en' ) !== false );
?>
<div class="avw-faq-hero">
    <p class="avw-faq-hero-eyebrow"><?php echo $is_en ? 'Help &amp; Information' : 'Hulp &amp; Informatie'; ?></p>
    <h1 class="avw-faq-hero-title"><?php echo $is_en ? 'Frequently Asked<br>Questions' : 'Veelgestelde<br>Vragen'; ?></h1>
    <?php
    echo '<p class="avw-faq-hero-sub">' . ( $is_en
        ? 'Do you have a question about ordering, delivery or pick-up? Find your answers here.'
        : 'Heeft u een vraag over bestellen, bezorgen of afhalen? Hier vindt u de antwoorden.'
    ) . '</p>';
    ?>
</div>

<!-- Accordion body -->
<div class="avw-faq-body">
    <div class="avw-faq-wrap">

        <?php
        $googtrans = isset($_COOKIE['googtrans']) ? $_COOKIE['googtrans'] : '';
        $is_en = ( strpos( $_SERVER['REQUEST_URI'], '/en/' ) !== false ) || ( strpos( $googtrans, '/en' ) !== false );

        if ( $is_en ) :
        $faqs = array(
            array(
                'q' => 'Where and when can I pick up my order?',
                'a' => '<p>You can pick up your order at our shop at <strong>Driehoekstraat 10</strong>, Amsterdam. Open Monday to Friday from <strong>13:00 to 17:00</strong> (weekends closed).</p>
                        <p>NB: If you have not yet received a pick-up notification from us, please call ahead to check whether the product is in stock — otherwise you may have made the trip for nothing!</p>
                        <div class="avw-notice"><strong>PLEASE NOTE:</strong> Until Monday 15 August we have limited availability and pick-up is not possible. Your order will not be dispatched until after 15 August.</div>',
            ),
            array(
                'q' => 'Which payment methods does Slijterij de Ooievaar accept?',
                'a' => '<p>When purchasing on our website you can pay with <strong>iDEAL</strong> or by <strong>bank transfer</strong>. Once payment has been confirmed, your order will be dispatched.</p>
                        <p>Please make sure to only close the iDEAL window after clicking <em>close</em>, otherwise your order will not be registered as placed.</p>
                        <p>If paying from abroad, we accept payments via <strong>SWIFT, Credit card, Bancontact</strong> and <strong>Sofort Banking</strong>.</p>',
            ),
            array(
                'q' => 'Pick up or delivery?',
                'a' => '<p>It\'s great that you can order our products through the webshop and have them delivered. But what could be nicer than strolling through the Jordaan and picking up your parcel at our shop on the beautiful Driehoekstraat? It saves on delivery costs and we both contribute to a smaller footprint.</p>
                        <p>With a bit of luck you can even watch us work through the windows! You can\'t get any closer — unless you book a distillery tour, of course.</p>
                        <p>If you choose pick-up, we will send you a confirmation once the bottles are ready. Due to staff shortages we operate adjusted opening hours:</p>
                        <p><strong>Open:</strong> Monday to Friday 13:00 – 17:00.<br><strong>Closed:</strong> Saturday and Sunday.</p>',
            ),
            array(
                'q' => 'Delivery and ID verification?',
                'a' => '<p>From 1 July 2021, the new alcohol legislation is in effect. This means that upon delivery of your parcel, the <strong>PostNL</strong> courier will ask for your ID to confirm the parcel is intended for you.</p>
                        <p><strong>We do not deliver to persons under the age of 18!</strong></p>',
            ),
            array(
                'q' => 'What are the shipping costs?',
                'a' => '<p>If you cannot visit the shop, shipping is your only option. You can still reduce your footprint by ordering multiple bottles per shipment — it lowers your proportional shipping costs.</p>
                        <ul style="margin:12px 0 12px 20px; line-height:1.9; color:rgba(54,34,29,0.75);">
                            <li>Orders <strong>from € 50.00</strong> → reduced shipping costs</li>
                            <li>Orders <strong>from € 150.00</strong> → free shipping</li>
                        </ul>
                        <p>Shipping costs are calculated automatically at checkout. Our products do not fit through letterboxes and require a signature upon delivery. You will see the costs appear directly when filling your basket.</p>',
            ),
            array(
                'q' => 'When will my order be shipped?',
                'a' => '<p>If you order <strong>before 10:00</strong> on a working day and pay by iDEAL, we aim to dispatch your order the same working day. For orders placed after 10:00, we aim to dispatch the following working day.</p>
                        <p>Unfortunately our post office is no longer just around the corner, so we cannot always guarantee same or next-day dispatch. We aim for this, but due to our small team and high demand it sometimes isn\'t possible.</p>
                        <p>NB: If you need the parcel by a specific date, please mention this in the <strong>comments field</strong> — otherwise we will assume the shipment is not urgent.</p>
                        <div class="avw-notice"><strong>PLEASE NOTE:</strong> From Friday 21 July until Monday 15 August 2023 we will not be dispatching parcels due to limited availability. An order placed after 21 July at 17:00 will only be dispatched from 15 August onwards.</div>',
            ),
        );
        else :
        $faqs = array(
            array(
                'q' => 'Waar en wanneer kan ik mijn bestelling afhalen?',
                'a' => '<p>U kunt uw bestelling afhalen in de winkel op <strong>Driehoekstraat nummer 10</strong>, te Amsterdam. Geopend van maandag tot en met vrijdag van <strong>13.00 tot 17.00 uur</strong> (weekend gesloten).</p>
                        <p>NB: Als u nog geen afhaalbericht van ons heeft ontvangen verzoeken wij u voor het afhalen in de winkel even te bellen of het product voorradig is. Anders komt u misschien voor niks…!</p>
                        <div class="avw-notice"><strong>LET OP:</strong> Tot maandag 15 augustus zijn wij beperkt aanwezig en kan er niet worden afgehaald. Uw bestelling wordt tot die tijd pas verzonden na 15 augustus.</div>',
            ),
            array(
                'q' => 'Welke betalingsmethodes accepteert Slijterij de Ooievaar?',
                'a' => '<p>Tijdens het kopen op onze website kan met <strong>iDEAL</strong> worden afgerekend, of via een <strong>overschrijving</strong>. Zodra de betaling bij ons is gemeld, wordt uw bestelling verstuurd.</p>
                        <p>Let u er a.u.b. op dat u het iDEAL-venster pas afsluit nadat u op <em>afsluiten</em> heeft geklikt, anders wordt uw bestelling niet als besteld doorgegeven.</p>
                        <p>Betaalt u vanuit het buitenland, dan accepteren wij betalingen via <strong>SWIFT, Creditcard, Bancontact</strong> en <strong>Sofort Banking</strong>.</p>',
            ),
            array(
                'q' => 'Afhalen of verzenden?',
                'a' => '<p>Het is fijn dat je onze producten via de webwinkel kunt bestellen en laten bezorgen. Maar wat is er nou leuker dan door de Jordaan slenteren en tegelijk even je pakje ophalen bij onze slijterij in de prachtige Driehoekstraat? Het scheelt je bezorgkosten en tegelijkertijd dragen we allebei bij aan een kleinere footprint.</p>
                        <p>Met een beetje mazzel kun je ons ook nog door de ramen heen aan het werk zien! Dichterbij kun je niet komen — tenzij je een rondleiding reserveert natuurlijk.</p>
                        <p>Als je kiest voor afhalen, sturen wij je een bevestiging zodra de flessen klaar staan. In verband met personeelstekorten hanteren wij gewijzigde openingstijden:</p>
                        <p><strong>Open:</strong> maandag t/m vrijdag van 13.00 – 17.00 uur.<br><strong>Gesloten:</strong> zaterdag en zondag.</p>',
            ),
            array(
                'q' => 'Bezorgen en legitimatie?',
                'a' => '<p>Vanaf 1 juli 2021 is de nieuwe alcoholwet van kracht. Dit betekent dat bij aflevering van uw pakket de bezorger van <strong>PostNL</strong> om uw legitimatie vraagt, opdat zeker is dat het pakket voor u bestemd is.</p>
                        <p><strong>Wij leveren niet aan personen onder de 18 jaar!</strong></p>',
            ),
            array(
                'q' => 'Wat zijn de verzendkosten?',
                'a' => '<p>Als je niet naar de slijterij kunt komen is verzending je enige optie. Ook dan kun je je footprint verkleinen door meerdere flessen per zending te bestellen — je verlaagt er je percentuele portokosten mee.</p>
                        <ul style="margin:12px 0 12px 20px; line-height:1.9; color:rgba(54,34,29,0.75);">
                            <li>Aankopen <strong>vanaf € 50,00</strong> → verlaagde verzendkosten</li>
                            <li>Aankopen <strong>vanaf € 150,00</strong> → gratis verzending</li>
                        </ul>
                        <p>Verzendkosten worden automatisch berekend bij het afrekenen. Onze producten passen niet door de brievenbus en zijn een belstuk. Bij het vullen van uw winkelmandje ziet u de kosten direct verschijnen.</p>',
            ),
            array(
                'q' => 'Wanneer wordt mijn bestelling verzonden?',
                'a' => '<p>Indien u <strong>voor 10.00 uur</strong> op een werkdag bestelt en per iDEAL betaalt, proberen wij de bestelling nog dezelfde werkdag te verzenden. Bij een bestelling na 10.00 uur proberen wij deze de volgende werkdag de deur uit te doen.</p>
                        <p>Helaas is ons postkantoor niet meer om de hoek, waardoor wij niet altijd in staat zijn te garanderen dat uw pakketje dezelfde of volgende dag de deur uitgaat. Het is ons streven, maar in verband met de kleine personele bezetting en de drukte, lukt het ook wel eens niet!</p>
                        <p>NB: Indien u het pakketje voor een bepaalde datum nodig heeft, verzoeken wij u dit bij het vakje <strong>opmerkingen</strong> te vermelden, anders gaan wij er van uit dat de zending geen haast heeft.</p>
                        <div class="avw-notice"><strong>LET OP:</strong> Vanaf vrijdag 21 juli tot en met maandag 15 augustus 2023 sturen wij in verband met onze beperkte aanwezigheid geen pakketten. Een pakket dat u na 21 juli 17.00 uur bestelt wordt pas vanaf 15 augustus verzonden.</div>',
            ),
        );
        endif;
        ?>

        <?php foreach ( $faqs as $i => $faq ) : ?>
        <div class="avw-faq-item" id="faq-<?php echo $i; ?>">
            <button class="avw-faq-q" aria-expanded="false" aria-controls="faq-a-<?php echo $i; ?>">
                <span class="avw-faq-q-text"><?php echo esc_html( $faq['q'] ); ?></span>
                <span class="avw-faq-icon" aria-hidden="true">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="#36221d" stroke-width="2" stroke-linecap="round">
                        <line x1="7" y1="1" x2="7" y2="13"/>
                        <line x1="1" y1="7" x2="13" y2="7"/>
                    </svg>
                </span>
            </button>
            <div class="avw-faq-a" id="faq-a-<?php echo $i; ?>" role="region">
                <div class="avw-faq-a-inner">
                    <?php echo $faq['a']; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>

<script>
(function () {
    var items = document.querySelectorAll('.avw-faq-item');

    items.forEach(function (item) {
        var btn = item.querySelector('.avw-faq-q');
        var ans = item.querySelector('.avw-faq-a');
        var inner = item.querySelector('.avw-faq-a-inner');

        btn.addEventListener('click', function () {
            var isOpen = item.classList.contains('open');

            /* Close all */
            items.forEach(function (it) {
                it.classList.remove('open');
                it.querySelector('.avw-faq-q').setAttribute('aria-expanded', 'false');
                it.querySelector('.avw-faq-a').style.maxHeight = '0';
            });

            /* Open clicked if it was closed */
            if (!isOpen) {
                item.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
                ans.style.maxHeight = inner.scrollHeight + 32 + 'px';
            }
        });
    });
})();
</script>

<?php get_footer(); ?>
