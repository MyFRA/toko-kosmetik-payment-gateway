<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $data = [
            'title'     => 'Promo Kosmetik dan Aksesoris', 
            'nav'       => 'promo',
            'arr_promo'  => Promo::where('forever', true)
                            ->orWhere('end_date', '>=', date('d-m-y'))
                            ->orderBy('updated_at', 'DESC')
                            ->simplePaginate(15),
        ];

        return view('web.pages.promo.index', $data);
    }
}
