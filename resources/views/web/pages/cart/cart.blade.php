@extends('web.layouts.app')

@section('content')
    <h1 class="padding-responsive related-product-title text-555 title-cart"><i class="zmdi zmdi-shopping-cart mr-4"></i> Keranjang </h1>
    <div class="cart-wrapper">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="cart-product">
            <hr>
            <div class="products-cart" id="products-cart">
                @forelse ($carts as $cart)
                <div class="product-cart">
                    <div class="product">
                        <img src="{{ $cart['image_src'] }}" alt="product-image">
                        <div class="price-and-detail">
                            <h4 class="name">{{ $cart['product_name'] }}</h4>
                            @if ($cart['discount'])
                                <div class="cart-product-discount">
                                    <span class="discount-percent">{{$cart['discount']}}%</span>
                                    <span class="real-price">Rp. {{ number_format($cart['price'], 0, '.', '.') }}</span>
                                </div>
                            @endif
                            <h5 class="price">Rp. {{ number_format($cart['price_after_discount'], 0, '.', '.') }}</h5>
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
                        <input type="checkbox" name="checked_products[]" multiple="multiple" onchange="checkProduct(this)" data-product_id="{{ $cart['product_id'] }}" data-price="{{ $cart['price_after_discount'] }}" {{ $cart['is_checked'] ? 'checked' : ''}}>
                    </div>
                </div>
                @empty
                <div class="empty-cart-wrapper">
                    <img src="{{ asset('/images/assets/undraw_empty_cart_co35.png') }}" alt="empty-cart">
                    <h3>Tidak ada produk di keranjang</h3>
                </div>
                @endforelse
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
    <div class="products-container cart-margin-bottom">
        <div class="products-text-wrapper">
            <h1 class="related-product-title real">Produk Lainya</h1>
        </div>
        <div class="products-wrapper home-recommendation-products-wrapper not-using-slick {{ count($related_products) >= 5 ? 'justify-content-space-between' : '' }}">
            @foreach ($related_products as $product)
            <a href="{{ url('/product/' . $product->product_slug) }}" class="product {{ count($related_products) < 5 ? 'mr-lg-18' : '' }}">
                <div class="thumb-product">
                    <img class="product-image" src="{{ asset('/storage/images/products/' . json_decode($product->product_images)[0]->name) }}" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ strlen($product->product_name) >= 23 ? substr($product->product_name, 0, 23) . '...' : $product->product_name }}</h5>
                    <div class="price-wrapper">
                        @if (!is_null($product->discount))
                            @if ( $product->discount->forever == true )
                                <h4>Rp. {{ number_format(floor($product->price - ($product->price * $product->discount->discount_percent / 100)), 0, '.', '.') }}</h4>
                            @elseif(strtotime($product->discount->end_date) >= strtotime(date('d-m-y')))
                                <h4>Rp. {{ number_format(floor($product->price - ($product->price * $product->discount->discount_percent / 100)), 0, '.', '.') }}</h4>
                            @else
                                <h4>Rp. {{ number_format($product->price, 0, '.', '.') }}</h4>
                            @endif
                        @else
                            <h4>Rp. {{ number_format($product->price, 0, '.', '.') }}</h4>
                        @endif
                        @if (!is_null($product->discount))
                            @if ( $product->discount->forever == true )
                                <div class="discount">
                                    <h5 class="text-555"><strike>Rp. {{ number_format($product->price, 0, '.', '.') }}</strike></h5>
                                    <span>{{ $product->discount->discount_percent }}% OFF</span>
                                </div>  
                            @elseif(strtotime($product->discount->end_date) >= strtotime(date('d-m-y')))
                                <div class="discount">
                                    <h5 class="text-555"><strike>Rp. {{ number_format($product->price, 0, '.', '.') }}</strike></h5>
                                    <span>{{ $product->discount->discount_percent }}% OFF</span>
                                </div>  
                            @endif
                        @endif
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok {{ number_format($product->amount, 0, '.', '.') }}</span>
                        @if ($product->sold > 0)
                            <span class="sold">{{ number_format($product->sold, 0, '.', '.') }} Terjual</span>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
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
                generatePriceTotal();
                });
            }
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
                generatePriceTotal();
                });
            }
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
                    if(res.data.alreadyInFavorite) {
                            if( !element.classList.contains('active') ) {
                                element.classList.add('active');
                            }
                        } else {
                            if( element.classList.contains('active') ) {
                                element.classList.remove('active');
                            }
                        }
                    Toast.fire({
                            icon: 'success',
                            title: res.message
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