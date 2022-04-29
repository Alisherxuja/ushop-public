<?php

use App\Http\Controllers\Telegram\OrderController;

Route::get('create', [OrderController::class, 'create']);