<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\ProductCategory;
use App\Models\Product;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title'                 => 'Kategori Produk',
            'main_title'            => 'List Kategori Produk',
            'sidebar'               => 'product-category',
            'product_categories'    => ProductCategory::orderBy('category_name', 'ASC')->paginate(10),
        ];

        return view('admin.pages.product-category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'                 => 'Kategori Produk',
            'main_title'            => 'Tambah Kategori Produk',
            'sidebar'               => 'product-category',
        ];

        return view('admin.pages.product-category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name'   => 'required',
            'image_category'  => 'required'
        ]);

        if($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $fileValidation = $this->fileValidation($request->file('image_category'), ['jpeg', 'jpg', 'png', 'webp']);

        $slug = Str::slug($request->category_name);
        if(ProductCategory::where('slug', $slug)->count() > 0) {
            return back()
                    ->withInput()
                    ->with('failed', 'Nama Kategori sudah digunakan');
        }

        if($fileValidation) {
            return back()
                ->withInput()
                ->with('failed', 'Gambar Kategori harus berekstensi jpg, jpeg, png');
        }

        $image_category_name = $this->uploadFile(uniqid($slug), $request->file('image_category'), 'images/product-categories');

        $ProductCategory = ProductCategory::create([
            'category_name'  => $request->category_name,
            'slug'           => $slug,
            'image_category' => $image_category_name,
        ]);

        return redirect('/app-admin/product-category')->with('success', 'Kategori Produk ' . $ProductCategory->category_name . ' telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'title'                 => 'Kategori Produk',
            'main_title'            => 'Detail Kategori Produk',
            'sidebar'               => 'product-category',
            'product_category'      => ProductCategory::find($id),
        ];

        return view('admin.pages.product-category.show', $data);
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
            'title'                 => 'Kategori Produk',
            'main_title'            => 'Edit Kategori Produk',
            'sidebar'               => 'product-category',
            'product_category'      => ProductCategory::find($id),
        ];

        return view('admin.pages.product-category.edit', $data);
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
        $validator = Validator::make($request->all(), [
            'category_name'   => 'required',
        ]);

        if($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $ProductCategory = ProductCategory::find($id);
        $image_category_name = $ProductCategory->image_category;

        if( !is_null($request->file('image_category')) ) {
            $fileValidation = $this->fileValidation($request->file('image_category'), ['jpeg', 'jpg', 'png', 'webp']);
            
            if($fileValidation) {
                return back()
                    ->withInput()
                    ->with('failed', 'Gambar Kategori harus berekstensi jpg, jpeg, png');
            }

            Storage::delete('public/images/product-categories/' . $image_category_name);
            $image_category_name = $this->uploadFile(uniqid($ProductCategory->slug), $request->file('image_category'), 'images/product-categories');
        }


        $ProductCategory->update([
            'category_name'  => $request->category_name,
            'image_category' => $image_category_name,
        ]);

        return redirect('/app-admin/product-category')->with('success', 'Kategori Produk ' . $request->category_name . ' telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Product::where('product_category_id', $id)->count() > 0) {
            return back()
                        ->with('failed', 'Kategori Produk tidak dapat dihapus karena masih terikat dengan produk');
        }
        
        $ProductCategory = ProductCategory::find($id);

        Storage::delete('public/images/product-categories/' . $ProductCategory->image_category);
        ProductCategory::destroy($ProductCategory->id);

        return back()->with('success', 'Kategori Produk ' . $ProductCategory->category_name . ' telah dihapus');
    }
}
