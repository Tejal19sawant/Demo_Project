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

Route::get('/', function () {
    //return view('welcome');
    return view('auth/login');
});


Route::get('/home_website','Website\HomeController@index');
Route::get('/products','Website\HomeController@products');

Auth::routes();

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
/**********Product Management ends here**********/

Route::resource('admin/banners', 'Admin\\bannersController');