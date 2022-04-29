<?php

use App\Http\Controllers\AuthController;

Route::group([], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']); //+
    });
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::group(['prefix' => 'upload'], __DIR__ . '/upload.php');
        Route::group(['prefix' => 'auth'], __DIR__ . '/auth_jwt.php');


        Route::group(['prefix' => 'adds'], __DIR__ . '/adds.php');
        Route::group(['prefix' => 'article'], __DIR__ . '/article.php');

        Route::group(['prefix' => 'stuff'], __DIR__ . '/stuff.php');

        Route::group(['prefix' => 'product-reviews'], __DIR__ . '/product-reviews.php');

        Route::group(['prefix' => 'users'], __DIR__ . '/users.php');
        Route::group(['prefix' => 'roles'], __DIR__ . '/role.php');
        Route::group(['prefix' => 'profile'], __DIR__ . '/profile.php');
        Route::group(['prefix' => 'orders'], __DIR__ . '/orders.php');
        Route::group(['prefix' => 'article'], __DIR__ . '/article.php');
        Route::group(['prefix' => 'setting'], __DIR__ . '/setting.php'); //
        Route::group(['prefix' => 'products'], __DIR__ . '/products.php');//+
        Route::group(['prefix' => 'courier'], __DIR__ . '/courier.php'); //+
        Route::group(['prefix' => 'delivery-types'], __DIR__ . '/delivery-type.php'); //+
        Route::group(['prefix' => 'payment-types'], __DIR__ . '/payment-type.php'); //+
        Route::group(['prefix' => 'dashboard'], __DIR__ . '/dashboard.php'); //+
        Route::group(['prefix' => 'locations'], __DIR__ . '/location.php'); //+
        Route::group(['prefix' => 'measure'], __DIR__ . '/measure.php'); //+
        Route::group(['prefix' => 'categories'], __DIR__ . '/category.php'); //+
        Route::group(['prefix' => 'brands'], __DIR__ . '/brand.php'); //+
        Route::group(['prefix' => 'banners'], __DIR__ . '/banners.php'); //+
        Route::group(['prefix' => 'faqs'], __DIR__ . '/faqs.php'); //+
        Route::group(['prefix' => 'pages'], __DIR__ . '/pages.php'); //+
    });
});

