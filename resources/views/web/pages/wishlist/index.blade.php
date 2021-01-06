@extends('web.layouts.app')

@section('content')
<div class="products-container">
    <div class="products-text-wrapper">
        <h1 class="related-product-title text-555 mt-13 mb-5"><i class="zmdi zmdi-favorite text-pink mr-4"></i> Daftar Wishlist </h1>
    </div>
    <div class="products-wrapper home-recommendation-products-wrapper not-using-slick {{ count($wishlists) >= 5 ? 'justify-content-space-between' : '' }}">
        @forelse ($wishlists as $wishlist)
            <a href="{{ url('/product/' . $wishlist->product->product_slug) }}" class="product {{ count($wishlists) < 5 ? 'mr-lg-18' : '' }}">
                <div class="thumb-product">
                    <img class="product-image" src="{{ asset('/storage/images/products/' . json_decode($wishlist->product->product_images)[0]->name) }}" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ strlen($wishlist->product->product_name) >= 23 ? substr($wishlist->product->product_name, 0, 23) . '...' : $wishlist->product->product_name }}</h5>
                    <div class="price-wrapper">
                        @if (!is_null($wishlist->product->discount))
                            @if ( $wishlist->product->discount->forever == true )
                                <h4>Rp. {{ number_format(floor($wishlist->product->price - ($wishlist->product->price * $wishlist->product->discount->discount_percent / 100)), 0, '.', '.') }}</h4>
                            @elseif(strtotime($wishlist->product->discount->end_date) >= strtotime(date('d-m-y')))
                                <h4>Rp. {{ number_format(floor($wishlist->product->price - ($wishlist->product->price * $wishlist->product->discount->discount_percent / 100)), 0, '.', '.') }}</h4>
                            @else
                                <h4>Rp. {{ number_format($wishlist->product->price, 0, '.', '.') }}</h4>
                            @endif
                        @else
                            <h4>Rp. {{ number_format($wishlist->product->price, 0, '.', '.') }}</h4>
                        @endif
                        @if (!is_null($wishlist->product->discount))
                            @if ( $wishlist->product->discount->forever == true )
                                <div class="discount">
                                    <h5 class="text-555"><strike>Rp. {{ number_format($wishlist->product->price, 0, '.', '.') }}</strike></h5>
                                    <span>{{ $wishlist->product->discount->discount_percent }}% OFF</span>
                                </div>  
                            @elseif(strtotime($wishlist->product->discount->end_date) >= strtotime(date('d-m-y')))
                                <div class="discount">
                                    <h5 class="text-555"><strike>Rp. {{ number_format($wishlist->product->price, 0, '.', '.') }}</strike></h5>
                                    <span>{{ $wishlist->product->discount->discount_percent }}% OFF</span>
                                </div>  
                            @endif
                        @endif
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok {{ number_format($wishlist->product->amount, 0, '.', '.') }}</span>
                        @if ($wishlist->product->sold > 0)
                            <span class="sold">{{ number_format($wishlist->product->sold, 0, '.', '.') }} Terjual</span>
                        @endif
                    </div>
                    <div class="wishlist-delete-from-wishlist-wrapper">
                        <button onclick="deleteFromWishlist({{$wishlist->product->id}})"><i class="zmdi zmdi-delete mr-2"></i> Hapus Dari Wishlist</button>
                    </div>
                </div>
            </a>
        @empty
            <div class="empty-product-wrapper">
                <img src="{{ asset('/images/assets/undraw_fall_thyk.png') }}" alt="" class="img-empty-product">
                <h2 class="text-empty">
                    <span>Kamu belum menambahkan</span>
                    <span>daftar wishlist</span>
                </h2>
            </div>
        @endforelse
    </div>
    <form action="{{ url('/wishlist-page-delete-wishlist') }}" method="POST" id="form-delete-wishlist">
        @csrf
    </form>
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
        if(`{{session('success')}}` != `` ? true : false) {
            console.log('ok')
            Toast.fire({
                icon: 'success',
                title: `{{session('success')}}`,
            });
        } else if(`{{session('failed')}}` != `` ? true : false   ) {
            Toast.fire({
                icon: 'error',
                title: `{{session('failed')}}`,
            });
        }
    </script>
    <script>
        function deleteFromWishlist(product_id) {
            event.preventDefault();
            if(confirm('Apakah anda yakin akan menghapus produk dari wishlist')) {
                const form = document.getElementById('form-delete-wishlist');
                form.innerHTML += `<input type="hidden" name="product_id" value="${product_id}" />`;
                form.submit();
            }
        }
    </script>
@endsection