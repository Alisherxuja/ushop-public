<?php

use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Mobile\CartController;
use App\Http\Controllers\Mobile\CategoryController;
use App\Http\Controllers\Mobile\OrderController;
use App\Http\Controllers\Mobile\ProductController;
use App\Http\Controllers\Mobile\ProfileController;

Route::group(['prefix' => 'auth'], __DIR__ . '/auth.php');

Route::get('category/parent/{category}', [CategoryController::class, 'child']);
Route::get('category/products/{category}', [CategoryController::class, 'products']);
Route::get('category/all', [CategoryController::class, 'all']);
Route::get('category/parents', [CategoryController::class, 'parents']);
Route::get('category/parent-with-children', [CategoryController::class, 'parentWithChild']);

Route::get('product/list', [ProductController::class, 'list']);
Route::get('product', [ProductController::class, 'index']);
Route::get('product/{product}', [ProductController::class, 'get']);

Route::post('cart/product/{product}', [CartController::class, 'updateByProduct']);
Route::post('cart/increment/{cart}', [CartController::class, 'increment']);
Route::post('cart/decrement/{cart}', [CartController::class, 'decrement']);
Route::delete('cart/clear', [CartController::class, 'clear']);
Route::get('cart/list', [CartController::class, 'list']);
Route::post('cart/{product}', [CartController::class, 'add']);

Route::get('payment-types', [OrderController::class, 'paymentType']);

Route::get('order/dates', [OrderController::class, 'dates']);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('order', [OrderController::class, 'index']);
    Route::post('order', [OrderController::class, 'create']);

    Route::get('profile/info', [ProfileController::class, 'info']);
    Route::post('profile', [ProfileController::class, 'update']);
});
