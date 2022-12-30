<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class publik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('adm')->check()) {
            return redirect()->intended('/adm/dashboard');
        } else if (Auth::guard('peminjam')->check()) {
            return redirect()->intended('dashboard');
        } else {
            return $next($request);
        }
    }
}
