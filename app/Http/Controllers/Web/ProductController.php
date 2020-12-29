<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Wishlist;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        if( isset($request->category) ) {
            $category = ProductCategory::where('slug', $request->category)->first();
            if( !is_null($category) ) {
                $products = Product::where('product_category_id', $category->id)->orderBy('created_at', 'DESC')->get();
            } else {
                $products = Product::orderBy('created_at', 'DESC')->get();
            }
        } else {
            $products = Product::orderBy('created_at', 'DESC')->get();
        }

        $data = [
            'title'        => 'Jual Judul Produk',
            'nav'          => '',
            'products'     => $products,
        ];

        return view('web.pages.product.index', $data);
    }

    public function show($slug)
    {
        $product = Product::where('product_slug', $slug)->first();
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
            'title'                     => 'Jual Judul Produk',
            'nav'                       => '',
            'remove_bottom_navigation'  => true,
            'product'                   => $product,
            'product_images'            => (array) json_decode($product->product_images),
            'alreadyInFavorite'         => $alreadyInFavorite > 0 ? true : false,
        ];

        return view('web.pages.product.show', $data);
    }
}
