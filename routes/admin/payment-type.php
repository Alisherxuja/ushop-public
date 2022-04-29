<?php

use App\Http\Controllers\Admin\PaymentTypeController;

Route::get('/list', [PaymentTypeController::class, 'list']);

Route::get('', [PaymentTypeController::class, 'index']);
Route::get('/{type}', [PaymentTypeController::class, 'get']);
Route::post('', [PaymentTypeController::class, 'create']);
Route::put('/{type}', [PaymentTypeController::class, 'update']);
Route::delete('/{type}', [PaymentTypeController::class, 'destroy']);
