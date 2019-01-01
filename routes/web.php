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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile','HomeController@profile')->name('profile');
Route::get('my_thread','HomeController@myThread')->name('my_thread');
Route::post('save_thread','HomeController@saveThread')->name('save_thread');
Route::post('save_profile','HomeController@saveProfile')->name('save_profile');
Route::post('add_comment/{thread_id}','HomeController@addComment')->name('add_comment');

Route::get('threads/{order_by?}','HomeController@threads')->name('threads');
Route::get('view_thread/{id}','HomeController@view')->name('view_thread');
