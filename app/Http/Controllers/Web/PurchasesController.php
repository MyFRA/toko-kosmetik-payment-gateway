<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Sales;

class PurchasesController extends Controller
{
    public function indexBelumBayar()
    {
        $data = [
            'title'  => 'Pembayaran ~ Belum Bayar',
            'nav'    => 'purchases',
            'sales'  => Sales::where('customer_id', Auth::guard('customer')->user()->id)
                            ->where('status', 'belum bayar')->orderBy('created_at', 'DESC')->get(),
        ];

        return view('web.pages.purchases.belum-bayar.index', $data);
    }
}
