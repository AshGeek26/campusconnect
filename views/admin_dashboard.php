<?php
session_start();
require_once '../config/db.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch real data from database
try {
    // Get total news posts
    $stmt = $pdo->query("SELECT COUNT(*) FROM news");
    $totalNews = $stmt->fetchColumn();

    // Get total users
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $totalUsers = $stmt->fetchColumn();

    // Get pending complaints
    $stmt = $pdo->query("SELECT COUNT(*) FROM feedback WHERE category = 'complaint'");
    $pendingComplaints = $stmt->fetchColumn();

    // Get recent activities
    $stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC LIMIT 3");
    $recentActivities = $stmt->fetchAll();

    // Get recent complaints
    $stmt = $pdo->query("SELECT * FROM feedback WHERE category = 'complaint' ORDER BY submitted_at DESC LIMIT 2");
    $recentComplaints = $stmt->fetchAll();

} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Campus Connect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    :root {
            --primary-color: #2c3e50;    /* Deep navy blue */
            --secondary-color: #3498db;  /* Bright blue */
            --accent-color: #27ae60;     /* Fresh green */
            --light-background: #ecf0f1; /* Light gray */
            --text-color: #333;
            --warning-color: #e74c3c;    /* Red for alerts */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-background);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
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
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: var(--secondary-color);
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: var(--light-background);
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .stat-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card i {
            font-size: 2rem;
            color: var(--secondary-color);
        }

        .recent-activities {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .activity-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .complaints-section {
            margin-top: 20px;
        }

        .complaint-card {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .complaint-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
        }

        .status-pending {
            background-color: #f39c12;
            color: white;
        }

        .status-resolved {
            background-color: var(--accent-color);
            color: white;
        }

        @media (max-width: 768px) {
            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 100%;
                position: static;
            }

            .dashboard-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">
            <i class="fas fa-newspaper"></i>
            <h2>Campus Connect</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="news_management.php"><i class="fas fa-newspaper"></i> News Management</a></li>
            <li><a href="user_management.php"><i class="fas fa-users"></i> User Management</a></li>
            <li><a href="feedback.php"><i class="fas fa-comment-dots"></i> Community Feedback</a></li>
            <li><a href="complaints.php"><i class="fas fa-flag"></i> Complaints</a></li>
            <li><a href="student_gov.php"><i class="fas fa-university"></i> Student Government</a></li>
            <li><a href="analytics.php"><i class="fas fa-chart-bar"></i> Analytics</a></li>
            <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="../config/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <div class="user-profile">
                <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                <i class="fas fa-user-circle"></i>
            </div>
        </div>

        <div class="dashboard-stats">
            <div class="stat-card">
                <div>
                    <h3>Total News Posts</h3>
                    <p><?php echo $totalNews; ?></p>
                </div>
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-card">
                <div>
                    <h3>Active Users</h3>
                    <p><?php echo $totalUsers; ?></p>
                </div>
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-card">
                <div>
                    <h3>Pending Complaints</h3>
                    <p><?php echo $pendingComplaints; ?></p>
                </div>
                <i class="fas fa-flag"></i>
            </div>
            <div class="stat-card">
                <div>
                    <h3>Student Government Updates</h3>
                    <p>8</p>
                </div>
                <i class="fas fa-university"></i>
            </div>
        </div>

        <div class="recent-activities">
            <h2>Recent Activities</h2>
            <?php foreach ($recentActivities as $activity): ?>
            <div class="activity-item">
                <span><?php echo htmlspecialchars($activity['title']); ?></span>
                <small><?php echo date('g:i a', strtotime($activity['created_at'])); ?></small>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="complaints-section">
            <h2>Recent Complaints</h2>
            <?php foreach ($recentComplaints as $complaint): ?>
            <div class="complaint-card">
                <div class="complaint-header">
                    <strong><?php echo htmlspecialchars($complaint['name']); ?></strong>
                    <span class="complaint-status status-pending">Pending</span>
                </div>
                <p><?php echo htmlspecialchars($complaint['message']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
