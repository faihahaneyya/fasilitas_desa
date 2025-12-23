<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FasilitasUmumController;
use App\Http\Controllers\PembayaranFasilitasController;
use App\Http\Controllers\PeminjamanFasilitasController;
use App\Http\Controllers\PetugasFasilitasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\SyaratFasilitasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('warga', WargaController::class);
Route::resource('fasilitas', FasilitasUmumController::class);

// Resource route untuk peminjaman
Route::resource('peminjaman', PeminjamanFasilitasController::class);

// Custom routes untuk peminjaman
Route::post('/peminjaman/{peminjaman}/status', [PeminjamanFasilitasController::class, 'updateStatus'])->name('peminjaman.status');
Route::get('/peminjaman/calendar/{fasilitas_id?}', [PeminjamanFasilitasController::class, 'calendar'])->name('peminjaman.calendar');
Route::get('/peminjaman/search', [PeminjamanFasilitasController::class, 'search'])->name('peminjaman.search');

// Atau route manual
Route::get('/peminjaman/{id}', [PeminjamanFasilitasController::class, 'show'])
    ->name('peminjaman.show');


Route::resource(
    'pembayaran-fasilitas',
    PembayaranFasilitasController::class
);

// Route about
Route::get('/about', [AboutController::class, 'index'])->name('about');

// routes/web.php
Route::view('/about', 'pages.about')->name('about');

Route::view('/developer', 'pages.developer-profile')->name('developer.show');

Route::resource('users', UserController::class);
Route::resource('syarat-fasilitas', SyaratFasilitasController::class)->names('syarat');
Route::resource('petugas-fasilitas', PetugasFasilitasController::class)->names('petugas');
Route::delete('/peminjaman/media/{id}', [PeminjamanFasilitasController::class, 'destroyMedia'])->name('peminjaman.media.destroy');

// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
// Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
// Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
