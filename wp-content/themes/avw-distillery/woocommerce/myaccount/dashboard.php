<?php
/**
 * Custom Boutique My Account Dashboard — De Ooievaar Distillery
 *
 * @package WooCommerce\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_user = wp_get_current_user();
?>

<style>
/* ============================================================
   BOUTIQUE MY ACCOUNT DASHBOARD
   ============================================================ */

.avw-dashboard {
    font-family: 'DM Sans', sans-serif;
    color: #133E23;
    padding-bottom: 80px;
}

/* Welcome banner */
.avw-dashboard-welcome {
    background: linear-gradient(135deg, #133E23 0%, #1e5c35 100%);
    border-radius: 20px;
    padding: 40px 44px;
    margin-bottom: 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
}

.avw-dashboard-welcome-text h2 {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(22px, 4vw, 32px);
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #cdbca6;
    font-weight: normal;
    margin: 0 0 8px;
}

.avw-dashboard-welcome-text p {
    font-size: 14px;
    color: rgba(205,188,166,0.6);
    margin: 0;
}

.avw-dashboard-welcome-avatar {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    background: rgba(205,188,166,0.15);
    border: 2px solid rgba(205,188,166,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.avw-dashboard-welcome-avatar svg {
    opacity: 0.7;
}

/* Section heading */
.avw-dashboard-section-title {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.14em;
    color: rgba(19,62,35,0.4);
    margin: 0 0 16px;
}

/* Dashboard action cards grid */
.avw-dashboard-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 48px;
}

@media (max-width: 900px) {
    .avw-dashboard-cards { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 560px) {
    .avw-dashboard-cards { grid-template-columns: 1fr; }
    .avw-dashboard-welcome { padding: 28px 24px; }
}

/* Individual card */
.avw-dash-card {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 16px;
    padding: 28px 28px 24px;
    background: #fff;
    border-radius: 18px;
    border: 1px solid rgba(19,62,35,0.07);
    box-shadow: 0 4px 24px rgba(0,0,0,0.03);
    text-decoration: none;
    color: #133E23;
    transition: all 0.25s ease;
    cursor: pointer;
}

.avw-dash-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.08);
    border-color: rgba(19,62,35,0.15);
    color: #133E23;
    text-decoration: none;
}

.avw-dash-card__icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: rgba(19,62,35,0.06);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: background 0.2s;
}

.avw-dash-card:hover .avw-dash-card__icon {
    background: rgba(19,62,35,0.1);
}

.avw-dash-card__body {
    flex: 1;
}

.avw-dash-card__title {
    font-family: 'Kurversbrug', serif;
    font-size: 16px;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #133E23;
    margin: 0 0 6px;
    font-weight: normal;
}

.avw-dash-card__desc {
    font-size: 13px;
    color: rgba(19,62,35,0.5);
    line-height: 1.5;
    margin: 0;
}

.avw-dash-card__arrow {
    margin-left: auto;
    opacity: 0.25;
    transition: opacity 0.2s, transform 0.2s;
    align-self: center;
}
.avw-dash-card:hover .avw-dash-card__arrow {
    opacity: 0.6;
    transform: translateX(4px);
}

/* Log out link */
.avw-logout-wrap {
    margin-top: 12px;
    text-align: right;
}
.avw-logout-link {
    font-size: 12px;
    color: rgba(19,62,35,0.35);
    text-decoration: none;
    letter-spacing: 0.06em;
    transition: color 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.avw-logout-link:hover { color: #dc2626; }
</style>

<div class="avw-dashboard">

    <!-- Welcome Banner -->
    <div class="avw-dashboard-welcome">
        <div class="avw-dashboard-welcome-text">
            <h2><?php printf( esc_html__( 'Welcome, %s', 'woocommerce' ), esc_html( $current_user->display_name ) ); ?></h2>
            <p><?php esc_html_e( 'Manage your orders, addresses and account details below.', 'woocommerce' ); ?></p>
        </div>
        <div class="avw-dashboard-welcome-avatar">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#cdbca6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </div>
    </div>

    <p class="avw-dashboard-section-title"><?php esc_html_e( 'Quick Access', 'woocommerce' ); ?></p>

    <!-- Action Cards -->
    <div class="avw-dashboard-cards">

        <!-- Orders -->
        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>" class="avw-dash-card">
            <div class="avw-dash-card__icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#133E23" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <path d="M9 12h6M9 16h4"/>
                </svg>
            </div>
            <div class="avw-dash-card__body">
                <p class="avw-dash-card__title"><?php esc_html_e( 'My Orders', 'woocommerce' ); ?></p>
                <p class="avw-dash-card__desc"><?php esc_html_e( 'View your recent orders and their status.', 'woocommerce' ); ?></p>
            </div>
            <svg class="avw-dash-card__arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#133E23" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </a>

        <!-- Addresses -->
        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>" class="avw-dash-card">
            <div class="avw-dash-card__icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#133E23" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
            </div>
            <div class="avw-dash-card__body">
                <p class="avw-dash-card__title"><?php esc_html_e( 'My Addresses', 'woocommerce' ); ?></p>
                <p class="avw-dash-card__desc"><?php esc_html_e( 'Update your billing and shipping addresses.', 'woocommerce' ); ?></p>
            </div>
            <svg class="avw-dash-card__arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#133E23" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </a>

        <!-- Account Details -->
        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>" class="avw-dash-card">
            <div class="avw-dash-card__icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#133E23" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M6 20v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="avw-dash-card__body">
                <p class="avw-dash-card__title"><?php esc_html_e( 'Account Details', 'woocommerce' ); ?></p>
                <p class="avw-dash-card__desc"><?php esc_html_e( 'Edit your password and account information.', 'woocommerce' ); ?></p>
            </div>
            <svg class="avw-dash-card__arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#133E23" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </a>

    </div>

    <!-- Log Out -->
    <div class="avw-logout-wrap">
        <a href="<?php echo esc_url( wc_logout_url() ); ?>" class="avw-logout-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            <?php esc_html_e( 'Sign Out', 'woocommerce' ); ?>
        </a>
    </div>

</div>
