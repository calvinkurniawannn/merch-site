<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SellerAccount;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
        'username' => 'required|string|unique:users',
        'password' => 'required|string|min:6',
        'name'     => 'required|string',
        'email'    => 'required|string|email|unique:users',
        'phone'    => 'nullable|string',
        'address'  => 'nullable|string',
        ]);

        
        $user = User::create([
            'username' => $request->username,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'role'     => 'user',
            'seller_account_id' => null, // default null, bisa diisi kalau ada
        ]);

        // login otomatis setelah signup
        Auth::login($user);

        return redirect()->route('login.page');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // cari user berdasarkan username + seller_account_id
        $user = User::where('username', $request->username)
                    ->first();

        // cek user + password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid credentials');
        }

        // login manual pakai Auth
        Auth::login($user);

        // redirect sesuai role
        if ($user->role === 'admin_seller') {
            return redirect()->route('dashboard.home.seller');
        } elseif ($user->role === 'user') {
            return redirect()->route('dashboard.home.user');
        }

        return redirect()->route('dashboard.home.user');
    }
    public function login_seller(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'account_code' => 'required|string',
            'password' => 'required|string',
        ]);

        // cari seller account sesuai input
        $seller = SellerAccount::where('account_code', $request->account_code)->first();

        if (!$seller) {
            return back()->with('error', 'Invalid credentials');
        }

        // cari user berdasarkan username + seller_account_id
        $user = User::where('username', $request->username)
                    ->where('seller_account_id', $seller->id)
                    ->first();

        // cek user + password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid credentials');
        }

        // login manual pakai Auth
        Auth::login($user);

        // redirect sesuai role
        if ($user->role === 'admin_seller') {
            return redirect()->route('dashboard.home.seller');
        } elseif ($user->role === 'user') {
            return redirect()->route('dashboard.home.user');
        }

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect ke login page
        return redirect()->route('login.page.seller');
    }

}