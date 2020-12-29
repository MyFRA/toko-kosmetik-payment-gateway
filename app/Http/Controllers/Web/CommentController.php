<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\ProductComment;
use App\Models\Product;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $allProductsId = join(',', $this->getAllId(Product::get()));

        $validator = Validator::make($request->all(), [
            'product_id' => "required|in:$allProductsId",
            'comment'    => 'required|string',
        ], [
            'product_id.required' => 'Produk tidak tidak boleh kosong',
            'product_id.in'       => 'Produk tidak ada / sudah dihapus',
            'comment.required'    => 'Komentar tidak boleh kosong',
            'comment.string'      => 'Komentar harus bersifat teks',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code'      => 401,
                'success'   => (boolean) false,
                'message'   => $validator->errors()->first(), 
            ]);
        }

        ProductComment::create([
            'product_id'  => $request->product_id,
            'comment'     => $request->comment,
            'customer_id' => Auth::guard('customer')->user()->id
        ]);

        $allComments = ProductComment::where('product_id', $request->product_id)->orderBy('updated_at', 'DESC')->get();
        $validComments = [];

        foreach ($allComments as $comment) {
            $validComments[] = [
                'customer_name' => $comment->customer->fullname,
                'photo'         => $comment->customer->photo ? $comment->customer->photo[0]->name : null,
                'comment_at'    => $comment->getCreatedAtAttributes($comment->created_at, 'diffForHumans'),
                'comment'       => $comment->comment,
            ];
        }

        return response()->json([
            'code'      => 200,
            'success'   => (boolean) true,
            'message'   => 'Komentar berhasil ditambahkan',
            'data'      => [
                'comments' => $validComments, 
            ]
        ]);
    }
}
