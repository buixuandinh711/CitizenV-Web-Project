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

Route::post('edit-location','App\Http\Controllers\DeclareLocationController@EditLocation');

Route::post('delete-location','App\Http\Controllers\DeclareLocationController@DeleteLocation');

//User

Route::post('add-new-user','App\Http\Controllers\UserController@AddNewUser');

Route::get('account-location-info','App\Http\Controllers\UserController@AccountLocationInfo');

Route::post('edit-user','App\Http\Controllers\UserController@EditUser');

Route::post('delete-user','App\Http\Controllers\UserController@DeleteUser');

//Access

Route::get('load-declared-permission','App\Http\Controllers\AccessController@LoadDeclaredPermission');

Route::post('submit-declared-permission','App\Http\Controllers\AccessController@SubmitDeclarePermission');

Route::get('declare-permission-location-info','App\Http\Controllers\AccessController@DeclarePermissionLocationInfo');

Route::post('edit-access', 'App\Http\Controllers\AccessController@EditAccess');

Route::post('delete-access', 'App\Http\Controllers\AccessController@DeleteAccess');

//Declare Population

Route::post('add-person', 'App\Http\Controllers\DeclarePopulationController@AddPerson');

Route::post('delete-person', 'App\Http\Controllers\DeclarePopulationController@DeletePerson');

Route::post('edit-person', 'App\Http\Controllers\DeclarePopulationController@EditPerson');

Route::get('follow-declare-population', 'App\Http\Controllers\DeclarePopulationController@FollowDeclarePopulation');