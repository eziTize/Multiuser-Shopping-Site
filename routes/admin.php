<?php

/*
|----------------------------------------------------------------
|   Admin Routes
|----------------------------------------------------------------
*/
Route::group(array('prefix' => env('admin'),'namespace' => 'Admin'), function(){
    Route::get('/','AdminController@root');
    Route::get('login','AdminController@index');
    Route::post('login','AdminController@login');
    Route::get('logout','AdminController@logout');

    Route::group(['middleware' => 'admin'], function(){
        
        /*
        |----------------------------------------------------------------
        |   Dashboard & Account Settings
        |----------------------------------------------------------------
        */
        Route::get('dashboard','AdminController@dashboard');
        Route::get('settings','AdminController@settings');
        Route::post('settings','AdminController@update')->name('admin.settings');


        /*
        |----------------------------------------------------------------
        |   Manage Products
        |----------------------------------------------------------------
        */

        Route::get('products','ProductController@index');  // List
        Route::get('products/{id}/edit','ProductController@edit');  // Edit Page
        Route::put('products/{id}/update','ProductController@update'); // Update Data
        Route::delete('products/{id}/delete','ProductController@destroy'); // Delete
        Route::get('products/create','ProductController@create'); // Create
        Route::post('products/store','ProductController@store'); // Store Data


        /*
        |----------------------------------------------------------------
        |   Manage Categories
        |----------------------------------------------------------------
        */

        Route::get('categories','CategoryController@index');  // List
        Route::get('categories/{id}/edit','CategoryController@edit');  // Edit Page
        Route::put('categories/{id}/update','CategoryController@update'); // Update Data
        Route::delete('categories/{id}/delete','CategoryController@destroy'); // Delete
        Route::get('categories/create','CategoryController@create'); // Create
        Route::post('categories/store','CategoryController@store'); // Store Data


        /*
        |----------------------------------------------------------------
        |   Manage Customers
        |----------------------------------------------------------------
        */

        Route::get('customers','CustomerController@index');  // List


        /*
        |----------------------------------------------------------------
        |   Manage Orders
        |----------------------------------------------------------------
        */

        Route::get('orders','OrderController@index');  // List
        Route::get('orders/{id}/edit','OrderController@editStatus'); // Edit Page
        Route::put('orders/{id}/update','OrderController@toggleStatus'); // Update Status
        Route::get('orders/{id}/view','OrderController@show'); // Show Details

        /*
        |----------------------------------------------------------
        |   Manage Sellers
        |----------------------------------------------------------
        */

        Route::get('seller','SellerController@index')->name('seller.index'); // List
        Route::get('seller/{id}/edit','SellerController@edit')->name('seller.edit');;  // Edit Page
        Route::put('seller/{id}/update','SellerController@update')->name('seller.update'); // Update Data
        Route::delete('seller/{id}/delete','SellerController@destroy')->name('seller.destroy'); // Delete
        Route::put('seller/{id}/e-reset','SellerController@e_reset')->name('seller.reset'); // Earning Reset
        Route::get('seller/create','SellerController@create')->name('seller.create'); // Create
        Route::post('seller/store','SellerController@store')->name('seller.store'); // Store Data

        //Route::resource('seller','SellerController');


        /*
        |----------------------------------------------------------
        |   Manage Sales
        |----------------------------------------------------------
        */

        Route::get('sales','SalesController@index')->name('sales.index'); // List

    });
});