<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\BlogController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', [HomeController::class, 'home'])->name('home');

// Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register-konsumen', [RegisterController::class, 'register_konsumen'])->name('register-konsumen');
Route::post('/register-umkm', [RegisterController::class, 'register_umkm'])->name('register-umkm');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/tentang-kami', function () {
    return view('about');
});
Route::get('/lupa-password', [LupaPasswordController::class, 'lupaPassword'])->name('lupa-password');
Route::get('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset-password');


Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.detail');
Route::get('/search', [BlogController::class, 'search'])->name('blog.search');