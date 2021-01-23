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
          <h4>List Faq</h4>
        </div>

        <div class="card-body">
          <a href="{{ url('/app-admin/faq/create') }}" class="btn btn-primary mb-4">Tambah Faq</a>

          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <tbody>
                <tr>
                  <th>#</th>
                  <th>Pertanyaan</th>
                  <th>Jawaban</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($faqs as $key => $faq)
                  <tr>
                    <td>{{ $loop->iteration + $faqs->firstItem() - 1 }}</td>
                    <td>{{ substr($faq->question, 0, 50) }}</td>
                    <td>{{ substr($faq->answer, 0, 100) }}</td>
                    <td>
                      <a href="{{ url('/app-admin/faq/' . $faq->id . '/edit') }}" class="btn btn-sm btn-primary"><i class="fas fa-edit mr-2"></i> Edit</a>
                      <a href="" class="btn btn-sm btn-danger" onclick="deleteRow('{{ url('/app-admin/faq/' . $faq->id) }}', 'Faq dengan pertanyaan {{ $faq->question }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-right mt-n4">
          {{ $faqs->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection