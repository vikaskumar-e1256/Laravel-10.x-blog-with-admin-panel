<?php

namespace App\Http\Controllers;

use App\Models\PricingPlan;
use Illuminate\Http\Request;
use App\Services\StripeService;
use App\Services\RazorpayService;

class PaymentController extends Controller
{
    private $razorpayService;
    private $stripeService;

    public function __construct(RazorpayService $razorpayService /*, StripeService $stripeService*/)
    {
        $this->razorpayService = $razorpayService;
        // $this->stripeService = $stripeService;
    }

    public function checkout($id)
    {
        $plan = PricingPlan::where('id', $id)->firstOrFail();
        return view('site.checkout', compact('plan'));
    }

    public function payNow(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            if ($request->paymentMethod === "razorpay") {
                $result = $this->razorpayPayment($request);
            }else if ($request->paymentMethod === "stripe") {
                $result = $this->stripePayment($request);
            }
            return response()->json($result);
        }
    }

    public function razorpayPayment($request)
    {
        $plan = PricingPlan::where('id', $request->plan)->first();
        if (!$plan) {
            $array = [
                "success" => false,
                "message" => "Plan does not exist."
            ];
            return $array;
        }

        $result = $this->razorpayService->createOrder($plan);

        return $result;
    }

    public function stripePayment(Request $request)
    {
        $amount = $request->input('amount');
        $result = $this->stripeService->createPaymentIntent($amount);

        return response()->json($result);
    }
}
