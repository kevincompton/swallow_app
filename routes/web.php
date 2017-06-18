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

Route::get('/', function () {
    return view('welcome');
});

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

// internal API
Route::get('/products', 'APIController@fetchProducts');
Route::get('/user/products', 'APIController@fetchUserProducts');
Route::get('/companies/{category}', 'APIController@wpUsers');
Route::get('/wp/products/{company}', 'APIController@wpProducts');