<?php
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Moonlight Photos - Complete Your Booking</title>
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
      background-color: #f5f5f5;
    }

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

    .payment-container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
      margin-bottom: 2rem;
      padding: 1rem;
      background: #f9f9f9;
      border-radius: 4px;
    }

    .order-summary h2 {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 1rem;
    }

    .order-details {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.5rem;
      padding: 0.5rem 0;
      border-bottom: 1px solid #eee;
    }

    .order-total {
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      margin-top: 1rem;
      padding-top: 1rem;
      border-top: 1px solid #eee;
    }

    .booking-details {
      margin-bottom: 1.5rem;
      padding: 1rem;
      background: #f9f9f9;
      border-radius: 4px;
    }

    .booking-details h2 {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 1rem;
    }

    .booking-info {
      display: grid;
      gap: 0.5rem;
    }

    .booking-info-item {
      display: flex;
      justify-content: space-between;
    }

    .booking-info-label {
      color: #666;
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
      cursor: pointer;
      transition: border-color 0.2s ease;
    }

    .gcash-option:hover {
      border-color: #0070f3;
    }

    .gcash-option img {
      height: 40px;
      width: auto;
    }

    .billing-address {
      margin-bottom: 2rem;
    }

    .billing-address h2 {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 1.5rem;
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
      border-color: #0070f3;
    }

    .review-section {
      margin-bottom: 2rem;
    }

    .review-section h2 {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 1rem;
    }

    .review-text {
      color: #666;
      margin-bottom: 1.5rem;
    }

    .terms-section {
      margin-bottom: 1.5rem;
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
      color: #0070f3;
      text-decoration: none;
    }

    .terms-link:hover {
      text-decoration: underline;
    }

    .pay-button {
      width: 100%;
      padding: 1rem;
      background: #0070f3;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .pay-button:hover {
      background: #0051cc;
    }

    .pay-button:disabled {
      background: #ccc;
      cursor: not-allowed;
    }

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

    .back-button {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
      color: #333;
      font-size: 1rem;
      padding: 0.5rem;
      margin-bottom: 1rem;
      cursor: pointer;
      transition: color 0.2s ease;
    }

    .back-button:hover {
      color: #0070f3;
    }

    .back-button img {
      width: 20px;
      height: 20px;
      vertical-align: middle;
    }

    @media (max-width: 768px) {
      .payment-container {
        margin: 1rem;
        padding: 1rem;
      }

      .nav {
        padding: 1rem;
      }

      .nav-links {
        gap: 1.5rem;
      }

      .form-row {
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
      <a href="gift-card.php">Gift Card</a>
      <a href="book-now.php">Book Now</a>
      <div id="authLinks">
        <a href="login.php" id="loginLink">Log in</a>
      </div>
    </div>
  </nav>

  <div class="payment-container">
    <a class="back-button" onclick="handleBack()">
      <img src="static/back icon.png" alt="Back">
      <span>Back</span>
    </a>

    <div class="payment-header">
      <h1>Complete Your Booking</h1>
    </div>

    <div class="booking-details">
      <h2>Booking Details</h2>
      <div class="booking-info">
        <div class="booking-info-item">
          <span class="booking-info-label">Package:</span>
          <span id="packageName"></span>
        </div>
        <div class="booking-info-item">
          <span class="booking-info-label">Branch:</span>
          <span id="branchName"></span>
        </div>
        <div class="booking-info-item">
          <span class="booking-info-label">Date:</span>
          <span id="bookingDate"></span>
        </div>
        <div class="booking-info-item">
          <span class="booking-info-label">Time:</span>
          <span id="bookingTime"></span>
        </div>
      </div>
    </div>

    <div class="order-summary">
      <h2>Order Summary</h2>
      <div class="order-details">
        <span>Package Fee</span>
        <span id="packagePrice"></span>
      </div>
      <div class="order-total">
        <span>Total</span>
        <span id="totalAmount"></span>
      </div>
    </div>

    <div class="payment-method">
      <h2>Payment Method</h2>
      <div class="gcash-option">
        <img src="static/gcash logo.jpg" alt="GCash Logo">
        <span>Pay with GCash</span>
      </div>
    </div>

    <div class="billing-address">
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

    <div class="review-section">
      <h2>Review & place order</h2>
      <p class="review-text">Review your details above and continue when you're ready.</p>
      
      <div class="terms-section">
        <div class="checkbox-group">
          <input type="checkbox" id="termsCheckbox" required>
          <label for="termsCheckbox">I agree to the <a href="#" class="terms-link">Terms & Conditions</a> *</label>
        </div>
        
        <div class="checkbox-group">
          <input type="checkbox" id="marketingCheckbox">
          <label for="marketingCheckbox">I agree to receive marketing communications via email and/or SMS to any emails and phone numbers added above</label>
        </div>
      </div>
    </div>

    <button class="pay-button" onclick="handlePayment()">Place Order & Pay</button>
  </div>

  <div class="overlay" id="overlay"></div>
  <div class="success-message" id="successMessage">
    Booking confirmed! 🎉<br>
    Thank you for choosing Moonlight Photos.<br>
    Redirecting to homepage...
  </div>

  <script src="static/js/auth.js"></script>
  <script>
    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const package = urlParams.get('package') || 'Lunar Package';
    const branch = urlParams.get('branch') || 'Tanauan';
    const date = urlParams.get('date') || 'June 5, 2025';
    const time = urlParams.get('time') || '11:00 am';
    const price = urlParams.get('price') || '899';

    // Update page with booking details
    document.getElementById('packageName').textContent = package;
    document.getElementById('branchName').textContent = `${branch} Branch`;
    document.getElementById('bookingDate').textContent = date;
    document.getElementById('bookingTime').textContent = time;
    document.getElementById('packagePrice').textContent = `₱${price}`;
    document.getElementById('totalAmount').textContent = `₱${price}`;

    // Add event listeners for form validation
    const requiredInputs = document.querySelectorAll('input[required], select[required]');
    requiredInputs.forEach(input => {
        input.addEventListener('input', validateForm);
    });

    document.getElementById('termsCheckbox').addEventListener('change', validateForm);

    function handleBack() {
      const urlParams = new URLSearchParams(window.location.search);
      const source = urlParams.get('source');
      const giftType = urlParams.get('giftType');

      if (source === 'gift-card') {
        // If coming from gift card, redirect based on gift type
        if (giftType === 'self') {
          window.location.href = 'gift-card.html?type=self';
        } else if (giftType === 'other') {
          window.location.href = 'gift-card.html?type=other';
        } else {
          window.location.href = "gift-card.php";
        }
      } else {
        // If coming from booking, redirect to schedule page with preserved parameters
        const package = urlParams.get('package');
        const branch = urlParams.get('branch');
        window.location.href = `schedule.php?package=${encodeURIComponent(package)}&branch=${encodeURIComponent(branch)}`;
      }
    }

    function handlePayment() {
      // Validate required fields
      const requiredFields = [
        'firstName',
        'lastName',
        'phone',
        'country',
        'address',
        'city',
        'zipCode'
      ];

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
      const termsChecked = document.getElementById('termsCheckbox').checked;
      if (!termsChecked) {
        alert('Please agree to the Terms & Conditions');
        return;
      }

      if (!isValid) {
        alert('Please fill in all required fields');
        return;
      }

      // Show overlay and success message
      document.getElementById('overlay').classList.add('show');
      document.getElementById('successMessage').classList.add('show');
      
      // Redirect to homepage after 2.5 seconds
      setTimeout(() => {
        window.location.href = "index.php";
      }, 2500);
    }
  </script>
</body>
</html> 