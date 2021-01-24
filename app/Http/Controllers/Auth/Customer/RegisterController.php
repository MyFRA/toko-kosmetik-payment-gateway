<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\VerifikasiEmailRegistrasi;
use Carbon\Carbon;

use App\Models\Customer;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.customer.register');
    }
    
    public function register(Request $request)
    {
        try {
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
    
            $newCustomer = Customer::create([
                'fullname'                  => $request->fullname,
                'email'                     => $request->email,
                'password'                  => Hash::make($request->password),
                'photo'                     => null,
                'status'                    => 'pending',
                'email_verified_at'         => null,
                'email_verification_token'  => Str::random(60),
            ]);

            // Send Email Verification
            Mail::to($newCustomer->email)
                ->send(new VerifikasiEmailRegistrasi($newCustomer->email_verification_token));

            // Success Send Email Verification
            return view('layout-after-email-send-verification');

        } catch (\Throwable $th) {
            if($validator->fails()) {
                return back()
                        ->withInput()
                        ->with('failed', 'Maaf registrasi akun gagal, periksa koneksi internet anda kembali atau coba lagi nanti');
            }
        }
    }

    public function verifyCustomer($email_verification_token = null) 
    {
        if(is_null($email_verification_token)) {
            return abort(404);
        }
        if( !in_array($email_verification_token, $this->getAllOneColumn(Customer::get(), 'email_verification_token')) ) {
            return abort(404);
        }
        $customer = Customer::where('email_verification_token', $email_verification_token)->first();
        if( is_null($customer->email_verified_at) && $customer->status == 'pending' ) {
            $customer->update([
                'email_verified_at' => Carbon::now()->toDateTimeString(),
                'status'            => 'activated',
            ]); 
        }

        return view('auth.customer.account-activated');
    }
}
