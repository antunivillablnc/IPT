<?php
require_once 'config/database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards - Moonlight Photos</title>
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
            min-height: 100vh;
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

        .user-icon {
            width: 20px;
            height: 20px;
            margin-left: 0.5rem;
            vertical-align: middle;
        }

        /* Hero Banner */
        .hero-banner {
            background-color: #FF90BB;
            color: white;
            text-align: center;
            padding: 4rem 2rem;
            margin: 4rem auto;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            letter-spacing: 1px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            font-weight: 400;
            opacity: 0.95;
        }

        .become-member-btn {
            background-color: #B4F0E9;
            color: #333;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .become-member-btn:hover {
            background-color: #9DE0D9;
            transform: translateY(-2px);
        }

        /* Features Section */
        .features {
            padding: 5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
        }

        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            color: #333;
        }

        .feature-description {
            color: #666;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .points-list {
            list-style: none;
            text-align: left;
            margin-top: 1.2rem;
        }

        .points-list li {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: #555;
            font-size: 1rem;
            line-height: 1.5;
        }

        .points-list li::before {
            content: "•";
            color: #FF90BB;
            font-size: 1.8rem;
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

            .hero-banner {
                margin: 2rem 1rem;
                padding: 3rem 1.5rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }
        }

        /* Points View Overlay */
        .points-view {
            display: none;
            background-color: #FFF5F5;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 4rem auto;
            text-align: center;
        }

        .points-view.show {
            display: block;
        }

        .points-view h2 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .points-circle {
            width: 150px;
            height: 150px;
            background-color: #fff;
            border-radius: 50%;
            margin: 2rem auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .points-number {
            font-size: 3rem;
            font-weight: 600;
            color: #333;
            line-height: 1;
        }

        .points-label {
            font-size: 0.9rem;
            color: #666;
            margin-top: 0.5rem;
        }

        .points-info {
            margin: 2rem 0;
            text-align: center;
            color: #666;
        }

        .learn-more-link {
            color: #FF90BB;
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-block;
            margin-top: 1rem;
        }

        .learn-more-link:hover {
            text-decoration: underline;
        }

        .rewards-list {
            margin-top: 2rem;
            text-align: left;
        }

        .reward-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .reward-item:last-child {
            border-bottom: none;
        }

        .reward-info {
            color: #333;
        }

        .points-needed {
            color: #666;
            font-size: 0.9rem;
        }

        /* Hide rewards content when points view is shown */
        .rewards-content.hide {
            display: none;
        }

        .disabled {
     pointer-events: none !important;
     opacity: 0.6;
     cursor: not-allowed;
     user-select: none;
     text-decoration: none;
     color: #999 !important;
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

    <div class="points-view" id="pointsView">
        <h2>Rewards</h2>
        <p>Check out all of the rewards that are available to you.</p>
        
        <div class="points-circle">
            <span class="points-number">100</span>
            <span class="points-label">Total points earned</span>
        </div>
        
        <div class="points-info">
            <a href="#" class="learn-more-link" id="learnMoreLink">Learn how to earn more points</a>
        </div>

        <div class="rewards-list">
            <div class="reward-item">
                <span class="reward-info">1,000 points = ₱1,000 off the lowest priced item in cart</span>
                <span class="points-needed">900 points needed</span>
            </div>
            <div class="reward-item">
                <span class="reward-info">500 points = 50% off the lowest priced item in cart</span>
                <span class="points-needed">400 points needed</span>
            </div>
            <div class="reward-item">
                <span class="reward-info">300 points = 30% off the lowest priced item in cart</span>
                <span class="points-needed">200 points needed</span>
            </div>
            <div class="reward-item">
                <span class="reward-info">150 points = 15% off the lowest priced item in cart</span>
                <span class="points-needed">50 points needed</span>
            </div>
        </div>
    </div>

    <div class="rewards-content" id="rewardsContent">
        <!-- Hero Banner -->
        <section class="hero-banner">
            <h1 class="hero-title">Annyeong loyalty rewards</h1>
            <p class="hero-subtitle">Earn points and turn them into rewards</p>
            <a href="#" class="become-member-btn">Become a Member</a>
        </section>

        <!-- Features Section -->
        <section class="features">
            <!-- Sign Up Card -->
            <div class="feature-card">
                <div class="feature-icon">✨</div>
                <h2 class="feature-title">Sign Up</h2>
                <p class="feature-description">
                    Join our loyalty program today and start earning points with every interaction. It's completely free and takes just a minute to become a member!
                </p>
            </div>

            <!-- Earn Points Card -->
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h2 class="feature-title">Earn Points</h2>
                <ul class="points-list">
                    <li>Sign up to the site (100 points)</li>
                    <li>Share our FB Page (100 points)</li>
                    <li>Book a session (500 points)</li>
                    <li>Write a review (200 points)</li>
                    <li>Refer a friend (300 points)</li>
                </ul>
            </div>

            <!-- Redeem Rewards Card -->
            <div class="feature-card">
                <div class="feature-icon">🎁</div>
                <h2 class="feature-title">Redeem Rewards</h2>
                <ul class="points-list">
                    <li>200 points = Free 4R print</li>
                    <li>500 points = ₱500 discount</li>
                    <li>1000 points = Free mini session</li>
                    <li>2000 points = Premium package</li>
                    <li>3000 points = Full photoshoot</li>
                </ul>
            </div>
        </section>
    </div>

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
    <script>
        // Check if user is logged in
        const currentUser = JSON.parse(localStorage.getItem('currentUser'));
        const becomeMemberBtn = document.querySelector('.become-member-btn');
        const pointsView = document.getElementById('pointsView');
        const rewardsContent = document.getElementById('rewardsContent');
        const learnMoreLink = document.getElementById('learnMoreLink');

        if (currentUser) {
            // Update button text
            becomeMemberBtn.textContent = 'View Points';
            
            // Add click handler for View Points button
            becomeMemberBtn.addEventListener('click', (e) => {
                e.preventDefault();
                pointsView.classList.add('show');
                rewardsContent.classList.add('hide');
            });

            // Add click handler for Learn More link
            learnMoreLink.addEventListener('click', (e) => {
                e.preventDefault();
                pointsView.classList.remove('show');
                rewardsContent.classList.remove('hide');
            });
        }

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