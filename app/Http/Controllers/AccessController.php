<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessController extends Controller
{
    public function LoadDeclaredPermission() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['resp' => true, 'info' => []];
                $access = DB::table('access')->join('city', 'city.city_id', '=', 'access.username')
                ->selectRaw('city.city_name AS location')->selectRaw('access.username AS user')
                ->selectRaw('access.start_date AS startDate')->selectRaw('access.end_date AS endDate')->get();
                $result['info'] = $access;
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = ['resp' => '', 'info' => []];
                $access_city = DB::table('access')->where('username',session('user')->username)->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                if (count($access_city)) {
                    $result['resp'] = true;
                } else {
                    $result['resp'] = false;
                }
                $access = DB::table('access')->join('district', 'district.district_id', '=', 'access.username')
                ->selectRaw('district.district_name AS location')->selectRaw('access.username AS user')
                ->selectRaw('access.start_date AS startDate')->selectRaw('access.end_date AS endDate')->
                where('city_id',session('user')->username)->get();
                $result['info'] = $access;
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = ['resp' => '', 'info' => []];
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')->where('username',session('user')->username)->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                if (count($access_city) && count($access_district)) {
                    $result['resp'] = true;
                } else {
                    $result['resp'] = false;
                }
                $access = DB::table('access')->join('ward', 'ward.ward_id', '=', 'access.username')
                ->selectRaw('ward.ward_name AS location')->selectRaw('access.username AS user')
                ->selectRaw('access.start_date AS startDate')->selectRaw('access.end_date AS endDate')
                ->where('district_id',session('user')->username)->get();
                $result['info'] = $access;
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = ['resp' => '', 'info' => []];
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')->where('username',session('user')->username)->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                if (count($access_city) && count($access_district) && count($access_ward)) {
                    $result['resp'] = true;
                } else {
                    $result['resp'] = false;
                }
                $access = DB::table('access')->join('village', 'village.village_id', '=', 'access.username')
                ->selectRaw('village.village_name AS location')->selectRaw('access.username AS user')
                ->selectRaw('access.start_date AS startDate')->selectRaw('access.end_date AS endDate')
                ->where('ward_id',session('user')->username)->get();
                $result['info'] = $access;
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function SubmitDeclarePermission(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['resp' => ''];
                $username = $request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 2 || count($access) || 
                    !ctype_digit($username)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->insert(['username' => $username,'start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = ['resp' => ''];
                $username = session('user')->username.$request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $access = DB::table('access')->where('username', $username)->get();
                $access_city = DB::table('access')->where('username',session('user')->username)->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 4 || count($access) || 
                    !ctype_digit($username) || !count($access_city)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->insert(['username' => $username,'start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = ['resp' => ''];
                $username = session('user')->username.$request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $access = DB::table('access')->where('username', $username)->get();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')->where('username',session('user')->username)->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 6 || count($access) || 
                    !ctype_digit($username) || !count($access_city) || !count($access_district)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->insert(['username' => $username,'start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = ['resp' => ''];
                $username = session('user')->username.$request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $access = DB::table('access')->where('username', $username)->get();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')->where('username',session('user')->username)->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 8 || count($access) || 
                    !ctype_digit($username) || !count($access_city) || !count($access_district) ||
                    !count($access_ward)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->insert(['username' => $username,'start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function DeletePermission(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['resp' => ''];
                $username = $request->code;
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || strlen($username) != 2 || !count($access) || !ctype_digit($username)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $username)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $result = ['resp' => ''];
                $username = session('user')->username.$request->code;
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || strlen($username) != 4 || !count($access) || !ctype_digit($username) || !count($access_city)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $username)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $result = ['resp' => ''];
                $username = session('user')->username.$request->code;
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || strlen($username) != 6 || !count($access) || !ctype_digit($username) || !count($access_city) || !count($access_district)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $username)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')->where('username',session('user')->username)->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $result = ['resp' => ''];
                $username = session('user')->username.$request->code;
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || strlen($username) != 8 || !count($access) || !ctype_digit($username) || !count($access_city) || !count($access_district) || 
                !count($access_ward)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $username)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function EditAccess(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['resp' => ''];
                $username = $request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 2 || !count($access) || 
                    !ctype_digit($username)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $username)
                ->update(['start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $result = ['resp' => ''];
                $username = session('user')->username.$request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 4 || !count($access) || 
                    !ctype_digit($username) ||  !count($access_city)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $username)
                ->update(['start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $result = ['resp' => ''];
                $username = session('user')->username.$request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 6 || !count($access) || 
                    !ctype_digit($username) || !count($access_city) || !count($access_district)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $username)
                ->update(['start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')->where('username',session('user')->username)->whereRaw('start_date <= now()')->whereRaw('end_date >= now()')->get();
                $result = ['resp' => ''];
                $username = session('user')->username.$request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 8 || !count($access) || 
                    !ctype_digit($username) || !count($access_city) || !count($access_district) ||
                    !count($access_ward)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $username)
                ->update(['start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function DeclarePermissionLocationInfo() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['name' => 'cả nước', 'code' => 'admin', 'nonGrantedLocation' => []];
                $noaccesslocation = DB::table('city')->leftjoin('access', 'city.city_id', '=', 'access.username')->selectraw('city.city_id as code')
                ->selectraw('city.city_name as name')->whereraw('access.username is null')->get();
                $result['nonGrantedLocation'] = $noaccesslocation;
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = ['name' => '', 'code' => '', 'nonGrantedLocation' => []];
                $city = DB::table('city')->where('city_id', session('user')->username)->first();
                $result['name'] = $city->city_name;
                $result['code'] = $city->city_id;
                $noaccesslocation = DB::table('district')->leftjoin('access', 'district.district_id', '=', 'access.username')
                ->selectraw('district.district_id as code')->selectraw('district.district_name as name')
                ->whereraw('access.username is null')->where('city_id',session('user')->username)->get();
                $result['nonGrantedLocation'] = $noaccesslocation;
                foreach($result['nonGrantedLocation'] as $r) {
                    $r->code = substr($r->code,2,4);
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = ['name' => '', 'code' => '', 'nonGrantedLocation' => []];
                $district = DB::table('district')->where('district_id', session('user')->username)->first();
                $result['name'] = $district->district_name;
                $result['code'] = $district->district_id;
                $noaccesslocation = DB::table('ward')->leftjoin('access', 'ward.ward_id', '=', 'access.username')
                ->selectraw('ward.ward_id as code')->selectraw('ward.ward_name as name')
                ->whereraw('access.username is null')->where('district_id',session('user')->username)->get();
                $result['nonGrantedLocation'] = $noaccesslocation;
                foreach($result['nonGrantedLocation'] as $r) {
                    $r->code = substr($r->code,4,6);
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = ['name' => '', 'code' => '', 'nonGrantedLocation' => []];
                $ward = DB::table('ward')->where('ward_id', session('user')->username)->first();
                $result['name'] = $ward->ward_name;
                $result['code'] = $ward->ward_id;
                $noaccesslocation = DB::table('village')->leftjoin('access', 'village.village_id', '=', 'access.username')
                ->selectraw('village.village_id as code')->selectraw('village.village_name as name')
                ->whereraw('access.username is null')->where('ward_id',session('user')->username)->get();
                $result['nonGrantedLocation'] = $noaccesslocation;
                foreach($result['nonGrantedLocation'] as $r) {
                    $r->code = substr($r->code,6,8);
                }
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }
}