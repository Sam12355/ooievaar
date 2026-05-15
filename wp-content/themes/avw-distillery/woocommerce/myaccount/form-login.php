<?php
/**
 * Custom Boutique Login/Register Template — De Ooievaar Distillery
 *
 * @package WooCommerce\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_customer_login_form' );
?>

<style>
/* ============================================================
   BOUTIQUE MY ACCOUNT / LOGIN PAGE
   ============================================================ */

.avw-login-page {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 24px 60px;
    font-family: 'DM Sans', sans-serif;
}

.avw-login-wrap {
    width: 100%;
    max-width: 520px;
}

/* ---- Tabs ---- */
.avw-tabs {
    display: flex;
    border-bottom: 2px solid rgba(19,62,35,0.08);
    margin-bottom: 36px;
    gap: 0;
}
.avw-tab-btn {
    flex: 1;
    background: none;
    border: none;
    padding: 16px 12px;
    font-family: 'Kurversbrug', serif;
    font-size: 15px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(19,62,35,0.35);
    cursor: pointer;
    position: relative;
    transition: color 0.2s;
}
.avw-tab-btn::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0; right: 0;
    height: 2px;
    background: #133E23;
    transform: scaleX(0);
    transition: transform 0.25s ease;
}
.avw-tab-btn.active {
    color: #133E23;
}
.avw-tab-btn.active::after {
    transform: scaleX(1);
}
.avw-tab-panel { display: none; }
.avw-tab-panel.active { display: block; }

/* ---- Card ---- */
.avw-login-card {
    background: #fff;
    border-radius: 24px;
    padding: 44px 40px;
    box-shadow: 0 12px 60px rgba(0,0,0,0.06);
    border: 1px solid rgba(19,62,35,0.05);
}

.avw-login-card-title {
    font-family: 'Kurversbrug', serif;
    font-size: 22px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #133E23;
    font-weight: normal;
    margin: 0 0 8px;
}

.avw-login-card-subtitle {
    font-size: 13px;
    color: rgba(19,62,35,0.5);
    margin: 0 0 32px;
    line-height: 1.6;
}

.avw-divider {
    height: 1.5px;
    background: rgba(19,62,35,0.07);
    margin: 0 0 32px;
}

/* ---- Form Fields ---- */
.avw-login-card .form-row {
    margin-bottom: 20px !important;
    display: flex !important;
    flex-direction: column !important;
}

.avw-login-card .form-row label {
    font-size: 11px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    color: rgba(19,62,35,0.5) !important;
    margin-bottom: 8px !important;
    display: block !important;
}

.avw-login-card .form-row input[type="text"],
.avw-login-card .form-row input[type="email"],
.avw-login-card .form-row input[type="password"] {
    padding: 15px 20px !important;
    border: 1.5px solid rgba(19,62,35,0.1) !important;
    border-radius: 12px !important;
    font-size: 15px !important;
    color: #133E23 !important;
    background: #fafafa !important;
    transition: all 0.2s !important;
    width: 100% !important;
    font-family: 'DM Sans', sans-serif !important;
}

.avw-login-card .form-row input:focus {
    border-color: #133E23 !important;
    background: #fff !important;
    outline: none !important;
    box-shadow: 0 0 0 4px rgba(19,62,35,0.06) !important;
}

/* Remember me & Lost password row */
.avw-login-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 10px;
}

.avw-login-card .woocommerce-form-login__rememberme {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    font-size: 13px !important;
    color: rgba(19,62,35,0.6) !important;
    cursor: pointer !important;
}

.avw-login-card .woocommerce-form-login__rememberme input[type="checkbox"] {
    width: 16px !important;
    height: 16px !important;
    margin: 0 !important;
    accent-color: #133E23 !important;
    cursor: pointer !important;
    flex-shrink: 0 !important;
}

.avw-lost-password {
    font-size: 12px !important;
    color: rgba(19,62,35,0.45) !important;
    text-decoration: none !important;
    letter-spacing: 0.04em !important;
    transition: color 0.2s !important;
}
.avw-lost-password:hover { color: #133E23 !important; }

/* ---- Primary Button ---- */
.avw-login-card .button,
.avw-login-card button[type="submit"],
.avw-login-card input[type="submit"] {
    display: block !important;
    width: 100% !important;
    padding: 17px 24px !important;
    background: #133E23 !important;
    color: #cdbca6 !important;
    border: none !important;
    border-radius: 9999px !important;
    font-family: 'Kurversbrug', serif !important;
    font-size: 15px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.2em !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 6px 24px rgba(19,62,35,0.2) !important;
    text-align: center !important;
}
.avw-login-card .button:hover,
.avw-login-card button[type="submit"]:hover,
.avw-login-card input[type="submit"]:hover {
    background: #0a2415 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 10px 32px rgba(19,62,35,0.3) !important;
    color: #fff !important;
}

/* ---- CTA links below forms ---- */
.avw-login-links {
    margin-top: 24px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.avw-login-links a {
    display: block;
    text-align: center;
    padding: 13px 20px;
    border-radius: 9999px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-decoration: none;
    transition: all 0.2s;
    border: 1.5px solid rgba(19,62,35,0.15);
    color: #133E23;
    background: transparent;
}
.avw-login-links a:hover {
    border-color: #133E23;
    background: rgba(19,62,35,0.04);
}
.avw-login-links a.wholesale {
    border-color: rgba(205,188,166,0.5);
    color: #8a6d40;
    background: rgba(205,188,166,0.06);
}
.avw-login-links a.wholesale:hover {
    border-color: #cdbca6;
    background: rgba(205,188,166,0.12);
}

/* ---- WC notices ---- */
.avw-login-page .woocommerce-error,
.avw-login-page .woocommerce-message,
.avw-login-page .woocommerce-info {
    border-radius: 12px !important;
    font-size: 14px !important;
    padding: 14px 18px !important;
    margin-bottom: 20px !important;
    border-left: 3px solid !important;
    list-style: none !important;
}
.avw-login-page .woocommerce-error { background: rgba(220,38,38,0.04) !important; border-color: #dc2626 !important; color: #991b1b !important; }
.avw-login-page .woocommerce-message { background: rgba(19,62,35,0.04) !important; border-color: #133E23 !important; color: #133E23 !important; }

/* ---- Password strength meter ---- */
.avw-login-card #strength_meter_message { font-size: 12px; margin-top: 6px; }

/* Responsive */
@media (max-width: 480px) {
    .avw-login-card { padding: 30px 24px; }
}
</style>

<div class="avw-login-page">
    <div class="avw-login-wrap">
        <div class="avw-login-card">

            <!-- ── TABS ── -->
            <div class="avw-tabs">
                <button class="avw-tab-btn active" data-tab="login"><?php esc_html_e( 'Sign In', 'woocommerce' ); ?></button>
                <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
                <button class="avw-tab-btn" data-tab="register"><?php esc_html_e( 'Create Account', 'woocommerce' ); ?></button>
                <?php endif; ?>
            </div>

            <!-- ── LOGIN PANEL ── -->
            <div class="avw-tab-panel active" id="avw-panel-login">
                <p class="avw-login-card-subtitle"><?php esc_html_e( 'Welcome back. Sign in to your account.', 'woocommerce' ); ?></p>

                <form class="woocommerce-form woocommerce-form-login login" method="post">
                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <div class="form-row form-row-wide">
                        <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
                    </div>

                    <div class="form-row form-row-wide">
                        <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input class="woocommerce-Input woocommerce-Input--password input-text" type="password" name="password" id="password" autocomplete="current-password" />
                    </div>

                    <?php do_action( 'woocommerce_login_form' ); ?>

                    <div class="avw-login-meta">
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                            <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                        </label>
                        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="avw-lost-password"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
                    </div>

                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                    <input type="hidden" name="redirect" value="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" />

                    <button type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                        <?php esc_html_e( 'Sign In', 'woocommerce' ); ?>
                    </button>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>
                </form>

                <div class="avw-login-links">
                    <a href="<?php echo esc_url( home_url( '/en/business-registration/' ) ); ?>" class="wholesale">
                        <?php esc_html_e( 'Are you a wholesale customer? Click here.', 'woocommerce' ); ?>
                    </a>
                </div>
            </div>

            <!-- ── REGISTER PANEL ── -->
            <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
            <div class="avw-tab-panel" id="avw-panel-register">
                <p class="avw-login-card-subtitle"><?php esc_html_e( 'New to De Ooievaar? Create a free account to track orders and manage your details.', 'woocommerce' ); ?></p>

                <form method="post" class="woocommerce-form woocommerce-form-register register">
                    <?php do_action( 'woocommerce_register_form_start' ); ?>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                    <div class="form-row form-row-wide">
                        <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
                    </div>
                    <?php endif; ?>

                    <div class="form-row form-row-wide">
                        <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
                    </div>

                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                    <div class="form-row form-row-wide">
                        <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                    </div>
                    <?php else : ?>
                    <p style="font-size:13px; color:rgba(19,62,35,0.5); margin-bottom: 24px;"><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>
                    <?php endif; ?>

                    <?php do_action( 'woocommerce_register_form' ); ?>
                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>

                    <button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
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
    var tabs    = document.querySelectorAll('.avw-tab-btn');
    var panels  = document.querySelectorAll('.avw-tab-panel');

    tabs.forEach(function (btn) {
        btn.addEventListener('click', function () {
            tabs.forEach(function (b) { b.classList.remove('active'); });
            panels.forEach(function (p) { p.classList.remove('active'); });
            btn.classList.add('active');
            var panel = document.getElementById('avw-panel-' + btn.dataset.tab);
            if (panel) panel.classList.add('active');
        });
    });

    /* If WC returned a register error, auto-switch to the register tab */
    if (document.querySelector('.woocommerce-error') && document.getElementById('avw-panel-register')) {
        var registerBtn = document.querySelector('[data-tab="register"]');
        if (registerBtn) registerBtn.click();
    }
})();
</script>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
