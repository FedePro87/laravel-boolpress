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

Route::get('/', 'PostController@index')->name('home');

Route::get('/category/{category_name}', 'PostController@getPostByCategory')->name('getPostByCategory');
Route::get('/post/{id}', 'PostController@show')->name('postShow');
Route::get('/admin/post/new', 'PostController@create')->name('adminPostCreate');
Route::get('/admin/post/edit/{id}', 'PostController@edit')->name('adminPostEdit');
Route::get('/admin/post/delete/{id}', 'PostController@destroy')->name('adminPostDelete');
Route::get('/search', 'PostController@showAdvancedSearchResults')->name('showAdvancedSearchResults');
Route::resource('posts','PostController');

Route::post('/mail/send','HomeController@sendMail')->name('sendMail');
Route::get('/mail','HomeController@showMailForm')->name('showMailForm');
Auth::routes();
