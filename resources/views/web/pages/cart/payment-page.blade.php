@extends('web.layouts.app')

@section('content')
    <div class="payment-page-container">
        <div class="inner-payment-page-container">
            <div class="text-title-payment">
                <h2 class="text-finish-payment">Selesaikan Pembayaran Dalam</h2>
                <h3 class="time-limit-payment"></h3>
                <p>Batas Akhir Pembayaran</p>
                <h3 class="date-limit-payment">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($sale->limit_payment_date))->isoFormat('dddd, d MMMM Y HH:mm') }}</h3>
            </div>
            <div class="transfer-detail">
                <div class="bank-name-wrapper">
                    <span class="bank-name">
                        {{ $sale->bank->bank_name }}
                    </span>
                    <img src="{{ asset('/storage/images/bank-accounts/' . $sale->bank->bank_logo ) }}" alt="bank-account-logo">
                </div>
                <div class="bank-account-detail">
                    <div class="group">
                        <div class="left">
                            <label for="bank-account">Nomor Rekening</label>
                            <span class="bank-account" id="bank-account">
                                <span>{{ $sale->bank->bank_account_number }}</span>
                                <span class="owner"> A/N {{ $sale->bank->bank_account_name }} </span>
                                <input type="hidden" name="bank_account_number" id="bank_account_number" value="{{ $sale->bank->bank_account_number }}">
                            </span>
                        </div>
                        <div class="right">
                            <span class="copy-bank-account" onclick="copy_text()">Salin</span>
                        </div>
                    </div>
                    <div class="group">
                        <div class="left">
                            <label for="payment-total">Total Pembayaran</label>
                            <span class="payment-total" id="payment-total">Rp. {{ number_format($sale->price_total, 0, '.', '.') }}</span>
                        </div>
                        <div class="right">
                            <a href="{{ url('/sales/' . $sale->id) }}" class="view-detail">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="confirmation-proof-payment-wrapper">
                <hr>
                <h2>Konfirmasi Pembayaran</h2>
                <form action="{{ url('/cart/checkout/payment-transfer/' . $sale->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="group">
                        <label for="">Bukti Pembayaran</label>
                        <div class="upload-trigger">
                            <span><i class="zmdi zmdi-cloud-upload"></i></span>
                            <span>Sentuh Untuk Upload</span>
                        </div>
                        <div class="preview-proof-payment">
                            <img src="{{ asset('/images/icons/image-icon.png') }}"/> 
                            <div class="close-button d-none">
                                <span><i class="zmdi zmdi-close"></i></span>
                            </div>
                        </div>
                        <input type="file" class="d-none" name="proof_of_payment">
                        @error('proof_of_payment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="group">
                        <label for="bank-sender-account-name">Nama Pengirim di Rekening</label>
                        <input type="text" name="bank_sender_account_name" id="bank-sender-account-name" placeholder="Nama Pengirim" class="@error('bank_sender_account_name') is-invalid @enderror" value="{{old('bank_sender_account_name')}}">
                        @error('bank_sender_account_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="group">
                        <button type="submit" id="submit-proof-payment">Kirimkan Bukti Pembayaran</button>
                    </div>
                </form>

                <div class="menu-choose">
                    <a href="{{ url('/product') }}">Belanja Lagi</a>
                    <a href="{{ url('/purchases/' . $sale->id) }}">Cek Detail Pembelian</a>
                </div>
            </div>
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
        const end_date = new Date("{{ \Carbon\Carbon::createFromTimeStamp(strtotime($sale->limit_payment_date))->dayName . ', ' . \Carbon\Carbon::createFromTimeStamp(strtotime($sale->limit_payment_date))->format('d F Y H:i') }}").getTime();

        let backOff = setInterval(() => {
            const dateNow  = new Date().getTime();
            const distance = end_date - dateNow;

            const hours     = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes   = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds   = Math.floor((distance % (1000 * 60)) / 1000);

            if( hours < 0 ) {
                document.querySelector('.time-limit-payment').innerHTML = `Pembayaran Telah Expired`;
            } else {
                document.querySelector('.time-limit-payment').innerHTML = `${hours}:${minutes}:${seconds}`;
            }
        }, 1000);
    </script>

    <script>
        const upload_file_trigger   = document.querySelector('.upload-trigger');
        const input_type_file       = document.querySelector('input[name="proof_of_payment"]');
        const preview_proof_payment = document.querySelector('.preview-proof-payment');
        const proof_image_preview   = document.querySelector('.preview-proof-payment img');

        upload_file_trigger.addEventListener('click', () => {
            input_type_file.click();
        });

        input_type_file.addEventListener('change', () => {
            const reader = new FileReader();
            reader.onload = function() {
                proof_image_preview.setAttribute('src', reader.result);
            }
            reader.readAsDataURL(input_type_file.files[0]);
        });
    </script>
    <script>
        function copy_text() {
            var valueText = $("#bank_account_number").select().val();
            document.execCommand("copy");
            Toast.fire({
                icon: 'success',
                title: 'Nomor Rekening telah disalin'
            });
        }
    </script>
    <script>
        preview_proof_payment.addEventListener('click', (e) => {
            if(e.target.tagName == 'IMG') {
                const img = e.target;

                img.parentElement.classList.add('clicked');
                img.classList.add('img-proof-preview');
                img.classList.add('popup');
                img.nextElementSibling.classList.remove('d-none');
            }
        });
    </script>

    <script>
        document.querySelector('.close-button').addEventListener('click', (e) => {
            document.querySelector('.clicked').classList.remove('clicked');
            document.querySelector('img.img-proof-preview').classList.remove('popup');
            document.querySelector('img.img-proof-preview').classList.remove('img-proof-preview');
            if( e.target.tagName == 'I' ) {
                e.target.parentElement.parentElement.classList.add('d-none');
            } else if( e.target.tagName == 'SPAN' ){
                e.target.parentElement.classList.add('d-none');
            } else {
                e.target.classList.add('d-none');
            }
        });
    </script>
    <script>
        if({{session('form-failed') ? 'true' : 'false'}}) {
            Toast.fire({
                icon: 'error',
                title: '{{session('form-failed')}}'
            });
        }
    </script>
@endsection