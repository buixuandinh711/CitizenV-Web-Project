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

//Declare Location

Route::get('current-local-info','App\Http\Controllers\DeclareLocationController@CurrentLocalInfo');

Route::post('update-new-location','App\Http\Controllers\DeclareLocationController@UpdateNewLocation');

Route::post('edit-location','App\Http\Controllers\DeclareLocationController@EditLocation');

Route::post('delete-location','App\Http\Controllers\DeclareLocationController@DeleteLocation');

Route::get('get-city','App\Http\Controllers\DeclareLocationController@GetCity');

Route::post('get-district','App\Http\Controllers\DeclareLocationController@GetDistrict');

Route::post('get-ward','App\Http\Controllers\DeclareLocationController@GetWard');

Route::post('get-village','App\Http\Controllers\DeclareLocationController@GetVillage');

//User

Route::post('add-new-user','App\Http\Controllers\UserController@AddNewUser');

Route::get('account-location-info','App\Http\Controllers\UserController@AccountLocationInfo');

Route::post('edit-user','App\Http\Controllers\UserController@EditUser');

Route::post('delete-account','App\Http\Controllers\UserController@DeleteAccount');

//Access

Route::get('load-declared-permission','App\Http\Controllers\AccessController@LoadDeclaredPermission');

Route::post('submit-declared-permission','App\Http\Controllers\AccessController@SubmitDeclarePermission');

Route::get('declare-permission-location-info','App\Http\Controllers\AccessController@DeclarePermissionLocationInfo');

Route::post('edit-access', 'App\Http\Controllers\AccessController@EditAccess');

Route::post('delete-permission', 'App\Http\Controllers\AccessController@DeletePermission');

//Declare Population

Route::post('submit-new-citizen', 'App\Http\Controllers\DeclarePopulationController@AddPerson');

Route::post('delete-person', 'App\Http\Controllers\DeclarePopulationController@DeletePerson');

Route::post('edit-person', 'App\Http\Controllers\DeclarePopulationController@EditPerson');

Route::get('follow-declare-population', 'App\Http\Controllers\DeclarePopulationController@FollowDeclarePopulation');

Route::get('show-list-population', 'App\Http\Controllers\DeclarePopulationController@ShowListPopulation');

Route::get('show-total-population', 'App\Http\Controllers\DeclarePopulationController@ShowTotalPopulation');

Route::post('show-info-population', 'App\Http\Controllers\DeclarePopulationController@ShowInfoPopulation');

Route::get('show-total-population-each-city', 'App\Http\Controllers\DeclarePopulationController@ShowTotalPopulationEachCity');

Route::get('show-total-population-each-district', 'App\Http\Controllers\DeclarePopulationController@ShowTotalPopulationEachDistrict');

Route::get('show-total-population-each-ward', 'App\Http\Controllers\DeclarePopulationController@ShowTotalPopulationEachWard');

Route::get('show-total-population-each-village', 'App\Http\Controllers\DeclarePopulationController@ShowTotalPopulationEachVillage');

Route::post('show-list-population-each-city', 'App\Http\Controllers\DeclarePopulationController@ShowListPopulationEachCity');

Route::post('show-list-population-each-district', 'App\Http\Controllers\DeclarePopulationController@ShowListPopulationEachDistrict');

Route::post('show-list-population-each-ward', 'App\Http\Controllers\DeclarePopulationController@ShowListPopulationEachWard');

Route::post('show-list-population-each-village', 'App\Http\Controllers\DeclarePopulationController@ShowListPopulationEachVillage');
