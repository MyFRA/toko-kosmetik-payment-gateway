<div class="product-product-detail">
    <div class="product-image-container">
        <div class="product-image">
            <img src="https://assets.pikiran-rakyat.com/crop/204x7:1986x1325/x/photo/2020/08/16/2708438435.jpg" alt="product-image">
        </div>
        <div class="product-thumbs">
            <div class="active">
                <img class="product-thumb" src="https://assets.pikiran-rakyat.com/crop/204x7:1986x1325/x/photo/2020/08/16/2708438435.jpg" alt="product-thumb">
            </div>
            <div>
                <img class="product-thumb" src="https://ecs7.tokopedia.net/img/cache/700/product-1/2020/3/23/32384324/32384324_cb38cac5-5003-464c-b923-6016f5f58181_1081_1081.webp" alt="product-thumb">
            </div>
            <div>
                <img class="product-thumb" src="https://assets.pikiran-rakyat.com/crop/204x7:1986x1325/x/photo/2020/08/16/2708438435.jpg" alt="product-thumb">
            </div>
            <div>
                <img class="product-thumb" src="https://assets.pikiran-rakyat.com/crop/204x7:1986x1325/x/photo/2020/08/16/2708438435.jpg" alt="product-thumb">
            </div>
            <div>
                <img class="product-thumb" src="https://assets.pikiran-rakyat.com/crop/204x7:1986x1325/x/photo/2020/08/16/2708438435.jpg" alt="product-thumb">
            </div>
        </div>
    </div>
    <div class="product-detail-container">
        <h3 class="title-product">Wardah Everyday BB Cream Natural 30 ml</h3>
        <div class="terjual-dilihat">
            <span>Terjual 744 Produk</span>
            <span>18,7rb x Dilihat</span>
        </div>
        <div class="product-order-desc-container">
            <div class="product-order-desc">
                <div class="label">
                    HARGA
                </div>
                <div class="desc harga-desc">
                    <h5><span>20%</span>Rp49.500</h5>
                    <h3>Rp39.600</h3>
                </div>
            </div>
            <div class="product-order-desc">
                <div class="label">
                    WARNA
                </div>
                <div class="desc varian-warna-desc">
                    <div class="warna">
                        <div class="color" style="background-color: #000"></div>
                        <div class="text">Hitam</div>
                    </div>
                    <div class="warna">
                        <div class="color" style="background-color: #000"></div>
                        <div class="text">Hitam</div>
                    </div>
                    <div class="warna">
                        <div class="color" style="background-color: #000"></div>
                        <div class="text">Hitam</div>
                    </div>
                    <div class="warna">
                        <div class="color" style="background-color: #000"></div>
                        <div class="text">Hitam</div>
                    </div>
                    
                </div>
            </div>
            <div class="product-order-desc">
                <div class="label">
                    JUMLAH
                </div>
                <div class="desc jumlah-desc">
                    <button class="min">-</button>
                    <input type="number" value="1" readonly>
                    <button class="plus">+</button>
                </div>
            </div>
            <div class="product-order-desc">
                <div class="label">
                    INFO PRODUK
                </div>
                <div class="desc info-product-desc">
                    <div class="info-product">
                        <div class="title-info">Berat</div>
                        <div class="desc-info">100gr</div>
                    </div>
                    <div class="info-product">
                        <div class="title-info">Kondisi</div>
                        <div class="desc-info">Baru</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        const product_image = document.querySelector('.product-image img');
        product_image.style.height = product_image.offsetWidth + 'px';

        const product_thumbs_wrapper = document.querySelector('.product-thumbs');
        const product_thumb_width = document.querySelector('.product-thumbs div img').offsetWidth + 'px';
    
        product_thumbs_wrapper.querySelectorAll('div').forEach((e) => {
            e.style.height = product_thumb_width;
        });

        product_thumbs_wrapper.addEventListener('click', (e) => {
            if(e.target.className == 'product-thumb') {
                product_image.setAttribute('src', e.target.getAttribute('src'));
            }
        });

    </script>    
@endsection