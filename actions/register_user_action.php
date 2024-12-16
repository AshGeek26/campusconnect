<?php


require_once '../config/db.php';

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form inputs
    $firstName = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
    $lastName = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validate inputs
    if (empty($firstName)) {
        $errors[] = "First name is required";
    }
    if (empty($lastName)) {
        $errors[] = "Last name is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        try {
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $errors[] = "Email already registered";
            } else {
                // Hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert new user
                $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, 'student')");
                $stmt->execute([$firstName, $lastName, $email, $hashedPassword]);
                
                $success = true;
                
                header("Location: ../views/login.php");
                
            }
        } catch (PDOException $e) {
            $errors[] = "Registration failed: " . $e->getMessage();
        }
    }
}
 
exit();


?>