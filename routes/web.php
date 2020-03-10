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

Route::get('all_categories','CategoryController@all_categories')->name('all_categories');
Route::post('save_category','CategoryController@save_category')->name('save_category');



Route::get('{path}','HomeController@index')->where('path','.*');
