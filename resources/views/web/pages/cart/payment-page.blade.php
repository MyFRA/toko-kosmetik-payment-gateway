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
                                <span class="owner"> A/N TOMY WIBOWO </span>
                            </span>
                        </div>
                        <div class="right">
                            <span class="copy-bank-account">Salin</span>
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
                <form action="">
                    <div class="group">
                        <label for="">Bukti Pembayaran</label>
                        <div class="upload-trigger">
                            <span><i class="zmdi zmdi-cloud-upload"></i></span>
                            <span>Sentuh Untuk Upload</span>
                        </div>
                        <div class="preview-proof-payment"></div>
                        <input type="file" class="d-none" name="proof_of_payment">
                    </div>
                    <div class="group">
                        <label for="bank-sender-account-name">Nama Pengirim di Rekening</label>
                        <input type="text" name="bank-sender-account-name" id="bank-sender-account-name" placeholder="Nama Pengirim">
                    </div>
                    <div class="group">
                        <button type="submit">Kirimkan Bukti Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const end_date = new Date("{{ \Carbon\Carbon::createFromTimeStamp(strtotime($sale->limit_payment_date))->dayName . ', ' . \Carbon\Carbon::createFromTimeStamp(strtotime($sale->limit_payment_date))->format('d F Y H:i') }}").getTime();

        let backOff = setInterval(() => {
            const dateNow  = new Date().getTime();
            const distance = end_date - dateNow;

            const hours     = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes   = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds   = Math.floor((distance % (1000 * 60)) / 1000);

            document.querySelector('.time-limit-payment').innerHTML = `${hours}:${minutes}:${seconds}`;
        }, 1000);
    </script>

    <script>
        const upload_file_trigger   = document.querySelector('.upload-trigger');
        const input_type_file       = document.querySelector('input[name="proof_of_payment"]');
        const preview_proof_payment = document.querySelector('.preview-proof-payment');

        upload_file_trigger.addEventListener('click', () => {
            input_type_file.click();
        });

        input_type_file.addEventListener('change', () => {
            const reader = new FileReader();
            reader.onload = function() {
                preview_proof_payment.innerHTML =  `<img src="${reader.result}"/>`;
            }
            reader.readAsDataURL(input_type_file.files[0]);
        });
    </script>
@endsection