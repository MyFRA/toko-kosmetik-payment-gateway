@extends('web.layouts.app')

@section('content')
    <div class="new-ui-login-container">
        <div class="new-ui-login-wrapper">
            <h2 class="title">RESET KATA SANDI</h2>
            <form method="POST" action="{{ url('/reset-password') }}" class="form-group-wrapper" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="token" value="{{$token}}">
                <div class="form-group">
                    <input type="password" name="new_password" id="new_password" placeholder="Kata Sandi" class="@error('new_password') ora-valid @enderror" value="{{old('new_password')}}" >
                    <div style="display: flex; justify-content: space-between; align-items: center">
                        @error('new_password')
                            <div class="invalid-feedback" style="margin-top: 9px; color: #DB2777">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Konfirmasi Kata Sandi" class="@error('new_password_confirmation') ora-valid @enderror" value="{{old('new_password_confirmation')}}">
                    <div style="display: flex; justify-content: space-between; align-items: center">
                        @error('new_password_confirmation')
                            <div class="invalid-feedback" style="margin-top: 9px; color: #DB2777">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit">Reset Kata Sandi</button>
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
        if( {{session('failed') ? 'true' : 'false' }} ) {
            Toast.fire({
                'title' : `{{session('failed')}}`,
                'icon'  : 'error',
            });
        }
    </script>
@endsection