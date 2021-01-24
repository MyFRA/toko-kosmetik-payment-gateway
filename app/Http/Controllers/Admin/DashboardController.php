<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Sales;

class DashboardController extends Controller
{
    public function index()
    {
        $jml_pendapatan = 0;
        $sales = Sales::get();
        foreach ($sales as $sale) {
            $jml_pendapatan += $sale->price_total;
        }
        
        $data = [
            'title'          => 'Dashboard',
            'main_title'     => 'Dashboard',
            'sidebar'        => 'dashboard',
            'jml_produk'     => Product::count(),
            'jml_customer'   => Customer::count(),
            'jml_penjualan'  => Sales::count(),
            'jml_pendapatan' => $jml_pendapatan,
        ];

        return view('admin.pages.dashboard.index', $data);
    }
}
