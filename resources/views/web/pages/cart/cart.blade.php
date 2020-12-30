@extends('web.layouts.app')

@section('content')
    <div class="cart-wrapper">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="cart-product">
            <hr>
            <div class="products-cart" id="products-cart">
                @foreach ($carts as $cart)
                <div class="product-cart">
                    <div class="product">
                        <img src="{{ $cart['image_src'] }}" alt="product-image">
                        <div class="price-and-detail">
                            <h4 class="name">{{ $cart['product_name'] }}</h4>
                            <h5 class="price">Rp. {{ number_format($cart['product_price'], 0, '.', '.') }}</h5>
                        </div>
                    </div>
                    <div class="action-product">
                        <div class="note">
                        </div>
                        <div class="action">
                            <div class="sub-action">
                                <a href="" onclick="addToWishlist(this, {{$cart['product_id']}})" class="{{ $cart['is_wishlist'] ? 'active' : ''}}"><i class="zmdi zmdi-favorite"></i></a>
                            </div>
                            <div class="sub-action">
                                <a href="" onclick="deleteProductFromCart({{$cart['product_id']}})"><i class="zmdi zmdi-delete"></i></a>
                            </div>
                            <div class="sub-action">
                                <button onclick="decreaseAmount(this)" data-product_id="{{ $cart['product_id'] }}">-</button>
                                <input type="number" id="product-amount" value="{{ $cart['cart_amount'] }}" readonly>
                                <button onclick="increaseAmount(this, {{ $cart['product_amount'] }})" data-product_id="{{ $cart['product_id'] }}">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="product-check">
                        <input type="checkbox" name="checked_products[]" multiple="multiple" onchange="checkProduct(this)" data-product_id="{{ $cart['product_id'] }}" data-price="{{ $cart['product_price'] }}" {{ $cart['is_checked'] ? 'checked' : ''}}>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="cart-total-price">
            <div class="total-wrapper">
                <h4>Ringkasan Belanja</h4>
                <div class="total-price">
                    <span class="text">Total Harga</span>
                    <span class="price">-</span>
                </div>
                <button class="disabled" id="checkout-button" onclick="gotoShipment(this, '{{url('/cart/shipment')}}')">Beli (<span>0</span>)</button>
            </div>
        </div>
    </div>
    <div class="products-container">
        <div class="products-text-wrapper">
            <h4 class="related-product-title">Produk Lainya</h4>
        </div>
        <div class="products-wrapper home-recommendation-products-wrapper not-using-slick">
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        function checkProduct(element) {
            const setCheckedUrl = '{{url('/checked-cart')}}';
            const product_id    = element.getAttribute('data-product_id');

            if(!element.hasAttribute('checked')) {
                fetch(setCheckedUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type' : 'application/json',
                    },
                    body : JSON.stringify({
                        '_token'     : document.getElementById('token').value,
                        'product_id' : product_id,
                        'is_checked' : true,
                    }),
                }).then(response => response.json())
                    .then((res) => {
                        if(res.code == 200 && res.success) {
                            element.setAttribute('checked', true);
                            generatePriceTotal();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: res.message,
                            });
                        }
                    });
            } else {
                fetch(setCheckedUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type' : 'application/json',
                    },
                    body : JSON.stringify({
                        '_token'     : document.getElementById('token').value,
                        'product_id' : product_id,
                        'is_checked' : false,
                    }),
                }).then(response => response.json())
                    .then((res) => {
                        if(res.code == 200 && res.success) {
                            element.removeAttribute('checked');
                            generatePriceTotal();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: res.message,
                            });
                        }
                    });
            }
        }

        function generatePriceTotal() {
            const arr_product_check = document.querySelectorAll('.product-check input[type=checkbox]');
            const price_total_element = document.querySelector('.total-price .price');
            const checkout_button = document.getElementById('checkout-button');
            let price_total = 0;
            let amount_total = 0;

            arr_product_check.forEach((e) => {
                if(e.hasAttribute('checked')) {
                    const price = e.getAttribute('data-price');
                    const product_amount = e.parentElement.parentElement.querySelector('#product-amount').value;

                    price_total += price * product_amount;
                    amount_total += parseInt(product_amount);
                }

            })
            if( price_total > 0 ) {
                price_total_element.innerHTML = 'Rp. ' + formatRupiah(price_total);
                checkout_button.classList.remove('disabled');
                checkout_button.querySelector('span').innerHTML = amount_total;
            } else {
                checkout_button.classList.add('disabled');
                checkout_button.querySelector('span').innerHTML = 0;
                price_total_element.innerHTML = '-';
            }
        }

        function formatRupiah(angka){
            let	number_string = angka.toString();
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                    
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }
        
        function deleteProductFromCart(product_id) {
            event.preventDefault();
            if(confirm('Yakin akan menghapus produk dari keranjang?')) {
                const url = '{{url('/delete-from-cart')}}';
                const data = {
                    '_token'     : document.getElementById('token').value,
                    'product_id' : product_id,
                }

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type' : 'application/json',
                    },
                    body: JSON.stringify(data),
                }).then(response => response.json())
                .then((res) => {
                    if(res.code == 200 && res.success) {
                        const products_cart_wrapper = document.getElementById('products-cart');
                        const customerCartAmount = document.getElementById('customer-cart-amount');
                        customerCartAmount.innerHTML = res.data.customerCartAmount;
                        let products_cart = '';

                        res.data.carts.forEach((cart) => {
                            const product_cart = `
                                <div class="product-cart">
                                    <div class="product">
                                        <img src="${cart.image_src}" alt="product-image">
                                        <div class="price-and-detail">
                                            <h4 class="name">${cart.product_name}</h4>
                                            <h5 class="price">${'Rp ' + formatRupiah(cart.product_price)}</h5>
                                        </div>
                                    </div>
                                    <div class="action-product">
                                        <div class="note">
                                        </div>
                                        <div class="action">
                                            <div class="sub-action">
                                                <a href=""><i class="zmdi zmdi-favorite"></i></a>
                                            </div>
                                            <div class="sub-action">
                                                <a href="" onclick="deleteProductFromCart(${cart.product_id})"><i class="zmdi zmdi-delete"></i></a>
                                            </div>
                                            <div class="sub-action">
                                                <button onclick="decreaseAmount(this)">-</button>
                                                <input type="number" id="product-amount" value="${cart.cart_amount}">
                                                <button onclick="increaseAmount(this, ${cart.product_amount})">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-check">
                                        <input type="checkbox" name="checked_products[]" multiple="multiple" onchange="checkProduct(this)" data-product_id="${cart.product_id}" data-price="${cart.product_price}">
                                    </div>
                                </div>`;
                                products_cart += product_cart;
                        });
                        products_cart_wrapper.innerHTML = products_cart;
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: res.message
                        })
                    }
                })
            }
        }
    </script>
    <script>
        function increaseAmount(element, max) {
            const product_amount = element.parentElement.querySelector('input');
            const product_id     = element.getAttribute('data-product_id');
            const url            = '{{url('/increase-cart')}}';

            if( parseInt(product_amount.value) < max ) {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type' : 'application/json',
                    },
                    body : JSON.stringify({
                        _token : document.getElementById('token').value,
                        product_id : product_id,
                        is_increased : true,
                    }),
                }).then(response => response.json())
                .then((res) => {
                    if(res.code == 200 && res.success) {
                        product_amount.value = res.data.product_amount;
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: res.message,
                        })
                    }
                });
            }
            generatePriceTotal();
        }

        function decreaseAmount(element) {
            const product_amount = element.parentElement.querySelector('input');
            const product_id     = element.getAttribute('data-product_id');
            const url            = '{{url('/increase-cart')}}';

            if( parseInt(product_amount.value) > 1 ) {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type' : 'application/json',
                    },
                    body : JSON.stringify({
                        _token : document.getElementById('token').value,
                        product_id : product_id,
                        is_increased : false,
                    }),
                }).then(response => response.json())
                .then((res) => {
                    if(res.code == 200 && res.success) {
                        product_amount.value = res.data.product_amount;
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: res.message,
                        })
                    }
                });
            }
            generatePriceTotal();
        }
    </script>
    <script>
        function addToWishlist(element, product_id) {
            event.preventDefault();
            const url = '{{ url('/add-to-wishlists') }}';
            const customerWishlistAmount = document.getElementById('customer-wishlist-amount');

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type' : 'application/json'
                    },
                    body: JSON.stringify({
                        '_token'     : document.getElementById('token').value,
                        'product_id' : product_id,
                    }),
            }).then(response => response.json())
            .then((res) => {
                if(res.code == 200 && res.success) {
                    customerWishlistAmount.innerHTML = res.data.customerWishlistAmount;
                    element.classList.add('active');

                    Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                } else {
                    const urlDeleteFromWishlist = '{{ url('/delete-from-wishlists') }}';
                    fetch(urlDeleteFromWishlist, {
                        method : 'POST',
                        headers : {
                            'Content-Type' : 'application/json',
                        },
                        body : JSON.stringify({
                            '_token' : document.getElementById('token').value,
                            'product_id' : product_id,
                        }),
                    }).then(response => response.json())
                        .then((res) => {
                            if(res.code == 200 && res.success) {
                                customerWishlistAmount.innerHTML = res.data.customerWishlistAmount;
                               if(element.classList.contains('active')) {
                                   element.classList.remove('active')
                               }

                                Toast.fire({
                                    icon: 'success',
                                    title: res.message
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: res.message
                                })
                            }
                        })
                }
            })
        }
    </script>
    <script>
        generatePriceTotal();
    </script>

    <script>
        function gotoShipment(element, url) {
            if(!element.classList.contains('disabled')) {
                window.location.href = url;
            }
        }
    </script>
@endsection