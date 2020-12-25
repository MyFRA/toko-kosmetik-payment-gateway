<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

use Auth;
use DB;
use Mail;
use Crypt;

class RegisterController extends Controller
{
        /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $data = [
            'title'     => 'Register',
            'nav'       => 'account'
        ];

        return view('auth.web.register', $data);
    }

        /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }

     /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname'      => 'required|string|max:100',
            'email'         => 'required|string|max:100|email|unique:customers',
            'number_phone'  => 'required|string|max:16',
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
                    ->withErrors($validator)
                    ->withInput();
        }

        DB::transaction(function () use ($request) {
            // save into table
            $customer = Customer::create([
                'fullname'      => $request['fullname'],
                'email'         => $request['email'],
                'number_phone'  => $request['number_phone'],
                'password'      => Hash::make($request['password']),
            ]);
            // send email verification
            Mail::to($customer->email)->send(new VerifyEmail($customer));
        });
        // redirect to home
        return redirect()->back();
    }

    public function verify()
    { 
        if (empty(request('token'))) {
            // if token is not provided
            return redirect()->route('customer.signup-form');
        }
        // descrypt token as email
        $decryptedEmail = Crypt::decrypt(request('token'));
        // find user by email
        $customer = Customer::whereEmail($decryptedEmail)->first();
        if ($customer->status == 'activated') {
            // user is already active, do something
        }
        // otherwise change user status to "activated"
        $customer->status = 'activated';
        $customer->save();
        // autologin
        Auth::loginUsingId($customer->id);
        return redirect('/home');
    }
}
