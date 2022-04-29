<?php

use App\Http\Controllers\Admin\RolesController;

Route::get('/permissions', [RolesController::class, 'permissions'])->name('admin.role.permissions');
Route::get('/list', [RolesController::class, 'list'])->name('admin.role.list');
Route::get('', [RolesController::class, 'index'])->name('admin.role.index');
Route::get('/{role}', [RolesController::class, 'get'])->name('admin.role.get');
Route::put('/{role}', [RolesController::class, 'update'])->name('admin.role.update');
Route::post('', [RolesController::class, 'create'])->name('admin.role.create');
Route::delete('/{role}', [RolesController::class, 'destroy'])->name('admin.role.destroy');
