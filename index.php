<?php
require_once 'config/database.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Moonlight Photos - Home</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
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

    .user-menu {
      position: relative;
      display: inline-block;
      cursor: pointer;
    }

    .user-menu-content {
      display: none;
      position: absolute;
      right: 0;
      top: 100%;
      background: white;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      border-radius: 4px;
      padding: 0.5rem 0;
      min-width: 120px;
      z-index: 1000;
    }

    .user-menu-content a {
      display: block;
      padding: 0.5rem 1rem;
      color: #4a4a4a;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .user-menu-content a:hover {
      background-color: #f5f5f5;
    }

    .user-menu.show .user-menu-content {
      display: block;
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

    /* Photo Grid */
    .photo-grid {
      max-width: 1400px;
      margin: 2rem auto;
      padding: 0 2rem;
    }

    .photo-grid img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Booking Section */
    .booking-section {
      text-align: center;
      padding: 4rem 2rem;
      background-color: #FFF5F5;
    }

    .booking-title {
      font-size: 2.5rem;
      color: #333;
      margin-bottom: 1rem;
      font-weight: 600;
    }

    .booking-subtitle {
      color: #666;
      margin-bottom: 3rem;
    }

    .branch-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2rem;
      max-width: 1000px;
      margin: 0 auto;
    }

    .branch-card {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      cursor: pointer;
    }

    .branch-card:hover {
      transform: translateY(-5px);
    }

    .branch-image {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }

    .branch-name {
      padding: 1.5rem;
      font-size: 1.2rem;
      font-weight: 600;
      color: #333;
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

      .photo-grid {
        grid-template-columns: repeat(3, 1fr);
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

      .photo-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .branch-grid {
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

    /* Book Now Section */
    #book-now-section .photo-grid {
      max-width: 1000px;
      margin: 2rem auto;
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
    <a href="index.html" class="logo">
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

  <div class="photo-grid">
    <img src="static\Untitled design.jpg" alt="Moonlight Photos Gallery">
  </div>

  <section class="booking-section">
    <h1 class="booking-title">book your self-photo shoot</h1>
    <p class="booking-subtitle">select a branch below</p>

    <div class="branch-grid">
      <div class="branch-card" onclick="window.location.href='tanauan.php';">
        <img src="static\Tanauan.jpg" alt="Tanauan City Branch" class="branch-image">
        <div class="branch-name">TANAUAN CITY</div>
      </div>
      <div class="branch-card" onclick="window.location.href='sto-tomas.php';">
        <img src="static\SM STO..jpg" alt="Sto. Tomas City Branch" class="branch-image">
        <div class="branch-name">STO. TOMAS CITY</div>
      </div>
    </div>
  </section>

  <section class="events-section">
    <h2 class="events-title">and hey, we also do events.</h2>
    <p class="events-subtitle">We're bringing the Moonlight Photos to your events with Booths by Moonlight Photos.</p>
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


