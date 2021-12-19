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
            return view('Main');
        }
        return redirect('login');
    }

    public function Logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('login');
    }
}
