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

Route::get('/product', function () {
    return view('welcome');
});

Route::get('/list', 'ListsController@index')->name('home');
Route::post('/list', 'ListsController@create')->name('create.list');
Route::post('/delete', 'ListsController@delete')->name('delete.list');
