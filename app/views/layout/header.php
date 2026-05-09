<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['page_title'] ?? "Darrel & Ayien's Five Star Hotel" ?></title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="/HotelReservationSystemArmojallasRunes/assets/css/style.css">
</head>
<body>

<header>
    <nav class="navbar">
        <div class="nav-container">
            <a href="/HotelReservationSystemArmojallasRunes/public/home" class="nav-logo">
                <em>D&amp;A</em> Hotel
            </a>
            <ul class="nav-links">
                <li><a href="/HotelReservationSystemArmojallasRunes/public/home">Home</a></li>
                <li><a href="/HotelReservationSystemArmojallasRunes/public/profile">Profile</a></li>
                <li><a href="/HotelReservationSystemArmojallasRunes/public/reservation">Reservation</a></li>
                <li><a href="/HotelReservationSystemArmojallasRunes/public/contact">Contacts</a></li>
                <li><a href="/HotelReservationSystemArmojallasRunes/public/admin" class="nav-admin-link">Admin</a></li>
            </ul>
        </div>
    </nav>
</header>

<main class="container">
