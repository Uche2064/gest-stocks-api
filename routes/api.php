<?php

use App\Http\Controllers\API\auth\AuthController;
use App\Http\Controllers\API\category\CategoryController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::resource('categories', CategoryController::class);
});