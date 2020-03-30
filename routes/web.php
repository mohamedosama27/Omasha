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

// Route::get('/', 'ItemController@showAll');

    Route::get('/', 'ItemController@index')->name('home');
    Route::get('/category/{id}', 'CategoryController@index')->name('category');

    Route::get('/ItemController/action', 'ItemController@action')->name('ItemController.action');
Route::post('/add-to-cart', 'CartController@AddToCart')->name('item.addToCart');

Route::post('/decrementItem', [
    'uses' => 'CartController@decrementItem',
    'as' => 'decrementItem'
]);
Route::post('/incrementItem', [
    'uses' => 'CartController@incrementItem',
    'as' => 'incrementItem'
]);



Route::get('/home', [
    'uses' => 'ItemController@index',
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
Route::get('/deleteimage/{id}',
[
    'uses' => 'ItemController@deleteImage',
    'as' => 'image.delete'
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



Route::get('/vieworders',[
    'uses' => 'OrderController@showAll',
    'as' => 'vieworders'
]);
Route::get('/viewmails','MailController@index')->name('viewmails');
Route::get('/Mail_us_Admin/reply','MailController@store');


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
Route::get('autocomplete', 'ItemController@autocomplete')->name('autocomplete');


Auth::routes();

