<?php
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Purchase - Moonlight Photos</title>
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
            background-color: #f5f5f5;
            min-height: 100vh;
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

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem;
        }

        .payment-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 2rem;
            position: relative;
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: #333;
            font-size: 1rem;
            margin-bottom: 2rem;
            cursor: pointer;
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

        .payment-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .payment-header h1 {
            font-size: 1.5rem;
            color: #333;
        }

        .order-summary {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .order-summary h2 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #efb4b4;
        }

        .order-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
            font-size: 0.95rem;
            color: #555;
        }

        .order-details:last-of-type {
            border-bottom: none;
        }

        .order-details span:first-child {
            font-weight: 500;
            color: #333;
        }

        .order-details span:last-child {
            color: #666;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px solid #efb4b4;
            font-size: 1.1rem;
            color: #333;
        }

        .billing-form {
            margin-bottom: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
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
            border-color: #FF6B6B;
        }

        .payment-method {
            margin-bottom: 2rem;
        }

        .payment-method h2 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .gcash-option {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
            cursor: pointer;
            transition: border-color 0.2s ease;
        }

        .gcash-option:hover {
            border-color: #FF6B6B;
        }

        .gcash-option img {
            height: 40px;
            width: auto;
        }

        .terms-section {
            margin-bottom: 2rem;
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .checkbox-group input[type="checkbox"] {
            margin-top: 0.25rem;
        }

        .checkbox-group label {
            font-size: 0.9rem;
            color: #333;
        }

        .terms-link {
            color: #FF6B6B;
            text-decoration: none;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        .pay-button {
            width: 100%;
            padding: 1rem;
            background: #FF6B6B;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .pay-button:hover {
            background: #ff5252;
        }

        .pay-button:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        /* Success Message */
        .success-message {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #4CAF50;
            color: white;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
            z-index: 1000;
        }

        .success-message.show {
            display: block;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .overlay.show {
            display: block;
        }

        @media (max-width: 768px) {
            .nav {
                padding: 1rem;
            }

            .nav-links {
                gap: 1.5rem;
            }

            .payment-container {
                padding: 1rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .gift-details {
            margin: 1rem 0;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .gift-detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .gift-detail-item:last-child {
            margin-bottom: 0;
        }

        .gift-detail-label {
            font-weight: 500;
        }

        .gift-detail-value {
            text-align: right;
            word-break: break-word;
            max-width: 60%;
        }

        .message-box {
            margin-top: 0.5rem;
            padding: 0.5rem;
            background: #f5f5f5;
            border-radius: 4px;
            font-style: italic;
        }

        #giftDetails {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        #giftDetails .order-details span:last-child {
            max-width: 60%;
            text-align: right;
            word-wrap: break-word;
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

    <div class="main-content">
        <div class="payment-container">
            <a href="javascript:void(0)" class="back-button" onclick="goBack()">
                <img src="static/back icon.png" alt="Back">
                <span>Back</span>
            </a>

            <div class="payment-header">
                <h1>Complete Your Purchase</h1>
            </div>

            <div class="order-summary">
                <h2>Order Summary</h2>
                <div class="order-details">
                    <span>Digital Gift Card</span>
                    <span id="giftCardAmount">₱799.00</span>
                </div>
                <div id="giftDetails">
                    <!-- Gift details will be populated by JavaScript -->
                </div>
                <div class="order-total">
                    <span>Total</span>
                    <span id="totalAmount">₱799.00</span>
                </div>
            </div>

            <div class="billing-form">
                <h2>Billing Address</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">First name *</label>
                        <input type="text" class="form-input" id="firstName" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Last name *</label>
                        <input type="text" class="form-input" id="lastName" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Phone *</label>
                    <input type="tel" class="form-input" id="phone" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Country/Region *</label>
                    <select class="form-input" id="country" required>
                        <option value="">Select a country/region</option>
                        <option value="PH">Philippines</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Address *</label>
                    <input type="text" class="form-input" id="address" required>
                </div>
                <div class="form-group">
                    <label class="form-label">City *</label>
                    <input type="text" class="form-input" id="city" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Zip / Postal code *</label>
                    <input type="text" class="form-input" id="zipCode" required>
                </div>
            </div>

            <div class="payment-method">
                <h2>Payment Method</h2>
                <div class="gcash-option">
                    <img src="static/gcash logo.jpg" alt="GCash Logo">
                    <span>Pay with GCash</span>
                </div>
            </div>

            <div class="terms-section">
                <div class="checkbox-group">
                    <input type="checkbox" id="termsCheckbox" required>
                    <label for="termsCheckbox">I agree to the <a href="#" class="terms-link">Terms & Conditions</a> *</label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="marketingCheckbox">
                    <label for="marketingCheckbox">I agree to receive marketing communications via email and/or SMS</label>
                </div>
            </div>

            <button class="pay-button" onclick="handlePayment()">Place Order & Pay</button>
        </div>
    </div>

    <div class="overlay" id="overlay"></div>
    <div class="success-message" id="successMessage">
        Payment successful! 🎉<br>
        Thank you for your purchase.<br>
        Redirecting to homepage...
    </div>

    <script src="static/js/auth.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get URL parameters
            const params = new URLSearchParams(window.location.search);
            const amount = params.get('amount');
            const giftType = params.get('giftType');
            
            // Update amounts
            const formattedAmount = `₱${amount}.00`;
            document.getElementById('giftCardAmount').textContent = formattedAmount;
            document.getElementById('totalAmount').textContent = formattedAmount;

            // Get gift details container
            const giftDetails = document.getElementById('giftDetails');
            let detailsHTML = '';

            if (giftType === 'other') {
                // For someone else
                const recipientEmail = params.get('recipientEmail');
                const recipientName = params.get('recipientName');
                const deliveryDate = params.get('deliveryDate');
                const message = params.get('message');

                // Only show fields that have values
                if (recipientEmail) {
                    detailsHTML += `
                        <div class="order-details">
                            <span>Recipient Email</span>
                            <span>${recipientEmail}</span>
                        </div>`;
                }
                if (recipientName && recipientName !== 'Not Provided') {
                    detailsHTML += `
                        <div class="order-details">
                            <span>Recipient Name</span>
                            <span>${recipientName}</span>
                        </div>`;
                }
                if (deliveryDate && deliveryDate !== 'Not Provided') {
                    detailsHTML += `
                        <div class="order-details">
                            <span>Delivery Date</span>
                            <span>${deliveryDate}</span>
                        </div>`;
                }
                if (message && message !== 'Not Provided') {
                    detailsHTML += `
                        <div class="order-details">
                            <span>Message</span>
                            <span>${message}</span>
                        </div>`;
                }
            } else {
                // For myself
                const email = params.get('email');
                const firstName = params.get('firstName');
                const lastName = params.get('lastName');
                const phone = params.get('phone');

                // Only show fields that have values
                if (email) {
                    detailsHTML += `
                        <div class="order-details">
                            <span>Email</span>
                            <span>${email}</span>
                        </div>`;
                }
                if ((firstName && firstName !== 'Not Provided') || (lastName && lastName !== 'Not Provided')) {
                    detailsHTML += `
                        <div class="order-details">
                            <span>Name</span>
                            <span>${firstName !== 'Not Provided' ? firstName : ''} ${lastName !== 'Not Provided' ? lastName : ''}</span>
                        </div>`;
                }
                if (phone && phone !== 'Not Provided') {
                    detailsHTML += `
                        <div class="order-details">
                            <span>Phone</span>
                            <span>${phone}</span>
                        </div>`;
                }
            }

            // Add a note if no details were provided
            if (!detailsHTML) {
                detailsHTML = `
                    <div class="order-details">
                        <span>Note</span>
                        <span>No additional details provided</span>
                    </div>`;
            }

            giftDetails.innerHTML = detailsHTML;

            // Handle back button
            document.querySelector('.back-button').addEventListener('click', function(e) {
                e.preventDefault();
                window.history.back();
            });
        });

        function goBack() {
            // Redirect back to gift card page with the correct type
            window.location.href = `gift-card.html?type=${giftType}`;
        }

        function handlePayment() {
            // Get all required billing fields
            const requiredFields = [
                'firstName',
                'lastName',
                'phone',
                'country',
                'address',
                'city',
                'zipCode'
            ];

            // Validate billing fields
            const isValid = requiredFields.every(field => {
                const element = document.getElementById(field);
                if (!element.value) {
                    element.classList.add('error');
                    return false;
                }
                element.classList.remove('error');
                return true;
            });

            // Check terms agreement
            if (!document.getElementById('termsCheckbox').checked) {
                alert('Please agree to the Terms & Conditions');
                return;
            }

            if (!isValid) {
                alert('Please fill in all required billing fields');
                return;
            }

            // Show success message and overlay
            document.getElementById('overlay').classList.add('show');
            document.getElementById('successMessage').classList.add('show');

            // Redirect to homepage after 2.5 seconds
            setTimeout(() => {
                window.location.href = "index.php";
            }, 2500);
        }

        // Add event listeners for form validation
        const requiredInputs = document.querySelectorAll('input[required], select[required]');
        requiredInputs.forEach(input => {
            input.addEventListener('input', () => {
                if (input.value) {
                    input.classList.remove('error');
                }
            });
        });

        document.getElementById('termsCheckbox').addEventListener('change', function() {
            if (this.checked) {
                this.classList.remove('error');
            }
        });
    </script>
</body>
</html> 