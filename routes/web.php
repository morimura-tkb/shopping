<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/shopping/products/{id}/{page_id?}','ProductsController@index')->name('shopping.index');
Route::post('/shopping/search_result/{page_id?}','ProductsController@search');
Route::get('/shopping/search_result/{page_id?}','ProductsController@search')->name('shopping.search');

Route::get('/shopping/nusers/member','NusersController@member');
Route::get('/shopping/nusers/login','NusersController@login')->name('shopping.login');
Route::get('/shopping/nusers/register','NusersController@register')->name('shopping.register');

Route::get('/shopping/users/userinfo','UsersController@userinfo');
Route::get('/shopping/users/cash','UsersController@cash');

Route::get('shopping/users/cart','CartController@products_cart');

Route::get('shopping/users/message','UsersController@message');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/shopping/users/userinfo','UsersController@userinfo');
    Route::post('/shopping/users/userinfo_change','UsersController@userinfo_change');
    Route::post('/shopping/users/pass_change','UsersController@pass_change');
    Route::get('/shopping/users/cash','UsersController@cash');

    Route::get('shopping/users/cart','CartController@products_cart');
    
    Route::post('/shopping/users/cart','CartController@add_cart');
    Route::post('/shopping/users/cart/delete','CartController@delete');
    Route::post('/shopping/users/cart/change','CartController@change');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
