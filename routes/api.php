<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderApiController;


// Test route
Route::get('/orders/test', function () {
    return response()->json(['success' => true]);
});


/*
|--------------------------------------------------------------------------
| PUBLIC API ROUTES
|--------------------------------------------------------------------------
*/

// Public order search (static route first!)
Route::get('/orders/search', [OrderApiController::class, 'search']);

/*
|--------------------------------------------------------------------------
| PROTECTED API ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/orders', [OrderApiController::class, 'index']);

    // Dynamic route must come after static routes
    Route::get('/orders/{id}', [OrderApiController::class, 'show']);

    Route::put('/orders/{id}/status', [OrderApiController::class, 'changeStatus']);
    Route::post('/orders/{id}/photo', [OrderApiController::class, 'uploadPhoto']);
});