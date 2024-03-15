<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RazorpayService;

class RazorpayController extends Controller
{
    private $razorpayService;

    public function __construct(RazorpayService $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

    public function handleWebhook(Request $request)
    {
        $razorpaySignature = $request->header('x-razorpay-signature');
        $webhookSecret = env('RAZORPAY_WEBHOOK_SECRET'); // Your Razorpay webhook secret

        // Verify the webhook signature
        $valid = $this->razorpayService->verifyWebhookSignature($razorpaySignature, $request->getContent(), $webhookSecret);

        if (!$valid) {
            abort(403, 'Invalid webhook signature');
        }

        // Handle the webhook payload to confirm payment status
        $payload = json_decode($request->getContent(), true);

        // Log the entire payload for debugging
        \Log::debug("Razorpay Webhook Received: " . json_encode($payload, JSON_PRETTY_PRINT));

        // Handle different events
        switch ($payload['event']) {
            case 'payment.captured':
                $this->handlePaymentCapturedEvent($payload);
                break;

            case 'subscription.activated':
                $this->handleSubscriptionActivatedEvent($payload);
                break;

                // Add more cases for other events as needed

            default:
                // Handle unknown events or log them for reference
                \Log::warning("Unhandled Razorpay Webhook Event: {$payload['event']}");
                break;
        }

        return response()->json(['status' => 'success']);
    }

    protected function handlePaymentCapturedEvent(array $payload)
    {
        // Handle the payment captured event
        \Log::info("Payment Captured - Order ID: {$payload['order_id']}, Amount: {$payload['payload']['payment']['entity']['amount']}");
        // Add your database update or other actions here
    }

    protected function handleSubscriptionActivatedEvent(array $payload)
    {
        // Handle the subscription activated event
        \Log::info("Subscription Activated - Subscription ID: {$payload['subscription_id']}");
        // Add your database update or other actions here
    }

}
