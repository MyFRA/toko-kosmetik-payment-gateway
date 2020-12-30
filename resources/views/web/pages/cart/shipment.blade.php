@extends('web.layouts.app')

@section('content')
<section class="cart-shipment">
    <h3 class="checkout-title">Checkout</h3>
    <h4 class="shipment-address-title">Alamat Pengiriman</h4>
    <div class="shipment-wrapper">
        <div class="info-wrapper">
            <div class="full-address">
                <h4>Tomy Wibowo</h4>
                <span class="number-phone">085865721251</span>
                <span class="address-writen">purbalingga, rembang, losari, 1/4</span>
                <span class="address">Rembang, Kab. Purbalingga, 53356</span>
            </div>
            <button class="choose-address">Pilih Alamat Lain</button>
            <div class="shipment-cart-products">
                <div class="list-products">
                    <div class="product">
                        <img src="https://ecs7.tokopedia.net/img/cache/100-square/VqbcmM/2020/11/13/56cec66d-fe05-45de-8f60-dd7e40ac3113.jpg.webp" alt="thumb-product" class="thumb-product">
                        <div class="desc-product">
                            <span class="title-product">kaos distro samurai japan - XL, Putih</span>
                            <span class="price-product">Rp35.000</span>
                            <span class="amount-weight">5 barang (950 gr)</span>
                        </div>
                    </div>
                </div>
                <div class="expeditions-wrapper">
                    <span class="title-choose-expeditions">Pilih Expedisi</span>
                    <div class="select">
                        <select name="slct" id="slct">
                            <option selected disabled>Pengiriman</option>
                            <option value="1">Pure CSS</option>
                            <option value="2">No JS</option>
                            <option value="3">Nice!</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="total-price-wrapper">
            <div class="shopping-summary-wrapper">
                <div class="shopping-summary">
                    <span class="title">Ringkasan belanja</span>
                    <div class="amount-price">
                        <span class="amount">Total Harga (13 Produk)</span>
                        <span class="price">Rp799.493</span>
                    </div>
                    <div class="amount-price">
                        <span class="amount">Total Ongkos Kirim</span>
                        <span class="price">Rp50.493</span>
                    </div>
                </div>
                <div class="bill-pay-wrapper">
                    <div class="bill-total">
                        <span class="bill-text">Total Tagihan</span>
                        <span class="bill-amount">-</span>
                    </div>
                    <button class="choose-payment-buton">PILIH PEMBAYARAN</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('stylesheet')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#expedition').select2();
        });
    </script>
@endsection