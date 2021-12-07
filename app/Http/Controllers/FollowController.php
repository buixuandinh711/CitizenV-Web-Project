<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function ShowFollowCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $persontotal = DB::table('person')->select('city_id', DB::raw('count(*) as person_total'))->groupBy('city_id')->get();
                return view('Follow/ShowFollowCity',['persontotal'=>$persontotal]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function ShowFollowDistrict() {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                $persontotal = DB::table('person')->select('district_id', DB::raw('count(*) as person_total'))
                ->where('city_id',session('user')->username)->groupBy('district_id')->get();
                return view('Follow/ShowFollowDistrict',['persontotal'=>$persontotal]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function ShowFollowWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $persontotal = DB::table('person')->select('ward_id', DB::raw('count(*) as person_total'))
                ->where('district_id',session('user')->username)->groupBy('ward_id')->get();
                return view('Follow/ShowFollowWard',['persontotal'=>$persontotal]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function ShowFollowVillage() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $persontotal = DB::table('person')->select('village_id', DB::raw('count(*) as person_total'))
                ->where('ward_id',session('user')->username)->groupBy('village_id')->get();
                return view('Follow/ShowFollowVillage',['persontotal'=>$persontotal]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }
}
