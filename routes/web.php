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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UsersController@index')->name('users');
Route::get('/users/getall', 'UsersController@getAll')->name('users.getAll');
Route::get('/users/getById/{id}', 'UsersController@getById')->name('users.getById');
Route::post('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users/update', 'UsersController@update')->name('users.update');
Route::get('/users/delete/{id}', 'UsersController@delete')->name('users.delete');

Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/category/getall', 'CategoryController@getAll')->name('category.getAll');
Route::get('/category/getById/{id}', 'CategoryController@getById')->name('category.getById');
Route::post('/category/create', 'CategoryController@create')->name('category.create');
Route::post('/category/update', 'CategoryController@update')->name('category.update');
Route::get('/category/delete/{id}', 'CategoryController@delete')->name('category.delete');

Route::get('/supplier', 'SupplierController@index')->name('supplier');
Route::get('/supplier/getall', 'SupplierController@getAll')->name('supplier.getAll');
Route::get('/supplier/getById/{id}', 'SupplierController@getById')->name('supplier.getById');
Route::post('/supplier/create', 'SupplierController@create')->name('supplier.create');
Route::post('/supplier/update', 'SupplierController@update')->name('supplier.update');
Route::get('/supplier/delete/{id}', 'SupplierController@delete')->name('supplier.delete');

Route::get('/product', 'ProductController@index')->name('product');
Route::get('/product/add', 'ProductController@add')->name('product.add');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
Route::get('/product/getall', 'ProductController@getAll')->name('product.getAll');
// Route::get('/product/getById/{id}', 'ProductController@getById')->name('product.getById');
Route::post('/product/create', 'ProductController@create')->name('product.create');
Route::post('/product/update', 'ProductController@update')->name('product.update');
Route::get('/product/delete/{id}', 'ProductController@delete')->name('product.delete');
