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

Route::get('/list', 'ListsController@index');
Route::post('/list', 'ListsController@create');
Route::post('/delete', 'ListsController@delete');
Route::post('/update', 'ListsController@update');
