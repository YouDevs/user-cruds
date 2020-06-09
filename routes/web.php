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

Route::get('/', 'UsersController@index')->name('user.index');
Route::post('user/store', 'UsersController@store')->name('user.store');
Route::post('user/{id}/update', 'UsersController@update')->name('user.update');
Route::post('user/{id}/delete', 'UsersController@delete')->name('user.delete');
