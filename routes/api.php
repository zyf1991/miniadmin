<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Plan;
use App\Models\Custom;
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
Route::group(['middleware' => 'auth:api'], function() {

});

//获取计划
Route::get('plan', 'PlanController@index');
Route::get('plan/{id}', 'PlanController@show');
Route::post('plan', 'PlanController@store');
Route::put('plan/{id}', 'PlanController@update');
Route::delete('plan/{id}', 'PlanController@delete');


//用户计划
//Route::get('custom', 'CustomController@index');
Route::post('custom/get', 'CustomController@index');
Route::get('custom/{id}', 'CustomController@show');
Route::post('custom', 'CustomController@store');
Route::put('custom/{id}', 'CustomController@update');
Route::delete('custom/{id}', 'CustomController@delete');




//获取计划
Route::get('sign', 'SignController@index');
Route::get('sign/{id}', 'SignController@show');
Route::post('sign', 'SignController@store');
Route::put('sign/{id}', 'SignController@update');
Route::delete('sign/{id}', 'SignController@delete');


Route::get('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');
