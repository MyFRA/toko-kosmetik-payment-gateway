<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
            'email' => 'required|max:100|email|string',
        ], [
            'email.required'        => 'Email tidak boleh kosong',
            'email.max'             => 'Email maksimal 100 karakter',
            'email.email'           => 'Email tidak valid',
            'email.string'          => 'EMail harus harus berupa teks'
        ]);

        if( $validator->fails() ) {
            return back()->withErrors($validator)
                        ->withInput();
        }

    }
}
