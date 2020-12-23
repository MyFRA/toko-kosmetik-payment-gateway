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
          <h4>List Promo Produk</h4>
        </div>

        <div class="card-body">
          <a href="{{ url('/app-admin/promo/create') }}" class="btn btn-primary mb-4">Tambah Promo Produk</a>

          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <tbody>
                <tr>
                  <th>#</th>
                  <th>Gambar</th>
                  <th>Nama Produk</th>
                  <th>Selamanya</th>
                  <th>Tanggal Berakhir</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($arr_promo as $key => $promo)
                  <tr>
                    <td>{{ $loop->iteration + $arr_promo->firstItem() - 1 }}</td>
                    <td><img class="rounded" src="{{ asset('/storage/images/products/' . json_decode($promo->product->product_images)[0]->name) }}" alt="product-category-image" width="80px" height="80px" style="object-fit: cover; object-position: center"></td>
                    <td>{{ $promo->product->product_name }}</td>
                    <td>
                      <i class="fas fa-{{ $promo->forever == 1 ? 'check' : 'times' }} text-{{ $promo->forever == 1 ? 'success' : 'danger' }}" style="font-size: 23px"></i>
                    </td>
                    <td>
                      @if ($promo->forever == 1)
                        Selamanya
                      @else
                        {{ $promo->end_date }}
                      @endif
                    </td>
                    <td>
                      <a href="{{ url('/app-admin/promo/' . $promo->id . '/edit') }}" class="btn btn-sm btn-primary"><i class="fas fa-edit mr-2"></i> Edit</a>
                      <a href="" class="btn btn-sm btn-danger" onclick="deleteRow('{{ url('/app-admin/promo/' . $promo->id) }}', 'Promo Produk {{ $promo->product->product_name }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-right mt-n4">
          {{ $arr_promo->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
