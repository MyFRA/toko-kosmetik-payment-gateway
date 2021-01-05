<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Wishlist;
use App\Models\ProductComment;

class ProductController extends Controller
{
    public function index(Request $request)
    {
       if(!$request->category && !$request->product_name) {
            $valid_products = Product::orderBy('created_at', 'DESC')->simplePaginate(20);
       } else {
           if( $request->category && $request->product_name ) {
               $product_category = ProductCategory::where('slug', $request->category)->first();
                if(!is_null($product_category)) {
                    $valid_products = Product::where('product_category_id', $product_category->id)
                    ->where('product_name', 'like', '%' . $request->product_name . '%')
                    ->orderBy('created_at', 'DESC')
                    ->simplePaginate(20);
                } elseif(is_null($product_category)) {
                    $valid_products = Product::where('product_name', 'like', '%' . $request->product_name . '%')
                                            ->orderBy('created_at', 'DESC')                
                                            ->simplePaginate(20);
                }
           } elseif( $request->category && !$request->product_name ) {
                $product_category = ProductCategory::where('slug', $request->category)->first();
                if(!is_null($product_category)) {
                    $valid_products = Product::where('product_category_id', $product_category->id)
                                        ->orderBy('created_at', 'DESC')                
                                        ->simplePaginate(20);
                } elseif(is_null($product_category)) {
                    $valid_products = Product::orderBy('created_at', 'DESC')->simplePaginate(20);
                }
           } elseif( $request->product_name && !$request->category ) {
            $valid_products = Product::where('product_name', 'like', '%' . $request->product_name . '%')
                                    ->orderBy('created_at', 'DESC')
                                    ->simplePaginate(20);
           }
       }
        
        $data = [
            'title'        => 'Jual Produk Kosmetik dan Aksesoris',
            'nav'          => 'product',
            'products'     => $valid_products,
        ];

        return view('web.pages.product.index', $data);
    }

    public function show($slug)
    {
        $product = Product::where('product_slug', $slug)->first();
        
        if(is_null($product)) {
            $data = [
                'title'   => 'Produk tidak ditemukan',
                'nav'     => ''
            ];
            return view('web.pages.product.product-show-not-found', $data);
        }
        
        $product->update([
            'counter' => $product->counter + 1,
        ]);

        $alreadyInFavorite = 0;

        if( Auth::guard('customer')->check() ) {
            $alreadyInFavorite = Wishlist::where('customer_id', Auth::guard('customer')->user()->id)
                                    ->where('product_id', $product->id)
                                    ->count();
        }

        $data = [
            'title'                     => 'Jual ' . $product->product_name,
            'nav'                       => '',
            'remove_bottom_navigation'  => true,
            'product'                   => $product,
            'product_images'            => (array) json_decode($product->product_images),
            'alreadyInFavorite'         => $alreadyInFavorite > 0 ? true : false,
            'comments'                  => ProductComment::where('product_id', $product->id)->orderBy('updated_at', 'DESC')->simplePaginate(5),
            'related_products'          => Product::inRandomOrder()->limit(15)->get(),
        ];

        return view('web.pages.product.show', $data);
    }
}
