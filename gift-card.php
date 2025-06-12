<?php
require_once 'config/database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Moonlight Photos - Gift Card</title>
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

    /* Gift Card Section Styles */
    .gift-card-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: start;
    }

    .gift-card-image {
      background: transparent;
      padding: 2rem;
      border-radius: 8px;
      text-align: center;
    }

    .gift-card-image img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .gift-card {
      display: none;
    }

    .gift-card-form {
      padding: 1rem;
    }

    .gift-card-title {
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
      color: #333;
    }

    .gift-card-price {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 1rem;
    }

    .gift-card-description {
      color: #666;
      margin-bottom: 2rem;
      line-height: 1.6;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      color: #666;
    }

    .amount-options {
      display: flex;
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .amount-option {
      padding: 0.5rem 2rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .amount-option:hover {
      border-color: #efb4b4;
    }

    .amount-option.active {
      background-color: #efb4b4;
      border-color: #efb4b4;
      color: white;
    }

    .form-input {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-bottom: 0.5rem;
    }

    .form-message {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      height: 100px;
      resize: none;
    }

    .buy-now-btn {
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

    .buy-now-btn:hover {
      background: #9ED3CC;
    }

    .recipient-info {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
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

      .gift-card-container {
        grid-template-columns: 1fr;
        gap: 2rem;
      }

      .recipient-info {
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

    .recipient-selection {
      display: flex;
      gap: 1rem;
      margin-top: 0.5rem;
    }

    .recipient-option {
      flex: 1;
      background: #fff;
      border: 2px solid #FFE4E4;
      border-radius: 8px;
      padding: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
      text-align: center;
    }

    .recipient-option:hover {
      border-color: #efb4b4;
    }

    .recipient-option input[type="radio"] {
      display: none;
    }

    .recipient-option label {
      cursor: pointer;
      font-size: 0.9rem;
      color: #333;
    }

    .recipient-option input[type="radio"]:checked + label {
      color: #FF6B6B;
      font-weight: 500;
    }

    .recipient-option input[type="radio"]:checked + label::before {
      content: "✓";
      margin-right: 0.5rem;
    }

    .recipient-option:has(input[type="radio"]:checked) {
      border-color: #FF6B6B;
      background-color: #FFF5F5;
    }

    /* Add these new styles */
    .checkout-layout {
      margin-top: 2rem;
      background: #f8f8f8;
      border-radius: 8px;
      padding: 2rem;
    }

    .checkout-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    .checkout-title {
      font-size: 1.5rem;
      color: #333;
      font-weight: 500;
    }

    .continue-browsing {
      color: #333;
      text-decoration: underline;
      font-size: 0.9rem;
    }

    .customer-details {
      margin-top: 2rem;
    }

    .customer-details h2 {
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

    .order-summary {
      background: white;
      border-radius: 8px;
      padding: 1.5rem;
      margin-top: 2rem;
    }

    .order-summary h2 {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 1rem;
    }

    .order-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #eee;
    }

    .order-item img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 4px;
    }

    .order-item-details {
      flex: 1;
    }

    .order-item-title {
      font-weight: 500;
      color: #333;
      margin-bottom: 0.25rem;
    }

    .order-item-qty {
      color: #666;
      font-size: 0.9rem;
    }

    .order-totals {
      margin-top: 1rem;
    }

    .total-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 0.5rem;
      color: #666;
      font-size: 0.9rem;
    }

    .total-row.final {
      color: #333;
      font-weight: 500;
      font-size: 1rem;
      margin-top: 1rem;
      padding-top: 1rem;
      border-top: 1px solid #eee;
    }

    .loyalty-notice {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: #666;
      font-size: 0.9rem;
      margin: 1rem 0;
    }

    .loyalty-notice svg {
      width: 16px;
      height: 16px;
    }

    .secure-checkout {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      color: #666;
      font-size: 0.9rem;
      margin-top: 1rem;
    }

    .secure-checkout svg {
      width: 14px;
      height: 14px;
    }

    @media (max-width: 768px) {
      .form-row {
        grid-template-columns: 1fr;
      }

      .checkout-layout {
        padding: 1rem;
      }
    }

    /* Add notification styles */
    .notification {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #4CAF50;
      color: white;
      padding: 16px 32px;
      border-radius: 4px;
      font-size: 1rem;
      z-index: 1000;
      display: none;
    }

    .notification.show {
      display: block;
      animation: fadeInOut 2.5s ease-in-out;
    }

    @keyframes fadeInOut {
      0% { opacity: 0; }
      15% { opacity: 1; }
      85% { opacity: 1; }
      100% { opacity: 0; }
    }

    /* Success Message Styles */
    .success-message {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #efb4b4;
        color: white;
        padding: 2rem 3rem;
        border-radius: 12px;
        text-align: center;
        font-size: 1.2rem;
        font-weight: 500;
        box-shadow: 0 4px 20px rgba(239, 180, 180, 0.3);
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

    /* For myself section specific styles */
    #forMyselfForm .success-message {
      border-left: 5px solid #B4E0D9;
    }

    /* For someone else section specific styles */
    #forSomeoneElseForm .success-message {
      border-left: 5px solid #efb4b4;
    }

    /* For someone else section specific styles */
    #giftSuccessMsg {
        border: 2px solid #fff;
        background-color: #efb4b4;
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

    /* Add overlay styles */
    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .overlay.show {
        display: block;
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

  <div class="notification" id="notification">Successfully!</div>

  <div class="success-message" id="bookingSuccess">✨ Booking successful!</div>

  <main>
    <div class="gift-card-container">
      <div class="gift-card-image">
        <img src="static/Gcard.png" alt="Moonlight Photos Gift Card">
        <div class="gift-card"></div>
      </div>
      
      <div class="gift-card-form">
        <h1 class="gift-card-title">Digital Gift Card</h1>
        <p class="gift-card-price">₱799</p>
        <p class="gift-card-description">
          Ideal for gift emergencies. We got you covered. You can't go wrong with a gift card. Choose an amount and write a personalized message to make this gift your own.
        </p>

        <form id="giftCardForm">
          <div class="form-group">
            <label class="form-label">Who is the gift card for? *</label>
            <div class="recipient-selection">
              <div class="recipient-option">
                <input type="radio" id="forSomeoneElse" name="recipient" value="someone-else" required>
                <label for="forSomeoneElse">For someone else</label>
              </div>
              <div class="recipient-option">
                <input type="radio" id="forMyself" name="recipient" value="myself" required>
                <label for="forMyself">For myself</label>
              </div>
            </div>
          </div>

          <div id="giftCardDetails" style="display: none;">
            <div class="form-group">
              <label class="form-label">Amount</label>
              <div class="amount-options">
                <div class="amount-option active">₱799</div>
                <div class="amount-option">₱999</div>
                <div class="amount-option">₱1,499</div>
              </div>
            </div>

            <div id="selfPurchaseFields" style="display: none;">
              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" name="email">
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label">First name</label>
                  <input type="text" class="form-input" name="firstName">
                </div>
                <div class="form-group">
                  <label class="form-label">Last name</label>
                  <input type="text" class="form-input" name="lastName">
                </div>
              </div>
              <div class="form-group">
                <label class="form-label">Phone</label>
                <input type="tel" class="form-input" name="phone">
              </div>
            </div>

            <div id="recipientFields" style="display: none;">
              <div class="form-group">
                <label class="form-label">Recipient email</label>
                <input type="email" class="form-input" name="recipientEmail" placeholder="Recipient email">
              </div>

              <div class="form-group">
                <label class="form-label">Recipient name</label>
                <input type="text" class="form-input" name="recipientName" placeholder="Recipient name">
              </div>

              <div class="form-group">
                <label class="form-label">Delivery date</label>
                <input type="date" class="form-input" name="deliveryDate" placeholder="Select delivery date">
              </div>

              <div class="form-group">
                <label class="form-label">Message</label>
                <textarea class="form-message" name="message" placeholder="Add a personal message..."></textarea>
              </div>
            </div>

            <button type="submit" class="buy-now-btn">Buy Now</button>
          </div>
        </form>
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
    // Get all amount options and price display element
    const amountOptions = document.querySelectorAll('.amount-option');
    const priceDisplay = document.querySelector('.gift-card-price');
    const recipientOptions = document.querySelectorAll('input[name="recipient"]');
    const giftCardDetails = document.getElementById('giftCardDetails');
    const recipientFields = document.getElementById('recipientFields');
    const selfPurchaseFields = document.getElementById('selfPurchaseFields');
    const giftCardForm = document.getElementById('giftCardForm');

    // Function to handle form submission and redirect to payment
    function handleFormSubmission(e) {
      e.preventDefault();
      
      const selectedRecipient = document.querySelector('input[name="recipient"]:checked');
      if (!selectedRecipient) {
        alert('Please select who the gift card is for');
        return;
      }

      // Get selected amount
      const activeAmount = document.querySelector('.amount-option.active');
      const amount = activeAmount ? activeAmount.textContent.replace('₱', '') : '799';

      // Get recipient type
      const type = selectedRecipient.value;
      const giftType = type === 'myself' ? 'self' : 'other';

      let params = new URLSearchParams();
      params.append('amount', amount);
      params.append('giftType', giftType);

      if (giftType === 'other') {
        // Get recipient details
        const recipientEmail = document.querySelector('input[name="recipientEmail"]').value || '';
        const recipientName = document.querySelector('input[name="recipientName"]').value || 'Not Provided';
        const deliveryDate = document.querySelector('input[name="deliveryDate"]').value || 'Not Provided';
        const message = document.querySelector('textarea[name="message"]').value || 'Not Provided';

        params.append('recipientEmail', recipientEmail);
        params.append('recipientName', recipientName);
        params.append('deliveryDate', deliveryDate);
        params.append('message', message);
      } else {
        // Get self purchase details
        const email = document.querySelector('input[name="email"]').value || '';
        const firstName = document.querySelector('input[name="firstName"]').value || 'Not Provided';
        const lastName = document.querySelector('input[name="lastName"]').value || 'Not Provided';
        const phone = document.querySelector('input[name="phone"]').value || 'Not Provided';

        params.append('email', email);
        params.append('firstName', firstName);
        params.append('lastName', lastName);
        params.append('phone', phone);
      }

      // Redirect to payment page with parameters
      window.location.href = `gift-card-payment.php?${params.toString()}`;
    }

    // Add click event listener to each amount option
    amountOptions.forEach(option => {
      option.addEventListener('click', function() {
        // Remove active class from all options
        amountOptions.forEach(opt => opt.classList.remove('active'));
        
        // Add active class to clicked option
        this.classList.add('active');
        
        // Update price display
        const selectedPrice = this.textContent;
        priceDisplay.textContent = selectedPrice;
      });
    });

    // Handle recipient selection
    recipientOptions.forEach(option => {
      option.addEventListener('change', function() {
        giftCardDetails.style.display = 'block';
        
        if (this.value === 'someone-else') {
          recipientFields.style.display = 'block';
          selfPurchaseFields.style.display = 'none';
        } else {
          recipientFields.style.display = 'none';
          selfPurchaseFields.style.display = 'block';
        }
      });
    });

    // Handle form submission
    giftCardForm.addEventListener('submit', handleFormSubmission);

    // Set default selection to "For Someone Else"
    document.getElementById('forSomeoneElse').checked = true;
    recipientFields.style.display = 'block';
    selfPurchaseFields.style.display = 'none';
    giftCardDetails.style.display = 'block';
  </script>

  <!-- Success message popup -->
  <div id="overlay" class="overlay"></div>
  <div id="successMessage" class="success-message">
      Gift card purchase successful! 🎁<br>
      You will receive a confirmation message shortly.
  </div>

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