<?php

use App\Http\Controllers\Admin\SettingController;

Route::get('', [SettingController::class, 'get']);
Route::post('', [SettingController::class, 'createOrUpdate']);
