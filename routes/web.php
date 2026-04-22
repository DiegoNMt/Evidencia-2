<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderPhotoController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('orders.search');

// 1. Apunta a nuestra nueva interfaz de CoreUI
/*Route::get('/login', [HomeController::class, 'dashboard'])
    ->name('dashboard')
    ->middleware('auth');*/

// 2. Rutas del andamiaje de Autenticación (Login, Registro, Recuperación)
Auth::routes();

// 3. Ruta de inicio post-autenticación
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 4. Resource Routes for Users
Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');

// 5. Resource Routes for orders y customers
Route::resource('orders', OrderController::class);
Route::resource('customers', CustomerController::class);

Route::get('orders-deleted', [OrderController::class, 'deleted'])->name('orders.deleted');
Route::post('orders/{id}/restore', [OrderController::class, 'restore'])->name('orders.restore');
Route::post('orders/{id}/status', [OrderController::class, 'changeStatus'])->name('orders.changeStatus');
Route::post('orders/{orderId}/photos', [OrderPhotoController::class, 'store'])->name('orders.photos.store');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::resource('users', App\Http\Controllers\UserController::class);

    Route::resource('orders', OrderController::class);
    Route::get('orders-archived', [OrderController::class, 'archived'])->name('orders.archived');
    Route::post('orders/{id}/restore', [OrderController::class, 'restore'])->name('orders.restore');
    Route::post('orders/{id}/status', [OrderController::class, 'changeStatus'])->name('orders.changeStatus');
    Route::post('orders/{orderId}/photos', [OrderPhotoController::class, 'store'])->name('orders.photos.store');
});