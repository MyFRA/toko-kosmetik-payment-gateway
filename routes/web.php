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
Route::get('/wishlist', 'Web\WishlistController@index');
Route::get('/categories', 'Web\CategoriesController@index');
Route::get('/product/{slug}', 'Web\ProductController@show');
Route::get('/product', 'Web\ProductController@index');
Route::get('/account', 'Web\AccountController@index')->middleware(['auth.customer']);
Route::get('/cart', 'Web\CartController@index');
Route::get('/promo', 'Web\PromoController@index');

// Customer Authentication Route
Route::get('/login', 'Auth\Customer\LoginController@showLoginForm');
Route::post('/login', 'Auth\Customer\LoginController@login');
Route::post('/logout', 'Auth\Customer\LoginController@logout');
Route::get('/register', 'Auth\Customer\RegisterController@showRegistrationForm');
Route::post('/register', 'Auth\Customer\RegisterController@register');

Route::post('/email/resend', 'Auth\Customer\VerificationController@resend ')->name('verification.resend')->middleware(['auth.customer']);
Route::get('/email/verify', 'Auth\Customer\VerificationController@show')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', 'Auth\Customer\VerificationController@verify')->name('verification.verify')->middleware(['auth.customer']);