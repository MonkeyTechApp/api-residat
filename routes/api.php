<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::group(['middleware' => 'auth:sanctum'], function (){

    Route::post("country", 'App\Http\Controllers\CountryController@store');
    Route::get('country/{id}','App\Http\Controllers\CountryController@show');
    Route::get('country','App\Http\Controllers\CountryController@index');
    Route::put('country/{id}','App\Http\Controllers\CountryController@update');
    Route::delete('country/{id}','App\Http\Controllers\CountryController@destroy');


    Route::post("region", 'App\Http\Controllers\RegionController@store');
    Route::get('region/{id}','App\Http\Controllers\RegionController@show');
    Route::get('region','App\Http\Controllers\RegionController@index');
    Route::put('region/{id}','App\Http\Controllers\RegionController@update');
    Route::delete('region/{id}','App\Http\Controllers\RegionController@destroy');

    Route::post("adminZone", 'App\Http\Controllers\AdministrativeZoneController@store');
    Route::get('adminZone/{id}','App\Http\Controllers\AdministrativeZoneController@show');
    Route::get('adminZone','App\Http\Controllers\AdministrativeZoneController@index');
    Route::put('adminZone/{id}','App\Http\Controllers\AdministrativeZoneController@update');
    Route::delete('adminZone/{id}','App\Http\Controllers\AdministrativeZoneController@destroy');
});

Route::get('testing/{mytest}','App\Http\Controllers\TestController@index');

Route::post("login", 'App\Http\Controllers\UserController@index');




