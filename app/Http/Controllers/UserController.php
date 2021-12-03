<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function ShowLogin() {
        return view('Login');
    }

    public function CheckLogin(Request $request) {
        $username = $request['username'];
        $password = $request['password'];
        $user = DB::table('users')->where('username', $username)->where('password', $password)->get();
        if (count($user)) {
            $request->session()->put('user', $user[0]);
            return redirect('Main');
        } else {
            return view('Login',['err'=>"Đăng nhập thất bại"]);
        }
    }

    public function Logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('Login');
    }

    //City User 
    public function GetAddUserCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return view('User/City/AddUserCity');
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function PostAddUSerCity(Request $request) {
        $username = $request->username;
        $password = $request->password;
        $user = DB::table('users')->where('username', $username)->get();
        if ($username == "" || $password == "" || strlen($username) != 2 || count($user) || !is_numeric($username)) {
            return redirect('AddUserCity')->with('mes','Thêm tài khoản thất bại');
        }
        DB::table('users')->insert(['username' => $username,'password' => $password]);
        return redirect('AddUserCity')->with('mes','Thêm tài khoản thành công');
    }

    public function ShowUSerCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $user = DB::table('users')->whereRaw('LENGTH(username) = 2')->get();
                return view('User/City/ShowUserCity',['user'=>$user]);
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function DeleteUserCity(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                DB::table('users')->where('username', $request->username)->delete();
                return redirect('ShowUserCity')->with('mes','Xóa tài khoản thành công');
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function GetEditUserCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return view('User/City/EditUserCity');
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function PostEditUserCity(Request $request) {
        $user = DB::table('users')->where('username', $request->username)->get();
        if (count($user) && strlen($request->username) == 2 && $request->password != "") {
            DB::table('users')->where('username', $request->username)->update(['password' => $request->password]);
            return redirect('EditUserCity')->with('mes','Sửa tài khoản thành công');
        }
        return redirect('EditUserCity')->with('mes','Sửa tài khoản thất bại');
    }

    //District User 
    public function GetAddUserDistrict() {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                $currentTime = Carbon::now();
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user)) {
                    return view('User/District/AddUserDistrict');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function PostAddUSerDistrict(Request $request) {
        $username = $request->username;
        $password = $request->password;
        $city_id = substr($username,0,2);
        $user = DB::table('users')->where('username', $username)->get();
        if ($username == "" || $password == "" || strlen($username) != 4 || count($user) || !is_numeric($username) || $city_id != session('user')->username) {
            return redirect('AddUserDistrict')->with('mes','Thêm tài khoản thất bại');
        }
        DB::table('users')->insert(['username' => $username,'password' => $password]);
        return redirect('AddUserDistrict')->with('mes','Thêm tài khoản thành công');
    }

    public function ShowUSerDistrict() {
        if (session('user')) {
            $city_id = session('user')->username.'%';
            if (strlen(session('user')->username) == 2) {
                $user = DB::table('users')->whereRaw('LENGTH(username) = 4')->Where('username', 'like', $city_id)->get();
                return view('User/District/ShowUserDistrict',['user'=>$user]);
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function DeleteUserDistrict(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                $currentTime = Carbon::now();
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user)) {
                    DB::table('users')->where('username', $request->username)->delete();
                    return redirect('ShowUserDistrict')->with('mes','Xóa tài khoản thành công');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function GetEditUserDistrict() {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                $currentTime = Carbon::now();
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user)) {
                    return view('User/District/EditUserDistrict');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function PostEditUserDistrict(Request $request) {
        $city_id = session('user')->username.'%';
        $user = DB::table('users')->where('username', $request->username)->Where('username', 'like', $city_id)->get();
        if (count($user) && strlen($request->username) == 4 && $request->password != "") {
            DB::table('users')->where('username', $request->username)->update(['password' => $request->password]);
            return redirect('EditUserDistrict')->with('mes','Sửa tài khoản thành công');
        }
        return redirect('EditUserDistrict')->with('mes','Sửa tài khoản thất bại');
    }

    //Ward User 
    public function GetAddUserWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district)) {
                    return view('User/Ward/AddUserWard');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function PostAddUSerWard(Request $request) {
        $username = $request->username;
        $password = $request->password;
        $district_id = substr($username,0,4);
        $user = DB::table('users')->where('username', $username)->get();
        if ($username == "" || $password == "" || strlen($username) != 6 || count($user) || !is_numeric($username) || $district_id != session('user')->username) {
            return redirect('AddUserWard')->with('mes','Thêm tài khoản thất bại');
        }
        DB::table('users')->insert(['username' => $username,'password' => $password]);
        return redirect('AddUserWard')->with('mes','Thêm tài khoản thành công');
    }

    public function ShowUSerWard() {
        if (session('user')) {
            $district_id = session('user')->username.'%';
            if (strlen(session('user')->username) == 4) {
                $user = DB::table('users')->whereRaw('LENGTH(username) = 6')->Where('username', 'like', $district_id)->get();
                return view('User/Ward/ShowUserWard',['user'=>$user]);
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function DeleteUserWard(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district)) {
                    DB::table('users')->where('username', $request->username)->delete();
                    return redirect('ShowUserWard')->with('mes','Xóa tài khoản thành công');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function GetEditUserWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district)) {
                    return view('User/Ward/EditUserWard');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function PostEditUserWard(Request $request) {
        $district_id = session('user')->username.'%';
        $user = DB::table('users')->where('username', $request->username)->Where('username', 'like', $district_id)->get();
        if (count($user) && strlen($request->username) == 6 && $request->password != "") {
            DB::table('users')->where('username', $request->username)->update(['password' => $request->password]);
            return redirect('EditUserWard')->with('mes','Sửa tài khoản thành công');
        }
        return redirect('EditUserWard')->with('mes','Sửa tài khoản thất bại');
    }

    //Village User 
    public function GetAddUserVillage() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $ward_username = substr(session('user')->username,0,4);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district) && count($user_ward)) {
                    return view('User/Village/AddUserVillage');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function PostAddUSerVillage(Request $request) {
        $username = $request->username;
        $password = $request->password;
        $ward_id = substr($username,0,6);
        $user = DB::table('users')->where('username', $username)->get();
        if ($username == "" || $password == "" || strlen($username) != 8 || count($user) || !is_numeric($username) || $ward_id != session('user')->username) {
            return redirect('AddUserVillage')->with('mes','Thêm tài khoản thất bại');
        }
        DB::table('users')->insert(['username' => $username,'password' => $password]);
        return redirect('AddUserVillage')->with('mes','Thêm tài khoản thành công');
    }

    public function ShowUSerVillage() {
        if (session('user')) {
            $ward_id = session('user')->username.'%';
            if (strlen(session('user')->username) == 6) {
                $user = DB::table('users')->whereRaw('LENGTH(username) = 8')->Where('username', 'like', $ward_id)->get();
                return view('User/Village/ShowUserVillage',['user'=>$user]);
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function DeleteUserVillage(Request $request) {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $ward_username = substr(session('user')->username,0,4);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district) && count($user_ward)) {
                    DB::table('users')->where('username', $request->username)->delete();
                    return redirect('ShowUserVillage')->with('mes','Xóa tài khoản thành công');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function GetEditUserVillage() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $currentTime = Carbon::now();
                $district_username = substr(session('user')->username,0,2);
                $ward_username = substr(session('user')->username,0,4);
                $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)->where('end_date','>=',$currentTime)->get();
                if (count($user) && count($user_district) && count($user_ward)) {
                    return view('User/Village/EditUserVillage');
                }
            }
        }
        return redirect('Main')->with('mes','Bạn không đủ quyền');
    }

    public function PostEditUserVillage(Request $request) {
        $ward_id = session('user')->username.'%';
        $user = DB::table('users')->where('username', $request->username)->Where('username', 'like', $ward_id)->get();
        if (count($user) && strlen($request->username) == 8 && $request->password != "") {
            DB::table('users')->where('username', $request->username)->update(['password' => $request->password]);
            return redirect('EditUserVillage')->with('mes','Sửa tài khoản thành công');
        }
        return redirect('EditUserVillage')->with('mes','Sửa tài khoản thất bại');
    }
}