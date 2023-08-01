<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::middleware('auth:api')->group(function () {
    Route::get('products', [ProductController::class, 'index']);
    Route::middleware('is_admin')->group(function () {
        Route::post('products', [ProductController::class, 'store']);
    });

    Route::post('logout', [AuthController::class, 'logout']);
});;