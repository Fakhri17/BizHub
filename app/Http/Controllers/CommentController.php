<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\UmkmProduct;

class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:umkm_products,id',
            'comment_text' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'umkm_product_id' => $request->product_id,
            'comment_text' => $request->comment_text,
            'parent_id' => $request->parent_id,
        ]);

        $umkmProduct = UmkmProduct::find($request->product_id);
        $umkmProduct->increment('comment_count');

        


        return redirect()->back();
    }

    public function like($id)
    {
        $comment = Comment::find($id);
        $comment->increment('likes_count');

        return redirect()->back();
    }
}
