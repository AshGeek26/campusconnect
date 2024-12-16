<?php
// header.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Connect</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<header>
    <nav>
        <ul class="nav-bar">
            <li><a href="index.php">Home</a></li>
            <li><a href="newsFeed.php">News</a></li>
            <li><a href="studentGov.php">Student Gov</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php"><i class="fas fa-user-circle"></i> Logout</a></li>
            <?php else: ?>
                <li><a href="login.php"><i class="fas fa-user-circle"></i> Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
