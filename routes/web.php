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
Route::get('/add-to-cart/{id}', [
    'uses' => 'CartController@AddToCart',
    'as' => 'item.addToCart'
]);
Route::get('/home', 'ItemController@showAll');
Route::put('/createitem', 'ItemController@create');

Route::get('/cart', 'CartController@showCart');

Route::get('/removefromcart/{id}', [
    'uses' => 'CartController@removeItem',
    'as' => 'removefromcart'
]);
Route::get('/item', function () {
    return view('item');
});
Route::get('/additem', function () {
    return view('additem');
});
// Route::get('/','ItemController@showAll');


Auth::routes();

