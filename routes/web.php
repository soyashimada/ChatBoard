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

Route::middleware('auth')->group(function(){
    Route::get('board', 'BoardController@index')->name('board');

    Route::get('board/read/{id}', 'PostController@read')->where('id','[0-9]+')->name('read');
    Route::post('board/read/{id}','PostController@post')->where('id','[0-9]+');

    Route::get('ajax/board/read', 'PostController@get_posts');
    Route::post('ajax/board/read', 'PostController@post');

    Route::get('board/create', 'BoardController@add')->name('create_board');
    Route::post('board/create', 'BoardController@create');

    Route::get('board/search', 'BoardController@search')->name('search');

    Route::get('profile/{user}', 'UserProfileController@index')->name('profile');

    Route::get('settings/profile', 'UserProfileController@select_setting_profile')->name('setting_profile_top');


    Route::get('settings/profile/name', 'UserProfileController@setting_profile_name');
    Route::post('settings/profile/name','UserProfileController@store');

    Route::get('settings/profile/statusMessage', 'UserProfileController@setting_profile_status_message');
    Route::post('settings/profile/statusMessage','UserProfileController@store');

    Route::get('settings/profile/userImage', 'UserProfileController@setting_profile_user_image');
    Route::post('settings/profile/userImage','UserProfileController@store_image');

    Route::get('settings/profile/userLink', 'UserProfileController@setting_profile_user_link');
    Route::post('settings/profile/userLink','UserProfileController@store');

});



