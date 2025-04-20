<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//____CategoryController Routes
Route::apiResource('categories', CategoryController::class);
//____ProductController Routes
Route::apiResource('products', ProductController::class);
