<?php

use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::post('file', [UploadController::class, 'upload']);
Route::post('remove', [UploadController::class, 'remove']);
