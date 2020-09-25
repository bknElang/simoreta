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
Route::get('/', 'App\Http\Controllers\AuthController@getLogin')->name('login')->middleware('guest');
Route::post('/', 'App\Http\Controllers\AuthController@postLogin')->middleware('guest');

//register
Route::get('/register', 'App\Http\Controllers\AuthController@getRegister')->name('register')->middleware('auth');
Route::post('/register', 'App\Http\Controllers\AuthController@postRegister')->middleware('auth');

//logout
Route::get('/logout', '\App\Http\Controllers\AuthController@logout')->middleware('auth');

//user
Route::get('/home', '\App\Http\Controllers\PagesController@home')->middleware('auth')->name('home');
Route::get('/users', '\App\Http\Controllers\UsersController@index')->middleware('auth')->name('Users');
Route::get('/users', '\App\Http\Controllers\UsersController@search')->middleware('auth')->name('search');
Route::get('/users/{user}','\App\Http\Controllers\UsersController@show')->middleware('auth')->name('User\'s Detail');
Route::delete('/users/{user}','\App\Http\Controllers\UsersController@destroy')->middleware('auth');
Route::patch('/users/{user}','\App\Http\Controllers\UsersController@update')->middleware('auth');
Route::post('/users/{user}','\App\Http\Controllers\UsersController@updateAvatar')->middleware('auth');




