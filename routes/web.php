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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'AuthController@index');

Route::get('/login', 'AuthController@login');
Route::post('/loginPost', 'AuthController@loginPost');

Route::get('/register', 'AuthController@register');
Route::post('/registerPost', 'AuthController@registerPost');

Route::get('/logout', 'AuthController@logout');

Route::resource('products','ProductController');
Route::post('/imageupload', 'ProductController@imageUploadPost');
Route::post('/products/store', 'ProductController@store');



;
//Route::resource('product.layout','ProductController');

