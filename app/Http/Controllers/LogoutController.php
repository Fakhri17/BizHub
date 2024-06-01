<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/')->with('success', 'Anda berhasil logout');
        } else {
            return redirect('/');
        }
    }
}
