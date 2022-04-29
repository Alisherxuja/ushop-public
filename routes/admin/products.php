<?php

use App\Http\Controllers\Admin\ProductsController;

Route::post('/upload', [ProductsController::class, 'upload']);

Route::get('/attachment-list/{product}', [ProductsController::class, 'productAttachments']);
Route::post('/attachments/{product}', [ProductsController::class, 'attachments']);
Route::delete('/delete-attachment/{attachment}', [ProductsController::class, 'destroyAttachment']);

Route::get('', [ProductsController::class, 'index']);
Route::get('/{product}', [ProductsController::class, 'get']);
Route::post('', [ProductsController::class, 'create']);
Route::put('/{product}', [ProductsController::class, 'update']);
Route::delete('/{product}', [ProductsController::class, 'destroy']);
