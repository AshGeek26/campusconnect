<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Government | Campus Connect</title>
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
            background-color: var(--light-background);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-right: 20px;
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }

        .sidebar-logo i {
            font-size: 2rem;
            margin-right: 10px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 15px;
        }

        .sidebar-menu a {
            color: var(--text-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: var(--light-background);
        }

        .main-content {
            flex-grow: 1;
        }

        .student-gov-header {
            background-color: var(--primary-color);
            color: white;
            padding: 40px 20px;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 10px;
        }

        .student-gov-header h1 {
            margin-bottom: 10px;
        }

        .departments-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .department-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .department-card:hover {
            transform: translateY(-5px);
        }

        .department-card i {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

      
       
        
        .feedback-button {
        display: inline-flex; /* Align icon and text in a row */
        align-items: center;  /* Center the icon and text vertically */
        justify-content: center; /* Center the content horizontally */
        width: 100%;
        padding: 15px;
        background-color: var(--secondary-color);
        color: white;
        text-decoration: none; /* Remove underline for the link */
        font-size: 1rem;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .feedback-button:hover {
        background-color: #2980b9;
    }

    .feedback-button i {
        margin-right: 8px; /* Add space between the icon and text */
    }


        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                margin-bottom: 20px;
                position: static;
            }

            .departments-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar-logo">
                <i class="fas fa-university"></i>
                <h2>Campus Connect</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#" class="active"><i class="fas fa-university"></i> Student Government</a></li>
                <li><a href="#"><i class="fas fa-chart-pie"></i> Welfare</a></li>
                <li><a href="#"><i class="fas fa-money-bill-wave"></i> Finance</a></li>
                <li><a href="#"><i class="fas fa-bullhorn"></i> Outreach</a></li>
                <li><a href="#"><i class="fas fa-running"></i> Sports</a></li>
                <li><a href="#"><i class="fas fa-theater-masks"></i> Entertainment</a></li>
                <li><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
    
            </ul>
        </div>

        <div class="main-content">
            <div class="student-gov-header">
                <h1>Student Government</h1>
                <p>Empowering students, driving campus change, and representing your voice.</p>
            </div>

            <div class="departments-grid">
                <div class="department-card">
                    <i class="fas fa-chart-pie"></i>
                    <h3>Welfare</h3>
                    <p>Supporting student health, mental wellness, and campus resources.</p>
                </div>
                <div class="department-card">
                    <i class="fas fa-money-bill-wave"></i>
                    <h3>Finance</h3>
                    <p>Managing budget, allocations, and financial transparency.</p>
                </div>
                <div class="department-card">
                    <i class="fas fa-bullhorn"></i>
                    <h3>Outreach</h3>
                    <p>Building community connections and external partnerships.</p>
                </div>
                <div class="department-card">
                    <i class="fas fa-running"></i>
                    <h3>Sports</h3>
                    <p>Promoting athletic excellence and campus spirit.</p>
                </div>
                <div class="department-card">
                    <i class="fas fa-theater-masks"></i>
                    <h3>Entertainment</h3>
                    <p>Organizing campus events and cultural activities.</p>
                </div>
                <div class="department-card">
                    <i class="fas fa-globe"></i>
                    <h3>International</h3>
                    <p>Supporting and representing international student needs.</p>
                </div>
            </div>


            <div class="feedback-section">
                <h2>Have a Suggestion?</h2>
                <p>Your voice matters. Share your ideas, concerns, or feedback with the Student Government.</p>
                <a href="feedback.html" class="feedback-button">
                    <i class="fas fa-comment-dots"></i> Submit Feedback
                </a>
            </div>
            
        </div>
    </div>
</body>
</html>