<?php
require_once 'config/database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Late, Rescheduling and Cancellation Policy - Moonlight Photos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="static/css/auth.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #FFF5F5;
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
        }

        .nav-links a:hover {
            color: #6e7bb8;
        }

        /* Policy Content */
        .policy-container {
            max-width: 800px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .policy-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 2rem;
            text-align: center;
        }

        .policy-intro {
            color: #666;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .policy-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .policy-list {
            list-style: none;
        }

        .policy-list li {
            color: #666;
            line-height: 1.6;
            margin-bottom: 0.5rem;
            padding-left: 1.5rem;
            position: relative;
        }

        .policy-list li::before {
            content: "•";
            position: absolute;
            left: 0;
            color: #666;
        }

        .thank-you {
            color: #666;
            line-height: 1.6;
            margin-top: 2rem;
        }

        /* Events Section */
        .events-section {
            background-color: #efb4b4;
            padding: 3rem 2rem;
            text-align: center;
            color: white;
        }

        .events-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .events-subtitle {
            font-size: 1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .learn-more-btn {
            background-color: #B4F0E9;
            color: #333;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .learn-more-btn:hover {
            background-color: #9DE0D9;
            transform: translateY(-2px);
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
            width: 24px;
            height: 24px;
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

            .policy-container {
                padding: 0 1.5rem;
            }

            .policy-title {
                font-size: 1.75rem;
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
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }

        .notification.show {
            display: block;
            animation: fadeInOut 3s ease-in-out;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; }
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
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="gift-card.php">Gift Card</a>
                <a href="book-now.php">Book Now</a>
            <?php else: ?>
                <span class="disabled">Gift Card</span>
                <span class="disabled">Book Now</span>
            <?php endif; ?>
            <div id="authLinks">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-menu" id="userMenu">
                        <span class="user-name" id="userName"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
                        <div class="user-menu-content" id="userMenuContent">
                            <a href="logout.php" class="logout-btn">Log out</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php" id="loginLink">Log in</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="notification" id="notification">Successfully logged in!</div>

    <div class="policy-container">
        <h1 class="policy-title">Late, Rescheduling and Cancellation Policy</h1>
        
        <p class="policy-intro">
            We want every client to enjoy a smooth, fun, and hassle-free experience at our studio. To make this possible, we kindly ask that you take a moment to review and follow our policies. Please understand that delays with one session can affect the next. Let's help each other by respecting everyone's scheduled time.
        </p>

        <div class="policy-section">
            <h2 class="section-title">Rescheduling & Cancellation Policy</h2>
            <ul class="policy-list">
                <li>Rescheduling is FREE as long as it's done at least 3 days before your reserved time slot.</li>
                <li>Within the lock-in period (less than 3 days before your booking):
                    <ul>
                        <li>A rescheduling fee of Php 375 will apply.</li>
                        <li>Free rebooking or refunds will not be granted.</li>
                    </ul>
                </li>
                <li>Cancellations made at least 3 days in advance will be charged a Php 320 cancellation fee.</li>
                <li>No-shows (clients who do not arrive for their scheduled session) are not eligible for refunds or rebooking.</li>
            </ul>
        </div>

        <div class="policy-section">
            <h2 class="section-title">Late Policy</h2>
            <ul class="policy-list">
                <li>We start the timer exactly at your scheduled time.</li>
                <li>If you arrive late, you may use only the remaining time of your package.</li>
                <li>Clients arriving 10 minutes or more late will not be accommodated.
                    <ul>
                        <li>Rescheduling on the same day may be allowed only if there is an available slot.</li>
                    </ul>
                </li>
                <li>To avoid delays or missed sessions, please arrive 5-10 minutes early.</li>
            </ul>
        </div>

        <p class="thank-you">Thank you for your cooperation—we can't wait to welcome you!</p>
    </div>

    <section class="events-section">
        <h2 class="events-title">and hey, we also do events.</h2>
        <p class="events-subtitle">We're bringing the Annyeong Experience to your events with Booths by Annyeong Studio.</p>
        <a href="#" class="learn-more-btn">LEARN MORE</a>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <img src="static/MOONLIGHT-removebg-preview.png" alt="Moonlight Photos" class="footer-logo">
                <div class="social-icons">
                    <a href="#" title="Facebook">
                        <img src="static/facebook.jpg" alt="Facebook">
                    </a>
                    <a href="#" title="Instagram">
                        <img src="static/instagram.jpg" alt="Instagram">
                    </a>
                    <a href="#" title="TikTok">
                        <img src="static/tiktok.jpg" alt="TikTok">
                    </a>
                    <a href="#" title="Pinterest">
                        <img src="static/pinterest1.jpg" alt="Pinterest">
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var userMenu = document.getElementById('userMenu');
        var userMenuContent = document.getElementById('userMenuContent');
        if (userMenu && userMenuContent) {
            userMenu.addEventListener('click', function(e) {
                e.stopPropagation();
                userMenuContent.classList.toggle('show');
            });
            document.addEventListener('click', function() {
                userMenuContent.classList.remove('show');
            });
        }
    });
    </script>
</body>
</html> 