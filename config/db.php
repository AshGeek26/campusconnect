<?php
// db.php - Database connection
$host = 'localhost';
$db = 'campus_connect';
$user = 'root'; // Change if using a different DB user
$pass = '';     // Add your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
