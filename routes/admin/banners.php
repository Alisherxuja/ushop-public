<?php

use App\Http\Controllers\Admin\BannerController;

Route::get('', [BannerController::class, 'index']);
Route::get('/{banner}', [BannerController::class, 'get']);
Route::post('', [BannerController::class, 'create']);
Route::put('/{banner}', [BannerController::class, 'update']);
Route::delete('/{banner}', [BannerController::class, 'destroy']);
