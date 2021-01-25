<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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

    public function indexMenungguKonfirmasiPembayaran()
    {
        $data = [
            'title'  => 'Pembayaran ~ Menunggu Konfirmasi Pembayaran',
            'nav'    => 'purchases',
            'sales'  => Sales::where('customer_id', Auth::guard('customer')->user()->id)
                            ->where('status', 'menunggu konfirmasi bukti pembayaran')->orderBy('updated_at', 'DESC')->get(),
        ];

        return view('web.pages.purchases.belum-bayar.index', $data);
    }

    public function indexDikirim() 
    {
        $data = [
            'title'  => 'Pembayaran ~ Dikirim',
            'nav'    => 'purchases',
            'sales'  => Sales::where('customer_id', Auth::guard('customer')->user()->id)
                            ->where('status', 'dikirim')->orderBy('updated_at', 'DESC')->get(),
        ];

        return view('web.pages.purchases.belum-bayar.index', $data);
    }

    public function indexDiterima()
    {
        $data = [
            'title'  => 'Pembayaran ~ Diterima',
            'nav'    => 'purchases',
            'sales'  => Sales::where('customer_id', Auth::guard('customer')->user()->id)
                            ->where('status', 'diterima')->orderBy('updated_at', 'DESC')->get(),
        ];

        return view('web.pages.purchases.belum-bayar.index', $data);
    }

    public function productBeAccepted(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sale_id'   => 'required',
        ], [
            'sale_id.required' => 'sale id tidak boleh kosong',
        ]);

        if($validator->fails()) {
            return back()->with('failed', $validator->errors()->first());
        }

        $sale = Sales::where('id', $request->sale_id)->first();

        if( is_null($sale) ) {
            return back()->with('failed', 'sale id tidak valid');
        }

        if( $sale->customer_id != Auth::guard('customer')->user()->id) {
            return back()->with('failed', 'id customer tidak cocok');
        }

        $sale->update([
            'status'  => 'diterima',
        ]);

        return redirect('/purchases/diterima')->with('success', 'Produk telah terkonfirmasi diterima');
    }
}
