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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'CustomerController@index');

Route::get('/customers/create','CustomerController@create');
Route::post('/customers','CustomerController@store');
Route::post('/customers/{id}/edit','CustomerController@edit');
Route::post('/customers/{id}/update','CustomerController@update');
Route::post('/customers/{id}','CustomerController@destroy');
