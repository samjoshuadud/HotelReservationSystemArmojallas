<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hotel_reservation');

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            // Connect without selecting a DB first
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";charset=utf8",
                DB_USER,
                DB_PASS,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );

            // Create DB if not exists
            $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8 COLLATE utf8_general_ci");
            $pdo->exec("USE " . DB_NAME);

            // Create tables
            $pdo->exec("CREATE TABLE IF NOT EXISTS reservations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                customer_name VARCHAR(100) NOT NULL,
                contact_number VARCHAR(20) NOT NULL,
                date_reserved DATETIME NOT NULL,
                from_date DATE NOT NULL,
                to_date DATE NOT NULL,
                room_type ENUM('Regular', 'De Luxe', 'Suite') NOT NULL,
                room_capacity ENUM('Single', 'Double', 'Family') NOT NULL,
                payment_type ENUM('Cash', 'Cheque', 'Credit Card') NOT NULL,
                num_days INT NOT NULL,
                rate_per_day DECIMAL(10,2) NOT NULL,
                sub_total DECIMAL(10,2) NOT NULL,
                discount DECIMAL(10,2) NOT NULL DEFAULT 0,
                total_bill DECIMAL(10,2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");

            $pdo->exec("CREATE TABLE IF NOT EXISTS admin_users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");

            // default admin credentials (admin / admin123)
            $count = $pdo->query("SELECT COUNT(*) FROM admin_users")->fetchColumn();
            if ($count == 0) {
                $hash = password_hash('admin123', PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO admin_users (username, password) VALUES ('admin', ?)");
                $stmt->execute([$hash]);
            }

        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }
    return $pdo;
}
?>
