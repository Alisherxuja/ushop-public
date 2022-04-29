<?php

use App\Http\Controllers\Admin\ProfileController;


Route::get('/get', [ProfileController::class, 'get']);
Route::post('/password', [ProfileController::class, 'password']);
Route::post('/update', [ProfileController::class, 'update']);
