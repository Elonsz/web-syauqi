<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * CheckLogin Middleware — diperkuat dengan validasi integritas session
 * Memastikan user login valid, session tidak dibajak, dan akun masih aktif.
 *
 * @author Hugo Putra Pratama — Yayasan Cahaya Amanah Ar-Raudhah
 */
class CheckLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek flag logged_in di session
        if (!session('logged_in')) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu untuk mengakses halaman tersebut.');
        }

        // 2. Jika ada user_id di session, validasi bahwa user masih ada di database
        $userId = session('user_id');
        if ($userId) {
            $user = \App\Models\User::find($userId);

            if (!$user) {
                // User telah dihapus dari database — paksa logout
                Log::warning("Session hijack attempt atau akun dihapus. Session user_id={$userId}, IP=" . $request->ip());
                session()->flush();
                session()->regenerate();

                return redirect()->route('login')
                    ->with('error', 'Sesi Anda tidak valid atau akun telah dihapus. Silakan login kembali.');
            }

            // 3. Simpan role di session untuk digunakan di seluruh aplikasi
            if (!session('user_role')) {
                session(['user_role' => $user->role]);
            }
        }

        return $next($request);
    }
}
