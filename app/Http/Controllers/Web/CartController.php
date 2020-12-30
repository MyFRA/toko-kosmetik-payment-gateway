<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\ProductVariant;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)->orderBy('created_at', 'DESC')->get();
        $validCarts = [];
        
        foreach ($carts as $cart) {
            $amount_wishlist = Wishlist::where('customer_id', $cart->customer_id)
                                        ->where('product_id', $cart->product->id)
                                        ->count();
            $validCarts[] = [
                'product_id'        => $cart->product_id,
                'image_src'         => asset('/storage/images/products/' . json_decode($cart->product->product_images)[0]->name),
                'product_name'      => $cart->product->product_name,
                'product_price'     => $cart->product->price,
                'product_amount'    => $cart->product->amount,
                'cart_amount'       => $cart->amount,
                'is_wishlist'       => $amount_wishlist > 0 ? true : false,
            ];
        }

        $price_total = 0;
        foreach ($carts as $cart) {
            $price_total += $cart->product->price * $cart->amount;
        }
        
        $data = [
            'title'                     => 'cart',
            'nav'                       => 'cart',
            'remove_bottom_navigation'  => true,
            'carts'                     => $validCarts,
            'price_total'               => $price_total
        ];

        return view('web.pages.cart.cart', $data);
    }

    public function addToCart(Request $request)
    {
        $allProductsId = join(',', $this->getAllId(Product::get()));
        
        $validator = Validator::make($request->all(), [
            'product_id' => "required|in:$allProductsId",
            'variant'    => 'required',
            'amount'     => 'required|numeric|min:1'
        ], [
            'product_id.required' => 'Produk tidak boleh kosong',
            'product_id.in'       => 'Produk tidak ada / sudah dihapus',
            'amount.required'     => 'Jumlah tidak boleh kosong',
            'amount.numeric'      => 'Jumlah harus menggunakan angka',
            'amount.min'          => 'Jumlah minimal 1',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => "Doesn't pass validation",
                'data'      => [
                    'error'  => $validator->errors(),
                ]
            ], 200);
        }

        $product = Product::find($request->product_id);
        $secondValidator = Validator::make($request->all(), [
            'amount'     => "max:$product->amount"
        ], [
            'amount.max'      => 'Jumlah maksimal adalah ' . $product->amount,
        ]);

        if($secondValidator->fails()) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => 'Jumlah maksimal adalah ' . $product->amount,
            ], 200);
        }

        if( $request->variant['has_variant'] ) {
            $db_product_variants = ProductVariant::where('product_id', $product->id)->get();
            $db_product_variants = $this->getAllOneColumn($db_product_variants, 'variant');
    
            if( !in_array($request->variant['variant'], $db_product_variants) ) {
                return response()->json([
                    'code'      => 404,
                    'success'   => (boolean) false,
                    'message'   => "Variant tidak ditemukan",
                ], 200);
            }
        }


        $cart = Cart::create([
            'customer_id'   => Auth::guard('customer')->user()->id,
            'product_id'    => $product->id,
            'amount'        => $request->amount,
            'variant'       => ( $request->variant['has_variant'] ) ? $request->variant['variant'] : '',
        ]);
        
        return response()->json([
            'code'      => '200',
            'success'   => (boolean) true,
            'message'   => 'Produk berhasil ditambahkan ke keranjang',
            'data'      => [
                'customerCartAmount'    => Cart::where('customer_id', Auth::guard('customer')->user()->id)->count(),
            ],
        ], 200);
    }

    public function deleteFromCart(Request $request)
    {
        $allProductsId = join(',', $this->getAllId(Product::get()));

        $validator = Validator::make($request->all(), [
            'product_id'             => "required|in:$allProductsId",
        ], [
            'product_id.required' => 'Produk tidak boleh kosong',
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
            ]);
        }

        $cart = Cart::where('customer_id', Auth::guard('customer')->user()->id)->where('product_id', $request->product_id);
        
        if( $cart->count() > 0 ) {
            $cart->delete();
        }

        $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)->orderBy('created_at', 'DESC')->get();
        $validCarts = [];

        foreach ($carts as $cart) {
            $validCarts[] = [
                'product_id' => $cart->product->product_id,
                'image_src' => asset('/storage/images/products/' . json_decode($cart->product->product_images)[0]->name),
                'product_name' => $cart->product->product_name,
                'product_price' => $cart->product->price,
                'product_amount' => $cart->product->amount,
                'cart_amount'   => $cart->amount,
            ];
        }

        return response()->json([
            'code'      => '200',
            'success'   => (boolean) true,
            'message'   => 'Produk berhasil dihapus dari keranjang',
            'data'      => [
                'carts'    => $validCarts,
                'customerCartAmount' => count($validCarts)
            ],
        ], 200);
    }
}
