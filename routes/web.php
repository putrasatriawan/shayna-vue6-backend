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

use App\Http\Controllers\DashboardController;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;



Route::get('/', 'DashboardController@index')->name('dashboard');


Auth::routes(['register' => false]);

Route::get('products/{id}/gallery', 'ProductController@gallery')
    ->name('products.gallery');

Route::resource('products', 'ProductController');

Route::resource('product-galleries', 'ProductGalleryController');

Route::get('transactions/{id}/set-status', 'TransactionController@setStatus')
    ->name('transactions.status');

Route::resource('transactions', 'TransactionController');

Route::post('test', function () {
    return 'Post is working';
});