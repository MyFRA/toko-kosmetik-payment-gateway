<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $data = [
            'title'  => 'Daftar Kategori',
            'nav'    => 'categories',
        ];

        return view('web.pages.categories.index', $data);
    }
}
