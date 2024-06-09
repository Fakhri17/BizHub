<?php

namespace App\Http\Controllers;

use App\Models\UmkmProduct;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // count user only UMKM OWNER role spatie
        $umkm_owner = User::role('UMKM Owner')->count();
        $user_list = User::count();
        $umkm_product = UmkmProduct::count();
        $data = [
            'umkm_owner' => $umkm_owner,
            'user_list' => $user_list,
            'umkm_product' => $umkm_product
        ];
        return view('index', compact('data'));
    }
}
