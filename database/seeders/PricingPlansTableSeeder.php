<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PricingPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pricingPlans = [
            [
                'name' => 'Free',
                'price' => 0,
                'features' => '1 Blog Post / Month, Basic Support, Email Support, Unlimited Access',
                'post_limit' => 1,
            ],
            [
                'razorpay_plan_id' => 'plan_NnmHLkSEsgjTGP',
                'stripe_plan_id' => 'YOUR_STRIPE_PLAN_ID_2', // Replace with your actual plan ID
                'name' => 'Basic',
                'price' => 10,
                'features' => '4 Blog Posts / Month, Email Support, Email Support, Unlimited Access',
                'post_limit' => 2,
            ],
            [
                'razorpay_plan_id' => 'plan_NnmJcQmu8IluHc',
                'stripe_plan_id' => 'YOUR_STRIPE_PLAN_ID_3',
                'name' => 'Premium',
                'price' => 20,
                'features' => 'Unlimited Blog Posts / Month, Email & Phone Support, 24/7 Priority Support',
                'post_limit' => null, // No post limit for Premium plan
            ],
        ];

        foreach ($pricingPlans as $plan) {
            PricingPlan::create($plan);
        }
    }
}
