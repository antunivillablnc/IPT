<?php
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Self Shoot - Moonlight Photos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="static/css/auth.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #fff;
        }

        /* Navigation */
        .nav {
            background-color: #efb4b4;
            padding: 1.5rem 4rem;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
        }

        .logo {
            text-decoration: none;
            flex-shrink: 0;
        }

        .logo img {
            height: 90px;
            width: auto;
            vertical-align: middle;
        }

        .nav-links {
            display: flex;
            gap: 3rem;
            align-items: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .nav-links a {
            color: #4a4a4a;
            text-decoration: none;
            font-weight: 400;
            font-size: 1rem;
            transition: color 0.2s ease;
            white-space: nowrap;
        }

        .nav-links a:hover {
            color: #6e7bb8;
        }

        /* Main Content */
        .main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            text-align: center;
        }

        .title {
            color: #ff7f7f;
            font-size: 2.5rem;
            margin: 3rem 0;
            font-weight: 700;
        }

        .branch-select {
            text-align: left;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            color: #4a4a4a;
        }

        .branch-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
            position: relative;
        }

        .branch-grid::after {
            content: '';
            position: absolute;
            top: 5%;
            bottom: 5%;
            left: 50%;
            width: 1px;
            background-color: #e0e0e0;
            transform: translateX(-50%);
        }

        .branch-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
            padding: 0.5rem;
        }

        .branch-card:hover {
            transform: translateY(-5px);
        }

        .branch-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .branch-name {
            padding: 1rem;
            font-size: 1.2rem;
            font-weight: 600;
            color: #4a4a4a;
        }

        /* Footer */
        .footer {
            background: #FFFCF6;
            padding: 3rem 2rem;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 2rem;
        }

        .footer-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 1.5rem;
        }

        .footer-logo {
            width: 200px;
            height: auto;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
        }

        .social-icons a {
            text-decoration: none;
        }

        .social-icons img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .footer-right {
            text-align: right;
        }

        .branch-info {
            margin-bottom: 1.5rem;
        }

        .branch-info h3 {
            color: #000;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .branch-info p {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .copyright {
            text-align: center;
            color: #000;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        @media (max-width: 1024px) {
            .nav {
                padding: 1rem 2rem;
            }

            .nav-links {
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                padding: 1rem;
                gap: 1rem;
            }

            .nav-links {
                position: static;
                transform: none;
                flex-wrap: wrap;
                justify-content: center;
                gap: 1.5rem;
            }

            .logo img {
                height: 70px;
            }

            .nav-links a {
                font-size: 0.9rem;
            }

            .footer-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .footer-left {
                align-items: center;
            }

            .footer-right {
                text-align: center;
            }

            .branch-grid::after {
                display: none;
            }

            .branch-card {
                border-bottom: 1px solid #e0e0e0;
                padding-bottom: 2rem;
                margin-bottom: 2rem;
            }

            .branch-card:last-child {
                border-bottom: none;
                padding-bottom: 0;
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <a href="index.php" class="logo">
            <img src="static/LOGO1.png" alt="Moonlight Photos Logo" />
        </a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="faq.php">FAQ</a>
            <a href="rewards.php">Rewards</a>
            <a href="gift-card.php">Gift Card</a>
            <a href="book-now.php">Book Now</a>
            <div id="authLinks">
                <a href="login.php" id="loginLink">Log in</a>
            </div>
        </div>
    </nav>

    <div class="notification" id="notification">Successfully logged in!</div>

    <main class="main">
        <h1 class="title">BOOK YOUR SELF SHOOT</h1>
        <h2 class="branch-select">Select a Branch</h2>

        <div class="branch-grid">
            <div class="branch-card" onclick="window.location.href = 'tanauan.php';" style="cursor: pointer;">
                <img src="static\Tanauan.jpg" 
                     alt="Victory Mall & Market Tanauan" 
                     class="branch-image">
                <div class="branch-name">TANAUAN CITY</div>
            </div>

            <div class="branch-card" onclick="window.location.href = 'sto-tomas.php';" style="cursor: pointer;">
                <img src="static\SM STO..jpg" 
                     alt="SM Sto. Tomas" 
                     class="branch-image">
                <div class="branch-name">STO. TOMAS CITY</div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <img src="static\MOONLIGHT-removebg-preview.png" alt="Moonlight Photos" class="footer-logo">
                <div class="social-icons">
                    <a href="#" title="Facebook">
                        <img src="static\facebook.jpg" alt="Facebook">
                    </a>
                    <a href="#" title="Instagram">
                        <img src="static\instagram.jpg" alt="Instagram">
                    </a>
                    <a href="#" title="TikTok">
                        <img src="static\tiktok.jpg" alt="TikTok">
                    </a>
                    <a href="#" title="Pinterest">
                        <img src="static\pinterest1.jpg" alt="Pinterest">
                    </a>
                </div>
            </div>
            <div class="footer-right">
                <div class="branch-info">
                    <h3>Tanauan City Branch</h3>
                    <p>A. Mabini Ave, Población 7,<br>
                    Tanauan City, Batangas<br>
                    0927 148 6528</p>
                </div>
                <div class="branch-info">
                    <h3>Sto. Tomas City Branch</h3>
                    <p>20 Pan-Philippine Hwy,<br>
                    Sto. Tomas City, Batangas<br>
                    0906 073 4325</p>
                </div>
            </div>
        </div>
        <div class="copyright">© Moonlight Photos 2025</div>
    </footer>

    <script src="static/js/auth.js"></script>
</body>
</html> 