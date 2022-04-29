<?php

use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\Cabinet\CabinetController;
use App\Http\Controllers\Site\Cabinet\OrderController;
use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('thanks', [AuthController::class, 'thanks'])->name('thanks');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('sign-up', [AuthController::class, 'signUp'])->name('signUp');
    Route::post('reset-password', [AuthController::class, 'signUp'])->name('resetPassword');


    Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');

    Route::get('/product/modal/view/{product}', [HomeController::class, 'productModalView'])->name('productModalView');
    Route::get('/product/{product}', [HomeController::class, 'product'])->name('product');

    Route::get('/news', [HomeController::class, 'news'])->name('news');
    Route::get('/favorite/{product}', [HomeController::class, 'addOrRemoveFavorite'])->name('favorite.removeOrCreate');
    Route::get('/favorite', [HomeController::class, 'favorite'])->name('favorite');
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::post('/faq', [HomeController::class, 'faqCreate'])->name('faq.create');
    Route::get('/search', [HomeController::class, 'search'])->name('search');

    Route::get('/cart/delete/{cart}', [HomeController::class, 'cartDeleteOne'])->name('cart.delete.one');
    Route::get('/cart/delete', [HomeController::class, 'cartDelete'])->name('cart.delete');
    Route::get('/cart/{product}', [HomeController::class, 'cart'])->name('cart');
    Route::get('/cart', [HomeController::class, 'cartView'])->name('cart.view');

    Route::get('/cart/plus/{id}', [HomeController::class, 'cartPlus'])->name('cart.plus');
    Route::get('/cart/minus/{id}', [HomeController::class, 'cartMinus'])->name('cart.minus');

    Route::get('/page/{page}', [HomeController::class, 'page'])->name('page');

    Route::get('/about-company', [HomeController::class, 'aboutCompany'])->name('aboutCompany');
    Route::get('/contacts', [HomeController::class, 'contacts'])->name('contacts');
    Route::get('/payment', [HomeController::class, 'payment'])->name('payment');
    Route::get('/return', [HomeController::class, 'returnPage'])->name('return');


    Route::post('/rate/{product}', [HomeController::class, 'rateSave'])->name('rate.save');
    Route::get('/', [HomeController::class, 'index'])->name('main');

    Route::group(['prefix' => 'cabinet', 'middleware' => 'auth:web'], function () {
        Route::post('/update', [CabinetController::class, 'update'])->name('user.cabinet.update');
        Route::get('', [CabinetController::class, 'cabinet'])->name('user.cabinet');

        Route::group(['prefix' => 'order'], function () {
            Route::get('/success/{order}', [OrderController::class, 'successPayment'])->name('user.order.success');
            Route::get('/payment/{order}', [OrderController::class, 'payment'])->name('user.order.payment');
            Route::get('/view', [OrderController::class, 'orderPage'])->name('user.order.view');
            Route::post('/create', [OrderController::class, 'create'])->name('user.order.create');
            Route::get('/re-order/{order}', [OrderController::class, 'reOrder'])->name('user.reOrder');
            Route::get('/history', [OrderController::class, 'history'])->name('user.order.history');
        });
    });

});
