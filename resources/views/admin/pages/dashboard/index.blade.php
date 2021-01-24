@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-shopping-bag"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Produk</h4>
          </div>
          <div class="card-body">
            {{ $jml_produk }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Pelangan</h4>
          </div>
          <div class="card-body">
            {{ $jml_customer }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-file"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Penjualan</h4>
          </div>
          <div class="card-body">
            {{ $jml_penjualan }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-money-bill"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Pendapatan</h4>
          </div>
          <div class="card-body">
            Rp {{ $jml_pendapatan ? number_format($jml_pendapatan, 0, '.', '.') : 0 }}
          </div>
        </div>
      </div>
    </div>                  
  </div>
  <div class="row">
      <div class="col">
        <div class="card p-4">
          <h3 class="text-center">Selamat Datang {{ Auth::guard('admin')->user()->name }}</h3>
          <p class="mt-3" style="text-indent: 20px">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus possimus fugit animi inventore aperiam. Laboriosam iure quo dolores odit dolorum?</p>
        </div>
      </div>
  </div>
@endsection