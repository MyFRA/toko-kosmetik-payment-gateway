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
          <h4>List Kategori Produk</h4>
        </div>

        <div class="card-body">
          <a href="{{ url('/app-admin/product-category/create') }}" class="btn btn-primary mb-4">Tambah Kategori Produk</a>

          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <tbody>
                <tr>
                  <th>#</th>
                  <th>Gambar</th>
                  <th>Nama Kategori</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($product_categories as $key => $product_category)
                  <tr>
                    <td>{{ $loop->iteration + $product_categories->firstItem() - 1 }}</td>
                    <td><img class="rounded" src="{{ asset('/storage/images/product-categories/' . $product_category->image_category) }}" alt="product-category-image" width="80px" height="80px" style="object-fit: cover; object-position: center"></td>
                    <td>{{ $product_category->category_name }}</td>
                    <td>
                      <a href="{{ url('/app-admin/product-category/' . $product_category->id) }}" class="btn btn-sm btn-success"><i class="fas fa-eye mr-2"></i> Lihat</a>
                      <a href="{{ url('/app-admin/product-category/' . $product_category->id . '/edit') }}" class="btn btn-sm btn-primary"><i class="fas fa-edit mr-2"></i> Edit</a>
                      <a href="" class="btn btn-sm btn-danger" onclick="deleteRow('{{ url('/app-admin/product-category/' . $product_category->id) }}', 'Kategori Produk {{ $product_category->category_name }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-right mt-n4">
          {{ $product_categories->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
