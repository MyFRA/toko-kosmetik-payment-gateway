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
                'description'           => '👉CITRA SAKURA FAIR UV
                Hand Body lotion terbaru dari Citra yang dibuat untuk kulit cantik perempuan Indonesia dengan menggunakan rahasia bunga Sakura.
                Kini Citra mengungkap rahasia bunga Sakura untuk kulit cantik Indonesia
                BARU!
                Kulit segar & cerah merona mulai dalam 7 hari*
                Diperkaya kekuatan bunga Sakura & Vit B3, Citra Sakura Fair UV membantu menghambat pr oduksi melanin dan noda gelap, untuk kulit lebih cerah merona, segar sepanjang hari.
                Keunggulan
                Kombinasi Ekstrak Sakura + Vitamin B3 berkhasiat mencegah produksi melanin dan noda gelap sehingga kulit lebih cerah dan merona.
                Fragrance baru dalam Citra Sakura Fair UV lebih wangi dan tahan lama.
                Ekstrak Bunga Sakura dalam Citra Sakura Fair UV berasal dari Kanagawa, Asli dari Jepang.
                
                👉CITRA PEARLY WHITE UV
                
                merupakan salah satu varian body lotion yang dikeluarkan oleh Citra. Citra Pearly White UV menghadirkan energi mencerahkan alami dari mutiara korea, yang dipilih dari keunikan kilaunya dan pada saat yang tepat dimana kerang mutiara merekah dan memperlihatkan mutiara yang bersinar alami.
                
                👉CITRA NOURISH WHITE UV
                
                Citra Hand Body Lotion Nourishing White UV 230ml  dapat melindungi kulit dari sengatan matahari & efek buruknya terhadap kulit, menjaga kehalusan & kelembutan kulit, menjaga kelembaban kulit, dan mencerahkan kulit sehingga menjaga kulit Anda tetap tampak putih berkilau.
                Manfaat
                
                Kandungan antioksidan dari bunga lotus salju
                Dapat melindungi kulit dari sengatan matahari & efek buruknya terhadap kulit
                Aman digunakan
                Keunggulan
                
                Mengoptimalkan peremajaan kulit Merawat kulit di malam hari Kulit sehat dan segar
                
                👉CITRA YOUTHFULL RADIANCE
                
                Madu dan Goji Berry dari pegunungan Himalaya dikenal telah digunakan dari generasi ke generasi untuk menjaga keremajaan kulit. Ekstrak buah Goji Berrynya dikenal membantu memperlambat kulit berubah menjadi kusam dan tua terlalu dini. Madunya dikenal sebagai pelembab alami. Vitamin Pencerah kulitnya dikenal membantu membuat kulit tampak cerah.
                
                👉CITRA SPOTLESS WHITE UV
                
                Beras Jepang kaya akan antioksidan dan dikenal dapat menghaluskan dan membuat kulit tampak putih. Minyak Bunga Camellia dikenal dapat merawat dan membuat kulit terasa lembut. Perpaduan UV protection nya (UVA & UVB) membantu melindungi kulit dari sinar matahari yang dapat mengakibatkan terbentuknya noda hitam dan warna kulit yang tidak rata.
                
                👉CITRA WHITENING GEL
                
                Wakame, rumput laut Jepang telah lama menjadi salah satu rahasia kecantikan kulit cerah alami wanita Jepang. Kandungan dari rumput laut Jepang yang kaya akan vitamin dan antioksidan dipercaya secara turun-menurun oleh wanita Jepang untuk menjaga kesehatan kulitnnya.
                Citra Whitening Gel Lotion memanfaatkan kekuatan Wakame Jepang yang diperkaya dengan vitamin dan mineral untuk kulit cerah alami.',
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
                'description'           => 'Deskripsi MARINA HAND BODY LOTION UV / MARINA HBL UV 250ML
                MARINA HAND BODY LOTION UV / MARINA HBL UV
                
                ISI 250ML
                
                VARIAN : CANTUMKAN VARIAN YG DIPILIH
                
                BIRU, PINK , ORANGE',
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
                'description'           => 'Body lotion 
                Mencerahkan dan mencegah penuaan pada kulit
                Diperkaya dengan Vitamin B3, AHA, dan Pro-Retinol, yang memberikan 10 manfaat dalam 1 lotion, yaitu kulit tampak lebih cerah, warna kulit tetap cerah merata, perlindungan dari sinar UVA dan UVB
                Menyamarkan noda hitam pada kulit, kulit tampak lebih bercahaya, kulit terasa lebih kencang, menyamarkan kerut halus, merawat keremajaan kulit, melembabkan secara menyeluruh
                Volume : 200 mL',
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
                'description'           => 'Best for Gifting and for personal Use, combine it with matching dress and be the limelight of every Occassion
                Plated with High Quality Polish for Long Lasting Finish
                Suitable for all occassions
                Nickel free and Lead free as per International Standards that makes it very skin friendly. The plating is non-allergic and safe for all environments
                Jewelery Care : Never allow your fashion jewellery to come in contact with harsh chemicals, oils, nor spray perfumes directly on them. This will cause the jewellery to fade, discolour, or even ruin them completely. And we wouldn’t want that!',
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
                'description'           => 'Best for Gifting and for personal Use, combine it with matching dress and be the limelight of every Occassion
                Plated with High Quality Polish for Long Lasting Finish
                Suitable for all occassions
                Nickel free and Lead free as per International Standards that makes it very skin friendly. The plating is non-allergic and safe for all environments
                Jewelery Care : Never allow your fashion jewellery to come in contact with harsh chemicals, oils, nor spray perfumes directly on them. This will cause the jewellery to fade, discolour, or even ruin them completely. And we wouldn’t want that!',
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
                'description'           => 'Hanya untuk wanita dan anak perempuan, bukan untuk pria. Ini adalah gelang dan pengiring pengantin hadiah ibu yang terinspirasi.
                【BAHAN】 Gelang awal ini terbuat dari Titanium Steel, sama seperti instrumen bedah, bukan paduan. Bebas timah dan bebas nikel, aman untuk kulit. Tidak akan berubah menjadi hitam atau hijau, dan tidak akan berkarat, ramah lingkungan. Polishing kecerahan tinggi, tidak ada bintik atau butiran dalam perbesaran.
                【WARNA & DIAMOND】 3 Lapisan 18K naik berlapis emas di permukaan, digunakan kerajinan vakum suhu tinggi, tidak akan pudar.10 AAA + cubic-zirconia diamankan pada pulceras para mujer ini, dan tidak ada sekrup yang digali pergelangan tangan Anda, mudah dipakai dan lepas.
                【HADIAH YANG INDAH】  Hadiah kelulusan yang sempurna untuk anak perempuannya, dan juga hadiah pernikahan, hadiah ulang tahun untuk wanita, hadiah teman terbaik, hadiah penghargaan guru, dll.
                
                #gelang #Titanium #bracelet #gelangbangle #gelangkorea #gelanglapisemas #gelangcantik',
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
                'description'           => 'Gelang high-end terbaru, hadiah paling cocok untuk Natal dan Hari Valentine untuk kekasih dan teman

                A- (simbol tak terbatas): Mewakili cinta tak terbatas untuk kekasih Anda
                B- (Pohon Kehidupan): Pohon suci melambangkan kehidupan dan keberuntungan
                C- (Heart to Heart): Mewakili cinta bersama selamanya
                D- (Aku memilikimu di hatiku): Artinya aku mencintaimu dan memelukmu dalam pelukanku
                E- (4 daun rumput): melambangkan keberuntungan
                
                Bahannya sangat halus dan tidak berkarat
                Packing: 1 gelang',
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
                'description'           => 'EXTRA HOLD STYLING GEL: TRESemmé Extra Hold Hair Gel provides resistance to humidity all day long while continuously holding your style strong
                STYLING GEL FOR CONTROL: this hair gel has an alcohol-free styling gel formula that provides all the control you need without leaving your hair looking sticky or wet
                SALON-QUALITY HAIR STYLING: this professional, affordable salon-quality hair gel also targets flyaways to keep your style frizz-free and manageable
                HAIR STYLING GEL: rock your natural shine with this hair styling gel product that leaves hair defined, moveable and luminous
                SCULPTING GEL: TRESemmé Extra Hold Hair Gel works great after using any of our TRESemmé shampoo and conditioner hair products
                WOMENS HAIR GEL: this styling hair gel is designed for all hair types and works as a wavy, curly hair gel or as a fine hair styler to hold any look',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
