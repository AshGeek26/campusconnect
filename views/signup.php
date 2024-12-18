
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Campus Connect</title>
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
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .return-home {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .return-home a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
        }

        .signup-container {
            width: 100%;
            max-width: 500px;
        }

        .signup-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 40px;
            text-align: center;
        }

        .profile-icon {
            font-size: 4rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }

        .signup-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .signup-btn:hover {
            background-color: #2ecc71;
        }

        .switch-to-login {
            margin-top: 20px;
            text-align: center;
        }

        .switch-to-login a {
            color: var(--secondary-color);
            text-decoration: none;
        }


        @media (max-width: 480px) {
            .signup-card {
                padding: 20px;
            }
        }
        .error-message {
            color: #e74c3c;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #fde8e8;
        }
        .success-message {
            color: #27ae60;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #e8f8e8;
        }
    </style>
</head>


<body>
    <div class="return-home">
        <a href="../index.php">
            <i class="fas fa-home"></i> Return to Homepage
        </a>
    </div>

    <div class="signup-container">
        <div class="signup-card">
            <div class="profile-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            
            

            

            
                <form action="../actions/register_user_action.php" method="post" >
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" 
                               value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>"
                               placeholder="Enter your first name" required>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname"
                               value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>"
                               placeholder="Enter your last name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">University Email</label>
                        <input type="email" id="email" name="email"
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                               placeholder="your.name@university.edu" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" 
                               placeholder="Create a strong password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" 
                               placeholder="Repeat your password" required>
                    </div>

                    <button type="submit" class="signup-btn">Create Campus Connect Account</button>
                </form>


            <div class="switch-to-login">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

    <script>
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
</body>
</html>
