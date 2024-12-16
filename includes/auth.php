<?php
session_start();

// Database connection (replace with your actual database connection details)
include('../config/db.php');  // Assuming you have a separate db_config.php for database settings

// Function to sanitize user input
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect the user input
    $username = sanitize_input($_POST['username']);
    $password = sanitize_input($_POST['password']);

    // Query to fetch the user from the database
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);  // Bind the username parameter to prevent SQL injection
        $stmt->execute();
        $stmt->store_result();

        // Check if a user with that username exists
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $db_username, $db_password);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $db_password)) {
                // Password is correct, start a session for the user
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $db_username;

                // Redirect to the dashboard or home page
                header("Location: dashboard.php");
                exit();
            } else {
                // Incorrect password
                $_SESSION['error_message'] = "Invalid password!";
                header("Location: login.php");
                exit();
            }
        } else {
            // User not found
            $_SESSION['error_message'] = "No user found with that username!";
            header("Location: login.php");
            exit();
        }

        $stmt->close();
    } else {
        // Database query error
        $_SESSION['error_message'] = "Database error!";
        header("Location: login.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
