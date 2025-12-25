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
        // Jika sudah login, langsung ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.login');
    }

    /**
     * Menampilkan form registrasi
     */
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    /**
     * Memproses registrasi (DENGAN ROLE)
     */
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // === SEKARANG MENDUKUNG KOLOM ROLE ===
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default saat daftar adalah 'user'
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '!');
    }

    /**
     * Proses login (DENGAN REDIRECT BERDASARKAN ROLE)
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

            // Opsional: Logika redirect berbeda berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('dashboard')
                    ->with('success', 'Selamat datang Admin, ' . $user->name);
            }

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
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Anda telah logout.');
    }
}