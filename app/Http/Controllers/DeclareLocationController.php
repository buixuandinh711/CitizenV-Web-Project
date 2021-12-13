<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeclareLocationController extends Controller
{
    public function CurrentLocalInfo () {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $city = DB::table('city')->get();
                $data = ['local' => '', 'codes' => []];
                $data['local'] = 'cả nước';
                foreach($city as $c)
                    array_push($data['codes'],$c->city_id);
                return response()->json($data);
            } else if (strlen(session('user')->username) == 2) {
                $district = DB::table('district')->Where('city_id',session('user')->username)->get();
                $city = DB::table('city')->Where('city_id', session('user')->username)->first();
                $data = ['local' => '', 'codes' => []];
                $data['local'] = $city->city_name;
                foreach($district as $d)
                    array_push($data['codes'],substr($d->district_id,2,4));
                return response()->json($data);
            } else if (strlen(session('user')->username) == 4) {
                $ward = DB::table('ward')->Where('district_id', session('user')->username)->get();
                $district = DB::table('district')->Where('district_id', session('user')->username)->first();
                $data = ['local' => '', 'codes' => []];
                $data['local'] = $district->district_name;
                foreach($ward as $w)
                    array_push($data['codes'],substr($w->ward_id,4,6));
                return response()->json($data);
            } else if (strlen(session('user')->username) == 6) {
                $village = DB::table('village')->Where('ward_id', session('user')->username)->get();
                $ward = DB::table('ward')->Where('ward_id', session('user')->username)->first();
                $data = ['local' => '', 'codes' => []];
                $data['local'] = $ward->ward_name;
                foreach($village as $v)
                    array_push($data['codes'],substr($v->village_id,6,8));
                return response()->json($data);
            }
        }
    }

    public function UpdateNewLocation(Request $request) {
        // return response()->json($request);
        if (session('user')) {
            if (session('user')->username == "admin") {
                $success = ['resp' => 'success','codes' => []];
                $error = ['resp' => 'error']; 
                $city_id = $request['code'];
                $city_name = $request['name'];
                $city = DB::table('city')->where('city_id', $city_id)->get();
                if (count($city) || $city_id == "" || $city_name == "" || strlen($city_id) != 2 || !ctype_digit($city_id)) {
                    return response()->json($error);
                }
                DB::table('city')->insert(['city_id' => $city_id,'city_name' => $city_name]);  
                $city = DB::table('city')->get();
                foreach($city as $c) {
                    array_push($success['codes'],$c->city_id);
                }
                return response()->json($success);
            } else if (strlen(session('user')->username) == 2) {
                $success = ['resp' => 'success','codes' => []];
                $error = ['resp' => 'error']; 
                $district_id = session('user')->username.$request['code'];
                $district_name = $request['name'];
                $district = DB::table('district')->where('district_id', $district_id)->get();
                if (count($district) || $district_id == "" || $district_name == "" || strlen($district_id) != 4 || !ctype_digit($district_id)) {
                    return response()->json($error);
                }
                DB::table('district')
                ->insert(['city_id' => session('user')->username,'district_id' => $district_id,'district_name' => $district_name]);
                $district = DB::table('district')->where('city_id',session('user')->username)->get();
                foreach($district as $d) {
                    array_push($success['codes'],substr($d->district_id,2,4));
                }
                return response()->json($success);
            } else if (strlen(session('user')->username) == 4) {
                $success = ['resp' => 'success','codes' => []];
                $error = ['resp' => 'error']; 
                $ward_id = session('user')->username.$request['code'];
                $ward_name = $request['name'];
                $ward = DB::table('ward')->where('ward_id', $ward_id)->get();
                if (count($ward) || $ward_id == "" || $ward_name == "" || strlen($ward_id) != 6 || !ctype_digit($ward_id)) {
                    return response()->json($error);
                }
                DB::table('ward')
                ->insert(['city_id' => substr(session('user')->username,0,2),'district_id' => session('user')->username,'ward_id' => $ward_id,'ward_name' => $ward_name]);
                $ward = DB::table('ward')->where('district_id',session('user')->username)->get();
                foreach($ward as $w) {
                    array_push($success['codes'],substr($w->ward_id,4,6));
                }
                return response()->json($success);
            } else if (strlen(session('user')->username) == 6) {
                $success = ['resp' => 'success','codes' => []];
                $error = ['resp' => 'error']; 
                $village_id = session('user')->username.$request['code'];
                $village_name = $request['name'];
                $village = DB::table('village')->where('village_id', $village_id)->get();
                if (count($village) || $village_id == "" || $village_name == "" || strlen($village_id) != 8 || !ctype_digit($village_id)) {
                    return response()->json($error);
                } 
                DB::table('village')
                ->insert(['city_id' => substr(session('user')->username,0,2),'district_id' => substr(session('user')->username,0,4),'ward_id' => session('user')->username,'village_id' => $village_id, 'village_name' => $village_name]);
                $village = DB::table('village')->where('ward_id',session('user')->username)->get();
                foreach($village as $v) {
                    array_push($success['codes'],substr($v->village_id,6,8));
                }
                return response()->json($success);
            }
        } 
    }
}
