<div class="product-product-detail">
    <div class="product-image-container">
        <div class="product-image">
            <img src="{{ asset('/storage/images/products/' . $product_images[0]->name) }}" alt="product-image">
        </div>
        <div class="product-thumbs {{ count($product_images) >= 5 ? 'justify-content-space-between' : '' }}">
            @foreach (json_decode($product->product_images) as $key => $product_image)
                <div class="{{ $key == 0 ? 'active' : '' }} {{ count($product_images) >= 5 ? '' : 'mr-lg-15' }}">
                    <img class="product-thumb" src="{{ asset('/storage/images/products/'. $product_image->name) }}" alt="product-thumb">
                </div>
            @endforeach
        </div>
    </div>
    <div class="product-detail-container">
        <h3 class="title-product">{{ $product->product_name }}</h3>
        <div class="terjual-dilihat">
            <span>
                @if ($product->sold > 0)
                    Terjual {{ $product->sold }} Produk,
                @else
                    Belum Terjual,
                @endif
            </span>
            <span>{{ $product->counter }} x Dilihat</span>
        </div>
        <div class="product-order-desc-container">
            <div class="product-order-desc">
                <div class="label">
                    HARGA
                </div>
                <div class="desc harga-desc">
                    @if (!is_null($product->discount))
                        @if ( $product->discount->forever == true )
                            <h5 class="mb-7">
                                <span>{{ $product->discount->discount_percent }}%</span>{{ $product->price }}
                            </h5>
                        @elseif(strtotime($product->discount->end_date) >= strtotime(date('d-m-y')))
                            <h5 class="mb-7">
                                <span>{{ $product->discount->discount_percent }}%</span>{{ $product->price }}
                            </h5>
                        @endif
                    @endif
                    @if (!is_null($product->discount))
                        @if ( $product->discount->forever == true )
                            <h3>Rp. {{ number_format(floor($product->price - ($product->price * $product->discount->discount_percent / 100)),0,',','.') }}</h3>
                        @elseif(strtotime($product->discount->end_date) >= strtotime(date('d-m-y')))
                            <h3>Rp. {{ number_format(floor($product->price - ($product->price * $product->discount->discount_percent / 100)),0,',','.') }}</h3>
                        @else
                            <h3>Rp. {{ number_format($product->price,0,',','.') }}</h3>
                        @endif
                    @else
                        <h3>Rp. {{ number_format($product->price,0,',','.') }}</h3>
                    @endif
                </div>
            </div>
            @if (count($product->product_variants) > 0)
                <div class="product-order-desc">
                    <div class="label">
                        Varian
                    </div>
                    <div class="desc varian-warna-desc" id="varian-wrapper">
                        @foreach ($product->product_variants as $variant)
                            <div class="warna">
                                <div class="text">{{ $variant->variant }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="product-order-desc">
                <div class="label">
                    JUMLAH
                </div>
                <div class="desc jumlah-desc">
                    <button class="min" id="min">-</button>
                    <input type="number" name="amount" value="1" id="amount" readonly>
                    <button class="plus" id="plus">+</button>
                </div>
            </div>
            <div class="product-order-desc">
                <div class="label">
                    INFO PRODUK
                </div>
                <div class="desc info-product-desc">
                    <div class="info-product">
                        <div class="title-info">Berat</div>
                        <div class="desc-info">{{ $product->weight }}gr</div>
                    </div>
                    <div class="info-product">
                        <div class="title-info">Kondisi</div>
                        <div class="desc-info">{{ $product->condition }}</div>
                    </div>
                    <div class="info-product">
                        <div class="title-info">Stok</div>
                        <div class="desc-info">{{ $product->amount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>