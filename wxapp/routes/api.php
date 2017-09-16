<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');
//APP端
// Route::get("index","API\IndexController@index");
// Route::post("login","API\UserController@login");
// Route::group(["namespace"=>"API","middleware"=>"tokenChk"],function(){
// // Route::group(["namespace"=>"API"],function(){
// 	// Route::get("/","IndexController@index");
// 	Route::post("logout","UserController@logout");
// 	Route::post("item/get","DataController@getItem");
// 	Route::post("item/search","DataController@searchItem");

// 	Route::post("useritem/pass","DataController@passItem");
// 	Route::post("useritem/nopass","DataController@noPassItem");
// 	Route::post("useritem/get","DataController@getUserItem");
// 	Route::post("useritem/search","DataController@searchUserItem");
// });