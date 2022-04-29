<?php

use App\Http\Controllers\Admin\LocationController;


Route::get('/list', [LocationController::class, 'list'])->name('admin.location.list');
Route::get('/parent', [LocationController::class, 'parentList'])->name('admin.location.parentList');
Route::get('/parent-with-child', [LocationController::class, 'withTree'])->name('admin.location.withTree');

Route::get('', [LocationController::class, 'index'])->name('admin.location.index');
Route::get('/{location}', [LocationController::class, 'get'])->name('admin.location.get');
Route::post('', [LocationController::class, 'create'])->name('admin.location.create');
Route::put('/{location}', [LocationController::class, 'update'])->name('admin.location.update');
Route::delete('/{location}', [LocationController::class, 'destroy'])->name('admin.location.destroy');
