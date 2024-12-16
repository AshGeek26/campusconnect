<?php
session_start();
session_destroy();
header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout | Campus Connect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;    /* Deep navy blue */
            --secondary-color: #3498db;  /* Bright blue */
            --accent-color: #27ae60;     /* Fresh green */
            --light-background: #ecf0f1; /* Light gray */
            --text-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .return-home {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .return-home a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
        }

        .logout-container {
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 40px;
            text-align: center;
        }

        .logout-icon {
            font-size: 4rem;
            color: var(--accent-color);
            margin-bottom: 20px;
        }

        .logout-message {
            color: var(--text-color);
            margin-bottom: 30px;
        }

        .logout-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .btn-login {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-login:hover {
            background-color: #2980b9;
        }

        .btn-home {
            background-color: var(--accent-color);
            color: white;
        }

        .btn-home:hover {
            background-color: #2ecc71;
        }

        @media (max-width: 480px) {
            .logout-container {
                padding: 20px;
            }

            .logout-actions {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="return-home">
        <a href="index.php">
            <i class="fas fa-home"></i> Return to Homepage
        </a>
    </div>

    <div class="logout-container">
        <div class="logout-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        
        <div class="logout-message">
            <h2>You have been successfully logged out</h2>
            <p>Thank you for using Campus Connect. We hope to see you again soon!</p>
        </div>

        <div class="logout-actions">
            <a href="login.html" class="btn btn-login">
                <i class="fas fa-sign-in-alt"></i> Log In Again
            </a>
            <a href="../index.php" class="btn btn-home">
                <i class="fas fa-home"></i> Go to Homepage
            </a>
        </div>
    </div>
</body>
</html>