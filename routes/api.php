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

//mengambil api product menggunakan method get
Route::get('products', 'API\ProductController@all');
//mempost atau menampilkan data checkout
Route::post('checkout', 'API\CheckoutController@checkout');

Route::get('transactions/{id}', 'API\TransactionController@get');


// image.png