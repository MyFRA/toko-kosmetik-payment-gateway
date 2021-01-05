<div class="breadcrumb">
    <ul>
        <li>
            <a href="{{ url('/') }}">Home</a>
            <i class="zmdi zmdi-caret-right"></i>
        </li>
        <li>
            <a href="{{ url('/product?category=' . $product->category->slug) }}">{{ $product->category->category_name }}</a>
            <i class="zmdi zmdi-caret-right"></i>
        </li>
        <li>
            <span>{{ $product->product_name }}</span>
        </li>
    </ul>
</div>