<?php
require_once 'auth.php';
require_once '../includes/db.php';

$rates = [
    'Single'  => ['Regular' => 100,  'De Luxe' => 300,  'Suite' => 500],
    'Double'  => ['Regular' => 200,  'De Luxe' => 500,  'Suite' => 800],
    'Family'  => ['Regular' => 500,  'De Luxe' => 750,  'Suite' => 1000],
];

$errors = [];
$data   = ['customer_name'=>'','contact_number'=>'','from_date'=>'','to_date'=>'',
           'room_type'=>'','room_capacity'=>'','payment_type'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'customer_name'  => trim($_POST['customer_name'] ?? ''),
        'contact_number' => trim($_POST['contact_number'] ?? ''),
        'from_date'      => $_POST['from_date'] ?? '',
        'to_date'        => $_POST['to_date'] ?? '',
        'room_type'      => $_POST['room_type'] ?? '',
        'room_capacity'  => $_POST['room_capacity'] ?? '',
        'payment_type'   => $_POST['payment_type'] ?? '',
    ];

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

            $pdo  = getDB();
            $stmt = $pdo->prepare("INSERT INTO reservations
                (customer_name,contact_number,date_reserved,from_date,to_date,room_type,room_capacity,payment_type,num_days,rate_per_day,sub_total,discount,total_bill)
                VALUES(:cn,:co,NOW(),:fd,:td,:rt,:rc,:pt,:nd,:rpd,:st,:disc,:tb)");
            $stmt->execute([':cn'=>$data['customer_name'],':co'=>$data['contact_number'],
                ':fd'=>$data['from_date'],':td'=>$data['to_date'],':rt'=>$data['room_type'],
                ':rc'=>$data['room_capacity'],':pt'=>$data['payment_type'],
                ':nd'=>$num_days,':rpd'=>$rate_per_day,':st'=>$sub_total,':disc'=>$discount,':tb'=>$total_bill]);
            header('Location: index.php?msg=added');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title>Add Reservation — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="background:var(--cream);">
<div class="admin-header">
    <div class="admin-title">⚙ Admin — Add Reservation</div>
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
                        <option value="">-- Select --</option>
                        <?php foreach (['Regular','De Luxe','Suite'] as $rt): ?>
                            <option value="<?=$rt?>" <?= $data['room_type']===$rt?'selected':'' ?>><?=$rt?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Room Capacity</label>
                    <select name="room_capacity" required>
                        <option value="">-- Select --</option>
                        <?php foreach (['Single','Double','Family'] as $rc): ?>
                            <option value="<?=$rc?>" <?= $data['room_capacity']===$rc?'selected':'' ?>><?=$rc?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Payment Type</label>
                    <select name="payment_type" required>
                        <option value="">-- Select --</option>
                        <?php foreach (['Cash','Cheque','Credit Card'] as $pt): ?>
                            <option value="<?=$pt?>" <?= $data['payment_type']===$pt?'selected':'' ?>><?=$pt?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Add Reservation</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
