<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

Route::get('login','App\Http\Controllers\UserController@ShowLogin');

Route::post('login','App\Http\Controllers\UserController@CheckLogin');

Route::get('main',function() {
    if (session('user')) {
        return view('Main');
    }
});

Route::get('logout','App\Http\Controllers\UserController@Logout');

//User City

Route::get('addusercity','App\Http\Controllers\UserController@GetAddUserCity');

Route::post('addusercity','App\Http\Controllers\UserController@PostAddUserCity');

Route::get('showusercity','App\Http\Controllers\UserController@ShowUserCity');

Route::get('deleteusercity/{username}','App\Http\Controllers\UserController@DeleteUSerCity');

Route::get('editusercity','App\Http\Controllers\UserController@GetEditUserCity');

Route::post('editusercity','App\Http\Controllers\UserController@PostEditUserCity');

//User District

Route::get('adduserdistrict','App\Http\Controllers\UserController@GetAddUserDistrict');

Route::post('adduserdistrict','App\Http\Controllers\UserController@PostAddUserDistrict');

Route::get('showuserdistrict','App\Http\Controllers\UserController@ShowUserDistrict');

Route::get('deleteuserdistrict/{username}','App\Http\Controllers\UserController@DeleteUSerDistrict');

Route::get('edituserdistrict','App\Http\Controllers\UserController@GetEditUserDistrict');

Route::post('edituserdistrict','App\Http\Controllers\UserController@PostEditUserDistrict');

//User Ward

Route::get('adduserward','App\Http\Controllers\UserController@GetAddUserWard');

Route::post('adduserward','App\Http\Controllers\UserController@PostAddUserWard');

Route::get('showuserward','App\Http\Controllers\UserController@ShowUserWard');

Route::get('deleteuserward/{username}','App\Http\Controllers\UserController@DeleteUSerWard');

Route::get('edituserward','App\Http\Controllers\UserController@GetEditUserWard');

Route::post('edituserward','App\Http\Controllers\UserController@PostEditUserWard');

//User Village

Route::get('adduservillage','App\Http\Controllers\UserController@GetAddUserVillage');

Route::post('adduservillage','App\Http\Controllers\UserController@PostAddUserVillage');

Route::get('showuservillage','App\Http\Controllers\UserController@ShowUserVillage');

Route::get('deleteuservillage/{username}','App\Http\Controllers\UserController@DeleteUSerVillage');

Route::get('edituservillage','App\Http\Controllers\UserController@GetEditUserVillage');

Route::post('edituservillage','App\Http\Controllers\UserController@PostEditUserVillage');

//Declare City

Route::get('adddeclarecity','App\Http\Controllers\CityController@GetAddDeclareCity');

Route::post('adddeclarecity','App\Http\Controllers\CityController@PostAddDeclareCity');

Route::get('showdeclarecity','App\Http\Controllers\CityController@ShowDeclareCity');

Route::get('deletedeclarecity/{city_id}','App\Http\Controllers\CityController@DeleteDeclareCity');

Route::get('editdeclarecity','App\Http\Controllers\CityController@GetEditDeclareCity');

Route::post('editdeclarecity','App\Http\Controllers\CityController@PostEditDeclareCity');

//Declare District

Route::get('adddeclaredistrict','App\Http\Controllers\DistrictController@GetAddDeclareDistrict');

Route::post('adddeclaredistrict','App\Http\Controllers\DistrictController@PostAddDeclareDistrict');

Route::get('showdeclaredistrict','App\Http\Controllers\DistrictController@ShowDeclareDistrict');

Route::get('deletedeclaredistrict/{district_id}','App\Http\Controllers\DistrictController@DeleteDeclareDistrict');

Route::get('editdeclaredistrict','App\Http\Controllers\DistrictController@GetEditDeclareDistrict');

Route::post('editdeclaredistrict','App\Http\Controllers\DistrictController@PostEditDeclareDistrict');

//Declare Ward

Route::get('adddeclareward','App\Http\Controllers\WardController@GetAddDeclareWard');

Route::post('adddeclareward','App\Http\Controllers\WardController@PostAddDeclareWard');

Route::get('showdeclareward','App\Http\Controllers\WardController@ShowDeclareWard');

Route::get('deletedeclareward/{ward_id}','App\Http\Controllers\WardController@DeleteDeclareWard');

Route::get('editdeclareward','App\Http\Controllers\WardController@GetEditDeclareWard');

Route::post('editdeclareward','App\Http\Controllers\WardController@PostEditDeclareWard');

//Declare Village

Route::get('adddeclarevillage','App\Http\Controllers\VillageController@GetAddDeclareVillage');

Route::post('adddeclarevillage','App\Http\Controllers\VillageController@PostAddDeclareVillage');

Route::get('showdeclarevillage','App\Http\Controllers\VillageController@ShowDeclareVillage');

Route::get('deletedeclarevillage/{village_id}','App\Http\Controllers\VillageController@DeleteDeclareVillage');

Route::get('editdeclarevillage','App\Http\Controllers\VillageController@GetEditDeclareVillage');

Route::post('editdeclarevillage','App\Http\Controllers\VillageController@PostEditDeclareVillage');

//Declare Person

Route::get('adddeclareperson','App\Http\Controllers\PersonController@GetAddDeclarePerson');

Route::post('adddeclareperson','App\Http\Controllers\PersonController@PostAddDeclarePerson');

Route::get('showdeclareperson','App\Http\Controllers\PersonController@ShowDeclarePerson');

Route::get('deletedeclareperson/{person_id}','App\Http\Controllers\PersonController@DeleteDeclarePerson');

Route::get('editdeclareperson','App\Http\Controllers\PersonController@GetEditDeclarePerson');

Route::post('editdeclareperson','App\Http\Controllers\PersonController@PostEditDeclarePerson');

//Access City

Route::get('addaccesscity','App\Http\Controllers\AccessController@GetAddAccessCity');

Route::post('addaccesscity','App\Http\Controllers\AccessController@PostAddAccessCity');

Route::get('showaccesscity','App\Http\Controllers\AccessController@ShowAccessCity');

Route::get('deleteaccesscity/{username}','App\Http\Controllers\AccessController@DeleteAccessCity');

Route::get('editaccesscity','App\Http\Controllers\AccessController@GetEditAccessCity');

Route::post('editaccesscity','App\Http\Controllers\AccessController@PostEditAccessCity');

//Access District

Route::get('addaccessdistrict','App\Http\Controllers\AccessController@GetAddAccessDistrict');

Route::post('addaccessdistrict','App\Http\Controllers\AccessController@PostAddAccessDistrict');

Route::get('showaccessdistrict','App\Http\Controllers\AccessController@ShowAccessDistrict');

Route::get('deleteaccessdistrict/{username}','App\Http\Controllers\AccessController@DeleteAccessDistrict');

Route::get('editaccessdistrict','App\Http\Controllers\AccessController@GetEditAccessDistrict');

Route::post('editaccessdistrict','App\Http\Controllers\AccessController@PostEditAccessDistrict');

//Access Ward

Route::get('addaccessward','App\Http\Controllers\AccessController@GetAddAccessWard');

Route::post('addaccessward','App\Http\Controllers\AccessController@PostAddAccessWard');

Route::get('showaccessward','App\Http\Controllers\AccessController@ShowAccessWard');

Route::get('deleteaccessward/{username}','App\Http\Controllers\AccessController@DeleteAccessWard');

Route::get('editaccessward','App\Http\Controllers\AccessController@GetEditAccessWard');

Route::post('editaccessward','App\Http\Controllers\AccessController@PostEditAccessWard');

//Access Village

Route::get('addaccessvillage','App\Http\Controllers\AccessController@GetAddAccessVillage');

Route::post('addaccessvillage','App\Http\Controllers\AccessController@PostAddAccessVillage');

Route::get('showaccessvillage','App\Http\Controllers\AccessController@ShowAccessVillage');

Route::get('deleteaccessvillage/{username}','App\Http\Controllers\AccessController@DeleteAccessVillage');

Route::get('editaccessvillage','App\Http\Controllers\AccessController@GetEditAccessVillage');

Route::post('editaccessvillage','App\Http\Controllers\AccessController@PostEditAccessVillage');

//Person all

Route::get('showlistpersonall','App\Http\Controllers\PersonAreaController@ShowListPersonAll');
Route::get('showtotalpersonall','App\Http\Controllers\PersonAreaController@ShowTotalPersonAll');
Route::get('showinfopersonall','App\Http\Controllers\PersonAreaController@GetShowInfoPersonAll');
Route::post('showinfopersonall','App\Http\Controllers\PersonAreaController@PostShowInfoPersonAll');

//Person city

Route::get('showlistpersoncity','App\Http\Controllers\PersonAreaController@ShowListPersonCity');
Route::get('showtotalpersoncity','App\Http\Controllers\PersonAreaController@ShowTotalPersonCity');
Route::get('showinfopersoncity','App\Http\Controllers\PersonAreaController@GetShowInfoPersonCity');
Route::post('showinfopersoncity','App\Http\Controllers\PersonAreaController@PostShowInfoPersonCity');

//Person district

Route::get('showlistpersondistrict','App\Http\Controllers\PersonAreaController@ShowListPersonDistrict');
Route::get('showtotalpersondistrict','App\Http\Controllers\PersonAreaController@ShowTotalPersonDistrict');
Route::get('showinfopersondistrict','App\Http\Controllers\PersonAreaController@GetShowInfoPersonDistrict');
Route::post('showinfopersondistrict','App\Http\Controllers\PersonAreaController@PostShowInfoPersonDistrict');

//Person ward

Route::get('showlistpersonward','App\Http\Controllers\PersonAreaController@ShowListPersonWard');
Route::get('showtotalpersonward','App\Http\Controllers\PersonAreaController@ShowTotalPersonWard');
Route::get('showinfopersonward','App\Http\Controllers\PersonAreaController@GetShowInfoPersonWard');
Route::post('showinfopersonward','App\Http\Controllers\PersonAreaController@PostShowInfoPersonWard');

//Person Each City

Route::get('showtotalpersoneachcity','App\Http\Controllers\PersonEachAreaController@ShowTotalPersonEachCity');
Route::get('showlistpersoneachcity','App\Http\Controllers\PersonEachAreaController@GetShowListPersonEachCity');
Route::post('showlistpersoneachcity','App\Http\Controllers\PersonEachAreaController@PostShowListPersonEachCity');

//Person Each District

Route::get('showtotalpersoneachdistrict','App\Http\Controllers\PersonEachAreaController@ShowTotalPersonEachDistrict');
Route::get('showlistpersoneachdistrict','App\Http\Controllers\PersonEachAreaController@GetShowListPersonEachDistrict');
Route::post('showlistpersoneachdistrict','App\Http\Controllers\PersonEachAreaController@PostShowListPersonEachDistrict');

//Person Each Ward

Route::get('showtotalpersoneachward','App\Http\Controllers\PersonEachAreaController@ShowTotalPersonEachWard');
Route::get('showlistpersoneachward','App\Http\Controllers\PersonEachAreaController@GetShowListPersonEachWard');
Route::post('showlistpersoneachward','App\Http\Controllers\PersonEachAreaController@PostShowListPersonEachWard');

//Person Each Village

Route::get('showtotalpersoneachvillage','App\Http\Controllers\PersonEachAreaController@ShowTotalPersonEachVillage');
Route::get('showlistpersoneachvillage','App\Http\Controllers\PersonEachAreaController@GetShowListPersonEachVillage');
Route::post('showlistpersoneachvillage','App\Http\Controllers\PersonEachAreaController@PostShowListPersonEachVillage');