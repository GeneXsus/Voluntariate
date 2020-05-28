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


Route::middleware(['verified'])->group(function () {

    //offers
    Route::get('/offers', 'OfferController@index')->name('offers.index');
    Route::post('/offers', 'OfferController@store')->name('offers.store');
    Route::get('/offers/create', 'OfferController@create')->name('offers.create');
    Route::get('/offers/{offer}', 'OfferController@show')->name('offers.show');
    Route::get('/offers/{offer}/edit', 'OfferController@edit')->name('offers.edit');
    Route::put('/offers/{offer}', 'OfferController@update')->name('offers.update');
    Route::post('/offers/{offer}/toogle', 'OfferController@toogle')->name('offers.toogle');
    Route::post('/offers/{offer}/subscribe', 'OfferController@subscribeUser')->name('offers.subscribe');
    Route::post('/offers/{offer}/unsubscribe', 'OfferController@unsubscribeUser')->name('offers.unsubscribe');
    Route::post('/offers/{offer}/{user}/accept', 'OfferController@accept')->name('offers.accept');
    Route::post('/offers/{offer}/{user}/refuse', 'OfferController@refuse')->name('offers.refuse');
    Route::delete('/offers/{offer}', 'OfferController@destroy')->name('offers.delete');

    //type
    Route::get('/types', 'TypeController@index')->name('types.index');
    Route::post('/types', 'TypeController@store')->name('types.store');
    Route::get('/types/create', 'TypeController@create')->name('types.create');
    Route::get('/types/{type}', 'TypeController@show')->name('types.show');
    Route::get('/types/{type}/edit', 'TypeController@edit')->name('types.edit');
    Route::put('/types/{type}', 'TypeController@update')->name('types.update');
    Route::delete('/types/{type}', 'TypeController@destroy')->name('types.delete');

    //user
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/editSelf', 'UserController@editSelf')->name('users.editSelf');
    Route::put('/users/editSelf/update', 'UserController@updateSelf')->name('users.updateSelf');
    Route::post('/users', 'UserController@store')->name('users.store');
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::get('/users/{user}', 'UserController@show')->name('users.show');
    Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::put('/users/{user}', 'UserController@update')->name('users.update');
    Route::delete('/users/{user}', 'UserController@destroy')->name('users.delete');

    Route::post('/ratings', 'RatingController@store')->name('ratings.store');
    Route::delete('/ratings', 'RatingController@destroy')->name('ratings.delete');

    Route::get('/chat', 'ChatsController@index');
    Route::get('messages', 'ChatsController@fetchMessages');
    Route::post('messages', 'ChatsController@sendMessage');
});

Route::get('lang/{lang}', 'LanguageController@swap')->name('lang.swap');




