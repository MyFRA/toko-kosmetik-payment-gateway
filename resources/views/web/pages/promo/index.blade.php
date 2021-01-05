@extends('web.layouts.app')

@section('content')
<div class="products-container" style="background-color: #DB2777">
    <div class="products-text-wrapper">
        <h1 class="related-product-title text-white mt-13 mb-5"><i class="zmdi zmdi-fire mr-3"></i> Promo</h1>
    </div>
    <div class="products-wrapper home-recommendation-products-wrapper not-using-slick {{ count($arr_promo) >= 5 ? 'justify-content-space-between' : '' }}">
        @foreach ($arr_promo as $promo)
            <a href="{{ url('/product/' . $promo->product->product_slug) }}" class="product {{ count($arr_promo) < 5 ? 'mr-lg-18' : '' }}">
                <div class="thumb-product">
                    <img class="product-image" src="{{ asset('/storage/images/products/' . json_decode($promo->product->product_images)[0]->name) }}" alt="thumb-product">
                    <img class="promo-label" src="https://www.pinclipart.com/picdir/big/336-3366313_great-clips-printable-coupons-valpak.png" alt="promo">
                </div>
                <div class="desc-product">
                    <h5>{{ strlen($promo->product->product_name) >= 23 ? substr($promo->product->product_name, 0, 23) . '...' : $promo->product->product_name }}</h5>
                    <div class="price-wrapper">
                        @if (!is_null($promo->product->discount))
                            @if ( $promo->product->discount->forever == true )
                                <h4>Rp. {{ number_format(floor($promo->product->price - ($promo->product->price * $promo->product->discount->discount_percent / 100)), 0, '.', '.') }}</h4>
                            @elseif(strtotime($promo->product->discount->end_date) >= strtotime(date('d-m-y')))
                                <h4>Rp. {{ number_format(floor($promo->product->price - ($promo->product->price * $promo->product->discount->discount_percent / 100)), 0, '.', '.') }}</h4>
                            @else
                                <h4>Rp. {{ number_format($promo->product->price, 0, '.', '.') }}</h4>
                            @endif
                        @else
                            <h4>Rp. {{ number_format($promo->product->price, 0, '.', '.') }}</h4>
                        @endif
                        @if (!is_null($promo->product->discount))
                            @if ( $promo->product->discount->forever == true )
                                <div class="discount">
                                    <h5 class="text-555"><strike>Rp. {{ number_format($promo->product->price, 0, '.', '.') }}</strike></h5>
                                    <span>{{ $promo->product->discount->discount_percent }}% OFF</span>
                                </div>  
                            @elseif(strtotime($promo->product->discount->end_date) >= strtotime(date('d-m-y')))
                                <div class="discount">
                                    <h5 class="text-555"><strike>Rp. {{ number_format($promo->product->price, 0, '.', '.') }}</strike></h5>
                                    <span>{{ $promo->product->discount->discount_percent }}% OFF</span>
                                </div>  
                            @endif
                        @endif
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok {{ number_format($promo->product->amount, 0, '.', '.') }}</span>
                        @if ($promo->product->sold > 0)
                            <span class="sold">{{ number_format($promo->product->sold, 0, '.', '.') }} Terjual</span>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div>
{{ $arr_promo->links() }}
</div>
@endsection