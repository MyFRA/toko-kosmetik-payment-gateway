<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
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
