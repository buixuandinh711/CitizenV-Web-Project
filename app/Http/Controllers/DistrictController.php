<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DistrictController extends Controller
{
    // public function GetAddDeclareDistrict() {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 2) {
    //             $currentTime = Carbon::now();
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user)) {
    //                 return view('Declare/District/AddDeclareDistrict');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostAddDeclareDistrict(Request $request) {
    //     $district_id = $request->district_id;
    //     $district_name = $request->district_name;
    //     $city_id = substr($district_id,0,2);
    //     $district = DB::table('district')->where('district_id', $district_id)->get();
    //     if ($district_id == "" || $district_name == "" || strlen($district_id) != 4 || count($district) || !ctype_digit($district_id) || 
    //         $city_id != session('user')->username) {
    //         return redirect('adddeclaredistrict')->with('mes','Thêm quận thất bại');
    //     }
    //     DB::table('district')->insert(['city_id' => $city_id,'district_id' => $district_id,'district_name' => $district_name]);
    //     return redirect('adddeclaredistrict')->with('mes','Thêm quận thành công');
    // }

    // public function ShowDeclareDistrict() {
    //     if (session('user')) {
    //         $city_id = session('user')->username.'%';
    //         if (strlen(session('user')->username) == 2) {
    //             $district = DB::table('district')->Where('district_id', 'like', $city_id)->get();
    //             return view('Declare/District/ShowDeclareDistrict',['district'=>$district]);
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function DeleteDeclareDistrict(Request $request) {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 2) {
    //             $currentTime = Carbon::now();
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user)) {
    //                 DB::table('district')->where('district_id', $request->district_id)->delete();
    //                 return redirect('showdeclaredistrict')->with('mes','Xóa quận thành công');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function GetEditDeclareDistrict() {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 2) {
    //             $currentTime = Carbon::now();
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user)) {
    //                 return view('Declare/District/EditDeclareDistrict');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostEditDeclareDistrict(Request $request) {
    //     $city_id = session('user')->username.'%';
    //     $district = DB::table('district')->where('district_id', $request->district_id)->Where('district_id', 'like', $city_id)->get();
    //     if (count($district) && $request->district_name != "") {
    //         DB::table('district')->where('district_id', $request->district_id)->update(['district_name' => $request->district_name]);
    //         return redirect('editdeclaredistrict')->with('mes','Sửa quận thành công');
    //     }
    //     return redirect('editdeclaredistrict')->with('mes','Sửa quận thất bại');
    // }
}
