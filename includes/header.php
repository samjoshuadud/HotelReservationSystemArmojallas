<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$current_page = basename($_SERVER['PHP_SELF']);
$base = '';
if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
    $base = '../';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Darrel & Ayien\'s Five Star Hotel' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
</head>
<body>

<header class="site-header">
    <div class="header-inner">
        <div class="hotel-brand">
            <span class="star">★ ★ ★ ★ ★</span>
            <h1 class="hotel-name">Darrel &amp; Ayien's</h1>
            <p class="hotel-sub">FIVE STAR HOTEL</p>
        </div>
    </div>
    <nav class="main-nav">
        <ul>
            <li><a href="<?= $base ?>index.php" class="<?= $current_page==='index.php'?'active':'' ?>">Home</a></li>
            <li><a href="<?= $base ?>profile.php" class="<?= $current_page==='profile.php'?'active':'' ?>">Company's Profile</a></li>
            <li><a href="<?= $base ?>reservation.php" class="<?= $current_page==='reservation.php'?'active':'' ?>">Reservation</a></li>
            <li><a href="<?= $base ?>contacts.php" class="<?= $current_page==='contacts.php'?'active':'' ?>">Contacts</a></li>
        </ul>
    </nav>
</header>

<main class="page-content">
