<?php

namespace App\Http\Controllers\API;

use App\Models\PricingPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlansResource;

class PricingController extends Controller
{
    public function __invoke()
    {
        $plans = PricingPlan::active()->get();
        return PlansResource::collection($plans);
    }
}
