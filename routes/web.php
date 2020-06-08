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

// Route::get('/', function () {
//     return view('front.home.home');
// });
Route::get('/','FrontController@index')->name('home');
Route::get('/category','FrontController@Category')->name('category');
Route::get('/about','FrontController@About')->name('about');
Route::get('/contact','FrontController@Contact')->name('contact');
Route::get('/labour-by-category/{id}/{cat_name}','FrontController@LabourCategory')->name('LabourByCat');
Route::get('/labour-view','FrontController@AllLabour')->name('labours');
Route::get('/src','FrontController@SearchLabour');
Route::get('/hire/{id}','FrontController@Hirelabour')->name('hire');

Route::get('/client_signup','ClientController@index',)->name('client_signup');
Route::post('/signUp','ClientController@ClientSignup',)->name('signUp');
Route::get('/client_login','ClientController@ClientLogin',)->name('client_login');
Route::post('/loginPost','ClientController@ClientLoginPost',)->name('loginPost');
Route::get('/client_logout','ClientController@ClientLogout',)->name('client_logout');

Auth::routes();

Route::get('/main', 'HomeController@index')->name('main');
Route::get('/fatchType', 'HomeController@GetType')->name('fatchType');
Route::get('/fatchArea', 'HomeController@GetArea')->name('fatchArea');

Route::get('/{any}', function() { return view('admin.dashboard.home'); })->where('any', '(.*)');