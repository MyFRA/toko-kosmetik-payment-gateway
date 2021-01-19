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
          <h4>List Rekening Bank</h4>
        </div>

        <div class="card-body">
          <a href="{{ url('/app-admin/bank-account/create') }}" class="btn btn-primary mb-4">Tambah Rekening Bank</a>

          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <tbody>
                <tr>
                  <th>#</th>
                  <th>Logo</th>
                  <th>Nama Bank</th>
                  <th>Pemilik Rekening (Atas Nama)</th>
                  <th>Nomor Rekeing</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($bank_accounts as $key => $bank_account)
                  <tr>
                    <td>{{ $loop->iteration + $bank_accounts->firstItem() - 1 }}</td>
                    <td><img src="{{ asset('/storage/images/bank-accounts/' . $bank_account->bank_logo) }}" alt="bank-logo" class="rounded-sm" width="90px"></td>
                    <td>{{ $bank_account->bank_name }}</td>
                    <td>{{ $bank_account->bank_account_name }}</td>
                    <td>{{ $bank_account->bank_account_number }}</td>
                    <td>
                      <a href="{{ url('/app-admin/bank-account/' . $bank_account->id . '/edit') }}" class="btn btn-sm btn-primary"><i class="fas fa-edit mr-2"></i> Edit</a>
                      <a href="" class="btn btn-sm btn-danger" onclick="deleteRow('{{ url('/app-admin/bank-account/' . $bank_account->id) }}', 'Rekening Bank Atas Nama {{ $bank_account->bank_account_name }}')"><i class="fas fa-trash mr-2"></i> Hapus</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-right mt-n4">
          {{ $bank_accounts->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection