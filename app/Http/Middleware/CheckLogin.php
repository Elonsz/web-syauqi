<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Pastikan user sudah login sebelum mengakses halaman yang dilindungi.
     * Jika belum login, redirect ke halaman login dengan pesan peringatan.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('logged_in')) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu untuk mengakses halaman tersebut.');
        }

        return $next($request);
    }
}
