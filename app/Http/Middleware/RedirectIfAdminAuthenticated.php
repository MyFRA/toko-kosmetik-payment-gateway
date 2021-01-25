<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class RedirectIfAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('customer')->check()) {
            return redirect('/account');
        } else if( Auth::guard('admin')->check() ) {
            return redirect('/app-admin');
        } else if( Auth::check() ) {
            Auth::logout();
        }
        
        return $next($request);
    }
}
