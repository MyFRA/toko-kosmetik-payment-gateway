<?php

Route::middleware(['admin.auth'])->group(function() {
    Route::get('/', 'Admin\DashboardController@index');
    Route::resource('/product', 'Admin\ProductController');
    Route::resource('/product-category', 'Admin\ProductCategoryController');
    Route::resource('/promo', 'Admin\PromoController');
    Route::resource('/discount', 'Admin\DiscountController');
});

Route::get('/login', 'Auth\Admin\LoginController@showLoginForm');