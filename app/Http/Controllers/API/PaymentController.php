<?php

namespace App\Http\Controllers\API;

use App\Models\PricingPlan;
use Illuminate\Http\Request;
use App\Services\RazorpayService;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlansResource;

class PaymentController extends Controller
{
    private $razorpayService;
    private $stripeService;

    public function __construct(RazorpayService $razorpayService /*, StripeService $stripeService*/)
    {
        $this->razorpayService = $razorpayService;
        // $this->stripeService = $stripeService;
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'planID' => 'required|exists:pricing_plans,id'
        ]);

        $plan = PricingPlan::where('id', $request->planID)->active()->first();
        if (!$plan) {
            $response = [
                'success' => false,
                'message' => 'Plan not found.',
            ];
            return response()->json($response, 404);
        }
        return new PlansResource($plan);
    }

    public function payNow(Request $request)
    {
        try {
            if ($request->isMethod('POST')) {
                if ($request->paymentMethod === "razorpay") {
                    $result = $this->razorpayPayment($request);
                } else if ($request->paymentMethod === "stripe") {
                    $result = $this->stripePayment($request);
                } else {
                    throw new \Exception("Invalid payment method.");
                }
                return response()->json($result);
            } else {
                throw new \Exception("Invalid request method.");
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "An error occurred while processing the payment."
            ], 500);
        }
    }

    public function razorpayPayment(Request $request)
    {
        $plan = PricingPlan::find($request->planID);
        if (!$plan) {
            return [
                "success" => false,
                "message" => "Plan does not exist."
            ];
        }
        $user = auth('api')->user();
        $result = $this->razorpayService->createOrder($plan, 'INR', $user);

        return $result;
    }

    public function verifyPaymentSignatureRazorpay(Request $request)
    {
        $razorpayPaymentId = $request->razorpay_payment_id;
        $razorpaySubscriptionId = $request->razorpay_subscription_id;
        $razorpaySignature = $request->razorpay_signature;
        
        $isSignatureVerified = $this->razorpayService->verifyPaymentSignature($razorpayPaymentId, $razorpaySubscriptionId, $razorpaySignature);

        if ($isSignatureVerified) {
            return response()->json(['success' => true, 'message' => 'Payment signature is verified.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Payment signature verification failed.']);
        }
    }


    public function stripePayment(Request $request)
    {
        $amount = $request->input('amount');
        $result = $this->stripeService->createPaymentIntent($amount);

        return response()->json($result);
    }
}
