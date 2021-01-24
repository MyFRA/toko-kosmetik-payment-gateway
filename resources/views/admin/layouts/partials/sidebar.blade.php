<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ url('/app-admin') }}">Indah Jaya</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/app-admin') }}">St</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="{{ $sidebar == 'dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
          <li class="menu-header">Produk</li>
          <li class="{{ $sidebar == 'product' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/product') }}"><i class="fas fa-shopping-bag"></i> <span>Produk</span></a></li>
          <li class="{{ $sidebar == 'product-category' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/product-category') }}"><i class="fas fa-list-alt"></i> <span>Kategori Produk</span></a></li>
          <li class="{{ $sidebar == 'promo' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/promo') }}"><i class="fas fa-tags"></i> <span>Promo</span></a></li>
          <li class="{{ $sidebar == 'discount' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/discount') }}"><i class="fas fa-percent"></i> <span>Diskon</span></a></li>
          <li class="menu-header">Akun</li>
          {{-- <li class="{{ $sidebar == 'profile' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/profile') }}"><i class="far fa-user"></i> <span>Profil</span></a>
          </li> --}}
          <li class="{{ $sidebar == 'bank-account' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/bank-account') }}"><i class="far fa-credit-card"></i> <span>Rekening Bank</span></a>
          </li>
          <li class="menu-header">Penjualan</li>
          <li class="{{ $sidebar == 'all-purchases' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/purchases') }}"><i class="fas fa-list"></i> <span>Semua Penjualan</span></a>
          </li>
          <li class="{{ $sidebar == 'belum-bayar' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/purchases/belum-bayar') }}"><i class="fas fa-dollar-sign"></i> <span>Belum Bayar</span></a>
          </li>
          <li class="{{ $sidebar == 'menunggu-konfirmasi-bukti-pembayaran' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/purchases/menunggu-konfirmasi-pembayaran') }}"><i class="fas fa-tasks"></i> <span>Menunggu Konfirmasi Bukti Pembayaran</span></a>
          </li>
          <li class="{{ $sidebar == 'dikirim' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/purchases/dikirim') }}"><i class="fas fa-truck"></i> <span>Dikirim</span></a>
          </li>
          <li class="{{ $sidebar == 'diterima' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/purchases/diterima') }}"><i class="fas fa-check"></i> <span>Diterima</span></a>
          </li>
          <li class="{{ $sidebar == 'expired' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/purchases/expired') }}"><i class="fas fa-trash"></i> <span>Expired</span></a>
          </li>
          <li class="menu-header">Lainya</li>
          <li class="{{ $sidebar == 'faq' ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/app-admin/faq') }}"><i class="far fa-comments"></i> <span>FAQ</span></a>
          </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="" class="btn btn-danger btn-lg btn-block btn-icon-split" onclick="adminLogout()">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>
    </aside>
  </div>