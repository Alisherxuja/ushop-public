<?php

use App\Http\Controllers\Admin\MeasureController;

Route::get('', [MeasureController::class, 'index']);
Route::get('/list', [MeasureController::class, 'list']);
Route::get('/{measure}', [MeasureController::class, 'get']);
Route::post('', [MeasureController::class, 'create']);
Route::put('/{measure}', [MeasureController::class, 'update']);
Route::delete('/{measure}', [MeasureController::class, 'destroy']);
