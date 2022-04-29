<?php

use App\Http\Controllers\Telegram\AuthController;

Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('me', [AuthController::class, 'me']);
Route::post('logout', [AuthController::class, 'logout']);