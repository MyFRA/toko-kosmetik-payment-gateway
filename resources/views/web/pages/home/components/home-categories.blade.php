<div class="home-categories">
    <div class="title-home-categories">
        <h2>Kategori</h2>
        <a href="{{ url('/product') }}">Lihat Semua</a>
    </div>
    <div class="categories">
        @foreach ($categories as $category)
            <div class="category">
                <a href="{{ url('/product?category=' . $category->slug) }}" class="category-image" style="background-image: url('{{asset('/storage/images/product-categories/' . $category->image_category)}}')"></a>
                <a href="{{ url('/product?category=' . $category->slug) }}" class="category-name">{{ $category->category_name }}</a>
            </div>
        @endforeach
    </div>
    <hr>
</div>