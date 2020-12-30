<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Wishlist;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $data = [
            'title'     => '',
            'nav'       => 'wishlist'
        ];

        return view('web.pages.wishlist.index', $data);
    }

    public function addToWishlist(Request $request)
    {
        $allProductsId = join(',', $this->getAllId(Product::get()));

        $validator = Validator::make($request->all(), [
            'product_id' => "required|in:$allProductsId",
        ], [
            'product_id.required' => 'Produk tidak tidak boleh kosong',
            'product_id.in'       => 'Produk tidak ada / sudah dihapus',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => "validasi gagal",
                'data'      => [
                    'error'  => $validator->errors(),
                ]
            ], 200);
        }

        $countWishlist = Wishlist::where('customer_id', Auth::guard('customer')->user()->id)
        ->where('product_id', $request->product_id)
        ->count();

        if( $countWishlist > 0 ) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => "Produk sudah ada di daftar wishlist",
            ], 200);
        }

        Wishlist::create([
            'customer_id'   => Auth::guard('customer')->user()->id,
            'product_id'    => $request->product_id,
        ]);

        return response()->json([
            'code'      => 200,
            'success'   => (boolean) true,
            'message'   => 'Produk berhasil ditambahkan ke daftar wishlist',
            'data'      => [
                'customerWishlistAmount' => Wishlist::where('customer_id', Auth::guard('customer')->user()->id)->count(),
            ]
        ]);
    }

    public function deleteFromWishlist(Request $request)
    {
        $allProductsId = join(',', $this->getAllId(Product::get()));

        $validator = Validator::make($request->all(), [
            'product_id' => "required|in:$allProductsId",
        ], [
            'product_id.required' => 'Produk tidak tidak boleh kosong',
            'product_id.in'       => 'Produk tidak ada / sudah dihapus',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => $validator->errors()->first(),
                'data'      => [
                    'error'  => $validator->errors(),
                ]
            ], 200);
        }

        $wishlist = Wishlist::where('customer_id', Auth::guard('customer')->user()->id)
        ->where('product_id', $request->product_id);

        if( $wishlist->count() < 1 ) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => "Produk belum ada di daftar wishlist",
            ], 200);
        }

        $wishlist->delete();

        return response()->json([
            'code'      => 200,
            'success'   => (boolean) true,
            'message'   => 'Produk berhasil dihapus dari daftar wishlist',
            'data'      => [
                'customerWishlistAmount' => Wishlist::where('customer_id', Auth::guard('customer')->user()->id)->count(),
            ]
        ]);
    }
}
