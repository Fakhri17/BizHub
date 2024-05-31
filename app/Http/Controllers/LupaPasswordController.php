<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LupaPasswordController extends Controller
{
    public function lupaPassword()
    {
        return view('auth.lupa-password');
    }
}
