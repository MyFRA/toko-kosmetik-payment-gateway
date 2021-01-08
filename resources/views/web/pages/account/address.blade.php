@extends('web.layouts.app')

@section('content')
<div class="account-index">
    <h3 class="font-weight-bold title padding-responsive text-666">{{ Auth::guard('customer')->user()->fullname }}</h3>
    <div class="account-profile">
        <div class="link-wrapper">
            <a href="{{ url('/account') }}" class="">Biodata Diri</a>
            <a href="{{ url('/account/address') }}" class="active">Daftar Alamat</a>
        </div>
        <div class="content-wrapper daftar-alamat">
            <div class="px-15 py-20">
                <div class="alert-success-wrapper"></div>
                <button class="button-tambah-alamat" id="button-trigger-tambah-alamat" data-modal="false"><i class="zmdi zmdi-plus mr-3"></i> Tambah Alamat Baru</button>
                <div class="overlay-modal-form-address d-none">
                    <div class="modal-wrapper-form-address">
                        <h2 class="title">Tambah Alamat Baru</h2>
                        <div class="alert-error-wrapper"></div>
                        <div class="form">
                            <div class="row address-name">
                                <div class="form-group">
                                    <label for="address_name">Nama Alamat</label>
                                    <input type="text" name="address_name" id="address_name" autocomplete="off">
                                    <small>Contoh: Alamat Rumah, Kantor, Apartemen dll</small>
                                </div>
                            </div>
                            <div class="row receiver-number-phone">
                                <div class="form-group ">
                                    <label for="customer_name">Nama Penerima</label>
                                    <input type="text" name="customer_name" id="customer_name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="number_phone">Nomor HP</label>
                                    <input type="number" name="number_phone" id="number_phone" autocomplete="off">
                                </div>
                            </div>
                            <div class="row district-postal-code">
                                <div class="form-group">
                                    <label for="region">Kota atau Kecamatan</label>
                                    <select name="region" id="region">
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->province->province . ', ' . $region->city_name}}">{{ $region->province->province . ', ' . $region->city_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Kode POS</label>
                                    <input type="number" name="postal_code" id="postal_code" autocomplete="off">
                                </div>
                            </div>
                            <div class="row address">
                                <div class="form-group">
                                    <label for="address">Alamat Lengkap</label>
                                    <textarea name="address" id="address" cols="30" rows="10" placeholder="Alamat Lengkap" autocomplete="off"></textarea>
                                </div>
                            </div>
                            <div class="button-wrapper">
                                <button class="close"><i class="zmdi zmdi-close mr-3"></i> Batal</button>
                                <button class="save"><i class="zmdi zmdi-plus mr-3"></i> Tambah</button>
                            </div>
                        </div>
                        <button class="close-button" id="close-button-modal-address"><i class="zmdi zmdi-close font-weight-bold"></i></button>
                    </div>
                </div>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="list-address-wrapper">
                    <h3>Daftar Alamat</h3>
                    <div class="list-address">
                        @foreach ($addresses as $address)
                            <div class="address">
                                <h5 class="address-name">Alamat {{ $address->address_name }} {!! $address->main_address ? '<span>Alamat Utama</span>' : '' !!}</h5>
                                <h4 class="customer-name">{{ $address->customer_name }}</h4>
                                <div class="alamat-wrapper">
                                    <h5>Alamat Pengiriman</h5>
                                    <p>{{ $address->province }}, {{ $address->city }}, {{ $address->postal_code }}</p>
                                </div>
                                <div class="alamat-wrapper">
                                    <h5>Alamat Lengkap</h5>
                                    <p>{{ $address->full_address }}</p>
                                </div>
                                <div class="list-alamat-button-wrapper">
                                    <button class="edit-alamat"><i class="zmdi zmdi-edit mr-2"></i> Ubah Alamat</button>
                                    <button class="delete-alamat" onclick="deleteAdrress({{$address->id}})"><i class="zmdi zmdi-delete mr-2"></i> Hapus Alamat</button>
                                    @if (!$address->main_address)
                                        <button class="set-active" onclick="setActive({{$address->id}})"><i class="zmdi zmdi-check mr-2"></i> Setel Sebagai Alamat Utama</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        const list_address_wrapper = document.querySelector('.list-address');
    </script>
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
        const button_trigger_tambah_alamat  = document.getElementById('button-trigger-tambah-alamat');
        const overlay                       = document.querySelector('.overlay-modal-form-address');
        const close_modal                   = document.getElementById('close-button-modal-address');
        const button_cancel                 = document.querySelector('button.close');

        button_trigger_tambah_alamat.addEventListener('click', () => {
            if(button_trigger_tambah_alamat.getAttribute('data-modal') == 'false') {
                overlay.classList.remove('d-none');
                overlay.children[0].classList.add('popup');
                button_trigger_tambah_alamat.setAttribute('data-modal', 'true');
            }
        });

        close_modal.addEventListener('click', () => {
            if(button_trigger_tambah_alamat.getAttribute('data-modal') == 'true') {
                overlay.classList.add('d-none');
                overlay.children[0].classList.remove('popup');
                button_trigger_tambah_alamat.setAttribute('data-modal', 'false');
            }
        });

        button_cancel.addEventListener('click', () => {
            if(button_trigger_tambah_alamat.getAttribute('data-modal') == 'true') {
                overlay.classList.add('d-none');
                overlay.children[0].classList.remove('popup');
                button_trigger_tambah_alamat.setAttribute('data-modal', 'false');
            }
        })
    </script>
    <script>
        const button_submit = document.querySelector('.save');
        const available_name    = ['address_name', 'customer_name', 'number_phone', 'region', 'postal_code', 'address'];
        const alert_success_wrapper = document.querySelector('.alert-success-wrapper');
        const alert_error_wrapper = document.querySelector('.alert-error-wrapper');

        button_submit.addEventListener('click', () => {
            event.preventDefault();
            const url = `{{url('/account/address')}}`;
            const data = {
                '_token'     : document.getElementById('token').value,
                address_name : document.querySelector("input[name='address_name']").value,
                customer_name: document.querySelector("input[name='customer_name']").value,
                number_phone : document.querySelector("input[name='number_phone']").value,
                region       : document.querySelector("select[name='region']").value,      
                postal_code  : document.querySelector("input[name='postal_code']").value,
                address      : document.querySelector("textarea[name='address']").value
            };
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type' : 'application/json',
                },
                body : JSON.stringify(data),
            }).then(response => response.json())
            .then((res) => {
                if(res.code == 200 && res.success) {
                    alert_success_wrapper.innerHTML = `<div class="alert alert-success mb-7">
                                                            <span class="font-weight-bold">Berhasil, </span> ${res.message}
                                                        </div>`;
                    overlay.classList.add('d-none');
                    overlay.children[0].classList.remove('popup');
                    button_trigger_tambah_alamat.setAttribute('data-modal', 'false');

                    available_name.forEach((name) => {
                        const element = document.getElementById(name);
                        element.value = '';
                        if(element.classList.contains('is-invalid')) {
                            element.classList.remove('is-invalid');
                        }
                        alert_error_wrapper.innerHTML = '';

                        const addresses         = res.data.addresses;
                        list_address_wrapper.innerHTML = '';
                        addresses.forEach((address) => {
                            list_address_wrapper.innerHTML += `<div class="address">
                                                                    <h5 class="address-name">Alamat ${address.address_name} ${address.main_address ? `<span>Alamat Utama</span>` : ``}</h5>
                                                                    <h4 class="customer-name">${ address.customer_name }</h4>
                                                                    <div class="alamat-wrapper">
                                                                        <h5>Alamat Pengiriman</h5>
                                                                        <p>${ address.province }, ${ address.city }, ${ address.postal_code }</p>
                                                                    </div>
                                                                    <div class="alamat-wrapper">
                                                                        <h5>Alamat Lengkap</h5>
                                                                        <p>${ address.full_address }</p>
                                                                    </div>
                                                                    <div class="list-alamat-button-wrapper">
                                                                        <button class="edit-alamat"><i class="zmdi zmdi-edit mr-2"></i> Ubah Alamat</button>
                                                                        <button class="delete-alamat" onclick="deleteAdrress({{$address->id}})"><i class="zmdi zmdi-delete mr-2"></i> Hapus Alamat</button>
                                                                        ${!address.main_address ? 
                                                                            `<button class="set-active" onclick="setActive(${address.id})"><i class="zmdi zmdi-check mr-2"></i> Setel Sebagai Alamat Utama</button>`
                                                                            :
                                                                            ``}
                                                                    </div>
                                                                </div>`
                        });
                        Toast.fire({
                            icon: 'success',
                            title: res.message,
                        });
                    });
                } else {
                    let errors            = res.data.errors;
                    available_name.forEach((name) => {
                        const element = document.getElementById(name);
                        if(errors.hasOwnProperty(name)) {
                            if(!element.classList.contains('is-invalid')) {
                                element.classList.add('is-invalid');
                            }
                        } else {
                            if(element.classList.contains('is-invalid')) {
                                element.classList.remove('is-invalid');
                            }
                        }
                    });
                    alert_error_wrapper.innerHTML = `<div class="alert alert-danger mt-n15 mb-6" style="font-size: 13px !important">
                                                            <span class="font-weight-bold">Gagal, </span>${res.message}
                                                        </div>`
                }
            })
        });
    </script>
    <script>
        function setActive(address_id) {
            const url        = '{{ url('/account/address/set-active')}}';

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body : JSON.stringify({
                    _token : document.getElementById('token').value,
                    address_id: address_id,
                }),
            }).then(response => response.json())
            .then((res) => {
                if(res.code == 200 && res.success) {
                    const addresses         = res.data.addresses;
                    list_address_wrapper.innerHTML = '';
                    addresses.forEach((address) => {
                        list_address_wrapper.innerHTML += `<div class="address">
                                                                <h5 class="address-name">Alamat ${address.address_name} ${address.main_address ? `<span>Alamat Utama</span>` : ``}</h5>
                                                                <h4 class="customer-name">${ address.customer_name }</h4>
                                                                <div class="alamat-wrapper">
                                                                    <h5>Alamat Pengiriman</h5>
                                                                    <p>${ address.province }, ${ address.city }, ${ address.postal_code }</p>
                                                                </div>
                                                                <div class="alamat-wrapper">
                                                                    <h5>Alamat Lengkap</h5>
                                                                    <p>${ address.full_address }</p>
                                                                </div>
                                                                <div class="list-alamat-button-wrapper">
                                                                    <button class="edit-alamat"><i class="zmdi zmdi-edit mr-2"></i> Ubah Alamat</button>
                                                                    <button class="delete-alamat" onclick="deleteAdrress({{$address->id}})"><i class="zmdi zmdi-delete mr-2"></i> Hapus Alamat</button>
                                                                    ${!address.main_address ? 
                                                                        `<button class="set-active" onclick="setActive(${address.id})"><i class="zmdi zmdi-check mr-2"></i> Setel Sebagai Alamat Utama</button>`
                                                                        :
                                                                        ``}
                                                                </div>
                                                            </div>`
                    });
                    Toast.fire({
                        icon: 'success',
                        title: res.message,
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
        function deleteAdrress(address_id) {
            if(confirm('Apakah anda yakin akan menghapus alamat?')) {
                const url = '{{ url('/account/delete-address')}}';
                fetch(url, {
                    method      : 'POST',
                    'headers'   : {
                        'Content-Type' : 'application/json',
                    },
                    body : JSON.stringify({
                        '_token'     : document.getElementById('token').value,
                        'address_id' : address_id,
                    }),
                }).then(response => response.json())
                .then((res) => {
                    if(res.code == 200 && res.success) {
                        const addresses         = res.data.addresses;
                        list_address_wrapper.innerHTML = '';
                        addresses.forEach((address) => {
                            list_address_wrapper.innerHTML += `<div class="address">
                                                                    <h5 class="address-name">Alamat ${address.address_name} ${address.main_address ? `<span>Alamat Utama</span>` : ``}</h5>
                                                                    <h4 class="customer-name">${ address.customer_name }</h4>
                                                                    <div class="alamat-wrapper">
                                                                        <h5>Alamat Pengiriman</h5>
                                                                        <p>${ address.province }, ${ address.city }, ${ address.postal_code }</p>
                                                                    </div>
                                                                    <div class="alamat-wrapper">
                                                                        <h5>Alamat Lengkap</h5>
                                                                        <p>${ address.full_address }</p>
                                                                    </div>
                                                                    <div class="list-alamat-button-wrapper">
                                                                        <button class="edit-alamat"><i class="zmdi zmdi-edit mr-2"></i> Ubah Alamat</button>
                                                                        <button class="delete-alamat" onclick="deleteAdrress({{$address->id}})"><i class="zmdi zmdi-delete mr-2"></i> Hapus Alamat</button>
                                                                        ${!address.main_address ? 
                                                                            `<button class="set-active" onclick="setActive(${address.id})"><i class="zmdi zmdi-check mr-2"></i> Setel Sebagai Alamat Utama</button>`
                                                                            :
                                                                            ``}
                                                                    </div>
                                                                </div>`
                        });
                        Toast.fire({
                            icon: 'success',
                            title: res.message,
                        });
                    } else {
                        Toast.fire({
                            'icon'  : 'error',
                            'title' : res.message,
                        });
                    }
                });
            }
        }
    </script>
@endsection