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
    public function prosesLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = \DB::table('users')
            ->where('email', $request->email)
            ->where('password', $request->password) // kalau pakai hash, ganti pakai Hash::check
            ->first();

        if ($user) {
            session(['user' => $user]);

            if ($user->role === 'admin') {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('user.home');
            }
        } else {
            return redirect()->back()->withErrors(['Login gagal! Email atau password salah.']);
        }
    }
    // Proses login
    // Proses login
public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Cek apakah email ada di database
    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return redirect()->route('register')->with('error', 'Email belum terdaftar. Silakan registrasi terlebih dahulu.');
    }

    // Cek apakah password cocok
    if (!Auth::attempt($credentials)) {
        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    // Jika login berhasil, arahkan ke halaman menu
    $request->session()->regenerate();
    return redirect()->route('home')->with('success', 'Login berhasil!');
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
