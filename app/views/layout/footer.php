</main>

<footer style="background: var(--dark); color: var(--cream); padding: 40px 20px; border-top: 2px solid var(--gold); margin-top: auto;">
    <div style="max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px;">
        <div>
            <h4 style="font-family: var(--font-display); color: var(--gold); font-size: 1.4rem; margin-bottom: 15px;">Darrel & Ayien's Five Star Hotel</h4>
            <p style="font-size: 0.85rem; color: var(--gold-light); line-height: 1.6;">Providing excellence in hospitality since 2024. Your comfort is our ultimate priority in the heart of the city.</p>
        </div>
        <div>
            <h4 style="font-family: var(--font-display); color: var(--gold); font-size: 1.1rem; margin-bottom: 15px; letter-spacing: 1px; text-transform: uppercase;">Quick Links</h4>
            <ul style="list-style: none;">
                <li style="margin-bottom: 8px;"><a href="<?= URLROOT ?>/home" style="color: var(--cream-dark); text-decoration: none; font-size: 0.85rem;">Home</a></li>
                <li style="margin-bottom: 8px;"><a href="<?= URLROOT ?>/profile" style="color: var(--cream-dark); text-decoration: none; font-size: 0.85rem;">Company Profile</a></li>
                <li style="margin-bottom: 8px;"><a href="<?= URLROOT ?>/reservation" style="color: var(--cream-dark); text-decoration: none; font-size: 0.85rem;">Online Reservation</a></li>
                <li style="margin-bottom: 8px;"><a href="<?= URLROOT ?>/contact" style="color: var(--cream-dark); text-decoration: none; font-size: 0.85rem;">Contact Us</a></li>
            </ul>
        </div>
    </div>
    <div style="text-align: center; padding-top: 40px; margin-top: 40px; border-top: 1px solid rgba(201,168,76,0.15); font-size: 0.75rem; color: var(--gold-light); letter-spacing: 1px;">
        &copy; <?= date('Y') ?> Hotel Reservation System. All Rights Reserved.
    </div>
</footer>

</body>
</html>
