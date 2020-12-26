@extends('web.layouts.app')

@section('content')
    <div class="account-index">
        <h3 class="font-weight-bold title padding-responsive text-666">Muhammad Tomy</h3>
        @include('web.pages.account.components.index.account')
        @include('web.pages.account.components.index.daftar-transaksi')
        @include('web.pages.account.components.index.faq')
        @include('web.pages.account.components.index.hubungi-kami')
        <div class="padding-responsive">
            <a href="" onclick="logoutAction()">
                <h3 class="title-account-daftar-transaksi">Logout</h3>
            </a>
        </div>
        @include('web.pages.account.components.index.product-recommendation')
    </div>
@endsection

@section('script')
    <script>
        const product_image = document.querySelector('.account-profile .content-wrapper .profile-wrapper .photo-profile-wrapper form img');
        product_image.style.height = product_image.offsetWidth + 'px';
    </script>    
    <script>
        const buttonPilihFotoProfil = document.querySelector('.account-profile .content-wrapper .profile-wrapper .photo-profile-wrapper form button');
        const inputFile = document.querySelector('.account-profile .content-wrapper .profile-wrapper .photo-profile-wrapper form input');
    
        buttonPilihFotoProfil.addEventListener('click', () => {
            inputFile.click();
        });
    </script>
@endsection