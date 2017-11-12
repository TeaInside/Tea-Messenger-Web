<?php

use IceTea\Routing\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.
| This file will be loaded by \App\Providers\RouteServiceProvider.
*/

Route::get("/", function() {
	return view('welcome');
});

Route::get("/test", "TestController@index@");


Route::get("/profile/{user}", function($a){	
	/**
	 * http://localhost/profile/ammarfaizi2
	 */
	echo $a['user']; // ammarfaizi2
});


Route::get("/aaa", function () {
	return view("aaa");
});