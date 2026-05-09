<?php require_once '../app/views/layout/header.php'; ?>

<h2 class="page-title">Company Profile</h2>
<hr class="page-divider">

<div class="card profile-card">
    <div style="display:grid; grid-template-columns: 1fr 2fr; gap:30px; align-items:center;">
        <div>
            <div style="background:var(--burgundy); color:white; width:100%; aspect-ratio:1; display:flex; align-items:center; justify-content:center; font-size:4rem; border-radius:8px;">
                D&A
            </div>
        </div>
        <div>
            <h3 style="margin-top:0; color:var(--burgundy); font-family:var(--font-heading);">Darrel & Ayien's Five Star Hotel</h3>
            <p>Founded in 2024, our hotel was built on the principle of providing an unparalleled luxury experience for travelers who seek comfort, elegance, and world-class service.</p>
            <p>Located in the heart of the city, we offer 150 meticulously designed rooms and suites, each offering breathtaking views and modern amenities that cater to both business and leisure guests.</p>
        </div>
    </div>

    <div style="margin-top:40px; display:grid; grid-template-columns: 1fr 1fr; gap:30px;">
        <div class="info-box">
            <h4 style="color:var(--burgundy); border-bottom:1px solid var(--gold); padding-bottom:8px;">Our Mission</h4>
            <p style="font-size:0.9rem; line-height:1.6;">To provide exceptional hospitality experiences that exceed our guests' expectations through personalized service, exquisite surroundings, and attention to every detail.</p>
        </div>
        <div class="info-box">
            <h4 style="color:var(--burgundy); border-bottom:1px solid var(--gold); padding-bottom:8px;">Our Vision</h4>
            <p style="font-size:0.9rem; line-height:1.6;">To be recognized as the premier luxury hotel destination globally, setting the standard for excellence in the hospitality industry.</p>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
