<?php

use App\Http\Controllers\Admin\ProductReviewController;

Route::delete('/attachment/{attachment}', [ProductReviewController::class, 'destroyAttachment']);
Route::post('/change/{review}', [ProductReviewController::class, 'change']);

Route::get('', [ProductReviewController::class, 'index']);
Route::get('/{review}', [ProductReviewController::class, 'get']);
Route::delete('/{review}', [ProductReviewController::class, 'destroy']);
