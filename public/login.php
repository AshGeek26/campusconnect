<?php
// login.php - User Login
include '../includes/header.php';
include '../config/db.php';
include '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Start session and redirect user
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: newsFeed.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<div class="login-container">
    <div class="login-card">
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="login.php" method="post">
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
    </div>
</div>

<?php
include '../includes/footer.php';
?>
