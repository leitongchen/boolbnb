<?php

use Illuminate\Support\Facades\Auth;
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

//Home public
Route::get('/', 'HomeController@index')->name("index");

Route::prefix('apartments')
    ->name('apartments.')
    ->group(function () {
        
    // Search 
    Route::get('/search', 'SearchPageController@index')->name('search'); 
    
    Route::get('/', 'ApartmentController@index')->name('index');
    Route::get('/{id}', 'ApartmentController@show')->name('show');

});

Auth::routes();


// Messages public
Route::get("/messages/create/{apartment}", "MessageController@create")->name("messages.create");
Route::get("/messages/{id}", "MessageController@show")->name("messages.show");
Route::post("/messages", "MessageController@store")->name("messages.store");

//Rotte admin
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        //home
        Route::get('/', 'HomeController@index')->name('home');

        //appartamenti admin
        Route::get('/apartments', 'ApartmentController@index')->name('apartments.index');
        Route::get('/apartments/create', 'ApartmentController@create')->name('apartments.create');
        Route::post('/apartments', 'ApartmentController@store')->name('apartments.store');
        Route::get('/apartments/{id}', 'ApartmentController@show')->name('apartments.show');
        Route::get('/apartments/{apartment}/edit', 'ApartmentController@edit')->name('apartments.edit');
        Route::put('/apartments/{apartment}/update', 'ApartmentController@update')->name('apartments.update');
        Route::delete('/apartments/{apartment}', 'ApartmentController@destroy')->name('apartments.destroy');

        //visits
        Route::get('/visits/{apartment}', 'VisitController@show')->name('visits.show');

        //messages
        Route::get('/messages/{apartment}', 'MessageController@index')->name('messages.index');
        Route::get('/messages/{message}/show', 'MessageController@show')->name('messages.show');
        Route::delete('/messages/{message}/destroy', 'MessageController@destroy')->name('messages.destroy');

    });
