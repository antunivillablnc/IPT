<?php
require_once 'config/database.php';
session_start();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = mysqli_prepare($conn, "SELECT user_id, name, email, password FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        $error = 'Email not found';
    } elseif (!password_verify($password, $user['password'])) {
        $error = 'Incorrect password';
    } else {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        header('Location: index.php');
        exit();
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moonlight Photos - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="static/css/auth.css" rel="stylesheet">
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

        .login-container {
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

        .login-btn {
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

        .login-btn:hover {
            background-color: #9DE0D9;
        }

        .signup-link {
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

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            font-size: 0.9rem;
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .notification.show {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 480px) {
            .login-container {
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
    <div class="login-container">
        <a href="index.php" class="close-btn" id="closeBtn">×</a>
        <img src="static/LOGO1.png" alt="Moonlight Photos" class="logo">
        <p class="tagline">Let's turn your moments<br>into magic under the moonlight!</p>
        <?php if ($error): ?>
            <div class="error-message" style="display:block; color:#ff4444; margin-bottom:1rem;"> <?php echo $error; ?> </div>
        <?php endif; ?>
        <form id="loginForm" method="POST" action="login.php">
            <div class="input-group">
                <label for="email">EMAIL*</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">PASSWORD*</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Log In</button>
            <a href="signup.php" class="signup-link">Don't have an account? Sign up</a>
        </form>
    </div>

    <div class="notification" id="notification">Successfully logged in!</div>
</body>
</html> 