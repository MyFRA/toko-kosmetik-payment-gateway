@extends('web.layouts.app')

@section('content')
    <div class="new-ui-login-container">
        <div class="new-ui-login-wrapper">
            <h2 class="title">LOGIN</h2>
            <form method="POST" action="{{ url('/login') }}" class="form-group-wrapper">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="Email" class="@error('email') ora-valid @enderror" value="{{old('email')}}">
                    @error('email')
                        <div class="invalid-feedback" style="margin-top: 9px; color: #DB2777">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Kata Sandi" class="@error('password') ora-valid @enderror"{{old('password')}}>
                    <div style="display: flex; justify-content: space-between; align-items: center">
                        @error('password')
                            <div class="invalid-feedback" style="margin-top: 9px; color: #DB2777">
                                {{ $message }}
                            </div>
                        @enderror
                        <a href="{{ url('/forgot-password') }}" class="forgot-password">Lupa kata sandi</a>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit">Masuk</button>
                    <span>Belum mempunyai akun? <a href="{{ url('/register') }}">Daftar</a></span>
                </div>
            </form>
        </div>
        <div class="new-ui-login-dot-1"></div>
        <div class="new-ui-login-dot-2"></div>
    </div>
@endsection

@section('script')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
        })
    </script>

    <script>
        if( {{session('success') ? 'true' : 'false' }} ) {
            Toast.fire({
                'title' : `{{session('success')}}`,
                'icon'  : 'success',
            });
        }
    </script>

    <script>
        if( {{session('failed') ? 'true' : 'false' }} ) {
            Toast.fire({
                'title' : `{{session('failed')}}`,
                'icon'  : 'error',
            });
        }
    </script>
@endsection