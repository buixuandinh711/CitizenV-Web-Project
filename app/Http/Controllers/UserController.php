<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function AddNewUser(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['resp' => '']; 
                $username = $request->username;
                $password = $request->password;
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || $password == "" || strlen($username) != 2 || count($user) || !ctype_digit($username)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->insert(['username' => $username,'password' => $password]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {   
                $result = ['resp' => '']; 
                $username = session('user')->username.$request->username;
                $password = $request->password;
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || $password == "" || strlen($username) != 4 || count($user) || !ctype_digit($username) || 
                    !count($access_city)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->insert(['username' => $username,'password' => $password]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {   
                $result = ['resp' => '']; 
                $username = session('user')->username.$request->username;
                $password = $request->password;
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || $password == "" || strlen($username) != 6 || count($user) || !ctype_digit($username) || 
                    !count($access_city) || !count($access_district)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->insert(['username' => $username,'password' => $password]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {   
                $result = ['resp' => ''];  
                $username = session('user')->username.$request->username;
                $password = $request->password;
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || $password == "" || strlen($username) != 8 || count($user) || !ctype_digit($username) || 
                    !count($access_city) || !count($access_district) || !count($access_ward)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->insert(['username' => $username,'password' => $password]);
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function AccountLocationInfo() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['name' => 'cả nước', 'code' => 'admin', 'accountLocation' => [], 'noAccountLocation' => []];
                $userlocation = DB::table('city')
                ->leftjoin('users', 'city.city_id', '=', 'users.username')
                ->selectraw('city.city_id as code')
                ->selectraw('city.city_name as name')
                ->whereraw('users.username is not null')->get();
                $nouserlocation = DB::table('city')
                ->leftjoin('users', 'city.city_id', '=', 'users.username')
                ->selectraw('city.city_id as code')
                ->selectraw('city.city_name as name')
                ->whereraw('users.username is null')->get();
                $result['accountLocation'] = $userlocation;
                $result['noAccountLocation'] = $nouserlocation;
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = ['name' => '', 'code' => '', 'accountLocation' => [], 'noAccountLocation' => []];
                $city = DB::table('city')->where('city_id', session('user')->username)->first();
                $result['name'] = $city->city_name;
                $result['code'] = $city->city_id;
                $userlocation = DB::table('district')
                ->leftjoin('users', 'district.district_id', '=', 'users.username')
                ->selectraw('district.district_id as code')
                ->selectraw('district.district_name as name')
                ->whereraw('users.username is not null')
                ->where('city_id',session('user')->username)->get();
                $nouserlocation = DB::table('district')
                ->leftjoin('users', 'district.district_id', '=', 'users.username')
                ->selectraw('district.district_id as code')
                ->selectraw('district.district_name as name')
                ->whereraw('users.username is null')
                ->where('city_id',session('user')->username)->get();
                $result['accountLocation'] = $userlocation;
                foreach($result['accountLocation'] as $r) {
                    $r->code = substr($r->code,2,4);
                }
                $result['noAccountLocation'] = $nouserlocation;
                foreach($result['noAccountLocation'] as $r) {
                    $r->code = substr($r->code,2,4);
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = ['name' => '', 'code' => '', 'accountLocation' => [], 'noAccountLocation' => []];
                $district = DB::table('district')->where('district_id', session('user')->username)->first();
                $result['name'] = $district->district_name;
                $result['code'] = $district->district_id;
                $userlocation = DB::table('ward')
                ->leftjoin('users', 'ward.ward_id', '=', 'users.username')
                ->selectraw('ward.ward_id as code')
                ->selectraw('ward.ward_name as name')
                ->whereraw('users.username is not null')
                ->where('district_id',session('user')->username)->get();
                $nouserlocation = DB::table('ward')
                ->leftjoin('users', 'ward.ward_id', '=', 'users.username')
                ->selectraw('ward.ward_id as code')
                ->selectraw('ward.ward_name as name')
                ->whereraw('users.username is null')
                ->where('district_id',session('user')->username)->get();
                $result['accountLocation'] = $userlocation;
                foreach($result['accountLocation'] as $r) {
                    $r->code = substr($r->code,4,6);
                }
                $result['noAccountLocation'] = $nouserlocation;
                foreach($result['noAccountLocation'] as $r) {
                    $r->code = substr($r->code,4,6);
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = ['name' => '', 'code' => '', 'accountLocation' => [], 'noAccountLocation' => []];
                $ward = DB::table('ward')->where('ward_id', session('user')->username)->first();
                $result['name'] = $ward->ward_name;
                $result['code'] = $ward->ward_id;
                $userlocation = DB::table('village')
                ->leftjoin('users', 'village.village_id', '=', 'users.username')
                ->selectraw('village.village_id as code')
                ->selectraw('village.village_name as name')
                ->whereraw('users.username is not null')
                ->where('ward_id',session('user')->username)->get();
                $nouserlocation = DB::table('village')
                ->leftjoin('users', 'village.village_id', '=', 'users.username')
                ->selectraw('village.village_id as code')
                ->selectraw('village.village_name as name')
                ->whereraw('users.username is null')
                ->where('ward_id',session('user')->username)->get();
                $result['accountLocation'] = $userlocation;
                foreach($result['accountLocation'] as $r) {
                    $r->code = substr($r->code,6,8);
                }
                $result['noAccountLocation'] = $nouserlocation;
                foreach($result['noAccountLocation'] as $r) {
                    $r->code = substr($r->code,6,8);
                }
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function DeleteAccount(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['resp' => '']; 
                $username = $request->username;
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || strlen($username) != 2 || !count($user) || !ctype_digit($username)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->where('username', $username)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {   
                $result = ['resp' => ''];
                $username = session('user')->username.$request->username;
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || strlen($username) != 4 || !count($user) || !ctype_digit($username) || !count($access_city)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->where('username', $username)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {   
                $result = ['resp' => '']; 
                $username = session('user')->username.$request->username;
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || strlen($username) != 6 || !count($user) || !ctype_digit($username) || !count($access_city) || 
                    !count($access_district)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->where('username', $username)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {   
                $result = ['resp' => ''];
                $username = session('user')->username.$request->username;
                $user = DB::table('users')->where('username', $username)->get();
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                if ($username == "" || strlen($username) != 8 || !count($user) || !ctype_digit($username) || !count($access_city) || 
                    !count($access_district) || !count($access_ward)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->where('username', $username)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function EditUser(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['resp' => ''];
                $username = $request->username;
                $password = $request->password;
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || $password == "" || strlen($username) != 2 || !count($user) || !ctype_digit($username)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->where('username', $username)->update(['password' => $password]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {   
                $result = ['resp' => '']; 
                $username = session('user')->username.$request->username;
                $password = $request->password;
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || $password == "" || strlen($username) != 4 || !count($user) || !ctype_digit($username) || 
                    !count($access_city)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->where('username', $username)->update(['password' => $password]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {   
                $result = ['resp' => '']; 
                $username = session('user')->username.$request->username;
                $password = $request->password;
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || $password == "" || strlen($username) != 6 || !count($user) || !ctype_digit($username) || 
                    !count($access_city) || !count($access_district)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->where('username', $username)->update(['password' => $password]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {   
                $result = ['resp' => ''];
                $username = session('user')->username.$request->username;
                $password = $request->password;
                $user = DB::table('users')->where('username', $username)->get();
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                if ($username == "" || $password == "" || strlen($username) != 8 || !count($user) || !ctype_digit($username) || 
                    !count($access_city) || !count($access_district) || !count($access_ward)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('users')->where('username', $username)->update(['password' => $password]);
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function EditPassword(Request $request) {
        if (session('user')) {
            if ($request->password == '') {
                return response()->json(['resp' => 'error']);
            }
            DB::table('users')->where('username', session('user')->username)->update(['password' => $request->password]);
            return response()->json(['resp' => 'success']);
        }
        return response()->json(['resp' => 'error']);
    }
}