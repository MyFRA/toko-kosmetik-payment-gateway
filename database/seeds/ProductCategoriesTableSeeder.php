<?php

use Illuminate\Database\Seeder;

use App\Models\ProductCategory;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_categories = [
            [
                'id'             => 1,
                'category_name'  => 'Lipstik',
                'slug'           => 'lipstik',
                'image_category' => 'lipstik5fe7d21865ce7.jpg',
            ],
            [
                'id'             => 2,
                'category_name'  => 'Hair Care',
                'slug'           => 'hair-care',
                'image_category' => 'hair-care5fe7d36314cd9.jpg',
            ],
            [
                'id'             => 3,
                'category_name'  => 'Skin Care',
                'slug'           => 'skin-care',
                'image_category' => 'skin-care5fe7d4bda64f4.jpg',
            ],
            [
                'id'             => 4,
                'category_name'  => 'Body Lotion',
                'slug'           => 'body-lotion',
                'image_category' => 'body-lotion5fe7d5afc43a3.jpg',
            ],
            [
                'id'             => 5,
                'category_name'  => 'Kalung',
                'slug'           => 'kalung',
                'image_category' => 'kalung5fe7d797cceb3.webp',
            ],
            [
                'id'             => 6,
                'category_name'  => 'Bros',
                'slug'           => 'bros',
                'image_category' => 'bros5fe7d84ecce4a.jpg',
            ],
            [
                'id'             => 7,
                'category_name'  => 'Gelang',
                'slug'           => 'gelang',
                'image_category' => 'gelang5fe7d85871c40.jpg',
            ],
        ];

        foreach($product_categories as $product_category) {
            ProductCategory::create($product_category);
        }
    }
}
