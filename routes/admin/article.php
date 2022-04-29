<?php

use App\Http\Controllers\Admin\ArticleController;

Route::post('/upload', [ArticleController::class, 'upload']);
Route::get('', [ArticleController::class, 'index']);
Route::get('/{article}', [ArticleController::class, 'get']);
Route::post('', [ArticleController::class, 'create']);
Route::put('/{article}', [ArticleController::class, 'update']);
Route::delete('/attachment/{attachment}', [ArticleController::class, 'destroyAttachment']);
Route::delete('/{article}', [ArticleController::class, 'destroy']);
