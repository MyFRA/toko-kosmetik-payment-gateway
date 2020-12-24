@extends('web.layouts.app')

@section('content')
<div class="auth-web-login-container">
    <div class="auth-web-login auth-web-register">
        <div class="form-login">
            <div class="logo">
                <img src="https://demo.hasthemes.com/corano-preview/corano/assets/img/logo/logo.png" alt="app-logo">
            </div>
            <form action="{{ url('/register') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label class="font-weight-bold" for="fullname">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="fullname" name="fullname" id="fullname" placeholder="Nama Lengkap" class="@error('fullname') is-invalid @enderror" value="{{old('fullname')}}">

                    @error('fullname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" placeholder="Email" class="@error('email') is-invalid @enderror" value="{{old('email')}}">
                    
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="number_phone">Nomor HP <span class="text-danger">*</span></label>
                    <input type="number" name="number_phone" id="number_phone" placeholder="Nomor HP" class="@error('number_phone') is-invalid @enderror" value="{{old('number_phone')}}">
                    
                    @error('number_phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="password">Kata Sandi <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" placeholder="Kata Sandi" class="@error('password') is-invalid @enderror">
                
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="password_confirmation">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Kata Sandi">
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