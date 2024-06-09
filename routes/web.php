<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\LoginController;
// use App\Http\Controllers\LogoutController;
// use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UmkmProductController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Artisan;

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
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register-konsumen', [AuthController::class, 'register_konsumen'])->name('auth.register-konsumen');
Route::post('/register-umkm', [AuthController::class, 'register_umkm'])->name('auth.register-umkm');
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login-proses', [AuthController::class, 'login_proses'])->name('auth.login-proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
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

Route::get('/umkm', [UmkmProductController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{slug}', [UmkmProductController::class, 'detail'])->name('umkm.detail');
Route::middleware('auth')->group(function () {
    
    Route::get('/umkm/product/wishlist', [UmkmProductController::class, 'wishlist'])->name('umkm.wishlist');
    Route::post('/umkm/add/{productId}', [UmkmProductController::class, 'addToWishlist'])->name('umkm.add');
    Route::post('/umkm/remove/{productId}', [UmkmProductController::class, 'removeFromWishlist'])->name('umkm.remove');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{id}/like', [CommentController::class, 'like'])->name('comments.like');
});

Route::get('/generate-storage-link', function(){
    Artisan::call('storage:link');
    echo 'Storage link generated successfully';
 });

