<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductComment;
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

    public function getProductComments($product_id = null)
    {
        if(is_null($product_id)) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => 'Produk id tidak boleh kosong',
            ]);
        }

        $allProductsId = $this->getAllId(Product::get());
        if(!in_array($product_id, $allProductsId)) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => 'Tidak ditemukan komentar dari produk tersebut',
            ]);
        }

        $comments           = ProductComment::where('product_id', $product_id)->orderBy('created_at', 'DESC')->get();
        $valid_comment      = [];
        foreach ($comments as $comment) {
            $valid_comment[] = [
                'customer_photo' => $comment->customer->photo ? asset('/storage/images/customer-profiles/' . $comment->customer->photo) : asset('/images/icons/avatar.jpg'),
                'customer_name'  => $comment->customer->fullname,
                'comment_date'   => $comment->getCreatedAtAttributes($comment->created_at, 'diffForHumans'),
                'comment'        => $comment->comment,
            ];
        }
        return response()->json([
            'code'      => 200,
            'success'   => (boolean) true,
            'message'   => 'success comments has been retirieves',
            'data'      => [
                'comments' => $valid_comment,
            ],
        ]);
    }
}
