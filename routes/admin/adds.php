<?php

use App\Http\Controllers\Admin\AdController;


Route::get('', [AdController::class, 'index']);
Route::get('/{article}', [AdController::class, 'get']);
Route::post('', [AdController::class, 'create']);
Route::put('/{article}', [AdController::class, 'update']);
Route::delete('/{article}', [AdController::class, 'destroy']);
