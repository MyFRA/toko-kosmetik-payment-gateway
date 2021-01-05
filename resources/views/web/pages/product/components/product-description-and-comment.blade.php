<div class="product-product-description-header">
    <div class="product-desc-wrapper">
        <h3 class="title">DESKRIPSI</h3>
        <div class="desc-product">
            {!! $product->description !!}
        </div>
    </div>
    <div class="product-desc-wrapper">
        <h3 class="title ulasan">ULASAN</h3>
        <h5 class="ulasan-count">
            @if (count($product->comments) > 0)
                Semua komentar {{ count($product->comments) }}
            @else
                Belum ada komentar
            @endif
        </h5>
        <div class="ulasan-wrapper">
        </div>
        <p class="tampilkan-lebih-banyak-komentar">Tampilkan lebih banyak komentar</p>
    </div>
</div>