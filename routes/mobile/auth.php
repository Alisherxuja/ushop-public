<?php


use App\Http\Controllers\Mobile\AuthController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'signUp']);