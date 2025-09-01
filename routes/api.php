<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);

// Example of protected route
Route::middleware('auth:sanctum')->get('/profile', function (\Illuminate\Http\Request $request) {
    return $request->user();
});
