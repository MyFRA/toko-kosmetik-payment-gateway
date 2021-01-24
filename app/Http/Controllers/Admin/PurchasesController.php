<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sales;

class PurchasesController extends Controller
{
    public function index()
    {
        $data = [
            'main_title' => 'Pembelian ~ Semua Pembelian',
            'title'      => 'Pembelian ~ Semua Pembelian',
            'sidebar'    => 'all-purchases',
            'sales'      => Sales::orderBy('created_at', 'DESC')->paginate(10),
        ];

        return view('admin.pages.purchases.index', $data);
    }

    public function indexMenungguKonfirmasiPembayaran()
    {
        $data = [
            'main_title' => 'Pembelian ~ Menunggu Konfirmasi Bukti Pembayaran',
            'title'      => 'Pembelian ~ Menunggu Konfirmasi Bukti Pembayaran',
            'sidebar'    => 'menunggu-konfirmasi-bukti-pembayaran',
            'sales'      => Sales::where('status', 'menunggu konfirmasi bukti pembayaran')->orderBy('created_at', 'DESC')->paginate(10),
        ];

        return view('admin.pages.purchases.index', $data);
    }

    public function indexBelumBayar()
    {
        $data = [
            'main_title' => 'Pembelian ~ Belum Bayar',
            'title'      => 'Pembelian ~ Belum Bayar',
            'sidebar'    => 'belum-bayar',
            'sales'      => Sales::where('status', 'belum bayar')->orderBy('created_at', 'DESC')->paginate(10),
        ];

        return view('admin.pages.purchases.menunggu-konfirmasi-pembayaran.index', $data);
    }

    public function indexMenungguKonfirmasiBuktiPembayaran()
    {
        $data = [
            'main_title' => 'Pembelian ~ Menunggu Konfirmasi Bukti Pembayaran',
            'title'      => 'Pembelian ~ Menunggu Konfirmasi Bukti Pembayaran',
            'sidebar'    => 'belum-bayar',
            'sales'      => Sales::where('status', 'menunggu konfirmasi bukti pembayaran')->orderBy('updated_at', 'DESC')->paginate(10),
        ];

        return view('admin.pages.purchases.menunggu-konfirmasi-pembayaran.index', $data);
    }

    public function indexDikirim()
    {
        $data = [
            'main_title' => 'Pembelian ~ Dikirim',
            'title'      => 'Pembelian ~ Dikirim',
            'sidebar'    => 'dikirim',
            'sales'      => Sales::where('status', 'dikirim')->orderBy('updated_at', 'DESC')->paginate(10),
        ];

        return view('admin.pages.purchases.dikirim.index', $data);
    }

    public function indexDiterima()
    {
        $data = [
            'main_title' => 'Pembelian ~ Diterima',
            'title'      => 'Pembelian ~ Diterima',
            'sidebar'    => 'diterima',
            'sales'      => Sales::where('status', 'diterima')->orderBy('updated_at', 'DESC')->paginate(10),
        ];

        return view('admin.pages.purchases.diterima.index', $data);
    }

    public function indexExpired()
    {
        $data = [
            'main_title' => 'Pembelian ~ Expired',
            'title'      => 'Pembelian ~ Expired',
            'sidebar'    => 'expired',
            'sales'      => Sales::where('status', 'expired')->orderBy('updated_at', 'DESC')->paginate(10),
        ];

        return view('admin.pages.purchases.expired.index', $data);
    }

    public function show($id) {
        $data = [
            'main_title'    => 'Pembayaran ~ Detail',
            'title'         => 'Pembayaran ~ Detail',
            'sidebar'       => '',
            'sale'          => Sales::find($id),
        ];

        return view('admin.pages.purchases.show', $data);
    }

    public function confirmPayment($id) {
        $sale = Sales::find($id);
        $sale->update([
            'status'    => 'dikirim',
        ]);

        return redirect('/app-admin/purchases/dikirim')->with('success', 'Pembayaran ' . $sale->address->customer_name . ' telah dikonfirmasi');
    }
}
