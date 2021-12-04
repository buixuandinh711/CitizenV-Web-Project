<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonEachAreaController extends Controller
{
    //Person Each City
    public function ShowTotalPersonEachCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $persontotal = DB::table('person')->select('city_id', DB::raw('count(*) as person_total'))->groupBy('city_id')->get();
                return view('PersonEachArea/PersonEachCity/ShowTotalPersonEachCity',['persontotal'=>$persontotal]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetShowListPersonEachCity() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return view('PersonEachArea/PersonEachCity/ShowListPersonEachCity');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostShowListPersonEachCity(Request $request) {
        $person = DB::table('person')->where('city_id',$request->city_id)->get();
        return view('PersonEachArea/PersonEachCity/ShowListPersonEachCity',['person'=>$person]);
    }

    //Person Each District
    public function ShowTotalPersonEachDistrict() {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                $persontotal = DB::table('person')->select('district_id', DB::raw('count(*) as person_total'))->where('city_id',session('user')->username)->groupBy('district_id')->get();
                return view('PersonEachArea/PersonEachDistrict/ShowTotalPersonEachDistrict',['persontotal'=>$persontotal]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetShowListPersonEachDistrict() {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                return view('PersonEachArea/PersonEachDistrict/ShowListPersonEachDistrict');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostShowListPersonEachDistrict(Request $request) {
        $person = DB::table('person')->where('district_id',$request->district_id)->where('city_id',session('user')->username)->get();
        return view('PersonEachArea/PersonEachDistrict/ShowListPersonEachDistrict',['person'=>$person]);
    }

    //Person Each Ward
    public function ShowTotalPersonEachWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $persontotal = DB::table('person')->select('ward_id', DB::raw('count(*) as person_total'))->where('district_id',session('user')->username)->groupBy('ward_id')->get();
                return view('PersonEachArea/PersonEachWard/ShowTotalPersonEachWard',['persontotal'=>$persontotal]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetShowListPersonEachWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                return view('PersonEachArea/PersonEachWard/ShowListPersonEachWard');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostShowListPersonEachWard(Request $request) {
        $person = DB::table('person')->where('ward_id',$request->ward_id)->where('district_id',session('user')->username)->get();
        return view('PersonEachArea/PersonEachWard/ShowListPersonEachWard',['person'=>$person]);
    }

    //Person Each Village
    public function ShowTotalPersonEachVillage() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $persontotal = DB::table('person')->select('village_id', DB::raw('count(*) as person_total'))->where('ward_id',session('user')->username)->groupBy('village_id')->get();
                return view('PersonEachArea/PersonEachVillage/ShowTotalPersonEachVillage',['persontotal'=>$persontotal]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetShowListPersonEachVillage() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                return view('PersonEachArea/PersonEachVillage/ShowListPersonEachVillage');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostShowListPersonEachVillage(Request $request) {
        $person = DB::table('person')->where('village_id',$request->village_id)->where('ward_id',session('user')->username)->get();
        return view('PersonEachArea/PersonEachVillage/ShowListPersonEachVillage',['person'=>$person]);
    }
}
