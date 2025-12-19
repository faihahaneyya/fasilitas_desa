<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function index()
    {
        return view('pages.auth.formlogin');
    }

    /**
     * Menampilkan form registrasi
     */
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    /**
     * Memproses registrasi (TANPA ROLE DAN IS_ACTIVE)
     */
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // === PERBAIKAN: HANYA 3 KOLOM YANG ADA ===
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            // JANGAN TAMBAH 'role' dan 'is_active'!
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke dashboard
        return redirect()->route('dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '!');
    }

    /**
     * Proses login (TANPA CEK ROLE)
     */
   public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // === HAPUS/HAPUS SEMUA YANG CEK ROLE ===
        // Karena kolom 'role' belum ada di database!

        // Redirect ke dashboard tanpa cek role
        return redirect()->route('dashboard')
            ->with('success', 'Login berhasil!');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}
    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout(); //mengeluarkan pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth')->with('success', 'Anda telah logout.');
    }
}
