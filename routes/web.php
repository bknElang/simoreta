<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;

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

//login
Route::get('/', 'App\Http\Controllers\AuthController@getLogin')->middleware('guest')->name('login');
Route::post('/', 'App\Http\Controllers\AuthController@postLogin')->middleware('guest');
Route::get('/home', '\App\Http\Controllers\PagesController@home')->middleware('auth')->name('home');

//register
Route::get('/register', 'App\Http\Controllers\AuthController@getRegister')->middleware('auth')->name('register');
Route::post('/register', 'App\Http\Controllers\AuthController@postRegister')->middleware('auth');

//logout
Route::get('/logout', '\App\Http\Controllers\AuthController@logout')->middleware('auth');

//user
Route::get('/users', '\App\Http\Controllers\UsersController@index')->middleware('auth')->name('Users');
Route::get('/users', '\App\Http\Controllers\UsersController@search')->middleware('auth')->name('search');
Route::get('/users/{user}','\App\Http\Controllers\UsersController@show')->middleware('auth')->name('User\'s Detail');
Route::delete('/users/{user}','\App\Http\Controllers\UsersController@destroy')->middleware('auth');
Route::patch('/users/{user}','\App\Http\Controllers\UsersController@update')->middleware('auth');
Route::post('/users/{user}','\App\Http\Controllers\UsersController@updateAvatar')->middleware('auth');

//kendaraan
Route::get('/ordercar', '\App\Http\Controllers\OrderKendaraansController@create')->middleware('auth');
Route::post('/ordercar', '\App\Http\Controllers\OrderKendaraansController@store')->middleware('auth')->name('ordercar');
route::get('/myordercar', '\App\Http\Controllers\OrderKendaraansController@myindex')->middleware('auth');
Route::get('/myordercar/{orderKendaraan}', '\App\Http\Controllers\OrderKendaraansController@show')->middleware('auth')->name('Order\'s Detail');
Route::get('/todocar', '\App\Http\Controllers\OrderKendaraansController@todoindex')->middleware('auth');
Route::get('/todocar/{orderKendaraan}', '\App\Http\Controllers\OrderKendaraansController@edit')->middleware('auth')->name('Order\'s Detail');
Route::post('/todocar/{orderKendaraan}', '\App\Http\Controllers\AssignKendaraansController@store')->middleware('auth')->name('assignkendaraan');
Route::patch('/todocar/{orderKendaraan}', '\App\Http\Controllers\OrderKendaraansController@update')->middleware('auth');
Route::patch('/todocar/{orderKendaraan}/finish', '\App\Http\Controllers\OrderKendaraansController@finish')->middleware('auth');

//myorder
Route::get('/myorder', '\App\Http\Controllers\PagesController@myorder')->middleware('auth')->name('myorder');