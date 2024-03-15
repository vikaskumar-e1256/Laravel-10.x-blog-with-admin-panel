<?php

namespace App\Services;

use Razorpay\Api\Api as RazorpayApi;

class RazorpayService
{
    private $razorpayApiKey;
    private $razorpaySecretKey;

    public function __construct()
    {
        $this->razorpayApiKey = env('RAZORPAY_KEY');
        $this->razorpaySecretKey = env('RAZORPAY_SECRET');
    }

    public function createOrder($plan, $currency = 'INR')
    {
        try {
            $razorpay = new RazorpayApi($this->razorpayApiKey, $this->razorpaySecretKey);

            $order = $razorpay->subscription->create(
                array(
                    'plan_id' => $plan->razorpay_plan_id,
                    'customer_notify' => 1,
                    'quantity' => 1,
                    'total_count' => 6,
                    'start_at' => now(),
                    'addons' => array(
                        array('item' =>
                        array('name' => $plan->name, 'amount' => $plan->price*100, 'currency' =>$currency))
                    ), 'notes' => array('key1' => 'value3', 'key2' => 'value2')
                )
            );
            \Log::debug("Subscription Order Created. Order URL: $order->short_url");
            return ['payurl' => $order->short_url];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function verifyWebhookSignature($signature, $payload, $webhookSecret)
    {
        $razorpay = new RazorpayApi($this->razorpayApiKey, $this->razorpaySecretKey);

        try {
            $razorpay->utility->verifyWebhookSignature($payload, $signature, $webhookSecret);
            return true;
        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            return false;
        }
    }
}
