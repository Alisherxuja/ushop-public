<?php

use App\Http\Controllers\Telegram\ProductController;
use App\Http\Controllers\Telegram\TelegramController;

Route::get('/favorites/{product}', [TelegramController::class, 'addOrRemoveFavorite']);
Route::get('/favorites', [TelegramController::class, 'favoriteList']);

Route::get('/cart/add/{product}', [TelegramController::class, 'addCart']);
Route::get('/cart/remove/{cart}', [TelegramController::class, 'removeCart']);
Route::get('/cart/increment/{product}', [TelegramController::class, 'increment']);
Route::get('/cart/decrement/{product}', [TelegramController::class, 'decrement']);
Route::get('/cart/all', [TelegramController::class, 'removeCartAll']);
Route::get('/cart', [TelegramController::class, 'cartList']);


Route::get('/category/{category}', [ProductController::class, 'index']);
Route::get('/{product}', [ProductController::class, 'get']);