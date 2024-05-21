<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function register_proses(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users|min:5|max:255',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|min:11|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|email:dns|max:255|unique:users',
            'password' => 'required|string|min:5|max:255',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('login');
    }
}
