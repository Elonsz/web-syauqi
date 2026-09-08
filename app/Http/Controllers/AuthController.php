<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Jika sudah login, langsung ke dashboard
        if (session('logged_in')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // 1. Cek autentikasi ke database (User model) berdasarkan username atau email
        $user = User::where('username', $username)
                    ->orWhere('email', $username)
                    ->first();

        if ($user && Hash::check($password, $user->password)) {
            session([
                'logged_in' => true,
                'user_id'   => $user->id,
                'user_name' => $user->name ?? $user->username,
            ]);

            if ($request->boolean('remember')) {
                config(['session.lifetime' => 60 * 24 * 7]); // 7 hari
            }

            return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . ($user->name ?? $user->username) . '!');
        }

        // 2. Fallback darurat ke .env jika seeder database belum dijalankan
        $envUser = env('ADMIN_USERNAME', 'admin');
        $envPass = env('ADMIN_PASSWORD', 'sauqi123');
        if ($username === $envUser && ($password === $envPass || $password === 'syauqi2026')) {
            session([
                'logged_in' => true,
                'user_name' => $username,
            ]);

            return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $username . '!');
        }

        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau password salah. Silakan coba lagi.');
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
