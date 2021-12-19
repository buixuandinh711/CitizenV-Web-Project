<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeclarePopulationController extends Controller
{
    public function AddPerson(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 8) {
                $currentTime = Carbon::now();
                $result = ['resp' => ''];
                $person_id = $request->code;
                $person_name = $request->name;
                $person_date = $request->date;
                $person_gender = $request->gender;	
                $person_home_town = $request->home_town;	
                $person_permanent_address = $request->permanent_address;
                $person_temporary_address = $request->temporary_address;
                $person_religion = $request->religion;
                $person_level = $request->level;
                $person_job = $request->job;
                $city_id = substr(session('user')->username,0,2);
                $district_id = substr(session('user')->username,0,4);
                $ward_id = substr(session('user')->username,0,6);
                $village_id = session('user')->username;
                $person = DB::table('person')->where('person_id', $person_id)->get();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $access_ward = DB::table('access')->where('username',substr(session('user')->username,0,6))
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $access_village = DB::table('access')->where('username',session('user')->username)
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($person) || !ctype_digit($person_id) || !count($access_city) || !count($access_district) ||
                !count($access_ward) || !count($access_village) || $person_id == '' || $person_name == '' || $person_date == '' ||
                $person_gender == '' ||	$person_home_town == ''	|| $person_permanent_address == '' || $person_temporary_address == '' 
                || $person_religion == '' || $person_level == '' || $person_job == '') {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('person')->insert(['city_id' => $city_id,'district_id' => $district_id, 'ward_id' => $ward_id,
                'village_id' => $village_id, 'person_id' => $person_id, 'person_name' => $person_name, 'person_date' => $person_date,
                'person_gender' => $person_gender, 'person_home_town' => $person_home_town, 
                'person_permanent_address' => $person_permanent_address, 'person_temporary_address' => $person_temporary_address,
                'person_religion' => $person_religion, 'person_level' => $person_level, 'person_job' => $person_job]);
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function EditPerson(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 8) {
                $currentTime = Carbon::now();
                $result = ['resp' => ''];
                $person_id = $request->code;
                $person_name = $request->name;
                $person_date = $request->date;
                $person_gender = $request->gender;	
                $person_home_town = $request->home_town;	
                $person_permanent_address = $request->permanent_address;
                $person_temporary_address = $request->temporary_address;
                $person_religion = $request->religion;
                $person_level = $request->level;
                $person_job = $request->job;
                $city_id = substr(session('user')->username,0,2);
                $district_id = substr(session('user')->username,0,4);
                $ward_id = substr(session('user')->username,0,6);
                $village_id = session('user')->username;
                $person = DB::table('person')->where('person_id', $person_id)->get();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $access_ward = DB::table('access')->where('username',substr(session('user')->username,0,6))
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $access_village = DB::table('access')->where('username',session('user')->username)
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (!count($person) || !ctype_digit($person_id) || !count($access_city) || !count($access_district) ||
                !count($access_ward) || !count($access_village) || $person_id == '' || $person_name == '' || $person_date == '' ||
                $person_gender == '' ||	$person_home_town == ''	|| $person_permanent_address == '' || $person_temporary_address == '' 
                || $person_religion == '' || $person_level == '' || $person_job == '') {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('person')->where('person_id',$person_id)->update(['person_name' => $person_name, 
                'person_date' => $person_date,'person_gender' => $person_gender, 'person_home_town' => $person_home_town, 
                'person_permanent_address' => $person_permanent_address, 'person_temporary_address' => $person_temporary_address,
                'person_religion' => $person_religion, 'person_level' => $person_level, 'person_job' => $person_job]);
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function DeletePerson(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 8) {
                $currentTime = Carbon::now();
                $result = ['resp' => ''];
                $person_id = $request->code;
                $person = DB::table('person')->where('person_id', $person_id)->get();
                $access_city = DB::table('access')->where('username',substr(session('user')->username,0,2))
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $access_district = DB::table('access')->where('username',substr(session('user')->username,0,4))
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $access_ward = DB::table('access')->where('username',substr(session('user')->username,0,6))
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $access_village = DB::table('access')->where('username',session('user')->username)
                ->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (!count($person) || !ctype_digit($person_id) || !count($access_city) || !count($access_district) ||
                !count($access_ward) || !count($access_village) || $person_id == '') {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('person')->where('person_id', $person_id)->delete();
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function FollowDeclarePopulation() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = array();
                $city = DB::table('city')->get();
                foreach($city as $c) {
                    $complete = DB::table('village')->where('city_id',$c->city_id)->where('complete', 0)->get();
                    if (count($complete)) {
                        array_push($result,['city_id' => $c->city_id, 'complete' => false]);
                    } else {
                        array_push($result,['city_id' => $c->city_id, 'complete' => true]);
                    }
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = array();
                $district = DB::table('district')->where('city_id', session('user')->username)->get();
                foreach($district as $d) {
                    $complete = DB::table('village')->where('district_id',$d->district_id)->where('complete', 0)->get();
                    if (count($complete)) {
                        array_push($result,['district_id' => $d->district_id, 'complete' => false]);
                    } else {
                        array_push($result,['district_id' => $d->district_id, 'complete' => true]);
                    }
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = array();
                $ward = DB::table('ward')->where('district_id', session('user')->username)->get();
                foreach($ward as $w) {
                    $complete = DB::table('village')->where('ward_id',$w->ward_id)->where('complete', 0)->get();
                    if (count($complete)) {
                        array_push($result,['ward_id' => $w->ward_id, 'complete' => false]);
                    } else {
                        array_push($result,['ward_id' => $w->ward_id, 'complete' => true]);
                    }
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = DB::table('village')->where('ward_id', session('user')->username)->select('village_id','complete')->get();
                foreach($result as $r) {
                    if ($r->complete) {
                        $r->complete = true;
                    } else {
                        $r->complete = false;
                    }
                }
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowTotalPopulation() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = DB::table('person')->count();
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = DB::table('person')->where('city_id',session('user')->username)->count();
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = DB::table('person')->where('district_id',session('user')->username)->count();
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = DB::table('person')->where('ward_id',session('user')->username)->count();
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowListPopulation() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = DB::table('person')->get();
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = DB::table('person')->where('city_id',session('user')->username)->get();
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = DB::table('person')->where('district_id',session('user')->username)->get();
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = DB::table('person')->where('ward_id',session('user')->username)->get();
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowInfoPopulation(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $success = ['resp' => 'success', 'info' => []];
                $error = ['resp' => 'error'];
                $person = DB::table('person')->where('person_id',$request->code)->first(); 
                if (!ctype_digit($request->code) || !$person) {
                    return response()->json($error);  
                }
                $success['info'] = $person;
                return response()->json($success); 
            } else if (strlen(session('user')->username) == 2) {
                $success = ['resp' => 'success', 'info' => []];
                $error = ['resp' => 'error'];
                $person = DB::table('person')->where('person_id',$request->code)->where('city_id',session('user')->username)->first();
                if (!ctype_digit($request->code) || !$person) {
                    return response()->json($error);  
                }
                $success['info'] = $person;
                return response()->json($success); 
            } else if (strlen(session('user')->username) == 4) {
                $success = ['resp' => 'success', 'info' => []];
                $error = ['resp' => 'error'];
                $person = DB::table('person')->where('person_id',$request->code)->where('district_id',session('user')->username)->first();
                if (!ctype_digit($request->code) || !$person) {
                    return response()->json($error);  
                }
                $success['info'] = $person;
                return response()->json($success); 
            } else if (strlen(session('user')->username) == 6) {
                $success = ['resp' => 'success', 'info' => []];
                $error = ['resp' => 'error'];
                $person = DB::table('person')->where('person_id',$request->code)->where('ward_id',session('user')->username)->first();
                if (!ctype_digit($request->code) || !$person) {
                    return response()->json($error);  
                }
                $success['info'] = $person;
                return response()->json($success); 
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowTotalPopulationEachCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = DB::table('person')->select('city_id', DB::raw('count(*) as person_total'))->groupBy('city_id')->get();
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowTotalPopulationEachDistrict() {
        if (session('user')->username == 'admin') {
            $result = DB::table('person')->select('district_id', DB::raw('count(*) as person_total'))
            ->groupBy('district_id')->get();
            return response()->json($result);
        } else if (strlen(session('user')->username) == 2) {
            $result = DB::table('person')->select('district_id', DB::raw('count(*) as person_total'))
            ->where('city_id',session('user')->username)->groupBy('district_id')->get();
            return response()->json($result);
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowTotalPopulationEachWard() {
        if (session('user')->username == 'admin') {
            $result = DB::table('person')->select('ward_id', DB::raw('count(*) as person_total'))
            ->groupBy('ward_id')->get();
            return response()->json($result);
        } else if (strlen(session('user')->username) == 2) {
            $result = DB::table('person')->select('ward_id', DB::raw('count(*) as person_total'))
            ->where('city_id',session('user')->username)->groupBy('ward_id')->get();
            return response()->json($result);
        } else if (strlen(session('user')->username) == 4) {
            $result = DB::table('person')->select('ward_id', DB::raw('count(*) as person_total'))
            ->where('district_id',session('user')->username)->groupBy('ward_id')->get();
            return response()->json($result);
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowTotalPopulationEachVillage() {
        if (strlen(session('user')->username) == 6) {
            $result = DB::table('person')->select('village_id', DB::raw('count(*) as person_total'))
            ->where('ward_id',session('user')->username)->groupBy('village_id')->get();
            return response()->json($result);
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowListPopulationEachCity(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $success = ['resp' => 'success', 'list' => []];
                $error = ['resp' => 'error'];
                $person  = DB::table('person')->where('city_id',$request->code)->get();
                if (!count($person) || !ctype_digit($request->code) || strlen($request->code) != 2) {
                    return response()->json($error); 
                }
                $success['list'] = $person;
                return response()->json($success);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowListPopulationEachDistrict(Request $request) {
        if (session('user')->username == 'admin') {
            $success = ['resp' => 'success', 'list' => []];
            $error = ['resp' => 'error'];
            $person = DB::table('person')->where('district_id',$request->code)->get();
            if (!count($person) || !ctype_digit($request->code) || strlen($request->code) != 4) {
                return response()->json($error); 
            }
            $success['list'] = $person;
            return response()->json($success);
        } else if (strlen(session('user')->username) == 2) {
            $success = ['resp' => 'success', 'list' => []];
            $error = ['resp' => 'error'];
            $person = DB::table('person')->where('district_id',$request->code)->where('city_id',session('user')->username)->get();
            if (!count($person) || !ctype_digit($request->code) || strlen($request->code) != 4) {
                return response()->json($error); 
            }
            $success['list'] = $person;
            return response()->json($success);
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowListPopulationEachWard(Request $request) {
        if (session('user')->username == 'admin') {
            $success = ['resp' => 'success', 'list' => []];
            $error = ['resp' => 'error'];
            $person = DB::table('person')->where('ward_id',$request->code)->get();
            if (!count($person) || !ctype_digit($request->code) || strlen($request->code) != 6) {
                return response()->json($error); 
            }
            $success['list'] = $person;
            return response()->json($success);
        } else if (strlen(session('user')->username) == 2) {
            $success = ['resp' => 'success', 'list' => []];
            $error = ['resp' => 'error'];
            $person = DB::table('person')->where('ward_id',$request->code)->where('city_id',session('user')->username)->get();
            if (!count($person) || !ctype_digit($request->code) || strlen($request->code) != 6) {
                return response()->json($error); 
            }
            $success['list'] = $person;
            return response()->json($success);
        } else if (strlen(session('user')->username) == 4) {
            $success = ['resp' => 'success', 'list' => []];
            $error = ['resp' => 'error'];
            $person = DB::table('person')->where('ward_id',$request->code)->where('district_id',session('user')->username)->get();
            if (!count($person) || !ctype_digit($request->code) || strlen($request->code) != 6) {
                return response()->json($error); 
            }
            $success['list'] = $person;
            return response()->json($success);
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowListPopulationEachVillage(Request $request) {
        if (strlen(session('user')->username) == 6) {
            $success = ['resp' => 'success', 'list' => []];
            $error = ['resp' => 'error'];
            $person = DB::table('person')->where('village_id',$request->code)->where('ward_id',session('user')->username)->get();
            if (!count($person) || !ctype_digit($request->code) || strlen($request->code) != 8) {
                return response()->json($error); 
            }
            $success['list'] = $person;
            return response()->json($success);
        }
        return response()->json(['resp' => 'error']);
    }
}
