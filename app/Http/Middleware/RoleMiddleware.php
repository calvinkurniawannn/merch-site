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

        // Kalau belum login → lempar ke login
        if (!$user) {
            return redirect()->route('login.page.seller');
        }

        // Kalau role user tidak ada di daftar roles → abort 404
        if (!in_array($user->role, $roles)) {
            abort(404);
        }

        return $next($request);
    }
}