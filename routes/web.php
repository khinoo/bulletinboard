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
    return view('welcome');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/login', 'Auth\LoginController@authenticate');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::get('/home', 'Auth\LoginController@home')->name('home');

Route::get('/forget-password', 'Auth\ForgotPasswordController@getEmail');
Route::post('/forget-password', 'Auth\ForgotPasswordController@postEmail');

Route::get('reset-password/{token}', 'Auth\ResetPasswordController@getPassword');
Route::post('reset-password', 'Auth\ResetPasswordController@updatePassword');

Route::get('/posts', 'PostsController@index');
Route::get('/confirm', 'PostsController@confirm')->name('confirm');
Route::post('/confirm', 'PostsController@confirm');
Route::get('/search', 'PostsController@search')->name('search');

Route::get('/userconfirm', 'UsersController@userconfirm')->name('userconfirm');
Route::post('/userconfirm', 'UsersController@userconfirm');

Route::post('createpost', 'PostsController@store')->name('store');
Route::get('createpost/{id}', 'PostsController@edit');

Route::post('createuser', 'UsersController@store')->name('store');
Route::get('createuser/{id}', 'UsersController@edit');

Route::get('/postlist', 'PostsController@show')->name('show');
Route::post('/postlist', 'PostsController@show');	

Route::get('/userlist', 'UsersController@index')->name('index');
Route::get('/profile', 'UsersController@show');
Route::get('/usersearch', 'UsersController@usersearch')->name('search');
Route::get('/createuser', 'UsersController@create')->name('create');

Route::get('/deletepost/{id}', 'PostsController@destroy')->name('destroy');
Route::get('/deleteuser/{id}', 'UsersController@destroy')->name('destroy');

Route::get('/changepassword/{id}', 'UsersController@changepasswordview')->name('changepasswordview');
Route::post('/changepassword', 'UsersController@changepassword');

Route::get('/uploadview', 'PostsController@uploadview')->name('uploadview');

Route::get('importExportView', 'ImportExportController@importExportView');
Route::get('export', 'ImportExportController@export')->name('export');
Route::post('import', 'ImportExportController@import')->name('import');

