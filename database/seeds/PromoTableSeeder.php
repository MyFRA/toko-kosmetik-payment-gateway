<?php

use Illuminate\Database\Seeder;

use App\Models\Promo;
use App\Models\Product;

class PromoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::limit(200)->get();

        foreach ($products as $product) {
            if(is_null($product->promo)) {
                Promo::create([
                    'product_id'  => $product->id,
                    'forever'     => 1,
                ]);
            }
        }
    }
}
