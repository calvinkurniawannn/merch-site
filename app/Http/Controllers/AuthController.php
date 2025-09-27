<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
        'store_id' => 'integer|exists:stores,id',
        'username' => 'required|string|unique:users',
        'password' => 'required|string|min:6',
        'name'     => 'required|string',
        'email'    => 'required|string|email|unique:users',
        'phone'    => 'nullable|string',
        'address'  => 'nullable|string',
        ]);

        
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'role'     => 'user',
            'store_id' => $request->store_id,
            'created_by' => $request->username,
            'created_date'=> now(),
            'modified_by' => $request->username,
            'modified_date'=> now()
        ]);

        $store = Store::find($user->store_id);


        // login otomatis setelah signup
        Auth::login($user);

        return redirect()->route('login.page',['account_code' => $store->account_code]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'store_id' => 'required|integer|exists:stores,id',
            'password' => 'required|string',
        ]);

        $user = User::where([
            ['username', $request->username],
            ['store_id', $request->store_id],
        ])->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid credentials');
        }

        Auth::login($user);
        $store = Store::find($user->store_id);

        switch ($user->role) 
        {
            case 'admin_seller':
                return redirect()->route('dashboard.home.seller', ['account_code' => $store->account_code]);

            case 'user':
                return redirect()->route('dashboard.home.user',['account_code' => $store->account_code]);
                
            default:
                return redirect()->route('home');
        }
    }
    public function logout(Request $request)
    {
        $user = Auth::user();
        $account_code = null;

        if ($user && $user->store_id) {
            $seller = \App\Models\Store::find($user->store_id);
            $account_code = $seller?->account_code; // safe navigation
        }

        // Logout user
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect ke login page toko yg sesuai
        if ($account_code) {
            return redirect()->route('login.page', ['account_code' => $account_code]);
        }

        // fallback kalau gak ada account_code
        return redirect('/');
    }

    // =====================DONE

}