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

Route::get('login','App\Http\Controllers\Controller@ShowLogin');

Route::post('login','App\Http\Controllers\Controller@CheckLogin');

Route::get('main','App\Http\Controllers\Controller@ShowMain');

Route::get('logout','App\Http\Controllers\Controller@Logout');

//Declare Location

Route::get('current-local-info','App\Http\Controllers\DeclareLocationController@CurrentLocalInfo');

Route::post('update-new-location','App\Http\Controllers\DeclareLocationController@UpdateNewLocation');

//User

Route::post('add-new-user','App\Http\Controllers\UserController@AddNewUser');

Route::get('account-location-info','App\Http\Controllers\UserController@AccountLocationInfo');

//Access

Route::get('load-declared-permission','App\Http\Controllers\AccessController@LoadDeclaredPermission');

Route::post('submit-declared-permission','App\Http\Controllers\AccessController@SubmitDeclarePermission');

Route::post('edit-access', 'App\Http\Controllers\AccessController@EditAccess');

Route::post('delete-access', 'App\Http\Controllers\AccessController@DeleteAccess');