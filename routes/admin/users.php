<?php

use App\Http\Controllers\Admin\UsersController;

Route::post('/change/{user}', [UsersController::class, 'change']);

Route::get('/list', [UsersController::class, 'list']);
Route::get('', [UsersController::class, 'index']);
Route::get('/{user}', [UsersController::class, 'get']);
Route::post('', [UsersController::class, 'create']);
Route::put('/{user}', [UsersController::class, 'update']);
Route::delete('/{user}', [UsersController::class, 'destroy']);
