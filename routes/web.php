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

Route::get('/', 'ItemController@showAll');

Route::get('/cart', function () {
    return view('cart');
});
Route::get('/item', function () {
    return view('item');
});

// Route::get('/','ItemController@showAll');


Auth::routes();

Route::get('/home', 'ItemController@showAll');
