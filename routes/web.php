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
//     return view('welcome');
// });

Auth::routes();
Route::get('/', 'MovieController@index');

Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');



//Route::get('/home', 'HomeController@index')->name('home');


Route::resource('movie','MovieController');
Route::get('/movie/search/{search}', 'MovieController@search');
Route::get('/movie/count/all', 'MovieController@count');
Route::put('/rate/{movie}/{rate}', 'MovieController@rate');
