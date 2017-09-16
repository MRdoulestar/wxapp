<?php

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
//APP端
Route::match(["get","post"],"api/index","API\IndexController@index");
Route::post("api/login","API\UserController@login");
Route::group(["namespace"=>"API","prefix"=>"api","middleware"=>"tokenChk"],function(){
// Route::group(["namespace"=>"API","prefix"=>"api"],function(){
	// Route::get("/","IndexController@index");
	Route::post("logout","UserController@logout");
	Route::post("item/get","DataController@getItem");
	Route::post("item/search","DataController@searchItem");

	Route::post("useritem/pass","DataController@passItem");
	Route::post("useritem/nopass","DataController@noPassItem");
	Route::post("useritem/get","DataController@getUserItem");
	Route::post("useritem/search","DataController@searchUserItem");
});


//网页端
Route::get("/","Home\UserController@loginWeb")->name('loginweb');
Route::post("login","Home\UserController@login")->name('login');
Route::group(["namespace"=>"Home","middleware"=>"loginChk"],function(){
	//后台主页
	Route::get("index","DataController@index");
	Route::match(["post","get"],"logout","UserController@logout")->name('logout');
	//超级管理员页面
	Route::group(["middleware"=>"adminChk"],function(){
		Route::get("dataweb","DataController@dataweb");
		Route::get("excel/export","ExcelController@export");	//导出excel
		Route::get("userweb","UserController@getuser");
		Route::match(["post","get"],"useradd","UserController@adduser");
		Route::post("userdel","UserController@deluser");
	});
	//上传人员页面
	Route::get("commitweb","DataController@commitweb");
	Route::match(["post","get"],"nochkweb","DataController@nochkweb");
	Route::match(["post","get"],"historyweb","DataController@historyweb");
	Route::post("itemdel","DataController@delitem");
	Route::post("excel/import","ExcelController@import");	//导入excel
});

