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
              <form method="POST" action="{{ url('/app-admin/faq') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-header">
                  <h4>Tambah FAQ</h4>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="question">Pertanyaan<span class="text-danger">*</span></label>
                    <textarea name="question" id="question" style="height: 100px" class="form-control @error('question') is-invalid @enderror">{{old('question')}}</textarea>

                    @error('question')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="answer">Jawaban<span class="text-danger">*</span></label>
                    <textarea name="answer" id="answer" style="height: 100px" class="form-control @error('answer') is-invalid @enderror">{{old('answer')}}</textarea>

                    @error('answer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>   
                    @enderror
                  </div>

                </div>
                <div class="card-footer mt-n4">
                  <button type="submit" class="btn btn-primary">Tambahkan FAQ</button>
                  <button type="reset" class="btn btn-secondary ml-3">Reset</button>
                  <a href="{{ url('/app-admin/faq') }}" class="btn btn-dark float-right">Kembali</a>
                </div>
              </form>
            </div>
        </div>
    </div>
@endsection