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

// questa route porta alla Homepage
Route::get('/', function () {
    return view('homepage');
});

// routes di default per le autenticazioni
Auth::routes();

// route per le autenticazioni degli utenti
Route::get('/upr', 'HomeController@index')->name('upr.home');

// routes per gli utenti registrati (upr)
Route::prefix('upr')
    ->namespace('Upr')
    ->middleware('auth')
    ->name('upr.')
    ->group(function () {
      Route::resource('apartments', 'ApartmentController');
      Route::resource('messages', 'MessageController')->except('store');
    });

// routes per gli utenti non registrati
Route::resource('apartments','ApartmentController')->only('index','show');
Route::post('/apartments/{aparment}', 'MessageController@store')->name('message.store');
Route::get('/search','ApartmentController@search')->name('search');
