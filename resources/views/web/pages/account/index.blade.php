@extends('web.layouts.app')

@section('content')
    <div class="new-account-index-container">
        <div class="top-section-profile-account">
            <div class="profile-img">
                <img src="{{ asset('/images/icons/avatar.jpg') }}" alt="photo-profile">
            </div>
            <div class="name-account">
                <span>Tomy Wibowo</span>
                <div>
                    <a href="{{ url('/account/profile') }}">Edit Profil</a>
                </div>
            </div>
        </div>
        <div class="purchases-wrapper">
            <div class="top-section-purchases">
                <h2>Pesanan</h2>
            </div>
            <div class="bottom-section-purchases">
                <a href="" class="sub">
                    <div class="icon">
                        <i class="zmdi zmdi-card"></i>
                    </div>
                    <div class="text">
                        Belum Bayar
                    </div>
                </a>
                <a href="" class="sub">
                    <div class="icon">
                        <i class="zmdi zmdi-assignment"></i>
                    </div>
                    <div class="text">
                        Menunggu Konfirmasi Pembayaran
                    </div>
                </a>
                <a href="" class="sub">
                    <div class="icon">
                        <i class="zmdi zmdi-truck"></i>
                    </div>
                    <div class="text">
                        Dikirim
                    </div>
                </a>
                <a href="" class="sub">
                    <div class="icon">
                        <i class="zmdi zmdi-badge-check"></i>
                    </div>
                    <div class="text">
                        Diterima
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
@endsection