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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function () {
    Route::get('/offers', 'OfferController@index')->name('offers.index');
    Route::post('/offers', 'OfferController@store')->name('offers.store');
    Route::get('/offers/create', 'OfferController@create')->name('offers.create');
    Route::get('/offers/{offer}', 'OfferController@show')->name('offers.show');
    Route::get('/offers/{offer}/edit', 'OfferController@edit')->name('offers.edit');
    Route::put('/offers/{offer}', 'OfferController@update')->name('offers.update');
    Route::post('/offers/{offer}/toogle', 'OfferController@toogle')->name('offers.toogle');


    Route::get('/chat', 'ChatsController@index');
    Route::get('messages', 'ChatsController@fetchMessages');
    Route::post('messages', 'ChatsController@sendMessage');
});

Route::get('lang/{lang}', 'LanguageController@swap')->name('lang.swap');



