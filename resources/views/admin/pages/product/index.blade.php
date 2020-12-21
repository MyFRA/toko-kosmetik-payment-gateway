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
      <div class="card">
        <div class="card-header">
          <h4>List Produk</h4>
        </div>

        <div class="card-body">
          <a href="{{ url('/app-admin/product/create') }}" class="btn btn-primary mb-4">Tambah Produk</a>

          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <tbody>
                <tr>
                  <th>#</th>
                  <th>Gambar</th>
                  <th>Nama Produk</th>
                  <th>Kategori</th>
                  <th>Harga</th>
                  <th>Berat</th>
                  <th>Jumlah</th>
                  <th>Kondisi</th>
                  <th>Terjual</th>
                  <th>Dilihat</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($products as $key => $product)
                  <tr>
                    <td>{{ $loop->iteration + $products->firstItem() - 1 }}</td>
                    <td>
                      @foreach (json_decode($product->product_images) as $image)
                          @if ($image->index == 0)
                            <img class="rounded" src="{{ asset('/storage/images/products/' . $image->name) }}" alt="product-category-image" width="80px" height="80px" style="object-fit: cover; object-position: center">
                          @endif
                      @endforeach
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->category->category_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->weight }}</td>
                    <td>{{ $product->amount }}</td>
                    <td>{{ $product->condition }}</td>
                    <td>{{ $product->sold }}</td>
                    <td>{{ $product->counter }}</td>
                    <td>
                      <a href="{{ url('/product/' . $product->product_slug) }}" class="btn btn-sm btn-success"><i class="fas fa-eye mr-2"></i> Lihat</a>
                      <a href="{{ url('/app-admin/product/' . $product->id . '/edit') }}" class="btn btn-sm btn-primary"><i class="fas fa-edit mr-2"></i> Edit</a>
                      <a href="" class="btn btn-sm btn-danger" onclick="deleteRow('{{ url('/app-admin/product/' . $product->id) }}', 'Produk {{ $product->product_name }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-right mt-n4">
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
