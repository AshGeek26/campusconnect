<?php
// signup.php - User Registration
include 'includes/header.php';
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
        $stmt->execute([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
        ]);
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        $error = "Registration failed: " . $e->getMessage();
    }
}
?>

<div class="signup-container">
    <div class="signup-card">
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="signup.php" method="post">
        <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Enter your first name" required>
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" required>
                </div>


                <div class="form-group">
                    <label for="email">University Email</label>
                    <input type="email" id="email" name="email" placeholder="your.name@university.edu" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a strong password" required>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Repeat your password" required>
                </div>

                <button type="submit" class="signup-btn">Create Campus Connect Account</button>
        </form>
        <div class="switch-to-login">
                <p>Already have an account? <a href="login.html">Login</a></p>
        </div>
    </div>
</div>

<script>
        // Optional: Password match validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm-password');

        function validatePassword(){
            if(password.value != confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords Don't Match");
            } else {
                confirmPassword.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirmPassword.onkeyup = validatePassword;
</script>

<?php
include 'includes/footer.php';
?>
