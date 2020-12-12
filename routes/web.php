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
Route::get('/login', 'Auth\Web\LoginController@showLoginForm');
Route::post('/login', 'Auth\Web\LoginController@login');
Route::post('/logout', 'Auth\Web\LoginController@logout');
Route::get('/register', 'Auth\Web\RegisterController@showRegistrationForm');
Route::post('/register', 'Auth\Web\RegisterController@register');