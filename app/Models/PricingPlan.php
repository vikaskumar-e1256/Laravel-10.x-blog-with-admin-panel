<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'razorpay_plan_id',
        'stripe_plan_id',
        'name',
        'price',
        'interval',
        'features',
        'post_limit',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
