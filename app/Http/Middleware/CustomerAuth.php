<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CustomerAuth
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
        if (!Auth::guard('customer')->check()) {
            return redirect('/login');
        } elseif( !Auth::guard('customer')->user()->email_verified_at ) {
            Auth::guard('customer')->logout();
            Auth::logout();
            return redirect('/login')
                    ->with('failed', 'Akun belum diverifikasi, silahkan cek pesan email konfirmasi anda');
        }
        return $next($request);
    }
}
