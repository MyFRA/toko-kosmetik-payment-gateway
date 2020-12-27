<?php

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

Route::get('/', 'Web\HomeController@index');
Route::get('/categories', 'Web\CategoriesController@index');
Route::get('/promo', 'Web\PromoController@index');

// Customer Authentication Route
Route::get('/login', 'Auth\Customer\LoginController@showLoginForm')->middleware(['customer.guest'])->name('customer.login');
Route::post('/login', 'Auth\Customer\LoginController@login');
Route::get('/register', 'Auth\Customer\RegisterController@showRegistrationForm')->name('customer.signup-form');
Route::post('/register', 'Auth\Customer\RegisterController@register');

// Product Route
Route::get('/product/{slug}', 'Web\ProductController@show');
Route::get('/product', 'Web\ProductController@index');

Route::middleware(['customer.auth'])->group(function() {
    Route::post('/logout', 'Auth\Customer\LoginController@logout');
    Route::get('/cart', 'Web\CartController@index');
    Route::get('/wishlist', 'Web\WishlistController@index');

    // Account
    Route::get('/account', 'Web\AccountController@index');
    Route::post('/account/fullname/update', 'Web\AccountController@updateFullname');
    Route::post('/account/birth/update', 'Web\AccountController@updateBirth');
    Route::post('/account/gender/update', 'Web\AccountController@updateGender');
    Route::post('/account/email/update', 'Web\AccountController@updateEmail');
    Route::post('/account/number_phone/update', 'Web\AccountController@updateNumberPhone');
    Route::post('/account/photo/update', 'Web\AccountController@updatePhoto');

    // Cart
    Route::post('/add-to-cart', 'Web\CartController@addToCart');
});

Route::get('/verify', 'Auth\Customer\RegisterController@verify')->name('customer.verify');