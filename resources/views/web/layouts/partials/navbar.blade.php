<nav class="navbar">
    <div class="logo">
        <img src="https://demo.hasthemes.com/corano-preview/corano/assets/img/logo/logo.png" alt="logo">
    </div>
    <ul class="nav-links">
        <li class="nav-link {{ $nav == 'home' ? 'active' : ''}}">
            <a href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-link {{ $nav == 'promo' ? 'active' : ''}}">
            <a href="{{ url('/promo') }}">Promo</a>
        </li>
        <li class="nav-link {{ $nav == 'product' ? 'active' : ''}}">
            <a href="{{ url('/product') }}">Produk</a>
        </li>
        <li class="nav-link {{ $nav == 'categories' ? 'active' : ''}}">
            <a href="{{ url('/categories') }}">Kategori</a>
        </li>
        <li class="nav-link {{ $nav == 'faq' ? 'active' : ''}}">
            <a href="{{ url('/faq') }}">FAQ</a>
        </li>
    </ul>
    <div class="action-wrapper">
        <div class="search">
            <input type="text" placeholder="cari produk">
            <button type="submit"><i class="zmdi zmdi-search"></i></button>
        </div>
        <div class="action">
            <a href="{{ url('/wishlist') }}" class="icon {{ $nav == 'wishlist' ? 'active' : '' }}"><i class="zmdi zmdi-favorite zmdi-hc-lg"></i>
            <a href="{{ url('/cart') }}" class="icon {{ $nav == 'wishlist' ? 'cart' : '' }}"><i class="zmdi zmdi-shopping-cart zmdi-hc-lg"></i></a>
            @if (Auth::guard('customer')->check())
                <a href=""><i class="zmdi zmdi-account zmdi-hc-lg" style="margin-right: 13px"></i> Tomy Wibowo</a>
            @else
                <a href="{{ url('/login') }}" class="auth login">Masuk</a>
                <a href="{{ url('/register') }}" class="auth register">Daftar</a>
            @endif
        </div>
    </div>
</nav>