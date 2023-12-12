<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Tag\TagController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Post\PostController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Category\CategoryController;

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
Route::get('/admin-login', [LoginController::class, 'showLoginForm'])
    ->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])
    ->name('admin.post.login');

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
        Route::get('ajax', [PostController::class, 'getPostsData'])
            ->name('data');


    });

    // Category Routes
    Route::prefix('categories/')->name('categories.')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])
            ->name('list');
        Route::get('create', [CategoryController::class, 'create'])
            ->name('create');
        Route::post('store', [CategoryController::class, 'store'])
            ->name('store');
        Route::get('ajax', [CategoryController::class, 'getCategoryData'])
            ->name('data');
    });

    // Tag Routes
    Route::prefix('tags/')->name('tags.')->group(function(){
        Route::get('/', [TagController::class, 'index'])
            ->name('list');
        Route::get('create', [TagController::class, 'create'])
            ->name('create');
        Route::post('store', [TagController::class, 'store'])
            ->name('store');
        Route::get('ajax', [TagController::class, 'getTagData'])
            ->name('data');
    });

});
