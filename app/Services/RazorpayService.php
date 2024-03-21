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

    public function createOrder($plan, $currency = 'INR', $user)
    {
        try {
            $razorpay = new RazorpayApi($this->razorpayApiKey, $this->razorpaySecretKey);

            $order = $razorpay->subscription->create(
                array(
                    'plan_id' => $plan->razorpay_plan_id,
                    'customer_notify' => 1,
                    'quantity' => 1,
                    'total_count' => 12, // Set to null for recurring billing until canceled
                    'start_at' => now(),
                    'addons' => array(
                        array('item' =>
                        array('name' => $plan->name, 'amount' => $plan->price*100, 'currency' =>$currency))
                    ),
                    'notes' => array(
                        "pricing_plan_id" => $plan->id,
                        "user_id" => $user->id,
                        "user_name" => $user->name,
                        "user_email" => $user->email,
                    )
                )
            );
            \Log::channel('payment_activity_log')->debug("Subscription Order Created. Order URL: ".$order->id);
            return ['payurl' => $order->short_url, 'subscription_id' => $order->id, 'plan_id' => $order->plan_id];
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
            \Log::alert("verifyWebhookSignature::failed".$e->getMessage());
            return false;
        }
    }

    public function verifyPaymentSignature($razorpayPaymentId, $razorpaySubscriptionId, $razorpaySignature)
    {
        return $this->generateSignatureRzp($razorpayPaymentId, $razorpaySubscriptionId, $razorpaySignature);
    }

    private function generateSignatureRzp($razorpay_payment_id, $subscription_id, $razorpay_signature)
    {
        $generated_signature = hash_hmac("sha256", $razorpay_payment_id . "|" . $subscription_id, $this->razorpaySecretKey);

        if ($generated_signature == $razorpay_signature) {
            return true;
        }
        return false;
    }

}
