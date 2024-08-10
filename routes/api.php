<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout',[AuthController::class,'logout']);
    
    Route::get('product/title/{product:title}',[ProductController::class,'showTitle']);
    Route::apiResource('product',ProductController::class)->except('create','edit');    
});

