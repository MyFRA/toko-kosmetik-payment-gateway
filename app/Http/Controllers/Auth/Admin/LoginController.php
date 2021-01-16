<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Session;
use App\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $admin = User::where('email', $request->email)->first();
        if( $admin == null ) {
            Session::flash('old_value', [
                'email'     => $request->email,
                'password'  => $request->password,
            ]);
            Session::flash('errorEmail', [
                'message' => 'Email tidak ditemukan',
            ]);
            return back();
        }

        if( !Hash::check($request->password, $admin->password) ) {
            Session::flash('old_value', [
                'email'     => $request->email,
                'password'  => $request->password,
            ]);
            Session::flash('errorPassword', [
                'message' => 'Kata sandi salah',
            ]);
            return back();
        }

        $user = Auth::guard('admin')->attempt([
            'email'     => $request->email,
            'password'  => $request->password,
        ]);

        if( $user ) {
            return redirect('/app-admin');
        }
    }
}
