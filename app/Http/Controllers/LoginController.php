<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        else  {
            return view('auth.login');
        }
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            return redirect('/')->with('success', 'Login Berhasil!');
        } else {
            session()->flash('failed', 'Email atau password salah!');
            return redirect()->route('login');
        }
    }

    public function logout(Request $request) 
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/')->with('success', 'Logout Berhasil!');
        } else {
            return redirect('/');
        }
    }

}
