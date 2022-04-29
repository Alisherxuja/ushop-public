<?php

use App\Http\Controllers\Admin\CategoryController;

Route::get('/parent-list', [CategoryController::class, 'parentList']);
Route::get('/parent-with-children', [CategoryController::class, 'parentListWithChildren']);

Route::get('', [CategoryController::class, 'index']);
Route::get('/{category}', [CategoryController::class, 'get']);
Route::post('', [CategoryController::class, 'create']);
Route::put('/{category}', [CategoryController::class, 'update']);
Route::delete('/{category}', [CategoryController::class, 'destroy']);
