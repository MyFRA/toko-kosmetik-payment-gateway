<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordEmail;

use App\Models\Customer;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Lupa Kata Sandi',
            'nav'   => '',
        ];

        return view('web.pages.forgot-password.index', $data);
    }

    public function sendEmailAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:100|email|string|in:' . join(',',  $this->getAllOneColumn(Customer::get(), 'email')),
        ], [
            'email.required'        => 'Email tidak boleh kosong',
            'email.max'             => 'Email maksimal 100 karakter',
            'email.email'           => 'Email tidak valid',
            'email.string'          => 'Email harus harus berupa teks',
            'email.in'              => 'Alamat email tidak ditemukan',
        ]);

        if( $validator->fails() ) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $customer = Customer::where('email', $request->email)->first();
        
        $customer->update([
            'forgot_password_token' => Str::random(60),
        ]);
        $customer = Customer::where('email', $request->email)->first();

        // Send Reset Password 
        Mail::to($request->email)
                ->send(new ResetPasswordEmail($customer->forgot_password_token));
        
        return view('layout-after-forgot-password');
    }

    public function resetPasswordShowForm($token = null) {
        if($token == null || $token == '') {
            return abort(404);
        }

        $data = [
            'title'   => 'Reset Password',
            'nav'     => 'reset-password',
            'token'   => $token,
        ];

        return view('reset-password-form', $data);
    } 

    public function resetPasswordAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_password'                  => 'required|min:8|string|confirmed',
            'new_password_confirmation'     => 'string',
            'token'                         => 'required',
        ], [
            'new_password.required'                 =>  'Kata sandi tidak boleh kosong',
            'new_password.min'                      =>  'Kata sandi minimal 8 karakter',
            'new_password.string'                   =>  'Kata sandi harus berupa teks',
            'new_password.confirmed'                =>  'Konfirmasi kata sandi tidak cocok',
            'new_password_confirmation.string'      =>  'ulangi kata harus berupa teks',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        if( !in_array($request->token, $this->getAllOneColumn(Customer::get(), 'forgot_password_token')) ) {
            return back()->with('failed', 'Token tidak cocok / sudah kadaluarsa')->withInput();
        }

        $customer = Customer::where('forgot_password_token', $request->token)->first();

        $customer->update([
            'forgot_password_token'  => null,
            'password'               => Hash::make($request->new_password),
        ]);

        return redirect('/login')->with('success', 'Berhasil, kata sandi telah direset');
    }
}
