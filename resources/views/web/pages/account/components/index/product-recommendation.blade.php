<div class="products-container">
    <div class="products-text-wrapper">
        <h1 class="related-product-title real">Produk Lainya</h1>
    </div>
    <div class="products-wrapper home-recommendation-products-wrapper not-using-slick {{ count($related_products) >= 5 ? 'justify-content-space-between' : '' }}">
        @foreach ($related_products as $product)
            <a href="{{ url('/product/' . $product->product_slug) }}" class="product {{ count($related_products) < 5 ? 'mr-lg-18' : '' }}">
                <div class="thumb-product">
                    <img class="product-image" src="{{ asset('/storage/images/products/' . json_decode($product->product_images)[0]->name) }}" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ strlen($product->product_name) >= 23 ? substr($product->product_name, 0, 23) . '...' : $product->product_name }}</h5>
                    <div class="price-wrapper">
                        @if (!is_null($product->discount))
                            @if ( $product->discount->forever == true )
                                <h4>Rp. {{ number_format(floor($product->price - ($product->price * $product->discount->discount_percent / 100)), 0, '.', '.') }}</h4>
                            @elseif(strtotime($product->discount->end_date) >= strtotime(date('d-m-y')))
                                <h4>Rp. {{ number_format(floor($product->price - ($product->price * $product->discount->discount_percent / 100)), 0, '.', '.') }}</h4>
                            @else
                                <h4>Rp. {{ number_format($product->price, 0, '.', '.') }}</h4>
                            @endif
                        @else
                            <h4>Rp. {{ number_format($product->price, 0, '.', '.') }}</h4>
                        @endif
                        @if (!is_null($product->discount))
                            @if ( $product->discount->forever == true )
                                <div class="discount">
                                    <h5 class="text-555"><strike>Rp. {{ number_format($product->price, 0, '.', '.') }}</strike></h5>
                                    <span>{{ $product->discount->discount_percent }}% OFF</span>
                                </div>  
                            @elseif(strtotime($product->discount->end_date) >= strtotime(date('d-m-y')))
                                <div class="discount">
                                    <h5 class="text-555"><strike>Rp. {{ number_format($product->price, 0, '.', '.') }}</strike></h5>
                                    <span>{{ $product->discount->discount_percent }}% OFF</span>
                                </div>  
                            @endif
                        @endif
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok {{ number_format($product->amount, 0, '.', '.') }}</span>
                        @if ($product->sold > 0)
                            <span class="sold">{{ number_format($product->sold, 0, '.', '.') }} Terjual</span>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>