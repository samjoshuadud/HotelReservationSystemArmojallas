<?php require_once '../app/views/layout/header.php'; ?>

<?php if ($data['success'] && $data['billing']): $billing = $data['billing']; ?>
    <h2 class="page-title">Reservation: Billing Information</h2>
    <hr class="page-divider">

    <div class="discount-note">
        Enjoy our <strong>10% discount</strong> for 3–5 days of reservation &nbsp;|&nbsp;
        Enjoy our <strong>15% discount</strong> for 6 days or above of reservation
    </div>

    <div class="card">
        <div class="datetime-display">
            Date Reserved: <strong><?= htmlspecialchars($billing['date_reserved']) ?></strong>
            &nbsp;&nbsp; Time: <strong><?= htmlspecialchars($billing['time_reserved']) ?></strong>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
            <div>
                <p style="font-size:0.78rem; text-transform:uppercase; letter-spacing:1.5px; color:var(--text-light);">Customer Name</p>
                <p style="font-weight:600; font-size:1rem;"><?= htmlspecialchars($billing['customer_name']) ?></p>
            </div>
            <div>
                <p style="font-size:0.78rem; text-transform:uppercase; letter-spacing:1.5px; color:var(--text-light);">Contact Number</p>
                <p style="font-weight:600; font-size:1rem;"><?= htmlspecialchars($billing['contact_number']) ?></p>
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <p style="font-size:0.78rem; text-transform:uppercase; letter-spacing:1.5px; color:var(--text-light); margin-bottom:6px;">Date of Reservation</p>
            <div style="display:flex; gap:40px;">
                <div><span style="color:var(--text-light); font-size:0.85rem;">From: </span><strong><?= date('F d, Y', strtotime($billing['from_date'])) ?></strong></div>
                <div><span style="color:var(--text-light); font-size:0.85rem;">To: </span><strong><?= date('F d, Y', strtotime($billing['to_date'])) ?></strong></div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div>
                <div class="billing-row"><span class="billing-label">Room Type:</span> <strong><?= htmlspecialchars($billing['room_type']) ?></strong></div>
                <div class="billing-row"><span class="billing-label">Room Capacity:</span> <strong><?= htmlspecialchars($billing['room_capacity']) ?></strong></div>
                <div class="billing-row"><span class="billing-label">Payment Type:</span> <strong><?= htmlspecialchars($billing['payment_type']) ?></strong></div>
            </div>
            <div class="billing-block">
                <strong style="font-size:0.75rem; letter-spacing:2px; text-transform:uppercase; color:var(--text-light);">Billing Statements</strong>
                <div class="billing-row"><span class="billing-label">No. of Days:</span> <strong><?= $billing['num_days'] ?></strong></div>
                <div class="billing-row"><span class="billing-label">Rate/Day:</span> <strong>₱<?= number_format($billing['rate_per_day'], 2) ?></strong></div>
                <div class="billing-row"><span class="billing-label">Sub-Total:</span> <strong>₱<?= number_format($billing['sub_total'], 2) ?></strong></div>
                <div class="billing-row">
                    <span class="billing-label"><?= $billing['discount'] >= 0 ? 'Discount:' : 'Surcharge:' ?></span>
                    <strong style="color:<?= $billing['discount'] >= 0 ? 'green' : '#c0392b' ?>">
                        <?= $billing['discount'] >= 0 ? '' : '+' ?>₱<?= number_format(abs($billing['discount']), 2) ?>
                    </strong>
                </div>
                <div class="billing-row total"><span>Total Bill:</span> <span>₱<?= number_format($billing['total_bill'], 2) ?></span></div>
            </div>
        </div>
    </div>

    <div class="btn-group">
        <a href="/HotelReservationSystemArmojallasRunes/public/home" class="btn btn-primary">Home</a>
        <a href="/HotelReservationSystemArmojallasRunes/public/reservation" class="btn btn-secondary">New Reservation</a>
    </div>

<?php else: ?>
    <h2 class="page-title">Online Reservation</h2>
    <hr class="page-divider">

    <?php if (!empty($data['errors'])): ?>
        <div class="alert alert-error">
            <?php foreach ($data['errors'] as $e): ?>
                <div>⚠ <?= htmlspecialchars($e) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="section-label">Supply the necessary information below</div>

    <div class="card">
        <div class="datetime-display">
            <?= date('F d, Y') ?> &nbsp;@&nbsp; <?= date('g:i:s A') ?>
        </div>

        <form method="POST" action="/HotelReservationSystemArmojallasRunes/public/reservation">
            <div class="form-grid">
                <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <input type="text" id="customer_name" name="customer_name"
                           value="<?= htmlspecialchars($_POST['customer_name'] ?? '') ?>"
                           placeholder="Full name" required>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number"
                           value="<?= htmlspecialchars($_POST['contact_number'] ?? '') ?>"
                           placeholder="e.g. 0917-8051962" required>
                </div>
            </div>

            <div style="margin-top:20px;">
                <p style="font-size:0.72rem; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; color:var(--text-light); margin-bottom:12px;">Reservation Date</p>
                <div class="form-grid">
                    <div class="form-group">
                        <label>From</label>
                        <input type="date" name="from_date"
                               value="<?= htmlspecialchars($_POST['from_date'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>To</label>
                        <input type="date" name="to_date"
                               value="<?= htmlspecialchars($_POST['to_date'] ?? '') ?>" required>
                    </div>
                </div>
            </div>

            <div class="radio-section" style="margin-top:24px;">
                <div>
                    <div class="radio-section-label">Room Type</div>
                    <div class="radio-group">
                        <?php foreach (['Suite','De Luxe','Regular'] as $rt): ?>
                            <label>
                                <input type="radio" name="room_type" value="<?= $rt ?>"
                                    <?= (($_POST['room_type'] ?? '') === $rt) ? 'checked' : '' ?>>
                                <?= $rt ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <div class="radio-section-label">Room Capacity</div>
                    <div class="radio-group">
                        <?php foreach (['Family','Double','Single'] as $rc): ?>
                            <label>
                                <input type="radio" name="room_capacity" value="<?= $rc ?>"
                                    <?= (($_POST['room_capacity'] ?? '') === $rc) ? 'checked' : '' ?>>
                                <?= $rc ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <div class="radio-section-label">Payment Type</div>
                    <div class="radio-group">
                        <?php foreach (['Cash','Cheque','Credit Card'] as $pt): ?>
                            <label>
                                <input type="radio" name="payment_type" value="<?= $pt ?>"
                                    <?= (($_POST['payment_type'] ?? '') === $pt) ? 'checked' : '' ?>>
                                <?= $pt ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" name="submit" class="btn btn-primary">Submit Reservation</button>
                <button type="reset" class="btn btn-secondary">Clear Entry</button>
            </div>
        </form>
    </div>

<?php endif; ?>

<?php require_once '../app/views/layout/footer.php'; ?>
