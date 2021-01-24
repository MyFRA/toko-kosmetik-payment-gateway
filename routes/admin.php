<?php

Route::middleware(['admin.auth'])->group(function() {
    Route::get('/', 'Admin\DashboardController@index');
    Route::resource('/product', 'Admin\ProductController');
    Route::resource('/product-category', 'Admin\ProductCategoryController');
    Route::resource('/promo', 'Admin\PromoController');
    Route::resource('/discount', 'Admin\DiscountController');
    Route::resource('/bank-account', 'Admin\BankAccountController');
    Route::resource('/faq', 'Admin\FaqController');
    Route::get('/purchases', 'Admin\PurchasesController@index');
    Route::get('/purchases/belum-bayar', 'Admin\PurchasesController@indexBelumBayar');
    Route::get('/purchases/menunggu-konfirmasi-pembayaran', 'Admin\PurchasesController@indexMenungguKonfirmasiPembayaran');
    Route::get('/purchases/dikirim', 'Admin\PurchasesController@indexDikirim');
    Route::get('/purchases/diterima', 'Admin\PurchasesController@indexDiterima');
    Route::get('/purchases/expired', 'Admin\PurchasesController@indexExpired');
    Route::get('/purchases/detail/{id}', 'Admin\PurchasesController@show');
    Route::put('/purchases/confirm-proof-payment/{id}', 'Admin\PurchasesController@confirmPayment');
    
    Route::post('/logout', 'Auth\Admin\LoginController@logout');
});

Route::middleware(['admin.guest'])->group(function() {
    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm');
    Route::post('/login', 'Auth\Admin\LoginController@login');
});