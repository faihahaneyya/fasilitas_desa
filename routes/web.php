<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FasilitasUmumController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PeminjamanFasilitasController;
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

Route::resource('peminjaman', PeminjamanFasilitasController::class);
Route::get('/peminjaman/search', [PeminjamanFasilitasController::class, 'search'])->name('peminjaman.search');
Route::post('/peminjaman/{peminjaman}/status', [PeminjamanFasilitasController::class, 'updateStatus'])->name('peminjaman.status');
Route::get('/peminjaman/calendar/{fasilitas_id?}', [PeminjamanFasilitasController::class, 'calendar'])->name('peminjaman.calendar');
