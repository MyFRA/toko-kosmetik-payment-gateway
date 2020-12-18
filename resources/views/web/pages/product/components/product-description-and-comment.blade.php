<div class="product-product-description-header">
    <div class="product-desc-wrapper">
        <h3 class="title">DESKRIPSI</h3>
        <p class="desc-product">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium dicta earum adipisci, pariatur sapiente asperiores quisquam illum velit, architecto commodi dolorum officiis doloribus quos excepturi alias nobis id quam distinctio?
        </p>
    </div>
    <div class="product-desc-wrapper">
        <h3 class="title">ULASAN</h3>
        <h5 class="ulasan-count">Semua ulasan 134</h5>
        <div class="ulasan-wrapper">
            <div class="ulasan">
                <div class="account">
                    <div class="photo">
                        <img src="https://ecs7.tokopedia.net/img/cache/100-square/user-1/2020/10/25/10689613/10689613_b3a6ed88-69ad-431f-a368-f0786037ebad.jpg" alt="photo-profile">
                    </div>
                    <div class="info">
                        <a href="" class="name">rina</a>
                        <span class="date">3 hari lalu</span>
                    </div>
                </div>
                <div class="comment">
                    <p class="comment-user">Lipstick nya bagus banget</p>
                </div>
            </div>
            <div class="ulasan">
                <div class="account">
                    <div class="photo">
                        <img src="https://ecs7.tokopedia.net/img/cache/100-square/user-1/2020/10/25/10689613/10689613_b3a6ed88-69ad-431f-a368-f0786037ebad.jpg" alt="photo-profile">
                    </div>
                    <div class="info">
                        <a href="" class="name">rina</a>
                        <span class="date">3 hari lalu</span>
                    </div>
                </div>
                <div class="comment">
                    <p class="comment-user">Terima Kasih, pengiriman ok, layanan oke</p>
                </div>
            </div>
            <div class="ulasan">
                <div class="account">
                    <div class="photo">
                        <img src="https://ecs7.tokopedia.net/img/cache/100-square/user-1/2020/10/25/10689613/10689613_b3a6ed88-69ad-431f-a368-f0786037ebad.jpg" alt="photo-profile">
                    </div>
                    <div class="info">
                        <a href="" class="name">rina</a>
                        <span class="date">3 hari lalu</span>
                    </div>
                </div>
                <div class="comment">
                    <p class="comment-user">Warna merah ready ndak ?</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        const height_product_header_desc = document.querySelector('.product-product-description-header .inner .product-desc-product').offsetHeight;
        const product_header_desc = document.querySelectorAll('.product-product-description-header .inner .product-desc-product a');

        product_header_desc.forEach((e) => {
            e.style.height = height_product_header_desc;
            console.log(height_product_header_desc);
        });

        console.log(product_header_desc);
    </script>