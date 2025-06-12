<?php
require_once 'config/database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Moonlight Photos</title>
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

        /* FAQ Section */
        .faq-container {
            max-width: 800px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .faq-item {
            border-bottom: 1px solid #eee;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            padding: 1rem 0;
        }

        .faq-question h3 {
            font-size: 1.1rem;
            font-weight: 500;
            color: #333;
            margin: 0;
        }

        .faq-answer {
            display: none;
            padding: 1rem 0;
            color: #666;
            line-height: 1.6;
        }

        .faq-answer p {
            margin: 0;
            padding: 0;
        }

        .faq-answer ul {
            list-style: none;
            padding: 0;
            margin: 0.5rem 0 0 0;
        }

        .faq-answer li {
            margin-bottom: 0.5rem;
            padding-left: 1rem;
            position: relative;
        }

        .faq-answer li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #666;
        }

        .faq-question.active + .faq-answer {
            display: block;
        }

        .toggle-icon {
            width: 24px;
            height: 24px;
            transition: transform 0.3s ease;
        }

        .faq-question.active .toggle-icon {
            transform: rotate(180deg);
        }

        .policy-link {
            display: block;
            text-align: center;
            margin: 2rem 0;
            color: #FF6B6B;
            text-decoration: none;
            font-size: 1.1rem;
        }

        .policy-link:hover {
            text-decoration: underline;
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

            .faq-container {
                padding: 0 1rem;
            }

            .faq-question h3 {
                font-size: 1rem;
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

    <div class="notification" id="notification">Successfully logged in!</div>

    <div class="faq-container">
        <div class="faq-item">
            <div class="faq-question">
                <h3>What are your operating hours?</h3>
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234a4a4a'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E" 
                     alt="Toggle" 
                     class="toggle-icon">
            </div>
            <div class="faq-answer">
                <p>📍 LIPA BRANCH</p>
                <ul>
                    <li>Monday - Tuesday: 10:00 AM - 7:00 PM</li>
                    <li>Wednesday: Closed</li>
                    <li>Thursday: 10:00 AM - 7:00 PM</li>
                    <li>Friday - Sunday: 10:00 AM - 8:00 PM</li>
                </ul>
                <p>📍 BATANGAS BRANCH</p>
                <ul>
                    <li>Monday: 1:00 PM - 5:00 PM</li>
                    <li>Tuesday & Wednesday: Closed</li>
                    <li>Thursday: 1:00 PM - 5:00 PM</li>
                    <li>Friday - Sunday: 1:00 PM - 5:00 PM</li>
                </ul>
                <p>To avoid delays, we recommend arriving 5-10 minutes before your scheduled session.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Do you accept walk-ins?</h3>
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234a4a4a'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E" 
                     alt="Toggle" 
                     class="toggle-icon">
            </div>
            <div class="faq-answer">
                <p>Yes, walk-ins are welcome if the schedule allows. However, we highly recommend booking in advance to ensure your preferred time slot.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Are fur babies allowed in the studio?</h3>
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234a4a4a'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E" 
                     alt="Toggle" 
                     class="toggle-icon">
            </div>
            <div class="faq-answer">
                <p>Absolutely! Fur babies are always welcome. Just make sure they will be wearing diapers, well-behaved and supervised at all times. Let us know ahead so we can prepare the space for them.</p>
                <p><strong>Note:</strong> Any damages (peeing, pooing, biting, damaging of equipments) your pet may do is your full responsibility.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>What types of photography services do you offer?</h3>
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234a4a4a'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E" 
                     alt="Toggle" 
                     class="toggle-icon">
            </div>
            <div class="faq-answer">
                <p>We provide:</p>
                <ul>
                    <li>Portraits and family shoots</li>
                    <li>Graduation and ID photos</li>
                    <li>Pet photography</li>
                    <li>Product and business branding</li>
                    <li>Couple and engagement sessions</li>
                    <li>Event coverage (on request)</li>
                </ul>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>How can I book a session?</h3>
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234a4a4a'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E" 
                     alt="Toggle" 
                     class="toggle-icon">
            </div>
            <div class="faq-answer">
                <p>You can book via:</p>
                <ul>
                    <li>Social media messaging</li>
                    <li>Phone call/text at [----------]</li>
                    <li>Walk-in (subject to availability)</li>
                </ul>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Do you allow rescheduling?</h3>
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234a4a4a'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E" 
                     alt="Toggle" 
                     class="toggle-icon">
            </div>
            <div class="faq-answer">
                <p>Yes, we understand plans can change. Kindly inform us at least 24 hours in advance to reschedule your session.</p>
                <p>We can reschedule for free as long as it's 3 days before your reserved time slot. If you wish to rebook your slot after the 3 days lock-in period, last-minute changes may be subject to a rescheduling fee of Php 375.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Can I bring outfit changes or props?</h3>
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234a4a4a'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E" 
                     alt="Toggle" 
                     class="toggle-icon">
            </div>
            <div class="faq-answer">
                <p>Definitely! Feel free to bring extra outfits or meaningful props to add personality to your photos.</p>
            </div>
        </div>

        <a href="policy.php" class="policy-link">See our Late, Rescheduling and Cancellation Policy ›</a>
    </div>

    <section class="events-section">
        <h2 class="events-title">and hey, we also do events.</h2>
        <p class="events-subtitle">We're bringing the Annyeong Experience to your events with Booths by Annyeong Studio.</p>
        <a href="#" class="learn-more-btn">LEARN MORE</a>
    </section>

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

    <script>
        // Add click event listeners to FAQ questions
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                // Close all other answers
                document.querySelectorAll('.faq-question').forEach(q => {
                    if (q !== question) {
                        q.classList.remove('active');
                        q.nextElementSibling.style.display = 'none';
                    }
                });
                
                // Toggle active class
                question.classList.toggle('active');
                
                // Toggle answer visibility
                const answer = question.nextElementSibling;
                if (question.classList.contains('active')) {
                    answer.style.display = 'block';
                } else {
                    answer.style.display = 'none';
                }
            });
        });
    </script>
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