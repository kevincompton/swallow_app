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

// Client Routes
Route::get('/', 'ClientController@welcome');
Route::get('/edibles', 'ClientController@index');
Route::get('/product/{id}', 'ClientController@showProduct');
Route::get('/company/{id}', 'ClientController@showCompany');
Route::get('/dispensary/{id}', 'ClientController@showDispensary');
Route::get('/education', 'ClientController@education');
Route::get('/dispensaries', 'ClientController@dispensaryIndex');
Route::get('/products/filter', 'ClientController@results');

// client API
Route::get('/client/products', 'ClientController@fetchProducts');
Route::get('/client/tags', 'ClientController@fetchTags');
Route::get('/confirm/age', 'ClientController@confirmAge');

Auth::routes();

// User Routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/profile', 'UserController@profile');
Route::put('/user/update', 'UserController@update');

// Product Routes
Route::get('/product/edit/{id}', 'ProductController@edit');
Route::post('/product/create', 'ProductController@create');
Route::put('/product/update/{id}', 'ProductController@update');
Route::get('/product/deactivate/{id}', 'ProductController@deactivate');
Route::get('/product/activate/{id}', 'ProductController@activate');
Route::get('/product/link/{id}', 'ProductController@linkProduct');
Route::get('/product/detach/{id}', 'ProductController@unlink');
Route::get('/product/approve/{user}/{product}', 'ProductController@approveLink');
Route::get('/product/delete/{id}', 'ProductController@delete');

// Admin routes
Route::get('/admin', 'AdminController@index')->middleware('admin');
Route::get('/approve/{id}', 'AdminController@approve')->middleware('admin');
Route::get('/sync/products', 'ImportController@syncProducts')->middleware('admin');
Route::get('/sync/tags', 'ImportController@syncTags')->middleware('admin');
Route::get('/sync/companies', 'ImportController@syncCompanies')->middleware('admin');
Route::get('/sync/dispensaries', 'ImportController@syncDispensaries')->middleware('admin');
Route::get('/attach/products', 'ImportController@attachProducts')->middleware('admin');
Route::get('/sync/company/images', 'ImportController@companyImages')->middleware('admin');
Route::get('/sync/locations', 'ImportController@syncLocations')->middleware('admin');
Route::get('/sync/brands', 'ImportController@syncBrands')->middleware('admin');

// internal API
Route::get('/products', 'APIController@fetchProducts');
Route::get('/user/products', 'APIController@fetchUserProducts');
Route::get('/companies/{category}', 'APIController@wpUsers');
Route::get('/wp/products/{company}', 'APIController@wpProducts');



// Test Routes

Route::get('/test/location', "APIController@locationRadius");