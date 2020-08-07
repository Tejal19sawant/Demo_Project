<?php

use Illuminate\Support\Facades\Route;

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




Auth::routes();

/***********ADMIN SECTION LINK STARTS HERE****************/
Route::get('/', function () {
    //return view('welcome');
    return view('auth/login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin/users', 'Admin\\usersController');
Route::resource('admin/configuration', 'Admin\\configurationController');
Route::resource('admin/category', 'Admin\\categoryController');

/**********Product Management starts here**********/
Route::get('admin/product', 'Admin\\productController@index');
Route::get('/admin/product/create','Admin\\productController@create');
Route::post('/admin/submitproduct','Admin\\productController@store_product');
Route::get('/admin/product/{id?}/edit','Admin\\productController@edit_product');
Route::get('/admin/product/{id?}','Admin\\productController@show_product');
Route::patch('/admin/product/{id?}','Admin\\productController@update_product');
Route::DELETE('/admin/product/{id?}','Admin\\productController@delete_product');
Route::get('/admin/product/attributes/{id?}', 'Admin\\productController@create_attribute');
Route::post('/admin/product/storeatt/{id?}', 'Admin\\productController@store_attribute');
Route::DELETE('/admin/product/delete_attr/{id?}','Admin\\productController@delete_product_attr');
Route::post('/admin/product/edit-attributes/{id?}', 'Admin\\productController@edit_attribute');
Route::match(['get','post'],'/admin/product/add-images/{id?}', 'Admin\\productController@add_images');
Route::DELETE('/admin/product/delete_prodimgs/{id?}','Admin\\productController@delete_product_imgaes');
Route::post('/admin/product/updatefeaturedprod/{id?}', 'Admin\\productController@update_featuredprod_status');
/**********Product Management ends here**********/

Route::resource('admin/banners', 'Admin\\bannersController');

//Coupons route
Route::match(['get','post'],'/admin/coupon', 'Admin\\CouponsController@index');
Route::match(['get','post'],'/admin/coupon/create', 'Admin\\CouponsController@create');
Route::post('/admin/coupon/store', 'Admin\\CouponsController@store');
Route::get('/admin/coupon/{id?}','Admin\\CouponsController@show');
Route::get('/admin/coupon/{id?}/edit','Admin\\CouponsController@edit');
Route::patch('/admin/coupon/{id?}','Admin\\CouponsController@update');
Route::DELETE('/admin/coupon/{id?}','Admin\\CouponsController@delete');

/***********ADMIN SECTION LINK ENDS HERE****************/


/***********WEBSITE SECTION LINK STARTS HERE****************/

Route::get('/index','Website\HomeController@index');
Route::get('/products','Website\ProductController@products');
Route::get('/products/{id}','Website\ProductController@product_details');
Route::get('/categories/{categoty_id}','Website\ProductController@categories');
Route::get('/get-product-price','Website\ProductController@getprice');

//Route for Login-Register
Route::get('/login-register','Website\\LoginController@userLogin');
//Route for add users registration
Route::post('/user-register','Website\LoginController@register');
//Route for logout
Route::get('/user-logout','Website\LoginController@logout');
//Route for login
Route::post('/user-login','Website\LoginController@login');

//Route for MiddleWare for Front Login
Route::group(['middleware'=>['frontlogin']],function(){
//Route for user account
Route::match(['get','post'],'/account','Website\LoginController@account');
Route::match(['get','post'],'/change-password','Website\LoginController@changePassword');
Route::match(['get','post'],'/change-address','Website\LoginController@changeAddress');
});





//Route for add to cart
Route::match(['get','post'],'add-cart','Website\ProductController@addtoCart');
//Route for cart
Route::match(['get','post'],'/cart','Website\ProductController@Cart');
//Route for Delete cart
Route::get('/cart/delete-product/{id?}','Website\\ProductController@deleteCartProduct');
//Route for Update Quantity
Route::get('/cart/update-quantity/{id}/{quantity}','Website\ProductController@updateCartQuantity');
//Apply Coupon Code
Route::post('/cart/apply-coupon','Website\ProductController@applyCoupon');
/************WEBSITE SECTION LINK ENDS HERE***********************/