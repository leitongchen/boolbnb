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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/apartments', 'ApartmentController@index')->name('apartments.index');
Route::get('/apartments/{id}', 'ApartmentController@show')->name('apartments.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        Route::get('/apartments', 'ApartmentController@index')->name('apartments.index');
        Route::get('/apartments/create', 'ApartmentController@create')->name('apartments.create');
        Route::post('/apartments', 'ApartmentController@store')->name('apartments.store');
        Route::get('/apartments/{apartment}/edit', 'ApartmentController@edit')->name('apartments.edit');
        Route::put('/apartments/{apartment}/update', 'ApartmentController@update')->name('apartments.update');
    });
