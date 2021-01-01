<nav class="navbar">
    <div class="logo">
        <img src="{{ asset('/images/icons/logo-no-text.png') }}" alt="logo">
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
            <div id="select-product-category-wrap">
            </div>
            <input type="text" placeholder="Cari Produk" id="input-search-product" autocomplete="off">
            <button type="submit" id="button-search-product"><i class="zmdi zmdi-search"></i></button>
        </div>
        <div class="action">
            <a href="{{ url('/wishlist') }}" class="icon {{ $nav == 'wishlist' ? 'active' : '' }}"><i class="zmdi zmdi-favorite"> <span id="customer-wishlist-amount" class="{{ Auth::guard('customer')->check() ? 'bg-pink' : '' }}">{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->wishlist->count() : '' }}</span></i>
            <a href="{{ url('/cart') }}" class="icon {{ $nav == 'wishlist' ? 'cart' : '' }}"><i class="zmdi zmdi-shopping-cart"></i> <span id="customer-cart-amount" class="{{ Auth::guard('customer')->check() ? 'bg-pink' : '' }}">{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->carts->count() : '' }}</span></a>
            @if (Auth::guard('customer')->check())
                <a href="{{ url('/account') }}" class="account" ><i class="zmdi zmdi-account zmdi-hc-lg" style="margin-right: 13px"></i> {{ Auth::guard('customer')->user()->fullname }}</a>
            @else
                <a href="{{ url('/login') }}" class="auth login">Masuk</a>
                <a href="{{ url('/register') }}" class="auth register">Daftar</a>
            @endif
        </div>
    </div>
</nav>