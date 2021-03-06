<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    public function ShowLogin() {
        return view('login');
    }

    public function CheckLogin(Request $request) {
        $username = $request['username'];
        $password = $request['password'];
        $user = DB::table('users')->where('username', $username)->where('password', $password)->first();
        if ($user) {
            $request->session()->put('user', $user);
            return redirect('main');
        } else {
            return redirect('login')->with('mes','Đăng nhập thất bại');
        }
    }

    public function ShowMain() {
        if (session('user')) {
            if (strlen(session('user')->username) != 8) {
                return view('Main');
            } else {
                return view('mains');
            }
        }
        return redirect('login');
    }

    public function Logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->forget('id');
        return redirect('login');
    }

    public function DeclareLocation() {
        if (session('user')) {
            if (strlen(session('user')->username) != 8) {
                return view('declarelocation');
            } else {
                return redirect('main');
            }
        }
        return redirect('login');
    }

    public function DeclareAccount() {
        if (session('user')) {
            if (strlen(session('user')->username) != 8) {
                return view('declareaccount');
            } else {
                return redirect('main');
            }
        }
        return redirect('login');
    }

    public function GrantPermission() {
        if (session('user')) {
            if (strlen(session('user')->username) != 8) {
                return view('grantpermission');
            } else {
                return redirect('main');
            }
        }
        return redirect('login');
    }

    public function AddCitizen() {
        if (session('user')) {
            if (strlen(session('user')->username) == 8) {
                return view('addcitizen');
            } else {
                return redirect('main');
            }
        }
        return redirect('login');
    }

    public function ListCitizen() {
        if (session('user')) {
            if (strlen(session('user')->username) == 8) {
                return view('listcitizens');
            } else if (strlen(session('user')->username) != 8) {
                return view('listcitizen');
            }
        }
        return redirect('login');
    }

    public function DeclareStatus() {
        if (session('user')) {
            if (strlen(session('user')->username) != 8) {
                return view('declarestatus');
            } else {
                return redirect('main');
            }
        }
        return redirect('login');
    }

    public function CitizenInfo() {
        if (session('user')) {
            if (strlen(session('user')->username) != 8) {
                return view('citizeninfo');
            } else {
                return view('citizeninfos');
            }
        }
        return redirect('login');
    }

    public function InfoCitizen() {
        if (session('user')) {
            if (strlen(session('user')->username) != 8) {
                return view('infocitizen');
            }
        }
        return redirect('login');
    }

    public function GeneralInfo() {
        if (session('user')) {
            if (strlen(session('user')->username) != 8) {
                return view('generalinfo');
            }
        }
        return redirect('login');
    }

    public function ModifyPassword() {
        if (session('user')) {
            if (strlen(session('user')->username) != 8) {
                return view('modifypassword');
            } else {
                return view('modifypasswords');
            }
        }
        return redirect('login');
    }
}
