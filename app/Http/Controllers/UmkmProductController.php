<?php

namespace App\Http\Controllers;

use App\Models\UmkmProduct;
use Illuminate\Http\Request;

class UmkmProductController extends Controller
{
    //
    public function index()
    {
        // Retrieve all UMKM products
        $products = UmkmProduct::with('umkmOwner.user')->get();

        // Pass the products data to the view
        return view('umkm.index', compact('products'));
    }

    public function detail($slug)
    {
        // Retrieve the product by slug with related owner and user
        $product = UmkmProduct::with(['umkmOwner.user', 'productCategory'])->where('slug', $slug)->firstOrFail();

        // Pass the product data to the view
        return view('umkm.detail', compact('product'));
    }
}
