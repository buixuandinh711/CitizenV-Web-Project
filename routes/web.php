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

Route::get('Login','App\Http\Controllers\UserController@ShowLogin');

Route::post('Login','App\Http\Controllers\UserController@CheckLogin');

Route::get('Main',function() {
    if (session('user')) {
        return view('Main');
    }
});

Route::get('Logout','App\Http\Controllers\UserController@Logout');

//User City

Route::get('AddUserCity','App\Http\Controllers\UserController@GetAddUserCity');

Route::post('AddUserCity','App\Http\Controllers\UserController@PostAddUserCity');

Route::get('ShowUserCity','App\Http\Controllers\UserController@ShowUserCity');

Route::get('DeleteUserCity/{username}','App\Http\Controllers\UserController@DeleteUSerCity');

Route::get('EditUserCity','App\Http\Controllers\UserController@GetEditUserCity');

Route::post('EditUserCity','App\Http\Controllers\UserController@PostEditUserCity');

//User District

Route::get('AddUserDistrict','App\Http\Controllers\UserController@GetAddUserDistrict');

Route::post('AddUserDistrict','App\Http\Controllers\UserController@PostAddUserDistrict');

Route::get('ShowUserDistrict','App\Http\Controllers\UserController@ShowUserDistrict');

Route::get('DeleteUserDistrict/{username}','App\Http\Controllers\UserController@DeleteUSerDistrict');

Route::get('EditUserDistrict','App\Http\Controllers\UserController@GetEditUserDistrict');

Route::post('EditUserDistrict','App\Http\Controllers\UserController@PostEditUserDistrict');

//User Ward

Route::get('AddUserWard','App\Http\Controllers\UserController@GetAddUserWard');

Route::post('AddUserWard','App\Http\Controllers\UserController@PostAddUserWard');

Route::get('ShowUserWard','App\Http\Controllers\UserController@ShowUserWard');

Route::get('DeleteUserWard/{username}','App\Http\Controllers\UserController@DeleteUSerWard');

Route::get('EditUserWard','App\Http\Controllers\UserController@GetEditUserWard');

Route::post('EditUserWard','App\Http\Controllers\UserController@PostEditUserWard');

//User Village

Route::get('AddUserVillage','App\Http\Controllers\UserController@GetAddUserVillage');

Route::post('AddUserVillage','App\Http\Controllers\UserController@PostAddUserVillage');

Route::get('ShowUserVillage','App\Http\Controllers\UserController@ShowUserVillage');

Route::get('DeleteUserVillage/{username}','App\Http\Controllers\UserController@DeleteUSerVillage');

Route::get('EditUserVillage','App\Http\Controllers\UserController@GetEditUserVillage');

Route::post('EditUserVillage','App\Http\Controllers\UserController@PostEditUserVillage');

//Declare City

Route::get('AddDeclareCity','App\Http\Controllers\CityController@GetAddDeclareCity');

Route::post('AddDeclareCity','App\Http\Controllers\CityController@PostAddDeclareCity');

Route::get('ShowDeclareCity','App\Http\Controllers\CityController@ShowDeclareCity');

Route::get('DeleteDeclareCity/{city_id}','App\Http\Controllers\CityController@DeleteDeclareCity');

Route::get('EditDeclareCity','App\Http\Controllers\CityController@GetEditDeclareCity');

Route::post('EditDeclareCity','App\Http\Controllers\CityController@PostEditDeclareCity');

//Declare District

Route::get('AddDeclareDistrict','App\Http\Controllers\DistrictController@GetAddDeclareDistrict');

Route::post('AddDeclareDistrict','App\Http\Controllers\DistrictController@PostAddDeclareDistrict');

Route::get('ShowDeclareDistrict','App\Http\Controllers\DistrictController@ShowDeclareDistrict');

Route::get('DeleteDeclareDistrict/{district_id}','App\Http\Controllers\DistrictController@DeleteDeclareDistrict');

Route::get('EditDeclareDistrict','App\Http\Controllers\DistrictController@GetEditDeclareDistrict');

Route::post('EditDeclareDistrict','App\Http\Controllers\DistrictController@PostEditDeclareDistrict');

//Declare Ward

Route::get('AddDeclareWard','App\Http\Controllers\WardController@GetAddDeclareWard');

Route::post('AddDeclareWard','App\Http\Controllers\WardController@PostAddDeclareWard');

Route::get('ShowDeclareWard','App\Http\Controllers\WardController@ShowDeclareWard');

Route::get('DeleteDeclareWard/{ward_id}','App\Http\Controllers\WardController@DeleteDeclareWard');

Route::get('EditDeclareWard','App\Http\Controllers\WardController@GetEditDeclareWard');

Route::post('EditDeclareWard','App\Http\Controllers\WardController@PostEditDeclareWard');

//Declare Village

Route::get('AddDeclareVillage','App\Http\Controllers\VillageController@GetAddDeclareVillage');

Route::post('AddDeclareVillage','App\Http\Controllers\VillageController@PostAddDeclareVillage');

Route::get('ShowDeclareVillage','App\Http\Controllers\VillageController@ShowDeclareVillage');

Route::get('DeleteDeclareVillage/{village_id}','App\Http\Controllers\VillageController@DeleteDeclareVillage');

Route::get('EditDeclareVillage','App\Http\Controllers\VillageController@GetEditDeclareVillage');

Route::post('EditDeclareVillage','App\Http\Controllers\VillageController@PostEditDeclareVillage');

//Declare Person

Route::get('AddDeclarePerson','App\Http\Controllers\PersonController@GetAddDeclarePerson');

Route::post('AddDeclarePerson','App\Http\Controllers\PersonController@PostAddDeclarePerson');

Route::get('ShowDeclarePerson','App\Http\Controllers\PersonController@ShowDeclarePerson');

Route::get('DeleteDeclarePerson/{person_id}','App\Http\Controllers\PersonController@DeleteDeclarePerson');

Route::get('EditDeclarePerson','App\Http\Controllers\PersonController@GetEditDeclarePerson');

Route::post('EditDeclarePerson','App\Http\Controllers\PersonController@PostEditDeclarePerson');

//Access City

Route::get('AddAccessCity','App\Http\Controllers\AccessController@GetAddAccessCity');

Route::post('AddAccessCity','App\Http\Controllers\AccessController@PostAddAccessCity');

Route::get('ShowAccessCity','App\Http\Controllers\AccessController@ShowAccessCity');

Route::get('DeleteAccessCity/{username}','App\Http\Controllers\AccessController@DeleteAccessCity');

Route::get('EditAccessCity','App\Http\Controllers\AccessController@GetEditAccessCity');

Route::post('EditAccessCity','App\Http\Controllers\AccessController@PostEditAccessCity');

//Access District

Route::get('AddAccessDistrict','App\Http\Controllers\AccessController@GetAddAccessDistrict');

Route::post('AddAccessDistrict','App\Http\Controllers\AccessController@PostAddAccessDistrict');

Route::get('ShowAccessDistrict','App\Http\Controllers\AccessController@ShowAccessDistrict');

Route::get('DeleteAccessDistrict/{username}','App\Http\Controllers\AccessController@DeleteAccessDistrict');

Route::get('EditAccessDistrict','App\Http\Controllers\AccessController@GetEditAccessDistrict');

Route::post('EditAccessDistrict','App\Http\Controllers\AccessController@PostEditAccessDistrict');

//Access Ward

Route::get('AddAccessWard','App\Http\Controllers\AccessController@GetAddAccessWard');

Route::post('AddAccessWard','App\Http\Controllers\AccessController@PostAddAccessWard');

Route::get('ShowAccessWard','App\Http\Controllers\AccessController@ShowAccessWard');

Route::get('DeleteAccessWard/{username}','App\Http\Controllers\AccessController@DeleteAccessWard');

Route::get('EditAccessWard','App\Http\Controllers\AccessController@GetEditAccessWard');

Route::post('EditAccessWard','App\Http\Controllers\AccessController@PostEditAccessWard');

//Access Village

Route::get('AddAccessVillage','App\Http\Controllers\AccessController@GetAddAccessVillage');

Route::post('AddAccessVillage','App\Http\Controllers\AccessController@PostAddAccessVillage');

Route::get('ShowAccessVillage','App\Http\Controllers\AccessController@ShowAccessVillage');

Route::get('DeleteAccessVillage/{username}','App\Http\Controllers\AccessController@DeleteAccessVillage');

Route::get('EditAccessVillage','App\Http\Controllers\AccessController@GetEditAccessVillage');

Route::post('EditAccessVillage','App\Http\Controllers\AccessController@PostEditAccessVillage');