@extends('web.layouts.app')

@section('content')
<div class="auth-web-login-container">
    <div class="auth-web-login auth-web-register">
        <div class="form-login">
            <div class="logo">
                <img src="https://demo.hasthemes.com/corano-preview/corano/assets/img/logo/logo.png" alt="app-logo">
            </div>
            <form action="">
                <div class="form-group">
                    <label class="font-weight-bold" for="name">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="name" name="name" id="name" placeholder="Nama Lengkap" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" placeholder="Email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="password">Kata Sandi <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" placeholder="Kata Sandi">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="password_confirmation">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                    <input type="password_confirmation" name="password" id="password_confirmation" placeholder="Konfirmasi Kata Sandi">
                </div>
                <div class="form-group">
                    <button type="submit">Daftar</button>
                </div>
                <div class="have-an-account">
                    <span>Sudah mempunyai akun? <a href="{{ url('/login') }}">Masuk</a></span>
                </div>
            </form>
        </div>
        <div class="illustration">
            <img src="{{ asset('/images/assets/Skincare-bro.png') }}" alt="login-illustration">
        </div>
    </div>
</div>

@endsection