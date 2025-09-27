<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoutingController extends Controller
{
    public function view_LoginPage($account_code)
    {
        $store = Store::where('account_code',$account_code)
        ->first();
        
        if (!$store) {
            abort(404);
        }
        return view('auth.loginpage', compact('store'));
    }

    public function view_SignUp($account_code)
    {
        $store = Store::where('account_code',$account_code)
        ->first();    

        if (!$store) {
            abort(404);
        }
        return view('auth.signuppage',compact('store'));
    }

    // ======================== DONE


}