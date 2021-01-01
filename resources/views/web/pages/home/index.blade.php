@extends('web.layouts.app')

@section('content')

    @include('web.pages.home.components.banner-wrapper')
    @include('web.pages.home.components.home-services')
    @include('web.pages.home.components.home-promo')
    @include('web.pages.home.components.home-categories')
    @include('web.pages.home.components.home-newest-product')
    @include('web.pages.home.components.home-best-seller')
    @include('web.pages.home.components.home-recommendation')

@endsection

@section('stylesheet')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>
@endsection

@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            if($(window).width() < 510) {
                $('.home-promo-product-wrapper').slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                });  
                $('.home-best-seller').slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                });  
                $('.home-newest-product').slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                });  
            }else if($(window).width() < 992) {
                $('.home-promo-product-wrapper').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                });  
                $('.home-best-seller').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                });  
                $('.home-newest-product').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                });  
            }else if($(window).width() <= 1280) {
                $('.home-promo-product-wrapper').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                });  
                $('.home-best-seller').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                });  
                $('.home-newest-product').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                });  
            }
        });
    </script>
@endsection