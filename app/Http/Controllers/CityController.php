<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function GetAddDeclareCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return view('Declare/City/AddDeclareCity');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostAddDeclareCity(Request $request) {
        $city_id = $request->city_id;
        $city_name = $request->city_name;
        $city = DB::table('city')->where('city_id', $city_id)->get();
        if ($city_id == "" || $city_name == "" || strlen($city_id) != 2 || count($city) || !is_numeric($city_id)) {
            return redirect('adddeclarecity')->with('mes','Thêm thành phố thất bại');
        }
        DB::table('city')->insert(['city_id' => $city_id,'city_name' => $city_name]);
        return redirect('adddeclarecity')->with('mes','Thêm thành phố thành công');
    }

    public function ShowDeclareCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $city = DB::table('city')->get();
                return view('Declare/City/ShowDeclareCity',['city'=>$city]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function DeleteDeclareCity(Request $request) {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                DB::table('city')->where('city_id', $request->city_id)->delete();
                return redirect('showdeclarecity')->with('mes','Xóa thành phố thành công');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetEditDeclareCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return view('Declare/City/EditDeclareCity');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostEditDeclareCity(Request $request) {
        $city = DB::table('city')->where('city_id', $request->city_id)->get();
        if (count($city) && $request->city_name != "") {
            DB::table('city')->where('city_id', $request->city_id)->update(['city_name' => $request->city_name]);
            return redirect('editdeclarecity')->with('mes','Sửa thành phố thành công');
        }
        return redirect('editdeclarecity')->with('mes','Sửa thành phố thất bại');
    }
}
