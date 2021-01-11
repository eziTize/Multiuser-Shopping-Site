<?php

/*
|----------------------------------------------------------------
|   Seller Routes
|----------------------------------------------------------------
*/
Route::group(array('prefix' => env('seller'),'namespace' => 'Seller'), function(){
    Route::get('/','AdminController@root');
    Route::get('login','AdminController@index');
    Route::post('login','AdminController@login');
    Route::get('logout','AdminController@logout');
    Route::post('loginWithID/{id}','AdminController@loginWithID');

    Route::group(['middleware' => 'seller'], function(){
        
        /*
        |----------------------------------------------------------------
        |   Dashboard & Account Settings
        |----------------------------------------------------------------
        */
        Route::get('dashboard','AdminController@dashboard');
        Route::get('settings','AdminController@settings');
        Route::post('settings','AdminController@update')->name('settings.update');


        /*
        |----------------------------------------------------------
        |   Manage Sales
        |----------------------------------------------------------
        */

        Route::get('sales','SalesController@index')->name('s_sales.index'); // List


        /*
        |----------------------------------------------------------
        |   Wallet 
        |----------------------------------------------------------
        */

        Route::get('wallet', function () {
            return view('seller.wallet.index');
        });

        
    });
});