<?php
/**
 * Template Name: Registration
 */
get_header(); ?>


<style>
/* ============================================================
   BUSINESS REGISTRATION PAGE STYLES
   ============================================================ */
.avw-biz-reg {
    min-height: 80vh;
    padding: 80px 24px 120px;
    background: #fff;
    font-family: 'DM Sans', sans-serif;
}

.avw-biz-container {
    max-width: 1000px;
    margin: 0 auto;
}

.avw-biz-header {
    text-align: center;
    margin-bottom: 64px;
}

.avw-biz-title {
    font-family: 'Kurversbrug', serif;
    font-size: clamp(2.5rem, 6vw, 4rem);
    color: #133E23;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    margin-bottom: 16px;
    font-weight: normal;
}

.avw-biz-subtitle {
    font-size: 16px;
    color: rgba(19,62,35,0.6);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.7;
}

.avw-biz-form-wrap {
    background: #fff;
    border: 1px solid rgba(19,62,35,0.08);
    border-radius: 32px;
    padding: 60px;
    box-shadow: 0 20px 80px rgba(0,0,0,0.04);
}

@media (max-width: 768px) {
    .avw-biz-form-wrap { padding: 40px 24px; }
    .avw-biz-reg { padding-top: 60px; }
}

.avw-biz-form-section-title {
    font-family: 'Kurversbrug', serif;
    font-size: 18px;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #133E23;
    margin-bottom: 32px;
    padding-bottom: 12px;
    border-bottom: 1.5px solid rgba(19,62,35,0.1);
    display: flex;
    align-items: center;
    gap: 12px;
}

.avw-biz-form-section-title span {
    width: 28px;
    height: 28px;
    background: #133E23;
    color: #cdbca6;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 12px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 700;
}

.avw-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px 32px;
    margin-bottom: 48px;
}

@media (max-width: 640px) {
    .avw-grid { grid-template-columns: 1fr; }
}

.avw-form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.avw-form-group.full-width {
    grid-column: span 2;
}

@media (max-width: 640px) {
    .avw-form-group.full-width { grid-column: span 1; }
}

.avw-form-group label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: rgba(19,62,35,0.5);
    margin-left: 4px;
}

.avw-form-group input, 
.avw-form-group select, 
.avw-form-group textarea {
    padding: 16px 20px;
    border: 1.5px solid rgba(19,62,35,0.12);
    border-radius: 16px;
    font-size: 15px;
    color: #133E23;
    background: #fafafa;
    transition: all 0.25s ease;
    width: 100%;
    outline: none;
    font-family: 'DM Sans', sans-serif;
}

.avw-form-group input:focus, 
.avw-form-group select:focus, 
.avw-form-group textarea:focus {
    border-color: #133E23;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(19,62,35,0.05);
}

.avw-form-group textarea {
    min-height: 120px;
    resize: vertical;
}

.avw-biz-submit-btn {
    display: block;
    width: 100%;
    background: #133E23;
    color: #cdbca6;
    padding: 20px 32px;
    border-radius: 9999px;
    font-family: 'Kurversbrug', serif;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 10px 40px rgba(19,62,35,0.2);
    text-align: center;
    margin-top: 20px;
}

.avw-biz-submit-btn:hover {
    background: #0a2415;
    transform: translateY(-3px);
    box-shadow: 0 15px 50px rgba(19,62,35,0.3);
    color: #fff;
}

.avw-biz-footer-note {
    text-align: center;
    margin-top: 40px;
    font-size: 13px;
    color: rgba(19,62,35,0.4);
}
</style>

<div class="avw-biz-reg">
    <div class="avw-biz-container">
        
        <!-- Header -->
        <header class="avw-biz-header">
            <h1 class="avw-biz-title">Business Registration</h1>
            <p class="avw-biz-subtitle">
                Become a wholesale partner. Complete the form below to apply for a business account and access our artisanal collection of genevers and liqueurs.
            </p>
        </header>

        <!-- Application Form -->
        <div class="avw-biz-form-wrap">
            <form action="#" method="POST" id="avw-business-registration-form">
                
                <!-- Section 1: Company Info -->
                <h3 class="avw-biz-form-section-title"><span>1</span> Company Information</h3>
                <div class="avw-grid">
                    <div class="avw-form-group full-width">
                        <label>Business Name *</label>
                        <input type="text" name="biz_name" required placeholder="Legal company name">
                    </div>
                    <div class="avw-form-group">
                        <label>VAT Number *</label>
                        <input type="text" name="biz_vat" required placeholder="e.g. NL123456789B01">
                    </div>
                    <div class="avw-form-group">
                        <label>Chamber of Commerce (KvK) *</label>
                        <input type="text" name="biz_kvk" required placeholder="8-digit number">
                    </div>
                    <div class="avw-form-group">
                        <label>Business Type</label>
                        <select name="biz_type">
                            <option value="horeca">Cafe / Restaurant / Hotel</option>
                            <option value="retail">Liquor Store / Retail</option>
                            <option value="wholesale">Wholesale / Distributor</option>
                            <option value="events">Events / Catering</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="avw-form-group">
                        <label>Website</label>
                        <input type="url" name="biz_web" placeholder="https://">
                    </div>
                </div>

                <!-- Section 2: Contact Info -->
                <h3 class="avw-biz-form-section-title"><span>2</span> Contact Details</h3>
                <div class="avw-grid">
                    <div class="avw-form-group">
                        <label>Full Name *</label>
                        <input type="text" name="contact_name" required placeholder="Main contact person">
                    </div>
                    <div class="avw-form-group">
                        <label>Phone Number *</label>
                        <input type="tel" name="contact_phone" required placeholder="+31 ...">
                    </div>
                    <div class="avw-form-group full-width">
                        <label>Work Email Address *</label>
                        <input type="email" name="contact_email" required placeholder="email@company.com">
                    </div>
                </div>

                <!-- Section 3: Address -->
                <h3 class="avw-biz-form-section-title"><span>3</span> Business Address</h3>
                <div class="avw-grid">
                    <div class="avw-form-group full-width">
                        <label>Street & Number *</label>
                        <input type="text" name="addr_street" required>
                    </div>
                    <div class="avw-form-group">
                        <label>Postal Code *</label>
                        <input type="text" name="addr_zip" required>
                    </div>
                    <div class="avw-form-group">
                        <label>City *</label>
                        <input type="text" name="addr_city" required>
                    </div>
                    <div class="avw-form-group full-width">
                        <label>Additional Notes</label>
                        <textarea name="message" placeholder="Tell us about your business or specific products you are interested in..."></textarea>
                    </div>
                </div>

                <button type="submit" class="avw-biz-submit-btn">Submit Application</button>

                <p class="avw-biz-footer-note">
                    Your application will be reviewed by our team. We usually respond within 2-3 business days.
                </p>
            </form>
        </div>

    </div>
</div>

<?php get_footer(); ?>
