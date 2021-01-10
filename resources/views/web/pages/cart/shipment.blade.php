@extends('web.layouts.app')

@section('content')
<section class="cart-shipment">
    <h3 class="checkout-title">Checkout</h3>
    <h4 class="shipment-address-title" data-address_used_id="{{ $address ? $address->id : '' }}" data-address_city_id="{{ $address ? $address->city_id : '' }}">Alamat Pengiriman</h4>
    <div class="shipment-wrapper">
        <div class="info-wrapper">
            <div class="full-address">
                <h6 style="font-weight: 600" class="mb-3">{{ $address->address_name }}</h6>
                <h4>{{ $address->customer_name }}</h4>
                <span class="number-phone">{{ $address->number_phone }}</span>
                <span class="address">{{ $address->province->province }}, {{ $address->city->city_name }} - {{ $address->postal_code }}</span>
                <span class="address-writen">{{ $address->full_address }}</span>
            </div>
            <button class="choose-address">Pilih Alamat Lain</button>
            <div class="shipment-cart-products">
                <div class="list-products">
                    @foreach ($carts as $cart)
                        <div class="product">
                            <img src="https://ecs7.tokopedia.net/img/cache/100-square/VqbcmM/2020/11/13/56cec66d-fe05-45de-8f60-dd7e40ac3113.jpg.webp" alt="thumb-product" class="thumb-product">
                            <div class="desc-product">
                                <span class="title-product">kaos distro samurai japan - XL, Putih</span>
                                <span class="price-product">Rp35.000</span>
                                <span class="amount-weight">5 barang (950 gr)</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="expeditions-wrapper">
                    <button class="choose-expedition">
                        <span></span>
                        <span class="pilih-pengiriman">Pilih Pengiriman</span>
                        <span><i class="zmdi zmdi-chevron-down font-weight-bold"></i></span>
                    </button>    
                    <div class="place-choosed-expedition-wrapper">

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


    <!-- Modal Choose Address -->
    <div class="overlay-choose-address d-none" data-modal_show="false">
        <div class="modal-choose-address">
            <h2 class="title">Pilih Alamat</h2>
            <div class="address-wrapper">
                @foreach ($addresses as $row_address)
                    <div class="address {{ $row_address->id == $address->id ? 'active' : '' }}">
                        <h5 class="address-name">Alamat {{ $row_address->address_name }} {!! $row_address->main_address ? '<span>Alamat Utama</span>' : '' !!}</h5>
                        <h4 class="customer-name">{{ $row_address->customer_name }}</h4>
                        <div class="alamat-wrapper">
                            <h5>Alamat Pengiriman</h5>
                            <p>{{ $row_address->province->province }}, {{ $row_address->city->city_name }}, {{ $row_address->postal_code }}</p>
                        </div>
                        <div class="alamat-wrapper">
                            <h5>Alamat Lengkap</h5>
                            <p>{{ $row_address->full_address }}</p>
                        </div>
                        <div class="alamat-wrapper">
                            <h5>Nomor HP</h5>
                            <p>{{ $row_address->number_phone }}</p>
                        </div>
                        @if ($row_address->id != $address->id)
                            <div class="list-alamat-button-wrapper">
                                <button class="delete-alamat" onclick="chooseAddressToShipment({{$row_address->id}})">Pilih Alamat</button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="close-button-choose-address">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
    </div>

    <!-- Modal Choose expedition -->
    <div class="overlay-choose-expedition d-none" data-modal_show="false">
        <div class="modal-choose-expedition">
            <h2 class="title">Pilih Pengirimanan</h2>
            <div class="modal-expeditions-wrapper">
                
            </div>
            <div class="close-button-choose-expedition">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
    </div>
</section>
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
        const button_choose_address         = document.querySelector('button.choose-address');
        const overlay_choose_address        = document.querySelector('.overlay-choose-address'); 
        const close_button_choose_address   = document.querySelector('.close-button-choose-address');
        
        button_choose_address.addEventListener('click', () => {
            const modal_show = overlay_choose_address.getAttribute('data-modal_show');
            if( modal_show == 'false' ) {
                overlay_choose_address.classList.remove('d-none');
                overlay_choose_address.setAttribute('data-modal_show', 'true');
                overlay_choose_address.children[0].classList.add('popup');
            }
        });

        close_button_choose_address.addEventListener('click', () => {
            const modal_show = overlay_choose_address.getAttribute('data-modal_show');
            if( modal_show == 'true' ) {
                overlay_choose_address.classList.add('d-none');
                overlay_choose_address.setAttribute('data-modal_show', 'false');
                overlay_choose_address.children[0].classList.remove('popup');
            }
        })

        function chooseAddressToShipment(address_id) {
            const url = '{{ url('/account/address')}}' + `/${address_id}/json`;
            fetch(url).then(response => response.json())
                .then((res) => {
                    if(res.code == 200 && res.success) {
                        const address = res.data.address;
                        const element_address_name      = document.querySelector('.full-address h6');
                        const element_customer_name     = document.querySelector('.full-address h4');
                        const element_number_phone      = document.querySelector('.full-address span.number-phone');
                        const element_address           = document.querySelector('.full-address span.address');
                        const element_address_writen    = document.querySelector('.full-address span.address-writen');
                        const element_address_used_id   = document.querySelector('.shipment-address-title');

                        element_address_name.innerHTML      = address.address_name;
                        element_customer_name.innerHTML     = address.customer_name;
                        element_number_phone.innerHTML      = address.number_phone;
                        element_address.innerHTML           = `${address.province_name}, ${address.city_name} - ${address.postal_code}`;
                        element_address_writen.innerHTML    = address.full_address;
                        element_address_used_id.setAttribute('data-address_used_id', address.id);
                        element_address_used_id.setAttribute('data-address_city_id', address.city_id);

                        overlay_choose_address.classList.add('d-none');
                        overlay_choose_address.setAttribute('data-modal_show', 'false');
                        overlay_choose_address.children[0].classList.remove('popup');

                        const address_wrapper = document.querySelector('.address-wrapper');
                        address_wrapper.innerHTML = '';
                        const url_get_all_address = `{{url('/account/address/json')}}`;
                        fetch(url_get_all_address).then(response => response.json())
                            .then((res) => {
                                const addresses = res.data.addresses;
                                const address_used_id = document.querySelector('.shipment-address-title').getAttribute('data-address_used_id');
                                addresses.forEach((address) => {
                                    address_wrapper.innerHTML += `
                                    <div class="address ${ address.id == address_used_id ? 'active' : '' }">
                                        <h5 class="address-name">Alamat ${ address.address_name } ${ address.main_address ? '<span>Alamat Utama</span>' : '' }</h5>
                                        <h4 class="customer-name">${ address.customer_name }</h4>
                                        <div class="alamat-wrapper">
                                            <h5>Alamat Pengiriman</h5>
                                            <p>${ address.province_name }, ${ address.city_name }, ${ address.postal_code }</p>
                                        </div>
                                        <div class="alamat-wrapper">
                                            <h5>Alamat Lengkap</h5>
                                            <p>${ address.full_address }</p>
                                        </div>
                                        <div class="alamat-wrapper">
                                            <h5>Nomor HP</h5>
                                            <p>${ address.number_phone }</p>
                                        </div>
                                        ${ address.id != address_used_id ? 
                                        `<div class="list-alamat-button-wrapper">
                                            <button class="delete-alamat" onclick="chooseAddressToShipment(${address.id})">Pilih Alamat</button>
                                         </div>`
                                        : ``}
                                    </div>`;
                                });
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Alamat telah diubah',
                                });
                            });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: res.message,
                        });
                    }
                });
        }
    </script>
    <script>
        const button_choose_expedition          = document.querySelector('button.choose-expedition');
        const close_button_choose_expedition    = document.querySelector('.close-button-choose-expedition');
        const overlay_choose_expedition         = document.querySelector('.overlay-choose-expedition'); 
        
        button_choose_expedition.addEventListener('click', () => {
            const modal_show = overlay_choose_expedition.getAttribute('data-modal_show');
            if( modal_show == 'false' ) {
                overlay_choose_expedition.classList.remove('d-none');
                overlay_choose_expedition.setAttribute('data-modal_show', 'true');
                overlay_choose_expedition.children[0].classList.add('popup');
            }

            const expeditions_wrapper       = document.querySelector('.modal-expeditions-wrapper');
            const title_choose_expeditions  = document.querySelector('.modal-choose-expedition h2.title');
            const element_address_city_id   = document.querySelector('.shipment-address-title');
            const city_id                   = element_address_city_id.getAttribute('data-address_city_id');

            const url_get_costs = `{{url('/api/get-costs')}}/` + `${city_id}` + `/${500}`;

            title_choose_expeditions.innerHTML = 'Harap Tunggu';
            fetch(url_get_costs).then(response => response.json())
                .then((res) => {
                    if(res.code == 200 && res.success) {
                        title_choose_expeditions.innerHTML = 'Pilih Pengiriman';
                        const response_expeditions = res.data.expeditions.rajaongkir.results[0].costs;
                        expeditions_wrapper.innerHTML = '';
                        response_expeditions.forEach((expedition) => {
                            expeditions_wrapper.innerHTML += `<div class="expedition" onclick="expeditionChoosed('${expedition.service}', '${expedition.cost[0].value}','${expedition.cost[0].etd}', '${expedition.description}')">
                                                                    <div>
                                                                        <span class="type">${expedition.service}</span>
                                                                        <span class="price">Rp ${formatRupiah(expedition.cost[0].value)}</span>
                                                                    </div>
                                                                    <span class="estimation">Estimasi tiba ${expedition.cost[0].etd}</span>
                                                                    <span class="desc">${expedition.description}</span>
                                                                </div>`;
                        });
                        const modal_show = overlay_choose_expedition.getAttribute('data-modal_show');
                    }
                });
        });

        close_button_choose_expedition.addEventListener('click', () => {
            const modal_show = overlay_choose_expedition.getAttribute('data-modal_show');
            const expeditions_wrapper       = document.querySelector('.modal-expeditions-wrapper');
            expeditions_wrapper.innerHTML = '';
            if( modal_show == 'true' ) {
                overlay_choose_expedition.classList.add('d-none');
                overlay_choose_expedition.setAttribute('data-modal_show', 'false');
                overlay_choose_expedition.children[0].classList.remove('popup');
            }

        })
    </script>
    <script>
        function expeditionChoosed(service, price, etd, desc) {
            const title_choose_expeditions  = document.querySelector('.choose-expedition .pilih-pengiriman');
            const place_expedition_wrapper  = document.querySelector('.place-choosed-expedition-wrapper');
            const expeditions_wrapper       = document.querySelector('.modal-expeditions-wrapper');

            title_choose_expeditions.innerHTML = 'JNE ' + service;
            place_expedition_wrapper.innerHTML = `<div class="choosed-expedition-wrapper">
                                                    <div>
                                                        <span class="type">JNE ${service}</span>
                                                        <span class="price">Rp ${formatRupiah(price)}</span>
                                                    </div>
                                                    <span class="estimation">Estimasi tiba ${etd} hari</span>
                                                    <span class="desc">${desc}</span>
                                                </div>`;
            const modal_show = overlay_choose_expedition.getAttribute('data-modal_show');
            expeditions_wrapper.innerHTML = '';
            if( modal_show == 'true' ) {
                overlay_choose_expedition.classList.add('d-none');
                overlay_choose_expedition.setAttribute('data-modal_show', 'false');
                overlay_choose_expedition.children[0].classList.remove('popup');
            }
        }
    </script>
@endsection