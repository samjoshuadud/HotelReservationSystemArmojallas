<?php require_once '../app/views/layout/header.php'; ?>

<h2 class="page-title">Contact Us</h2>
<hr class="page-divider">

<div style="display:grid; grid-template-columns: 1fr 1.5fr; gap:30px;">
    <div>
        <div class="card">
            <h3 style="margin-top:0; font-size:1.2rem; color:var(--burgundy);">Get in Touch</h3>
            <p style="font-size:0.9rem; color:var(--text-light); margin-bottom:24px;">Have questions? Our team is here to help you 24/7.</p>
            
            <div style="margin-bottom:16px;">
                <strong>📍 Address</strong>
                <p style="margin:4px 0; font-size:0.85rem;">123 Luxury Avenue, Suite 500<br>Metro Manila, Philippines 1000</p>
            </div>
            
            <div style="margin-bottom:16px;">
                <strong>📞 Phone</strong>
                <p style="margin:4px 0; font-size:0.85rem;">+63 (02) 8888-1234<br>+63 917-123-4567</p>
            </div>
            
            <div style="margin-bottom:16px;">
                <strong>✉ Email</strong>
                <p style="margin:4px 0; font-size:0.85rem;">reservations@da-hotel.com<br>support@da-hotel.com</p>
            </div>
        </div>
    </div>
    
    <div>
        <div class="card">
            <form>
                <div class="form-grid">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" placeholder="Your first name">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" placeholder="Your last name">
                    </div>
                </div>
                <div class="form-group" style="margin-top:16px;">
                    <label>Email Address</label>
                    <input type="email" placeholder="example@email.com">
                </div>
                <div class="form-group" style="margin-top:16px;">
                    <label>Message</label>
                    <textarea rows="5" placeholder="How can we help you?" style="width:100%; padding:12px; border:1px solid #ddd; border-radius:4px; font-family:inherit;"></textarea>
                </div>
                <button type="button" class="btn btn-primary" style="margin-top:16px;">Send Message</button>
            </form>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
