<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\Auth\LoginController;
use App\Http\Controllers\Site\Auth\RegisterController;
use App\Http\Controllers\Site\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SiteController::class, 'home'])
    ->name('site.home');

Route::get('/post/{slug}', [SiteController::class, 'post'])
    ->name('site.post');

Route::get('/about', [SiteController::class, 'about'])
    ->name('site.about');

Route::get('/contact-us', [SiteController::class, 'contactUs'])
    ->name('site.contact');

Route::get('posts/category/{slug}', [SiteController::class, 'showByCategory'])
    ->name('site.posts.category');
Route::get('posts/tag/{slug}', [SiteController::class, 'showByTag'])
    ->name('site.posts.tag');
Route::post('/like/{postId}', [SiteController::class, 'like'])
    ->name('site.post.like');

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('pricing', function() {
    return view('site.pricing');
});
