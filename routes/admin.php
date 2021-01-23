<?php

Route::middleware(['admin.auth'])->group(function() {
    Route::get('/', 'Admin\DashboardController@index');
    Route::resource('/product', 'Admin\ProductController');
    Route::resource('/product-category', 'Admin\ProductCategoryController');
    Route::resource('/promo', 'Admin\PromoController');
    Route::resource('/discount', 'Admin\DiscountController');
    Route::resource('/bank-account', 'Admin\BankAccountController');
    Route::resource('/faq', 'Admin\FaqController');

    Route::post('/logout', 'Auth\Admin\LoginController@logout');
});

Route::middleware(['admin.guest'])->group(function() {
    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm');
    Route::post('/login', 'Auth\Admin\LoginController@login');
});