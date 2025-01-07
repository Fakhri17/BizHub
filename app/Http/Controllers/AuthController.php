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
        $request->validate([
            'username' => [
                'required',
                'min:5',
                'regex:/^\S*$/', // Tidak boleh mengandung spasi
                'regex:/^[a-z0-9]*$/', // Hanya huruf kecil dan angka
            ],
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone_number' => [
                'required',
                'regex:/^\d+$/', // Harus angka
                'min:11',
                'max:15',
            ],
            'address' => 'required|string',
        ], [
            // Custom error messages
            'username.required' => 'Username is required.',
            'username.min' => 'Username minimal 5 karakter.',
            'username.regex' => 'Username harus huruf kecil tanpa spasi.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password minimal 6 karakter.',
            'phone_number.required' => 'Phone number is required.',
            'phone_number.regex' => 'Phone number must be numeric.',
            'phone_number.min' => 'Phone number must be at least 11 digits.',
            'phone_number.max' => 'Phone number must be at most 15 digits.',
            'address.required' => 'Address is required.',
        ]);

        try {
            $user = User::create([
                'username' => $request->username,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'avatar_path' => '',
                'address' => $request->address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('Customer');

            return redirect()->route('auth.login')->with('success', 'Registration successful.');
        } catch (\Exception $e) {
            return redirect()->route('auth.register')->with('failed', 'Registrasi Gagal. Email Sudah Terdaftar');
        }
    }


    public function register_umkm(Request $request)
    {
        $request->validate([
            'username_umkm' => [
                'required',
                'string',
                'min:5',
                'regex:/^[a-z0-9]+$/', // Huruf kecil dan angka tanpa spasi
            ],
            'name_umkm' => 'required|string|max:255',
            'email_umkm' => 'required|email|unique:users,email',
            'password_umkm' => 'required|string|min:6',
            'phone_number_umkm' => [
                'required',
                'digits_between:11,15',
                'regex:/^\d+$/' // Hanya angka
            ],
            'address_umkm' => 'required|string|max:500',
            'npwp' => [
                'required',
                'regex:/^\d{2}\.\d{3}\.\d{3}\.\d{1}-\d{3}\.\d{3}$/' // NPWP harus 15 digit angka
            ],
        ]);

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
