<?php

use App\Http\Controllers\Admin\OrderController;

Route::post('/change/{order}', [OrderController::class, 'change']);
Route::post('/cancel/{order}', [OrderController::class, 'cancel']);

Route::get('/delivered', [OrderController::class, 'delivered']);
Route::get('/cancelled', [OrderController::class, 'cancelled']);
Route::get('', [OrderController::class, 'index']);
Route::get('/{order}', [OrderController::class, 'get']);
