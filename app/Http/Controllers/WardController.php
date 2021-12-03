<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WardController extends Controller
{
    public function GetAddDeclareWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district)) {
                    return view('Declare/Ward/AddDeclareWard');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function PostAddDeclareWard(Request $request) {
        $ward_id = $request->ward_id;
        $ward_name = $request->ward_name;
        $district_id = substr($ward_id,0,4);
        $city_id = substr($ward_id,0,2);
        $ward = DB::table('ward')->where('ward_id', $ward_id)->get();
        if ($ward_id == "" || $ward_name == "" || strlen($ward_id) != 6 || count($ward) || !is_numeric($ward_id) || $district_id != session('user')->username) {
            return redirect('AddDeclareWard')->with('mes','Thêm phường thất bại');
        }
        DB::table('ward')->insert(['city_id' => $city_id,'district_id' => $district_id,'ward_id' => $ward_id,'ward_name' => $ward_name]);
        return redirect('AddDeclareWard')->with('mes','Thêm phường thành công');
    }

    public function ShowDeclareWard() {
        if (session('user')) {
            $district_id = session('user')->username.'%';
            if (strlen(session('user')->username) == 4) {
                $ward = DB::table('ward')->Where('ward_id', 'like', $district_id)->get();
                return view('Declare/Ward/ShowDeclareWard',['ward'=>$ward]);
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function DeleteDeclareWard(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district)) {
                    DB::table('ward')->where('ward_id', $request->ward_id)->delete();
                    return redirect('ShowDeclareWard')->with('mes','Xóa phường thành công');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function GetEditDeclareWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district)) {
                    return view('Declare/Ward/EditDeclareWard');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function PostEditDeclareWard(Request $request) {
        $district_id = session('user')->username.'%';
        $ward = DB::table('ward')->where('ward_id', $request->ward_id)->Where('ward_id', 'like', $district_id)->get();
        if (count($ward) && $request->ward_name != "") {
            DB::table('ward')->where('ward_id', $request->ward_id)->update(['ward_name' => $request->ward_name]);
            return redirect('EditDeclareWard')->with('mes','Sửa phường thành công');
        }
        return redirect('EditDeclareWard')->with('mes','Sửa phường thất bại');
    }
}
