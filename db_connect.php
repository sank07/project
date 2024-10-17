<?php
$host = 'localhost';
$db = 'ecommerce_db';  // Name of your database
$user = 'root';        // Default XAMPP MySQL user
$pass = '';            // By default, no password for root in XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
