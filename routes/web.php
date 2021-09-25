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
Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function() {//prefixはadminから始まるURLのグループ！！
    Route::get('news/create', 'Admin\NewsController@add');//news/createのURLにフォルダ名"Admin"のnewscontroller
    Route::post('news/create', 'Admin\NewsController@create');
    Route::get('news', 'Admin\NewsController@index');
    Route::get('news/edit', 'Admin\NewsController@edit'); // 追記
    Route::post('news/edit', 'Admin\NewsController@update'); // 追記
    Route::get('news/delete', 'Admin\NewsController@delete');

    Route::get('profile', 'Admin\ProfileController@index');
    Route::get('profile/create','Admin\ProfileController@add');
    Route::post('profile/create','Admin\ProfileController@create');
    Route::get('profile/edit','Admin\ProfileController@edit');
    Route::post('profile/edit','Admin\ProfileController@update');
    Route::get('profile/delete', 'Admin\ProfileController@delete');

});
   
//Route::get('XXX', 'AAAController@bbb');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');