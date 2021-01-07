<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Hash;

use App\Models\Product;
use App\Models\Customer;
use App\Models\CustomerDetail;

class AccountController extends Controller
{
    public function index()
    {
        $data = [
            'title'             => 'Informasi Akun',
            'nav'               => 'account',
            'related_products'  => Product::inRandomOrder()->limit(15)->get(),
        ];

        return view('web.pages.account.index', $data);
    }

    public function updateFullname(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname'    => 'required|max:100',
        ], [
            'fullname.required' => 'Nama lengkap tidak boleh kosong',
            'fullname.max'      => 'Nama lengkap maksimal 100 karakter',
        ]);

        if($validator->fails()) {
            return back()->with('failed', $validator->errors()->first());
        }

        $customer = Customer::find(Auth::guard('customer')->user()->id);
        $customer->update([
            'fullname'  => $request->fullname,
        ]);
        
        return back()->with('success', 'Nama Telah diupdate');
    }

    public function updateBirth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'birth'             => 'required|date',
        ], [
            'birth.required'    => 'Tanggal lahir tidak boleh kosong',
            'birth.date'        => 'Tanggal lahir tidak valid',
        ]);

        if($validator->fails()) {
            return back()->with('failed', $validator->errors()->first());
        }

        $customerDetail = CustomerDetail::where('customer_id', Auth::guard('customer')->user()->id)->first();
        $customerDetail->update([
            'birth'  => $request->birth,
        ]);
        
        return back()->with('success', 'Tanggal lahir Telah diupdate');
    }

    public function updateGender(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gender'             => 'required|in:laki-laki,perempuan',
        ], [
            'gender.required'    => 'Jenis kelamin tidak boleh kosong',
            'gender.in'          => 'Jenis kelamin tidak valid',
        ]);

        if($validator->fails()) {
            return back()->with('failed', $validator->errors()->first());
        }

        $customerDetail = CustomerDetail::where('customer_id', Auth::guard('customer')->user()->id)->first();
        $customerDetail->update([
            'gender'  => $request->gender,
        ]);
        
        return back()->with('success', 'Jenis kelamin telah diupdate');
    }

    public function updateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|max:100|email',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.max'      => 'Email maksimal 100 karakter',
            'email.email'    => 'Email tidak valid',
        ]);

        if($validator->fails()) {
            return back()->with('failed', $validator->errors()->first());
        }

        $customer = Customer::find(Auth::guard('customer')->user()->id);

        if( $request->email != $customer->email ) {
            if(in_array($request->email, $this->getAllOneColumn(Customer::get(), 'email'))) {
                return back()->with('failed', 'Email sudah digunakan');
            }
        }

        $customer->update([
            'email'  => $request->email,
        ]);
        
        return back()->with('success', 'Email Telah diupdate');
    }

    public function updateNumberPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number_phone'       => 'required|numeric',
        ], [
            'number_phone.required'   => 'Nomor HP tidak boleh kosong',
            'number_phone.numeric'    => 'Nomor HP harus menggunakan angka',
        ]);

        if($validator->fails()) {
            return back()->with('failed', $validator->errors()->first());
        }

        $customerDetail = CustomerDetail::where('customer_id', Auth::guard('customer')->user()->id)->first();
        $customerDetail->update([
            'number_phone'  => $request->number_phone,
        ]);
        
        return back()->with('success', 'Nomor HP telah diupdate');
    }

    public function updatePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo'          => 'required|mimes:jpg,jpeg,png',
        ], [
            'photo.required' => 'Foto Profil tidak boleh kosong',
            'photo.mimes'    => 'Foto Profil harus berekstensi jpg, jpeg, png'
        ]);

        if($validator->fails()) {
            return back()->with('failed', $validator->errors()->first());
        }

        $customer = Customer::find(Auth::guard('customer')->user()->id);

        if( !is_null($customer->photo) ) {
            if( Storage::exists('public/images/customer-profiles/' . $customer->photo) ) {
                Storage::delete('public/images/customer-profiles/' . $customer->photo);
            }
        }

        $filename = $this->uploadFile(uniqid(Str::slug($customer->fullname)), $request->file('photo'), 'images/customer-profiles');
        
        $customer->update([
            'photo'  => $filename,
        ]);

        return back()->with('success', 'Foto Profil Telah diupdate');
    }

    public function indexChangePassword()
    {
        $data = [
            'title'   => 'Ubah Kata Sandi',
            'nav'     => 'account'
        ];

        return view('web.pages.account.change-password', $data);
    }

    public function actionChangePassword(Request $request) 
    {
        $customer = Auth::guard('customer')->user();
        if(!Hash::check($request->current_password, $customer->password)) {
            return back()->with('error_current_password', true)
                        ->with('current_password_message', 'password saat ini tidak cocok')
                        ->with('current_password_value', $request->current_password);
        }

        $validator = Validator::make($request->all(), [
            'new_password'    => 'required|min:8|string|confirmed',
        ], [
            'new_password.required'  => 'password baru tidak boleh kosong',
            'new_password.min'       => 'password baru minimal 8 karakter',
            'new_password.string'    => 'password baru harus berupa teks',
            'new_password.confirmed' => 'ulangi password baru tidak cocok',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)
                        ->with('current_password_value', $request->current_password)
                        ->withInput();
        }

        // Pass Validation
        $customer->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect('/account')->with('success', 'Password telah diupdate');
    }
}
