<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', 'ProductController@create')->name('create.product');
Route::post('/store', 'ProductController@store')->name('store.product');
Route::get('/sell/{productId}', 'ProductController@sell')->name('sell.product');
Route::get('/update-price/{productId}/{newPrice}', 'ProductController@updatePrice')->name('update.price');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

