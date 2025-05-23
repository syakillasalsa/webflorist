<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('halaman.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // default role
        ]);

        // Auto-login setelah registrasi
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('halaman.login');
    }

    // Proses login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek apakah user ada
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('register')->with('error', 'Email belum terdaftar. Silakan registrasi terlebih dahulu.');
        }

        // Cek password valid
        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Email atau password salah!']);
        }

        // Jika login berhasil
        $request->session()->regenerate();

        // Arahkan sesuai role
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}