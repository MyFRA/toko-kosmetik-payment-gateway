<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductCategory;

class CategoriesController extends Controller
{
    public function index()
    {
        $data = [
            'title'         => 'Daftar Kategori',
            'nav'           => 'categories',
            'categories'    => ProductCategory::orderBy('category_name', 'ASC')->get()
        ];

        return view('web.pages.categories.index', $data);
    }
}
