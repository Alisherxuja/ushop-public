<?php

use App\Http\Controllers\Admin\FaqController;


Route::get('', [FaqController::class, 'index']);
Route::get('/{faq}', [FaqController::class, 'get']);
Route::post('', [FaqController::class, 'create']);
Route::put('/{faq}', [FaqController::class, 'update']);
Route::delete('/{faq}', [FaqController::class, 'destroy']);
