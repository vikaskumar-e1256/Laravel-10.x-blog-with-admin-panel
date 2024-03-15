<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Free Plan',
                'price' => 0.00,
                'interval' => 'mo',
                'features' => 'Limited to 1 blog post per month.',
                'post_limit' => 1,
                'razorpay_plan_id' => NULL
            ],
            [
                'name' => 'Starter Plan',
                'price' => 9.99,
                'interval' => 'mo',
                'features' => 'Up to 15 blog posts per month.',
                'post_limit' => 15,
                'razorpay_plan_id' => 'plan_NI7lY3XbepMtS4'
            ],
            [
                'name' => 'Business Plan',
                'price' => 49.99,
                'interval' => 'mo',
                'features' => 'Unlimited blog posts per month.',
                'post_limit' => null, // Unlimited posts
                'razorpay_plan_id' => 'plan_NI7mTBgAMOOStt'
            ],
        ];

        \DB::table('pricing_plans')->insert($plans);
    }
}
