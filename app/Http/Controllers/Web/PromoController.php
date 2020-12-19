<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $data = [
            'title'     => 'promo', 
            'nav'       => 'promo',
        ];

        return view('web.pages.promo.index', $data);
    }
}
