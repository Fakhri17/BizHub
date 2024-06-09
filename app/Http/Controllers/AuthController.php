<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UmkmOwner;

class AuthController extends Controller
{
    //

    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
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

    public function register()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('auth.register');
        }
    }

    public function register_konsumen(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'avatar_path' => '',
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('Customer');

        return redirect()->route('auth.login')->with('success', 'Registration successful.');
    }

    public function register_umkm(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'avatar_path' => '',
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('UMKM Owner');

        UmkmOwner::create([
            'user_id' => $user->id,
            'npwp' => $request->npwp,
        ]);

        return redirect()->route('auth.login')->with('success', 'Registrasi Berhasil.');
    }

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
