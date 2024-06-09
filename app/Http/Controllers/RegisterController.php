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

        return redirect()->route('login')->with('success', 'Registration successful.');
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

        return redirect()->route('login')->with('success', 'Registrasi Berhasil.');
    }
}
