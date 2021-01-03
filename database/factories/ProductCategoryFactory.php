<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ProductCategory::class, function (Faker $faker) {
    $category_name = $faker->company;
    $images        = ['lipstik5fe7d21865ce7.jpg', 'hair-care5fe7d36314cd9.jpg', 'skin-care5fe7d4bda64f4.jpg', 'body-lotion5fe7d5afc43a3.jpg', 'kalung5fe7d797cceb3.webp', 'bros5fe7d84ecce4a.jpg', 'gelang5fe7d85871c40.jpg'];

    return [
        'category_name'     => $category_name,
        'slug'              => Str::slug($category_name),
        'image_category'    =>  $images[array_rand($images)],
    ];
});
