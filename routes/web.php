<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\WajibPajakController;
use App\Http\Controllers\ObjekPajakController;
use App\Http\Controllers\NotarisController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PersyaratanController;
use App\Http\Controllers\NotaryProfileController;
use App\Http\Controllers\NotaryDocumentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\api\WajibPajakApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\PetugasPelayananController;
use App\Http\Controllers\KepalaUptController;
use App\Http\Controllers\KasubitController;
use App\Http\Controllers\KabitController;
use App\Http\Controllers\PelayananCommentController;
use App\Http\Controllers\CertificateController;


// === AUTH ===
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// === REDIRECT SETELAH LOGIN ===
Route::get('/', function () {
    if (!Auth::check()) return redirect()->route('login');

    $role = Auth::user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'user' => redirect()->route('user.dashboard'),
        'notaris' => redirect()->route('notaris.dashboard'),
        'petugas_pelayanan' => redirect()->route('pelayanan.dashboard'),
        'kepala_upt' => redirect()->route('kepalaupt.dashboard'),
        'kasubit_penataan' => redirect()->route('kasubit.dashboard'),
        'kabit_pendapatan' => redirect()->route('kabit.dashboard'),
        default => abort(403, 'Role tidak dikenali'),
    };
})->name('home');

// === ROUTE UNTUK YANG SUDAH LOGIN ===
Route::middleware(['auth'])->group(function () {

    // === ADMIN ===
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
       Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/wajib-pajak', WajibPajakController::class);
        Route::resource('/objek-pajak', ObjekPajakController::class);
        Route::resource('/transaksi', TransaksiController::class);
        Route::resource('/persyaratan', PersyaratanController::class);
        Route::resource('/menus', MenuController::class);
        Route::resource('/users', UserController::class);
    });

    // === USER ===
    Route::middleware('role:user')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', fn() => view('user.dashboard'))->name('dashboard');
    });

    // === NOTARIS ===
    Route::middleware('role:notaris')->prefix('notaris')->name('notaris.')->group(function () {
        Route::get('/dashboard', [NotarisController::class, 'dashboard'])->name('dashboard');
        Route::get('/riwayat', [NotarisController::class, 'riwayat'])->name('riwayat');
        Route::resource('pengajuan', NotarisController::class)->parameters([
            'pengajuan' => 'pengajuan'
        ]);
        Route::get('/profile', [NotaryProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile', [NotaryProfileController::class, 'store'])->name('profile.store');
        Route::post('/profile/{profile}/verify', [NotaryProfileController::class, 'verify'])->name('profile.verify');
        Route::get('/documents', [NotaryDocumentController::class, 'index'])->name('documents.index');
        Route::post('/documents', [NotaryDocumentController::class, 'store'])->name('documents.store');
    });

    // === PETUGAS PELAYANAN ===
    Route::middleware('role:petugas_pelayanan')->prefix('pelayanan')->name('pelayanan.')->group(function () {
        Route::get('/dashboard', [PetugasPelayananController::class, 'index'])->name('dashboard');
        Route::get('{pelayanan}', [PetugasPelayananController::class, 'show'])->name('show');
        Route::get('/verifikasi', [PetugasPelayananController::class, 'verifikasi'])->name('verifikasi');
        Route::post('{pelayanan}/start', [PetugasPelayananController::class, 'startVerification'])->name('start');
        Route::post('{pelayanan}/approve', [PetugasPelayananController::class, 'approve'])->name('approve');
        Route::post('{pelayanan}/reject', [PetugasPelayananController::class, 'reject'])->name('reject');
    });

    // === KEPALA UPT ===
    Route::middleware('role:kepala_upt')->prefix('kepalaupt')->name('kepalaupt.')->group(function () {
        Route::get('/dashboard', [KepalaUptController::class, 'index'])->name('dashboard');
        Route::get('{pelayanan}', [KepalaUptController::class, 'show'])->name('show');
        Route::get('/verifikasi', [KepalaUptController::class, 'verifikasi'])->name('verifikasi');
        Route::post('{pelayanan}/start', [KepalaUptController::class, 'startVerification'])->name('start');
        Route::post('{pelayanan}/approve', [KepalaUptController::class, 'approve'])->name('approve');
        Route::post('{pelayanan}/reject', [KepalaUptController::class, 'reject'])->name('reject');
    });

    // === KASUBIT PENATAAN ===
    Route::middleware('role:kasubit_penataan')->prefix('kasubit')->name('kasubit.')->group(function () {
        Route::get('/dashboard', [KasubitController::class, 'index'])->name('dashboard');
        Route::get('{pelayanan}', [KasubitController::class, 'show'])->name('show');
        Route::get('/verifikasi', [KasubitController::class, 'verifikasi'])->name('verifikasi');
        Route::post('{pelayanan}/start', [KasubitController::class, 'startVerification'])->name('start');
        Route::post('{pelayanan}/approve', [KasubitController::class, 'approve'])->name('approve');
        Route::post('{pelayanan}/reject', [KasubitController::class, 'reject'])->name('reject');
    });

    // === KABIT PENDAPATAN ===
    Route::middleware('role:kabit_pendapatan')->prefix('kabit')->name('kabit.')->group(function () {
        Route::get('/dashboard', [KabitController::class, 'index'])->name('dashboard');
        Route::get('/persetujuan', [KabitController::class, 'persetujuan'])->name('persetujuan');
        Route::get('{pelayanan}', [KabitController::class, 'show'])->name('show');
        Route::post('{pelayanan}/start', [KabitController::class, 'startVerification'])->name('start');
        Route::post('{pelayanan}/approve', [KabitController::class, 'approve'])->name('approve');
        Route::post('{pelayanan}/reject', [KabitController::class, 'reject'])->name('reject');
    });
     Route::get('/certificates/{pelayanan}/download', [CertificateController::class, 'download'])
        ->name('certificates.download')
        ->middleware('signed');
    Route::post('/pelayanan/{pelayanan}/comments', [PelayananCommentController::class, 'store'])
        ->name('pelayanan.comments.store')
        ->middleware('role:petugas_pelayanan,kepala_upt,kasubit_penataan,kabit_pendapatan');
    // === API ===
    Route::get('api/wajibpajak-detail', [WajibPajakApiController::class, 'getDetailByNik']);
    Route::get('api/nik-autocomplete', [WajibPajakApiController::class, 'autocompleteNik']);
    Route::get('api/autocomplete-nop', [WajibPajakApiController::class, 'autocompleteNop']);
    Route::post('api/get-data-nop', [WajibPajakApiController::class, 'getDataNop']);
});

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/realisasi/pbb', [DashboardController::class, 'getRealisasiPbb'])->name('realisasi.pbb');
Route::get('/realisasi/{jenis}', [DashboardController::class, 'getRealisasi']);




