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
Route::get('/get/cpus', 'BuilderController@getCPUs');
Route::get('/get/mains', 'BuilderController@getMAINs');
Route::get('/get/rams', 'BuilderController@getRAMs');
Route::get('/get/vgas', 'BuilderController@getVGAs');
Route::get('/get/psus', 'BuilderController@getPSUs');
Route::get('/get/hdds', 'HDDController@getHDDs');
Route::get('/get/ssds', 'SSDController@getSSDs');
Route::get('/get/cases', 'CASEController@getCASEs');
Route::post('/user/login', 'LoginController@Login');
Route::post('/user/create','LoginController@CreateUser');
