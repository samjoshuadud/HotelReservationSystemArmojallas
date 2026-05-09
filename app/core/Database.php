<?php

class Database {
    private static $instance = null;
    private $pdo;

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'hotel_reservation';

    private function __construct() {
        try {
            // Initial connection to check/create database
            $this->pdo = new PDO("mysql:host=$this->host", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS $this->dbname CHARACTER SET utf8 COLLATE utf8_general_ci");
            $this->pdo->exec("USE $this->dbname");

            // Re-initialize with DB selected
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $this->createTables();
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }

    private function createTables() {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS reservations (
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

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS admin_users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        $count = $this->pdo->query("SELECT COUNT(*) FROM admin_users")->fetchColumn();
        if ($count == 0) {
            $hash = password_hash('admin123', PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("INSERT INTO admin_users (username, password) VALUES ('admin', ?)");
            $stmt->execute([$hash]);
        }
    }
}
