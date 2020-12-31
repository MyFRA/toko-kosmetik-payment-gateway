<div class="products-container">
    <div class="products-text-wrapper">
        <h2>Produk Terlaris</h2>
    </div>
    <div class="products-wrapper home-best-seller pink-toggle {{ count($best_seller_products) >= 5 ? 'justify-content-space-between' : '' }}">
        @foreach ($best_seller_products as $product)
            <a href="{{ url('/product/' . $product->product_slug) }}" class="product {{ count($best_seller_products) < 5 ? 'mr-lg-18' : '' }}">
                <div class="thumb-product">
                    <img class="product-image" src="{{ asset('/storage/images/products/' . json_decode($product->product_images)[0]->name) }}" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr($product->product_name, 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        @if (!is_null($product->discount))
                            @if ( $product->discount->forever == true )
                                <h4>Rp. {{ floor($product->price - ($product->price * $product->discount->discount_percent / 100)) }}</h4>
                            @elseif(strtotime($product->discount->end_date) >= strtotime(date('d-m-y')))
                                <h4>Rp. {{ floor($product->price - ($product->price * $product->discount->discount_percent / 100)) }}</h4>
                            @else
                                <h4>Rp. {{ $product->price }}</h4>
                            @endif
                        @else
                            <h4>Rp. {{ $product->price }}</h4>
                        @endif
                        @if (!is_null($product->discount))
                            @if ( $product->discount->forever == true )
                                <div class="discount">
                                    <h5><strike>Rp. {{ $product->price }}</strike></h5>
                                    <span>{{ $product->discount->discount_percent }}% OFF</span>
                                </div>  
                            @elseif(strtotime($product->discount->end_date) >= strtotime(date('d-m-y')))
                                <div class="discount">
                                    <h5><strike>Rp. {{ $product->price }}</strike></h5>
                                    <span>{{ $product->discount->discount_percent }}% OFF</span>
                                </div>  
                            @endif
                        @endif
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok {{ $product->amount }}</span>
                        @if ($product->sold > 0)
                            <span class="sold">{{ $product->sold }} Terjual</span>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <hr>
</div>