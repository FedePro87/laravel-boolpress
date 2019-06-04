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

Route::get('/', 'PostController@index')->name('home')->middleware('verified');

Route::get('/category/{category_name}', 'PostController@getPostByCategory')->name('getPostByCategory')->middleware('verified');
Route::get('/post/{id}', 'PostController@show')->name('postShow')->middleware('verified');
Route::get('/admin/post/new', 'PostController@create')->name('adminPostCreate')->middleware('verified');
Route::get('/admin/post/edit/{id}', 'PostController@edit')->name('adminPostEdit')->middleware('verified');
Route::get('/admin/post/delete/{id}', 'PostController@destroy')->name('adminPostDelete')->middleware('verified');
Route::get('/search', 'PostController@showAdvancedSearchResults')->name('showAdvancedSearchResults')->middleware('verified');
Route::resource('posts','PostController')->middleware('verified');

Route::post('/mail/send','HomeController@sendMail')->name('sendMail')->middleware('verified');
Route::get('/mail','HomeController@showMailForm')->name('showMailForm')->middleware('verified');
Auth::routes(['verify' => true]);
