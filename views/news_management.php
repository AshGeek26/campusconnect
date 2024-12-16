<?php
session_start();
require_once '../config/db.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                if (isset($_POST['title']) && isset($_POST['content'])) {
                    try {
                        $stmt = $pdo->prepare("INSERT INTO news (title, content, author_id, created_at) VALUES (?, ?, ?, NOW())");
                        $stmt->execute([
                            $_POST['title'],
                            $_POST['content'],
                            $_SESSION['user_id']
                        ]);
                        $_SESSION['success'] = "News post created successfully!";
                    } catch (PDOException $e) {
                        $_SESSION['error'] = "Error creating news post: " . $e->getMessage();
                    }
                }
                break;

            case 'update':
                if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content'])) {
                    try {
                        $stmt = $pdo->prepare("UPDATE news SET title = ?, content = ?, updated_at = NOW() WHERE id = ?");
                        $stmt->execute([
                            $_POST['title'],
                            $_POST['content'],
                            $_POST['id']
                        ]);
                        $_SESSION['success'] = "News post updated successfully!";
                    } catch (PDOException $e) {
                        $_SESSION['error'] = "Error updating news post: " . $e->getMessage();
                    }
                }
                break;

            case 'delete':
                if (isset($_POST['id'])) {
                    try {
                        $stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
                        $stmt->execute([$_POST['id']]);
                        $_SESSION['success'] = "News post deleted successfully!";
                    } catch (PDOException $e) {
                        $_SESSION['error'] = "Error deleting news post: " . $e->getMessage();
                    }
                }
                break;
        }
        header("Location: news_management.php");
        exit();
    }
}

// Fetch all news posts
try {
    $stmt = $pdo->query("SELECT n.*, u.first_name as author_name 
                         FROM news n 
                         LEFT JOIN users u ON n.author_id = u.id 
                         ORDER BY created_at DESC");
    $news = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = "Error fetching news: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Management | Campus Connect</title>
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
        .news-form {
            margin-bottom: 2rem;
            padding: 1rem;
            background: #f5f5f5;
            border-radius: 8px;
        }
        .news-list {
            display: grid;
            gap: 1rem;
        }
        .news-item {
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .button-group {
            display: flex;
            gap: 0.5rem;
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
            <li><a href="admin_dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
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
            <h1>News Management</h1>
            <div class="user-profile">
                <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                <i class="fas fa-user-circle"></i>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <div class="news-form">
            <h2>Create New Post</h2>
            <form method="POST" action="news_management.php">
                <input type="hidden" name="action" value="create">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea id="content" name="content" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>

        <div class="news-list">
            <h2>All News Posts</h2>
            <?php foreach ($news as $post): ?>
                <div class="news-item">
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p><?php echo htmlspecialchars($post['content']); ?></p>
                    <div class="news-meta">
                        <small>
                            Posted by <?php echo htmlspecialchars($post['author_name']); ?> 
                            on <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                        </small>
                    </div>
                    <div class="button-group">
                        <button class="btn btn-edit" onclick="editPost(<?php echo $post['id']; ?>)">
                            Edit
                        </button>
                        <form method="POST" action="news_management.php" style="display: inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                            <button type="submit" class="btn btn-delete" 
                                    onclick="return confirm('Are you sure you want to delete this post?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function editPost(id) {
            // You can implement a modal or redirect to an edit page
            // This is a basic example that uses prompt
            const newTitle = prompt("Enter new title:");
            const newContent = prompt("Enter new content:");
            
            if (newTitle && newContent) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'news_management.php';
                
                const fields = {
                    'action': 'update',
                    'id': id,
                    'title': newTitle,
                    'content': newContent
                };
                
                for (const [key, value] of Object.entries(fields)) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = value;
                    form.appendChild(input);
                }
                
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
