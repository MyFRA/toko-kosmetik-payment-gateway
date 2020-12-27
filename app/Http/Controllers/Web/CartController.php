<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $data = [
            'title'     => 'cart',
            'nav'       => 'cart',
            'remove_bottom_navigation' => true
        ];

        return view('web.pages.cart.cart', $data);
    }

    public function addToCart(Request $request)
    {
        return response()->json([
            'code'      => '200',
            'success'   => (boolean) true,
            'message'   => 'Produk berhasil ditambahkan ke keranjang',
        ], 200);
    }
}
