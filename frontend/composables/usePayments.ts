const usePayments = () => {
  const types = [
    { key: 'bank', name: 'Skarbonka'},
    { key: 'pay_later', name: 'Płatność odroczona'},
    { key: 'monetivo', name: 'Płatności online (Monetivo)'},
    { key: 'online', name: 'Płatności online (Transferuj.pl)'},
    { key: 'dotpay', name: 'Płatności online (Dotpay.pl)'},
    { key: 'paynow', name: 'Płatności online (Paynow.pl)'},
  ]

  return {
    types
  }
}

export default usePayments;