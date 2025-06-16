<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\WajibPajakController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\api\WajibPajakApiController;

// === AUTH ===
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// === REDIRECT SETELAH LOGIN ===
Route::get('/', function () {
    if (!Auth::check()) return redirect()->route('login');

    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->role === 'user') {
        return redirect()->route('user.dashboard');
    } else {
        abort(403); // Role tidak dikenal
    }
})->name('home');

// === ROUTE UNTUK YANG SUDAH LOGIN ===
Route::middleware(['auth'])->group(function () {

    // === ADMIN ===
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

        // Resource routes admin
        Route::resource('/wajib-pajak', WajibPajakController::class);
        Route::resource('/objek-pajak', ObjekPajakController::class);
        Route::resource('/transaksi', TransaksiController::class);
        Route::resource('/persyaratan', PersyaratanController::class);
        Route::resource('/users', UserController::class); // admin/users
    });

    // === USER ===
    Route::middleware('role:user')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', fn() => view('user.dashboard'))->name('dashboard');

        // Tambahkan route khusus user di sini
    });

    // === API ===
    Route::get('api/wajibpajak-detail', [WajibPajakApiController::class, 'getDetailByNik']);
    Route::get('api/nik-autocomplete', [WajibPajakApiController::class, 'autocompleteNik']);
});
