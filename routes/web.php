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

// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');
Route::get('/welcome', 'ItemController@welcome')->name('welcome');
Route::get('/','ItemController@welcome')->name('welcome');


//start subscriber routes
Route::get('/shop','ItemController@shop')->name('shop');

Route::post('/createSubscriber','SubscriberController@store')->name('createSubscriber');

Route::get('/subscribers','SubscriberController@showAll')
        ->name('subscribers')
        ->middleware('auth','ifAdmin');

Route::get('/deleteSubscriber/{id}', [
'uses' => 'SubscriberController@destroy',
'as' => 'subscriber.delete'
])->middleware('auth','ifAdmin');
                
//end  subscriber routes

//start contacts routes
Route::get('/manage_contacts',
['uses' => 'ContactController@showAll',
    'as' => 'contact.showAll'
]);
Route::put('/createcontact',
['uses' => 'ContactController@store',
    'as' => 'contact.store'
])->middleware('auth','ifAdmin');

Route::get('/deleteContact/{id}', [
    'uses' => 'ContactController@destroy',
    'as' => 'contact.delete'
])->middleware('auth','ifAdmin');

Route::put('/updateContact/{id}',
[
    'uses' => 'ContactController@update',
    'as' => 'contact.update'
])->middleware('auth','ifAdmin');
//end contacts routes


// start locations routes
Route::put('/createlocation',
['uses' => 'LocationController@store',
    'as' => 'location.store'
])->middleware('auth','ifAdmin');

Route::get('/wheretobuy',
['uses' => 'LocationController@showAll',
    'as' => 'location.showAll'
]);



Route::get('/deleteLocation/{id}', [
    'uses' => 'LocationController@destroy',
    'as' => 'location.delete'
])->middleware('auth','ifAdmin');

Route::put('/updateLocation/{id}',
[
    'uses' => 'LocationController@update',
    'as' => 'location.update'
])->middleware('auth','ifAdmin');
// end locations routes

// start distributors routes

Route::put('/createdistributor',
['uses' => 'DistributorController@store',
    'as' => 'distributor.store'
]);
Route::get('/showDistributors',
['uses' => 'DistributorController@showAll',
    'as' => 'distributor.showAll'
])->middleware('auth','ifAdmin');
Route::get('/deleteDistributors/{id}',
['uses' => 'DistributorController@delete',
    'as' => 'distributor.delete'
])->middleware('auth','ifAdmin');

Route::get('/distributor', function () {
    return view('distributor_form');
})->name('distributor_form');

// end distributors routes



Route::get('/downloadreport','OrderController@downloadreport')->name('downloadreport');
Route::get('/index', 'ItemController@random')->name('index');

Route::get('/newArrivals', 'ItemController@newArrivals')->name('newArrivals');

Route::get('send-mail','MailSend@mailsend');
Route::get('chat/{id}','MessageController@show')->name('chat')->middleware('auth');
Route::get('changeStatus/{id}','MessageController@changeStatus')->name('changeStatus')->middleware('auth');

Route::post('getmessage','MessageController@getmessage')->name('getmessage')->middleware('auth');
Route::post('automatedmessage','MessageController@automatedmessage')->name('automatedmessage')->middleware('auth');

Route::post('getSenders','MessageController@getSenders')->name('getSenders')->middleware('auth');

Route::post('countmessage','MessageController@countmessage')->name('countmessage');

Route::post('/sendmessage', [
    'uses' => 'MessageController@create',
    'as' => 'sendmessage'
])->middleware('auth');


Route::get('/category/{id}', 'CategoryController@index')->name('category');
Route::get('/product/{num}', 'ItemController@product')->name('ItemController.product');
Route::post('/ItemController/search', 'ItemController@search')->name('ItemController.search');
Route::post('/add-to-cart', 'CartController@AddToCart')->name('item.addToCart');
Route::post('/addToFavorite', 'FavoriteController@addToFavorites')->name('addToFavorite');
Route::get('/favorites', 'FavoriteController@show')->name('favorites')->middleware('auth');

Route::post('/decrementItem', [
    'uses' => 'CartController@decrementItem',
    'as' => 'decrementItem'
]);
Route::post('/incrementItem', [
    'uses' => 'CartController@incrementItem',
    'as' => 'incrementItem'
]);



Route::get('/home', [
    'uses' => 'ItemController@welcome',
    'as' => 'home'
]);
Route::put('/update/{id}',
[
    'uses' => 'ItemController@update',
    'as' => 'item.update'
])->middleware('auth','ifAdmin');
Route::get('/show/{id}', [
    'uses' => 'ItemController@show',
    'as' => 'item.show'
]);


Route::get('/accept/{id}', [
    'uses' => 'OrderController@accept',
    'as' => 'order.accept'
])->middleware('auth','ifAdmin');

Route::get('/invoice/{id}', [
    'uses' => 'OrderController@invoice',
    'as' => 'order.invoice'
])->middleware('auth','ifAdmin');

Route::get('/reject/{id}', [
    'uses' => 'OrderController@reject',
    'as' => 'order.reject'
])->middleware('auth','ifAdmin');
Route::get('/deleteOrder/{id}', [
    'uses' => 'OrderController@destroy',
    'as' => 'order.delete'
])->middleware('auth','ifAdmin');

Route::get('/report', [
    'uses' => 'OrderController@report',
    'as' => 'report'
])->middleware('auth','ifAdmin');
Route::get('/createitem',
[
    'uses' => 'ItemController@create',
    'as' => 'item.create'
])->middleware('auth','ifAdmin');
Route::put('/checkout',
[
    'uses' => 'OrderController@create',
    'as' => 'checkout'
])->middleware('auth');
Route::get('/deleteitem/{id}',
[
    'uses' => 'ItemController@destroy',
    'as' => 'item.delete'
])->middleware('auth','ifAdmin');
Route::get('/hideitem/{id}',
[
    'uses' => 'ItemController@hide',
    'as' => 'hideitem'
])->middleware('auth','ifAdmin');

Route::get('/deleteimage/{id}',
[
    'uses' => 'ItemController@deleteImage',
    'as' => 'image.delete'
])->middleware('auth','ifAdmin');
Route::get('/edititem/{id}', [
    'uses' => 'ItemController@edit',
    'as' => 'item.edit'
])->middleware('auth','ifAdmin');


//start category routes
Route::put('/createcategory',
[
    'uses' => 'CategoryController@store',
    'as' => 'category.store'
])->middleware('auth','ifAdmin');
Route::get('/editcategory', [
    'uses' => 'CategoryController@edit',
    'as' => 'category.edit'
])->middleware('auth','ifAdmin');
Route::get('/deleteCategory/{id}', [
    'uses' => 'CategoryController@destroy',
    'as' => 'category.delete'
])->middleware('auth','ifAdmin');

Route::put('/updateCategory/{id}',
[
    'uses' => 'CategoryController@update',
    'as' => 'category.update'
])->middleware('auth','ifAdmin');
//end category routes


Route::get('/cart',
[
    'uses' => 'CartController@showCart',
    'as' => 'cart'
]);

Route::get('/removefromcart/{id}', [
    'uses' => 'CartController@removeItem',
    'as' => 'removefromcart'
]);

Route::get('/removefromfavorites/{id}', [
    'uses' => 'FavoriteController@remove',
    'as' => 'removefromfavorites'
]);



Route::get('/vieworders',[
    'uses' => 'OrderController@showAll',
    'as' => 'vieworders'
])->middleware('auth','ifAdmin');
Route::get('/viewmails','MessageController@index')->name('viewmails')->middleware('auth','ifAdmin');
Route::get('/Mail_us_Admin/reply','MessageController@store')->middleware('auth','ifAdmin');


Route::put('/storeitem', [
    'uses' => 'ItemController@store',
    'as' => 'item.store'
])->middleware('auth','ifAdmin');

Route::put('/addAdmin', [
    'uses' => 'Auth\RegisterController@createAdmin',
    'as' => 'addAdmin'
])->middleware('auth','ifAdmin');
Route::get('/addadminview', function () {
    return view('auth/addadmin');
})->name('addadminview')->middleware('auth','ifAdmin');

Route::get('/lastorder', [
    'uses' => 'OrderController@show',
])->name('lastorder')->middleware('auth');

Route::get('/edituser/{id}', [
    'uses' => 'Auth\RegisterController@edit',
    'as' => 'user.edit'
])->middleware('auth');
Route::put('/updateuser/{id}', [
    'uses' => 'Auth\RegisterController@update',
    'as' => 'user.update'
]);
Route::get('autocomplete', 'ItemController@autocomplete')->name('autocomplete');

Route::get('/users','MessageController@showAll')->name('users')->middleware('auth','ifAdmin');
Route::post('/usersearch','MessageController@search')->name('user.search')->middleware('auth','ifAdmin');


Auth::routes();
Route::get('auth/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback'); 


