@extends('web.layouts.app')

@section('content')
    @include('web.pages.product.components.breadcrumb')
    @include('web.pages.product.components.product-detail')
    @include('web.pages.product.components.product-description-and-comment')
    @include('web.pages.product.components.comment-box')
    @include('web.pages.product.components.related-product')
    @include('web.pages.product.components.product-bottom-navigation-order')
@endsection

@section('script')
    <script>
        const plus = document.getElementById('plus');
        const min  = document.getElementById('min');
        const amount_input = document.getElementById('amount');

        min.addEventListener('click', () => {
            if( amount_input.value > 1 ) {
                amount_input.value = parseInt(amount_input.value) - 1;
            }
        });

        plus.addEventListener('click', () => {
            if( parseInt(amount_input.value) < {{ $product->amount }} )
            amount_input.value = parseInt(amount_input.value) + 1;
        });
    </script>

    <script>
        const varian_wrapper = document.getElementById('varian-wrapper');
        if( varian_wrapper ) {
            const allVariant = varian_wrapper.querySelectorAll('.warna');
            const textAllVariant = varian_wrapper.querySelectorAll('.warna .text');
            const arrAllVariant = [];
            textAllVariant.forEach((e) => {
                arrAllVariant.push(e.innerHTML);
            });

            varian_wrapper.addEventListener('click', (e) => {
                if(e.target.classList.contains('text')) {
                    const element = e.target.parentElement;

                    allVariant.forEach((e) => {
                        if(e.classList.contains('active')) {
                            e.classList.remove('active');
                        }
                    });
                    element.classList.add('active');
                } else if( e.target.classList.contains('warna') ) {
                    const element = e.target;

                    allVariant.forEach((e) => {
                        if(e.classList.contains('active')) {
                            e.classList.remove('active');
                        }
                    });
                    element.classList.add('active');
                }
            });
        }
    </script>

    <script>
        const product_image = document.querySelector('.product-image img');
        product_image.style.height = product_image.offsetWidth + 'px';

        const product_thumbs_wrapper = document.querySelector('.product-thumbs');
        const product_thumb_width = document.querySelector('.product-thumbs div img').offsetWidth + 'px';
    
        product_thumbs_wrapper.querySelectorAll('div').forEach((e) => {
            e.style.height = product_thumb_width;
        });

        product_thumbs_wrapper.addEventListener('click', (e) => {
            if(e.target.className == 'product-thumb') {
                product_image.setAttribute('src', e.target.getAttribute('src'));
            }
        });
    </script>    

    <script>
        const add_to_cart = document.querySelector('.add-to-cart');

        add_to_cart.addEventListener('click', () => {
            if( {{ is_null(Auth::guard('customer')->user()) ? 'false' : 'true' }} ) {
                const url = '{{ url('/add-to-cart') }}';
                $data     = {
                    '_token'     : document.getElementById('token').value,
                    'product_id' : {{ $product->id }},
                    'amount'     : parseInt(document.querySelector('input[name=amount]').value),
                }

                fetch(url, {
                    method : 'POST',
                    headers: {
                        'Content-Type' : 'application/json'
                    },
                    body : JSON.stringify($data),
                }).then(response => response.json())
                    .then(res => {
                        console.log(res);
                    })

            } else {
                window.location.href = '{{ url('/login') }}'
            }
        });
    </script>
@endsection
