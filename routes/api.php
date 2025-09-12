<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::put('users/{user}', [UserController::class, 'update']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/deposit', [TransactionController::class, 'deposit']);
    Route::post('/transfer', [TransactionController::class, 'transfer']);
    Route::post('/transactions/{id}/reverse', [TransactionController::class, 'reverse']);
    Route::get('/transactions', [TransactionController::class, 'history']);
});
