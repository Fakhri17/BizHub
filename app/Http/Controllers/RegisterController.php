<?php

namespace App\Http\Controllers;

use App\Models\UmkmOwner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
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
        // Validate the request data
        // $request->validate([
        //     'username' => 'required|unique:users|min:5|max:255',
        //     'name' => 'required|string|max:255',
        //     'phone_number' => 'required|min:11|max:20',
        //     'address' => 'required|string|max:255',
        //     'email' => 'required|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|max:255',
        // ]);

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

        return redirect()->route('login')->with('success', 'Registration successful.');
    }


    public function register_umkm(Request $request)
    {
        // $request->validate([
        //     'username' => 'required|unique:users|min:5|max:255',
        //     'name' => 'required|string|max:255',
        //     'phone_number' => 'required|min:11|max:20',
        //     'address' => 'required|string|max:255',
        //     'email' => 'required|email:dns|max:255|unique:users',
        //     'password' => 'required|string|min:8|max:255',
        //     'npwp' => 'required|string|min:15',
        // ]);

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

        return redirect()->route('login')->with('success', 'Registrasi Berhasil.');
    }
}
