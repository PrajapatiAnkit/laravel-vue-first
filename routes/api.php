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

Route::get('cache/clear', 'CommonController@cacheClear')->name('cacheClear');
/*
 |-------------------------------------------------------------------------------
 | Authenticates the user login
 |-------------------------------------------------------------------------------
 | URL:            /api/login
 | Controller:     AuthController@login
 | Method:         POST
 | Description:    Authenticates the user login
 */
Route::post('login','AuthController@login');
Route::post('logout','AuthController@logout');
Route::post('checktoken','AuthController@checkToken');

Route::group(['prefix' => 'users'],function (){
    Route::post('create','UserController@saveUser');
    Route::get('get','UserController@getUsers');
    Route::get('info/{userId}','UserController@getUserInfo');
    Route::post('delete','UserController@deleteUser');
});
