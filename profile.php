<?php
$page_title = "Company's Profile — Darrel & Ayien's Five Star Hotel";
require_once 'includes/header.php';
?>

<h2 class="page-title">Company's Profile</h2>
<hr class="page-divider">

<div class="hero-banner" style="padding: 40px; margin-bottom: 28px;">
    <p class="hero-sub">Established 1998</p>
    <h2 class="hero-title" style="font-size:2rem;"><em>A Legacy of Luxury</em></h2>
</div>

<div class="card">
    <div class="section-label">Our Story</div>
    <p style="line-height:1.8; font-size:0.92rem; color:var(--text); margin-bottom:16px;">
        Founded in 1998 by Darrel Mansueto and Ayien Traballo, our hotel began as a vision to create a sanctuary of luxury in the heart of Makati City. What started as a boutique 30-room establishment has grown into one of the Philippines' most prestigious five-star hotels, hosting dignitaries, celebrities, and discerning travelers from around the world.
    </p>
    <p style="line-height:1.8; font-size:0.92rem; color:var(--text);">
        Over the past two decades, we have continuously reinvested in our facilities and staff, earning multiple awards for hospitality excellence. Our philosophy remains unchanged: every guest deserves personalized service, impeccable comfort, and unforgettable memories.
    </p>
</div>

<div style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <div class="card">
        <div class="section-label">Our Mission</div>
        <p style="line-height:1.8; font-size:0.88rem; color:var(--text);">
            To deliver exceptional hospitality that exceeds expectations, creating unique and memorable experiences for every guest through our dedicated team, world-class amenities, and unwavering commitment to excellence.
        </p>
    </div>
    <div class="card">
        <div class="section-label">Our Vision</div>
        <p style="line-height:1.8; font-size:0.88rem; color:var(--text);">
            To be recognized as the premier luxury hotel destination in Southeast Asia, setting the gold standard for hospitality, sustainability, and guest satisfaction for generations to come.
        </p>
    </div>
</div>

<div class="card" style="margin-top:4px;">
    <div class="section-label">Awards &amp; Recognition</div>
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px,1fr)); gap:16px; margin-top:4px;">
        <div style="border-left:3px solid var(--gold); padding-left:14px;">
            <strong style="font-size:0.85rem;">🏆 Best Luxury Hotel</strong>
            <p style="font-size:0.78rem; color:var(--text-light); margin-top:3px;">Philippine Tourism Awards 2023</p>
        </div>
        <div style="border-left:3px solid var(--gold); padding-left:14px;">
            <strong style="font-size:0.85rem;">⭐ Five-Star Certified</strong>
            <p style="font-size:0.78rem; color:var(--text-light); margin-top:3px;">Department of Tourism, Philippines</p>
        </div>
        <div style="border-left:3px solid var(--gold); padding-left:14px;">
            <strong style="font-size:0.85rem;">🌿 Green Hotel Award</strong>
            <p style="font-size:0.78rem; color:var(--text-light); margin-top:3px;">ASEAN Sustainable Tourism 2022</p>
        </div>
        <div style="border-left:3px solid var(--gold); padding-left:14px;">
            <strong style="font-size:0.85rem;">🍴 Fine Dining Excellence</strong>
            <p style="font-size:0.78rem; color:var(--text-light); margin-top:3px;">Miele Guide Southeast Asia 2023</p>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
