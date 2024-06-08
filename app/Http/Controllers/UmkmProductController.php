<?php

namespace App\Http\Controllers;

use App\Models\UmkmProduct;
use Illuminate\Http\Request;

class UmkmProductController extends Controller
{
    //
    public function index(Request $request)
    {
        // Retrieve all UMKM products
        $search = $request->input('search_product') ?? '';
        $productCategorySlug = $request->input('product_category') ?? '';


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

        // Pass the products data to the view
        return view('umkm.index', compact('products', 'search', 'productCategorySlug'));
    }

    public function detail($slug)
    {

        $product = UmkmProduct::where('slug', $slug)->firstOrFail();
        return view('umkm.detail', compact('product'));
        // // Retrieve the product by slug with related owner and user
        // $product = UmkmProduct::with(['umkmOwner.user', 'productCategory'])->where('slug', $slug)->firstOrFail();

        // // Pass the product data to the view
        // return view('umkm.detail', compact('product'));
    }
}
