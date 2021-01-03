<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Promo;
use App\Models\Product;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title'                 => 'Indah Jaya Kosmetik, Beli Kosmetik dan Aksesoris Lengkap Terpercaya',
            'nav'                   => 'home',
            'arr_promo'             => Promo::where('forever', true)
                                            ->orWhere('end_date', '>=', date('d-m-y'))
                                            ->orderBy('updated_at', 'DESC')
                                            ->limit(5)
                                            ->get(),
            'categories'            => ProductCategory::inRandomOrder()
                                        ->limit(6)
                                        ->get(),
            'newest_products'       => Product::orderBy('created_at', 'DESC')->limit(5)->get(),
            'best_seller_products'  => Product::orderBy('sold', 'DESC')->limit(5)->get(),
        ];

        return view('web.pages.home.index', $data);
    }
}
