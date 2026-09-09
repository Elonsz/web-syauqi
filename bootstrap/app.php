<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // ── Middleware Aliases (bisa dipakai di routes) ──────────────────
        $middleware->alias([
            'auth.check'       => \App\Http\Middleware\CheckLogin::class,
            'admin.only'       => \App\Http\Middleware\AdminOnly::class,
            'login.throttle'   => \App\Http\Middleware\LoginRateLimiter::class,
            'chatbot.throttle' => \App\Http\Middleware\ChatbotRateLimiter::class,
        ]);

        // ── Trust Proxies — wajib untuk ngrok / reverse proxy ────────────
        // Ngrok bertindak sebagai reverse proxy; tanpa ini Laravel salah baca
        // IP, scheme (https), dan host — bisa menyebabkan request gagal.
        $middleware->trustProxies(at: '*');

        // ── Security Headers — diterapkan pada SEMUA web response ────────
        $middleware->web(append: [
            \App\Http\Middleware\SecurityHeaders::class,
        ]);

        // ── Chatbot: CSRF dikecualikan tapi diganti dengan rate limiter ──
        // (Chatbot route tetap bebas CSRF karena diakses via JavaScript fetch)
        $middleware->validateCsrfTokens(except: [
            'chatbot/ask',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

