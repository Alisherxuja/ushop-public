<?php

use App\Http\Controllers\Admin\PageController;


Route::get('', [PageController::class, 'index']);
Route::get('/{page}', [PageController::class, 'get']);
Route::post('', [PageController::class, 'create']);
Route::put('/{page}', [PageController::class, 'update']);
Route::delete('/{page}', [PageController::class, 'destroy']);
