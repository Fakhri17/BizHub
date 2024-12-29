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
            'email' => 'required|email',
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
            back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
                'password' => 'The provided credentials do not match our records.',
            ]);
            return redirect()->route('auth.login');
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

        // $request->validate([
        //     'username' => 'required|string|max:255',
        //     'name' => 'required|string|max:255',
        //     'phone_number' => 'required|string|max:20',
        //     'address' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        try {
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
        } catch (\Exception $e) {
            return redirect()->route('auth.register')->with('failed', 'Registrasi Gagal. Email Sudah Terdaftar');
        }
    }

    public function register_umkm(Request $request)
    {
        // validate

        // $request->validate([
        //     'username_umkm' => 'required|string|max:255',
        //     'name_umkm' => 'required|string|max:255',
        //     'phone_number_umkm' => 'required|string|max:20',
        //     'address_umkm' => 'required|string|max:255',
        //     'email_umkm' => 'required|string|email|max:255|unique:users,email',
        //     'password' => 'required|string|min:8|confirmed',
        //     'npwp' => 'required|string|max:25',
        // ]);

        try {
            $user = User::create([
                'username' => $request->username_umkm,
                'name' => $request->name_umkm,
                'phone_number' => $request->phone_number_umkm,
                'avatar_path' => '',
                'address' => $request->address_umkm,
                'email' => $request->email_umkm,
                'password' => Hash::make($request->password_umkm)
            ]);

            $user->assignRole('UMKM Owner');

            UmkmOwner::create([
                'user_id' => $user->id,
                'npwp' => $request->npwp,
            ]);

            return redirect()->route('auth.login')->with('success', 'Registrasi Berhasil.');
        } catch (\Exception $e) {
            return redirect()->route('auth.register')->with('failed', 'Registrasi Gagal. Email Sudah Terdaftar');
        }
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
