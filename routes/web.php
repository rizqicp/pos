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
