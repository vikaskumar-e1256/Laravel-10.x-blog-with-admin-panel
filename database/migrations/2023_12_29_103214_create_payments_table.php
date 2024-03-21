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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_email')->nullable();
            $table->string('transaction_id');
            $table->string('subscription_id')->nullable();
            $table->string('payment_gateway');
            $table->decimal('payment_amount', 8, 2);
            $table->string('payment_status');
            $table->string('currency');
            $table->string('payment_method');
            $table->json('payload')->nullable();
            $table->timestamp('payment_date');
            $table->unsignedBigInteger('pricing_plan_id')->nullable();
            $table->string('subscription_plan_id')->nullable();
            $table->timestamp('subscription_start_date')->nullable();
            $table->timestamp('subscription_end_date')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('pricing_plan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
