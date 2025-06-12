<?php
require_once 'config/database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Your Service - Annyeong Studio</title>
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
            margin: 0;
            display: flex;
            flex-direction: column;
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

        /* Footer */
        .footer {
            background: #FFFCF6;
            padding: 3rem 2rem;
            margin-top: auto;
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

        /* Schedule Container Styles */
        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .schedule-container {
            background-color: #fff;
            padding: 2rem;
            width: 100%;
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            position: relative;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        .back-button {
            position: absolute;
            top: 2rem;
            left: 2rem;
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.2s ease;
        }

        .back-button:hover {
            color: #FF6B6B;
        }

        .back-button img {
            width: 20px;
            height: 20px;
            vertical-align: middle;
        }

        .back-button span {
            font-weight: 500;
        }

        .schedule-header {
            text-align: center;
            margin-top: 2rem;
        }

        .schedule-header h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .schedule-header p {
            font-family: 'Poppins', sans-serif;
            color: #666;
            font-size: 0.9rem;
        }

        .schedule-content {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 2rem;
            margin-top: 1rem;
        }

        .date-time-section {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .timezone-selector {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .timezone-selector select {
            font-family: 'Poppins', sans-serif;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .calendar {
            margin-bottom: 2rem;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
        }

        .calendar-day:hover {
            background-color: #FFE4E4;
        }

        .calendar-day.selected {
            background-color: #FF6B6B;
            color: white;
        }

        .time-slots {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }

        .time-slot {
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
        }

        .time-slot:hover {
            background-color: #FFE4E4;
        }

        .time-slot.selected {
            background-color: #FF6B6B;
            color: white;
            border-color: #FF6B6B;
        }

        .service-details {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .service-details h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .detail-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 0.3rem;
        }

        .detail-value {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            color: #333;
            font-weight: 500;
        }

        .next-button {
            font-family: 'Poppins', sans-serif;
            background-color: #FF6B6B;
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.2s;
        }

        .next-button:hover {
            background-color: #ff5252;
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

            .schedule-content {
                grid-template-columns: 1fr;
            }

            .schedule-container {
                padding: 1rem;
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

    <div class="main-content">
        <div class="schedule-container">
            <a href="javascript:void(0)" class="back-button" onclick="goBack()">
                <img src="static/back icon.png" alt="Back">
                <span>Back</span>
            </a>
            
            <div class="schedule-header">
                <h1>Schedule your service</h1>
                <p>Check out our availability and book the date and time that works for you</p>
            </div>

            <div class="schedule-content">
                <div class="date-time-section">
                    <div class="timezone-selector">
                        <span>Time zone:</span>
                        <select id="timezone">
                            <option value="GMT+8">Philippine Standard Time (GMT+8)</option>
                        </select>
                    </div>

                    <div class="calendar">
                        <div class="calendar-header">
                            <button id="prevMonth">←</button>
                            <h3 id="currentMonth">June 2025</h3>
                            <button id="nextMonth">→</button>
                        </div>
                        <div class="calendar-grid" id="calendarGrid">
                            <!-- Calendar will be populated by JavaScript -->
                        </div>
                    </div>

                    <div class="time-slots" id="timeSlots">
                        <div class="time-slot">11:00 am</div>
                        <div class="time-slot">1:00 pm</div>
                        <div class="time-slot">3:00 pm</div>
                        <div class="time-slot">5:00 pm</div>
                    </div>
                </div>

                <div class="service-details">
                    <h2>Service Details</h2>
                    <div class="detail-item">
                        <div class="detail-label">Package</div>
                        <div class="detail-value" id="packageName">Lunar Package</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Location</div>
                        <div class="detail-value" id="branchName">Moonlight Studio, Tanauan City</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Date & Time</div>
                        <div class="detail-value" id="dateTime">June 5, 2025 at 11:00 am</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Duration</div>
                        <div class="detail-value">1 hr</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Price</div>
                        <div class="detail-value" id="price">₱899</div>
                    </div>

                    <button class="next-button" onclick="handleNext()">Next</button>
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

    <script src="static/js/auth.js"></script>
    <script>
        function goBack() {
            // Get the current URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const package = urlParams.get('package');
            const branch = urlParams.get('branch');
            const source = urlParams.get('source');

            // If we have a source parameter, use it to determine where to go back to
            if (source === 'book-now') {
                window.location.href = `book-now.html?package=${encodeURIComponent(package)}&branch=${encodeURIComponent(branch)}`;
            } else {
                // If no specific source, go back to the previous page while preserving state
                window.history.back();
            }
        }

        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const selectedPackage = urlParams.get('package') || 'Lunar Package';
        const selectedBranch = urlParams.get('branch') || 'Tanauan';

        // Package prices mapping
        const packagePrices = {
            'Lunar Package': '899',
            'Nocturnal Package': '1,199',
            'Twilight Package': '1,599',
            'Celestial Package': '1,999'
        };

        // Update service details
        document.getElementById('packageName').textContent = selectedPackage;
        document.getElementById('branchName').textContent = `Moonlight Studio, ${selectedBranch} City`;
        document.getElementById('price').textContent = `₱${packagePrices[selectedPackage] || '899'}`;

        // Calendar functionality
        let selectedDate = null;
        let selectedTime = null;

        function updateDateTime() {
            if (selectedDate && selectedTime) {
                const formattedDate = selectedDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                document.getElementById('dateTime').textContent = `${formattedDate} at ${selectedTime}`;
            }
        }

        // Time slot selection
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.addEventListener('click', function() {
                document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
                selectedTime = this.textContent;
                updateDateTime();
            });
        });

        // Next button click handler
        function handleNext() {
            const selectedDateElement = document.querySelector('.calendar-day.selected');
            const selectedTimeElement = document.querySelector('.time-slot.selected');
            
            if (!selectedDateElement || !selectedTimeElement) {
                alert('Please select both a date and time for your booking');
                return;
            }

            const packageName = document.getElementById('packageName').textContent;
            const branchName = document.getElementById('branchName').textContent.split(',')[0];
            const price = document.getElementById('price').textContent.replace('₱', '');
            const selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), parseInt(selectedDateElement.textContent));
            const formattedDate = selectedDate.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            const time = selectedTimeElement.textContent;

            // Redirect to payment page with booking details
            window.location.href = `booking-payment.php?package=${encodeURIComponent(packageName)}&branch=${encodeURIComponent(branchName)}&date=${encodeURIComponent(formattedDate)}&time=${encodeURIComponent(time)}&price=${encodeURIComponent(price)}&source=booking`;
        }

        // Simple calendar implementation
            const calendarGrid = document.getElementById('calendarGrid');
            const currentMonthElement = document.getElementById('currentMonth');
        let currentDate = new Date();

        function generateCalendar(date) {
            const year = date.getFullYear();
            const month = date.getMonth();
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const startingDay = firstDay.getDay();
            const monthLength = lastDay.getDate();

            currentMonthElement.textContent = date.toLocaleDateString('en-US', { 
                month: 'long', 
                year: 'numeric' 
            });

                calendarGrid.innerHTML = '';
                
                // Add day headers
                const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                days.forEach(day => {
                    const dayHeader = document.createElement('div');
                    dayHeader.textContent = day;
                dayHeader.style.fontWeight = 'bold';
                    calendarGrid.appendChild(dayHeader);
                });

            // Add blank spaces for days before the first of the month
            for (let i = 0; i < startingDay; i++) {
                const blank = document.createElement('div');
                calendarGrid.appendChild(blank);
            }

            // Add calendar days
            for (let i = 1; i <= monthLength; i++) {
                const day = document.createElement('div');
                day.textContent = i;
                day.classList.add('calendar-day');
                
                const currentDay = new Date(year, month, i);
                if (currentDay >= new Date()) {
                    day.addEventListener('click', function() {
                        document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                        this.classList.add('selected');
                        selectedDate = currentDay;
                        updateDateTime();
                    });
                } else {
                    day.style.color = '#ccc';
                    day.style.cursor = 'not-allowed';
                }
                
                calendarGrid.appendChild(day);
            }
        }

        generateCalendar(currentDate);

        // Month navigation
        document.getElementById('prevMonth').addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
            generateCalendar(currentDate);
            });

        document.getElementById('nextMonth').addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
            generateCalendar(currentDate);
        });

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