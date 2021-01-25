@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col">
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Berhasil</strong> {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      @if (session('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Gagal</strong> {{ session('failed') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h4>List Pembelian ~ Semua Pembelian</h4>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <tbody>
                <tr>
                  <th>#</th>
                  <th>Pembeli</th>
                  <th>Status</th>
                  <th>Checkout Pada Tanggal</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($sales as $key => $sale)
                  <tr>
                    <td>{{ $loop->iteration + $sales->firstItem() - 1 }}</td>
                    <td>{{ $sale->address->customer_name }}</td>
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
                    <td>{{ $sale->start_payment_date }}</td>
                    <td>
                      <a href="{{ url('/app-admin/purchases/detail/' . $sale->id ) }}" class="btn btn-sm btn-success"><i class="fas fa-eye mr-2"></i> Detail</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-right mt-n4">
          {{ $sales->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection