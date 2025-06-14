<?php
require_once 'config/database.php';
session_start();

// Get booking details from URL
$package = $_GET['package'] ?? '';
$branch = $_GET['branch'] ?? '';
$date = $_GET['date'] ?? '';
$time = $_GET['time'] ?? '';
$price = $_GET['price'] ?? '';
$source = $_GET['source'] ?? '';

// Insert into sessions table if all required data is present and no duplicate exists
if ($package && $branch && $price && $date && $time) {
    $duration = 1; // Assuming 1 hour session
    $available_dates = $date . ' ' . $time;

    // Check for existing session with same branch, package, date, and time
    $check_stmt = mysqli_prepare($conn, "SELECT session_id FROM sessions WHERE branch = ? AND package = ? AND available_dates = ?");
    mysqli_stmt_bind_param($check_stmt, "sss", $branch, $package, $available_dates);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);
    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        // Redirect back to schedule.php with error
        header("Location: schedule.php?error=slot-taken&package=" . urlencode($package) . "&branch=" . urlencode($branch));
        exit();
    }
    mysqli_stmt_close($check_stmt);

    // No duplicate, insert new session
    $insert_stmt = mysqli_prepare($conn, "INSERT INTO sessions (branch, package, price, duration, available_dates) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($insert_stmt, "ssdis", $branch, $package, $price, $duration, $available_dates);
    mysqli_stmt_execute($insert_stmt);
    mysqli_stmt_close($insert_stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moonlight Photos - Booking Form</title>
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

        /* Navigation styles from existing site */
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

        /* Updated Booking Form Styles */
        .booking-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 4rem;
        }

        .booking-form {
            padding-right: 2rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #333;
            text-decoration: none;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .form-title {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .section-title {
            font-size: 1.25rem;
            color: #333;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .login-prompt {
            background: #f8f8f8;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 2rem;
        }

        .login-prompt a {
            color: #6e7bb8;
            text-decoration: none;
            font-weight: 500;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 400;
        }

        .form-label.required::after {
            content: " *";
            color: #ff0000;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .phone-input {
            display: flex;
            gap: 1rem;
        }

        .country-select {
            width: 120px;
            padding: 1rem;
        }

        .backdrop-info {
            margin-top: 1rem;
        }

        .backdrop-list {
            margin-top: 0.5rem;
            list-style: none;
        }

        .backdrop-list li {
            margin-bottom: 0.5rem;
            color: #666;
        }

        .availability-notice {
            font-style: italic;
            color: #666;
            margin-top: 1rem;
        }

        .color-reference {
            margin-top: 1rem;
            color: #666;
        }

        /* Updated Booking Summary Styles */
        .booking-summary {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            position: sticky;
            top: 2rem;
            height: fit-content;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .summary-details {
            margin-bottom: 2rem;
        }

        .summary-item {
            margin-bottom: 1.5rem;
        }

        .summary-item h3 {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .summary-item p {
            color: #666;
            line-height: 1.4;
        }

        .payment-details {
            border-top: 1px solid #eee;
            padding-top: 1.5rem;
            margin-bottom: 2rem;
        }

        .total-amount {
            display: flex;
            justify-content: space-between;
            font-weight: 500;
            color: #333;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .view-policy {
            color: #6e7bb8;
            text-decoration: none;
            display: block;
            margin-bottom: 1rem;
        }

        .book-now-btn {
            width: 100%;
            padding: 1rem;
            background: #B4E0D9;
            border: none;
            border-radius: 25px;
            color: #333;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }

        .book-now-btn:hover {
            background: #9ED3CC;
        }

        .policy-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin: 2rem 0;
        }

        .policy-checkbox input[type="checkbox"] {
            margin-top: 0.25rem;
        }

        .policy-checkbox label {
            color: #333;
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .policy-checkbox a {
            color: #6e7bb8;
            text-decoration: none;
        }

        /* Footer styles from existing site */
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
            .booking-container {
                grid-template-columns: 1fr;
            }

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
        }

        /* Success Message Styles */
        .success-message {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            color: white;
            padding: 2rem 3rem;
            border-radius: 8px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
        }

        .success-message.show {
            display: block;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
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

    <!-- Add success message element -->
    <div class="success-message" id="bookingSuccess">✨ Booking Successful! Thank you for choosing our service.</div>

    <main class="booking-container">
        <div class="booking-form">
            <a href="book-now.php" class="back-button">← Back</a>
            <h1 class="form-title">Booking Form</h1>

            <div class="booking-section">
                <h2 class="section-title">Booking Details</h2>

                <form id="bookingForm" action="booking-payment.php" method="get">
                    <!-- Hidden fields to pass booking details -->
                    <input type="hidden" name="package" value="<?php echo htmlspecialchars($package); ?>">
                    <input type="hidden" name="branch" value="<?php echo htmlspecialchars($branch); ?>">
                    <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
                    <input type="hidden" name="time" value="<?php echo htmlspecialchars($time); ?>">
                    <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
                    <input type="hidden" name="source" value="<?php echo htmlspecialchars($source); ?>">

                    <div class="form-group">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-input" name="name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Email</label>
                        <input type="email" class="form-input" name="email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <div class="phone-input">
                            <select class="form-input country-select">
                                <option value="PH">🇵🇭 +63</option>
                            </select>
                            <input type="tel" class="form-input" name="contact" placeholder="Phone number" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Choose your preferred backdrop below and type it in. (Lunar - 1 backdrop / Noctural & Twilight- 3 backdrops)</label>
                        <textarea class="form-input" rows="4" name="requests" required></textarea>

                        <div class="backdrop-info">
                            <ul class="backdrop-list">
                                <li>Tanauan City Branch Backdrops: Barely Beige, Arctic Snow, Coral Pink, Stone Gray, Icy Blue, Evergreen & Passion Red</li>
                                <li>Sto. Tomas City Branch Backdrops: Evergreen, Arctic Snow, Coral Pink, Mint Green, Lavander Haze & Cocoa Brown</li>
                            </ul>
                            <p class="availability-notice">*COLORS ARE SUBJECT TO AVAILABILITY ON THE DAY OF YOUR SESSION</p>
                        </div>
                    </div>

                    <div class="policy-checkbox">
                        <input type="checkbox" id="policyAgreement" name="policyAgreement" required>
                        <label for="policyAgreement">I have read and agree to Annyeong Studio <a href="#" class="view-policy">Booking Policy</a></label>
                    </div>
                </form>
            </div>
        </div>

        <div class="booking-summary">
            <h2 class="section-title">Booking Details</h2>
            <div class="summary-details" id="summaryDetails">
                <!-- Summary items will be dynamically added here -->
            </div>

            <div class="payment-details">
                <div class="total-amount">
                    <span>Total</span>
                    <span id="totalPrice">₱0</span>
                </div>
            </div>

            <button type="submit" form="bookingForm" class="book-now-btn" id="bookNowBtn">Proceed to Payment</button>
            <div id="successMessage" class="success-message">
                Booking successful! 🎉<br>
                Redirecting you to the home page...
            </div>
        </div>
    </main>

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
        // Package prices mapping with correct prices
        const packagePrices = {
            'Lunar Package': '899',
            'Nocturnal Package': '1,199',
            'Twilight Package': '1,599',
            'Celestial Package': '1,999'
        };

        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const package = urlParams.get('package');
        const datetime = urlParams.get('datetime');
        const branch = urlParams.get('branch');

        // Function to create and append summary item
        function addSummaryItem(label, value) {
            if (!value) return; // Don't add if no value

            const summaryItem = document.createElement('div');
            summaryItem.className = 'summary-item';
            
            const labelDiv = document.createElement('div');
            labelDiv.className = 'detail-label';
            labelDiv.textContent = label;
            
            const valueDiv = document.createElement('div');
            valueDiv.className = 'detail-value';
            valueDiv.textContent = value;
            
            summaryItem.appendChild(labelDiv);
            summaryItem.appendChild(valueDiv);
            
            document.getElementById('summaryDetails').appendChild(summaryItem);
        }

        // Function to format price with peso sign
        function formatPrice(price) {
            return `₱${price}`;
        }

        // Populate booking summary with only selected details
        if (package) {
            addSummaryItem('Package Name', package);
        }
        
        if (branch) {
            let locationDisplay = '';
            if (branch === 'Tanauan') {
                locationDisplay = 'Tanauan City';
            } else if (branch === 'Sto. Tomas') {
                locationDisplay = 'Sto. Tomas City';
            } else {
                locationDisplay = branch;
            }
            addSummaryItem('Studio Location', locationDisplay);
        }
        
        if (datetime) {
            addSummaryItem('Date & Time', datetime);
            addSummaryItem('Duration', '1 hr');
        }

        // Update total price if package is selected
        const totalPriceElement = document.getElementById('totalPrice');
        if (package && packagePrices[package]) {
            const price = packagePrices[package];
            totalPriceElement.textContent = formatPrice(price);
            
            // Add total to summary details
            addSummaryItem('Total', formatPrice(price));
        } else {
            totalPriceElement.textContent = formatPrice('0');
        }

        // Function to show success message and redirect
        function showBookingSuccessAndRedirect() {
            const successMessage = document.getElementById('bookingSuccess');
            successMessage.classList.add('show');
            
            // Redirect to home page after showing message
            setTimeout(() => {
                window.location.href = "index.php";
            }, 2500);
        }

        // Submit booking
        function submitBooking() {
            if (!document.getElementById('policyCheckbox').checked) {
                alert('Please agree to the booking policy to continue.');
                return;
            }

            // Show success message and redirect
            showBookingSuccessAndRedirect();
        }

        // Form submission
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            // Validate required fields
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#ff0000';
                } else {
                    field.style.borderColor = '#ddd';
                }
            });
            if (!isValid) {
                e.preventDefault(); // Only prevent if invalid
                alert('Please fill in all required fields');
            }
            // If valid, form will submit to booking-payment.php
        });

        // Reset field styling on input
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('input', function() {
                this.style.borderColor = '#ddd';
            });
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