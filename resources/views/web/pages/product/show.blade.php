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
        var all_comments_global             = [];
        var price_total_user_choose         = document.getElementById('price-total-user-choose');
        const comments_wrapper              = document.querySelector('.ulasan-wrapper');
        const show_more_comments_element    = document.querySelector('p.tampilkan-lebih-banyak-komentar');
        const amount_input                  = document.getElementById('amount');
        const price                         = parseInt(document.getElementById('price-specify-product').getAttribute('data-price'));
    </script>
    <script>
        price_total_user_choose.innerHTML = 'Rp. ' + formatRupiah(price);
    </script>
    <script>
        const url_get_comments = '{{ url('/api/product-comments')}}/{{$product->id}}';
        fetch(url_get_comments).then(response => response.json())
        .then((res) => {
            if(res.code == 200 && res.success) {
                const all_comments_from_api = res.data.comments;
                all_comments_global = all_comments_from_api;
                if( all_comments_global.length <= 6 ) {
                    show_more_comments_element.style.display = 'none';
                }

                let comments = '';
                all_comments_from_api.forEach((comment, index) => {
                    if(index < 6) {
                        const comment_element = 
                        `<div class="ulasan">
                            <div class="account">
                                <div class="photo">
                                    <img src="${comment.customer_photo}" alt="photo-profile">
                                </div>
                                <div class="info">
                                    <span class="name">${comment.customer_name}</span>
                                    <span class="date">${comment.comment_date}</span>
                                </div>
                            </div>
                            <div class="comment">
                                <p class="comment-user">${comment.comment}</p>
                            </div>
                        </div>`;
                        comments += comment_element;
                    }
                });
                comments_wrapper.innerHTML = comments;
            }
        });
    </script>
    <script>
        // Tampilkan lebih banyak komentar
        show_more_comments_element.addEventListener('click', () => {
            var all_elements_comments_global_length = document.querySelectorAll('.ulasan-wrapper .ulasan').length;

            let comments = '';
            all_comments_global.forEach((element, index) => {
                if(index >= all_elements_comments_global_length && index < all_elements_comments_global_length + 6) {
                    const comment_element = 
                        `<div class="ulasan">
                            <div class="account">
                                <div class="photo">
                                    <img src="${element.customer_photo}" alt="photo-profile">
                                </div>
                                <div class="info">
                                    <span class="name">${element.customer_name}</span>
                                    <span class="date">${element.comment_date}</span>
                                </div>
                            </div>
                            <div class="comment">
                                <p class="comment-user">${element.comment}</p>
                            </div>
                        </div>`;
                        comments += comment_element;
                }
            });
            comments_wrapper.innerHTML += comments;
            if(document.querySelectorAll('.ulasan-wrapper .ulasan').length == all_comments_global.length) {
                show_more_comments_element.style.display = 'none';
            }
        });
    </script>
    <script>
        const plus = document.getElementById('plus');
        const min  = document.getElementById('min');

        min.addEventListener('click', () => {
            if( amount_input.value > 1 ) {
                amount_input.value                  = parseInt(amount_input.value) - 1;
                price_total_user_choose.innerHTML   = 'Rp. ' + formatRupiah(parseInt(price * amount_input.value));
            }
        });

        plus.addEventListener('click', () => {
            if( parseInt(amount_input.value) < {{ $product->amount }} )
            amount_input.value = parseInt(amount_input.value) + 1;
            price_total_user_choose.innerHTML   = 'Rp. ' + formatRupiah(parseInt(price * amount_input.value));
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
                product_thumbs_wrapper.querySelectorAll('div').forEach((e) => {
                    if(e.classList.contains('active')) {
                        e.classList.remove('active');
                    }
                });
                e.target.parentElement.classList.add('active');
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

    <script>
        const add_to_wishlist = document.querySelector('.product-bottom-navigation-order .sub.favorite');
        add_to_wishlist.addEventListener('click', () => {
            if( {{ is_null(Auth::guard('customer')->user()) ? 'false' : 'true' }} ) {
                const url = '{{ url('/add-to-wishlists') }}';

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type' : 'application/json'
                        },
                        body: JSON.stringify({
                            '_token'     : document.getElementById('token').value,
                            'product_id' : {{ $product->id }},
                        }),
                }).then(response => response.json())
                .then((res) => {
                    if(res.code == 200 && res.success) {
                        const customerWishlistAmount = document.getElementById('customer-wishlist-amount');
                        customerWishlistAmount.innerHTML = res.data.customerWishlistAmount;
                        if(res.data.alreadyInFavorite) {
                            if( !add_to_wishlist.classList.contains('active') ) {
                                add_to_wishlist.classList.add('active');
                            }
                        } else {
                            if( add_to_wishlist.classList.contains('active') ) {
                                add_to_wishlist.classList.remove('active');
                            }
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
                });
            } else {
                window.location.href = '{{ url('/login') }}'
            }
        });
    </script>
    <script>
        if ({{ Auth::guard('customer')->check() ? 'true' : 'false'}}) {
            const inputComment = document.querySelector('textarea#comment[name=comment]');
            const buttonComment = document.getElementById('submit-comment');

            buttonComment.addEventListener('click', () => {
                const url = '{{ url('/add-comment') }}';
                const data = {
                    _token: document.getElementById('token').value,
                    comment: inputComment.value,
                    product_id: {{ $product->id }},
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
                            const commentsWrapper = document.querySelector('.product-desc-wrapper .ulasan-wrapper');
                            const amountComments  = document.querySelector('.ulasan-count');
                            all_comments_global   = res.data.comments;
                            const allCommentsElement = document.querySelectorAll('.product-desc-wrapper .ulasan-wrapper .ulasan');
                            amountComments.innerHTML = 'Semua komentar ' + res.data.comments.length;
                            commentsWrapper.innerHTML = '';
                            let comments = '';

                            res.data.comments.forEach((comment, index) => {
                                if( all_comments_global.length == allCommentsElement.length + 1 ) {
                                    comments += `<div class="ulasan">
                                                    <div class="account">
                                                        <div class="photo">
                                                            <img src="${comment.customer_photo}" alt="photo-profile">
                                                        </div>
                                                        <div class="info">
                                                            <span class="name">${ comment.customer_name }</span>
                                                            <span class="date">${ comment.comment_date }</span>
                                                        </div>
                                                    </div>
                                                    <div class="comment">
                                                        <p class="comment-user">${ comment.comment }</p>
                                                    </div>
                                                </div>`; 
                                } else if( index < allCommentsElement.length ) {
                                    comments += `<div class="ulasan">
                                                    <div class="account">
                                                        <div class="photo">
                                                            <img src="${comment.customer_photo}" alt="photo-profile">
                                                        </div>
                                                        <div class="info">
                                                            <a href="" class="name">${ comment.customer_name }</a>
                                                            <span class="date">${ comment.comment_date }</span>
                                                        </div>
                                                    </div>
                                                    <div class="comment">
                                                        <p class="comment-user">${ comment.comment }</p>
                                                    </div>
                                                </div>`; 
                                }
                            })
                            
                            commentsWrapper.innerHTML = comments
                            inputComment.value = '';
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
            });
        }
    </script>
@endsection
