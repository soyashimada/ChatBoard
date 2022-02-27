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

Route::get('board/read/{id}', 'PostController@read')->name('read');
Route::post('board/read/{id}','PostController@post');

Route::get('ajax/board/read', 'PostController@get_posts');
Route::post('ajax/board/read', 'PostController@post');

Route::get('board/create', 'BoardController@add')->name('create_board');
Route::post('board/create', 'BoardController@create');

Route::get('board/search', 'BoardController@search')->name('search');

Route::get('profile/{user}', 'UserProfileController@index')->name('profile');

Route::get('settings/profile', 'UserProfileController@select_setting_profile')->name('setting_profile_top');

Route::get('settings/profile/{pass}', 'UserProfileController@setting_profile')->name('setting_profile');
Route::post('settings/profile/{pass}','UserProfileController@store');


