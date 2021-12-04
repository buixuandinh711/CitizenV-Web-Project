<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonAreaController extends Controller
{
    //Person All
    public function ShowListPersonAll() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $person = DB::table('person')->get();
                return view('PersonArea/PersonAll/ShowListPersonAll',['person'=>$person]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function ShowTotalPersonALL() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                $total = DB::table('person')->count();
                return view('PersonArea/PersonAll/ShowTotalPersonAll',['total'=>$total]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetShowInfoPersonALL() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return view('PersonArea/PersonAll/ShowInfoPersonAll');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostShowInfoPersonALL(Request $request) {
        $person = DB::table('person')->where('person_id',$request->person_id)->first();
        return view('PersonArea/PersonAll/ShowInfoPersonAll',['person'=>$person]);
    }

    //Person City
    public function ShowListPersonCity() {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                $person = DB::table('person')->where('city_id',session('user')->username)->get();
                return view('PersonArea/PersonCity/ShowListPersonCity',['person'=>$person]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function ShowTotalPersonCity() {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                $total = DB::table('person')->where('city_id',session('user')->username)->count();
                return view('PersonArea/PersonCity/ShowTotalPersonCity',['total'=>$total]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetShowInfoPersonCity() {
        if (session('user')) {
            if (strlen(session('user')->username) == 2) {
                return view('PersonArea/PersonCity/ShowInfoPersonCity');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostShowInfoPersonCity(Request $request) {
        $person = DB::table('person')->where('person_id',$request->person_id)->where('city_id',session('user')->username)->first();
        return view('PersonArea/PersonCity/ShowInfoPersonCity',['person'=>$person]);
    }

    //Person District
    public function ShowListPersonDistrict() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $person = DB::table('person')->where('district_id',session('user')->username)->get();
                return view('PersonArea/PersonDistrict/ShowListPersonDistrict',['person'=>$person]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function ShowTotalPersonDistrict() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                $total = DB::table('person')->where('district_id',session('user')->username)->count();
                return view('PersonArea/PersonDistrict/ShowTotalPersonDistrict',['total'=>$total]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetShowInfoPersonDistrict() {
        if (session('user')) {
            if (strlen(session('user')->username) == 4) {
                return view('PersonArea/PersonDistrict/ShowInfoPersonDistrict');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostShowInfoPersonDistrict(Request $request) {
        $person = DB::table('person')->where('person_id',$request->person_id)->where('district_id',session('user')->username)->first();
        return view('PersonArea/PersonDistrict/ShowInfoPersonDistrict',['person'=>$person]);
    }

    //Person Ward
    public function ShowListPersonWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $person = DB::table('person')->where('ward_id',session('user')->username)->get();
                return view('PersonArea/PersonWard/ShowListPersonWard',['person'=>$person]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function ShowTotalPersonWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                $total = DB::table('person')->where('ward_id',session('user')->username)->count();
                return view('PersonArea/PersonWard/ShowTotalPersonWard',['total'=>$total]);
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function GetShowInfoPersonWard() {
        if (session('user')) {
            if (strlen(session('user')->username) == 6) {
                return view('PersonArea/PersonWard/ShowInfoPersonWard');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function PostShowInfoPersonWard(Request $request) {
        $person = DB::table('person')->where('person_id',$request->person_id)->where('ward_id',session('user')->username)->first();
        return view('PersonArea/PersonWard/ShowInfoPersonWard',['person'=>$person]);
    }
}
