<?php

use App\Http\Controllers\Admin\StuffController;

Route::post('/change/{user}', [StuffController::class, 'change']);

Route::get('', [StuffController::class, 'index']);
Route::get('/{user}', [StuffController::class, 'get']);
Route::post('', [StuffController::class, 'create']);
Route::put('/{user}', [StuffController::class, 'update']);
Route::delete('/{user}', [StuffController::class, 'destroy']);
