<?php
session_start();
require_once '../config/db.php';

$errors = [];


// // Check if user is already logged in
// if (isset($_SESSION['user_id'])) {
//     if ($_SESSION['user_role'] === 'admin') {
//         header("Location: views/admin_dashboard.php");
//     } else {
//         header("Location: ../index.php"); // Regular users go to homepage
//     }
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];
    $remember = isset($_POST['remember-me']);

    // Validate inputs
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // If no validation errors, attempt login
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT id, first_name, last_name, email, password, role FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($user = $stmt->fetch()) {
                if (password_verify($password, $user['password'])) {
                    // Set session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_role'] = $user['role'];
                    $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];

                    // Handle Remember Me
                    if ($remember) {
                        $token = bin2hex(random_bytes(32));
                        setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/');
                        
                        $stmt = $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
                        $stmt->execute([$token, $user['id']]);
                    }

                    // Redirect based on role
                    if ($user['role'] === 'admin') {
                        header("Location: ../views/admin_dashboard.php");
                    } else {
                        header("Location: ../index.php"); // Regular users go to homepage
                    }
                    exit();
                } else {
                    $errors[] = "Invalid email or password";
                }
            } else {
                $errors[] = "Invalid email or password";
            }
        } catch (PDOException $e) {
            $errors[] = "Login failed: " . $e->getMessage();
        }
    }
}
?>