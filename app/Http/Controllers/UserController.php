<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function view_HomeUser($account_code)
    {
        $user   = Auth::user();
        $store = Store::where('account_code', $account_code)->first();

        if (!$store || $store->id !== $user->store_id) {
            abort(403, '404 No Access');
        }

        return view('dashboard.home-user', compact('user', 'store'));
    }


    // ======================== DONE

}