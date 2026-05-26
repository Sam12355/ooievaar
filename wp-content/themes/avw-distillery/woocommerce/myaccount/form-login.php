<?php
/**
 * Custom Auth Template — De Ooievaar Distillery
 *
 * @package WooCommerce\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_customer_login_form' );
?>

<style>
/* Break out of page.php wrapper padding for auth page */
body.woocommerce-account:not(.logged-in) .avw-page-wrap {
    padding-left: 0 !important;
    padding-right: 0 !important;
    max-width: 100% !important;
}

/* ── Layout ── */
.avw-auth {
    display: grid;
    grid-template-columns: 380px 1fr;
    min-height: 75vh;
}

/* ── Brand panel ── */
.avw-auth-brand {
    background: #36221d;
    padding: 64px 48px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.avw-auth-brand-eyebrow {
    font-family: 'Kurversbrug', serif;
    font-size: 11px;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: rgba(238,223,203,0.4);
}
.avw-auth-brand-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(2rem, 3.5vw, 2.8rem);
    font-weight: 300;
    color: #eedfcb;
    line-height: 1.15;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin: 48px 0 20px;
}
.avw-auth-brand-sub {
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    color: rgba(238,223,203,0.5);
    line-height: 1.75;
}
.avw-auth-brand-foot {
    font-family: 'Kurversbrug', serif;
    font-size: 10px;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: rgba(238,223,203,0.25);
}

/* ── Form panel ── */
.avw-auth-form {
    background: #fff;
    padding: 64px 56px;
    display: flex;
    align-items: flex-start;
    justify-content: center;
}
.avw-auth-inner {
    width: 100%;
    max-width: 440px;
}

/* ── Tabs ── */
.avw-auth-tabs {
    display: flex;
    border-bottom: 1.5px solid rgba(54,34,29,0.1);
    margin-bottom: 40px;
}
.avw-auth-tab {
    flex: 1;
    background: none;
    border: none;
    padding: 14px 12px;
    font-family: 'Kurversbrug', serif;
    font-size: 13px;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: rgba(54,34,29,0.3);
    cursor: pointer;
    position: relative;
    transition: color 0.2s;
}
.avw-auth-tab::after {
    content: '';
    position: absolute;
    bottom: -1.5px;
    left: 0; right: 0;
    height: 2px;
    background: #36221d;
    transform: scaleX(0);
    transition: transform 0.25s ease;
}
.avw-auth-tab.active { color: #36221d; }
.avw-auth-tab.active::after { transform: scaleX(1); }

/* ── Panels ── */
.avw-auth-panel { display: none; }
.avw-auth-panel.active { display: block; }

/* ── Fields ── */
.avw-auth-field {
    margin-bottom: 18px;
    display: flex;
    flex-direction: column;
}
.avw-auth-label {
    font-family: 'DM Sans', sans-serif;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: rgba(54,34,29,0.45);
    margin-bottom: 7px;
}
.avw-auth-label .required { color: rgba(54,34,29,0.3); }
.avw-auth-input {
    padding: 14px 18px !important;
    border: 1.5px solid rgba(54,34,29,0.12) !important;
    border-radius: 10px !important;
    font-size: 15px !important;
    color: #36221d !important;
    background: #fafaf8 !important;
    transition: border-color 0.2s, box-shadow 0.2s !important;
    width: 100% !important;
    font-family: 'DM Sans', sans-serif !important;
    outline: none !important;
    box-sizing: border-box !important;
    appearance: none !important;
    -webkit-appearance: none !important;
}
.avw-auth-input:focus {
    border-color: #36221d !important;
    background: #fff !important;
    box-shadow: 0 0 0 3px rgba(54,34,29,0.07) !important;
}

/* ── Meta row ── */
.avw-auth-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 8px;
}
.avw-auth-remember {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    font-family: 'DM Sans', sans-serif !important;
    font-size: 13px !important;
    color: rgba(54,34,29,0.5) !important;
    cursor: pointer !important;
}
.avw-auth-remember input[type="checkbox"] {
    width: 15px !important;
    height: 15px !important;
    margin: 0 !important;
    accent-color: #36221d !important;
    flex-shrink: 0 !important;
}
.avw-auth-forgot {
    font-family: 'DM Sans', sans-serif;
    font-size: 12px;
    color: rgba(54,34,29,0.35);
    text-decoration: none;
    transition: color 0.2s;
}
.avw-auth-forgot:hover { color: #36221d; }

/* ── Submit button ── */
.avw-auth-btn {
    display: block !important;
    width: 100% !important;
    padding: 16px 24px !important;
    background: #36221d !important;
    color: #eedfcb !important;
    border: none !important;
    border-radius: 9999px !important;
    font-family: 'Kurversbrug', serif !important;
    font-size: 14px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.2em !important;
    cursor: pointer !important;
    transition: background 0.25s, transform 0.2s !important;
    text-align: center !important;
}
.avw-auth-btn:hover {
    background: #1e1108 !important;
    color: #fff !important;
    transform: translateY(-1px) !important;
}

/* ── Wholesale link ── */
.avw-auth-wholesale {
    display: block;
    margin-top: 20px;
    text-align: center;
    padding: 12px 20px;
    border-radius: 9999px;
    border: 1.5px solid rgba(205,188,166,0.6);
    font-family: 'DM Sans', sans-serif;
    font-size: 12px;
    font-weight: 600;
    color: #9c7d50;
    text-decoration: none;
    letter-spacing: 0.05em;
    transition: all 0.2s;
}
.avw-auth-wholesale:hover {
    border-color: #cdbca6;
    background: rgba(205,188,166,0.08);
}

/* ── WC notices ── */
.avw-auth .woocommerce-error,
.avw-auth .woocommerce-message,
.avw-auth .woocommerce-info {
    border-radius: 10px !important;
    font-size: 13px !important;
    padding: 12px 16px !important;
    margin-bottom: 20px !important;
    border-left: 3px solid !important;
    list-style: none !important;
    font-family: 'DM Sans', sans-serif !important;
}
.avw-auth .woocommerce-error   { background: rgba(220,38,38,0.04) !important; border-color: #dc2626 !important; color: #991b1b !important; }
.avw-auth .woocommerce-message { background: rgba(54,34,29,0.04) !important; border-color: #36221d !important; color: #36221d !important; }

/* ── Responsive ── */
@media (max-width: 900px) {
    .avw-auth { grid-template-columns: 1fr; }
    .avw-auth-brand { display: none; }
    .avw-auth-form { padding: 48px 32px; }
    .avw-auth-inner { max-width: 100%; }
}
@media (max-width: 480px) {
    .avw-auth-form { padding: 36px 20px; }
    .avw-auth-tabs { margin-bottom: 28px; }
}
</style>

<div class="avw-auth">

    <!-- Brand panel (desktop only) -->
    <div class="avw-auth-brand">
        <div class="avw-auth-brand-eyebrow">A. van Wees · De Ooievaar</div>
        <div>
            <div class="avw-auth-brand-title">Uw<br>Account</div>
            <p class="avw-auth-brand-sub">Welkom terug. Log in om uw bestellingen te bekijken, uw gegevens te beheren en meer te ontdekken.</p>
        </div>
        <div class="avw-auth-brand-foot">Distilleerderij · Jordaan · Amsterdam · Est. 1782</div>
    </div>

    <!-- Form panel -->
    <div class="avw-auth-form">
        <div class="avw-auth-inner">

            <?php wc_print_notices(); ?>

            <!-- Tabs -->
            <div class="avw-auth-tabs">
                <button class="avw-auth-tab active" data-panel="login"><?php esc_html_e( 'Sign In', 'woocommerce' ); ?></button>
                <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
                <button class="avw-auth-tab" data-panel="register"><?php esc_html_e( 'Create Account', 'woocommerce' ); ?></button>
                <?php endif; ?>
            </div>

            <!-- Login panel -->
            <div class="avw-auth-panel active" id="avw-p-login">
                <form class="woocommerce-form woocommerce-form-login login" method="post">
                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <div class="avw-auth-field">
                        <label class="avw-auth-label" for="username">
                            <?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span>
                        </label>
                        <input type="text" class="avw-auth-input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username"
                               value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
                    </div>

                    <div class="avw-auth-field">
                        <label class="avw-auth-label" for="password">
                            <?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span>
                        </label>
                        <input type="password" class="avw-auth-input woocommerce-Input--password input-text" name="password" id="password" autocomplete="current-password" />
                    </div>

                    <?php do_action( 'woocommerce_login_form' ); ?>

                    <div class="avw-auth-meta">
                        <label class="avw-auth-remember woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                            <input class="woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                            <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                        </label>
                        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="avw-auth-forgot">
                            <?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?>
                        </a>
                    </div>

                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                    <input type="hidden" name="redirect" value="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" />

                    <button type="submit" class="avw-auth-btn woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                        <?php esc_html_e( 'Sign In', 'woocommerce' ); ?>
                    </button>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>
                </form>

                <a href="<?php echo esc_url( home_url( '/en/business-registration/' ) ); ?>" class="avw-auth-wholesale">
                    <?php esc_html_e( 'Are you a wholesale customer? Click here.', 'woocommerce' ); ?>
                </a>
            </div>

            <!-- Register panel -->
            <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
            <div class="avw-auth-panel" id="avw-p-register">
                <form method="post" class="woocommerce-form woocommerce-form-register register">
                    <?php do_action( 'woocommerce_register_form_start' ); ?>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                    <div class="avw-auth-field">
                        <label class="avw-auth-label" for="reg_username">
                            <?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span>
                        </label>
                        <input type="text" class="avw-auth-input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username"
                               value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
                    </div>
                    <?php endif; ?>

                    <div class="avw-auth-field">
                        <label class="avw-auth-label" for="reg_email">
                            <?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span>
                        </label>
                        <input type="email" class="avw-auth-input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email"
                               value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
                    </div>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                    <div class="avw-auth-field">
                        <label class="avw-auth-label" for="reg_password">
                            <?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span>
                        </label>
                        <input type="password" class="avw-auth-input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                    </div>
                    <?php else : ?>
                    <p style="font-size:13px; color:rgba(54,34,29,0.45); margin-bottom:24px; font-family:'DM Sans',sans-serif; line-height:1.6;">
                        <?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?>
                    </p>
                    <?php endif; ?>

                    <?php do_action( 'woocommerce_register_form' ); ?>
                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>

                    <button type="submit" class="avw-auth-btn woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
                        <?php esc_html_e( 'Create Account', 'woocommerce' ); ?>
                    </button>

                    <?php do_action( 'woocommerce_register_form_end' ); ?>
                </form>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
(function () {
    var tabs   = document.querySelectorAll('.avw-auth-tab');
    var panels = document.querySelectorAll('.avw-auth-panel');

    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            panels.forEach(function (p) { p.classList.remove('active'); });
            btn.classList.add('active');
            var panel = document.getElementById('avw-p-' + btn.dataset.panel);
            if (panel) panel.classList.add('active');
        });
    });

    if (document.querySelector('.woocommerce-error') && document.getElementById('avw-p-register')) {
        var regBtn = document.querySelector('[data-panel="register"]');
        if (regBtn) regBtn.click();
    }
})();
</script>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
