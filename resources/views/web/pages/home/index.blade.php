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
    <script>
        // Ready global element
        const button_load_more              = document.getElementById('load-more');
        const products_wrapper              = document.getElementById('products-wrapper-unique-id');
        let all_products_recommend = [];

        // First time page has been loaded, show 15 products data
        const url = '{{ url('/api/product-recommendation')}}' + '/75';
        fetch(url)
        .then(response => response.json())
        .then((res) => {
            if(res.code == 200 && res.success) {
                all_products_recommend = res.data.products;
                if( all_products_recommend.length <= 15 ) {
                    button_load_more.innerHTML = 'Lihat Semua Produk';
                }
                if(all_products_recommend.length >= 5) {
                    products_wrapper.classList.add('justify-content-space-between');
                }
                let products = '';
                all_products_recommend.forEach((product, index) => {
                    if(index < 15) {
                        const product_element = 
                        `<a href="{{ url('/product') }}/${product.slug}" class="product ${all_products_recommend.length < 5 ? 'mr-lg-18' : ''}">
                            <div class="thumb-product">
                                <img class="product-image" src="${product.imageUrl}" alt="thumb-product">
                            </div>
                            <div class="desc-product">
                                <h5>${product.name.length >= 30 ? product.name.slice(0, 30) + '...' : product.name}</h5>
                                <div class="price-wrapper">
                                    <h4>Rp. ${formatRupiah(product.price_after_discount)}</h4>
                                    ${!product.discount == null ? 
                                    `<div class="discount">
                                        <h5 class="text-555"><strike>Rp. ${formatRupiah(product.price)}</strike></h5>
                                        <span>${product.discount}% OFF</span>
                                    </div>`
                                    : ''
                                    }
                                </div>
                                <div class="info-product">
                                    <span class="stok">Stok ${formatRupiah(product.amount)}</span>
                                    ${product.sold > 0 ? `<span class="sold">${ formatRupiah(product.sold) } Terjual</span>` : ``}
                                </div>
                            </div>
                        </a>`;
                        products += product_element;
                    }
                });
                products_wrapper.innerHTML += products;
                products_wrapper.querySelectorAll('.product')[products_wrapper.querySelectorAll('.product').length - 1].setAttribute('id', 'last-product');
            }
        });

        button_load_more.addEventListener('click', () => {
            const products_count = products_wrapper.querySelectorAll('.product').length;
            if(products_wrapper.querySelectorAll('.product').length == all_products_recommend.length) {
                window.location.href = '{{ url('/product')}}';
            } else if( all_products_recommend.length > products_count ) {
                let products = '';
                window.location.href = '{{ url('/')}}' + '#last-product';
                products_wrapper.querySelectorAll('.product')[products_wrapper.querySelectorAll('.product').length - 1].removeAttribute('id');
                all_products_recommend.forEach((product, index) => {
                    if(index >= products_count && index < products_count + 15 ) {
                        const product_element = 
                        `<a href="{{ url('/product') }}/${product.slug}" class="product ${all_products_recommend.length < 5 ? 'mr-lg-18' : ''}">
                            <div class="thumb-product">
                                <img class="product-image" src="${product.imageUrl}" alt="thumb-product">
                            </div>
                            <div class="desc-product">
                                <h5>${product.name.length >= 23 ? product.name.slice(0, 23) + '...' : product.name}</h5>
                                <div class="price-wrapper">
                                    <h4>Rp. ${formatRupiah(product.price_after_discount)}</h4>
                                    ${!product.discount == null ? 
                                    `<div class="discount">
                                        <h5 class="text-555"><strike>Rp. ${formatRupiah(product.price)}</strike></h5>
                                        <span>${product.discount}% OFF</span>
                                    </div>`
                                    : ''
                                    }
                                </div>
                                <div class="info-product">
                                    <span class="stok">Stok ${formatRupiah(product.amount)}</span>
                                    ${product.sold > 0 ? `<span class="sold">${ formatRupiah(product.sold) } Terjual</span>` : ``}
                                </div>
                            </div>
                        </a>`;
                        products += product_element;
                    }
                });
                products_wrapper.innerHTML += products;
                products_wrapper.querySelectorAll('.product')[products_wrapper.querySelectorAll('.product').length - 1].setAttribute('id', 'last-product');
            
                if(products_wrapper.querySelectorAll('.product').length == all_products_recommend.length) {
                    button_load_more.innerHTML = 'Lihat Semua Produk';
                }
            }
        });
    </script>
@endsection