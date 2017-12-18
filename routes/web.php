<?php

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

Route::get('user', 'UserController@index');

Route::get('time', 'WorkingTimeController@index');
Route::post('time', 'WorkingTimeController@store');
Route::put('time/{id}', 'WorkingTimeController@update');

Route::get('/', function () {
    return view('welcome', ['team' => env('TEAM_NAME')]);
});
