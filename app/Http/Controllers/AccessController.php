<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccessController extends Controller
{
    //City Access 
    public function GetAddAccessCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return view('Access/City/AddAccessCity');
            }
        }
        return redirect('nain')->with('mes','Bạn không đủ quyền');
    }

    public function PostAddAccessCity(Request $request) {
        $username = $request->username;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $access = DB::table('access')->where('username', $username)->get();
        if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 2 || count($access) || !is_numeric($username)) {
            return redirect('addaccesscity')->with('mes','Thêm quyền thất bại');
        }
        DB::table('access')->insert(['username' => $username,'start_date' => $start_date, 'end_date' => $end_date]);
        return redirect('addaccesscity')->with('mes','Thêm quyền thành công');
    }

    public function ShowAccessCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $access = DB::table('access')->whereRaw('LENGTH(username) = 2')->get();
                return view('Access/City/ShowAccessCity',['access'=>$access]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function DeleteAccessCity(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                DB::table('access')->where('username', $request->username)->delete();
                return redirect('showaccesscity')->with('mes','Xóa quyền thành công');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetEditAccessCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return view('Access/City/EditAccessCity');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostEditAccessCity(Request $request) {
        $access = DB::table('access')->where('username', $request->username)->get();
        if (count($access) && strlen($request->username) == 2 && $request->start_date != "" && $request->end_date != "") {
            DB::table('access')->where('username', $request->username)->update(['start_date' => $request->start_date, 'end_date' => $request->end_date]);
            return redirect('editaccesscity')->with('mes','Sửa quyền thành công');
        }
        return redirect('editaccesscity')->with('mes','Sửa quyền thất bại');
    }

    //District Access 
    public function GetAddAccessDistrict() {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                $currentTime = Carbon::now();
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user)) {
                    return view('Access/District/AddAccessDistrict');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostAddAccessDistrict(Request $request) {
        $username = $request->username;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $city_id = substr($username,0,2);
        $access = DB::table('access')->where('username', $username)->get();
        if ($username == "" || $start_date == "" && $end_date == "" || strlen($username) != 4 || count($access) || !is_numeric($username) || $city_id != session('user')->username) {
            return redirect('addaccessdistrict')->with('mes','Thêm quyền thất bại');
        }
        DB::table('access')->insert(['username' => $username,'start_date' => $start_date, 'end_date' => $end_date]);
        return redirect('addaccessdistrict')->with('mes','Thêm quyền thành công');
    }

    public function ShowAccessDistrict() {
        if (session('user')) {
            $city_id = session('user')->username.'%';
            if (strlen(session('user')->username) == 2) {
                $access = DB::table('access')->whereRaw('LENGTH(username) = 4')->Where('username', 'like', $city_id)->get();
                return view('Access/District/ShowAccessDistrict',['access'=>$access]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function DeleteAccessDistrict(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                $currentTime = Carbon::now();
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user)) {
                    DB::table('access')->where('username', $request->username)->delete();
                    return redirect('showaccessdistrict')->with('mes','Xóa quyền thành công');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetEditAccessDistrict() {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                $currentTime = Carbon::now();
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user)) {
                    return view('Access/District/EditAccessDistrict');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostEditAccessDistrict(Request $request) {
        $city_id = session('user')->username.'%';
        $access = DB::table('access')->where('username', $request->username)->Where('username', 'like', $city_id)->get();
        if (count($access) && strlen($request->username) == 4 && $request->start_date != "" && $request->end_date != "") {
            DB::table('access')->where('username', $request->username)->update(['start_date' => $request->start_date, 'end_date' => $request->end_date]);
            return redirect('editaccessdistrict')->with('mes','Sửa quyền thành công');
        }
        return redirect('editaccessdistrict')->with('mes','Sửa quyền thất bại');
    }

    //Ward Access 
    public function GetAddAccessWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district)) {
                    return view('Access/Ward/AddAccessWard');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostAddAccessWard(Request $request) {
        $username = $request->username;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $district_id = substr($username,0,4);
        $access = DB::table('access')->where('username', $username)->get();
        if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 6 || count($access) || !is_numeric($username) || $district_id != session('user')->username) {
            return redirect('addaccessward')->with('mes','Thêm quyền thất bại');
        }
        DB::table('access')->insert(['username' => $username,'start_date' => $start_date, 'end_date' => $end_date]);
        return redirect('addaccessward')->with('mes','Thêm quyền thành công');
    }

    public function ShowAccessWard() {
        if (session('user')) {
            $district_id = session('user')->username.'%';
            if (strlen(session('user')->username) == 4) {
                $access = DB::table('access')->whereRaw('LENGTH(username) = 6')->Where('username', 'like', $district_id)->get();
                return view('Access/Ward/ShowAccessWard',['access'=>$access]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function DeleteAccessWard(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district)) {
                    DB::table('access')->where('username', $request->username)->delete();
                    return redirect('showaccessward')->with('mes','Xóa quyền thành công');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetEditAccessWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district)) {
                    return view('Access/Ward/EditAccessWard');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostEditAccessWard(Request $request) {
        $district_id = session('user')->username.'%';
        $access = DB::table('access')->where('username', $request->username)->Where('username', 'like', $district_id)->get();
        if (count($access) && strlen($request->username) == 6 && $request->start_date != "" && $request->end_date != "") {
            DB::table('access')->where('username', $request->username)->update(['start_date' => $request->start_date, 'end_date' => $request->end_date]);
            return redirect('editaccessward')->with('mes','Sửa quyền thành công');
        }
        return redirect('editaccessward')->with('mes','Sửa quyền thất bại');
    }

    //Village Access 
    public function GetAddAccessVillage() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $ward_username = substr(session('user')->username,0,4);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district) && count($user_ward)) {
                    return view('Access/Village/AddAccessVillage');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostAddAccessVillage(Request $request) {
        $username = $request->username;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $ward_id = substr($username,0,6);
        $access = DB::table('access')->where('username', $username)->get();
        if ($username == "" || $start_date == "" || $end_date == "" || strlen($username) != 8 || count($access) || !is_numeric($username) || $ward_id != session('user')->username) {
            return redirect('addaccessvillage')->with('mes','Thêm quyền thất bại');
        }
        DB::table('access')->insert(['username' => $username,'start_date' => $start_date, 'end_date' => $end_date]);
        return redirect('addaccessvillage')->with('mes','Thêm quyền thành công');
    }

    public function ShowAccessVillage() {
        if (session('user')) {
            $ward_id = session('user')->username.'%';
            if (strlen(session('user')->username) == 6) {
                $access = DB::table('access')->whereRaw('LENGTH(username) = 8')->Where('username', 'like', $ward_id)->get();
                return view('Access/Village/ShowAccessVillage',['access'=>$access]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function DeleteAccessVillage(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $ward_username = substr(session('user')->username,0,4);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district) && count($user_ward)) {
                    DB::table('access')->where('username', $request->username)->delete();
                    return redirect('showaccessvillage')->with('mes','Xóa quyền thành công');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetEditAccessVillage() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $ward_username = substr(session('user')->username,0,4);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district) && count($user_ward)) {
                    return view('Access/Village/EditAccessVillage');
                }
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostEditAccessVillage(Request $request) {
        $ward_id = session('user')->username.'%';
        $access = DB::table('access')->where('username', $request->username)->Where('username', 'like', $ward_id)->get();
        if (count($access) && strlen($request->username) == 8 && $request->start_date != "" && $request->end_date != "") {
            DB::table('access')->where('username', $request->username)->update(['start_date' => $request->start_date, 'end_date' => $request->end_date]);
            return redirect('editaccessvillage')->with('mes','Sửa quyền thành công');
        }
        return redirect('editaccessvillage')->with('mes','Sửa quyền thất bại');
    }
}
