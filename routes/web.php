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
Route::get('/show/{id}', [
    'uses' => 'ItemController@show',
    'as' => 'item.show'
]);


Route::get('/accept/{id}', [
    'uses' => 'OrderController@accept',
    'as' => 'order.accept'
]);
Route::get('/reject/{id}', [
    'uses' => 'OrderController@reject',
    'as' => 'order.reject'
]);
Route::get('/deleteOrder/{id}', [
    'uses' => 'OrderController@destroy',
    'as' => 'order.delete'
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
Route::get('/edititem/{id}', [
    'uses' => 'ItemController@edit',
    'as' => 'item.edit'
]);
Route::put('/createcategory',
[
    'uses' => 'CategoryController@store',
    'as' => 'category.store'
]);
Route::get('/editcategory', [
    'uses' => 'CategoryController@edit',
    'as' => 'category.edit'
]);
Route::get('/deleteCategory/{id}', [
    'uses' => 'CategoryController@destroy',
    'as' => 'category.delete'
]);
Route::put('/updateCategory/{id}',
[
    'uses' => 'CategoryController@update',
    'as' => 'category.update'
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

Route::get('/vieworders',[
    'uses' => 'OrderController@showAll',
    'as' => 'vieworders'
]);
Route::get('/viewmails',[
    'uses' => 'MailController@index',
    'as' => 'viewmails'
]);


Route::put('/storeitem', [
    'uses' => 'ItemController@store',
    'as' => 'item.store'
]);

Route::put('/addAdmin', [
    'uses' => 'Auth\RegisterController@createAdmin',
    'as' => 'addAdmin'
]);
Route::get('/edituser/{id}', [
    'uses' => 'Auth\RegisterController@edit',
    'as' => 'user.edit'
]);
Route::put('/updateuser/{id}', [
    'uses' => 'Auth\RegisterController@update',
    'as' => 'user.update'
]);

Auth::routes();

