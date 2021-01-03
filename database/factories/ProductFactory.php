<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $product_name       = $faker->bs;
    $product_categories = ProductCategory::select('id')->get()->toArray();

    return [
        'product_name'          => $product_name,
        'product_slug'          => Str::slug($product_name) . uniqid(),
        'product_category_id'   => $product_categories[array_rand($product_categories)]['id'],
        'price'                 => $faker->randomNumber(),
        'weight'                => $faker->randomNumber(3),
        'amount'                => $faker->numberBetween(1, 342),
        'condition'             => 'baru',
        'product_images'        => json_encode([["index"=>0,"name"=>"citra-hand-body-lotion-all-varian5fe7ddb168af4.jpg"],["index"=>1,"name"=>"citra-hand-body-lotion-all-varian5fe7ddb16b461.jpg"],["index"=>2,"name"=>"citra-hand-body-lotion-all-varian5fe7ddb16b719.jpg"]]),
        'enable_variants'       => 0,
        'description'           => '<p>👉CITRA SAKURA FAIR UV</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hand Body lotion terbaru dari Citra yang dibuat untuk kulit cantik perempuan Indonesia dengan menggunakan rahasia bunga Sakura.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kini Citra mengungkap rahasia bunga Sakura untuk kulit cantik Indonesia</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; BARU!</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kulit segar &amp; cerah merona mulai dalam 7 hari*</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Diperkaya kekuatan bunga Sakura &amp; Vit B3, Citra Sakura Fair UV membantu menghambat pr oduksi melanin dan noda gelap, untuk kulit lebih cerah merona, segar sepanjang hari.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Keunggulan</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kombinasi Ekstrak Sakura + Vitamin B3 berkhasiat mencegah produksi melanin dan noda gelap sehingga kulit lebih cerah dan merona.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Fragrance baru dalam Citra Sakura Fair UV lebih wangi dan tahan lama.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ekstrak Bunga Sakura dalam Citra Sakura Fair UV berasal dari Kanagawa, Asli dari Jepang.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 👉CITRA PEARLY WHITE UV</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; merupakan salah satu varian body lotion yang dikeluarkan oleh Citra. Citra Pearly White UV menghadirkan energi mencerahkan alami dari mutiara korea, yang dipilih dari keunikan kilaunya dan pada saat yang tepat dimana kerang mutiara merekah dan memperlihatkan mutiara yang bersinar alami.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 👉CITRA NOURISH WHITE UV</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Citra Hand Body Lotion Nourishing White UV 230ml&nbsp; dapat melindungi kulit dari sengatan matahari &amp; efek buruknya terhadap kulit, menjaga kehalusan &amp; kelembutan kulit, menjaga kelembaban kulit, dan mencerahkan kulit sehingga menjaga kulit Anda tetap tampak putih berkilau.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Manfaat</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Kandungan antioksidan dari bunga lotus salju</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Dapat melindungi kulit dari sengatan matahari &amp; efek buruknya terhadap kulit</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Aman digunakan</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Keunggulan</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Mengoptimalkan peremajaan kulit Merawat kulit di malam hari Kulit sehat dan segar</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 👉CITRA YOUTHFULL RADIANCE</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Madu dan Goji Berry dari pegunungan Himalaya dikenal telah digunakan dari generasi ke generasi untuk menjaga keremajaan kulit. Ekstrak buah Goji Berrynya dikenal membantu memperlambat kulit berubah menjadi kusam dan tua terlalu dini. Madunya dikenal sebagai pelembab alami. Vitamin Pencerah kulitnya dikenal membantu membuat kulit tampak cerah.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 👉CITRA SPOTLESS WHITE UV</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Beras Jepang kaya akan antioksidan dan dikenal dapat menghaluskan dan membuat kulit tampak putih. Minyak Bunga Camellia dikenal dapat merawat dan membuat kulit terasa lembut. Perpaduan UV protection nya (UVA &amp; UVB) membantu melindungi kulit dari sinar matahari yang dapat mengakibatkan terbentuknya noda hitam dan warna kulit yang tidak rata.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 👉CITRA WHITENING GEL</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Wakame, rumput laut Jepang telah lama menjadi salah satu rahasia kecantikan kulit cerah alami wanita Jepang. Kandungan dari rumput laut Jepang yang kaya akan vitamin dan antioksidan dipercaya secara turun-menurun oleh wanita Jepang untuk menjaga kesehatan kulitnnya.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Citra Whitening Gel Lotion memanfaatkan kekuatan Wakame Jepang yang diperkaya dengan vitamin dan mineral untuk kulit cerah alami.</p>',
    ];
});
