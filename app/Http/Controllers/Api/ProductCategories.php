<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductCategory;

class ProductCategories extends Controller
{
    public function index()
    {
        return response()->json([
            'code'      => 200,
            'success'   => (boolean) true,
            'message'   => 'All product categories successfully retrieved',
            'data'      => [
                'product_categories' => ProductCategory::orderBy('category_name', 'ASC')->get(),
            ]
            ], 200);
    }
}
