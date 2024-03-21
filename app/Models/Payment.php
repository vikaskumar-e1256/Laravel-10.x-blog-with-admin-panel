<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_email',
        'transaction_id',
        'subscription_id',
        'payment_gateway',
        'payment_amount',
        'payment_status',
        'currency',
        'payment_method',
        'payload',
        'payment_date',
        'pricing_plan_id',
        'subscription_plan_id',
        'subscription_start_date',
        'subscription_end_date',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}
