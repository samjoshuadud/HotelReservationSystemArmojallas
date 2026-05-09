<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Add Reservation — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/HotelReservationSystemArmojallasRunes/assets/css/style.css">
</head>
<body style="background:var(--cream);">
<div class="admin-header">
    <div class="admin-title">⚙ Admin — Add Reservation</div>
    <div class="admin-nav"><a href="/HotelReservationSystemArmojallasRunes/public/admin/index">← Back to Dashboard</a></div>
</div>
<div class="admin-content" style="max-width:700px;">
    <?php if ($data['errors']): ?>
        <div class="alert alert-error"><?php foreach($data['errors'] as $e) echo "<div>⚠ ".htmlspecialchars($e)."</div>"; ?></div>
    <?php endif; ?>
    <div class="card">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Customer Name</label>
                    <input type="text" name="customer_name" value="<?= htmlspecialchars($data['formData']['customer_name']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="contact_number" value="<?= htmlspecialchars($data['formData']['contact_number']) ?>" required>
                </div>
                <div class="form-group">
                    <label>From Date</label>
                    <input type="date" name="from_date" value="<?= htmlspecialchars($data['formData']['from_date']) ?>" required>
                </div>
                <div class="form-group">
                    <label>To Date</label>
                    <input type="date" name="to_date" value="<?= htmlspecialchars($data['formData']['to_date']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Room Type</label>
                    <select name="room_type" required>
                        <option value="">-- Select --</option>
                        <?php foreach (['Regular','De Luxe','Suite'] as $rt): ?>
                            <option value="<?=$rt?>" <?= $data['formData']['room_type']===$rt?'selected':'' ?>><?=$rt?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Room Capacity</label>
                    <select name="room_capacity" required>
                        <option value="">-- Select --</option>
                        <?php foreach (['Single','Double','Family'] as $rc): ?>
                            <option value="<?=$rc?>" <?= $data['formData']['room_capacity']===$rc?'selected':'' ?>><?=$rc?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Payment Type</label>
                    <select name="payment_type" required>
                        <option value="">-- Select --</option>
                        <?php foreach (['Cash','Cheque','Credit Card'] as $pt): ?>
                            <option value="<?=$pt?>" <?= $data['formData']['payment_type']===$pt?'selected':'' ?>><?=$pt?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Add Reservation</button>
                <a href="/HotelReservationSystemArmojallasRunes/public/admin/index" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
