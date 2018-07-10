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

Route::get('/ss', function () { return view('ss.index'); });
Route::get('/ss/layer_01', function () { return view('ss.01'); });
Route::get('/ss/layer_02', function () { return view('ss.02'); });
Route::get('/ss/layer_03', function () { return view('ss.03'); });
Route::get('/ss/layer_04', function () { return view('ss.04'); });
Route::get('/ss/layer_05', function () { return view('ss.05'); });
Route::get('/ss/layer_06', function () { return view('ss.06'); });
Route::get('/ss/layer_07', function () { return view('ss.07'); });
Route::get('/ss/layer_08', function () { return view('ss.08'); });
Route::get('/ss/layer_09', function () { return view('ss.09'); });
Route::get('/ss/layer_10', function () { return view('ss.10'); });
Route::get('/ss/layer_11', function () { return view('ss.11'); });
Route::get('/ss/layer_12', function () { return view('ss.12'); });
Route::get('/ss/layer_13', function () { return view('ss.13'); });

Route::get('/twitter', 'TwitterController@index');
Route::get('/wired', 'MediaController@index');

Route::get('/afteroffparty', 'AfterOffPartyController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
