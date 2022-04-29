<?php

use App\Http\Controllers\Telegram\AuthController;

Route::get('login', [AuthController::class, 'login']);
Route::get('sign-up', [AuthController::class, 'signUp']);