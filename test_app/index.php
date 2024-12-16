<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Connect - Community News Platform</title>
    <link rel="stylesheet" href="#">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-background);
        }

        header {
            background-color: var(--primary-color);
            padding: 15px 40px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            list-style: none;
            color: white;
        }

        .nav-bar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav-bar a:hover {
            background-color: var(--secondary-color);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            text-align: center;
            padding: 100px 20px;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255,255,255,0.1);
            padding: 40px;
            border-radius: 15px;
        }

        .hero-content h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: white;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .cta-button {
            display: inline-block;
            background-color: var(--accent-color);
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .cta-button:hover {
            transform: scale(1.05);
            background-color: #2ecc71;
        }

        .features-section {
            padding: 60px 20px;
            background-color: white;
            text-align: center;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .feature-item {
            background-color: var(--light-background);
            padding: 30px;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .feature-item i {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul class="nav-bar">
                <li><a href="#">Home</a></li>
                <li><a href="newsFeed.php">News</a></li>
                <li><a href="studentGov.php">Student Gov</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="login.php"><i class="fas fa-user-circle"></i> Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <div class="hero-content">
                <h1>Campus Connect: Your Community, Your Voice</h1>
                <p>Stay informed, share your story, and connect with your entire campus community in one seamless platform.</p>
                <a href="views/signup.html" class="cta-button">Get Started</a>
            </div>
        </section>

        <section class="features-section">
            <h2>Why Campus Connect?</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-bullhorn"></i>
                    <h3>Real-Time Updates</h3>
                    <p>Get instant news and announcements from across campus.</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-users"></i>
                    <h3>Community Engagement</h3>
                    <p>Share stories, concerns, and connect with fellow students.</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-comment-dots"></i>
                    <h3>Easy Feedback</h3>
                    <p>Submit suggestions and feedback directly to campus leadership.</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Campus Connect. All rights reserved.</p>
        <div class="social-links">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>
</body>
</html>