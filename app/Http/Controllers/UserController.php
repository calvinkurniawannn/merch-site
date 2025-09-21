<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function view_HomeUser()
    {
        $user = Auth::user();
        
        return view('dashboard.home-user',compact('user'));
    }

 
}