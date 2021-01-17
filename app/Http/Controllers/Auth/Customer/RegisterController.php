<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\TestEmail;

use App\Models\Customer;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.customer.register');
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname'      => 'required|string|max:100',
            'email'         => 'required|string|max:100|email|unique:customers',
            'password'      => 'required|string|min:8|confirmed',
        ], [
            'fullname.required'     => 'Nama lengkap tidak boleh kosong', 
            'fullname.string'       => 'Nama lengkap harus berupa teks',
            'fullname.max'          => 'Nama lengkap maksimal 100 karakter',
            'email.required'        => 'Email tidak boleh kosong',
            'email.string'          => 'Email harus berupa teks',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah digunakan',
            'email.max'             => 'Email maksimal 100 karakter',
            'password.required'     => 'Password tidak boleh kosong',
            'password.string'       => 'Password harus berupa teks',
            'password.min'          => 'Password minimal 8 karakter',
            'password.confirmed'    => 'Konfirmasi Password tidak cocok',
        ]);

        if($validator->fails()) {
            return back()
                    ->withErrors($validator->errors())
                    ->withInput();
        }

        $nama = "Wildan Fuady";
        $email = "tomyntapss@gmail.com";
        $kirim = Mail::to($email)->send(new TestEmail($nama));

        dd($kirim);
    }
}
