<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderPhotoController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Public search page
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Public order search
Route::get('/search', [HomeController::class, 'search'])
    ->name('orders.search');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard',
        [HomeController::class, 'dashboard'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | USERS
    |--------------------------------------------------------------------------
    */

    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | ORDERS
    |--------------------------------------------------------------------------
    */

    Route::resource('orders', OrderController::class);

    // Archived Orders
    Route::get('/orders-archived',
        [OrderController::class, 'archived'])
        ->name('orders.archived');

    // Restore Archived Order
    Route::post('/orders/{id}/restore',
        [OrderController::class, 'restore'])
        ->name('orders.restore');

    // Change Status
    Route::post('/orders/{id}/status',
        [OrderController::class, 'changeStatus'])
        ->name('orders.changeStatus');

    // Upload Photos
    Route::post('/orders/{orderId}/photos',
        [OrderPhotoController::class, 'store'])
        ->name('orders.photos.store');

    /*
    |--------------------------------------------------------------------------
    | CUSTOMERS
    |--------------------------------------------------------------------------
    */

    Route::resource('customers', CustomerController::class);

});