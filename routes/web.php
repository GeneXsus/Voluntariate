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
Route::get('privacidad', function (){ return   view('legal.privacidad');})->name('legal.privacidad');
Route::get('cookies', function (){ return   view('legal.cookies');})->name('legal.cookies');
Route::get('aviso', function (){ return   view('legal.avisoLegal');})->name('legal.avisoLegal');




    //offers
    Route::get('/offers', 'OfferController@index')->name('offers.index')->middleware('verified');
    Route::post('/offers', 'OfferController@store')->name('offers.store')->middleware('verified');
    Route::get('/offers/create', 'OfferController@create')->name('offers.create')->middleware('verified');
    Route::get('/offers/{offer}', 'OfferController@show')->name('offers.show')->middleware('verified');
    Route::get('/offers/{offer}/edit', 'OfferController@edit')->name('offers.edit')->middleware('verified');
    Route::get('/offers/chat/{chat_id}/{user}/{offer}', 'OfferController@chat')->name('offers.chat')->middleware('verified');
    Route::put('/offers/{offer}', 'OfferController@update')->name('offers.update')->middleware('verified');
    Route::post('/offers/{offer}/toogle', 'OfferController@toogle')->name('offers.toogle')->middleware('verified');
    Route::post('/offers/{offer}/subscribe', 'OfferController@subscribeUser')->name('offers.subscribe')->middleware('verified');
    Route::post('/offers/{offer}/unsubscribe', 'OfferController@unsubscribeUser')->name('offers.unsubscribe')->middleware('verified');
    Route::post('/offers/{offer}/{user}/accept', 'OfferController@accept')->name('offers.accept')->middleware('verified');
    Route::post('/offers/{offer}/{user}/refuse', 'OfferController@refuse')->name('offers.refuse')->middleware('verified');
    Route::delete('/offers/{offer}', 'OfferController@destroy')->name('offers.delete')->middleware('verified');

    //type
    Route::get('/types', 'TypeController@index')->name('types.index')->middleware('verified');
    Route::post('/types', 'TypeController@store')->name('types.store')->middleware('verified');
    Route::get('/types/create', 'TypeController@create')->name('types.create')->middleware('verified');
    Route::get('/types/{type}', 'TypeController@show')->name('types.show')->middleware('verified');
    Route::get('/types/{type}/edit', 'TypeController@edit')->name('types.edit')->middleware('verified');
    Route::put('/types/{type}', 'TypeController@update')->name('types.update')->middleware('verified');
    Route::delete('/types/{type}', 'TypeController@destroy')->name('types.delete')->middleware('verified');

    //user
    Route::get('/users', 'UserController@index')->name('users.index')->middleware('verified');
    Route::get('/users/editSelf', 'UserController@editSelf')->name('users.editSelf')->middleware('verified');
    Route::put('/users/editSelf/update', 'UserController@updateSelf')->name('users.updateSelf')->middleware('verified');
    Route::post('/users', 'UserController@store')->name('users.store')->middleware('verified');
    Route::get('/users/create', 'UserController@create')->name('users.create')->middleware('verified');
    Route::get('/users/{user}', 'UserController@show')->name('users.show')->middleware('verified');
    Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('verified');
    Route::put('/users/{user}', 'UserController@update')->name('users.update')->middleware('verified');
    Route::delete('/users/{user}', 'UserController@destroy')->name('users.delete')->middleware('verified');

    Route::post('/ratings', 'RatingController@store')->name('ratings.store')->middleware('verified');
    Route::delete('/ratings', 'RatingController@destroy')->name('ratings.delete')->middleware('verified');

    Route::get('/messages/{offer_id}/{chat_id}', 'ChatsController@fetchMessages')->middleware('verified');
    Route::post('/messages/{offer_id}/{chat_id}', 'ChatsController@sendMessage')->middleware('verified');


Route::get('lang/{lang}', 'LanguageController@swap')->name('lang.swap');




