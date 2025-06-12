<?php
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanauan City Branch - Moonlight Photos</title>
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

        /* Branch Content */
        .branch-container {
            max-width: 800px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 1rem;
            cursor: pointer;
            text-decoration: none;
        }

        .back-button img {
            height: 24px;
            width: auto;
            vertical-align: middle;
        }

        .branch-header {
            margin-bottom: 2rem;
        }

        .branch-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .branch-address {
            color: #666;
            font-size: 0.9rem;
        }

        /* Package Cards */
        .package-grid {
            display: grid;
            gap: 2rem;
        }

        .package-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .package-info {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .package-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .package-details h3 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .package-details p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .read-more {
            color: #FF6B6B;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .package-price {
            font-size: 1.1rem;
            color: #333;
            font-weight: 500;
            margin-right: 1rem;
        }

        .book-now-btn {
            background-color: #B4F0E9;
            color: #333;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .book-now-btn:hover {
            background-color: #9DE0D9;
            transform: translateY(-2px);
        }

        /* Add-ons Section */
        .add-ons-section {
            margin-top: 4rem;
        }

        .add-ons-header {
            text-align: center;
            color: #FF6B6B;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .add-ons-grid {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .add-ons-title {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .add-ons-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem 2rem;
        }

        .add-on-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            color: #666;
            font-size: 0.9rem;
        }

        .add-on-name {
            color: #666;
            font-size: 0.9rem;
        }

        .add-on-price {
            color: #333;
            font-weight: 500;
        }

        .add-on-note {
            font-size: 0.8rem;
            color: #666;
            text-align: center;
            margin-top: 1.5rem;
            font-style: italic;
        }

        /* Events Section */
        .events-section {
            background-color: #efb4b4;
            padding: 3rem 2rem;
            text-align: center;
            color: white;
            margin-top: 4rem;
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

            .branch-container {
                padding: 0 1.5rem;
            }

            .package-card {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }

            .package-info {
                flex-direction: column;
                gap: 1rem;
            }

            .add-ons-list {
                grid-template-columns: 1fr;
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

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            overflow: auto;
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            width: 80%;
            max-width: 700px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .close-modal {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 28px;
            font-weight: bold;
            color: #666;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-modal:hover {
            color: #333;
        }

        .modal-body {
            margin-top: 20px;
        }

        .modal-body img {
            width: 100%;
            max-height: 500px;
            object-fit: contain;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        #modalDetails {
            color: #333;
            line-height: 1.6;
        }

        .modal-body h2 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            font-family: 'Poppins', sans-serif;
        }

        .modal-body h3 {
            color: #FF6B6B;
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            font-family: 'Poppins', sans-serif;
        }

        .modal-body ul {
            list-style: none;
            padding: 0;
        }

        .modal-body li {
            color: #666;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            padding-left: 1.5rem;
            position: relative;
            font-family: 'Poppins', sans-serif;
        }

        .modal-body li:before {
            content: "•";
            color: #FF6B6B;
            position: absolute;
            left: 0;
        }
    </style>
</head>
<body>
    <!-- Modal Container -->
    <div id="packageModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Package Details">
                <div id="modalDetails"></div>
            </div>
        </div>
    </div>

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

    <div class="branch-container">
        <a href="book-now.php" class="back-button">
            <img src="static\back icon.png" alt="Back">
        </a>
        <div class="branch-header">
            <h1 class="branch-title">Tanauan City, Batangas</h1>
            <p class="branch-address">A. Mabini Ave, Población 7, Tanauan City, Batangas</p>
        </div>

        <div class="package-grid">
            <div class="package-card">
                <div class="package-info">
                    <img src="static\Lunar package.png" alt="Lunar Package" class="package-image">
                    <div class="package-details">
                        <h3>Lunar Package</h3>
                        <p>Perfect for individuals or couples</p>
                        <a href="#" class="read-more" data-package="lunar">READ MORE ›</a>
                    </div>
                </div>
                <div>
                    <span class="package-price">₱899</span>
                    <a href="schedule.php?package=Lunar%20Package&branch=Tanauan" class="book-now-btn">Book Now</a>
                </div>
            </div>

            <div class="package-card">
                <div class="package-info">
                    <img src="static\Noctural package.png" alt="Nocturnal Package" class="package-image">
                    <div class="package-details">
                        <h3>Nocturnal Package</h3>
                        <p>Great for small groups of 3-4</p>
                        <a href="#" class="read-more" data-package="nocturnal">READ MORE ›</a>
                    </div>
                </div>
                <div>
                    <span class="package-price">₱1,199</span>
                    <a href="schedule.php?package=Nocturnal%20Package&branch=Tanauan" class="book-now-btn">Book Now</a>
                </div>
            </div>

            <div class="package-card">
                <div class="package-info">
                    <img src="static\Twilight paackage.png" alt="Twilight Package" class="package-image">
                    <div class="package-details">
                        <h3>Twilight Package</h3>
                        <p>Perfect for groups of 5-6</p>
                        <a href="#" class="read-more" data-package="twilight">READ MORE ›</a>
                    </div>
                </div>
                <div>
                    <span class="package-price">₱1,599</span>
                    <a href="schedule.php?package=Twilight%20Package&branch=Tanauan" class="book-now-btn">Book Now</a>
                </div>
            </div>

            <div class="package-card">
                <div class="package-info">
                    <img src="static\Celestial package.png" alt="Celestial Package" class="package-image">
                    <div class="package-details">
                        <h3>Celestial Package</h3>
                        <p>Ideal for large groups of 7-8</p>
                        <a href="#" class="read-more" data-package="celestial">READ MORE ›</a>
                    </div>
                </div>
                <div>
                    <span class="package-price">₱1,999</span>
                    <a href="schedule.php?package=Celestial%20Package&branch=Tanauan" class="book-now-btn">Book Now</a>
                </div>
            </div>
        </div>

        <div class="add-ons-section">
            <p class="add-ons-header">All add-ons are now settled on the day of your shoot.</p>
            <div class="add-ons-grid">
                <h2 class="add-ons-title">Add-Ons</h2>
                <div class="add-ons-list">
                    <div class="add-on-item">
                        <span class="add-on-name">Additional Pax</span>
                        <span class="add-on-price">Php 299</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Additional Photo Strips</span>
                        <span class="add-on-price">Php 220</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Extra Pet</span>
                        <span class="add-on-price">Php 100</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Annyeong Mini</span>
                        <span class="add-on-price">Php 80</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Additional 10 mins</span>
                        <span class="add-on-price">Php 399</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Film Strips</span>
                        <span class="add-on-price">Php 80</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Soft Copy</span>
                        <span class="add-on-price">Php 399</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Film Strips</span>
                        <span class="add-on-price">Php 220</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Additional Backdrop</span>
                        <span class="add-on-price">Php 120</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Additional Enhanced Photo</span>
                        <span class="add-on-price">Php 60</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Backdrop Floor Extension</span>
                        <span class="add-on-price">Php 400</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">5R Photo with Frame</span>
                        <span class="add-on-price">Php 500</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Additional 4R Print</span>
                        <span class="add-on-price">Php 80</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">A4 Photo with Frame</span>
                        <span class="add-on-price">Php 1000</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">Additional Photo Strips</span>
                        <span class="add-on-price">Php 80</span>
                    </div>
                    <div class="add-on-item">
                        <span class="add-on-name">A3 Photo with Frame</span>
                        <span class="add-on-price">Php 1200</span>
                    </div>
                </div>
                <p class="add-on-note">All add-on payments will be settled directly at the studio.</p>
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
    <script src="static/js/auth.js"></script>
    <script>
        // Get modal elements
        const modal = document.getElementById('packageModal');
        const modalImg = document.getElementById('modalImage');
        const modalDetails = document.getElementById('modalDetails');
        const closeBtn = document.querySelector('.close-modal');

        // Package data object with full details
        const packageData = {
            'lunar': {
                image: 'static/Lunar package 1.png',
                details: `
                    <h2>Lunar Package</h2>
                    
                `
            },
            'nocturnal': {
                image: 'static/Noctural package 1.png',
                details: `
                    <h2>Nocturnal Package</h2>
                    
                `
            },
            'twilight': {
                image: 'static/Twilight package 1.png',
                details: `
                    <h2>Twilight Package</h2>
                  
                `
            },
            'celestial': {
                image: 'static/Celestial package 1.png',
                details: `
                    <h2>Celestial Package</h2>
                    
                `
            }
        };

        // Add click event listeners to all "READ MORE >" links
        document.querySelectorAll('.read-more').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const packageType = this.getAttribute('data-package');
                const packageInfo = packageData[packageType];
                
                if (packageInfo) {
                    modalImg.src = packageInfo.image;
                    modalDetails.innerHTML = packageInfo.details;
                    modal.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        // Close modal when clicking the close button
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        // Close modal when clicking outside the modal content
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    </script>
</body>
</html> 