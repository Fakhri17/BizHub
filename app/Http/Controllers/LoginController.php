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
        return view('auth.login');
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
            session()->flash('success', 'Login Berhasil!');
            return redirect()->route('home');
            // return 'sukses';
        } else {
            session()->flash('failed', 'Email atau password salah!');
            return redirect()->route('login');
            // return 'gagal';
        }
    }


}
