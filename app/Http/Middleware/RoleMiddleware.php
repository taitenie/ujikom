<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Cek apakah user yang login memiliki role yang sesuai
        if ($user && $user->role === $role) {
            return $next($request);
        }

        // Jika tidak sesuai, redirect ke halaman login atau halaman lain
        return redirect('/login')->with('error', 'You do not have permission to access this page.');
    }
}
