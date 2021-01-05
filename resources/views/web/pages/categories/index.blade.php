@extends('web.layouts.app')

@section('content')
    <div class="home-categories categories-categories">
        <h1 class="related-product-title text-555 mt-13 mb-5"><i class="zmdi zmdi-shopping-cart mr-4"></i> Kategori </h1>
        <div class="categories">
            @foreach ($categories as $category)
            <div class="category">
                <a href="{{ url('/product?category=' . $category->slug) }}" class="category-image" style="background-image: url('{{ asset('/storage/images/product-categories/' . $category->image_category) }}')"></a>
                <a href="{{ url('/product?category=' . $category->slug) }}" class="category-name">{{ $category->category_name }}</a>
            </div>
            @endforeach
        </div>
        <div class="not-promo">
            {{ $categories->links() }}
        </div>
    </div>
@endsection