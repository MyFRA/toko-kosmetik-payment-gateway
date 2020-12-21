@extends('admin.layouts.app')

@section('content')
    @if (session('failed'))
      <div class="row">
        <div class="col">
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal</strong> {{ session('failed') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    @endif
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                  <h4>Detail Kategori Produk</h4>
                </div>
                <div class="card-body pb-5">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('/storage/images/product-categories/' . $product_category->image_category) }}" alt="image-preview" class="rounded-lg" id="product_image_preview" style="width: 90%; object-fit: cover; object-position: center">
                    </div>
                    <hr>
                    <table class="mt-4">
                        <tr>
                            <th>Nama Kategori</th>
                            <td class="px-3">:</td>
                            <td>{{ $product_category->category_name }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer mt-n4">
                    <a href="{{ url('/app-admin/product-category') }}" class="btn btn-dark float-right">Kembali</a>
                  </div>
            </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
                <h4>List Produk Dengan Kategori {{ $product_category->category_name }}</h4>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($product_category->product as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>Parfum edit</td>
                                    <td>
                                        <a href="{{ url('/product/' . $product->product_slug) }}" class="btn btn-sm btn-success"><i class="fas fa-eye mr-2"></i> Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
      var product_image_preview = document.getElementById('product_image_preview');

      function showPreviewImage(file) {
        var reader = new FileReader();

        reader.onload = function() {
          product_image_preview.setAttribute('src', reader.result);
        }
        reader.readAsDataURL(file.files[0]);
      }

      product_image_preview.style.height = product_image_preview.offsetWidth + 'px';
    </script>
@endsection