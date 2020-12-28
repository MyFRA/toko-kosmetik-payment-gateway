<?php

use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'id'                    => 1,
                'product_name'          => 'Citra Hand Body Lotion All Varian',
                'product_slug'          => 'citra-hand-body-lotion-all-varian',
                'product_category_id'   => 4,
                'price'                 => 7000,
                'weight'                => 400,
                'amount'                => 975,
                'condition'             => 'baru',
                'product_images'        => '[{"index":0,"name":"citra-hand-body-lotion-all-varian5fe7ddb168af4.jpg"},{"index":1,"name":"citra-hand-body-lotion-all-varian5fe7ddb16b461.jpg"},{"index":2,"name":"citra-hand-body-lotion-all-varian5fe7ddb16b719.jpg"}]',
                'description'           => '<p>👉CITRA SAKURA FAIR UV</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hand Body lotion terbaru dari Citra yang dibuat untuk kulit cantik perempuan Indonesia dengan menggunakan rahasia bunga Sakura.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kini Citra mengungkap rahasia bunga Sakura untuk kulit cantik Indonesia</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BARU!</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kulit segar &amp; cerah merona mulai dalam 7 hari*</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Diperkaya kekuatan bunga Sakura &amp; Vit B3, Citra Sakura Fair UV membantu menghambat pr oduksi melanin dan noda gelap, untuk kulit lebih cerah merona, segar sepanjang hari.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Keunggulan</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kombinasi Ekstrak Sakura + Vitamin B3 berkhasiat mencegah produksi melanin dan noda gelap sehingga kulit lebih cerah dan merona.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Fragrance baru dalam Citra Sakura Fair UV lebih wangi dan tahan lama.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ekstrak Bunga Sakura dalam Citra Sakura Fair UV berasal dari Kanagawa, Asli dari Jepang.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 👉CITRA PEARLY WHITE UV</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; merupakan salah satu varian body lotion yang dikeluarkan oleh Citra. Citra Pearly White UV menghadirkan energi mencerahkan alami dari mutiara korea, yang dipilih dari keunikan kilaunya dan pada saat yang tepat dimana kerang mutiara merekah dan memperlihatkan mutiara yang bersinar alami.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 👉CITRA NOURISH WHITE UV</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Citra Hand Body Lotion Nourishing White UV 230ml&nbsp; dapat melindungi kulit dari sengatan matahari &amp; efek buruknya terhadap kulit, menjaga kehalusan &amp; kelembutan kulit, menjaga kelembaban kulit, dan mencerahkan kulit sehingga menjaga kulit Anda tetap tampak putih berkilau.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Manfaat</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kandungan antioksidan dari bunga lotus salju</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Dapat melindungi kulit dari sengatan matahari &amp; efek buruknya terhadap kulit</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Aman digunakan</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Keunggulan</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Mengoptimalkan peremajaan kulit Merawat kulit di malam hari Kulit sehat dan segar</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 👉CITRA YOUTHFULL RADIANCE</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Madu dan Goji Berry dari pegunungan Himalaya dikenal telah digunakan dari generasi ke generasi untuk menjaga keremajaan kulit. Ekstrak buah Goji Berrynya dikenal membantu memperlambat kulit berubah menjadi kusam dan tua terlalu dini. Madunya dikenal sebagai pelembab alami. Vitamin Pencerah kulitnya dikenal membantu membuat kulit tampak cerah.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 👉CITRA SPOTLESS WHITE UV</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Beras Jepang kaya akan antioksidan dan dikenal dapat menghaluskan dan membuat kulit tampak putih. Minyak Bunga Camellia dikenal dapat merawat dan membuat kulit terasa lembut. Perpaduan UV protection nya (UVA &amp; UVB) membantu melindungi kulit dari sinar matahari yang dapat mengakibatkan terbentuknya noda hitam dan warna kulit yang tidak rata.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 👉CITRA WHITENING GEL</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Wakame, rumput laut Jepang telah lama menjadi salah satu rahasia kecantikan kulit cerah alami wanita Jepang. Kandungan dari rumput laut Jepang yang kaya akan vitamin dan antioksidan dipercaya secara turun-menurun oleh wanita Jepang untuk menjaga kesehatan kulitnnya.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Citra Whitening Gel Lotion memanfaatkan kekuatan Wakame Jepang yang diperkaya dengan vitamin dan mineral untuk kulit cerah alami.</p>',
            ],
            [
                'id'                    => 2,
                'product_name'          => 'MARINA HAND BODY LOTION UV / MARINA HBL UV 250ML',
                'product_slug'          => 'marina-hand-body-lotion-uv-marina-hbl-uv-250ml',
                'product_category_id'   => 4,
                'price'                 => 9000,
                'weight'                => 280,
                'amount'                => 247,
                'condition'             => 'baru',
                'product_images'        => '[{"index":0,"name":"marina-hand-body-lotion-uv-marina-hbl-uv-250ml5fe7dfd4514a5.webp"}]',
                'description'           => '<div>Deskripsi MARINA HAND BODY LOTION UV / MARINA HBL UV 250ML</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; MARINA HAND BODY LOTION UV / MARINA HBL UV</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ISI 250ML</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; VARIAN : CANTUMKAN VARIAN YG DIPILIH</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BIRU, PINK , ORANGE</div>',
            ],
            [
                'id'                    => 3,
                'product_name'          => 'Vaseline Healthy White Perfect Hand Body Lotion [200 mL]',
                'product_slug'          => 'vaseline-healthy-white-perfect-hand-body-lotion-200-ml',
                'product_category_id'   => 4,
                'price'                 => 19250,
                'weight'                => 275,
                'amount'                => 423,
                'condition'             => 'baru',
                'product_images'        => '[{"index":0,"name":"vaseline-healthy-white-perfect-hand-body-lotion-200-ml5fe7e065e33eb.webp"}]',
                'description'           => '<div>Body lotion&nbsp;</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Mencerahkan dan mencegah penuaan pada kulit</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Diperkaya dengan Vitamin B3, AHA, dan Pro-Retinol, yang memberikan 10 manfaat dalam 1 lotion, yaitu kulit tampak lebih cerah, warna kulit tetap cerah merata, perlindungan dari sinar UVA dan UVB</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Menyamarkan noda hitam pada kulit, kulit tampak lebih bercahaya, kulit terasa lebih kencang, menyamarkan kerut halus, merawat keremajaan kulit, melembabkan secara menyeluruh</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Volume : 200 mL</div>',
            ],
            [
                'id'                    => 4,
                'product_name'          => 'YouBella Jewellery Latest Stylish Crystal Unisex Deer Brooch for Women/Girls/Men',
                'product_slug'          => 'youbella-jewellery-latest-stylish-crystal-unisex-deer-brooch-for-womengirlsmen',
                'product_category_id'   => 6,
                'price'                 => 350000,
                'weight'                => 345,
                'amount'                => 5,
                'condition'             => 'baru',
                'product_images'        => '[{"index":0,"name":"youbella-jewellery-latest-stylish-crystal-unisex-deer-brooch-for-womengirlsmen5fe7e134df34c.jpg"},{"index":1,"name":"youbella-jewellery-latest-stylish-crystal-unisex-deer-brooch-for-womengirlsmen5fe7e134df876.jpg"}]',
                'description'           => '<div>Best for Gifting and for personal Use, combine it with matching dress and be the limelight of every Occassion</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Plated with High Quality Polish for Long Lasting Finish</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Suitable for all occassions</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Nickel free and Lead free as per International Standards that makes it very skin friendly. The plating is non-allergic and safe for all environments</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Jewelery Care : Never allow your fashion jewellery to come in contact with harsh chemicals, oils, nor spray perfumes directly on them. This will cause the jewellery to fade, discolour, or even ruin them completely. And we wouldn’t want that!</div>',
            ],
            [
                'id'                    => 5,
                'product_name'          => 'YouBella Jewellery Latest Stylish Crystal Unisex Deer Brooch for Women/Girls/Men (Silver)',
                'product_slug'          => 'youbella-jewellery-latest-stylish-crystal-unisex-deer-brooch-for-womengirlsmen-silver',
                'product_category_id'   => 6,
                'price'                 => 3000000,
                'weight'                => 670,
                'amount'                => 7,
                'condition'             => 'baru',
                'product_images'        => '[{"index":0,"name":"youbella-jewellery-latest-stylish-crystal-unisex-deer-brooch-for-womengirlsmen-silver5fe7e179eaf3c.jpg"}]',
                'description'           => '<div>Best for Gifting and for personal Use, combine it with matching dress and be the limelight of every Occassion</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Plated with High Quality Polish for Long Lasting Finish</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Suitable for all occassions</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Nickel free and Lead free as per International Standards that makes it very skin friendly. The plating is non-allergic and safe for all environments</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Jewelery Care : Never allow your fashion jewellery to come in contact with harsh chemicals, oils, nor spray perfumes directly on them. This will cause the jewellery to fade, discolour, or even ruin them completely. And we wouldn’t want that!</div>',
            ],
            [
                'id'                    => 6,
                'product_name'          => 'Korea Titanium Gelang Wanita Nama Perhiasan Bracelet Gadis Hadiah Ulang Tahun Unik Emas Bangle',
                'product_slug'          => 'korea-titanium-gelang-wanita-nama-perhiasan-bracelet-gadis-hadiah-ulang-tahun-unik-emas-bangle',
                'product_category_id'   => 7,
                'price'                 => 20000,
                'weight'                => 240,
                'amount'                => 100,
                'condition'             => 'baru',
                'product_images'        => '[{"index":0,"name":"korea-titanium-gelang-wanita-nama-perhiasan-bracelet-gadis-hadiah-ulang-tahun-unik-emas-bangle5fe7e2828c606.jpg"},{"index":1,"name":"korea-titanium-gelang-wanita-nama-perhiasan-bracelet-gadis-hadiah-ulang-tahun-unik-emas-bangle5fe7e2828d666.jpg"},{"index":2,"name":"korea-titanium-gelang-wanita-nama-perhiasan-bracelet-gadis-hadiah-ulang-tahun-unik-emas-bangle5fe7e2828dba8.jpg"},{"index":3,"name":"korea-titanium-gelang-wanita-nama-perhiasan-bracelet-gadis-hadiah-ulang-tahun-unik-emas-bangle5fe7e2828dfae.jpg"}]',
                'description'           => '<div>Hanya untuk wanita dan anak perempuan, bukan untuk pria. Ini adalah gelang dan pengiring pengantin hadiah ibu yang terinspirasi.</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 【BAHAN】 Gelang awal ini terbuat dari Titanium Steel, sama seperti instrumen bedah, bukan paduan. Bebas timah dan bebas nikel, aman untuk kulit. Tidak akan berubah menjadi hitam atau hijau, dan tidak akan berkarat, ramah lingkungan. Polishing kecerahan tinggi, tidak ada bintik atau butiran dalam perbesaran.</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 【WARNA &amp; DIAMOND】 3 Lapisan 18K naik berlapis emas di permukaan, digunakan kerajinan vakum suhu tinggi, tidak akan pudar.10 AAA + cubic-zirconia diamankan pada pulceras para mujer ini, dan tidak ada sekrup yang digali pergelangan tangan Anda, mudah dipakai dan lepas.</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 【HADIAH YANG INDAH】&nbsp; Hadiah kelulusan yang sempurna untuk anak perempuannya, dan juga hadiah pernikahan, hadiah ulang tahun untuk wanita, hadiah teman terbaik, hadiah penghargaan guru, dll.</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; #gelang #Titanium #bracelet #gelangbangle #gelangkorea #gelanglapisemas #gelangcantik</div>',
            ],
            [
                'id'                    => 7,
                'product_name'          => 'Gelang Titanium Wanita Cinta tak terbatas, pohon kehidupan, hati ke hati, gelang liontin Bracelet',
                'product_slug'          => 'gelang-titanium-wanita-cinta-tak-terbatas-pohon-kehidupan-hati-ke-hati-gelang-liontin-bracelet',
                'product_category_id'   => 7,
                'price'                 => 19500,
                'weight'                => 346,
                'amount'                => 25,
                'condition'             => 'baru',
                'product_images'        => '[{"index":0,"name":"gelang-titanium-wanita-cinta-tak-terbatas-pohon-kehidupan-hati-ke-hati-gelang-liontin-bracelet5fe7e3bd554ae.jpg"},{"index":1,"name":"gelang-titanium-wanita-cinta-tak-terbatas-pohon-kehidupan-hati-ke-hati-gelang-liontin-bracelet5fe7e3bd5602d.jpg"},{"index":2,"name":"gelang-titanium-wanita-cinta-tak-terbatas-pohon-kehidupan-hati-ke-hati-gelang-liontin-bracelet5fe7e3bd5663f.jpg"},{"index":3,"name":"gelang-titanium-wanita-cinta-tak-terbatas-pohon-kehidupan-hati-ke-hati-gelang-liontin-bracelet5fe7e3bd56aa8.jpg"}]',
                'description'           => '<div><font color="#6a8759">Gelang high-end terbaru, hadiah paling cocok untuk Natal dan Hari Valentine untuk kekasih dan teman</font></div><div><font color="#6a8759"><br></font></div><div><font color="#6a8759">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; A- (simbol tak terbatas): Mewakili cinta tak terbatas untuk kekasih Anda</font></div><div><font color="#6a8759">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; B- (Pohon Kehidupan): Pohon suci melambangkan kehidupan dan keberuntungan</font></div><div><font color="#6a8759">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; C- (Heart to Heart): Mewakili cinta bersama selamanya</font></div><div><font color="#6a8759">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; D- (Aku memilikimu di hatiku): Artinya aku mencintaimu dan memelukmu dalam pelukanku</font></div><div><font color="#6a8759">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; E- (4 daun rumput): melambangkan keberuntungan</font></div><div><font color="#6a8759">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</font></div><div><font color="#6a8759">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Bahannya sangat halus dan tidak berkarat</font></div><div><font color="#6a8759">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Packing: 1 gelang</font></div>',
            ],
            [
                'id'                    => 8,
                'product_name'          => 'TRESemmé TRES Two Hair Styling Gel, Extra Hold Styling Extra Firm Control Hair Gel for All Hair Types 9 oz, Pack of 6',
                'product_slug'          => 'tresemme-tres-two-hair-styling-gel-extra-hold-styling-extra-firm-control-hair-gel-for-all-hair-types-9-oz-pack-of-6',
                'product_category_id'   => 2,
                'price'                 => 50500,
                'weight'                => 576,
                'amount'                => 72,
                'condition'             => 'baru',
                'product_images'        => '[{"index":0,"name":"tresemme-tres-two-hair-styling-gel-extra-hold-styling-extra-firm-control-hair-gel-for-all-hair-types-9-oz-pack-of-65fe7e463e0af0.jpg"}]',
                'description'           => '<div>EXTRA HOLD STYLING GEL: TRESemmé Extra Hold Hair Gel provides resistance to humidity all day long while continuously holding your style strong</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; STYLING GEL FOR CONTROL: this hair gel has an alcohol-free styling gel formula that provides all the control you need without leaving your hair looking sticky or wet</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SALON-QUALITY HAIR STYLING: this professional, affordable salon-quality hair gel also targets flyaways to keep your style frizz-free and manageable</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; HAIR STYLING GEL: rock your natural shine with this hair styling gel product that leaves hair defined, moveable and luminous</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SCULPTING GEL: TRESemmé Extra Hold Hair Gel works great after using any of our TRESemmé shampoo and conditioner hair products</div><div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; WOMENS HAIR GEL: this styling hair gel is designed for all hair types and works as a wavy, curly hair gel or as a fine hair styler to hold any look</div>',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
