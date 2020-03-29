<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/get/cpus', 'BuilderController@getCPUs');
Route::post('/get/mains', 'BuilderController@getMAINs');
Route::post('/get/rams', 'BuilderController@getRAMs');
Route::post('/get/vgas', 'BuilderController@getVGAs');
Route::post('/get/psus', 'BuilderController@getPSUs');
Route::post('/get/hdds', 'HDDController@getHDDs');
Route::post('/get/ssds', 'SSDController@getSSDs');
Route::post('/get/cases', 'CASEController@getCASEs');
Route::post('/user/login', 'LoginController@Login');
Route::post('/user/create','LoginController@CreateUser');
Route::post('/get/cart', 'BuilderController@getCart');
Route::post('/get/pc', 'RecommendPCController@getRecommendPC');
