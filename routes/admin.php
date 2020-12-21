<?php

Route::get('/', 'Admin\DashboardController@index');
Route::resource('/product', 'Admin\ProductController');
Route::resource('/product-category', 'Admin\ProductCategoryController');