<?php

use IceTea\Routing\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.
| This file will be loaded by \App\Providers\RouteServiceProvider.
*/

Route::get("/", "IndexController@index");
Route::post("/login", "Auth\\LoginController@action");
Route::get("/login", "Auth\\LoginController@indexLogin");

Route::get("/register", "RegisterController@index");
Route::post("/register", "RegisterController@action");

Route::get("/register/success", "RegisterController@success");
