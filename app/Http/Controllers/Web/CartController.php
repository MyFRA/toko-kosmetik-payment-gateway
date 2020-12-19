<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
