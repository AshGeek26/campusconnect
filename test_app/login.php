<?php
session_start();
require 'auth.php';
?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Campus Connect</title>
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

        .login-container {
            width: 100%;
            max-width: 400px;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 40px;
            text-align: center;
        }

        .profile-icon {
            font-size: 4rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-remember {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-remember input[type="checkbox"] {
            margin-right: 10px;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #2ecc71;
        }

        .alternative-actions {
            margin-top: 20px;
            text-align: center;
        }

        .alternative-actions a {
            color: var(--secondary-color);
            text-decoration: none;
        }

        .alternative-actions p {
            margin-bottom: 10px;
        }

        .forgot-password {
            display: block;
            margin-top: 10px;
            color: var(--primary-color);
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="return-home">
        <a href="../index.php">
            <i class="fas fa-home"></i> Return to Homepage
        </a>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="profile-icon">
                <i class="fas fa-user-circle"></i>
            </div>

            <form action="#" method="post">
                <div class="form-group">
                    <label for="email">University Email</label>
                    <input type="email" id="email" name="email" placeholder="your.name@university.edu" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="form-remember">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me">Remember Me</label>
                </div>

                <button type="submit" class="login-btn">Login to Campus Connect</button>
            </form>
            <!-- Forgot password doesn't really work -->
            <div class="alternative-actions">
                <p>Don't have an account? <a href="signup.html">Sign Up</a></p>
                <a href="forgot-password.html" class="forgot-password">Forgot Password?</a>
            </div>
        </div>
    </div>
</body>
</html>
