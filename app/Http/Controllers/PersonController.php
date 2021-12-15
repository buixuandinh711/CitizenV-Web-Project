<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PersonController extends Controller
{
    // public function GetAddDeclarePerson() {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 8) {
    //             $currentTime = Carbon::now();
    //             $district_username = substr(session('user')->username,0,2);
    //             $ward_username = substr(session('user')->username,0,4);
    //             $village_username = substr(session('user')->username,0,6);
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_village = DB::table('access')->where('username',$village_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user) && count($user_district) && count($user_ward) && count($user_village)) {
    //                 return view('Declare/Person/AddDeclarePerson');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostAddDeclarePerson(Request $request) {
    //     $person_id = $request->person_id;
    //     $person_name = $request->person_name;
    //     $person_date = $request->person_date;
    //     $person_gender = $request->person_gender;
    //     $village_id = session('user')->username;
    //     $ward_id = substr($village_id,0,6);
    //     $district_id = substr($village_id,0,4);
    //     $city_id = substr($village_id,0,2);
    //     $person = DB::table('person')->where('person_id', $person_id)->get();
    //     if ($person_id == "" || $person_name == "" || $person_gender == "" || $person_date == "" || count($person) || 
    //         !ctype_digit($person_id)) {
    //         return redirect('adddeclareperson')->with('mes','Thêm dân số thất bại');
    //     }
    //     DB::table('person')->insert(['city_id' => $city_id,'district_id' => $district_id,'ward_id' => $ward_id,
    //     'village_id' => $village_id,'person_id' => $person_id,'person_name' => $person_name, 'person_date' => $person_date, 
    //     'person_gender' => $person_gender]);
    //     return redirect('adddeclareperson')->with('mes','Thêm dân số thành công');
    // }

    // public function ShowDeclarePerson() {
    //     if (session('user')) {
    //         $village_id = session('user')->username.'%';
    //         if (strlen(session('user')->username) == 8) {
    //             $person = DB::table('person')->Where('village_id', 'like', $village_id)->get();
    //             return view('Declare/Person/ShowDeclarePerson',['person'=>$person]);
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function DeleteDeclarePerson(Request $request) {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 8) {
    //             $currentTime = Carbon::now();
    //             $district_username = substr(session('user')->username,0,2);
    //             $ward_username = substr(session('user')->username,0,4);
    //             $village_username = substr(session('user')->username,0,6);
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_village = DB::table('access')->where('username',$village_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user) && count($user_district) && count($user_ward) && count($user_village)) {
    //                 DB::table('person')->where('person_id', $request->person_id)->delete();
    //                 return redirect('showdeclareperson')->with('mes','Xóa dân số thành công');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function GetEditDeclarePerson() {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 8) {
    //             $currentTime = Carbon::now();
    //             $district_username = substr(session('user')->username,0,2);
    //             $ward_username = substr(session('user')->username,0,4);
    //             $village_username = substr(session('user')->username,0,6);
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_village = DB::table('access')->where('username',$village_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user) && count($user_district) && count($user_ward) && count($user_village)) {
    //                 return view('Declare/Person/EditDeclarePerson');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostEditDeclarePerson(Request $request) {
    //     $person = DB::table('person')->where('person_id', $request->person_id)->get();
    //     if (count($person) && $request->person_name != "" && $request->person_date != "" && $request->person_gender != "") {
    //         DB::table('person')->where('person_id', $request->person_id)->update(['person_name' => $request->person_name,
    //         'person_date' => $request->person_date,'person_gender' => $request->person_gender]);
    //         return redirect('editdeclareperson')->with('mes','Sửa dân số thành công');
    //     }
    //     return redirect('editdeclareperson')->with('mes','Sửa dân số thất bại');
    // }
}
