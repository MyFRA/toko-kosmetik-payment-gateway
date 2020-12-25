@extends('web.layouts.app')

@section('content')
<div class="auth-web-login-container" style="background-image: url({{asset('/images/assets/hiclipart.com.png')}})">
    <div class="auth-web-login">
        <div class="illustration">
            <img src="{{ asset('/images/assets/girl in wavy hair and glasses 5-01.png') }}" alt="login-illustration">
        </div>
        <div class="form-login">
            <div class="logo">
                <img src="https://demo.hasthemes.com/corano-preview/corano/assets/img/logo/logo.png" alt="app-logo">
            </div>
            <form action="{{ url('/login') }}" method="POST">
                @csrf
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
                    <label class="font-weight-bold" for="password">Kata Sandi <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" placeholder="Kata Sandi" class="@error('password') is-invalid @enderror">
                
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit">LOGIN</button>
                </div>
                <div class="have-an-account">
                    <span>Belum mempunyai akun? <a href="{{ url('/register') }}">Daftar</a></span>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection