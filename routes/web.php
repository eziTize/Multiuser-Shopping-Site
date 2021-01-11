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

//Route::view('forgot_password', 'reset_password')->name('password.reset');
//Route::get('password/reset/{token}', 'PasswordResetController@find');

//Paytm Routes
Route::get('/payment','PaytmController@order');
Route::post('/payment/status', 'PaytmController@paymentCallback');
Route::get('/order-placed', function () {
    return view('o_placed');
});
include_once("admin.php");
include_once("seller.php");


/*Route::get('/payment/status/failed', function () {
    return view('Failed');
});

Route::get('/payment/status/successful', function () {
    return view('Successful');
});

Route::get('/payment/status/pending', function () {
    return view('Pending');
});
*/

/*Route::get('/{any?}', function () {
    return view('welcome');
    
})->where('any', '.*');*/


Route::get('{any}', 'AppController@index')
->where('any', '.*')
->name('welcome');

