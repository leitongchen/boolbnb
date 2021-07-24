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



// Messages
Route::get("/messages", "MessageController@index")->name("messages.index");

Route::get("/messages/create", "MessageController@create")->name("messages.create");

Route::get("/messages/{id}", "MessageController@show")->name("messages.show");

Route::post("/messages", "MessageController@store")->name("messages.store");

Route::delete("/messages/{id}", "MessageController@destroy")->name("messages.destroy");

