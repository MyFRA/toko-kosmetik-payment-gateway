<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;

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
        $data = [
            'title'                     => 'Jual Judul Produk',
            'nav'                       => '',
            'product_category'          => 'Skin Care',
            'remove_bottom_navigation'  => true,
        ];

        return view('web.pages.product.show', $data);
    }
}
