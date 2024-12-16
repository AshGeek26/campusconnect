<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Campus Connect</title>
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

        .feedback-section {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .feedback-section h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input, 
        .form-group textarea, 
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }

        .submit-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #2ecc71;
        }

        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul class="nav-bar">
                <li><a href="../index.php">Home</a></li>
                <li><a href="newsFeed.html">News</a></li>
                <li><a href="studentGov.html">Student Gov</a></li>
                <li><a href="feedback.html" class="active">Feedback</a></li>
                <li><a href="login.html"><i class="fas fa-user-circle"></i> Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="feedback-section">
            <h1>Share Your Feedback</h1>
            <form id="feedbackForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="category">Feedback Category</label>
                    <select id="category" name="category" required>
                        <option value="">Select a Category</option>
                        <option value="campus-services">Campus Services</option>
                        <option value="academics">Academics</option>
                        <option value="student-life">Student Life</option>
                        <option value="facilities">Facilities</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Your Feedback</label>
                    <textarea id="message" name="message" required placeholder="Share your thoughts, suggestions, or concerns..."></textarea>
                </div>
                <button type="submit" class="submit-button">Submit Feedback</button>
            </form>
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

    <script>
        document.getElementById('feedbackForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your feedback! We will review it shortly.');
            this.reset();
        });
    </script>
</body>
</html>