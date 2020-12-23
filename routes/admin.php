<?php

Route::get('/', 'Admin\DashboardController@index');
Route::resource('/product', 'Admin\ProductController');
Route::resource('/product-category', 'Admin\ProductCategoryController');
Route::resource('/promo', 'Admin\PromoController');
Route::resource('/discount', 'Admin\DiscountController');