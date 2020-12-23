<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\{ Discount, Product };

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title'         => 'Diskon',
            'main_title'    => 'List Diskon',
            'sidebar'       => 'discount',
            'discounts'     => Discount::orderBy('end_date', 'ASC')->paginate(10)
        ];

        return view('admin.pages.discount.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products               = Product::orderBy('product_name', 'ASC')->get();
        $all_product_id_promo   = $this->getAllOneColumn(Discount::get(), 'product_id');
        $valid_products         = [];

        foreach ($products as $product) {
            if(!in_array($product->id, $all_product_id_promo)) {
                $valid_products[] = $product;
            }
        }

        $data = [
            'title'         => 'Diskon',
            'main_title'    => 'Tambah Diskon',
            'sidebar'       => 'discount',
            'products'      => $valid_products,
            'forevers'      => [
                [
                    'status'    => 0,
                    'text'      => 'Tidak',
                ],
                [
                    'status'    => 1,
                    'text'      => 'Iya',  
                ]
            ],
        ];

        return view('admin.pages.discount.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allProductId = join(',', $this->getAllId(Product::get()));
        $validator = Validator::make($request->all(), [
            'product_id'        => "required|in:$allProductId",
            'forever'           => 'required|in:0,1',
            'discount_percent'  => 'required|numeric|max:100|min:0',
        ]);

        if($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        if( $request->forever == 0 ) {
            $validator_again = Validator::make($request->all(), [
                'end_date'    => 'required|date',
            ]);

            if($validator_again->fails()) {
                return back()
                        ->withErrors($validator_again)
                        ->withInput();
            }
        }

        Discount::create([
            'product_id'        => $request->product_id,
            'forever'           => $request->forever,
            'discount_percent'  => $request->discount_percent,
            'end_date'          => $request->forever == 0 ? date('d-m-y', strtotime($request->end_date)) : null,
        ]);

        return redirect('/app-admin/discount')->with('success', 'Diskon Produk ' . Product::find($request->product_id)->product_name . ' telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title'         => 'Promo',
            'main_title'    => 'Edit Promo',
            'sidebar'       => 'promo',
            'discount'      => Discount::find($id),
            'forevers'      => [
                [
                    'status'    => 0,
                    'text'      => 'Tidak',
                ],
                [
                    'status'    => 1,
                    'text'      => 'Iya',  
                ]
            ],
        ];

        return view('admin.pages.discount.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $allProductId = join(',', $this->getAllId(Product::get()));
        $validator = Validator::make($request->all(), [
            'forever'           => 'required|in:0,1',
            'discount_percent'  => 'required|numeric|max:100|min:0',
        ]);

        if($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        if( $request->forever == 0 ) {
            $validator_again = Validator::make($request->all(), [
                'end_date'    => 'required|date',
            ]);

            if($validator_again->fails()) {
                return back()
                        ->withErrors($validator_again)
                        ->withInput();
            }
        }

        $discount = Discount::find($id);
        $discount->update([
            'forever'           => $request->forever,
            'discount_percent'  => $request->discount_percent,
            'end_date'          => $request->forever == 0 ? date('d-m-y', strtotime($request->end_date)) : null,
        ]);

        return redirect('/app-admin/discount')->with('success', 'Diskon Produk ' . $discount->product->product_name . ' telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Discount::find($id)->product;
        Discount::destroy($id);
        return back()->with('success', 'Diskon Produk ' . $product->product_name . ' telah dihapus');
    }
}
