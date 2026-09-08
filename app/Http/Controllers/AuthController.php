<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Kredensial login (hardcoded, ganti sesuai kebutuhan)
    private const USERNAME = 'admin';
    private const PASSWORD = 'syauqi2026';

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

        if ($username === self::USERNAME && $password === self::PASSWORD) {
            session([
                'logged_in' => true,
                'user_name' => $username,
            ]);

            if ($request->boolean('remember')) {
                // Perpanjang session 7 hari
                config(['session.lifetime' => 60 * 24 * 7]);
            }

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
