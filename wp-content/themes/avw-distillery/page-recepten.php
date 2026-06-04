<?php
/**
 * Template Name: Recepten
 *
 * @package avw-distillery
 */

get_header();

$products     = get_terms(array('taxonomy' => 'recept_product',     'hide_empty' => false));
$soorten      = get_terms(array('taxonomy' => 'recept_soort',       'hide_empty' => false));
$gelegenheden = get_terms(array('taxonomy' => 'recept_gelegenheid', 'hide_empty' => false));
?>

<style>
/* ============================================================
   RECEPTEN PAGE
   ============================================================ */
.avw-rec-hero {
    width: 100vw; position: relative; left: 50%; transform: translateX(-50%);
    background: #36221d; overflow: hidden;
    padding-top: 96px; padding-bottom: 56px;
}
.avw-rec-hero-img {
    position: absolute; top: -30%; left: 0;
    width: 100%; height: 160%;
    object-fit: cover; object-position: center 40%; opacity: 0.45;
}
.avw-rec-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(54,34,29,0.7) 100%);
}
.avw-rec-hero-content {
    position: relative; z-index: 10;
    max-width: 900px; margin: 0 auto; text-align: center; padding: 0 24px;
}
.avw-rec-breadcrumb {
    font-family: 'DM Sans', sans-serif; font-size: 13px;
    text-transform: uppercase; letter-spacing: 0.15em; color: rgba(238,223,203,0.7); margin-bottom: 20px;
}
.avw-rec-breadcrumb a { color: rgba(238,223,203,0.7); text-decoration: none; }
.avw-rec-breadcrumb a:hover { color: #fff; }
.avw-rec-hero-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(42px, 7vw, 80px); color: #eedfcb;
    text-transform: uppercase; letter-spacing: 0.12em; font-weight: normal;
    margin: 0; line-height: 1.05; text-shadow: 0 4px 24px rgba(0,0,0,0.4);
}

/* ---- Search Form ---- */
.avw-rec-body { width: 80%; max-width: 1400px; margin: 0 auto; padding: 60px 0 100px; }

.avw-rec-search-card {
    background: #fff; border-radius: 24px;
    padding: 32px 40px;
    box-shadow: 0 4px 40px rgba(54,34,29,0.08);
    border: 1px solid rgba(54,34,29,0.06);
    margin-bottom: 48px;
}

.avw-rec-search-title {
    font-family: 'Kurversbrug', serif; font-size: 20px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.1em; font-weight: normal;
    margin: 0 0 20px;
}

/* Single-line search bar */
.avw-rec-filterbar {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1.5fr auto;
    gap: 12px;
    align-items: end;
}

.avw-rec-filter-group { display: flex; flex-direction: column; gap: 5px; }

.avw-rec-filter-group label {
    font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.12em; color: rgba(54,34,29,0.5);
}

.avw-rec-filter-group select,
.avw-rec-keyword-input {
    font-family: 'DM Sans', sans-serif; font-size: 14px; color: #36221d;
    border: 1.5px solid rgba(54,34,29,0.15); border-radius: 12px;
    padding: 11px 16px; background: #fdf8f1;
    outline: none; transition: border-color 0.2s; width: 100%;
    appearance: none; -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2336221d' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px;
}

.avw-rec-keyword-input { background-image: none !important; padding-right: 16px !important; }

.avw-rec-filter-group select:focus,
.avw-rec-keyword-input:focus { border-color: #36221d; background: #fff; }

.avw-rec-search-btn {
    background: linear-gradient(90deg, rgba(0,0,0,0.2), rgba(0,0,0,0.2)), #432B25;
    color: #fff; font-family: 'Kurversbrug', serif; font-size: 16px;
    text-transform: uppercase; letter-spacing: 0.12em;
    padding: 11px 28px; border-radius: 34px; border: none;
    cursor: pointer; transition: opacity 0.2s; white-space: nowrap;
    align-self: end;
}
.avw-rec-search-btn:hover { opacity: 0.88; }

/* ---- Results ---- */
.avw-rec-results-header {
    font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.1em; color: rgba(54,34,29,0.4);
    margin-bottom: 24px;
}

.avw-rec-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;
}

.avw-rec-card {
    background: #fff; border-radius: 20px; overflow: hidden;
    box-shadow: 0 4px 20px rgba(54,34,29,0.07); border: 1px solid rgba(54,34,29,0.06);
    text-decoration: none; color: inherit; display: flex; flex-direction: column;
    transition: box-shadow 0.25s, transform 0.25s;
}
.avw-rec-card:hover { box-shadow: 0 12px 40px rgba(54,34,29,0.14); transform: translateY(-3px); }

.avw-rec-card-img {
    width: 100%; height: 200px; object-fit: cover; object-position: center;
    display: block; background: #eedfcb;
}

.avw-rec-card-img-placeholder {
    width: 100%; height: 200px; background: linear-gradient(135deg, #eedfcb 0%, #e0cbb0 100%);
    display: flex; align-items: center; justify-content: center;
}

.avw-rec-card-body { padding: 20px 22px 24px; flex: 1; display: flex; flex-direction: column; }

.avw-rec-card-title {
    font-family: 'Kurversbrug', serif; font-size: 17px; color: #36221d;
    text-transform: uppercase; letter-spacing: 0.06em; font-weight: normal;
    margin: 0 0 10px; line-height: 1.3;
}

.avw-rec-card-excerpt {
    font-family: 'DM Sans', sans-serif; font-size: 13px; color: rgba(54,34,29,0.6);
    line-height: 1.6; margin: 0; flex: 1;
}

.avw-rec-empty {
    text-align: center; padding: 60px 24px;
    font-family: 'DM Sans', sans-serif; color: rgba(54,34,29,0.4); font-size: 15px;
}

.avw-rec-spinner { display: none; text-align: center; padding: 40px; }
.avw-rec-spinner.active { display: block; }

@media (max-width: 900px) {
    .avw-rec-body { width: 92%; }
    .avw-rec-filterbar { grid-template-columns: 1fr 1fr; }
    .avw-rec-search-btn { grid-column: 1 / -1; justify-self: start; }
    .avw-rec-grid { grid-template-columns: 1fr 1fr; gap: 16px; }
}
@media (max-width: 480px) {
    .avw-rec-body { width: 100%; padding-left: 16px; padding-right: 16px; }
    .avw-rec-filterbar { grid-template-columns: 1fr; }
    .avw-rec-grid { grid-template-columns: 1fr; }
}
</style>

<!-- HERO -->
<section class="avw-rec-hero">
    <img id="rec-hero-img" class="avw-rec-hero-img" src="<?php echo get_template_directory_uri(); ?>/assets/assortment-hero-v2.png" alt="Recepten" />
    <div class="avw-rec-hero-overlay"></div>
    <div class="avw-rec-hero-content">
        <nav class="avw-rec-breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span style="margin:0 10px;">&bull;</span>
            <span style="color:#fff;">Recepten</span>
        </nav>
        <h1 id="rec-hero-title" class="avw-rec-hero-title">Recepten</h1>
    </div>
</section>

<!-- SEARCH + RESULTS -->
<div class="avw-rec-body">

    <!-- Search Form -->
    <div class="avw-rec-search-card">
        <h2 class="avw-rec-search-title">Zoek een recept</h2>

        <div class="avw-rec-filterbar">
            <div class="avw-rec-filter-group">
                <label for="rec-product">Product</label>
                <select id="rec-product" name="product">
                    <option value="">Alle producten</option>
                    <?php foreach ($products as $term): ?>
                        <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="avw-rec-filter-group">
                <label for="rec-soort">Soort</label>
                <select id="rec-soort" name="soort">
                    <option value="">Alle soorten</option>
                    <?php foreach ($soorten as $term): ?>
                        <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="avw-rec-filter-group">
                <label for="rec-gelegenheid">Gelegenheid</label>
                <select id="rec-gelegenheid" name="gelegenheid">
                    <option value="">Alle gelegenheden</option>
                    <?php foreach ($gelegenheden as $term): ?>
                        <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="avw-rec-filter-group">
                <label for="rec-keyword">Trefwoord</label>
                <input type="text" id="rec-keyword" class="avw-rec-keyword-input" placeholder="bijv. genever, limoen…" />
            </div>
            <button id="rec-search-btn" class="avw-rec-search-btn">Zoeken</button>
        </div>
    </div>

    <!-- Results -->
    <div id="rec-results-wrap">
        <div class="avw-rec-spinner" id="rec-spinner">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#36221d" stroke-width="2" style="animation:spin 1s linear infinite;">
                <circle cx="12" cy="12" r="10" stroke-opacity="0.2"/>
                <path d="M12 2a10 10 0 0 1 10 10"/>
            </svg>
        </div>
        <div id="rec-results-header" class="avw-rec-results-header" style="display:none;"></div>
        <div id="rec-results" class="avw-rec-grid"></div>
    </div>
</div>

<style>
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>

<?php get_footer(); ?>
