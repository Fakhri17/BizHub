<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PasswordResetController;

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

Route::get('lupa-password', [PasswordResetController::class, 'lupaPassword'])->name('lupa-password');
Route::post('lupa-password', [PasswordResetController::class, 'sendPasswordResetLink'])->name('lupa-password-proses');
Route::get('reset-password/{token}', [PasswordResetController::class, 'resetPasswordShow'])->name('reset-password');
Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('reset-password-proses');


Route::group(['middleware' => ['role:UMKM Owner|Super Admin']], function () {
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'detail'])->name('blog.detail');
});

// umkm list and detail page
Route::middleware('auth')->group(function () {
    Route::get('/umkm', function () {
        return view('umkm.index');
    })->name('umkm.index');

    Route::get('/umkm/{slug}', function () {
        return view('umkm.detail');
    })->name('umkm.detail');
});
