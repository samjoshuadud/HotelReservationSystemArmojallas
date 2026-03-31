<?php
require_once 'auth.php';
require_once '../includes/db.php';

$rates = [
    'Single'  => ['Regular' => 100,  'De Luxe' => 300,  'Suite' => 500],
    'Double'  => ['Regular' => 200,  'De Luxe' => 500,  'Suite' => 800],
    'Family'  => ['Regular' => 500,  'De Luxe' => 750,  'Suite' => 1000],
];

$pdo = getDB();
$id  = (int)($_GET['id'] ?? 0);

if (!$id) { header('Location: index.php'); exit; }

$stmt = $pdo->prepare("SELECT * FROM reservations WHERE id = :id");
$stmt->execute([':id' => $id]);
$res = $stmt->fetch();
if (!$res) { header('Location: index.php'); exit; }

$errors = [];
$data   = $res;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = array_merge($data, [
        'customer_name'  => trim($_POST['customer_name'] ?? ''),
        'contact_number' => trim($_POST['contact_number'] ?? ''),
        'from_date'      => $_POST['from_date'] ?? '',
        'to_date'        => $_POST['to_date'] ?? '',
        'room_type'      => $_POST['room_type'] ?? '',
        'room_capacity'  => $_POST['room_capacity'] ?? '',
        'payment_type'   => $_POST['payment_type'] ?? '',
    ]);

    foreach (['customer_name','contact_number','from_date','to_date','room_type','room_capacity','payment_type'] as $f) {
        if (empty($data[$f])) $errors[] = "Field '$f' is required.";
    }

    if (empty($errors)) {
        $from_dt  = new DateTime($data['from_date']);
        $to_dt    = new DateTime($data['to_date']);
        if ($to_dt <= $from_dt) { $errors[] = "To date must be after From date."; }
        else {
            $num_days    = $to_dt->diff($from_dt)->days;
            $rate_per_day = $rates[$data['room_capacity']][$data['room_type']];
            $sub_total   = $rate_per_day * $num_days;
            $discount    = 0;
            if ($data['payment_type'] === 'Cash') {
                if ($num_days >= 6) $discount = $sub_total * 0.15;
                elseif ($num_days >= 3) $discount = $sub_total * 0.10;
            } elseif ($data['payment_type'] === 'Cheque') {
                $discount = -($sub_total * 0.05);
            } elseif ($data['payment_type'] === 'Credit Card') {
                $discount = -($sub_total * 0.10);
            }
            $total_bill = $sub_total - $discount;

            $stmt = $pdo->prepare("UPDATE reservations SET
                customer_name=:cn, contact_number=:co, from_date=:fd, to_date=:td,
                room_type=:rt, room_capacity=:rc, payment_type=:pt,
                num_days=:nd, rate_per_day=:rpd, sub_total=:st, discount=:disc, total_bill=:tb
                WHERE id=:id");
            $stmt->execute([':cn'=>$data['customer_name'],':co'=>$data['contact_number'],
                ':fd'=>$data['from_date'],':td'=>$data['to_date'],':rt'=>$data['room_type'],
                ':rc'=>$data['room_capacity'],':pt'=>$data['payment_type'],
                ':nd'=>$num_days,':rpd'=>$rate_per_day,':st'=>$sub_total,':disc'=>$discount,':tb'=>$total_bill,
                ':id'=>$id]);
            header('Location: index.php?msg=updated');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Edit Reservation — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="background:var(--cream);">
<div class="admin-header">
    <div class="admin-title">⚙ Admin — Edit Reservation #<?= $id ?></div>
    <div class="admin-nav"><a href="index.php">← Back to Dashboard</a></div>
</div>
<div class="admin-content" style="max-width:700px;">
    <?php if ($errors): ?>
        <div class="alert alert-error"><?php foreach($errors as $e) echo "<div>⚠ ".htmlspecialchars($e)."</div>"; ?></div>
    <?php endif; ?>
    <div class="card">
        <form method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label>Customer Name</label>
                    <input type="text" name="customer_name" value="<?= htmlspecialchars($data['customer_name']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="contact_number" value="<?= htmlspecialchars($data['contact_number']) ?>" required>
                </div>
                <div class="form-group">
                    <label>From Date</label>
                    <input type="date" name="from_date" value="<?= htmlspecialchars($data['from_date']) ?>" required>
                </div>
                <div class="form-group">
                    <label>To Date</label>
                    <input type="date" name="to_date" value="<?= htmlspecialchars($data['to_date']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Room Type</label>
                    <select name="room_type" required>
                        <?php foreach (['Regular','De Luxe','Suite'] as $rt): ?>
                            <option value="<?=$rt?>" <?= $data['room_type']===$rt?'selected':'' ?>><?=$rt?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Room Capacity</label>
                    <select name="room_capacity" required>
                        <?php foreach (['Single','Double','Family'] as $rc): ?>
                            <option value="<?=$rc?>" <?= $data['room_capacity']===$rc?'selected':'' ?>><?=$rc?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Payment Type</label>
                    <select name="payment_type" required>
                        <?php foreach (['Cash','Cheque','Credit Card'] as $pt): ?>
                            <option value="<?=$pt?>" <?= $data['payment_type']===$pt?'selected':'' ?>><?=$pt?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
