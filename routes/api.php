<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*
|----------------------------------------------------------
|  Product Routes
|----------------------------------------------------------
*/

//list products
 Route::get('products', 'ProductController@index');

//list random products
 Route::get('r-products', 'ProductController@rIndex');

//list random sanitization products
 Route::get('f-products', 'ProductController@fIndex');

//single product
 Route::get('product/{slug}', 'ProductController@show');


 // Create New Product
 Route::post('product', 'ProductController@store');

//Edit Product
 Route::get('product/{id}', 'ProductController@edit');

// Update Product
 Route::put('product-edit', 'ProductController@update');

 // Delete Product
 Route::delete('product-edit/{id}', 'ProductController@destroy');


/*
|----------------------------------------------------------
|  Category Routes
|----------------------------------------------------------
*/ 

//list categories
 Route::get('categories', 'CategoryController@index');

// list Products in a specfic Category
 Route::get('category/{slug}', 'ProductController@showCat');


/*
|----------------------------------------------------------
|  Cart Routes
|----------------------------------------------------------
*/

//List Cart Items
Route::get('cart', 'CartController@index');

//Cart count
Route::get('count-total', 'CartController@count_and_total');

//Add To Cart
Route::post('add-to-cart/{id}', 'CartController@add_to_cart');

//Remove From Cart
Route::delete('remove-from-cart/{id}', 'CartController@remove_from_cart');

//Increase Quantity
Route::put('incr-from-cart/{id}', 'CartController@incr_qty');

//Decrease Quantity
Route::put('decr-from-cart/{id}', 'CartController@decr_qty');


/*
|----------------------------------------------------------
|  Checkout/Order Routes
|----------------------------------------------------------
*/

//Checkout
Route::post('checkout', 'OrderController@checkout');
Route::get('orders', 'OrderController@Index');
Route::post('cod', 'OrderController@cod');

//Route::post('/payment','OrderController@Paytm');
//Route::post('/payment','OrderController@order');

/*
|----------------------------------------------------------
|  User Routes
|----------------------------------------------------------
*/

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
Route::patch('updateuser', 'UserController@update');
Route::get('details', 'UserController@details');
Route::post('logout', 'UserController@logout');

});

/*
|----------------------------------------------------------
|  Forgot Password Routes
|----------------------------------------------------------
*/
Route::group([    
    //'namespace' => 'Auth',    
    'middleware' => 'api',    
    'prefix' => 'password'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('reset/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
   // Route::post('encrypt-pass', 'PasswordResetController@encryptPass');
});