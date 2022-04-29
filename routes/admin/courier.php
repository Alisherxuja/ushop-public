<?php

use App\Http\Controllers\Admin\CourierController;

Route::get('', [CourierController::class, 'index'])->name('admin.courier.index');
Route::get('/list', [CourierController::class, 'list'])->name('admin.courier.list');
Route::get('/{courier}', [CourierController::class, 'get'])->name('admin.courier.get');
Route::post('', [CourierController::class, 'create'])->name('admin.courier.create');
Route::put('/{courier}', [CourierController::class, 'update'])->name('admin.courier.update');
Route::delete('/{courier}', [CourierController::class, 'destroy'])->name('admin.courier.destroy');
