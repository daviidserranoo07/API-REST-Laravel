<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('product/title/{product:title}',[ProductController::class,'showTitle']);
Route::get('product/id/{product:id}',[ProductController::class,'showId']);
Route::apiResource('product',ProductController::class)->except('create','edit');

