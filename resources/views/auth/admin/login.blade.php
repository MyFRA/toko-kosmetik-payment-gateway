<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/admin/login.css') }}">
    <title>Login Administrator</title>
</head>
<body>
    <div class="container">
        <div class="login-wrapper">
            <div class="bg-people-wrapper">

            </div>
            <div class="form-login-wrapper">
                <div class="inner-form-login-wrapper">
                    <form action="{{ url('/app-admin/login') }}" method="POST">
                        @csrf
                        <div class="logo-text-section">
                            <img src="{{ asset('/images/icons/logo-no-text.png') }}" alt="logo">
                            <h3>Masuk Administrator</h3>
                        </div>
                        <div class="form-section">
                            <div class="form-group">
                                <input type="email" name="email" id="email" placeholder="Email" class="{{ session('errorEmail') ? 'is-invalid' : '' }}" value="{{session('old_value') ? session('old_value')['email'] : ''}}">
                                
                                @if (session('errorEmail'))
                                    <div class="invalid-feedback">
                                        {{ session('errorEmail')['message'] }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" placeholder="Password" class="{{ session('errorPassword') ? 'is-invalid' : '' }}" value="{{session('old_value') ? session('old_value')['password'] : ''}}">
                            
                                @if (session('errorPassword'))
                                    <div class="invalid-feedback">
                                        {{ session('errorPassword')['message'] }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit">Masuk</button>
                                <span class="back">Kembali ke <a href="{{ url('/') }}">Beranda Situs</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>