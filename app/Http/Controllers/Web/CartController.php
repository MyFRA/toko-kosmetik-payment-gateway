<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Session;

use App\Models\Cart;
use App\Models\Sales;
use App\Models\SalesAddress;
use App\Models\SalesProduct;
use App\Models\SalesBankAccount;
use App\Models\SalesExpedition;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Customer;
use App\Models\BankAccount;
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
        $price_product_total = 0;
        $amount_product_total = 0;
        $weight_product_total = 0;
        $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)
                    ->where('is_checked', true)    
                    ->orderBy('updated_at', 'DESC')->get();
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
            
            $hasDiscount = $discount ? true : false;
            $price_product_total += $price_after_discount * $cart['amount'];
            $amount_product_total += $cart->amount;
            $weight_product_total += $cart->product->weight * $cart->amount;
            $validCarts[] = [
                'product_id'            => $cart->product_id,
                'image_src'             => asset('/storage/images/products/' . json_decode($cart->product->product_images)[0]->name),
                'product_name'          => $cart->product->product_name,
                'product_price'         => $cart->product->price,
                'product_amount'        => $cart->product->amount,
                'product_weight'        => $cart->product->weight,
                'cart_amount'           => $cart->amount,
                'is_wishlist'           => $amount_wishlist > 0 ? true : false,
                'is_checked'            => $cart->is_checked,
                'price_after_diskon'    => $price_after_discount,
                'has_discount'          => $hasDiscount,
                'discount_percent'      => $discount,
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
            'price_product_total'       => $price_product_total,
            'amount_product_total'      => $amount_product_total,
            'weight_product_total'      => $weight_product_total,
            'bank_accounts'             => BankAccount::orderBy('bank_name', 'ASC')->get(),
        ];

        return view('web.pages.cart.shipment', $data);
    }

    public function checkout(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'address_id'            => 'required',
                'type_expedition'       => 'required',
                'price_total_payment'   => 'required',
                'price_expedition'      => 'required',
                'bank_id'               => 'required',
            ], [
                'address_id.required'           => 'alamat tidak boleh kosong',
                'type_expedition.required'      => 'tipe expedisi tidak boleh kosong',
                'price_total_payment.required'  => 'total harga tidak boleh kosong',
                'price_expedition.required'     => 'harga ekspedisi tidak boleh kosong',
                'bank_id.required'              => 'bank tidak boleh kosong',
            ]);
    
            if( $validator->fails() ) {
                return response()->json([
                    'code'      => 401,
                    'success'   => (boolean) false,
                    'message'   => $validator->errors()->first(),
                ]);
            }
    
            $customer = Customer::find(Auth::guard('customer')->user()->id);
    
            if(!in_array($request->address_id, $this->getAllId($customer->customerAddress))) {
                return response()->json([
                    'code'      => 401,
                    'success'   => (boolean) false,
                    'message'   => 'Alamat tidak valid',
                ]);
            };
    
            if(!in_array($request->bank_id, $this->getAllId(BankAccount::get()))) {
                return response()->json([
                    'code'      => 401,
                    'success'   => (boolean) false,
                    'message'   => 'Bank tidak valid',
                ]);
            };
    
            $customerAddress    = CustomerAddress::find($request->address_id);
            $carts              = Cart::where('customer_id', $customer->id)
                                    ->where('is_checked', true)    
                                    ->orderBy('updated_at', 'DESC')->get();
            $weightTotal        = 0;
            $price_total        = 0;
            $amount_total       = 0;

            foreach ($carts as $cart) {
                $product_discount_percent       = $cart->product->discount ? $cart->product->discount->discount_percent : 0;
                $product_price                  = $cart->product->price;
                $product_price_after_discount   = $product_price - ( $product_price * $product_discount_percent / 100 );

                $weightTotal  += $cart->product->weight * $cart->amount;
                $price_total  += $product_price_after_discount * $cart->amount;
                $amount_total += $cart->amount;
            }
    
            $client = new Client();
            $ongkirValid = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
                'form_params' => [
                    'key'           => 'ee1571301ce06a6cd9a9db8967e5e375',
                    'origin'        => 375,
                    'destination'   => $customerAddress->city_id,
                    'weight'        => $weightTotal,
                    'courier'       => 'jne',
                ]
            ]);
            $ongkirValid = json_decode((string) $ongkirValid->getBody())->rajaongkir;
            // Check Type Expedition
            $passValidationTypeExpedition = false;
            $costObj = null;

            foreach($ongkirValid->results[0]->costs as $cost) {
                if( $cost->service == $request->type_expedition ) {
                    $passValidationTypeExpedition = true;
                    $costObj = $cost;
                }
            }
    
            if( !$passValidationTypeExpedition ) {
                return response()->json([
                    'code'      => 401,
                    'success'   => (boolean) false,
                    'message'   => 'Layanan Expedisi tidak valid',
                ]);
            }
    
            if( $costObj->cost[0]->value != $request->price_expedition ) {
                return response()->json([
                    'code'      => 401,
                    'success'   => (boolean) false,
                    'message'   => 'Biaya Expedisi tidak valid',
                ]);
            }
    
            $bank           = BankAccount::find($request->bank_id);
            $sales_products = [];
            $sales  = Sales::create([
                'customer_id'               => $customer->id,
                'weight_total'              => $weightTotal,
                'amount_total'              => $amount_total,
                'price_total'               => (int) $price_total + (int) $costObj->cost[0]->value,
                'proof_of_payment'          => null,
                'status'                    => 'belum bayar',
                'bank_sender_account_name'  => null,
                'start_payment_date'        => Carbon::now()->toDateTimeString(),
                'limit_payment_date'        => Carbon::now()->addDays(1)->toDateTimeString(),
                'bank_sender_account_name'  => null,
            ]);

            foreach ($carts as $cart) {
                $product_discount_percent       = $cart->product->discount ? $cart->product->discount->discount_percent : 0;
                $product_price                  = $cart->product->price;
                $product_price_after_discount   = $product_price - ( $product_price * $product_discount_percent / 100 );
                
                SalesProduct::create([
                    'sales_id'                      => $sales->id,
                    'product_name'                  => $cart->product->product_name,
                    'product_image_url'             => url('/storage/images/products/' . [json_decode($cart->product->product_images)][0][0]->name),
                    'product_url'                   => url('/product/' . $cart->product->product_slug),
                    'product_amount'                => $cart->amount,
                    'product_discount_percent'      => $product_discount_percent,
                    'product_price'                 => $product_price,
                    'product_price_after_discount'  => $product_price_after_discount,
                    'product_weight'                => $cart->product->weight,
                    'product_variant'               => $cart->variant,
                ]);
                $cart->product->update([
                    'amount'    => $cart->product->amount - $cart->amount,
                ]);

                $cart->delete();
            }

            $sales_address = SalesAddress::create([
                'sales_id'                      => $sales->id,
                'address_name'                  => $customerAddress->address_name,
                'customer_name'                 => $customerAddress->customer_name,
                'number_phone'                  => $customerAddress->number_phone,
                'province'                      => $customerAddress->province->province,
                'city'                          => $customerAddress->city->city_name,
                'postal_code'                   => $customerAddress->postal_code,
                'full_address'                  => $customerAddress->full_address,
            ]);

            $sales_bank_account = SalesBankAccount::create([
                'sales_id'                      => $sales->id,
                'bank_name'                     => $bank->bank_name,
                'bank_logo'                     => $bank->bank_logo,
                'bank_account_name'             => $bank->bank_account_name,
                'bank_account_number'           => $bank->bank_account_number, 
            ]);

            $sales_expedition = SalesExpedition::create([
                'sales_id'                      => $sales->id,
                'type_expedition'               => $costObj->service,
                'price_expedition'              => $costObj->cost[0]->value,
                'estimation_expedition'         => $costObj->cost[0]->etd,
                'desc_expedition'               => $costObj->description,
            ]);
    
            return response()->json([
                'code'      => 200,
                'success'   => (boolean) true,
                'message'   => 'success, checkout product is successfully',
                'data'      => [
                    'sales' => $sales
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => 'Error, terdapat sedikit kesalahan',
            ]);
        }
    }

    public function paymentTransferPage($sales_id)
    {
        $data = [
            'title'     => 'Halaman Pembayaran',
            'nav'       => 'payment-page',
            'sale'      => Sales::find($sales_id),
        ];

        return view('web.pages.cart.payment-page', $data);
    }

    public function updateProofPaymentTransfer(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'proof_of_payment'          => 'required|mimes:jpg,jpeg,png',
                'bank_sender_account_name'  => 'required|string|max:100',
            ], [
                'proof_of_payment.required'             => 'foto bukti pembayaran tidak boleh kosong',
                'proof_of_payment.mimes'                => 'ekstensi tidak valid, harus diantara jpg, jpeg dan png',
                'bank_sender_account_name.required'     => 'nama pengirim tidak boleh kosong',
                'bank_sender_account_name.string'       => 'nama pengirim harus berupa teks',
                'bank_sender_account_name.max'          => 'nama pengirim maksimal 100 karakter'
            ]); 
        
            if( $validator->fails() ) {
                Session::flash('form-failed', 'Validasi gagal'); 
                return back()->withErrors($validator)
                            ->withInput();
            }
    
            $sale = Sales::find($id);
            
            if( $sale->customer_id != Auth::guard('customer')->user()->id ) {
                Session::flash('form-failed', 'id pembelian tidak valid'); 
                return back()->withInput();
            }

            if($sale->limit_payment_date < Carbon::now()) {
                Session::flash('form-failed', 'batas waktu pembayaran telah berakhir'); 
                return back()->withInput();
            }

            $image_proof_payment_name = $this->uploadFile(Str::random(40), $request->file('proof_of_payment'), 'images/proof-of-payments');
    
            $sale->update([
                'proof_of_payment'              => $image_proof_payment_name,
                'bank_sender_account_name'      => $request->bank_sender_account_name,
            ]);
    
            return redirect('/purchases')->with('success', 'bukti pembayaran telah dikirimkan');
        } catch (\Throwable $th) {
            return abort(404);
        }
    }
}
