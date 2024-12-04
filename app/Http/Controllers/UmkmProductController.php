<?php

namespace App\Http\Controllers;

use App\Models\UmkmProduct;
use Illuminate\Http\Request;
use App\Models\UserFavoriteProduct;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\ProductCategory;


class UmkmProductController extends Controller
{
    //
    public function index(Request $request)
    {
        // Retrieve all UMKM products
        $search = $request->input('search_product') ?? '';
        $productCategorySlug = $request->input('product_category') ?? '';
        $userFavorites = UserFavoriteProduct::where('user_id', Auth::id())
            ->where('is_favorite', true)
            ->pluck('umkm_product_id')
            ->toArray();


        $products = UmkmProduct::where('is_published', true)
            ->orderBy('created_at', 'desc');

        if ($search) {
            $products->where('product_name', 'like', "%$search%");
        }

        if ($productCategorySlug) {
            $products->whereHas('productCategory', function ($query) use ($productCategorySlug) {
                $query->where('slug', $productCategorySlug);
            });
        }

        $products = $products->paginate(6);

        $productCategories = ProductCategory::all();

        // Pass the products data to the view
        return view('umkm.index', compact('products', 'search', 'productCategorySlug', 'userFavorites', 'productCategories'));
    }

    public function detail($slug)
    {

        $product = UmkmProduct::where('slug', $slug)->firstOrFail();

        $userFavorites = UserFavoriteProduct::where('user_id', Auth::id())
            ->where('is_favorite', true)
            ->pluck('umkm_product_id')
            ->toArray();

        $commentsQuery = Comment::where('umkm_product_id', $product->id)
            ->orderBy('created_at', 'desc');

        // Paginate the query results
        $comments = $commentsQuery->paginate(5);



        return view('umkm.detail', compact('product', 'userFavorites', 'comments'));
        // // Retrieve the product by slug with related owner and user
        // $product = UmkmProduct::with(['umkmOwner.user', 'productCategory'])->where('slug', $slug)->firstOrFail();

        // // Pass the product data to the view
        // return view('umkm.detail', compact('product'));
    }

    public function wishlist()
    {
        $userFavorites = UserFavoriteProduct::where('user_id', Auth::id())
            ->where('is_favorite', true)
            ->pluck('umkm_product_id')
            ->toArray();

        $wishlist = UmkmProduct::whereIn('id', $userFavorites)->paginate(6);
        return view('umkm.wishlist', compact('wishlist', 'userFavorites'));
    }

    public function addToWishlist($productId)
    {
        $wishlist = UserFavoriteProduct::firstOrCreate([
            'user_id' => Auth::id(),
            'umkm_product_id' => $productId
        ]);

        $wishlist->is_favorite = true;
        $wishlist->save();

        return redirect()->back()->with('success', 'Product added to wishlist.');
    }

    public function removeFromWishlist($productId)
    {
        $wishlist = UserFavoriteProduct::where('user_id', Auth::id())->where('umkm_product_id', $productId)->firstOrFail();
        $wishlist->is_favorite = false;
        $wishlist->save();

        return redirect()->back()->with('remove', 'Product removed from wishlist.');
    }
}
