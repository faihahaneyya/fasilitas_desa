<?php

use App\Http\Controllers\{
    AboutController,
    AuthController,
    FasilitasUmumController,
    PembayaranFasilitasController,
    PeminjamanFasilitasController,
    PetugasFasilitasController,
    UserController,
    WargaController,
    SyaratFasilitasController
};
use Illuminate\Support\Facades\Route;

// --- GUEST: Hanya bisa diakses jika BELUM login ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// --- AUTH: Harus login dulu (CheckIsLogin) ---
Route::group(['middleware' => ['auth']], function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman yang bisa diakses SEMUA role (admin & user)
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view('/about', 'pages.about')->name('about');
    Route::view('/developer', 'pages.developer-profile')->name('developer.show');

    // --- ROLE: ADMIN ONLY ---
    // Akses penuh ke manajemen data master
    Route::resource('users', UserController::class);
    Route::group(['middleware' => ['checkrole:admin']], function () {
        Route::resource('warga', WargaController::class);
        Route::resource('fasilitas', FasilitasUmumController::class);
        Route::resource('syarat-fasilitas', SyaratFasilitasController::class)->names('syarat');
        Route::resource('petugas-fasilitas', PetugasFasilitasController::class)->names('petugas');
    });

    // --- ROLE: ADMIN & USER ---
    // User bisa meminjam dan membayar, Admin bisa memantau/validasi
    Route::group(['middleware' => ['checkrole:admin,user']], function () {
        Route::resource('peminjaman', PeminjamanFasilitasController::class);
        Route::resource('pembayaran-fasilitas', PembayaranFasilitasController::class);
        Route::delete('/peminjaman/media/{id}', [PeminjamanFasilitasController::class, 'destroyMedia'])->name('peminjaman.media.destroy');
    });

});