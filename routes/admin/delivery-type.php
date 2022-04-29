<?php

use App\Http\Controllers\Admin\DeliveryTypeController;

Route::get('', [DeliveryTypeController::class, 'index']);
Route::get('/list', [DeliveryTypeController::class, 'list']);
Route::get('/{type}', [DeliveryTypeController::class, 'get']);
Route::post('', [DeliveryTypeController::class, 'create']);
Route::put('/{type}', [DeliveryTypeController::class, 'update']);
Route::delete('/{type}', [DeliveryTypeController::class, 'destroy']);
