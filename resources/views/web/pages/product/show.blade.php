@extends('web.layouts.app')

@section('content')
    @include('web.pages.product.components.breadcrumb')
    @include('web.pages.product.components.product-detail')
    @include('web.pages.product.components.product-description-and-comment')
    @include('web.pages.product.components.comment-box')
    @include('web.pages.product.components.related-product')
    @include('web.pages.product.components.product-bottom-navigation-order')
@endsection

@section('stylesheet')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css">
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
        })
    </script>
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

                if( {{ (count($product->product_variants) > 0) ? 'true' : 'false' }} ) {
                    const allVariants = document.querySelectorAll('#varian-wrapper .warna');
                    for (let i = 0; i <= allVariants.length - 1; i++) {
                        if( allVariants[i].classList.contains('active') ) {
                            var variant = allVariants[i].querySelector('.text').innerHTML;
                        }
                    }
                }

                if( {{ (count($product->product_variants) > 0) ? 'true' : 'false' }} ) {
                    if( variant == undefined ) {
                            Toast.fire({
                                icon: 'error',
                                title: 'Pilih Varian terlebih dahulu'
                            })
                        return;
                    }
                }
                $data     = {
                    '_token'     : document.getElementById('token').value,
                    'product_id' : {{ $product->id }},
                    'amount'     : parseInt(document.querySelector('input[name=amount]').value),
                    'variant'    : {
                        'has_variant'  : {{ (count($product->product_variants) > 0) ? 'true' : 'false' }},
                        {{ (count($product->product_variants) > 0) ? "variant : variant" : '' }}
                    }
                }
                fetch(url, {
                    method : 'POST',
                    headers: {
                        'Content-Type' : 'application/json'
                    },
                    body : JSON.stringify($data),
                }).then(response => response.json())
                    .then(res => {
                        const customerCartAmount = document.getElementById('customer-cart-amount');
                        customerCartAmount.innerHTML = res.data.customerCartAmount;

                        if(res.code == 200 && res.success) {
                            Toast.fire({
                                icon: 'success',
                                title: res.message
                            })
                        }
                    })

            } else {
                window.location.href = '{{ url('/login') }}'
            }
        });
    </script>
@endsection
