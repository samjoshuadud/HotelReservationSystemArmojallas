<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Darrel & Ayien's Hotel</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/HotelReservationSystemArmojallasRunes/assets/css/style.css">
</head>
<body style="background:var(--cream); padding:0; margin:0;">

<div class="admin-header">
    <div class="admin-title">⚙ Admin Panel &mdash; Hotel Reservation System</div>
    <div class="admin-nav">
        <a href="/HotelReservationSystemArmojallasRunes/public/home">View Site</a>
        <a href="/HotelReservationSystemArmojallasRunes/public/admin/logout">Logout (<?= htmlspecialchars($_SESSION['admin_username']) ?>)</a>
    </div>
</div>

<div class="admin-content">

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-<?= $_GET['msg']==='deleted' ? 'error' : 'success' ?>">
            <?= $_GET['msg'] === 'deleted' ? '🗑 Reservation deleted.' : '✔ Operation successful.' ?>
        </div>
    <?php endif; ?>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number"><?= $data['stats']['total'] ?></div>
            <div class="stat-label">Total Reservations</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">₱<?= number_format($data['stats']['revenue'], 0) ?></div>
            <div class="stat-label">Total Revenue</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= round($data['stats']['avg_days'], 1) ?></div>
            <div class="stat-label">Avg Days/Stay</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $data['stats']['today'] ?></div>
            <div class="stat-label">Reservations Today</div>
        </div>
    </div>

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; flex-wrap:wrap; gap:10px;">
        <form method="GET" action="/HotelReservationSystemArmojallasRunes/public/admin/index" style="display:flex; gap:8px;">
            <input type="text" name="search" value="<?= htmlspecialchars($data['search']) ?>"
                   placeholder="Search by name or contact..." style="width:260px;">
            <button type="submit" class="btn btn-primary btn-sm">Search</button>
            <?php if ($data['search']): ?><a href="/HotelReservationSystemArmojallasRunes/public/admin/index" class="btn btn-secondary btn-sm">Clear</a><?php endif; ?>
        </form>
        <a href="/HotelReservationSystemArmojallasRunes/public/admin/add" class="btn btn-primary btn-sm">+ Add Reservation</a>
    </div>

    <div class="card" style="padding:0; overflow:hidden;">
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Contact</th>
                        <th>Reserved On</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Days</th>
                        <th>Room</th>
                        <th>Capacity</th>
                        <th>Payment</th>
                        <th>Total Bill</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['reservations'])): ?>
                        <tr><td colspan="12" style="text-align:center; padding:30px; color:var(--text-light);">No reservations found.</td></tr>
                    <?php else: ?>
                    <?php foreach ($data['reservations'] as $r): ?>
                        <tr>
                            <td><?= $r['id'] ?></td>
                            <td><strong><?= htmlspecialchars($r['customer_name']) ?></strong></td>
                            <td><?= htmlspecialchars($r['contact_number']) ?></td>
                            <td style="font-size:0.78rem;"><?= date('M d, Y', strtotime($r['date_reserved'])) ?></td>
                            <td style="font-size:0.78rem;"><?= date('M d, Y', strtotime($r['from_date'])) ?></td>
                            <td style="font-size:0.78rem;"><?= date('M d, Y', strtotime($r['to_date'])) ?></td>
                            <td style="text-align:center;"><?= $r['num_days'] ?></td>
                            <td><?= htmlspecialchars($r['room_type']) ?></td>
                            <td><?= htmlspecialchars($r['room_capacity']) ?></td>
                            <td>
                                <?php
                                $badges = ['Cash'=>'badge-cash','Cheque'=>'badge-cheque','Credit Card'=>'badge-credit'];
                                $badge  = $badges[$r['payment_type']] ?? '';
                                ?>
                                <span class="badge <?= $badge ?>"><?= htmlspecialchars($r['payment_type']) ?></span>
                            </td>
                            <td><strong>₱<?= number_format($r['total_bill'], 2) ?></strong></td>
                            <td>
                                <a href="/HotelReservationSystemArmojallasRunes/public/admin/edit/<?= $r['id'] ?>" class="btn btn-secondary btn-sm">Edit</a>
                                <a href="/HotelReservationSystemArmojallasRunes/public/admin/index?delete=<?= $r['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete this reservation?')">Del</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>
