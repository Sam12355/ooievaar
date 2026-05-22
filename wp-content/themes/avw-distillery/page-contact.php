<?php
/**
 * Template Name: Contact
 *
 * @package avw-distillery
 */

get_header();
?>

<style>
/* ============================================================
   CONTACT PAGE
   ============================================================ */
.avw-con-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-con-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 40%; opacity: 0.45;
}
.avw-con-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-con-hero-content {
    position: relative; z-index: 10;
    max-width: 900px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-con-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-con-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-con-breadcrumb a:hover { color: #fff; }
.avw-con-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(42px, 7vw, 80px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.05; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* ---- Body ---- */
.avw-con-body {
    width: 80%; max-width: 1400px; margin: 0 auto; padding: 72px 0 100px;
}

.avw-con-layout {
    display: grid; grid-template-columns: 1fr 1.4fr; gap: 40px; align-items: start;
}

/* ---- Info card ---- */
.avw-con-info-card {
    background: #fff; border-radius: 24px;
    box-shadow: 0 4px 40px rgba(54,34,29,0.08); border: 1px solid rgba(54,34,29,0.06);
    padding: 44px 44px;
}
.avw-con-info-notice {
    font-family: 'DM Sans', sans-serif; font-size: 14px; line-height: 1.7;
    color: rgba(54,34,29,0.65); margin-bottom: 28px;
    padding: 14px 18px; background: #fdf8f1; border-radius: 12px;
    border-left: 3px solid rgba(67,43,37,0.25);
}
.avw-con-info-block { margin-bottom: 28px; }
.avw-con-info-block:last-child { margin-bottom: 0; }
.avw-con-info-label {
    font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.14em; color: rgba(54,34,29,0.45);
    margin-bottom: 8px;
}
.avw-con-info-value {
    font-family: 'DM Sans', sans-serif; font-size: 15px; color: #36221d; line-height: 1.75;
}
.avw-con-info-value a { color: #432B25; text-decoration: none; }
.avw-con-info-value a:hover { text-decoration: underline; }
.avw-con-divider {
    border: none; border-top: 1px solid rgba(54,34,29,0.08); margin: 24px 0;
}

/* ---- Form card ---- */
.avw-con-form-card {
    background: #fff; border-radius: 24px;
    box-shadow: 0 4px 40px rgba(54,34,29,0.08); border: 1px solid rgba(54,34,29,0.06);
    padding: 44px 48px;
}
.avw-con-form-title {
    font-family: 'Kurversbrug', serif; font-size: 22px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.1em; font-weight: normal;
    margin: 0 0 32px;
}
.avw-con-field { display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px; }
.avw-con-field label {
    font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.12em; color: rgba(54,34,29,0.5);
}
.avw-con-field label .req { color: #c62828; margin-left: 2px; }
.avw-con-field input,
.avw-con-field textarea {
    font-family: 'DM Sans', sans-serif; font-size: 14px; color: #36221d;
    border: 1.5px solid rgba(54,34,29,0.15); border-radius: 12px;
    padding: 12px 16px; background: #fdf8f1;
    outline: none; transition: border-color 0.2s; width: 100%; box-sizing: border-box;
}
.avw-con-field input:focus,
.avw-con-field textarea:focus { border-color: #36221d; background: #fff; }
.avw-con-field textarea { resize: vertical; min-height: 140px; }

.avw-con-submit-btn {
    background: linear-gradient(90deg, rgba(0,0,0,0.2), rgba(0,0,0,0.2)), #432B25;
    color: #fff; font-family: 'Kurversbrug', serif; font-size: 17px;
    text-transform: uppercase; letter-spacing: 0.12em;
    padding: 14px 52px; border-radius: 34px; border: none;
    cursor: pointer; transition: opacity 0.2s; margin-top: 8px;
}
.avw-con-submit-btn:hover { opacity: 0.88; }
.avw-con-submit-btn:disabled { opacity: 0.5; cursor: not-allowed; }

.avw-con-msg {
    margin-top: 16px; padding: 14px 18px; border-radius: 12px;
    font-family: 'DM Sans', sans-serif; font-size: 14px; display: none;
}
.avw-con-msg.success { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
.avw-con-msg.error   { background: #ffebee; color: #c62828; border: 1px solid #ef9a9a; }

@media (max-width: 960px) {
    .avw-con-body { width: 92%; }
    .avw-con-layout { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .avw-con-body { width: 100%; padding-left: 16px; padding-right: 16px; }
    .avw-con-info-card, .avw-con-form-card { padding: 28px 24px; }
}
</style>

<!-- HERO -->
<section class="avw-con-hero">
    <img id="con-hero-img" class="avw-con-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="Contact" />
    <div class="avw-con-hero-overlay"></div>
    <div class="avw-con-hero-content">
        <nav class="avw-con-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;">Contact</span>
        </nav>
        <h1 id="con-hero-title" class="avw-con-hero-title">Contact</h1>
    </div>
</section>

<!-- CONTENT -->
<div class="avw-con-body">
    <div class="avw-con-layout">

        <!-- Info -->
        <div class="avw-con-info-card">
            <p class="avw-con-info-notice">
                De telefoonnummers hieronder zijn uitsluitend bedoeld voor vragen over onze producten.
            </p>

            <div class="avw-con-info-block">
                <div class="avw-con-info-label">Telefoon</div>
                <div class="avw-con-info-value">
                    <a href="tel:+31206267753">020-6267753</a> of <a href="tel:+31206264702">020-6264702</a>
                </div>
            </div>

            <hr class="avw-con-divider" />

            <div class="avw-con-info-block">
                <div class="avw-con-info-label">Adres</div>
                <div class="avw-con-info-value">
                    Slijterij de Ooievaar<br>
                    Driehoekstraat 10<br>
                    1015 GL Amsterdam
                </div>
            </div>

            <hr class="avw-con-divider" />

            <div class="avw-con-info-block">
                <div class="avw-con-info-label">Openingstijden</div>
                <div class="avw-con-info-value">
                    Maandag t/m vrijdag: 13.00 – 17.00 uur<br>
                    Gesloten in het weekend.
                </div>
            </div>

            <hr class="avw-con-divider" />

            <div class="avw-con-info-block">
                <div class="avw-con-info-label">KvK-nummer</div>
                <div class="avw-con-info-value">33112761</div>
            </div>

            <div class="avw-con-info-block">
                <div class="avw-con-info-label">BTW-nummer</div>
                <div class="avw-con-info-value">NL0014 15 694 B.01.9110</div>
            </div>
        </div>

        <!-- Form -->
        <div class="avw-con-form-card">
            <h2 class="avw-con-form-title">Stuur ons een bericht</h2>
            <form id="avw-contact-form" novalidate>
                <?php wp_nonce_field( 'avw_contact_nonce', 'avw_contact_nonce_field' ); ?>

                <div class="avw-con-field">
                    <label for="con-email">E-mail <span class="req">*</span></label>
                    <input type="email" id="con-email" name="email" placeholder="jouw@email.nl" required />
                </div>
                <div class="avw-con-field">
                    <label for="con-name">Naam <span class="req">*</span></label>
                    <input type="text" id="con-name" name="name" placeholder="Jouw naam" required />
                </div>
                <div class="avw-con-field">
                    <label for="con-subject">Onderwerp</label>
                    <input type="text" id="con-subject" name="subject" placeholder="Waar gaat je vraag over?" />
                </div>
                <div class="avw-con-field">
                    <label for="con-message">Bericht <span class="req">*</span></label>
                    <textarea id="con-message" name="message" placeholder="Je bericht…" required></textarea>
                </div>

                <button type="submit" class="avw-con-submit-btn">Versturen</button>
                <div id="avw-con-msg" class="avw-con-msg"></div>
            </form>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.fromTo('#con-hero-img',
            { yPercent: -15 },
            { yPercent: 15, ease: 'none',
              scrollTrigger: { trigger: '#con-hero-title', start: 'top bottom', end: 'bottom top', scrub: true } }
        );
    }

    var form = document.getElementById('avw-contact-form');
    var msg  = document.getElementById('avw-con-msg');
    var btn  = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        var email   = form.querySelector('#con-email').value.trim();
        var name    = form.querySelector('#con-name').value.trim();
        var message = form.querySelector('#con-message').value.trim();

        if (!email || !name || !message) {
            msg.className = 'avw-con-msg error';
            msg.textContent = 'Vul alle verplichte velden in.';
            msg.style.display = 'block';
            return;
        }

        btn.disabled = true;
        btn.textContent = 'Versturen…';

        var data = new FormData();
        data.append('action',  'avw_contact_submit');
        data.append('nonce',   form.querySelector('#avw_contact_nonce_field').value);
        data.append('email',   email);
        data.append('name',    name);
        data.append('subject', form.querySelector('#con-subject').value.trim());
        data.append('message', message);

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: data })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                msg.style.display = 'block';
                if (res.success) {
                    msg.className = 'avw-con-msg success';
                    msg.textContent = res.data;
                    form.reset();
                } else {
                    msg.className = 'avw-con-msg error';
                    msg.textContent = res.data;
                }
                btn.disabled = false;
                btn.textContent = 'Versturen';
            })
            .catch(function() {
                msg.className = 'avw-con-msg error';
                msg.textContent = 'Er ging iets mis. Probeer het opnieuw.';
                msg.style.display = 'block';
                btn.disabled = false;
                btn.textContent = 'Versturen';
            });
    });
});
</script>

<?php get_footer(); ?>
