<?php

use App\Http\Controllers\Telegram\CategoryController;

Route::get('parents', [CategoryController::class, 'parents']);
Route::get('/{category}', [CategoryController::class, 'child']);