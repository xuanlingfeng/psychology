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
Route::get('/admin', 'Admin\IndexController@index');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', 'Admin\IndexController@index'); // 返回后台视图
    Route::get('/wenti', 'Admin\IndexController@wenti');//添加问题试图
    Route::post('/question', 'Question\IndexController@index');
    Route::get('/options', 'Question\IndexController@xuanxiang');
    Route::post('/question/options', 'Question\IndexController@options');
    Route::get('/list','Question\IndexController@list');
});