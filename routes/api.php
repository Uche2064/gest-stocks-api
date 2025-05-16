<?php

use App\Http\Controllers\API\auth\AuthController;
use App\Http\Controllers\API\category\CategoryController;
use App\Http\Controllers\product\ProductController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::apiResource('categories', CategoryController::class);


    Route::apiResource('products', ProductController::class);
    Route::get('products/category/{category_id}', [ProductController::class, 'get_by_category']);
});