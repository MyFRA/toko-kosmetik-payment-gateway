<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title'     => '',
            'nav'       => 'home'
        ];

        return view('web.pages.home.index', $data);
    }
}
