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

Route::get('/home', [
    'uses' => 'ItemController@showAll',
    'as' => 'home'
]);
Route::put('/update/{id}',
[
    'uses' => 'ItemController@update',
    'as' => 'item.update'
]);
Route::get('/edit/{id}', [
    'uses' => 'ItemController@edit',
    'as' => 'item.edit'
]);

Route::get('/createitem',
[
    'uses' => 'ItemController@create',
    'as' => 'item.create'
]);
Route::put('/checkout',
[
    'uses' => 'OrderController@create',
    'as' => 'checkout'
]);
Route::get('/deleteitem/{id}',
[
    'uses' => 'ItemController@destroy',
    'as' => 'item.delete'
]);
Route::put('/createcategory',
[
    'uses' => 'CategoryController@store',
    'as' => 'category.store'
]);


Route::get('/cart',
[
    'uses' => 'CartController@showCart',
    'as' => 'cart'
]);

Route::get('/removefromcart/{id}', [
    'uses' => 'CartController@removeItem',
    'as' => 'removefromcart'
]);
Route::get('/decrementItem/{id}', [
    'uses' => 'CartController@decrementItem',
    'as' => 'decrementItem'
]);
Route::get('/incrementItem/{id}', [
    'uses' => 'CartController@incrementItem',
    'as' => 'incrementItem'
]);
Route::get('/item', function () {
    return view('item');
});
Route::get('/vieworders',[
    'uses' => 'OrderController@showAll',
    'as' => 'vieworders'
]);
Route::put('/storeitem', [
    'uses' => 'ItemController@store',
    'as' => 'item.store'
]);


Auth::routes();

