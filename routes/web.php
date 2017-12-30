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
Route::get("/logout", "Auth\\LoginController@logout");
Route::get("/chat", "ChatController@index");
Route::get("/chat/{username}", "ChatController@to");
Route::get("/chat/{username}/get", "ChatController@get");
Route::post("/chat/{username}/post", "ChatController@post");
Route::get("/profile", "ProfileController@index");
Route::post("/profile/change_info", "ProfileController@changeInfo");
Route::get("/profile/change_photo", "ProfileController@changePhotoPage");
Route::post("/profile/change_photo", "ProfileController@changePhoto");
Route::post("/profile/change_password", "ProfileController@changePassword");
Route::get("/groupchat", "GroupChatController@index");
Route::get("/groupchat/{groupname}", "GroupChatController@to");
Route::get("/groupchat/{groupname}/get", "GroupChatController@get");
Route::post("/groupchat/{groupname}/post", "GroupChatController@post");