@extends('web.layouts.app')

@section('content')
    <section class="change-password-wrapper">
        <div class="change-password">
            <div class="head">
                <h3>Password</h3>
                <p>Ubah Kata Sandi anda</p>
            </div>
            <div class="body">
                <form action="{{ url('/account/change-password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">Password Saat Ini</label>
                        <div class="input-and-error">
                            <input type="password" name="current_password" id="current_password" class="{{ session('error_current_password') ? 'is-invalid' : '' }}" value="{{session('current_password_value')}}">
                            @if (session('error_current_password'))
                                <div class="invalid-feedback">
                                    {{ session('current_password_message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <div class="input-and-error">
                            <input type="password" name="new_password" id="new_password" class="@error('new_password') is-invalid @enderror" value="{{old('new_password')}}">
                            @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Ulangi Password Baru</label>
                        <div class="input-and-error">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" value="{{old('new_password_confirmation')}}">
                        </div>
                    </div>
                    <div class="form-group button">
                        <button type="submit"><i class="zmdi zmdi-key mr-3"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection