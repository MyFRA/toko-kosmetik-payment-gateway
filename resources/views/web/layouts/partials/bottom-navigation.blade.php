<div class="bottom-navigation">
    <a href="{{ url('/') }}" class="{{ $nav == 'home' ? 'active' : '' }}">
        <span class="icon"><i class="zmdi zmdi-home"></i></span>
        <span class="text">Home</span>
    </a>
    <a href="{{ url('/wishlist') }}" class="{{ $nav == 'wishlist' ? 'active' : '' }}">
        <span class="icon"><i class="zmdi zmdi-favorite"></i></span>
        <span class="text">Wishlist</span>
    </a>
    <a href="{{ url('/categories') }}" class="{{ $nav == 'categories' ? 'active' : '' }}">
        <span class="icon"><i class="zmdi zmdi-mall"></i></span>
        <span class="text">Kategori</span>
    </a>
    <a href="{{ url('/cart') }}" class="{{ $nav == 'cart' ? 'active' : '' }}">
        <span class="icon"><i class="zmdi zmdi-shopping-cart"></i></span>
        <span class="text">Keranjang</span>
    </a>
    <a href="{{ url('/account') }}" class="{{ $nav == 'account' ? 'active' : '' }}">
        <span class="icon"><i class="zmdi zmdi-account"></i></span>
        <span class="text">Akun</span>
    </a>
</div>