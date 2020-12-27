<div class="home-categories categories-categories">
    <h2>Kategori</h2>
    <div class="categories">
        @foreach ($categories as $category)
        <div class="category">
            <a href="{{ url('/product?category=' . $category->slug) }}" class="category-image" style="background-image: url('{{ asset('/storage/images/product-categories/' . $category->image_category) }}')"></a>
            <a href="{{ url('/product?category=' . $category->slug) }}" class="category-name">{{ $category->category_name }}</a>
        </div>
        @endforeach
    </div>
    <div class="load-more-recommendation">
        <button>Muat Lebih Banyak</button>
    </div>
</div>