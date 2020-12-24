<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\{Product, ProductCategory};

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'title'         => 'Produk',
            'main_title'    => 'List Produk',
            'sidebar'       => 'product',
            'products'      => Product::orderBy('created_at', 'DESC')->paginate(10),
        ];

        return view('admin.pages.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'                 => 'Produk',
            'main_title'            => 'Tambah Produk',
            'sidebar'               => 'product',
            'product_categories'    => ProductCategory::orderBy('category_name', 'ASC')->get(),
            'conditions'            => ['baru', 'bekas']
        ];

        return view('admin.pages.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allProductCategoryId = join(',', $this->getAllId(ProductCategory::get()));
        $validator = Validator::make($request->all(), [
            'product_name'              => 'required|max:255',
            'product_category_id'       => "required|in:$allProductCategoryId",
            'price'                     => 'required|numeric',
            'weight'                    => 'required|numeric',
            'amount'                    => 'required|numeric',
            'condition'                 => 'required|in:baru,bekas',
            'description'               => 'required',
            'product_images'            => 'required'
        ]);

        if($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $slug = Str::slug($request->product_name);
        if(Product::where('product_slug', $slug)->count() > 0) {
            return back()
                    ->withInput()
                    ->with('failed', 'Nama produk sudah digunakan');
        }

        for( $i = 0; $i <= 3; $i++ ) {
            if(isset($request->file('product_images')[$i])) {
                $fileValidation = $this->fileValidation($request->file('product_images')[$i], ['jpeg', 'jpg', 'png']);

                if($fileValidation) {
                    return back()
                        ->withInput()
                        ->with('failed', 'Foto produk harus berekstensi jpg, jpeg, png');
                }
            }
        }

        $arr_product_images_name = [];

        for( $i = 0; $i <= 3; $i++ ) {
            if(isset($request->file('product_images')[$i])) {
                $arr_product_images_name[] = [
                    'index'     => $i,
                    'name'      => $this->uploadFile(uniqid($slug), $request->file('product_images')[$i], 'images/products'),
                ];
            }
        }

        $product = Product::create([
            'product_name'          => $request->product_name,
            'product_slug'          => $slug,
            'product_category_id'   => $request->product_category_id,
            'price'                 => $request->price,
            'weight'                => $request->weight,
            'amount'                => $request->amount,
            'condition'             => $request->condition,
            'product_images'        => json_encode($arr_product_images_name),
            'description'           => $request->description,
        ]);

        return redirect('/app-admin/product')->with('success', 'Produk ' . $request->product_name . ' telah ditambahkan');
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
            'title'                 => 'Produk',
            'main_title'            => 'Edit Produk',
            'sidebar'               => 'product',
            'product_categories'    => ProductCategory::orderBy('category_name', 'ASC')->get(),
            'conditions'            => ['baru', 'bekas'],
            'product'               => Product::find($id),
        ];

        return view('admin.pages.product.edit', $data);
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
        $allProductCategoryId = join(',', $this->getAllId(ProductCategory::get()));
        $validator = Validator::make($request->all(), [
            'product_name'              => 'required|max:255',
            'product_category_id'       => "required|in:$allProductCategoryId",
            'price'                     => 'required|numeric',
            'weight'                    => 'required|numeric',
            'amount'                    => 'required|numeric',
            'condition'                 => 'required|in:baru,bekas',
            'description'               => 'required',
        ]);

        if($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        if(!is_null($request->file('product_images'))) {
            foreach ($request->file('product_images') as $file) {
                $fileValidation = $this->fileValidation($file, ['jpeg', 'jpg', 'png']);

                if($fileValidation) {
                    return back()
                        ->withInput()
                        ->with('failed', 'Foto produk harus berekstensi jpg, jpeg, png');
                }
            }
        }

        $product = Product::find($id);
        $slug = Str::slug($request->product_name);
        $arr_product_images_name            = [];
        $arr_product_images_name_from_db    = json_decode($product->product_images);
        $arr_index_product_images_from_db   = [];

        if(!is_null($request->file('product_images'))) {
            foreach ($request->file('product_images') as $key => $product_image) {
                // Delete old file by key
                foreach ($arr_product_images_name_from_db as $keyDB => $product_image_db) {
                    if( gettype($product_image_db) == 'object' ) {
                        if($product_image_db->index == $key) {
                            Storage::delete('public/images/products/'. $product_image_db->name);

                            $arr_product_images_name_from_db[$keyDB] = [
                                'index'    => $key,
                                'name'     => $this->uploadFile(uniqid($slug), $request->file('product_images')[$key], 'images/products'),
                            ];
                        }
                    }
                }
            }

            foreach($arr_product_images_name_from_db as $product_image) {
                if( gettype($product_image) == 'object' ) {
                    $arr_index_product_images_from_db[] = $product_image->index;
                } else {
                    $arr_index_product_images_from_db[] = $product_image['index'];
                }
            }

            foreach ($request->file('product_images') as $key => $product_image) {
                if(!in_array($key, $arr_index_product_images_from_db)) {
                    $arr_product_images_name_from_db[] = [
                        'index'     => $key,
                        'name'      => $this->uploadFile(uniqid($slug), $product_image, 'images/products')
                    ];
                }
            }
        }

        $product->update([
            'product_name'          => $request->product_name,
            'product_category_id'   => $request->product_category_id,
            'price'                 => $request->price,
            'weight'                => $request->weight,
            'amount'                => $request->amount,
            'condition'             => $request->condition,
            'product_images'        => json_encode($arr_product_images_name_from_db),
            'description'           => $request->description,
        ]);

        return redirect('/app-admin/product')->with('success', 'Produk ' . $request->product_name . ' telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $arr_product_images = json_decode($product->product_images);
        foreach ($arr_product_images as $product_image) {
            if(Storage::exists('public/images/products/' . $product_image->name)) {
                Storage::delete('public/images/products/' . $product_image->name);
            }
        }
        Product::destroy($product->id);

        return back()->with('success', 'Produk ' . $product->product_name . ' telah dihapus');
    }

}
