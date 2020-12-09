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