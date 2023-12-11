<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;

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

Route::get('posts/category/{slug}', [SiteController::class, 'showByCategory'])
    ->name('site.posts.category');
Route::get('posts/tag/{slug}', [SiteController::class, 'showByTag'])
    ->name('site.posts.tag');
