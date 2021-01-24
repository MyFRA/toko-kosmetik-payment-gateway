@extends('web.layouts.app')

@section('content')
    <div class="new-ui-login-container">
        <div class="new-ui-login-wrapper">
            <h2 class="title">LUPA KATA SANDI</h2>
            <form method="POST" action="{{ url('/forgot-password') }}" class="form-group-wrapper">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="Masukan Alamat Email Anda" class="@error('email') ora-valid @enderror" value="{{old('email')}}">
                    @error('email')
                        <div class="invalid-feedback" style="margin-top: 9px; color: #DB2777">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit">Kirim</button>
                </div>
            </form>
        </div>
        <div class="new-ui-login-dot-1"></div>
        <div class="new-ui-login-dot-2"></div>
    </div>
@endsection