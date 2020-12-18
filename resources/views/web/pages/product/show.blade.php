@extends('web.layouts.app')

@section('content')
    @include('web.pages.product.components.breadcrumb')
    @include('web.pages.product.components.product-detail')
    @include('web.pages.product.components.product-description-and-comment')
    @include('web.pages.product.components.comment-box')
    @include('web.pages.product.components.related-product')
    @include('web.pages.product.components.product-bottom-navigation-order')
@endsection
