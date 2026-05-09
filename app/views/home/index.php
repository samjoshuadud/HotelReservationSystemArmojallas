<?php require_once '../app/views/layout/header.php'; ?>

<div class="hero-banner">
    <p class="hero-sub">Welcome to</p>
    <h2 class="hero-title"><em>Darrel &amp; Ayien's</em><br>Five Star Hotel</h2>
    <p class="hero-sub" style="margin-bottom:28px;">Where Luxury Meets Perfection</p>
    <a href="/HotelReservationSystemArmojallasRunes/public/reservation" class="hero-cta">Book Your Stay</a>
</div>

<div class="section-label">Our Amenities</div>

<div class="amenities">
    <div class="amenity-card">
        <div class="amenity-icon">🌊</div>
        <h3 class="amenity-title">Infinity Pool</h3>
        <p class="amenity-desc">Relax in our rooftop infinity pool overlooking the city skyline, open 24 hours.</p>
    </div>
    <div class="amenity-card">
        <div class="amenity-icon">🍽️</div>
        <h3 class="amenity-title">Fine Dining</h3>
        <p class="amenity-desc">Savor world-class cuisine prepared by our Michelin-starred executive chef.</p>
    </div>
    <div class="amenity-card">
        <div class="amenity-icon">💆</div>
        <h3 class="amenity-title">Luxury Spa</h3>
        <p class="amenity-desc">Rejuvenate with our full-service spa featuring traditional and modern therapies.</p>
    </div>
    <div class="amenity-card">
        <div class="amenity-icon">🏋️</div>
        <h3 class="amenity-title">Fitness Center</h3>
        <p class="amenity-desc">State-of-the-art equipment and personal trainers available every day.</p>
    </div>
    <div class="amenity-card">
        <div class="amenity-icon">🎪</div>
        <h3 class="amenity-title">Grand Ballroom</h3>
        <p class="amenity-desc">Host your events and celebrations in our 1,200-seat ballroom.</p>
    </div>
    <div class="amenity-card">
        <div class="amenity-icon">🚗</div>
        <h3 class="amenity-title">Valet Parking</h3>
        <p class="amenity-desc">Complimentary valet parking with 24-hour concierge security service.</p>
    </div>
</div>

<div style="margin-top: 36px;" class="card">
    <h3 class="page-title" style="font-size:1.4rem;">Room Rates</h3>
    <hr class="page-divider">
    <div class="rate-table-wrap">
        <table class="rate-table">
            <thead>
                <tr>
                    <th>Room Capacity</th>
                    <th>Room Type</th>
                    <th>Rate / Day</th>
                </tr>
            </thead>
            <tbody>
                <tr><td rowspan="3">Single</td><td>Regular</td><td>₱100.00</td></tr>
                <tr><td>De Luxe</td><td>₱300.00</td></tr>
                <tr><td>Suite</td><td>₱500.00</td></tr>
                <tr><td rowspan="3">Double</td><td>Regular</td><td>₱200.00</td></tr>
                <tr><td>De Luxe</td><td>₱500.00</td></tr>
                <tr><td>Suite</td><td>₱800.00</td></tr>
                <tr><td rowspan="3">Family</td><td>Regular</td><td>₱500.00</td></tr>
                <tr><td>De Luxe</td><td>₱750.00</td></tr>
                <tr><td>Suite</td><td>₱1,000.00</td></tr>
            </tbody>
        </table>
    </div>
    <div class="alert alert-info" style="margin-top:16px;">
        <strong>Cash Discounts:</strong> 10% off for 3–5 days stay &nbsp;|&nbsp; 15% off for 6+ days stay.<br>
        Cheque payments incur a +5% charge. Credit Card payments incur a +10% charge.
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>
