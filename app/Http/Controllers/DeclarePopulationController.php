<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeclarePopulationController extends Controller
{
    public function AddPerson(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 8) {
                $result = ['resp' => ''];
                $person_id = $request->id;
                $person_name = $request->name;
                $person_date = $request->dateOfBirth;
                $person_gender = $request->gender;		
                $person_permanent_address = $request->permanentAddress;
                $person_temporary_address = $request->currentAddress;
                $person_religion = $request->religion;
                $person_level = $request->grade;
                $person_job = $request->job;
                $village_id = session('user')->username;
                $person = DB::table('person')->where('person_id', $person_id)->get();
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')
                ->where('username',substr(session('user')->username,0,6))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_village = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                if (strlen($person_id) != 12 || count($person) || !ctype_digit($person_id) || !count($access_city) || 
                    !count($access_district) || !count($access_ward) || !count($access_village) || $person_id == '' || 
                    $person_name == '' || $person_date == '' || $person_gender == '' ||	$person_permanent_address == '' || 
                    $person_temporary_address == '' || $person_religion == '' || $person_level == '' || $person_job == '') {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('person')->insert(['village_id' => $village_id, 'person_id' => $person_id, 'person_name' => $person_name, 
                    'person_date' => $person_date, 'person_gender' => $person_gender, 
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
                $result = ['resp' => ''];
                $person_id = $request->id;
                $person_name = $request->name;
                $person_date = $request->dateOfBirth;
                $person_gender = $request->gender;		
                $person_permanent_address = $request->permanentAddress;
                $person_temporary_address = $request->currentAddress;
                $person_religion = $request->religion;
                $person_level = $request->grade;
                $person_job = $request->job;
                $city_id = substr(session('user')->username,0,2);
                $district_id = substr(session('user')->username,0,4);
                $ward_id = substr(session('user')->username,0,6);
                $village_id = session('user')->username;
                $person = DB::table('person')->where('person_id', $person_id)->get();
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')
                ->where('username',substr(session('user')->username,0,6))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_village = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                if (strlen($person_id) != 12 || !count($person) || !ctype_digit($person_id) || !count($access_city) || 
                    !count($access_district) || !count($access_ward) || !count($access_village) || $person_id == '' || 
                    $person_name == '' || $person_date == '' || $person_gender == '' || $person_permanent_address == '' || 
                    $person_temporary_address == '' || $person_religion == '' || $person_level == '' || $person_job == '') {
                    $result['resp'] = 'error';
                    return response()->json($result);
                }
                DB::table('person')->where('person_id',$person_id)->update(['person_name' => $person_name, 'person_date' => $person_date,
                    'person_gender' => $person_gender, 'person_permanent_address' => $person_permanent_address, 
                    'person_temporary_address' => $person_temporary_address,'person_religion' => $person_religion, 
                    'person_level' => $person_level, 'person_job' => $person_job]);
                $result['resp'] = 'success';
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function DeletePerson(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 8) {
                $result = ['resp' => ''];
                $person_id = $request->id;
                $person = DB::table('person')->where('person_id', $person_id)->get();
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')
                ->where('username',substr(session('user')->username,0,6))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_village = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                if (strlen($person_id) != 12 || !count($person) || !ctype_digit($person_id) || !count($access_city) || 
                !count($access_district) || !count($access_ward) || !count($access_village) || $person_id == '') {
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

    public function GetDeclareStatus() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = array();
                $city = DB::table('city')->get();
                foreach($city as $c) {
                    $city_id = $c->city_id.'%';
                    $totalperson = DB::table('person')->where('village_id','like', $city_id)->count();
                    $access_city = DB::table('access')->where('username', $c->city_id)->first();
                    $district = DB::table('district')->where('city_id', $c->city_id)->get();
                    $check = true;
                    if ($access_city) {
                        if (!count($district)) {
                            if (count($complete) || !count($wards)) {
                                array_push($result,['code' => $c->city_id, 'name' => $c->city_name , 'endDate' => $access_city->end_date, 
                                'isComplete' => false, 'declaredCitizen' => $totalperson]);
                                $check = false;
                            }
                        }
                        foreach($district as $d) {
                            $district_id = $d->district_id.'%';
                            $complete = DB::table('ward')->where('ward_id', 'like', $district_id)->where('complete', 0)->get();
                            $wards = DB::table('ward')->where('ward_id', 'like', $district_id)->get();
                            if (count($complete) || !count($wards)) {
                                array_push($result,['code' => $c->city_id, 'name' => $c->city_name , 'endDate' => $access_city->end_date, 
                                'isComplete' => false, 'declaredCitizen' => $totalperson]);
                                $check = false;
                                break;
                            }
                        }
                        if ($check) {
                            array_push($result,['code' => $c->city_id, 'name' => $c->city_name , 'endDate' => $access_city->end_date, 
                                'isComplete' => true, 'declaredCitizen' => $totalperson]);
                        }
                    } else {
                        array_push($result,['code' => $c->city_id, 'name' => $c->city_name , 'endDate' => '', 
                            'isComplete' => false, 'declaredCitizen' => $totalperson]);
                    }
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = array();
                $district = DB::table('district')->where('city_id', session('user')->username)->get();
                foreach($district as $d) {
                    $district_id = $d->district_id.'%';
                    $complete = DB::table('ward')->where('ward_id', 'like', $district_id)->where('complete', 0)->get();
                    $totalperson = DB::table('person')->where('village_id','like', $district_id)->count();
                    $access_district = DB::table('access')->where('username', $d->district_id)->first();
                    $wards = DB::table('ward')->where('ward_id', 'like', $district_id)->get();
                    if ($access_district) {
                        if (count($complete) || !count($wards)) {
                            array_push($result,['code' => $d->district_id, 'name' => $d->district_name , 
                                'endDate' => $access_district->end_date, 'isComplete' => false, 'declaredCitizen' => $totalperson]);
                        } else {
                            array_push($result,['code' => $d->district_id, 'name' => $d->district_name , 
                                'endDate' => $access_district->end_date, 'isComplete' => true, 'declaredCitizen' => $totalperson]);
                        }
                    } else {
                        array_push($result,['code' => $d->district_id, 'name' => $d->district_name , 
                            'endDate' => '', 'isComplete' => false, 'declaredCitizen' => $totalperson]);
                    }
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = array();
                $ward = DB::table('ward')->where('district_id', session('user')->username)->get();
                foreach($ward as $w) {
                    $ward_id = $w->ward_id.'%';
                    $totalperson = DB::table('person')->where('village_id','like', $ward_id)->count();
                    $access_ward = DB::table('access')->where('username', $w->ward_id)->first();
                    if ($access_ward) {
                        if (!$w->complete) {
                            array_push($result,['code' => $w->ward_id, 'name' => $w->ward_name , 'endDate' => $access_ward->end_date, 
                                'isComplete' => false, 'declaredCitizen' => $totalperson]);
                        } else {
                            array_push($result,['code' => $w->ward_id, 'name' => $w->ward_name , 'endDate' => $access_ward->end_date, 
                                'isComplete' => true, 'declaredCitizen' => $totalperson]);
                        }
                    } else {
                        array_push($result,['code' => $w->ward_id, 'name' => $w->ward_name , 'endDate' => '', 
                            'isComplete' => false, 'declaredCitizen' => $totalperson]);
                    }
                }
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = array();
                $village = DB::table('village')->where('ward_id', session('user')->username)->get();
                foreach($village as $v) {
                    $totalperson = DB::table('person')->where('village_id',$v->village_id)->count();
                    $access_village = DB::table('access')->where('username', $v->village_id)->first();
                    if ($access_village) {
                        if (!$v->complete) {
                            array_push($result,['code' => $v->village_id, 'name' => $v->village_name , 
                                'endDate' => $access_village->end_date, 'isComplete' => false, 'declaredCitizen' => $totalperson]);
                        } else {
                            array_push($result,['code' => $v->village_id, 'name' => $v->village_name , 
                                'endDate' => $access_village->end_date, 'isComplete' => true, 'declaredCitizen' => $totalperson]);
                        }
                    } else {
                        array_push($result,['code' => $v->village_id, 'name' => $v->village_name , 
                            'endDate' => '', 'isComplete' => false, 'declaredCitizen' => $totalperson]);
                    }
                }
                return response()->json($result);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function ShowListPopulation(Request $request) {
        if (session('user')) {
            $result = DB::table('person')
            ->where('village_id',$request->code)
            ->selectRaw('person_id as id')
            ->selectRaw('person_name as name')
            ->selectRaw('person_date as dateOfBirth')
            ->selectRaw('person_gender as gender')->get();
            return response()->json($result);
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
                $person = DB::table('person')->where('person_id',$request->code)
                ->where('village_id','like',session('user')->username.'%')->first();
                if (!ctype_digit($request->code) || !$person) {
                    return response()->json($error);  
                }
                $success['info'] = $person;
                return response()->json($success); 
            } else if (strlen(session('user')->username) == 4) {
                $success = ['resp' => 'success', 'info' => []];
                $error = ['resp' => 'error'];
                $person = DB::table('person')->where('person_id',$request->code)
                ->where('village_id','like',session('user')->username.'%')->first();
                if (!ctype_digit($request->code) || !$person) {
                    return response()->json($error);  
                }
                $success['info'] = $person;
                return response()->json($success); 
            } else if (strlen(session('user')->username) == 6) {
                $success = ['resp' => 'success', 'info' => []];
                $error = ['resp' => 'error'];
                $person = DB::table('person')->where('person_id',$request->code)
                ->where('village_id','like',session('user')->username.'%')->first();
                if (!ctype_digit($request->code) || !$person) {
                    return response()->json($error);  
                }
                $success['info'] = $person;
                return response()->json($success); 
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function ChangeCompleteStatus() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')
                ->where('username',substr(session('user')->username,0,6))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $ward = DB::table('ward')->where('ward_id', session('user')->username)->first();
                if (!count($access_city) || !count($access_district) || !count($access_ward)) {
                    if ($ward->complete) {
                        return response()->json(['isComplete' => true]);
                    } else {
                        return response()->json(['isComplete' => false]);
                    }
                }
                if ($ward->complete) {
                    DB::table('ward')->where('ward_id', session('user')->username)->update(['complete' => 0]);
                    return response()->json(['isComplete' => false]);
                } else {
                    DB::table('ward')->where('ward_id', session('user')->username)->update(['complete' => 1]);
                    return response()->json(['isComplete' => true]);
                }
            } else if (strlen(session('user')->username) == 8) {
                $access_city = DB::table('access')
                ->where('username',substr(session('user')->username,0,2))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_district = DB::table('access')
                ->where('username',substr(session('user')->username,0,4))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_ward = DB::table('access')
                ->where('username',substr(session('user')->username,0,6))
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $access_village = DB::table('access')
                ->where('username',session('user')->username)
                ->whereRaw('start_date <= now()')
                ->whereRaw('end_date >= now()')->get();
                $village = DB::table('village')->where('village_id', session('user')->username)->first();
                if (!count($access_city) || !count($access_district) || !count($access_ward) || !count($access_village)) {
                    if ($village->complete) {
                        return response()->json(['isComplete' => true]);
                    } else {
                        return response()->json(['isComplete' => false]);
                    }
                }
                if ($village->complete) {
                    DB::table('village')->where('village_id', session('user')->username)->update(['complete' => 0]);
                    return response()->json(['isComplete' => false]);
                } else {
                    DB::table('village')->where('village_id', session('user')->username)->update(['complete' => 1]);
                    return response()->json(['isComplete' => true]);
                }
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function GetUpperLocation() {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                $city = DB::table('city')->where('city_id',substr(session('user')->username,0,2))->first();
                return response()->json(['city' => $city->city_name]);
            } else if (strlen(session('user')->username) == 4) {
                $city = DB::table('city')->where('city_id',substr(session('user')->username,0,2))->first();
                $district = DB::table('district')->where('district_id',substr(session('user')->username,0,4))->first();
                return response()->json(['district' => $district->district_name, 'city' => $city->city_name]);
            } else if (strlen(session('user')->username) == 6) {
                $city = DB::table('city')->where('city_id',substr(session('user')->username,0,2))->first();
                $district = DB::table('district')->where('district_id',substr(session('user')->username,0,4))->first();
                $ward = DB::table('ward')->where('ward_id',substr(session('user')->username,0,6))->first();
                return response()->json(['ward' => $ward->ward_name, 'district' => $district->district_name, 'city' => $city->city_name]);
            } else if (strlen(session('user')->username) == 8) {
                $city = DB::table('city')->where('city_id',substr(session('user')->username,0,2))->first();
                $district = DB::table('district')->where('district_id',substr(session('user')->username,0,4))->first();
                $ward = DB::table('ward')->where('ward_id',substr(session('user')->username,0,6))->first();
                $village = DB::table('village')->where('village_id',session('user')->username)->first();
                return response()->json(['village' => $village->village_name, 'ward' => $ward->ward_name, 
                    'district' => $district->district_name, 'city' => $city->city_name]);
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function GetCompleteStatus() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $ward = DB::table('ward')->where('ward_id', session('user')->username)->first();
                if ($ward->complete) {
                    return response()->json(['isComplete' => true]); 
                } else {
                    return response()->json(['isComplete' => false]);
                }
            } else if (strlen(session('user')->username) == 8) {
                $village = DB::table('village')->where('village_id', session('user')->username)->first();
                if ($village->complete) {
                    return response()->json(['isComplete' => true]); 
                } else {
                    return response()->json(['isComplete' => false]);
                }
            }
        }
        return response()->json(['resp' => 'error']);
    }

    public function CheckCitizenInfo(Request $request) {
        if (session('user')) {
            $request->session()->put('id', $request->id);
            return response()->json(['resp' => 'success']);
        }
        return response()->json(['resp' => 'error']);
    }

    public function GetCitizenInfo(Request $request) {
        if (session('user') && session('id')) {
            $result = ['id' => '', 'name' => '', 'gender' => '', 'dateOfBirth' => '', 'permanentAddress' => '', 'currentAddress' => '', 
                'religion' => '', 'grade' => '', 'job' => ''];
            $person = DB::table('person')->where('person_id', session('id'))->first();
            $city_permanent = DB::table('city')->where('city_id', substr($person->person_permanent_address,0,2))->first();
            $district_permanent = DB::table('district')->where('district_id', substr($person->person_permanent_address,0,4))->first();
            $ward_permanent = DB::table('ward')->where('ward_id', substr($person->person_permanent_address,0,6))->first();
            $village_permanent = DB::table('village')->where('village_id', substr($person->person_permanent_address,0,8))->first();
            $city_current = DB::table('city')->where('city_id', substr($person->person_temporary_address,0,2))->first();
            $district_current = DB::table('district')->where('district_id', substr($person->person_temporary_address,0,4))->first();
            $ward_current = DB::table('ward')->where('ward_id', substr($person->person_temporary_address,0,6))->first();
            $village_current = DB::table('village')->where('village_id', substr($person->person_temporary_address,0,8))->first();
            $result['id'] = $person->person_id;
            $result['name'] = $person->person_name;
            $result['gender'] = $person->person_gender;
            $result['dateOfBirth'] = $person->person_date;
            $result['permanentAddress'] = $village_permanent->village_name.','.$ward_permanent->ward_name.','.$district_permanent->district_name.'.,'.$city_permanent->city_name;
            $result['currentAddress'] = $village_current->village_name.','.$ward_current->ward_name.','.$district_current->district_name.'.,'.$city_current->city_name;
            $result['religion'] = $person->person_religion;
            $result['grade'] = $person->person_level;
            $result['job'] = $person->person_job;
            return response()->json($result);
        }
        return response()->json(['resp' => 'error']);
    }

    public function PostCitizenInfo(Request $request) {
        if (session('user')) {
            $result = ['resp' => 'success' ,'id' => '', 'name' => '', 'gender' => '', 'dateOfBirth' => '', 'permanentAddress' => '', 'currentAddress' => '', 
                'religion' => '', 'grade' => '', 'job' => ''];
            $person = DB::table('person')->where('person_id', $request->id)->first();
            $persons = DB::table('person')->where('person_id', $request->id)->where('village_id','like',session('user')->username.'%')->first();
            if (!$person) {
                return response()->json(['resp' => 'Thông tin công dân không tồn tại!']);
            }
            if (!$persons) {
                return response()->json(['resp' => 'Không đủ quyền để xem thông tin!']);
            }
            $city_permanent = DB::table('city')->where('city_id', substr($person->person_permanent_address,0,2))->first();
            $district_permanent = DB::table('district')->where('district_id', substr($person->person_permanent_address,0,4))->first();
            $ward_permanent = DB::table('ward')->where('ward_id', substr($person->person_permanent_address,0,6))->first();
            $village_permanent = DB::table('village')->where('village_id', substr($person->person_permanent_address,0,8))->first();
            $city_current = DB::table('city')->where('city_id', substr($person->person_temporary_address,0,2))->first();
            $district_current = DB::table('district')->where('district_id', substr($person->person_temporary_address,0,4))->first();
            $ward_current = DB::table('ward')->where('ward_id', substr($person->person_temporary_address,0,6))->first();
            $village_current = DB::table('village')->where('village_id', substr($person->person_temporary_address,0,8))->first();
            $result['id'] = $person->person_id;
            $result['name'] = $person->person_name;
            $result['gender'] = $person->person_gender;
            $result['dateOfBirth'] = $person->person_date;
            $result['permanentAddress'] = $village_permanent->village_name.' , '.$ward_permanent->ward_name.' , '.$district_permanent->district_name.' , '.$city_permanent->city_name;
            $result['currentAddress'] = $village_current->village_name.' , '.$ward_current->ward_name.' , '.$district_current->district_name.' , '.$city_current->city_name;
            $result['religion'] = $person->person_religion;
            $result['grade'] = $person->person_level;
            $result['job'] = $person->person_job;
            return response()->json($result);
        }
        return response()->json(['resp' => 'error']);
    }
}
