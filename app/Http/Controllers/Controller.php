<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function ShowUser() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return redirect('showusercity');
            } else if (strlen(session('user')->username) == 2) {
                return redirect('showuserdistrict');
            } else if (strlen(session('user')->username) == 4) {
                return redirect('showuserward');
            } else if (strlen(session('user')->username) == 6) {
                return redirect('showuservillage');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function ShowDeclare() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return redirect('showdeclarecity');
            } else if (strlen(session('user')->username) == 2) {
                return redirect('showdeclaredistrict');
            } else if (strlen(session('user')->username) == 4) {
                return redirect('showdeclareward');
            } else if (strlen(session('user')->username) == 6) {
                return redirect('showdeclarevillage');
            } else if (strlen(session('user')->username) == 8) {
                return redirect('showdeclareperson');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function ShowAccess() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return redirect('showaccesscity');
            } else if (strlen(session('user')->username) == 2) {
                return redirect('showaccessdistrict');
            } else if (strlen(session('user')->username) == 4) {
                return redirect('showaccessward');
            } else if (strlen(session('user')->username) == 6) {
                return redirect('showaccessvillage');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function ShowListPerson() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return redirect('showlistpersonall');
            } else if (strlen(session('user')->username) == 2) {
                return redirect('showlistpersoncity');
            } else if (strlen(session('user')->username) == 4) {
                return redirect('showlistpersondistrict');
            } else if (strlen(session('user')->username) == 6) {
                return redirect('showlistpersonward');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }

    public function ShowFollow() {
        if (session('user')) {
            if (session('user')->username == 'admin') {
                return redirect('showfollowcity');
            } else if (strlen(session('user')->username) == 2) {
                return redirect('showfollowdistrict');
            } else if (strlen(session('user')->username) == 4) {
                return redirect('showfollowward');
            } else if (strlen(session('user')->username) == 6) {
                return redirect('showfollowvillage');
            }
        }
        return redirect('main')->with('mes','Bạn không đủ quyền');
    }
}
