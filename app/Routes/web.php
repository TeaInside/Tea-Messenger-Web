<?php

/**
 * Pengaturan router.
 */

Route::get("/", function(){
	return view("welcome", 
		[
			"title" => "Test"
		]
	);
});
Route::get("/home", "HomeController@index");
Route::get("/register", "RegisterController@index");
Route::get("/login", "LoginController@index");
Route::get("/forgot-password", function(){
	echo "Under development";
});





/*
Route::get("/test_closure", function(){
	echo "Test Closure sukses !";
});


Route::get("/users", function(){
	echo "Masukkan nama user !";
});

Route::get("/users/{nama_user}", function($par){
	var_dump($par);
});

Route::get("/test_model", "ContohController@testModel");
Route::get("/test_encryption", "ContohController@testEncrypt");
Route::get("/test_random_string", "ContohController@testRandomString");

*/