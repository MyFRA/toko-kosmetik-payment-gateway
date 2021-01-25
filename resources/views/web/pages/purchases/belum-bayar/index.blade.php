@extends('web.layouts.app')

@section('content')
<div class="purchases-web-container">
    <h1 class="related-product-title text-555 mt-13 mb-5"><i class="zmdi zmdi-card mr-4"></i> {{ $title }} </h1>

    <div class="purchases-wrapper">
        @foreach ($sales as $sale)
            <div class="purchases">
                @foreach ($sale->products as $product)
                    <div class="product">
                        <div class="photo-product">
                            <img src="{{ $product->product_image_url }}" alt="photo-product">
                        </div>
                        <div class="desc-product">
                            <div class="top">
                                <span class="name">{{ $product->product_name }}</span>
                                @if ($product->variant)
                                    <span class="variant">{{ $product->variant }}</span>
                                @endif
                                <span class="price-and-amount">
                                    <span>Rp. {{ number_format($product->product_price_after_discount, 0, '.', '.') }}</span>
                                    <span>X {{ $product->product_amount }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="amount-total">
                    <div class="row">
                        <span class="left">Status</span>
                        <span class="right">{{ $sale->status }}</span>
                    </div>
                    <div class="row">
                        <span class="left">Jumlah</span>
                        <span class="right">{{ $sale->amount_total }}</span>
                    </div>
                    <div class="row">
                        <span class="left">Biaya Expedisi</span>
                        <span class="right">Rp. {{ number_format($sale->expedition->price_expedition, 0, '.', '.') }}</span>
                    </div>
                    <div class="row">
                        <span class="left">Harga Produk total</span>
                        <span class="right">Rp. {{ number_format((int) $sale->price_total - (int) $sale->expedition->price_expedition, 0, '.', '.') }}</span>
                    </div>
                    <div class="row">
                        <span class="left">Harga total</span>
                        <span class="right">Rp. {{ number_format($sale->price_total, 0, '.', '.') }}</span>
                    </div>
                </div>
               @if ($sale->status == 'belum bayar')
                    <a href="{{ url('/cart/checkout/payment-transfer/' . $sale->id) }}" class="bayar-sekarang">BAYAR SEKARANG</a>
               @elseif($sale->status == 'dikirim')
                    <a href="" class="bayar-sekarang" onclick="confirmProductBeAccepted(this)" data-sale_id="{{$sale->id}}" >KONFIRMASI BARANG DITERIMA</a>
               @endif
            </div>
        @endforeach
    </div>
</div>

<form action="{{ url('/confirm-product-be-accepted') }}" method="POST" id="confirmProductBeAccepted">
    @csrf
    <input type="hidden" name="sale_id" value="">
</form>
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
        if( {{session('failed') ? 'true' : 'false' }} ) {
            Toast.fire({
                icon: 'error',
                title: `{{ session('failed') }}`,
            })
        }
    </script>
        <script>
            if( {{session('success') ? 'true' : 'false' }} ) {
                Toast.fire({
                    icon: 'success',
                    title: `{{ session('success') }}`,
                })
            }
        </script>
    <script>
        function confirmProductBeAccepted(element) {
            event.preventDefault();
            const sale_id           = element.getAttribute('data-sale_id');
            const form              = document.getElementById('confirmProductBeAccepted');
            const input_sale_id     = document.querySelector('form#confirmProductBeAccepted input[name="sale_id"]');
            input_sale_id.value = sale_id;
            form.submit();
        }
    </script>
@endsection