@extends('web.layouts.app')

@section('content')
    <div class="account-index">
        <h3 class="title padding-responsive">Akun Saya</h3>
        @include('web.pages.account.components.index.account')
        @include('web.pages.account.components.index.daftar-transaksi')
        @include('web.pages.account.components.index.faq')
        @include('web.pages.account.components.index.hubungi-kami')
        @include('web.pages.account.components.index.product-recommendation')
    </div>
@endsection