<div class="product-product-description-header">
    <div class="product-desc-wrapper">
        <h3 class="title">DESKRIPSI</h3>
        <div class="desc-product">
            {!! $product->description !!}
        </div>
    </div>
    <div class="product-desc-wrapper">
        <h3 class="title">ULASAN</h3>
        <h5 class="ulasan-count">
            @if (count($product->comments) > 0)
                Semua komentar {{ count($product->comments) }}
            @else
                Belum ada komentar
            @endif
        </h5>
        <div class="ulasan-wrapper">
            @foreach ($comments as $comment)
                <div class="ulasan">
                    <div class="account">
                        <div class="photo">
                            <img src="{{ $comment->customer->photo ? asset('/storage/images/customer-profiles/' . $comment->customer->photo) : 'https://i.pinimg.com/736x/4d/b8/3d/4db83d1b757657acf5edc8bd66e50abf.jpg' }}" alt="photo-profile">
                        </div>
                        <div class="info">
                            <a href="" class="name">{{ $comment->customer->fullname }}</a>
                            <span class="date">{{ $comment->getCreatedAtAttributes($comment->created_at, 'diffForHumans') }}</span>
                        </div>
                    </div>
                    <div class="comment">
                        <p class="comment-user">{{ $comment->comment }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>