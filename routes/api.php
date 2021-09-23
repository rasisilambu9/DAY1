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
// SELLER ROUTES



Route::get('/', function () {
    return view('welcome');
});


// SELLER ROUTES

Route::group(['prefix' => 'seller'], function () {

    Route::get('login', [ 'as' => 'login', 'uses' => 'App\Http\Controllers\UserControllerUserController@show']);
    Route::post('login','App\Http\Controllers\UserController@apilogin');
    Route::middleware('auth:sanctum')->get('user', function (Request $request) {    return $request->user(); });
    Route::middleware('auth:sanctum')->post('addproducts', 'App\Http\Controllers\ProductsController@add');
    Route::post('signup','App\Http\Controllers\RegisterController@apiinsert');
    Route::middleware('auth:sanctum')->post('logout','App\Http\Controllers\UserController@logout');

});

// ADMIN ROUTES

Route::group(['prefix' => 'admin'], function () {

    Route::post('/login','App\Http\Controllers\AdminController@apilogin');
    Route::middleware('auth:sanctum')->get('user', function (Request $request) {   return $request->user();  });
    Route::middleware('auth:sanctum')->get('products_view','App\Http\Controllers\AdminController@showproducts');
    Route::middleware('auth:sanctum')->post('approve/{id}','App\Http\Controllers\AdminController@approveproducts');
    Route::middleware('auth:sanctum')->post('logout','App\Http\Controllers\AdminController@logout');

});


// CUSTOMER ROUTES

Route::group(['prefix' => 'customer'], function () {
    
    Route::post('login','App\Http\Controllers\CustomerController@apilogin');
    Route::post('signup','App\Http\Controllers\CustomerController@apiinsert');
    Route::middleware('auth:sanctum')->get('user', function (Request $request) {  return $request->user();   });
    Route::middleware('auth:sanctum')->get('products_view','App\Http\Controllers\CustomerController@showproducts');
    Route::middleware('auth:sanctum')->post('purchase/{id}','App\Http\Controllers\CustomerController@purchase');
    Route::middleware('auth:sanctum')->post('logout','App\Http\Controllers\CustomerController@logout');
    
});

