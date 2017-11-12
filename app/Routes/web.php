<?php

/**
 * Pengaturan router.
 */

Route::get("/", "LoginController@index");
Route::get("/home", "HomeController@index");
Route::get("/register", "RegisterController@index");
<<<<<<< HEAD
Route::get("/forgot-password", "LoginController@forgot");
=======
Route::get("/forgotpassword", "LoginController@forgot");
Route::get("/main", "MainController@index");
>>>>>>> c8cad9148b2b822dfbf505370a4cbb3c3f691894
//Route::get("/login", "LoginController@index"); cukup 1 aja untuk ininya
// Route::get(
//     "/forgot-password",
//     function () {
//         echo "Under development";
//     }
// );





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
