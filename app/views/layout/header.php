<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['page_title'] ?? "Darrel & Ayien's Five Star Hotel" ?></title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="<?= ASSETROOT ?>/css/style.css">
</head>
<body>

<header class="site-header">
    <div class="header-inner">
        <div class="hotel-brand">
            <span class="star">★★★★★</span>
            <h1 class="hotel-name">Darrel & Ayien's</h1>
            <p class="hotel-sub">Five Star Hotel</p>
        </div>
    </div>
    <nav class="main-nav">
        <ul>
            <li><a href="<?= URLROOT ?>/home">Home</a></li>
            <li><a href="<?= URLROOT ?>/profile">Profile</a></li>
            <li><a href="<?= URLROOT ?>/reservation">Reservation</a></li>
            <li><a href="<?= URLROOT ?>/contact">Contacts</a></li>
            <li><a href="<?= URLROOT ?>/admin" style="color:var(--gold);">Admin</a></li>
        </ul>
    </nav>
</header>

<main class="page-content">

