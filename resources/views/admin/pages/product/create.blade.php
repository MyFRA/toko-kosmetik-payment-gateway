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
              <form method="POST" action="{{ url('/app-admin/product') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-header">
                  <h4>Tambah Produk</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="product_name">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" required="" placeholder="Nama Produk" autocomplete="off">

                    @error('product_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="product_category_id">Kategori Produk <span class="text-danger">*</span></label>
                    <select name="product_category_id" id="product_category_id" class="form-control">
                        @foreach ($product_categories as $product_category)
                            <option value="{{ $product_category->id }}" {{ old('product_category_id') ==  $product_category->id ? 'selected' : '' }}>{{ $product_category->category_name }}</option>
                        @endforeach
                    </select>

                    @error('product_category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="price">Harga <span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required="" placeholder="Harga" autocomplete="off">

                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="weight">Berat <span class="text-danger">*</span></label>
                    <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}" required="" placeholder="Berat (gram)" autocomplete="off">

                    @error('weight')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="amount">Jumlah <span class="text-danger">*</span></label>
                    <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required="" placeholder="Jumlah" autocomplete="off">

                    @error('amount')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="condition">Kondisi <span class="text-danger">*</span></label>
                    <select name="condition" id="condition" class="form-control">
                        @foreach ($conditions as $condition)
                            <option value="{{ $condition }}"  {{ old('condition') ==  $condition ? 'selected' : '' }}>{{ $condition }}</option>
                        @endforeach
                    </select>

                    @error('condition')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="enable_variants" id="enabled-variants">
                    <label class="text-dark" for="enabled-variants">Buat Varian</label>
                  </div>
                  <div class="form-group mb-4">
                    <select class="form-control" multiple="multiple" name="variants[]" id="variants" disabled>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="product_images">Foto Produk <span class="text-danger">*</span></label>
                    <div class="mb-3">
                      <img src="{{ asset('/images/icons/shopping-bag.png') }}" alt="product-photo" class="product_image_previews mr-2 rounded" width="100px" height="100px" style="object-fit: cover; object-position: center">
                      <img src="{{ asset('/images/icons/shopping-bag.png') }}" alt="product-photo" class="product_image_previews mr-2 rounded" width="100px" height="100px" style="object-fit: cover; object-position: center">
                      <img src="{{ asset('/images/icons/shopping-bag.png') }}" alt="product-photo" class="product_image_previews mr-2 rounded" width="100px" height="100px" style="object-fit: cover; object-position: center">
                      <img src="{{ asset('/images/icons/shopping-bag.png') }}" alt="product-photo" class="product_image_previews mr-2 rounded" width="100px" height="100px" style="object-fit: cover; object-position: center">
                    </div>
                    <input required type="file" class="form-control mb-3" name="product_images[]" multiple id="product_images" onchange="showPreviewImage(0, this)">
                    <input type="file" class="form-control mb-3" name="product_images[]" multiple id="product_images" onchange="showPreviewImage(1, this)">
                    <input type="file" class="form-control mb-3" name="product_images[]" multiple id="product_images" onchange="showPreviewImage(2, this)">
                    <input type="file" class="form-control mb-3" name="product_images[]" multiple id="product_images" onchange="showPreviewImage(3, this)">

                    @error('product_images')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="description">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" required="">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>
                </div>
                <div class="card-footer mt-n4">
                  <button type="submit" class="btn btn-primary">Tambahkan Produk</button>
                  <button type="reset" class="btn btn-secondary ml-3">Reset</button>
                  <a href="{{ url('/app-admin/product') }}" class="btn btn-dark float-right">Kembali</a>
                </div>
              </form>
            </div>
        </div>
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header">
              <h4>Gambar Utama Produk</h4>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <img src="{{ asset('/images/icons/shopping-bag.png') }}" alt="image-preview" class="rounded-lg" id="product_image_preview" style="width: 90%; object-fit: cover; object-position: center">
            </div>
          </div>
        </div>
    </div>
@endsection

@section('stylesheet')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  @endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#description').summernote({
          height: 200,
          placeholder: 'Deskripsi Produk',
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
          ]
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        $("#variants").select2({
          tags: true,
          theme: "classic"
        });
      });
    </script>
    <script>
      const enabled_variants = document.getElementById('enabled-variants');
      const input_variant = document.getElementById('variants');

      enabled_variants.addEventListener('change', () => {
        if( enabled_variants.checked ) {
          if(input_variant.hasAttribute('disabled')) {
            input_variant.removeAttribute('disabled');
          }
        } else {
          if(!input_variant.hasAttribute('disabled')) {
            input_variant.setAttribute('disabled', '');
          }
        }
      });
    </script>
    <script>
      var product_image_previews = document.querySelectorAll('.product_image_previews');
      var product_image_preview  = document.getElementById('product_image_preview');

      function showPreviewImage(index, file) {
        var reader = new FileReader();

        reader.onload = function() {
          product_image_previews[index].setAttribute('src', reader.result);
          if(index == 0) {
            product_image_preview.setAttribute('src', reader.result);
          }
        }
        reader.readAsDataURL(file.files[0]);
      }
      product_image_preview.style.height = product_image_preview.offsetWidth + 'px';
    </script>
@endsection