<?php
$page_title = "Contacts — Darrel & Ayien's Five Star Hotel";
require_once 'includes/header.php';
?>

<h2 class="page-title">Contacts</h2>
<hr class="page-divider">

<div class="contact-grid">
    <div class="card">
        <div class="section-label">Get In Touch</div>

        <div class="contact-item">
            <div class="contact-icon">📍</div>
            <div class="contact-detail">
                <h4>Address</h4>
                <p>123 Ayala Avenue, Makati City<br>Metro Manila, Philippines 1226</p>
            </div>
        </div>

        <div class="contact-item">
            <div class="contact-icon">📞</div>
            <div class="contact-detail">
                <h4>Phone</h4>
                <p>(02) 8888-5000<br>0917-8051962</p>
            </div>
        </div>

        <div class="contact-item">
            <div class="contact-icon">📠</div>
            <div class="contact-detail">
                <h4>Fax</h4>
                <p>(02) 8888-5001</p>
            </div>
        </div>

        <div class="contact-item">
            <div class="contact-icon">✉️</div>
            <div class="contact-detail">
                <h4>Email</h4>
                <p>reservations@darrel-ayien.com<br>info@darrel-ayien.com</p>
            </div>
        </div>

        <div class="contact-item">
            <div class="contact-icon">🌐</div>
            <div class="contact-detail">
                <h4>Website</h4>
                <p>www.darrel-ayien.com</p>
            </div>
        </div>

        <div class="contact-item">
            <div class="contact-icon">🕐</div>
            <div class="contact-detail">
                <h4>Front Desk Hours</h4>
                <p>Open 24 Hours, 7 Days a Week</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="section-label">Department Contacts</div>
        <table class="rate-table" style="margin-top:4px;">
            <thead>
                <tr><th>Department</th><th>Extension</th></tr>
            </thead>
            <tbody>
                <tr><td>Front Desk / Reservations</td><td>5100</td></tr>
                <tr><td>Concierge</td><td>5110</td></tr>
                <tr><td>Housekeeping</td><td>5120</td></tr>
                <tr><td>Restaurant &amp; Dining</td><td>5130</td></tr>
                <tr><td>Spa &amp; Wellness</td><td>5140</td></tr>
                <tr><td>Business Center</td><td>5150</td></tr>
                <tr><td>Security</td><td>5160</td></tr>
                <tr><td>Maintenance</td><td>5170</td></tr>
                <tr><td>General Manager's Office</td><td>5200</td></tr>
            </tbody>
        </table>

        <div class="alert alert-info" style="margin-top: 20px;">
            For online reservations, please visit our <a href="reservation.php" style="color:var(--gold-dark); font-weight:600;">Reservation page</a>.
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
