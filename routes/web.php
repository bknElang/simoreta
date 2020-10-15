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

//test
Route::get('/test/{user}', '\App\Http\Controllers\UsersController@test')->middleware('guest')->name('User\'s Detail');

//login
Route::get('/', 'App\Http\Controllers\AuthController@getLogin')->middleware('guest')->name('login');
Route::post('/', 'App\Http\Controllers\AuthController@postLogin')->middleware('guest');
Route::get('/home', '\App\Http\Controllers\PagesController@home')->middleware('auth')->name('home');

//forgot password
Route::get('/forgotpassword', '\App\Http\Controllers\AuthController@getReset')->middleware('guest')->name('forgotpassword');
Route::post('/forgotpassword', '\App\Http\Controllers\AuthController@postReset')->middleware('guest');
Route::get('/viewforgot', '\App\Http\Controllers\AuthController@viewReset')->middleware('auth');
Route::delete('/viewforgot/{resetRequest}', '\App\Http\Controllers\ResetRequestsController@destroy')->middleware('auth');

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
Route::post('/users/{user}','\App\Http\Controllers\UsersController@updateAvatar')->middleware('auth');
Route::get('/changepassword/{user}', '\App\Http\Controllers\UsersController@changepassword')->middleware('auth')->name('changepassword');
Route::patch('/changepassword/{user}', '\App\Http\Controllers\UsersController@updatePassword')->middleware('auth');

//aktiva
Route::get('/aktiva', '\App\Http\Controllers\OrderAktivasController@create')->middleware('auth');
Route::post('/aktiva', '\App\Http\Controllers\OrderAktivasController@store')->middleware('auth')->name('aktiva');
route::get('/myaktiva', '\App\Http\Controllers\OrderAktivasController@myindex')->middleware('auth');
route::get('/searchmyaktiva', '\App\Http\Controllers\OrderAktivasController@mysearch')->middleware('auth');
Route::get('/myaktiva/{orderAktiva}', '\App\Http\Controllers\OrderAktivasController@show')->middleware('auth')->name('Order\'s Detail');
route::get('/authaktiva', '\App\Http\Controllers\OrderAktivasController@authindex')->middleware('auth');
route::get('/searchauthaktiva', '\App\Http\Controllers\OrderAktivasController@authsearch')->middleware('auth');
Route::get('/authaktiva/{orderAktiva}', '\App\Http\Controllers\OrderAktivasController@authdetail')->middleware('auth')->name('Order\'s Detail');
Route::patch('/authaktiva/{orderAktiva}/approve', '\App\Http\Controllers\OrderAktivasController@approve')->middleware('auth');
Route::patch('/authaktiva/{orderAktiva}/reject', '\App\Http\Controllers\OrderAktivasController@reject')->middleware('auth');
Route::get('/todoaktiva', '\App\Http\Controllers\OrderAktivasController@todoindex')->middleware('auth');
route::get('/searchtodoaktiva', '\App\Http\Controllers\OrderAktivasController@todosearch')->middleware('auth');
Route::get('/todoaktiva/{orderAktiva}', '\App\Http\Controllers\OrderAktivasController@edit')->middleware('auth')->name('Order\'s Detail');
Route::patch('/todoaktiva/{orderAktiva}', '\App\Http\Controllers\OrderAktivasController@update')->middleware('auth');
Route::patch('/todoaktiva/{orderAktiva}/finish', '\App\Http\Controllers\OrderAktivasController@finish')->middleware('auth');

//kendaraan
Route::get('/ordercar', '\App\Http\Controllers\OrderKendaraansController@create')->middleware('auth');
Route::post('/ordercar', '\App\Http\Controllers\OrderKendaraansController@store')->middleware('auth')->name('ordercar');
route::get('/myordercar', '\App\Http\Controllers\OrderKendaraansController@myindex')->middleware('auth');
route::get('/searchmyordercar', '\App\Http\Controllers\OrderKendaraansController@mysearch')->middleware('auth');
Route::get('/myordercar/{orderKendaraan}', '\App\Http\Controllers\OrderKendaraansController@show')->middleware('auth')->name('Order\'s Detail');
route::get('/authcar', '\App\Http\Controllers\OrderKendaraansController@authindex')->middleware('auth');
route::get('/searchauthcar', '\App\Http\Controllers\OrderKendaraansController@authsearch')->middleware('auth');
Route::get('/authcar/{orderKendaraan}', '\App\Http\Controllers\OrderKendaraansController@authdetail')->middleware('auth')->name('Order\'s Detail');
Route::patch('/authcar/{orderKendaraan}/approve', '\App\Http\Controllers\OrderKendaraansController@approve')->middleware('auth');
Route::patch('/authcar/{orderKendaraan}/reject', '\App\Http\Controllers\OrderKendaraansController@reject')->middleware('auth');
Route::get('/todocar', '\App\Http\Controllers\OrderKendaraansController@todoindex')->middleware('auth');
Route::get('/searchtodocar', '\App\Http\Controllers\OrderKendaraansController@searchtodo')->middleware('auth');
Route::get('/todocar/{orderKendaraan}', '\App\Http\Controllers\OrderKendaraansController@edit')->middleware('auth')->name('Order\'s Detail');
Route::post('/todocar/{orderKendaraan}', '\App\Http\Controllers\AssignKendaraansController@store')->middleware('auth')->name('assignkendaraan');
Route::patch('/todocar/{orderKendaraan}', '\App\Http\Controllers\OrderKendaraansController@update')->middleware('auth');
Route::patch('/todocar/{orderKendaraan}/finish', '\App\Http\Controllers\OrderKendaraansController@finish')->middleware('auth');

//reimbursement
Route::get('/reimbursement', '\App\Http\Controllers\OrderReimbursementsController@create')->middleware('auth');
Route::post('/reimbursement', '\App\Http\Controllers\OrderReimbursementsController@store')->middleware('auth')->name('reimbursement');
route::get('/myreimbursement', '\App\Http\Controllers\OrderReimbursementsController@myindex')->middleware('auth');
route::get('/searchmyreimbursement', '\App\Http\Controllers\OrderReimbursementsController@mysearch')->middleware('auth');
Route::get('/myreimbursement/{orderReimbursement}', '\App\Http\Controllers\OrderReimbursementsController@show')->middleware('auth')->name('Order\'s Detail');
route::get('/authreimbursement', '\App\Http\Controllers\OrderReimbursementsController@authindex')->middleware('auth');
route::get('/searchauthreimbursement', '\App\Http\Controllers\OrderReimbursementsController@authsearch')->middleware('auth');
Route::get('/authreimbursement/{orderReimbursement}', '\App\Http\Controllers\OrderReimbursementsController@authdetail')->middleware('auth')->name('Order\'s Detail');
Route::patch('/authreimbursement/{orderReimbursement}/approve', '\App\Http\Controllers\OrderReimbursementsController@approve')->middleware('auth');
Route::patch('/authreimbursement/{orderReimbursement}/reject', '\App\Http\Controllers\OrderReimbursementsController@reject')->middleware('auth');
Route::get('/todoreimbursement', '\App\Http\Controllers\OrderReimbursementsController@todoindex')->middleware('auth');
route::get('/searchtodoreimbursement', '\App\Http\Controllers\OrderReimbursementsController@todosearch')->middleware('auth');
Route::get('/todoreimbursement/{orderReimbursement}', '\App\Http\Controllers\OrderReimbursementsController@edit')->middleware('auth')->name('Order\'s Detail');
Route::patch('/todoreimbursement/{orderReimbursement}', '\App\Http\Controllers\OrderReimbursementsController@update')->middleware('auth');
Route::patch('/todoreimbursement/{orderReimbursement}/finish', '\App\Http\Controllers\OrderReimbursementsController@finish')->middleware('auth');

//atk
Route::get('/atk', '\App\Http\Controllers\OrderATKsController@create')->middleware('auth');
Route::post('/atk', '\App\Http\Controllers\OrderATKsController@store')->middleware('auth')->name('atk');
route::get('/myatk', '\App\Http\Controllers\OrderATKsController@myindex')->middleware('auth');
route::get('/searchmyatk', '\App\Http\Controllers\OrderATKsController@mysearch')->middleware('auth');
route::get('/myatk/{orderATK}', '\App\Http\Controllers\OrderATKsController@show')->middleware('auth')->name('Order\'s Detail');
route::get('/authatk', '\App\Http\Controllers\OrderATKsController@authindex')->middleware('auth');
route::get('/searchauthatk', '\App\Http\Controllers\OrderATKsController@authsearch')->middleware('auth');
Route::get('/authatk/{orderATK}', '\App\Http\Controllers\OrderATKsController@authdetail')->middleware('auth')->name('Order\'s Detail');
Route::patch('/authatk/{orderATK}/approve', '\App\Http\Controllers\OrderATKsController@approve')->middleware('auth');
Route::patch('/authatk/{orderATK}/reject', '\App\Http\Controllers\OrderATKsController@reject')->middleware('auth');
Route::get('/todoatk', '\App\Http\Controllers\OrderATKsController@todoindex')->middleware('auth');
route::get('/searchtodoatk', '\App\Http\Controllers\OrderATKsController@todosearch')->middleware('auth');
Route::get('/todoatk/{orderATK}', '\App\Http\Controllers\OrderATKsController@edit')->middleware('auth')->name('Order\'s Detail');
Route::patch('/todoatk/{orderATK}', '\App\Http\Controllers\OrderATKsController@update')->middleware('auth');
Route::patch('/todoatk/{orderATK}/finish', '\App\Http\Controllers\OrderATKsController@finish')->middleware('auth');

//kiriman
Route::get('/kiriman', '\App\Http\Controllers\OrderKirimansController@create')->middleware('auth');
Route::post('/kiriman', '\App\Http\Controllers\OrderKirimansController@store')->middleware('auth')->name('kiriman');
route::get('/mykiriman', '\App\Http\Controllers\OrderKirimansController@myindex')->middleware('auth');
route::get('/searchmykiriman', '\App\Http\Controllers\OrderKirimansController@mysearch')->middleware('auth');
route::get('/mykiriman/{orderKiriman}', '\App\Http\Controllers\OrderKirimansController@show')->middleware('auth')->name('Order\'s Detail');
route::get('/authkiriman', '\App\Http\Controllers\OrderKirimansController@authindex')->middleware('auth');
route::get('/searchauthkiriman', '\App\Http\Controllers\OrderKirimansController@authsearch')->middleware('auth');
Route::get('/authkiriman/{orderKiriman}', '\App\Http\Controllers\OrderKirimansController@authdetail')->middleware('auth')->name('Order\'s Detail');
Route::patch('/authkiriman/{orderKiriman}/approve', '\App\Http\Controllers\OrderKirimansController@approve')->middleware('auth');
Route::patch('/authkiriman/{orderKiriman}/reject', '\App\Http\Controllers\OrderKirimansController@reject')->middleware('auth');
Route::get('/todokiriman', '\App\Http\Controllers\OrderKirimansController@todoindex')->middleware('auth');
route::get('/searchtodokiriman', '\App\Http\Controllers\OrderKirimansController@todosearch')->middleware('auth');
Route::get('/todokiriman/{orderKiriman}', '\App\Http\Controllers\OrderKirimansController@edit')->middleware('auth')->name('Order\'s Detail');
Route::patch('/todokiriman/{orderKiriman}', '\App\Http\Controllers\OrderKirimansController@update')->middleware('auth');
Route::patch('/todokiriman/{orderKiriman}/finish', '\App\Http\Controllers\OrderKirimansController@finish')->middleware('auth');

//jurnal manual
Route::get('/jurnalmanual', '\App\Http\Controllers\JurnalManualsController@create')->middleware('auth');
Route::post('/jurnalmanual', '\App\Http\Controllers\JurnalManualsController@store')->middleware('auth')->name('jurnalmanual');
route::get('/myjurnalmanual', '\App\Http\Controllers\JurnalManualsController@myindex')->middleware('auth');
route::get('/searchmyjurnalmanual', '\App\Http\Controllers\JurnalManualsController@mysearch')->middleware('auth');
Route::get('/myjurnalmanual/{jurnalManual}', '\App\Http\Controllers\JurnalManualsController@show')->middleware('auth')->name('Order\'s Detail');
route::get('/authjurnalmanual', '\App\Http\Controllers\JurnalManualsController@authindex')->middleware('auth');
route::get('/searchauthjurnalmanual', '\App\Http\Controllers\JurnalManualsController@authsearch')->middleware('auth');
Route::get('/authjurnalmanual/{jurnalManual}', '\App\Http\Controllers\JurnalManualsController@authdetail')->middleware('auth')->name('Order\'s Detail');
Route::patch('/authjurnalmanual/{jurnalManual}/approve', '\App\Http\Controllers\JurnalManualsController@approve')->middleware('auth');
Route::patch('/authjurnalmanual/{jurnalManual}/reject', '\App\Http\Controllers\JurnalManualsController@reject')->middleware('auth');
Route::get('/todomanual', '\App\Http\Controllers\JurnalManualsController@todoindex')->middleware('auth');
route::get('/searchtodomanual', '\App\Http\Controllers\JurnalManualsController@todosearch')->middleware('auth');
Route::get('/todomanual/{jurnalManual}', '\App\Http\Controllers\JurnalManualsController@edit')->middleware('auth')->name('Order\'s Detail');
Route::patch('/todomanual/{jurnalManual}', '\App\Http\Controllers\JurnalManualsController@update')->middleware('auth');
Route::patch('/todomanual/{jurnalManual}/finish', '\App\Http\Controllers\JurnalManualsController@finish')->middleware('auth');

//jurnal AAK
Route::get('/jurnalaak', '\App\Http\Controllers\JurnalAAKsController@create')->middleware('auth');
Route::post('/jurnalaak', '\App\Http\Controllers\JurnalAAKsController@store')->middleware('auth')->name('jurnalaak');
route::get('/myjurnalaak', '\App\Http\Controllers\JurnalAAKsController@myindex')->middleware('auth');
route::get('/searchmyjurnalaak', '\App\Http\Controllers\JurnalAAKsController@mysearch')->middleware('auth');
Route::get('/myjurnalaak/{jurnalAAK}', '\App\Http\Controllers\JurnalAAKsController@show')->middleware('auth')->name('Order\'s Detail');
route::get('/authjurnalaak', '\App\Http\Controllers\JurnalAAKsController@authindex')->middleware('auth');
route::get('/searchauthjurnalaak', '\App\Http\Controllers\JurnalAAKsController@authsearch')->middleware('auth');
Route::get('/authjurnalaak/{jurnalAAK}', '\App\Http\Controllers\JurnalAAKsController@authdetail')->middleware('auth')->name('Order\'s Detail');
Route::patch('/authjurnalaak/{jurnalAAK}/approve', '\App\Http\Controllers\JurnalAAKsController@approve')->middleware('auth');
Route::patch('/authjurnalaak/{jurnalAAK}/reject', '\App\Http\Controllers\JurnalAAKsController@reject')->middleware('auth');
Route::get('/todoaak', '\App\Http\Controllers\JurnalAAKsController@todoindex')->middleware('auth');
route::get('/searchtodoaak', '\App\Http\Controllers\JurnalAAKsController@todosearch')->middleware('auth');
Route::get('/todoaak/{jurnalAAK}', '\App\Http\Controllers\JurnalAAKsController@edit')->middleware('auth')->name('Order\'s Detail');
Route::patch('/todoaak/{jurnalAAK}', '\App\Http\Controllers\JurnalAAKsController@update')->middleware('auth');
Route::patch('/todoaak/{jurnalAAK}/finish', '\App\Http\Controllers\JurnalAAKsController@finish')->middleware('auth');

//requestjob
Route::get('/requestjob', '\App\Http\Controllers\OrderRequestJobsController@create')->middleware('auth');
Route::post('/requestjob', '\App\Http\Controllers\OrderRequestJobsController@store')->middleware('auth')->name('requestjob');
route::get('/myjob', '\App\Http\Controllers\OrderRequestJobsController@myindex')->middleware('auth');
route::get('/searchmyjob', '\App\Http\Controllers\OrderRequestJobsController@mysearch')->middleware('auth');
Route::get('/myjob/{orderRequestJob}', '\App\Http\Controllers\OrderRequestJobsController@show')->middleware('auth')->name('Order\'s Detail');
route::get('/authjob', '\App\Http\Controllers\OrderRequestJobsController@authindex')->middleware('auth');
route::get('/searchauthjob', '\App\Http\Controllers\OrderRequestJobsController@authsearch')->middleware('auth');
Route::get('/authjob/{orderRequestJob}', '\App\Http\Controllers\OrderRequestJobsController@authdetail')->middleware('auth')->name('Order\'s Detail');
Route::patch('/authjob/{orderRequestJob}/approve', '\App\Http\Controllers\OrderRequestJobsController@approve')->middleware('auth');
Route::patch('/authjob/{orderRequestJob}/reject', '\App\Http\Controllers\OrderRequestJobsController@reject')->middleware('auth');
Route::get('/todojob', '\App\Http\Controllers\OrderRequestJobsController@todoindex')->middleware('auth');
Route::get('/searchtodojob', '\App\Http\Controllers\OrderRequestJobsController@todosearch')->middleware('auth');
Route::get('/todojob/{orderRequestJob}', '\App\Http\Controllers\OrderRequestJobsController@edit')->middleware('auth')->name('Order\'s Detail');
Route::patch('/todojob/{orderRequestJob}', '\App\Http\Controllers\OrderRequestJobsController@update')->middleware('auth');
Route::patch('/todojob/{orderRequestJob}/finish', '\App\Http\Controllers\OrderRequestJobsController@finish')->middleware('auth');

//fixcomputer
Route::get('/fixcomputer', '\App\Http\Controllers\OrderFixComputerController@create')->middleware('auth');
Route::post('/fixcomputer', '\App\Http\Controllers\OrderFixComputerController@store')->middleware('auth')->name('fixcomputer');
route::get('/myfixcomputer', '\App\Http\Controllers\OrderFixComputerController@myindex')->middleware('auth');
route::get('/searchmyfixcomputer', '\App\Http\Controllers\OrderFixComputerController@mysearch')->middleware('auth');
Route::get('/myfixcomputer/{orderFixComputer}', '\App\Http\Controllers\OrderFixComputerController@show')->middleware('auth')->name('Order\'s Detail');
route::get('/authfixcomputer', '\App\Http\Controllers\OrderFixComputerController@authindex')->middleware('auth');
route::get('/searchauthfixcomputer', '\App\Http\Controllers\OrderFixComputerController@authsearch')->middleware('auth');
Route::get('/authfixcomputer/{orderFixComputer}', '\App\Http\Controllers\OrderFixComputerController@authdetail')->middleware('auth')->name('Order\'s Detail');
Route::patch('/authfixcomputer/{orderFixComputer}/approve', '\App\Http\Controllers\OrderFixComputerController@approve')->middleware('auth');
Route::patch('/authfixcomputer/{orderFixComputer}/reject', '\App\Http\Controllers\OrderFixComputerController@reject')->middleware('auth');
Route::get('/todofixcomputer', '\App\Http\Controllers\OrderFixComputerController@todoindex')->middleware('auth');
route::get('/searchtodofixcomputer', '\App\Http\Controllers\OrderFixComputerController@todosearch')->middleware('auth');
Route::get('/todofixcomputer/{orderFixComputer}', '\App\Http\Controllers\OrderFixComputerController@edit')->middleware('auth')->name('Order\'s Detail');
Route::patch('/todofixcomputer/{orderFixComputer}', '\App\Http\Controllers\OrderFixComputerController@update')->middleware('auth');
Route::patch('/todofixcomputer/{orderFixComputer}/finish', '\App\Http\Controllers\OrderFixComputerController@finish')->middleware('auth');

//fixaplikasi
Route::get('/fixaplikasi', '\App\Http\Controllers\OrderFixAplikasiController@create')->middleware('auth');
Route::post('/fixaplikasi', '\App\Http\Controllers\OrderFixAplikasiController@store')->middleware('auth')->name('fixaplikasi');
route::get('/myfixaplikasi', '\App\Http\Controllers\OrderFixAplikasiController@myindex')->middleware('auth');
route::get('/searchmyfixaplikasi', '\App\Http\Controllers\OrderFixAplikasiController@mysearch')->middleware('auth');
Route::get('/myfixaplikasi/{orderFixAplikasi}', '\App\Http\Controllers\OrderFixAplikasiController@show')->middleware('auth')->name('Order\'s Detail');
route::get('/authfixaplikasi', '\App\Http\Controllers\OrderFixAplikasiController@authindex')->middleware('auth');
route::get('/searchauthfixaplikasi', '\App\Http\Controllers\OrderFixAplikasiController@authsearch')->middleware('auth');
Route::get('/authfixaplikasi/{orderFixAplikasi}', '\App\Http\Controllers\OrderFixAplikasiController@authdetail')->middleware('auth')->name('Order\'s Detail');
Route::patch('/authfixaplikasi/{orderFixAplikasi}/approve', '\App\Http\Controllers\OrderFixAplikasiController@approve')->middleware('auth');
Route::patch('/authfixaplikasi/{orderFixAplikasi}/reject', '\App\Http\Controllers\OrderFixAplikasiController@reject')->middleware('auth');
Route::get('/todofixaplikasi', '\App\Http\Controllers\OrderFixAplikasiController@todoindex')->middleware('auth');
route::get('/searchtodofixaplikasi', '\App\Http\Controllers\OrderFixAplikasiController@todosearch')->middleware('auth');
Route::get('/todofixaplikasi/{orderFixAplikasi}', '\App\Http\Controllers\OrderFixAplikasiController@edit')->middleware('auth')->name('Order\'s Detail');
Route::patch('/todofixaplikasi/{orderFixAplikasi}', '\App\Http\Controllers\OrderFixAplikasiController@update')->middleware('auth');
Route::patch('/todofixaplikasi/{orderFixAplikasi}/finish', '\App\Http\Controllers\OrderFixAplikasiController@finish')->middleware('auth');

//fixhardware
Route::get('/fixhardware', '\App\Http\Controllers\OrderFixHardwareController@create')->middleware('auth');
Route::post('/fixhardware', '\App\Http\Controllers\OrderFixHardwareController@store')->middleware('auth')->name('fixhardware');
route::get('/myfixhardware', '\App\Http\Controllers\OrderFixHardwareController@myindex')->middleware('auth');
route::get('/searchmyfixhardware', '\App\Http\Controllers\OrderFixHardwareController@mysearch')->middleware('auth');
Route::get('/myfixhardware/{orderFixHardware}', '\App\Http\Controllers\OrderFixHardwareController@show')->middleware('auth')->name('Order\'s Detail');
route::get('/authfixhardware', '\App\Http\Controllers\OrderFixHardwareController@authindex')->middleware('auth');
route::get('/searchauthfixhardware', '\App\Http\Controllers\OrderFixHardwareController@authsearch')->middleware('auth');
Route::get('/authfixhardware/{orderFixHardware}', '\App\Http\Controllers\OrderFixHardwareController@authdetail')->middleware('auth')->name('Order\'s Detail');
Route::patch('/authfixhardware/{orderFixHardware}/approve', '\App\Http\Controllers\OrderFixHardwareController@approve')->middleware('auth');
Route::patch('/authfixhardware/{orderFixHardware}/reject', '\App\Http\Controllers\OrderFixHardwareController@reject')->middleware('auth');
Route::get('/todofixhardware', '\App\Http\Controllers\OrderFixHardwareController@todoindex')->middleware('auth');
route::get('/searchtodofixhardware', '\App\Http\Controllers\OrderFixHardwareController@todosearch')->middleware('auth');
Route::get('/todofixhardware/{orderFixHardware}', '\App\Http\Controllers\OrderFixHardwareController@edit')->middleware('auth')->name('Order\'s Detail');
Route::patch('/todofixhardware/{orderFixHardware}', '\App\Http\Controllers\OrderFixHardwareController@update')->middleware('auth');
Route::patch('/todofixhardware/{orderFixHardware}/finish', '\App\Http\Controllers\OrderFixHardwareController@finish')->middleware('auth');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
