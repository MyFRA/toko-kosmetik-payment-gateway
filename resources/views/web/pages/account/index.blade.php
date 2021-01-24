@extends('web.layouts.app')

@section('content')
    <div class="new-account-index-container">
        <div class="top-section-profile-account">
            <div class="profile-img">
                <img src="{{ asset('/images/icons/avatar.jpg') }}" alt="photo-profile">
            </div>
            <div class="name-account">
                <span>{{ Auth::guard('customer')->user()->fullname }}</span>
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
                <a href="{{ url('/purchases/belum-bayar') }}" class="sub">
                    <div class="icon">
                        <i class="zmdi zmdi-card"></i>
                        @if ($belum_bayar > 0)
                            <span>{{ $belum_bayar }}</span>
                        @endif
                    </div>
                    <div class="text">
                        Belum Bayar
                    </div>
                </a>
                <a href="{{ url('/purchases/menunggu-konfirmasi-bukti-pembayaran') }}" class="sub">
                    <div class="icon">
                        <i class="zmdi zmdi-assignment"></i>
                        @if ($menunggu_konfirmasi > 0)
                            <span>{{ $menunggu_konfirmasi }}</span>
                        @endif
                    </div>
                    <div class="text">
                        Menunggu Konfirmasi Pembayaran
                    </div>
                </a>
                <a href="dikirim" class="sub">
                    <div class="icon">
                        <i class="zmdi zmdi-truck"></i>
                        @if ($dikirim > 0)
                            <span>{{ $dikirim }}</span>
                        @endif
                    </div>
                    <div class="text">
                        Dikirim
                    </div>
                </a>
                <a href="diterima" class="sub">
                    <div class="icon">
                        <i class="zmdi zmdi-badge-check"></i>
                        @if ($diterima > 0)
                            <span>{{ $diterima }}</span>
                        @endif
                    </div>
                    <div class="text">
                        Diterima
                    </div>
                </a>
            </div>
        </div>
        <div class="purchases-wrapper">
            <div class="top-section-purchases">
                <h2>Pilihan</h2>
            </div>
            <div class="bottom-section-group">
                <a href="{{ url('/faq') }}">
                    <i class="zmdi zmdi-comments mr-3"></i> FAQ
                </a>
                <a href="" onclick="logoutAction()">
                    <i class="zmdi zmdi-power mr-3"></i> Keluar
                </a>
            </div>
        </div>
    </div>
@endsection