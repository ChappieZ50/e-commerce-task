<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::get('products', [ProductController::class, 'index']);
Route::post('cart', [CartController::class, 'store']);

Route::middleware('auth:api')->group(function () {
    Route::middleware('is_admin')->group(function () {
        Route::post('products', [ProductController::class, 'store']);
        Route::delete('products/{id}', [ProductController::class, 'destroy']);
        Route::get('products/{id}', [ProductController::class, 'show']);
    });

    Route::post('logout', [AuthController::class, 'logout']);
});;