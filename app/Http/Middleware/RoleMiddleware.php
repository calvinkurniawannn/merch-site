<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();
        $account_code = $request->route('account_code');

        // Kalau belum login
        if (!$user) {
            if ($account_code) {
                return redirect()->route('login.page', ['account_code' => $account_code]);
            }
            return redirect()->route('home');
        }

        // Kalau role tidak sesuai
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized');
        }

        // ✅ Tambahin check store
        if ($account_code) {
            $store = \App\Models\Store::where('account_code', $account_code)->firstOrFail();

            // cek apakah user login punya store yang sama
            if ($user->store_id !== $store->id) {
                abort(403, 'No Access');
            }
        }

        return $next($request);
    }

}