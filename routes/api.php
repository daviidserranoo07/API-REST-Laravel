<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Public routes without authentication for user registration and login
 */
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

/**
 * Protected routes with sanctum authentication, we need to 
 * pass the token in the header but we can use the same routes
 */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout',[AuthController::class,'logout']);

    Route::get('product/title/{product:title}',[ProductController::class,'showTitle']);
    Route::apiResource('product',ProductController::class)->except('create','edit');    
});

