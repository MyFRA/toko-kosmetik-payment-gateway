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
        <div class="col-lg-7">
            <div class="card">
              <form method="POST" action="{{ url('/app-admin/product-category/' . $product_category->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-header">
                  <h4>Edit Kategori Produk</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="category_name">Nama Kategori<span class="text-danger">*</span></label>
                    <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name') ? old('category_name') : $product_category->category_name }}" required="" placeholder="Nama Kategori" autocomplete="off">

                    @error('category_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="image_category">Gambar Kategori</label>
                    <input type="file" class="form-control mb-3" name="image_category" id="image_category" onchange="showPreviewImage(this)">

                    @error('image_category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                </div>
                <div class="card-footer mt-n4">
                  <button type="submit" class="btn btn-primary">Update Kategori Produk</button>
                  <button type="reset" class="btn btn-secondary ml-3">Reset</button>
                  <a href="{{ url('/app-admin/product-category') }}" class="btn btn-dark float-right">Kembali</a>
                </div>
              </form>
            </div>
        </div>
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header">
              <h4>Gambar Kategori Produk</h4>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <img src="{{ asset('/storage/images/product-categories/' . $product_category->image_category) }}" alt="image-preview" class="rounded-lg" id="product_image_preview" style="width: 90%; object-fit: cover; object-position: center">
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