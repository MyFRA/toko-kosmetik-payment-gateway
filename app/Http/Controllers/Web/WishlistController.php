<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $data = [
            'title'     => '',
            'nav'       => 'wishlist'
        ];

        return view('web.pages.wishlist.index', $data);
    }
}
