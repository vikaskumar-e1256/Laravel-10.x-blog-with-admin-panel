<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Post\PostController;

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
Route::prefix('admin/')->name('admin.')->group(function() {
    // Dashboard Route
    Route::get('dashboard', [DashboardController::class, 'showDashboard'])
        ->name('dashboard');

    // Post Routes
    Route::prefix('posts/')->name('posts.')->group(function() {
        Route::get('/', [PostController::class, 'index'])
        ->name('list');
        Route::get('create', [PostController::class, 'create'])
        ->name('create');
        Route::post('store', [PostController::class, 'store'])
        ->name('store');
        Route::get('posts/data', [PostController::class, 'getPostsData'])
        ->name('data');

    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
