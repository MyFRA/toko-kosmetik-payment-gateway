<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;

class ApiController extends Controller
{
    public function ProductCategories()
    {
        return response()->json([
            'code'      => 200,
            'success'   => (boolean) true,
            'message'   => 'All product categories successfully retrieved',
            'data'      => [
                'product_categories' => ProductCategory::orderBy('category_name', 'ASC')->get(),
            ]
        ], 200);
    }

    public function getRecommendation($count = null) {
        if(!is_null($count)) {
            $products       = Product::inRandomOrder()->limit($count)->get();
            $valid_products = [];

            foreach ($products as $product) {
                $price                  = $product->price;
                $price_after_discount   = $product->price;
                $discount               = null;
                if(!is_null($product->discount)) {
                    if($product->discount->forever == true) {
                        $price_after_discount   = floor($price - ($price * $product->discount->discount_percent / 100));
                        $discount               = $product->discount->discount_percent;
                    } elseif(strtotime($product->discount->end_date) >= strtotime(date('d-m-y'))) {
                        $price_after_discount   = floor($price - ($price * $product->discount->discount_percent / 100));
                        $discount               = $product->discount->discount_percent;
                    }
                }

                $valid_products[] = [
                    'slug'                  => $product->product_slug,
                    'imageUrl'              => asset('/storage/images/products/' . json_decode($product->product_images)[0]->name),
                    'name'                  => $product->product_name,
                    'price'                 => $price,
                    'price_after_discount'  => $price_after_discount,
                    'discount'              => $discount,
                    'amount'                => $product->amount,
                    'sold'                  => $product->sold, 
                ];
            }
            return response()->json([
                'code'      => 200,
                'success'   => (boolean) true,
                'message'   => 'success productRecommendation has been retirieves',
                'data'      => [
                    'products'  => $valid_products,
                ]
            ]);
        } else {
            return response()->json([
                'code'      => 200,
                'success'   => (boolean) true,
                'message'   => 'success productRecommendation has been retirieves',
                'data'      => [
                    'products'  => Product::inRandomOrder()->get(),
                ]
            ]);
        }
    }
}
