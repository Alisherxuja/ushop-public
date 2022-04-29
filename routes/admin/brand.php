<?php

use App\Http\Controllers\Admin\BrandController;

Route::get('/list', [BrandController::class, 'list'])->name('admin.brand.list');

Route::get('', [BrandController::class, 'index'])->name('admin.brand.index');
Route::get('/{brand}', [BrandController::class, 'get'])->name('admin.brand.get');
Route::post('', [BrandController::class, 'create'])->name('admin.brand.create');
Route::put('/{brand}', [BrandController::class, 'update'])->name('admin.brand.update');
Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
