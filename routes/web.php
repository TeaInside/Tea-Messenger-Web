<?php

Route::get("/", ["use" => "IndexController@index", "as" => "index"]);
Route::post("/", ["use" => "IndexController@index", "as" => "index"]);


Route::group(["prefix" => "user", "middleware" => "auth"], function () {
	Route::group(["prefix" => "profile"], function () {
		Route::group(["prefix" => "settings"], function () {
			Route::get("name", "");
		});
	});
});
