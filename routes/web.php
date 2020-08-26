<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/index', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::post('/users', 'UsersController@store');
Route::get('/users/delete/{user}', 'UsersController@destroy');
Route::get('users/{user}', 'UsersController@edit');
Route::put('/users/{user}', 'UsersController@update');

