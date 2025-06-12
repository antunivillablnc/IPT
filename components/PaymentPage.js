import React, { useState } from 'react';
import { useRouter } from 'next/router';
import Image from 'next/image';
import styles from '../styles/PaymentPage.module.css';

const PaymentPage = ({ amount, giftCardType }) => {
  const router = useRouter();
  const [isLoading, setIsLoading] = useState(false);

  const handlePlaceOrder = async () => {
    setIsLoading(true);
    try {
      // Here you would implement the actual payment processing logic
      // For now, we'll simulate a successful payment
      await new Promise(resolve => setTimeout(resolve, 1500));
      
      // Show success message
      alert('Payment successful! Thank you for your purchase.');
      
      // Redirect to homepage
      router.push('/');
    } catch (error) {
      alert('Payment failed. Please try again.');
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className={styles.container}>
      <div className={styles.paymentCard}>
        <h1>Checkout</h1>
        
        <div className={styles.orderSummary}>
          <h2>Order Summary</h2>
          <div className={styles.orderDetails}>
            <p>Digital Gift Card ({giftCardType})</p>
            <p>₱{amount.toFixed(2)}</p>
          </div>
          <div className={styles.totalAmount}>
            <h3>Total</h3>
            <h3>₱{amount.toFixed(2)}</h3>
          </div>
        </div>

        <div className={styles.paymentMethod}>
          <h2>Payment Method</h2>
          <div className={styles.gcashOption}>
            <Image
              src="/static/gcash logo.jpg"
              alt="GCash Logo"
              width={80}
              height={40}
              objectFit="contain"
            />
            <p>Pay with GCash</p>
          </div>
        </div>

        <button
          className={styles.paymentButton}
          onClick={handlePlaceOrder}
          disabled={isLoading}
        >
          {isLoading ? 'Processing...' : 'Place Order and Pay'}
        </button>
      </div>
    </div>
  );
};

export default PaymentPage; 