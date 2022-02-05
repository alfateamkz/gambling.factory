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

Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    Route::get('/logout', 'App\Http\Controllers\MainController@logout')->name('logout');
    Route::get('/exchange', 'App\Http\Controllers\MainController@exchange')->name('exchange');
    Route::get('/finance', 'App\Http\Controllers\MainController@finance')->name('finance');
    Route::get('/main', 'App\Http\Controllers\MainController@main')->name('main');
    Route::get('/platforms', 'App\Http\Controllers\MainController@platforms')->name('platforms');
    Route::get('/settings', 'App\Http\Controllers\MainController@settings')->name('settings');
    Route::get('/support', 'App\Http\Controllers\MainController@support')->name('support');
    Route::get('/team', 'App\Http\Controllers\MainController@team')->name('team');
    Route::get('/ticket/{id}', 'App\Http\Controllers\MainController@ticket')->name('ticket');
    Route::post('/transfer', 'App\Http\Controllers\MainController@transfer')->name('transfer');
    Route::get('/upbalance', 'App\Http\Controllers\MainController@upbalance')->name('upbalance');
    Route::post('/upbalance', 'App\Http\Controllers\MainController@upbalance')->name('upbalance');
    Route::get('/updates', 'App\Http\Controllers\MainController@updates')->name('updates');
    Route::get('/withdraw', 'App\Http\Controllers\MainController@withdraw')->name('withdraw');
    Route::post('/withdraw', 'App\Http\Controllers\MainController@withdraw')->name('withdraw');
});


Route::post('/signup','App\Http\Controllers\MainController@signup')->name('signup');
Route::post('/login','App\Http\Controllers\MainController@login')->name('login');
Route::post('/changePassword','App\Http\Controllers\MainController@changePassword')->name('changePassword');
Route::post('/editUserInfo','App\Http\Controllers\MainController@editUserInfo')->name('editUserInfo');

Route::post('/supportCreateTicket','App\Http\Controllers\MainController@supportCreateTicket')
    ->name('supportCreateTicket');
Route::post('/ticketCreateMessage','App\Http\Controllers\MainController@ticketCreateMessage')
    ->name('ticketCreateMessage');


Route::post('/sellToken', 'App\Http\Controllers\MainController@sellToken')->name('sellToken');
Route::post('/buyToken', 'App\Http\Controllers\MainController@buyToken')->name('buyToken');
