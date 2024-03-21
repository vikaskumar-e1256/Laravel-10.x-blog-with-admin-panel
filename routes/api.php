<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\PricingController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\RazorpayController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/razorpay-webhook', [RazorpayController::class, 'handleWebhook']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth/')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::middleware(['auth:api'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });

});
Route::middleware(['auth:api'])->group(function () {
    Route::post('checkout', [PaymentController::class, 'checkout']);
    Route::post('pay-now', [PaymentController::class, 'payNow']);
    Route::post('verify-payment-signature-rzp', [PaymentController::class, 'verifyPaymentSignatureRazorpay']);
});

Route::get('plans', PricingController::class);
Route::get('posts', [PostController::class, 'getAllPosts']);
Route::get('post/{slug}', [PostController::class, 'getPostBySlug']);
