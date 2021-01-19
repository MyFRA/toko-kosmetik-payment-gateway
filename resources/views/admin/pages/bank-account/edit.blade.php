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
              <form method="POST" action="{{ url('/app-admin/bank-account/' . $bank_account->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-header">
                  <h4>Edit Rekening Bank</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="bank_name">Nama Bank<span class="text-danger">*</span></label>
                    <input type="text" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name') ? old('bank_name') : $bank_account->bank_name }}" required="" placeholder="Nama Bank" autocomplete="off">

                    @error('bank_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="bank_logo">Logo Bank <span class="text-danger">*</span></label>
                    <input type="file" class="form-control mb-3" name="bank_logo" id="bank_logo" onchange="showPreviewImage(this)">

                    @error('bank_logo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="bank_account_name">Nama Pemilik (Atas Nama)<span class="text-danger">*</span></label>
                    <input type="text" name="bank_account_name" class="form-control @error('bank_account_name') is-invalid @enderror" value="{{ old('bank_account_name') ? old('bank_account_name') : $bank_account->bank_account_name }}" required="" placeholder="Nama Pemilik (Atas Nama)" autocomplete="off">

                    @error('bank_account_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="bank_account_number">Nomor Rekening<span class="text-danger">*</span></label>
                    <input type="text" name="bank_account_number" class="form-control @error('bank_account_number') is-invalid @enderror" value="{{ old('bank_account_number') ? old('bank_account_number') : $bank_account->bank_account_number }}" required="" placeholder="Nomor Rekening" autocomplete="off">

                    @error('bank_account_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                </div>
                <div class="card-footer mt-n4">
                  <button type="submit" class="btn btn-primary">Update Rekening Bank</button>
                  <button type="reset" class="btn btn-secondary ml-3">Reset</button>
                  <a href="{{ url('/app-admin/bank-account') }}" class="btn btn-dark float-right">Kembali</a>
                </div>
              </form>
            </div>
        </div>
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header">
              <h4>Logo Rekening Bank</h4>
            </div>
            <div class="card-body d-flex flex-column align-items-center">
              <img src="{{ asset('/storage/images/bank-accounts/' . $bank_account->bank_logo) }}" alt="image-preview" class="rounded-lg" id="product_image_preview" style="width: 100%;">
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
    </script>
@endsection