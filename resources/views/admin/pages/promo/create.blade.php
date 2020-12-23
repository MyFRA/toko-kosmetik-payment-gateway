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
              <form method="POST" action="{{ url('/app-admin/promo') }}">
                @csrf
                @method('POST')
                <div class="card-header">
                  <h4>Tambah Promo Produk</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="product_id">Pilih Produk<span class="text-danger">*</span></label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : ''}}>{{ $product->product_name }}</option>
                        @endforeach
                    </select>

                    @error('product_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="forever">Selamanya<span class="text-danger">*</span></label>
                    <select name="forever" id="forever" required class="form-control">
                        @foreach ($forevers as $forever)
                            <option value="{{ $forever['status'] }}" {{ old('forever') == $forever['status'] ? 'selected' : ''}}>{{ $forever['text'] }}</option>
                        @endforeach
                    </select>

                    @error('forever')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                    <div class="form-group">
                        <label for="end_date">Tanggal Berakhir</label>
                        <input type="text" class="form-control datepicker @error('end_date') is-invalid  @enderror" id="end_date" name="end_date" placeholder="Tanggal Berakhir">
                    
                        @error('end_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>   
                        @enderror
                    </div>

                </div>
                <div class="card-footer mt-n4">
                  <button type="submit" class="btn btn-primary">Tambahkan Promo</button>
                  <button type="reset" class="btn btn-secondary ml-3">Reset</button>
                  <a href="{{ url('/app-admin/promo') }}" class="btn btn-dark float-right">Kembali</a>
                </div>
              </form>
            </div>
        </div>
    </div>
@endsection

@section('stylesheet')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A==" crossorigin="anonymous" />
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
    <script>
        $('.datepicker').datepicker();
    </script>
    <script>
        const forever_input = document.getElementById('forever');
    </script>
@endsection