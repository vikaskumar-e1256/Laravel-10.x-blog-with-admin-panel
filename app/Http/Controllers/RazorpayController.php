<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\RazorpayService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            return response()->json(['error' => 'Invalid webhook signature'], 403);
        }

        // Handle the webhook payload to confirm payment status
        $payload = json_decode($request->getContent(), true);
        // Log the entire payload for debugging
        Log::channel('payment_activity_log')->debug("Razorpay Webhook Received: " . json_encode($payload, JSON_PRETTY_PRINT));

        // Parse webhook payload
        $eventType = $payload['event'];
        $paymentStatus = $payload['payload']['payment']['entity']['status'];

        // Handle the events
        switch ($eventType) {
            case 'payment.authorized':
                Payment::updateOrCreate([
                    'transaction_id' => $payload['payload']['payment']['entity']['id'],
                ], [
                    'user_email' => $payload['payload']['payment']['entity']['notes']['email'],
                    'payment_gateway' => 'Razorpay',
                    'payment_amount' => $payload['payload']['payment']['entity']['amount'] / 100, // Assuming amount is in paisa, converting to rupees
                    'payment_status' => $paymentStatus,
                    'currency' => $payload['payload']['payment']['entity']['currency'],
                    'payment_method' => $payload['payload']['payment']['entity']['method'],
                    'payment_date' => Carbon::createFromTimestamp($payload['created_at']),
                ]);
                break;

            case 'payment.failed':
                Payment::updateOrCreate([
                    'transaction_id' => $payload['payload']['payment']['entity']['id'],
                ], [
                    'payment_status' => $paymentStatus,
                ]);
                break;

            case 'payment.captured':
                Payment::updateOrCreate([
                    'transaction_id' => $payload['payload']['payment']['entity']['id'],
                ], [
                    'payment_status' => $paymentStatus,
                ]);
                break;

            case 'subscription.charged':
                Payment::updateOrCreate([
                    'transaction_id' => $payload['payload']['payment']['entity']['id'],
                ], [
                    'user_id' => $payload['payload']['subscription']['entity']['notes']['user_id'],
                    'user_email' => $payload['payload']['subscription']['entity']['notes']['user_email'],
                    'payment_status' => $paymentStatus,
                    'subscription_id' => $payload['payload']['subscription']['entity']['id'],
                    'subscription_start_date' => Carbon::createFromTimestamp($payload['payload']['subscription']['entity']['current_start']),
                    'subscription_end_date' => Carbon::createFromTimestamp($payload['payload']['subscription']['entity']['current_end']),
                    'pricing_plan_id' => $payload['payload']['subscription']['entity']['notes']['pricing_plan_id'] ?? null,
                    'subscription_plan_id' => $payload['payload']['subscription']['entity']['plan_id'],
                    'payload' => $payload
                ]);
                break;

            case 'subscription.cancelled':
                Payment::updateOrCreate([
                    'subscription_id' => $payload['payload']['subscription']['entity']['id']
                ], [
                    'payment_status' => $paymentStatus,
                    'payload' => $payload
                ]);
                break;

            case 'subscription.completed':
                Payment::updateOrCreate([
                    'subscription_id' => $payload['payload']['subscription']['entity']['id']
                ], [
                    'payment_status' => $paymentStatus,
                    'payload' => $payload
                ]);
                break;

            case 'subscription.activated':
                Payment::updateOrCreate([
                    'subscription_id' => $payload['payload']['subscription']['entity']['id']
                ], [
                    'payment_status' => $paymentStatus,
                    'payload' => $payload
                ]);
                break;

            case 'subscription.pending':
                Payment::updateOrCreate([
                    'subscription_id' => $payload['payload']['subscription']['entity']['id']
                ], [
                    'payment_status' => $paymentStatus,
                    'payload' => $payload
                ]);
                break;

            default:
                // Log unsupported event types
                Log::channel('payment_activity_log')->warning("Unhandled Razorpay Webhook Event: {$payload['event']}");
                break;
        }
        return response()->json(['message' => 'Webhook processed successfully']);
    }

}
