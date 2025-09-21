<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoutingController extends Controller
{
    public function view_LoginPageSeller(){
        return view('auth.loginpageseller');
    }

    public function view_LoginPage(){
        return view('auth.loginpage');
    }
    public function view_SignUp(){
        return view('auth.signuppage');
    }


}