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
Route::get("/login", "Auth\\LoginController@indexLogin")->name('login');
Route::get("/register", "RegisterController@index")->name('register');
Route::post("/register", "RegisterController@action");
Route::get("/register/success", "RegisterController@success");
Route::get("/logout", "Auth\\LoginController@logout")->name('logout');
Route::get("/chat", "ChatController@index")->name('chat');
Route::get("/chat/{username}", "ChatController@to");
Route::get("/chat/{username}/get", "ChatController@get");
Route::post("/chat/{username}/post", "ChatController@post");
Route::get("/profile", "ProfileController@index")->name('profile');
Route::post("/profile/change_info", "ProfileController@changeInfo");
Route::get("/profile/change_photo", "ProfileController@changePhotoPage")->name('change_photo');
Route::post("/profile/change_photo", "ProfileController@changePhoto");
Route::post("/profile/change_password", "ProfileController@changePassword");
Route::get('/forgot-password', "ForgotPasswordController@index")->name('forgot-password');
Route::get("/groupchat", "GroupChatController@index")->name('group_chat');
Route::get("/groupchat/{groupname}", "GroupChatController@to");
Route::get("/groupchat/{groupname}/get", "GroupChatController@get");
Route::post("/groupchat/{groupname}/post", "GroupChatController@post");
Route::get("/test/{test_id}", function ($param) {
	return view("tests/{$param['test_id']}");
})->name('test');
Route::get("/test2/{abc}/{def}", function () {})->name('test2');
Route::get("/testa", ["uses"=>function(){}, "as"=>"testa"]);
