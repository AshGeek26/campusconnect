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
                if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
                    try {
                        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())");
                        $stmt->execute([
                            $_POST['username'],
                            $_POST['email'],
                            $hashedPassword,
                            $_POST['role']
                        ]);
                        $_SESSION['success'] = "User created successfully!";
                    } catch (PDOException $e) {
                        $_SESSION['error'] = "Error creating user: " . $e->getMessage();
                    }
                }
                break;

            case 'update':
                if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['role'])) {
                    try {
                        $sql = "UPDATE users SET username = ?, email = ?, role = ?";
                        $params = [$_POST['username'], $_POST['email'], $_POST['role']];

                        // Only update password if a new one is provided
                        if (!empty($_POST['password'])) {
                            $sql .= ", password = ?";
                            $params[] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        }

                        $sql .= " WHERE id = ?";
                        $params[] = $_POST['id'];

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($params);
                        $_SESSION['success'] = "User updated successfully!";
                    } catch (PDOException $e) {
                        $_SESSION['error'] = "Error updating user: " . $e->getMessage();
                    }
                }
                break;

            case 'delete':
                if (isset($_POST['id'])) {
                    try {
                        // Don't allow admin to delete themselves
                        if ($_POST['id'] == $_SESSION['user_id']) {
                            throw new Exception("You cannot delete your own account!");
                        }
                        
                        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                        $stmt->execute([$_POST['id']]);
                        $_SESSION['success'] = "User deleted successfully!";
                    } catch (Exception $e) {
                        $_SESSION['error'] = $e->getMessage();
                    }
                }
                break;
        }
        header("Location: user_management.php");
        exit();
    }
}

// Fetch all users
try {
    $stmt = $pdo->query("SELECT id, username, email, role, created_at, last_login FROM users ORDER BY created_at DESC");
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = "Error fetching users: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | Campus Connect</title>
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
        .user-form {
            margin-bottom: 2rem;
            padding: 1rem;
            background: #f5f5f5;
            border-radius: 8px;
        }
        .user-list {
            display: grid;
            gap: 1rem;
        }
        .user-item {
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .role-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
        }
        .role-admin { background: #dc3545; color: white; }
        .role-user { background: #28a745; color: white; }
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
            <li><a href="student_gov.php"><i class="fas fa-university"></i> Student Government</a></li>
            <li><a href="analytics.php"><i class="fas fa-chart-bar"></i> Analytics</a></li>
            <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="dashboard-header">
            <h1>User Management</h1>
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

        <div class="user-form">
            <h2>Create New User</h2>
            <form method="POST" action="user_management.php">
                <input type="hidden" name="action" value="create">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create User</button>
            </form>
        </div>

        <div class="user-list">
    <h2>All Users</h2>
    <?php foreach ($users as $user): ?>
        <div class="user-item">
            <div class="user-header">
                <h3><?php echo htmlspecialchars($user['username']); ?></h3>
                <span class="role-badge role-<?php echo $user['role']; ?>">
                    <?php echo ucfirst(htmlspecialchars($user['role'])); ?>
                </span>
            </div>
            <div class="user-details">
                <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                <p>Created: <?php echo htmlspecialchars($user['created_at']); ?></p>
                <?php if ($user['last_login']): ?>
                    <p>Last Login: <?php echo htmlspecialchars($user['last_login']); ?></p>
                <?php endif; ?>
            </div>
            <div class="user-actions">
                <form method="POST" action="user_management.php">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <button type="submit" class="btn btn-edit">Edit</button>
                </form>
                <form method="POST" action="user_management.php">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <button type="submit" class="btn btn-delete">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>