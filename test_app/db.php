<?php
$host = 'localhost';
$db   = 'campus_connect';
$user = 'root'; // default XAMPP MySQL user
$pass = '';     // default XAMPP MySQL user password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>