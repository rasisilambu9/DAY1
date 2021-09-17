<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login','App\Http\Controllers\UserController@show');
Route::post('/login','App\Http\Controllers\UserController@login');
Route::get('/signup','App\Http\Controllers\RegisterController@show');
Route::post('/signup','App\Http\Controllers\RegisterController@insert');
Route::get('/logout','App\Http\Controllers\UserController@logout');