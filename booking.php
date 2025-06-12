<?php
require_once 'config/database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form - Moonlight Photos</title>
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

        /* Main Content */
        .main-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            color: #333;
            text-decoration: none;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }

        .back-link img {
            width: 24px;
            height: 24px;
            margin-right: 0.5rem;
        }

        .page-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 2rem;
        }

        /* Booking Form */
        .booking-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .booking-form {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #666;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .form-input:focus {
            outline: none;
            border-color: #efb4b4;
        }

        .backdrop-section {
            margin-top: 2rem;
        }

        .backdrop-info {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .backdrop-list {
            list-style: none;
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .backdrop-list li {
            margin-bottom: 0.5rem;
        }

        .backdrop-note {
            color: #666;
            font-style: italic;
            font-size: 0.8rem;
        }

        .booking-details {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .details-title {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .details-item {
            margin-bottom: 1rem;
        }

        .details-label {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .details-value {
            color: #333;
            font-weight: 500;
        }

        .total-section {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .total-price {
            font-size: 1.5rem;
            color: #333;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .book-now-btn {
            width: 100%;
            padding: 1rem;
            background: #B4E0D9;
            border: none;
            border-radius: 25px;
            color: #333;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .book-now-btn:hover {
            background: #9ED3CC;
        }

        .policy-link {
            color: #efb4b4;
            text-decoration: none;
        }

        .policy-link:hover {
            text-decoration: underline;
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

        @media (max-width: 768px) {
            .booking-container {
                grid-template-columns: 1fr;
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

    <div class="main-container">
        <a href="#" class="back-link" onclick="history.back(); return false;">
            <img src="static/back icon.png" alt="Back">
            Back
        </a>

        <h1 class="page-title">Booking Form</h1>

        <div class="booking-container">
            <div class="booking-form">
                <div class="form-group">
                    <label class="form-label">Name *</label>
                    <input type="text" class="form-input" required placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" class="form-input" required placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" class="form-input" placeholder="Enter your phone number">
                </div>

                <div class="backdrop-section">
                    <label class="form-label">Choose your preferred backdrop *</label>
                    <p class="backdrop-info">Choose your preferred backdrop below and type it in:</p>
                    <ul class="backdrop-list" id="backdropList">
                        <!-- Backdrop list will be populated by JavaScript -->
                    </ul>
                    <input type="text" class="form-input" required placeholder="Enter your preferred backdrop">
                    <p class="backdrop-note">*COLORS ARE SUBJECT TO AVAILABILITY ON THE DAY OF YOUR SESSION</p>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="policyCheckbox" required>
                    <label for="policyCheckbox">
                        I have read and agree to Annyeong Studio <a href="#" class="policy-link">Booking Policy</a>
                    </label>
                </div>
            </div>

            <div class="booking-details">
                <h2 class="details-title">Booking Details</h2>
                
                <div class="details-item">
                    <div class="details-label">Package</div>
                    <div class="details-value" id="packageName">Package Name</div>
                </div>

                <div class="details-item">
                    <div class="details-label">Date & Time</div>
                    <div class="details-value" id="dateTime">Date and Time</div>
                </div>

                <div class="details-item">
                    <div class="details-label">Location</div>
                    <div class="details-value" id="location">Location</div>
                </div>

                <div class="details-item">
                    <div class="details-label">Duration</div>
                    <div class="details-value" id="duration">Duration</div>
                </div>

                <div class="total-section">
                    <div class="total-price" id="price">₱0</div>
                    <button class="book-now-btn" onclick="submitBooking()">Book Now</button>
                </div>
            </div>
        </div>
    </div>

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

    <script>
        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const packageName = urlParams.get('package');
        const location = urlParams.get('location');
        const duration = urlParams.get('duration');
        const price = urlParams.get('price');
        const date = urlParams.get('date');
        const time = urlParams.get('time');

        // Update booking details
        document.getElementById('packageName').textContent = packageName || 'Package Name';
        document.getElementById('dateTime').textContent = `${date} at ${time}`;
        document.getElementById('location').textContent = location || 'Location';
        document.getElementById('duration').textContent = duration || 'Duration';
        document.getElementById('price').textContent = price || '₱0';

        // Populate backdrop list based on location
        const backdropList = document.getElementById('backdropList');
        const tanauanBackdrops = [
            'Barely Beige', 'Arctic Snow', 'Coral Pink', 'Stone Gray',
            'Icy Blue', 'Evergreen', 'Passion Red'
        ];
        const stoTomasBackdrops = [
            'Evergreen', 'Arctic Snow', 'Coral Pink', 'Mint Green',
            'Lavander Haze', 'Cocoa Brown'
        ];

        const backdrops = location.includes('Tanauan') ? tanauanBackdrops : stoTomasBackdrops;
        backdrops.forEach(backdrop => {
            const li = document.createElement('li');
            li.textContent = backdrop;
            backdropList.appendChild(li);
        });

        // Submit booking
        function submitBooking() {
            if (!document.getElementById('policyCheckbox').checked) {
                alert('Please agree to the booking policy to continue.');
                return;
            }

            // Here you would typically send the booking data to your server
            // For now, we'll just redirect to the home page
            window.location.href = "index.php";
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