@extends('web.layouts.app')

@section('content')
    <div class="cart-wrapper">
        <div class="cart-product">
            <div class="choose-all">
                <div class="check">
                    <input type="checkbox" name="check_all" id="check_all">
                    <label for="check_all">Pilih Semua Barang</label>
                </div>
                <div class="remove">
                    <a href="">Hapus</a>
                </div>
            </div>
            <div class="products-cart">
                <div class="product-cart">
                    <div class="product">
                        <img src="https://assets.pikiran-rakyat.com/crop/204x7:1986x1325/x/photo/2020/08/16/2708438435.jpg" alt="product-image">
                        <div class="price-and-detail">
                            <h4 class="name">kaos distro samurai japan - XL, Putih</h4>
                            <h5 class="price">Rp35.000</h5>
                        </div>
                    </div>
                    <div class="action-product">
                        <div class="note">
                            <a href="">Tulis catatan untuk produk</a>
                        </div>
                        <div class="action">
                            <div class="sub-action">
                                <a href=""><i class="zmdi zmdi-favorite"></i></a>
                            </div>
                            <div class="sub-action">
                                <a href=""><i class="zmdi zmdi-delete"></i></a>
                            </div>
                            <div class="sub-action">
                                <button>-</button>
                                <input type="number" readonly value="3">
                                <button>+</button>
                            </div>
                        </div>
                    </div>
                    <div class="product-check">
                        <input type="checkbox">
                    </div>
                </div>
                <div class="product-cart">
                    <div class="product">
                        <img src="https://assets.pikiran-rakyat.com/crop/204x7:1986x1325/x/photo/2020/08/16/2708438435.jpg" alt="product-image">
                        <div class="price-and-detail">
                            <h4 class="name">kaos distro samurai japan - XL, Putih</h4>
                            <h5 class="price">Rp35.000</h5>
                        </div>
                    </div>
                    <div class="action-product">
                        <div class="note">
                            <a href="">Tulis catatan untuk produk</a>
                        </div>
                        <div class="action">
                            <div class="sub-action">
                                <a href=""><i class="zmdi zmdi-favorite"></i></a>
                            </div>
                            <div class="sub-action">
                                <a href=""><i class="zmdi zmdi-delete"></i></a>
                            </div>
                            <div class="sub-action">
                                <button>-</button>
                                <input type="number" readonly value="3">
                                <button>+</button>
                            </div>
                        </div>
                    </div>
                    <div class="product-check">
                        <input type="checkbox">
                    </div>
                </div>
                <div class="product-cart">
                    <div class="product">
                        <img src="https://assets.pikiran-rakyat.com/crop/204x7:1986x1325/x/photo/2020/08/16/2708438435.jpg" alt="product-image">
                        <div class="price-and-detail">
                            <h4 class="name">kaos distro samurai japan - XL, Putih</h4>
                            <h5 class="price">Rp35.000</h5>
                        </div>
                    </div>
                    <div class="action-product">
                        <div class="note">
                            <a href="">Tulis catatan untuk produk</a>
                        </div>
                        <div class="action">
                            <div class="sub-action">
                                <a href=""><i class="zmdi zmdi-favorite"></i></a>
                            </div>
                            <div class="sub-action">
                                <a href=""><i class="zmdi zmdi-delete"></i></a>
                            </div>
                            <div class="sub-action">
                                <button>-</button>
                                <input type="number" readonly value="3">
                                <button>+</button>
                            </div>
                        </div>
                    </div>
                    <div class="product-check">
                        <input type="checkbox">
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-total-price">
            <div class="total-wrapper">
                <h4>Ringkasan Belanja</h4>
                <div class="total-price">
                    <span class="text">Total Harga</span>
                    <span class="price">Rp524.800</span>
                </div>
                <button>Beli (8)</button>
            </div>
        </div>
    </div>
    <div class="products-container">
        <div class="products-text-wrapper">
            <h4 class="related-product-title">Produk Lainya</h4>
        </div>
        <div class="products-wrapper home-recommendation-products-wrapper not-using-slick">
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
            <div class="product">
                <div class="thumb-product">
                    <img class="product-image" src="https://htmldemo.hasthemes.com/boria-preview/boria/assets/img/product/size-normal/product-home-3-img-2.jpg" alt="thumb-product">
                </div>
                <div class="desc-product">
                    <h5>{{ substr('Garnier White Skin Body Lotion', 0, 23) }}...</h5>
                    <div class="price-wrapper">
                        <h4>Rp. 103.500</h4>
                        <div class="discount">
                            <h5><strike>Rp. 200.000</strike></h5>
                            <span>30% OFF</span>
                        </div>
                    </div>
                    <div class="info-product">
                        <span class="stok">Stok 50</span>
                        <span class="sold">154 Terjual</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection