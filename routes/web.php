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

Route::get('declare-location','App\Http\Controllers\Controller@DeclareLocation');

Route::get('declare-account','App\Http\Controllers\Controller@DeclareAccount');

Route::get('grant-permission','App\Http\Controllers\Controller@GrantPermission');

Route::get('add-citizen','App\Http\Controllers\Controller@AddCitizen');

Route::get('list-citizen','App\Http\Controllers\Controller@ListCitizen');

Route::get('declare-status','App\Http\Controllers\Controller@DeclareStatus');

Route::get('citizen-info','App\Http\Controllers\Controller@CitizenInfo');

Route::get('info-citizen','App\Http\Controllers\Controller@InfoCitizen');

//Declare Location

Route::get('current-local-info','App\Http\Controllers\DeclareLocationController@CurrentLocalInfo');

Route::post('update-new-location','App\Http\Controllers\DeclareLocationController@UpdateNewLocation');

Route::post('edit-location','App\Http\Controllers\DeclareLocationController@EditLocation');

Route::post('delete-location','App\Http\Controllers\DeclareLocationController@DeleteLocation');

Route::get('get-city','App\Http\Controllers\DeclareLocationController@GetCity');

Route::post('get-district','App\Http\Controllers\DeclareLocationController@GetDistrict');

Route::post('get-ward','App\Http\Controllers\DeclareLocationController@GetWard');

Route::post('get-village','App\Http\Controllers\DeclareLocationController@GetVillage');

Route::get('get-location-info','App\Http\Controllers\DeclareLocationController@GetLocationInfo');

Route::get('get-location-chart','App\Http\Controllers\DeclareLocationController@GetLocationChart');

//User

Route::post('add-new-user','App\Http\Controllers\UserController@AddNewUser');

Route::get('account-location-info','App\Http\Controllers\UserController@AccountLocationInfo');

Route::post('edit-account','App\Http\Controllers\UserController@EditUser');

Route::post('delete-account','App\Http\Controllers\UserController@DeleteAccount');

//Access

Route::get('load-declared-permission','App\Http\Controllers\AccessController@LoadDeclaredPermission');

Route::post('submit-declared-permission','App\Http\Controllers\AccessController@SubmitDeclarePermission');

Route::get('declare-permission-location-info','App\Http\Controllers\AccessController@DeclarePermissionLocationInfo');

Route::post('edit-permission', 'App\Http\Controllers\AccessController@EditAccess');

Route::post('delete-permission', 'App\Http\Controllers\AccessController@DeletePermission');

Route::get('get-permission-location', 'App\Http\Controllers\AccessController@GetPermissionLocation');

//Declare Population

Route::post('submit-new-citizen', 'App\Http\Controllers\DeclarePopulationController@AddPerson');

Route::post('delete-person', 'App\Http\Controllers\DeclarePopulationController@DeletePerson');

Route::post('edit-person', 'App\Http\Controllers\DeclarePopulationController@EditPerson');

Route::get('get-declare-status', 'App\Http\Controllers\DeclarePopulationController@GetDeclareStatus');

Route::post('load-declared-citizen', 'App\Http\Controllers\DeclarePopulationController@ShowListPopulation');

Route::post('show-info-population', 'App\Http\Controllers\DeclarePopulationController@ShowInfoPopulation');

Route::get('change-complete-status', 'App\Http\Controllers\DeclarePopulationController@ChangeCompleteStatus');

Route::get('get-upper-location', 'App\Http\Controllers\DeclarePopulationController@GetUpperLocation');

Route::get('get-complete-status', 'App\Http\Controllers\DeclarePopulationController@GetCompleteStatus');

Route::post('check-citizen-info', 'App\Http\Controllers\DeclarePopulationController@CheckCitizenInfo');

Route::get('get-citizen-info', 'App\Http\Controllers\DeclarePopulationController@GetCitizenInfo');

Route::post('get-citizen-info', 'App\Http\Controllers\DeclarePopulationController@PostCitizenInfo');