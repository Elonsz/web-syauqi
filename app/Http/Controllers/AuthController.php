<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

/**
 * AuthController — Diperkuat dengan session regeneration,
 * penghapusan backdoor hardcoded, dan audit logging login.
 *
 * @author Hugo Putra Pratama — Yayasan Cahaya Amanah Ar-Raudhah
 */
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
            'username' => 'required|string|max:100',
            'password' => 'required|string|max:200',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $ip       = $request->ip();

        // ─── Autentikasi dari Database ──────────────────────────────────
        $user = User::where('username', $username)
                    ->orWhere('email', $username)
                    ->first();

        if ($user && Hash::check($password, $user->password)) {

            // ✅ KEAMANAN: Regenerate session ID setelah login berhasil
            // Mencegah session fixation attack
            Session::regenerate();

            session([
                'logged_in'   => true,
                'user_id'     => $user->id,
                'user_name'   => $user->name ?? $user->username,
                'user_role'   => $user->role,
                'login_ip'    => $ip,
                'login_at'    => now()->toDateTimeString(),
            ]);

            // Perpanjang lifetime session jika user centang "ingat saya"
            if ($request->boolean('remember')) {
                config(['session.lifetime' => 60 * 24 * 7]); // 7 hari
            }

            // 📋 Audit log — login berhasil
            Log::info("LOGIN BERHASIL: user={$user->username} role={$user->role} ip={$ip}");

            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang, ' . ($user->name ?? $user->username) . '!');
        }

        // ─── Login Gagal ─────────────────────────────────────────────────
        // 📋 Audit log — percobaan login gagal
        Log::warning("LOGIN GAGAL: username={$username} ip={$ip}");

        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau password salah. Silakan coba lagi.');
    }

    public function logout(Request $request)
    {
        $userName = session('user_name', 'unknown');
        $ip       = $request->ip();

        // 📋 Audit log — logout
        Log::info("LOGOUT: user={$userName} ip={$ip}");

        // ✅ KEAMANAN: Flush seluruh session dan regenerate ID baru
        Session::flush();
        Session::regenerate();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
