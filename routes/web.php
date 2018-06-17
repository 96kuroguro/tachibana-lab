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

Route::get('/op', function () {
    return view('index');
});
Route::get('/', function () {
    return view('corp');
});

Route::get('/twitter', 'TwitterController@index');
Route::get('/wired', 'MediaController@index');

Route::get('/afteroffparty', 'AfterOffPartyController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
