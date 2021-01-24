@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-header">
          <h4>Pembelian ~ Detail</h4>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <h6 class="text-dark">Ringkasan Pembelian</h6>
            <div class="group mt-2 px-3">
              <div class="table-responsive">
                <table class="table table-sm">
                  <tbody>
                    <tr>
                      <th>Nama Akun</th>
                      <td>{{ $sale->customer->fullname }}</td>
                    </tr>
                    <tr>
                      <th>Nama Pembeli</th>
                      <td>{{ $sale->address->customer_name }}</td>
                    </tr>
                    <tr>
                    <tr>
                      <th>Jumlah Total Produk</th>
                      <td>{{ $sale->amount_total }}</td>
                    </tr>
                    <th>Berat Total Produk (gram)</th>
                    <td>{{ number_format($sale->weight_total, 0, '.', '.') }} gram</td>
                  </tr>
                  <tr>
                    <th>Harga Total Produk</th>
                    <td>Rp. {{ number_format($sale->price_total, 0, '.', '.') }}</td>
                  </tr>
                  <tr>
                    <th>Checkout Pada</th>
                    <td>{{ $sale->start_payment_date }}</td>
                  </tr>
                  <tr>
                    <th>Nama Pengirim Rekening</th>
                    <td>{{ $sale->bank_sender_account_name ? $sale->bank_sender_account_name : '-' }}</td>
                  </tr>
                  <tr>
                    <th>Status </th>
                    <td>
                      @if ($sale->status == 'belum bayar')
                        <button class="btn btn-sm btn-dark">{{ $sale->status }}</button>
                      @elseif($sale->status == 'menunggu konfirmasi bukti pembayaran')
                        <button class="btn btn-sm btn-primary">{{ $sale->status }}</button>
                      @elseif($sale->status == 'dikirim')
                        <button class="btn btn-sm btn-info">{{ $sale->status }}</button>      
                      @elseif($sale->status == 'diterima')
                        <button class="btn btn-sm btn-success">{{ $sale->status }}</button>     
                      @elseif($sale->status == 'expired')
                        <button class="btn btn-sm btn-danger">{{ $sale->status }}</button>     
                      @endif
                    </td>
                  </tr>
                  </tbody>
                </table>
                @if ($sale->status == 'menunggu konfirmasi bukti pembayaran')
                  <form action="{{ url('/app-admin/purchases/confirm-proof-payment/' . $sale->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-primary w-100 my-2" type="submit">Konfirmasi Bukti Pembayaran</button>
                  </form>
                @endif
              </div>
            </div>
          </div>
          <div class="mb-3">
            <h6 class="text-dark">Produk Pembelian</h6>
            @foreach ($sale->products as $product)
              <div class="group mt-2 px-3">
                <div class="table-responsive">
                  <table class="table table-sm">
                    <tbody>
                      <tr>
                        <th>Nama Produk</th>
                        <td>{{ $product->product_name }}</td>
                      </tr>
                      <tr>
                        <th>Produk Varian</th>
                        <td>{{ $product->product_variant ? $product->variant : '-' }}</td>
                      </tr>
                      <tr>
                        <th>Link Produk</th>
                        <td><a href="{{ url($product->product_url) }}" class="btn btn-sm btn-success">Lihat</a></td>
                      </tr>
                      <tr>
                        <th>Jumlah Produk</th>
                        <td>{{ $product->product_amount }}</td>
                      </tr>
                      <tr>
                        <th>Berat Produk</th>
                        <td>{{ $product->product_weight }} gram</td>
                      </tr>
                      <tr>
                        <th>Diskon Produk Persen</th>
                        <td>{{ $product->product_discount_percent ? $product->product_discount_percent . '%' : '-' }}</td>
                      </tr>
                      <tr>
                        <th>Harga Asli Produk</th>
                        <td>Rp. {{ number_format($product->product_price, 0, '.', '.') }}</td>
                      </tr>
                      <tr>
                        <th>Harga Produk Setelah Diskon</th>
                        <td>Rp. {{ number_format($product->product_price_after_discount, 0, '.', '.') }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
            @endforeach
          </div>
          <div class="mb-3">
            <h6 class="text-dark">Alamat Pembeli</h6>
            <div class="group mt-2 px-3">
              <div class="table-responsive">
                <table class="table table-sm">
                  <tbody>
                    <tr>
                      <th>Nama Alamat</th>
                      <td>{{ $sale->address->address_name }}</td>
                    </tr>
                    <tr>
                      <th>Nama Pembeli</th>
                      <td>{{ $sale->address->customer_name }}</td>
                    </tr>
                    <tr>
                    <tr>
                      <th>Nomor HP</th>
                      <td>{{ $sale->address->number_phone }}</td>
                    </tr>
                    <th>Provinsi</th>
                    <td>{{ $sale->address->province }}</td>
                  </tr>
                  <tr>
                    <th>Kota</th>
                    <td>{{ $sale->address->city }}</td>
                  </tr>
                  <tr>
                    <th>Kode Pos</th>
                    <td>{{ $sale->address->postal_code }}</td>
                  </tr>
                  <tr>
                    <th>Alamat Lengkap</th>
                    <td>{{ $sale->address->full_address }}</td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <h6 class="text-dark">Rekening Pembelian (Pemilik)</h6>
            <div class="group mt-2 px-3">
              <div class="table-responsive">
                <table class="table table-sm">
                  <tbody>
                    <tr>
                      <th>Nama Bank</th>
                      <td>{{ $sale->bank->bank_name }}</td>
                    </tr>
                    <tr>
                      <th>Nama Akun Bank A/N</th>
                      <td>{{ $sale->bank->bank_account_name }}</td>
                    </tr>
                    <tr>
                    <tr>
                      <th>Nomor Rekening</th>
                      <td>{{ $sale->bank->bank_account_number }}</td>
                    </tr>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <h6 class="text-dark">Kurir Pembelian</h6>
            <div class="group mt-2 px-3">
              <div class="table-responsive">
                <table class="table table-sm">
                  <tbody>
                    <tr>
                      <th>Nama Expedisi</th>
                      <td>JNE</td>
                    </tr>
                    <tr>
                      <th>Tipe Expedisi</th>
                      <td>{{ $sale->expedition->type_expedition }}</td>
                    </tr>
                    <tr>
                    <tr>
                      <th>Biaya Expedisi</th>
                      <td>{{ $sale->expedition->price_expedition }}</td>
                    </tr>
                    <tr>
                      <th>Deskripsi</th>
                      <td>{{ $sale->expedition->desc_expedition }}</td>
                    </tr>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <a href="{{ url()->previous() }}" class="btn btn-dark">Kembali</a>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card">
        <div class="card-header">
          <h4>Bukti Pembayaran</h4>
        </div>
        <div class="card-body">
          @if ($sale->proof_of_payment)
              <img src="{{ asset('/storage/images/proof-of-payments/' . $sale->proof_of_payment) }}" alt="proof-of-payment" class="w-100">
          @else
            <h4>Tidak ada foto bukti pembayaran</h4>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection