<?php

Route::get('/', 'Admin\DashboardController@index');
Route::resource('/product', 'Admin\ProductController');