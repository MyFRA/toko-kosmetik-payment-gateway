<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="{{ asset('/css/customer/register.css') }}">
    <title>Customer Register | Toko Indah Jaya Kosmetik & Aksesoris</title>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <div class="bg-wrapper">
            </div>
            <div class="form-wrapper">
                <div class="inner-form-wrapper">
                    <form action="{{ url('/register') }}" method="POST">
                        @csrf
                        <div class="top-section">
                            <img src="{{ asset('/images/icons/logo.png') }}" alt="logo">
                        </div>
                        <div class="center-section">
                            <h3>Daftar Akun</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni eum eius suscipit consequuntur asperiores impedit atque dolores aut ipsam corrupti.</p>
                            @if (session('failed'))
                            <div class="alert-danger">
                                <span>Kesalahan, </span> {{ session('failed') }}
                            </div>                                
                            @endif
                            <div class="form-group-wrapper">
                                <div class="form-group">
                                    <label for="fullname">Nama Lengkap</label>
                                    <div class="input">
                                        <input type="text" name="fullname" id="fullname" placeholder="Nama Lengkap" class="@error('fullname') is-invalid @enderror" value="{{old('fullname')}}">
                                        <span><i class="zmdi zmdi-account"></i></span>
                                    </div>
                                    @error('fullname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input">
                                        <input type="email" name="email" id="email" placeholder="Email" class="@error('email') is-invalid @enderror" value="{{old('email')}}">
                                        <span><i class="zmdi zmdi-email"></i></span>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Kata Sandi</label>
                                    <div class="input">
                                        <input type="password" name="password" id="password_confirmation" placeholder="Kata Sandi" class="@error('password') is-invalid @enderror" value="{{old('password')}}">
                                        <span><i class="zmdi zmdi-lock"></i></span>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                                    <div class="input">
                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Kata Sandi" class="@error('password_confirmation') is-invalid @enderror" value="">
                                        <span><i class="zmdi zmdi-lock"></i></span>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group button">
                                    <button type="submit">Daftar Sekarang</button>
                                    <span>Sudah mempunyai akun? <a href="{{ url('/login') }}">Masuk</a></span>
                                </div>    
                            </div>
                        </div>
                        <div class="bottom-section">
                            <span>Kembali ke <a href="{{ url('/') }}">Beranda</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>