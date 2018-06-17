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

Route::get('/', 'IndexController@index');
Route::get('/films/details/id/{id}', 'FilmsController@details')->where('id', '[0-9]+');
Route::get('/logout' , 'Auth\LoginController@logout');
Route::get('/myorders', 'OrdersController@show');
Route::get('/myorders/cart' , 'OrdersController@showCart');
Route::get('/myorders/cart/add/{film_id}', 'OrdersController@addToCart')->where('film_id', '[0-9]+');
Route::get('/myorders/cart/clear', 'OrdersController@clearCart');
Route::get('/myorders/cart/checkout', 'OrdersController@checkout');
Route::get('/myorders/{order_id}', 'OrdersController@showDetails')->where('id', '[0-9]+');
Route::get('/myorders/{order_id}/cancel', 'OrdersController@cancel')->where('id', '[0-9]+');
Route::get('/profile', 'UserController@editUser');
Route::post('/profile', 'UserController@updateUser');

Auth::routes();
