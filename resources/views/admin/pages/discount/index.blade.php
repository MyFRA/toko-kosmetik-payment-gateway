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
          <h4>List Diskon Produk</h4>
        </div>

        <div class="card-body">
          <a href="{{ url('/app-admin/discount/create') }}" class="btn btn-primary mb-4">Tambah Diskon Produk</a>

          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <tbody>
                <tr>
                  <th>#</th>
                  <th>Gambar</th>
                  <th>Nama Produk</th>
                  <th>Selamanya</th>
                  <th>Tanggal Berakhir</th>
                  <th>Harga Asli</th>
                  <th>Harga Setelah Diskon</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($discounts as $key => $discount)
                  <tr>
                    <td>{{ $loop->iteration + $discounts->firstItem() - 1 }}</td>
                    <td><img class="rounded" src="{{ asset('/storage/images/products/' . json_decode($discount->product->product_images)[0]->name) }}" alt="product-category-image" width="80px" height="80px" style="object-fit: cover; object-position: center"></td>
                    <td>{{ $discount->product->product_name }}</td>
                    <td>
                      <i class="fas fa-{{ $discount->forever == 1 ? 'check' : 'times' }} text-{{ $discount->forever == 1 ? 'success' : 'danger' }}" style="font-size: 23px"></i>
                    </td>
                    <td>
                      @if ($discount->forever == 1)
                        Selamanya
                      @else
                        {{ $discount->end_date }}
                      @endif
                    </td>
                    <td>{{ $discount->product->price }}</td>
                    <td>{{ floor($discount->product->price - ($discount->product->price * $discount->discount_percent / 100)) }}</td>
                    <td>
                      <a href="{{ url('/app-admin/discount/' . $discount->id . '/edit') }}" class="btn btn-sm btn btn-primary"><i class="fas fa-edit mr-2"></i> Edit</a>
                      <a href="" class="btn btn-sm btn-danger" onclick="deleteRow('{{ url('/app-admin/discount/' . $discount->id) }}', 'Diskon Produk {{ $discount->product->product_name }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-right mt-n4">
          {{ $discounts->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
