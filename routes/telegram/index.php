<?php
Route::group([], function () {
    Route::group(['prefix' => 'auth'], __DIR__ . '/auth.php');
    Route::group(['prefix' => 'category'], __DIR__ . '/category.php');
    Route::group(['prefix' => 'product'], __DIR__ . '/product.php');
    Route::group(['prefix' => 'order'], __DIR__ . '/order.php');
    Route::group(['prefix' => 'auth'], __DIR__ . '/auth_jwt.php');
    Route::get('payment/list', [\App\Http\Controllers\Telegram\TelegramController::class, 'paymentList']);
});