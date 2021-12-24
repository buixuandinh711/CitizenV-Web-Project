<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeclareLocationController extends Controller
{
    public function CurrentLocalInfo () {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $city = DB::table('city')->selectRaw('city_id as code')->selectRaw('city_name as name')->get();
                $data = ['local' => 'cả nước', 'declared' => []];
                $data['declared'] = $city;
                return response()->json($data);
            } else if (strlen(session('user')->username) == 2) {
                $district = DB::table('district')
                ->Where('city_id',session('user')->username)
                ->selectRaw('district_id as code')
                ->selectRaw('district_name as name')->get();
                $city = DB::table('city')->Where('city_id', session('user')->username)->first();
                $data = ['local' => '', 'declared' => []];
                $data['local'] = $city->city_name;
                $data['declared'] = $district;
                foreach($data['declared'] as $d)
                    $d->code = substr($d->code,2,4);
                return response()->json($data);
            } else if (strlen(session('user')->username) == 4) {
                $ward = DB::table('ward')
                ->Where('district_id', session('user')->username)
                ->selectRaw('ward_id as code')
                ->selectRaw('ward_name as name')->get();
                $district = DB::table('district')->Where('district_id', session('user')->username)->first();
                $data = ['local' => '', 'declared' => []];
                $data['local'] = $district->district_name;
                $data['declared'] = $ward;
                foreach($data['declared'] as $d)
                    $d->code = substr($d->code,4,6);
                return response()->json($data);
            } else if (strlen(session('user')->username) == 6) {
                $village = DB::table('village')
                ->Where('ward_id', session('user')->username)
                ->selectRaw('village_id as code')
                ->selectRaw('village_name as name')->get();
                $ward = DB::table('ward')->Where('ward_id', session('user')->username)->first();
                $data = ['local' => '', 'declared' => []];
                $data['local'] = $ward->ward_name;
                $data['declared'] = $village;
                foreach($data['declared'] as $d)
                    $d->code = substr($d->code,6,8);
                return response()->json($data);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function UpdateNewLocation(Request $request) {
        if (session('user')) {
            if (session('user')->username == "admin") {
                $result = ['resp' => ''];
                $city_id = $request->code;
                $city_name = $request->name;
                $city = DB::table('city')->where('city_id', $city_id)->get();
                if (count($city) || $city_id == "" || $city_name == "" || strlen($city_id) != 2 || !ctype_digit($city_id)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('city')->insert(['city_id' => $city_id,'city_name' => $city_name]);  
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = ['resp' => ''];
                $district_id = session('user')->username.$request->code;
                $district_name = $request->name;
                $district = DB::table('district')->where('district_id', $district_id)->get();
                $access_city = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                if (count($district) || $district_id == "" || $district_name == "" || strlen($district_id) != 4 || 
                    !ctype_digit($district_id) || !count($access_city)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('district')
                ->insert(['city_id' => session('user')->username,'district_id' => $district_id,'district_name' => $district_name]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = ['resp' => '']; 
                $ward_id = session('user')->username.$request->code;
                $ward_name = $request->name;
                $ward = DB::table('ward')->where('ward_id', $ward_id)->get();
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                if (count($ward) || $ward_id == "" || $ward_name == "" || strlen($ward_id) != 6 || !ctype_digit($ward_id) || 
                    !count($access_city) || !count($access_district)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('ward')->insert(['district_id' => session('user')->username, 'ward_id' => $ward_id,'ward_name' => $ward_name,
                    'complete' => 0]);
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = ['resp' => ''];
                $village_id = session('user')->username.$request->code;
                $village_name = $request->name;
                $village = DB::table('village')->where('village_id', $village_id)->get();
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
                if (count($village) || $village_id == "" || $village_name == "" || strlen($village_id) != 8 || 
                    !ctype_digit($village_id) || !count($access_city) || !count($access_district) || !count($access_ward)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                } 
                DB::table('village')
                ->insert(['ward_id' => session('user')->username,'village_id' => $village_id, 'village_name' => $village_name, 
                    'complete' => 0]);
                $result['resp'] = 'success';
                return response()->json($result);
            }
        } 
        return response()->json(['resp' => 'error']);
    }

    public function DeleteLocation(Request $request) {
        if (session('user')) {
            if (session('user')->username == "admin") {
                $result = ['resp' => '']; 
                $city_id = $request->code;
                $city = DB::table('city')->where('city_id', $city_id)->get();
                if (!count($city) || $city_id == "" || strlen($city_id) != 2 || !ctype_digit($city_id)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('city')->where('city_id',$city_id)->delete();  
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = ['resp' => '']; 
                $district_id = session('user')->username.$request->code;
                $district = DB::table('district')->where('district_id', $district_id)->get();
                $access_city = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                if (!count($district) || $district_id == "" || strlen($district_id) != 4 || !ctype_digit($district_id) ||
                    !count($access_city)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('district')->where('district_id',$district_id)->delete();  
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = ['resp' => '']; 
                $ward_id = session('user')->username.$request->code;
                $ward = DB::table('ward')->where('ward_id', $ward_id)->get();
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                if (!count($ward) || $ward_id == "" || strlen($ward_id) != 6 || !ctype_digit($ward_id) || !count($access_city) || 
                    !count($access_district)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('ward')->where('ward_id',$ward_id)->delete();  
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = ['resp' => ''];
                $village_id = session('user')->username.$request->code;
                $village = DB::table('village')->where('village_id', $village_id)->get();
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
                if (!count($village) || $village_id == "" || strlen($village_id) != 8 || !ctype_digit($village_id) || 
                    !count($access_city) || !count($access_district) || !count($access_ward)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                } 
                DB::table('village')->where('village_id',$village_id)->delete();  
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function EditLocation(Request $request) {
        if (session('user')) {
            if (session('user')->username == "admin") {
                $result = ['resp' => ''];
                $city_id = $request->code;
                $city_name = $request->name;
                $city = DB::table('city')->where('city_id', $city_id)->get();
                if (!count($city) || $city_id == "" || $city_name == "" || strlen($city_id) != 2 || !ctype_digit($city_id)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('city')->where('city_id',$city_id)->update(['city_name' => $city_name]);  
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = ['resp' => ''];
                $district_id = session('user')->username.$request->code;
                $district_name = $request->name;
                $district = DB::table('district')->where('district_id', $district_id)->get();
                $access_city = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                if (!count($district) || $district_id == "" || $district_name == "" || strlen($district_id) != 4 || 
                    !ctype_digit($district_id) || !count($access_city)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('district')->where('district_id',$district_id)->update(['district_name' => $district_name]);  
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = ['resp' => '']; 
                $ward_id = session('user')->username.$request->code;
                $ward_name = $request->name;
                $ward = DB::table('ward')->where('ward_id', $ward_id)->get();
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                if (!count($ward) || $ward_id == "" || $ward_name == "" || strlen($ward_id) != 6 || !ctype_digit($ward_id) || 
                    !count($access_city) || !count($access_district)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('ward')->where('ward_id',$ward_id)->update(['ward_name' => $ward_name]);  
                $result['resp'] = 'success';
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = ['resp' => '']; 
                $village_id = session('user')->username.$request->code;
                $village_name = $request->name;
                $village = DB::table('village')->where('village_id', $village_id)->get();
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
                if (!count($village) || $village_id == "" || $village_name == "" || strlen($village_id) != 8 || 
                    !ctype_digit($village_id) || !count($access_city) || !count($access_district) || !count($access_ward)) {
                    $result['resp'] = 'error';
                    return response()->json($result);
                } 
                DB::table('village')->where('village_id',$village_id)->update(['village_name' => $village_name]);  
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function GetCity () {
        if (session('user')) {
            $city = DB::table('city')->selectRaw('city_id as code')->selectRaw('city_name as name')->get();
            return response()->json(['info' => $city]);
        }
        return response()->json(['resp' => 'error']);
    }

    public function GetDistrict (Request $request) {
        if (session('user')) {
            if (strlen($request->code) != 2) {
                return response()->json(['resp' => 'error']);
            }
            $district = DB::table('district')
            ->selectRaw('district_id as code')
            ->selectRaw('district_name as name')
            ->where('city_id', $request->code)->get();
            return response()->json(['info' => $district]);
        }
        return response()->json(['resp' => 'error']);
    }

    public function GetWard (Request $request) {
        if (session('user')) {
            if (strlen($request->code) != 4) {
                return response()->json(['resp' => 'error']);
            }
            $ward = DB::table('ward')
            ->selectRaw('ward_id as code')
            ->selectRaw('ward_name as name')
            ->where('district_id', $request->code)->get();
            return response()->json(['info' => $ward]);
        }
        return response()->json(['resp' => 'error']);
    }

    public function GetVillage (Request $request) {
        if (session('user')) {
            if (strlen($request->code) != 6) {
                return response()->json(['resp' => 'error']);
            }
            $village = DB::table('village')
            ->selectRaw('village_id as code')
            ->selectRaw('village_name as name')
            ->where('ward_id', $request->code)->get();
            return response()->json(['info' => $village]);
        }
        return response()->json(['resp' => 'error']);
    }

    public function GetLocationInfo() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return response()->json(['code' => 'admin', 'name' => 'cả nước']);
            } else if (strlen(session('user')->username) == 2) {
                $result = DB::table('city')
                ->where('city_id', session('user')->username)
                ->selectRaw('city_id as code')
                ->selectRaw('city_name as name')->first();
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = DB::table('district')
                ->where('district_id', session('user')->username)
                ->selectRaw('district_id as code')
                ->selectRaw('district_name as name')->first();
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = DB::table('ward')
                ->where('ward_id', session('user')->username)
                ->selectRaw('ward_id as code')
                ->selectRaw('ward_name as name')->first();
                return response()->json($result);
            } else if (strlen(session('user')->username) == 8) {
                $result = DB::table('village')
                ->where('village_id', session('user')->username)
                ->selectRaw('village_id as code')
                ->selectRaw('village_name as name')->first();
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function GetLocationChart() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['locations' => [], 'population' => []];
                $city = DB::table('city')->get();
                foreach($city as $c) {
                    $population = DB::table('person')->where('village_id','like', $c->city_id.'%')->count();
                    array_push($result['locations'],$c->city_name);
                    array_push($result['population'],$population);
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = ['locations' => [], 'population' => []];
                $district = DB::table('district')->where('city_id',session('user')->username)->get();
                foreach($district as $d) {
                    $population = DB::table('person')->where('village_id','like', $d->district_id.'%')->count();
                    array_push($result['locations'],$d->district_name);
                    array_push($result['population'],$population);
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = ['locations' => [], 'population' => []];
                $ward = DB::table('ward')->where('district_id',session('user')->username)->get();
                foreach($ward as $w) {
                    $population = DB::table('person')->where('village_id','like', $w->ward_id.'%')->count();
                    array_push($result['locations'],$w->ward_name);
                    array_push($result['population'],$population);
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = ['locations' => [], 'population' => []];
                $village = DB::table('village')->where('ward_id',session('user')->username)->get();
                foreach($village as $v) {
                    $population = DB::table('person')->where('village_id','like', $v->village_id.'%')->count();
                    array_push($result['locations'],$v->village_name);
                    array_push($result['population'],$population);
                }
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }
}
