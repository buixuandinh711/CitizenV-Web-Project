<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function AddNewUser(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $success = ['resp' => 'success'];
                $error = ['resp' => 'error']; 
                $username = $request->username;
                $password = $request->password;
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || $password == "" || strlen($username) != 2 || count($user) || !ctype_digit($username)) {
                    return response()->json($error);
                }
                DB::table('users')->insert(['username' => $username,'password' => $password]);
                return response()->json($success);
            } else if (strlen(session('user')->username) == 2) {   
                $success = ['resp' => 'success'];
                $error = ['resp' => 'error']; 
                $username = $request->username;
                $password = $request->password;
                $city_id = substr(session('user')->username,0,2);
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || $password == "" || strlen($username) != 4 || count($user) || !ctype_digit($username) || 
                    session('user')->username != $city_id) {
                    return response()->json($error);
                }
                DB::table('users')->insert(['username' => $username,'password' => $password]);
                return response()->json($success);
            } else if (strlen(session('user')->username) == 4) {   
                $success = ['resp' => 'success'];
                $error = ['resp' => 'error']; 
                $username = $request->username;
                $password = $request->password;
                $district_id = substr(session('user')->username,0,4);
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || $password == "" || strlen($username) != 6 || count($user) || !ctype_digit($username) || 
                    session('user')->username != $district_id) {
                    return response()->json($error);
                }
                DB::table('users')->insert(['username' => $username,'password' => $password]);
                return response()->json($success);
            } else if (strlen(session('user')->username) == 6) {   
                $success = ['resp' => 'success'];
                $error = ['resp' => 'error']; 
                $username = $request->username;
                $password = $request->password;
                $ward_id = substr(session('user')->username,0,6);
                $user = DB::table('users')->where('username', $username)->get();
                if ($username == "" || $password == "" || strlen($username) != 8 || count($user) || !ctype_digit($username) || 
                    session('user')->username != $ward_id) {
                    return response()->json($error);
                }
                DB::table('users')->insert(['username' => $username,'password' => $password]);
                return response()->json($success);
            }
        }
    }

    public function AccountLocationInfo() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $result = ['name' => 'cả nước', 'code' => 'admin', 'accountLocation' => [], 'noAccountLocation' => []];
                $userlocation = DB::table('city')->leftjoin('users', 'city.city_id', '=', 'users.username')->selectraw('city.city_id as code')
                ->selectraw('city.city_name as name')->whereraw('users.username is not null')->get();
                $nouserlocation = DB::table('city')->leftjoin('users', 'city.city_id', '=', 'users.username')->selectraw('city.city_id as code')
                ->selectraw('city.city_name as name')->whereraw('users.username is null')->get();
                $result['accountLocation'] = $userlocation;
                $result['noAccountLocation'] = $nouserlocation;
                return response()->json($result);
            } else if (strlen(session('user')->username) == 2) {
                $result = ['name' => '', 'code' => '', 'accountLocation' => [], 'noAccountLocation' => []];
                $city = DB::table('city')->where('city_id', session('user')->username)->first();
                $result['name'] = $city->city_name;
                $result['code'] = $city->city_id;
                $userlocation = DB::table('district')->leftjoin('users', 'district.district_id', '=', 'users.username')
                ->selectraw('district.district_id as code')->selectraw('district.district_name as name')
                ->whereraw('users.username is not null')->where('city_id',session('user')->username)->get();
                $nouserlocation = DB::table('district')->leftjoin('users', 'district.district_id', '=', 'users.username')
                ->selectraw('district.district_id as code')->selectraw('district.district_name as name')
                ->whereraw('users.username is null')->where('city_id',session('user')->username)->get();
                $result['accountLocation'] = $userlocation;
                $result['noAccountLocation'] = $nouserlocation;
                return response()->json($result);
            } else if (strlen(session('user')->username) == 4) {
                $result = ['name' => '', 'code' => '', 'accountLocation' => [], 'noAccountLocation' => []];
                $district = DB::table('district')->where('district_id', session('user')->username)->first();
                $result['name'] = $district->district_name;
                $result['code'] = $district->district_id;
                $userlocation = DB::table('ward')->leftjoin('users', 'ward.ward_id', '=', 'users.username')
                ->selectraw('ward.ward_id as code')->selectraw('ward.ward_name as name')
                ->whereraw('users.username is not null')->where('district_id',session('user')->username)->get();
                $nouserlocation = DB::table('ward')->leftjoin('users', 'ward.ward_id', '=', 'users.username')
                ->selectraw('ward.ward_id as code')->selectraw('ward.ward_name as name')
                ->whereraw('users.username is null')->where('district_id',session('user')->username)->get();
                $result['accountLocation'] = $userlocation;
                $result['noAccountLocation'] = $nouserlocation;
                return response()->json($result);
            } else if (strlen(session('user')->username) == 6) {
                $result = ['name' => '', 'code' => '', 'accountLocation' => [], 'noAccountLocation' => []];
                $ward = DB::table('ward')->where('ward_id', session('user')->username)->first();
                $result['name'] = $ward->ward_name;
                $result['code'] = $ward->ward_id;
                $userlocation = DB::table('village')->leftjoin('users', 'village.village_id', '=', 'users.username')
                ->selectraw('village.village_id as code')->selectraw('village.village_name as name')
                ->whereraw('users.username is not null')->where('ward_id',session('user')->username)->get();
                $nouserlocation = DB::table('village')->leftjoin('users', 'village.village_id', '=', 'users.username')
                ->selectraw('village.village_id as code')->selectraw('village.village_name as name')
                ->whereraw('users.username is null')->where('ward_id',session('user')->username)->get();
                $result['accountLocation'] = $userlocation;
                $result['noAccountLocation'] = $nouserlocation;
                return response()->json($result);
            }
        }
    }

    // public function ShowInfoUser() {
    //     if (session('user')) {
    //         if (session('user')->username == 'admin') {
    //             $user = DB::table('users')->leftjoin('city', 'city.city_id', '=', 'users.username')
    //             ->select('users.username')->selectRaw('city.city_name AS local_name')
    //             ->where('users.username','admin')->first();
    //             $user->local_name = 'Tổng cục';
    //             return view('User/ShowInfoUser',['user'=>$user]);
    //         } else if (strlen(session('user')->username) == 2) {   
    //             $user = DB::table('users')->join('city', 'city.city_id', '=', 'users.username')
    //             ->select('users.username')->selectRaw('city.city_name AS local_name')
    //             ->where('users.username',session('user')->username)->first();
    //             return view('User/ShowInfoUser',['user'=>$user]);
    //         } else if (strlen(session('user')->username) == 4) {   
    //             $user = DB::table('users')->join('district', 'district.district_id', '=', 'users.username')
    //             ->select('users.username')->selectRaw('district.district_name AS local_name')
    //             ->where('users.username',session('user')->username)->first();
    //             return view('User/ShowInfoUser',['user'=>$user]);
    //         } else if (strlen(session('user')->username) == 6) {   
    //             $user = DB::table('users')->join('ward', 'ward.ward_id', '=', 'users.username')
    //             ->select('users.username')->selectRaw('ward.ward_name AS local_name')
    //             ->where('users.username',session('user')->username)->first();
    //             return view('User/ShowInfoUser',['user'=>$user]);
    //         } else if (strlen(session('user')->username) == 8) {   
    //             $user = DB::table('users')->join('village', 'village.village_id', '=', 'users.username')
    //             ->select('users.username')->selectRaw('village.village_name AS local_name')
    //             ->where('users.username',session('user')->username)->first();
    //             return view('User/ShowInfoUser',['user'=>$user]);
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // //City User 
    // public function GetAddUserCity() {
    //     if (session('user')) {
    //         if (session('user')->username == 'admin') {
    //             return view('User/City/AddUserCity');
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostAddUSerCity(Request $request) {
    //     $username = $request->username;
    //     $password = $request->password;
    //     $user = DB::table('users')->where('username', $username)->get();
    //     if ($username == "" || $password == "" || strlen($username) != 2 || count($user) || !ctype_digit($username)) {
    //         return redirect('addusercity')->with('mes','Thêm tài khoản thất bại');
    //     }
    //     DB::table('users')->insert(['username' => $username,'password' => $password]);
    //     return redirect('addusercity')->with('mes','Thêm tài khoản thành công');
    // }

    // public function ShowUSerCity() {
    //     if (session('user')) {
    //         if (session('user')->username == 'admin') {
    //             $user = DB::table('users')->whereRaw('LENGTH(username) = 2')->get();
    //             return view('User/City/ShowUserCity',['user'=>$user]);
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function DeleteUserCity(Request $request) {
    //     if (session('user')) {
    //         if (session('user')->username == 'admin') {
    //             DB::table('users')->where('username', $request->username)->delete();
    //             return redirect('showusercity')->with('mes','Xóa tài khoản thành công');
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function GetEditUserCity() {
    //     if (session('user')) {
    //         if (session('user')->username == 'admin') {
    //             return view('User/City/EditUserCity');
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostEditUserCity(Request $request) {
    //     $user = DB::table('users')->where('username', $request->username)->get();
    //     if (count($user) && strlen($request->username) == 2 && $request->password != "") {
    //         DB::table('users')->where('username', $request->username)->update(['password' => $request->password]);
    //         return redirect('editusercity')->with('mes','Sửa tài khoản thành công');
    //     }
    //     return redirect('editusercity')->with('mes','Sửa tài khoản thất bại');
    // }

    // //District User 
    // public function GetAddUserDistrict() {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 2) {
    //             $currentTime = Carbon::now();
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user)) {
    //                 return view('User/District/AddUserDistrict');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostAddUSerDistrict(Request $request) {
    //     $username = $request->username;
    //     $password = $request->password;
    //     $city_id = substr($username,0,2);
    //     $user = DB::table('users')->where('username', $username)->get();
    //     if ($username == "" || $password == "" || strlen($username) != 4 || count($user) || !ctype_digit($username) || 
    //         $city_id != session('user')->username) {
    //         return redirect('adduserdistrict')->with('mes','Thêm tài khoản thất bại');
    //     }
    //     DB::table('users')->insert(['username' => $username,'password' => $password]);
    //     return redirect('adduserdistrict')->with('mes','Thêm tài khoản thành công');
    // }

    // public function ShowUSerDistrict() {
    //     if (session('user')) {
    //         $city_id = session('user')->username.'%';
    //         if (strlen(session('user')->username) == 2) {
    //             $user = DB::table('users')->whereRaw('LENGTH(username) = 4')->Where('username', 'like', $city_id)->get();
    //             return view('User/District/ShowUserDistrict',['user'=>$user]);
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function DeleteUserDistrict(Request $request) {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 2) {
    //             $currentTime = Carbon::now();
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user)) {
    //                 DB::table('users')->where('username', $request->username)->delete();
    //                 return redirect('showuserdistrict')->with('mes','Xóa tài khoản thành công');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function GetEditUserDistrict() {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 2) {
    //             $currentTime = Carbon::now();
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user)) {
    //                 return view('User/District/EditUserDistrict');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostEditUserDistrict(Request $request) {
    //     $city_id = session('user')->username.'%';
    //     $user = DB::table('users')->where('username', $request->username)->Where('username', 'like', $city_id)->get();
    //     if (count($user) && strlen($request->username) == 4 && $request->password != "") {
    //         DB::table('users')->where('username', $request->username)->update(['password' => $request->password]);
    //         return redirect('edituserdistrict')->with('mes','Sửa tài khoản thành công');
    //     }
    //     return redirect('edituserdistrict')->with('mes','Sửa tài khoản thất bại');
    // }

    // //Ward User 
    // public function GetAddUserWard() {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 4) {
    //             $currentTime = Carbon::now();
    //             $district_username = substr(session('user')->username,0,2);
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user) && count($user_district)) {
    //                 return view('User/Ward/AddUserWard');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostAddUSerWard(Request $request) {
    //     $username = $request->username;
    //     $password = $request->password;
    //     $district_id = substr($username,0,4);
    //     $user = DB::table('users')->where('username', $username)->get();
    //     if ($username == "" || $password == "" || strlen($username) != 6 || count($user) || !ctype_digit($username) || 
    //         $district_id != session('user')->username) {
    //         return redirect('adduserward')->with('mes','Thêm tài khoản thất bại');
    //     }
    //     DB::table('users')->insert(['username' => $username,'password' => $password]);
    //     return redirect('adduserward')->with('mes','Thêm tài khoản thành công');
    // }

    // public function ShowUSerWard() {
    //     if (session('user')) {
    //         $district_id = session('user')->username.'%';
    //         if (strlen(session('user')->username) == 4) {
    //             $user = DB::table('users')->whereRaw('LENGTH(username) = 6')->Where('username', 'like', $district_id)->get();
    //             return view('User/Ward/ShowUserWard',['user'=>$user]);
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function DeleteUserWard(Request $request) {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 4) {
    //             $currentTime = Carbon::now();
    //             $district_username = substr(session('user')->username,0,2);
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user) && count($user_district)) {
    //                 DB::table('users')->where('username', $request->username)->delete();
    //                 return redirect('showuserward')->with('mes','Xóa tài khoản thành công');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function GetEditUserWard() {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 4) {
    //             $currentTime = Carbon::now();
    //             $district_username = substr(session('user')->username,0,2);
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user) && count($user_district)) {
    //                 return view('User/Ward/EditUserWard');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostEditUserWard(Request $request) {
    //     $district_id = session('user')->username.'%';
    //     $user = DB::table('users')->where('username', $request->username)->Where('username', 'like', $district_id)->get();
    //     if (count($user) && strlen($request->username) == 6 && $request->password != "") {
    //         DB::table('users')->where('username', $request->username)->update(['password' => $request->password]);
    //         return redirect('edituserward')->with('mes','Sửa tài khoản thành công');
    //     }
    //     return redirect('edituserward')->with('mes','Sửa tài khoản thất bại');
    // }

    // //Village User 
    // public function GetAddUserVillage() {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 6) {
    //             $currentTime = Carbon::now();
    //             $district_username = substr(session('user')->username,0,2);
    //             $ward_username = substr(session('user')->username,0,4);
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user) && count($user_district) && count($user_ward)) {
    //                 return view('User/Village/AddUserVillage');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostAddUSerVillage(Request $request) {
    //     $username = $request->username;
    //     $password = $request->password;
    //     $ward_id = substr($username,0,6);
    //     $user = DB::table('users')->where('username', $username)->get();
    //     if ($username == "" || $password == "" || strlen($username) != 8 || count($user) || !ctype_digit($username) || 
    //         $ward_id != session('user')->username) {
    //         return redirect('adduservillage')->with('mes','Thêm tài khoản thất bại');
    //     }
    //     DB::table('users')->insert(['username' => $username,'password' => $password]);
    //     return redirect('adduservillage')->with('mes','Thêm tài khoản thành công');
    // }

    // public function ShowUSerVillage() {
    //     if (session('user')) {
    //         $ward_id = session('user')->username.'%';
    //         if (strlen(session('user')->username) == 6) {
    //             $user = DB::table('users')->whereRaw('LENGTH(username) = 8')->Where('username', 'like', $ward_id)->get();
    //             return view('User/Village/ShowUserVillage',['user'=>$user]);
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function DeleteUserVillage(Request $request) {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 6) {
    //             $currentTime = Carbon::now();
    //             $district_username = substr(session('user')->username,0,2);
    //             $ward_username = substr(session('user')->username,0,4);
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user) && count($user_district) && count($user_ward)) {
    //                 DB::table('users')->where('username', $request->username)->delete();
    //                 return redirect('showuservillage')->with('mes','Xóa tài khoản thành công');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function GetEditUserVillage() {
    //     if (session('user')) {
    //         if (strlen(session('user')->username) == 6) {
    //             $currentTime = Carbon::now();
    //             $district_username = substr(session('user')->username,0,2);
    //             $ward_username = substr(session('user')->username,0,4);
    //             $user = DB::table('access')->where('username',session('user')->username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_district = DB::table('access')->where('username',$district_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             $user_ward = DB::table('access')->where('username',$ward_username)->where('start_date','<=',$currentTime)
    //             ->where('end_date','>=',$currentTime)->get();
    //             if (count($user) && count($user_district) && count($user_ward)) {
    //                 return view('User/Village/EditUserVillage');
    //             }
    //         }
    //     }
    //     return redirect('main')->with('mes','Bạn không đủ quyền');
    // }

    // public function PostEditUserVillage(Request $request) {
    //     $ward_id = session('user')->username.'%';
    //     $user = DB::table('users')->where('username', $request->username)->Where('username', 'like', $ward_id)->get();
    //     if (count($user) && strlen($request->username) == 8 && $request->password != "") {
    //         DB::table('users')->where('username', $request->username)->update(['password' => $request->password]);
    //         return redirect('edituservillage')->with('mes','Sửa tài khoản thành công');
    //     }
    //     return redirect('edituservillage')->with('mes','Sửa tài khoản thất bại');
    // }
}