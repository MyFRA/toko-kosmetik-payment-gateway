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
use App\Models\CustomerAddress;

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
            $price                  = $cart->product->price;
            $price_after_discount   = $cart->product->price;
            $discount               = null;
            if(!is_null($cart->product->discount)) {
                if($cart->product->discount->forever == true) {
                    $price_after_discount   = floor($price - ($price * $cart->product->discount->discount_percent / 100));
                    $discount               = $cart->product->discount->discount_percent;
                } elseif(strtotime($cart->product->discount->end_date) >= strtotime(date('d-m-y'))) {
                    $price_after_discount   = floor($price - ($price * $cart->product->discount->discount_percent / 100));
                    $discount               = $cart->product->discount->discount_percent;
                }
            }
            $validCarts[] = [
                'cart_id'               => $cart->id,
                'product_id'            => $cart->product_id,
                'image_src'             => asset('/storage/images/products/' . json_decode($cart->product->product_images)[0]->name),
                'product_name'          => $cart->product->product_name,
                'price'                 => $price,
                'price_after_discount'  => $price_after_discount,
                'discount'              => $discount,
                'product_amount'        => $cart->product->amount,
                'cart_amount'           => $cart->amount,
                'is_wishlist'           => $amount_wishlist > 0 ? true : false,
                'is_checked'            => $cart->is_checked,
                'variant'               => $cart->variant,
            ];
        }

        $data = [
            'title'                     => 'Keranjang Produk Kosmetik dan Aksesoris',
            'nav'                       => 'cart',
            'remove_bottom_navigation'  => true,
            'carts'                     => $validCarts,
            'related_products'          => Product::inRandomOrder()->limit(15)->get(),
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
        $validator = Validator::make($request->all(), [
            'cart_id'             => "required",
        ], [
            'cart_id.required' => 'Produk tidak boleh kosong',
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

        $cart = Cart::where('customer_id', Auth::guard('customer')->user()->id)->where('id', $request->cart_id);
        if( $cart->count() > 0 ) {
            $cart->first()->delete();
        }

        $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)->orderBy('created_at', 'DESC')->get();
        $validCarts = [];

        foreach ($carts as $cart) {
            $amount_wishlist = Wishlist::where('customer_id', $cart->customer_id)
                                        ->where('product_id', $cart->product->id)
                                        ->count();
            $price                  = $cart->product->price;
            $price_after_discount   = $cart->product->price;
            $discount               = null;
            if(!is_null($cart->product->discount)) {
                if($cart->product->discount->forever == true) {
                    $price_after_discount   = floor($price - ($price * $cart->product->discount->discount_percent / 100));
                    $discount               = $cart->product->discount->discount_percent;
                } elseif(strtotime($cart->product->discount->end_date) >= strtotime(date('d-m-y'))) {
                    $price_after_discount   = floor($price - ($price * $cart->product->discount->discount_percent / 100));
                    $discount               = $cart->product->discount->discount_percent;
                }
            }
            $validCarts[] = [
                'cart_id'               => $cart->id,
                'product_id'            => $cart->product_id,
                'image_src'             => asset('/storage/images/products/' . json_decode($cart->product->product_images)[0]->name),
                'product_name'          => $cart->product->product_name,
                'price'                 => $price,
                'price_after_discount'  => $price_after_discount,
                'discount'              => $discount,
                'product_amount'        => $cart->product->amount,
                'cart_amount'           => $cart->amount,
                'is_wishlist'           => $amount_wishlist > 0 ? true : false,
                'is_checked'            => $cart->is_checked,
                'variant'               => $cart->variant,
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

    public function checkedCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id'             => "required",
            'is_checked'          => 'required|boolean',
        ], [
            'cart_id.required'    => 'Produk tidak boleh kosong',
            'is_checked'          => 'nilai input tidak valid'
        ]);

        if($validator->fails()) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => $validator->errors()->first(),
            ]);
        }

        $cart = Cart::where('customer_id', Auth::guard('customer')->user()->id)
                    ->where('id', $request->cart_id)->first();

        if( $request->is_checked ) {
            $cart->update([
                'is_checked' => true,
            ]);

            return response()->json([
                'code'      => 200,
                'success'   => (boolean) true,
                'message'   => 'Produk berhasil di checklist',
            ]);
        } else {
            $cart->update([
                'is_checked' => false,
            ]);

            return response()->json([
                'code'      => 200,
                'success'   => (boolean) true,
                'message'   => 'Produk berhasil di unchecklist',
            ]);
        }
    }

    public function increaseDecreaseCart(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cart_id'               => "required",
            'is_increased'          => 'required|boolean',
        ], [
            'cart_id.required'       => 'Produk tidak boleh kosong',
            'is_increased.required'  => 'Status tidak boleh kosong',
            'is_increased.boolean'   => 'Status tidak valid',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => $validator->errors()->first(),
            ]);
        }

        $cart = Cart::where('customer_id', Auth::guard('customer')->user()->id)
                    ->where('id', $request->cart_id)->first();

        if( $request->is_increased ) {
            $cart->update([
                'amount' => $cart->amount + 1,
            ]);
        } else {
            $cart->update([
                'amount' => $cart->amount - 1,
            ]);
        }

        return response()->json([
            'code'      => 200,
            'success'   => (boolean) true,
            'message'   => 'Jumlah produk berhasil diupdate',
            'data'      => [
                'product_amount' => $cart->amount,
            ]
        ]);
    }

    public function getShipment()
    {
        $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)
                    ->where('is_checked', true)    
                    ->orderBy('updated_at', 'DESC')->get();
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
                'is_checked'        => $cart->is_checked
            ];
        }

        $address = CustomerAddress::where('customer_id', Auth::guard('customer')->user()->id)
        ->where('main_address', true)->first();

        $address = $address ? $address : CustomerAddress::where('customer_id', Auth::guard('customer')->user()->id)
                                                        ->orderBy('created_at', 'ASC')->first();

        $addresses = CustomerAddress::where('customer_id', Auth::guard('customer')->user()->id)
                                        ->orderBy('main_address', 'DESC')
                                        ->orderBy('updated_at', 'DESC')->get();
        $data = [
            'title'                     => 'Checkout Produk Kosmetik dan Aksesoris',
            'nav'                       => 'cart',
            'carts'                     => $validCarts,
            'remove_bottom_navigation'  => true,
            'address'                   => $address,
            'addresses'                 => $addresses,
        ];

        return view('web.pages.cart.shipment', $data);
    }
}
