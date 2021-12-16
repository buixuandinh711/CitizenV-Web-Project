<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                $currentTime = Carbon::now();
                $access_city = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
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
                $currentTime = Carbon::now();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_district = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                if (count($access_city) && count($access_district)) {
                    $result['resp'] = true;
                } else {
                    $result['resp'] = false;
                }
                $access = DB::table('access')->join('ward', 'ward.ward_id', '=', 'access.username')
                ->selectRaw('ward.ward_name AS location')->selectRaw('access.username AS user')
                ->selectRaw('access.start_date AS startDate')->selectRaw('access.end_date AS endDate')->
                where('district_id',session('user')->username)->get();
                $result['info'] = $access;
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = ['resp' => '', 'info' => []];
                $currentTime = Carbon::now();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_ward = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                if (count($access_city) && count($access_district) && count($access_ward)) {
                    $result['resp'] = true;
                } else {
                    $result['resp'] = false;
                }
                $access = DB::table('access')->join('village', 'village.village_id', '=', 'access.username')
                ->selectRaw('village.village_name AS location')->selectRaw('access.username AS user')
                ->selectRaw('access.start_date AS startDate')->selectRaw('access.end_date AS endDate')->
                where('ward_id',session('user')->username)->get();
                $result['info'] = $access;
                return response()->json($result);
            }
        }
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
                $currentTime = Carbon::now();
                $result = ['resp' => ''];
                $username = $request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $city_id = substr($username,0,2);
                $access = DB::table('access')->where('username', $username)->get();
                $access_city = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 4 || count($access) || 
                    !ctype_digit($username) || $city_id != session('user')->username || !count($access_city)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->insert(['username' => $username,'start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $result = ['resp' => ''];
                $username = $request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $district_id = substr($username,0,4);
                $access = DB::table('access')->where('username', $username)->get();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_district = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 6 || count($access) || 
                    !ctype_digit($username) || $district_id != session('user')->username || !count($access_city) || !count($access_district)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->insert(['username' => $username,'start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $result = ['resp' => ''];
                $username = $request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $ward_id = substr($username,0,6);
                $access = DB::table('access')->where('username', $username)->get();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_ward = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 8 || count($access) || 
                    !ctype_digit($username) || $ward_id != session('user')->username || !count($access_city) || !count($access_district) ||
                    !count($access_ward)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->insert(['username' => $username,'start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
    }

    public function DeleteAccess(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['resp' => ''];
                $access = DB::table('access')->where('username', $request->code)->get();
                if (!count($access)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $request->code)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = ['resp' => ''];
                $currentTime = Carbon::now();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access = DB::table('access')->where('username', $request->code)->get();
                if (!count($access_city) || !count($access)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $request->code)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access = DB::table('access')->where('username', $request->code)->get();
                if (!count($access_city) || !count($access_district) || !count($access)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $request->code)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_ward = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access = DB::table('access')->where('username', $request->code)->get();
                if (!count($access_city) || !count($access_district) || !count($access_ward) || !count($access)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $request->code)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
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
                $currentTime = Carbon::now();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $result = ['resp' => ''];
                $username = $request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $city_id = substr($username,0,2);
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 4 || !count($access) || 
                    !ctype_digit($username) || $city_id != session('user')->username || !count($access_city)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $username)
                ->update(['start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $result = ['resp' => ''];
                $username = $request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $district_id = substr($username,0,4);
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 6 || !count($access) || 
                    !ctype_digit($username) || $district_id != session('user')->username || !count($access_city) || !count($access_district)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('access')->where('username', $username)
                ->update(['start_date' => $start_date, 'end_date' => $end_date]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $access_ward = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
                ->where('end_date','>=',$currentTime)->get();
                $result = ['resp' => ''];
                $username = $request->code;
                $start_date = $request->startDate;
                $end_date = $request->endDate;
                $ward_id = substr($username,0,6);
                $access = DB::table('access')->where('username', $username)->get();
                if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 8 || !count($access) || 
                    !ctype_digit($username) || $ward_id != session('user')->username || !count($access_city) || !count($access_district) ||
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
    }
}