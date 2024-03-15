<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeService
{
    private $stripeKey;

    public function __construct($stripeKey)
    {
        $this->stripeKey = $stripeKey;
        Stripe::setApiKey($this->stripeKey);
    }

    public function createPaymentIntent($amount, $currency = 'usd')
    {
        try {
            $intent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => $currency,
                // Add more PaymentIntent details as needed
            ]);

            return ['client_secret' => $intent->client_secret];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
