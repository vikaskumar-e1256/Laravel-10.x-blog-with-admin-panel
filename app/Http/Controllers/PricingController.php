<?php

namespace App\Http\Controllers;

use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $pricingPlans = PricingPlan::active()->get();
        return view('site.pricing', compact('pricingPlans'));
    }
}
