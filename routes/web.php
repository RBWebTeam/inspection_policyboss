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

Route::get('vehicle-details','Vehicle_DetailsController@getVehicle_details');
Route::get('table-details','Vehicle_DetailsController@get_Vehicle_details');
Route::get('log-in','Vehicle_DetailsController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'Auth\LoginController@getLogin');

Route:: get('image-galary','imagegalaryController@imagegalary');
route::get('image-galary','imagegalaryController@get_Vehicle_details');