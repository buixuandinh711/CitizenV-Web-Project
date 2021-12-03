<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VillageController extends Controller
{
    public function GetAddDeclareVillage() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $ward_username = substr(session('user')->username,0,4);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district) && count($user_ward)) {
                    return view('Declare/Village/AddDeclareVillage');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostAddDeclareVillage(Request $request) {
        $village_id = $request->village_id;
        $village_name = $request->village_name;
        $ward_id = substr($village_id,0,6);
        $district_id = substr($village_id,0,4);
        $city_id = substr($village_id,0,2);
        $village = DB::table('village')->where('village_id', $village_id)->get();
        if ($village_id == "" || $village_name == "" || strlen($village_id) != 8 || count($village) || !is_numeric($village_id) || $ward_id != session('user')->username) {
            return redirect('adddeclarevillage')->with('mes','Thêm thôn thất bại');
        }
        DB::table('village')->insert(['city_id' => $city_id,'district_id' => $district_id,'ward_id' => $ward_id,'village_id' => $village_id,'village_name' => $village_name]);
        return redirect('adddeclarevillage')->with('mes','Thêm thôn thành công');
    }

    public function ShowDeclareVillage() {
        if (session('user')) {
            $ward_id = session('user')->username.'%';
            if (strlen(session('user')->username) == 6) {
                $village = DB::table('village')->Where('village_id', 'like', $ward_id)->get();
                return view('Declare/Village/ShowDeclareVillage',['village'=>$village]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function DeleteDeclareVillage(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $ward_username = substr(session('user')->username,0,4);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district) && count($user_ward)) {
                    DB::table('village')->where('village_id', $request->village_id)->delete();
                    return redirect('showdeclarevillage')->with('mes','Xóa thôn thành công');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetEditDeclareVillage() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $ward_username = substr(session('user')->username,0,4);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district) && count($user_ward)) {
                    return view('Declare/Village/EditDeclareVillage');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostEditDeclareVillage(Request $request) {
        $ward_id = session('user')->username.'%';
        $village = DB::table('village')->where('village_id', $request->village_id)->Where('village_id', 'like', $ward_id)->get();
        if (count($village) && $request->village_name != "") {
            DB::table('village')->where('village_id', $request->village_id)->update(['village_name' => $request->village_name]);
            return redirect('editdeclarevillage')->with('mes','Sửa thôn thành công');
        }
        return redirect('editdeclarevillage')->with('mes','Sửa thôn thất bại');
    }
}
