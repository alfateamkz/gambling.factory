<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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

Route::get('/','App\Http\Controllers\MainController@index')->name('index');
Route::get('/exchange', 'App\Http\Controllers\MainController@exchange')->name('exchange');
Route::get('/finance', 'App\Http\Controllers\MainController@finance')->name('finance');
Route::get('/main', 'App\Http\Controllers\MainController@main')->name('main');
Route::get('/platforms', 'App\Http\Controllers\MainController@platforms')->name('platforms');
Route::get('/settings', 'App\Http\Controllers\MainController@settings')->name('settings');
Route::get('/support', 'App\Http\Controllers\MainController@support')->name('support');
Route::get('/team', 'App\Http\Controllers\MainController@team')->name('team');
Route::get('/ticket', 'App\Http\Controllers\MainController@ticket')->name('ticket');
Route::get('/transfer', 'App\Http\Controllers\MainController@transfer')->name('transfer');
Route::get('/upbalance', 'App\Http\Controllers\MainController@upbalance')->name('upbalance');
Route::get('/updates', 'App\Http\Controllers\MainController@updates')->name('updates');
Route::get('/withdraw', 'App\Http\Controllers\MainController@withdraw')->name('withdraw');

Route::post('/','App\Http\Controllers\MainController@signup')->name('signup');
