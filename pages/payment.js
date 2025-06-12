import { useRouter } from 'next/router';
import PaymentPage from '../components/PaymentPage';

export default function Payment() {
  const router = useRouter();
  const { amount, type } = router.query;

  if (!amount || !type) {
    return <div>Loading...</div>;
  }

  return (
    <PaymentPage 
      amount={parseFloat(amount)} 
      giftCardType={type}
    />
  );
} 