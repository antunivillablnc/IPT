<?php
require_once 'config/database.php';

// Initialize error messages
$firstname_error = $lastname_error = $email_error = $password_error = $confirm_password_error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = sanitize_input($_POST['firstname'] ?? '');
    $lastname = sanitize_input($_POST['lastname'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Validation
    if (strlen($firstname) < 2) {
        $firstname_error = 'First name must be at least 2 characters long';
    }
    if (strlen($lastname) < 2) {
        $lastname_error = 'Last name must be at least 2 characters long';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = 'Please enter a valid email address';
    }
    if (strlen($password) < 6) {
        $password_error = 'Password must be at least 6 characters long';
    }
    if ($password !== $confirmPassword) {
        $confirm_password_error = 'Passwords do not match';
    }

    // Check if email already exists
    if (empty($email_error)) {
        $stmt = mysqli_prepare($conn, "SELECT user_id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $email_error = 'Email already exists';
        }
        mysqli_stmt_close($stmt);
    }

    // If no errors, insert into database
    if (empty($firstname_error) && empty($lastname_error) && empty($email_error) && empty($password_error) && empty($confirm_password_error)) {
        $name = $firstname . ' ' . $lastname;
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);
        if (mysqli_stmt_execute($stmt)) {
            $success = true;
            header('Location: login.php?signup=success');
            exit();
        } else {
            $email_error = 'Registration failed. Please try again.';
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moonlight Photos - Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #FFE4E4;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .signup-container {
            position: relative;
            background-color: #fff;
            padding: 2.5rem 2rem;
            width: 90%;
            max-width: 500px;
            text-align: center;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #000;
            z-index: 10;
            text-decoration: none;
            padding: 5px 10px;
        }

        .logo {
            width: 150px;
            margin-bottom: 1rem;
        }

        .tagline {
            color: #FF6B6B;
            font-size: 1.3rem;
            margin-bottom: 2rem;
            line-height: 1.5;
            font-weight: 600;
        }

        .input-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.3rem;
            color: #000;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .input-group input {
            width: 100%;
            padding: 0.8rem;
            border: none;
            background-color: #FFE4E4;
            font-size: 0.9rem;
            color: #333;
        }

        .signup-btn {
            background-color: #B4F0E9;
            color: #000;
            border: none;
            padding: 0.8rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 1.5rem;
        }

        .signup-btn:hover {
            background-color: #9DE0D9;
        }

        .login-link {
            margin-top: 1rem;
            color: #FF6B6B;
            text-decoration: none;
            font-size: 0.9rem;
            display: block;
        }

        .error-message {
            color: #ff4444;
            font-size: 0.85rem;
            margin-top: 0.3rem;
            display: none;
        }

        @media (max-width: 480px) {
            .signup-container {
                padding: 2rem 1.5rem;
                width: 95%;
            }

            .logo {
                width: 130px;
            }
            
            .tagline {
                font-size: 1.15rem;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <a href="index.php" class="close-btn">×</a>
        <img src="static/LOGO1.png" alt="Moonlight Photos" class="logo">
        <p class="tagline">Join us and create magical moments!</p>
        <?php if ($success): ?>
            <div style="color: green; margin-bottom: 1rem;">Registration successful! Redirecting to login...</div>
        <?php endif; ?>
        <form id="signupForm" method="POST" action="signup.php">
            <div class="input-group">
                <label for="firstname">FIRSTNAME*</label>
                <input type="text" id="firstname" name="firstname" required value="<?php echo htmlspecialchars($_POST['firstname'] ?? ''); ?>">
                <?php if ($firstname_error): ?><div class="error-message" style="display:block;"><?php echo $firstname_error; ?></div><?php endif; ?>
            </div>
            <div class="input-group">
                <label for="lastname">LASTNAME*</label>
                <input type="text" id="lastname" name="lastname" required value="<?php echo htmlspecialchars($_POST['lastname'] ?? ''); ?>">
                <?php if ($lastname_error): ?><div class="error-message" style="display:block;"><?php echo $lastname_error; ?></div><?php endif; ?>
            </div>
            <div class="input-group">
                <label for="email">EMAIL*</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                <?php if ($email_error): ?><div class="error-message" style="display:block;"><?php echo $email_error; ?></div><?php endif; ?>
            </div>
            <div class="input-group">
                <label for="password">PASSWORD*</label>
                <input type="password" id="password" name="password" required>
                <?php if ($password_error): ?><div class="error-message" style="display:block;"><?php echo $password_error; ?></div><?php endif; ?>
            </div>
            <div class="input-group">
                <label for="confirmPassword">CONFIRM PASSWORD*</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <?php if ($confirm_password_error): ?><div class="error-message" style="display:block;"><?php echo $confirm_password_error; ?></div><?php endif; ?>
            </div>
            <button type="submit" class="signup-btn">Sign Up</button>
            <a href="login.php" class="login-link">Already have an account? Log in</a>
        </form>
    </div>
</body>
</html>