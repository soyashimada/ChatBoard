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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('board', 'BoardController@index')->name('board');

Route::get('board/read', 'PostController@read')->name('read');
Route::post('board/read','PostController@post');

Route::get('ajax/board/read', 'PostController@get_posts');
Route::post('ajax/board/read', 'PostController@post');

Route::get('board/create', 'BoardController@add')->name('create_board');
Route::post('board/create', 'BoardController@create');

Route::get('board/find', 'BoardController@search')->name('find');
Route::post('board/find', 'BoardController@find');

Route::get('profile', 'UserProfileController@index');

Route::get('settings/profile', 'UserProfileController@select_setting_profile');

Route::get('settings/profile/{pass}', 'UserProfileController@setting_profile')->name('setting_profile');
Route::post('settings/profile/{pass}','UserProfileController@store');


