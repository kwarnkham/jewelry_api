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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/items', 'ItemController@index');
Route::post('/item', 'ItemController@store');

Route::get('/categories', 'CategoryController@index');
Route::post('/category', 'CategoryController@store');

Route::get('/jewelTypes', 'JewelTypeController@index');
Route::post('/jewelType', 'JewelTypeController@store');

Route::post('/usdFactor', 'UsdFactorController@store');
Route::get('/usdFactor', 'UsdFactorController@index');

Route::get('/itemImages', 'ItemImageController@index');
