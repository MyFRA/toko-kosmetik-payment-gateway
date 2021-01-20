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
Route::get('/login', 'Auth\Customer\LoginController@showLoginForm')->middleware(['customer.guest']);
Route::post('/login', 'Auth\Customer\LoginController@login');
Route::get('/register', 'Auth\Customer\RegisterController@showRegistrationForm');
Route::post('/register', 'Auth\Customer\RegisterController@register');
Route::get('/verify/{email_verification_token}', 'Auth\Customer\RegisterController@verifyCustomer');
Route::get('/email', function() {
    return view('email');
});

// Product Route
Route::get('/product/{slug}', 'Web\ProductController@show');
Route::get('/product', 'Web\ProductController@index');

Route::middleware(['customer.auth'])->group(function() {
    Route::post('/logout', 'Auth\Customer\LoginController@logout');
    Route::get('/wishlist', 'Web\WishlistController@index');

    // Account
    Route::get('/account', 'Web\AccountController@index');
    Route::post('/account/fullname/update', 'Web\AccountController@updateFullname');
    Route::post('/account/birth/update', 'Web\AccountController@updateBirth');
    Route::post('/account/gender/update', 'Web\AccountController@updateGender');
    Route::post('/account/email/update', 'Web\AccountController@updateEmail');
    Route::post('/account/number_phone/update', 'Web\AccountController@updateNumberPhone');
    Route::post('/account/photo/update', 'Web\AccountController@updatePhoto');
    Route::get('/account/change-password', 'Web\AccountController@indexChangePassword');
    Route::post('/account/change-password', 'Web\AccountController@actionChangePassword');
    Route::get('/account/address', 'Web\AccountController@indexAddress');
    Route::post('/account/address', 'Web\AccountController@postAddress');
    Route::post('/account/address/set-active', 'Web\AccountController@setActive');
    Route::post('/account/delete-address', 'Web\AccountController@deleteAddress');
    Route::get('/account/address/{address_id}/json', 'Web\AccountController@findAddress');
    Route::post('/account/address/{address_id}/update', 'Web\AccountController@updateAddress');
    Route::get('/account/address/json', 'Web\AccountController@getAllAddressByCustomerJson');

    // Cart
    Route::get('/cart', 'Web\CartController@index');
    Route::get('/cart/shipment', 'Web\CartController@getShipment');
    Route::post('/add-to-cart', 'Web\CartController@addToCart');
    Route::post('/delete-from-cart', 'Web\CartController@deleteFromCart');
    Route::post('/checked-cart', 'Web\CartController@checkedCart');
    Route::post('/increase-cart', 'Web\CartController@increaseDecreaseCart');
    Route::post('/cart/checkout', 'Web\CartController@checkout');
    Route::get('/cart/checkout/payment-transfer/{sales_id}', 'Web\CartController@paymentTransferPage');

    // Wishlist
    Route::post('/add-to-wishlists', 'Web\WishlistController@addToWishlist');
    Route::post('/delete-from-wishlists', 'Web\WishlistController@deleteFromWishlist');
    Route::post('/wishlist-page-delete-wishlist', 'Web\WishlistController@wishlistPageDeleteFromWishlist');

    // Comment
    Route::post('/add-comment', 'Web\CommentController@addComment');

    // Test
    Route::get('/cek-ongkir', 'Test\CekOngkirController@cekOngkir');

    // Get Consts
    Route::get('/api/get-costs/{id_kota_tujuan}/{weight}', 'Api\ApiController@getCostsCourier');
});

// API (Not Must Logged In)
    Route::get('/api/product-categories', 'Api\ApiController@ProductCategories');
    Route::get('/api/product-recommendation/{count?}', 'Api\ApiController@getRecommendation');
    Route::get('/api/product-comments/{product_id?}', 'Api\ApiController@getProductComments');

