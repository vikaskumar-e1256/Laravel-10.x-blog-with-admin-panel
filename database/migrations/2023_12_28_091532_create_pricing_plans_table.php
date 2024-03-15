<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('razorpay_plan_id')->unique()->nullable();
            $table->string('stripe_plan_id')->unique()->nullable();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->string('interval')->default('mo');
            $table->text('features');
            $table->unsignedBigInteger('post_limit')->nullable();
            $table->timestamps();

            $table->index('razorpay_plan_id');
            $table->index('stripe_plan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_plans');
    }
};
