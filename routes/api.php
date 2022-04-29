<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {

    Route::post('payment/paycom', [\App\Http\Controllers\PaycomController::class, 'handle'])->middleware('paycom');
    Route::post('havas/price-list', [\App\Http\Controllers\Admin\HavasPriceListController::class, 'import']);
    Route::get('havas/async-file', [\App\Http\Controllers\Admin\HavasPriceListController::class, 'importFile']);

    Route::group(['prefix' => 'admin'], __DIR__ . '/admin/index.php');
    Route::group(['prefix' => 'telegram', 'middleware' => 'auth.telegram'], __DIR__ . '/telegram/index.php');

    Route::group(['prefix' => 'mobile'], __DIR__ . '/mobile/index.php');
});
