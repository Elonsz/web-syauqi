<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Yayasan Cahaya Amanah Ar-Raudhah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <script>
        window.tailwind = window.tailwind || {};
        window.tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        blue: { 50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa', 500: '#2563eb', 600: '#1d4ed8', 700: '#1e40af', 800: '#1e3a8a', 900: '#16285a', 950: '#081026' },
                        red: { 50: '#fef2f2', 100: '#fee2e2', 200: '#fecaca', 300: '#fca5a5', 400: '#f87171', 500: '#ef4444', 600: '#dc2626', 700: '#b91c1c', 800: '#991b1b', 900: '#7f1d1d', 950: '#450a0a' },
                        rose: { 50: '#fff1f2', 100: '#ffe4e6', 200: '#fecdd3', 300: '#fda4af', 400: '#fb7185', 500: '#f43f5e', 600: '#e11d48', 700: '#be123c', 800: '#9f1239', 900: '#881337', 950: '#4c0519' }
                    }
                }
            }
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .bg-animated {
            background: linear-gradient(135deg, #070d1e 0%, #0c1836 25%, #152c64 50%, #0d1b3e 75%, #070d1e 100%);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
        }
        @keyframes gradientShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.22;
            animation: floatOrb 10s ease-in-out infinite;
        }
        .orb-1 { width: 400px; height: 400px; background: #dc2626; top: -10%; left: -10%; animation-delay: 0s; }
        .orb-2 { width: 300px; height: 300px; background: #f59e0b; top: 60%; right: -5%; animation-delay: -4s; }
        .orb-3 { width: 250px; height: 250px; background: #1e3a8a; bottom: -5%; left: 40%; animation-delay: -7s; }
        @keyframes floatOrb {
            0%, 100% { transform: translateY(0) scale(1); }
            50%       { transform: translateY(-30px) scale(1.08); }
        }

        .islamic-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.78);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.14);
        }

        .input-field {
            transition: all 0.2s;
        }
        .input-field:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.35);
            border-color: #ef4444;
            background: rgba(255,255,255,0.12) !important;
        }

        .btn-login {
            background: linear-gradient(135deg, #dc2626, #991b1b);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            color: #ffffff;
        }
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
            transition: left 0.5s;
        }
        .btn-login:hover::before { left: 100%; }
        .btn-login:hover { transform: translateY(-1px); box-shadow: 0 8px 25px rgba(220, 38, 38, 0.45); }
        .btn-login:active { transform: translateY(0); }

        .card-enter {
            animation: cardEnter 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes cardEnter {
            from { opacity: 0; transform: translateY(30px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .arabic-text {
            font-family: 'Amiri', serif;
            background: linear-gradient(90deg, #fde68a, #fbbf24, #fde68a);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s linear infinite;
        }
        @keyframes shimmer {
            from { background-position: 0% center; }
            to   { background-position: 200% center; }
        }

        @keyframes rise {
            from { transform: translateY(0) scale(1); opacity: 0.8; }
            to   { transform: translateY(-100vh) scale(1.5); opacity: 0; }
        }
    </style>
</head>
<body class="bg-animated min-h-screen flex items-center justify-center relative overflow-hidden py-10">

    <!-- Orbs -->
    <div class="orb orb-1 islamic-pattern"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Islamic Pattern Overlay -->
    <div class="absolute inset-0 islamic-pattern pointer-events-none"></div>

    <!-- Tombol Kembali ke Landing Page (Pojok Kiri Atas) -->
    <a href="{{ route('landing') }}" 
       class="fixed top-4 left-4 sm:top-6 sm:left-6 z-20 inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-300 bg-slate-900/70 hover:bg-slate-800 hover:text-white border border-white/15 backdrop-blur-md transition-all duration-200 shadow-lg group">
        <i class="fa-solid fa-arrow-left text-[11px] transition-transform group-hover:-translate-x-1 text-red-400 group-hover:text-white"></i>
        <span>Kembali ke Beranda</span>
    </a>

    <!-- Login Container -->
    <div class="relative z-10 w-full max-w-md px-4">
        <div class="card-enter">

            <!-- Logo & Branding -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-white text-slate-900 shadow-2xl mb-3 relative p-2 border-2 border-red-500/50">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Yayasan" class="w-full h-full object-contain">
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-white tracking-tight">AR-RAUDHAH</h1>
                <p class="text-xs sm:text-sm font-bold text-red-400">Yayasan Cahaya Amanah</p>
                <p class="text-slate-300 text-[11px] mt-0.5">Banjarbaru - Kalimantan Selatan</p>
                <p class="arabic-text text-xl sm:text-2xl mt-2 font-bold">بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
                <p class="text-blue-200 text-xs mt-1">Sistem Penilaian Munaqasyah TPQ &amp; RTQ Ar-Raudhah</p>
            </div>

            <!-- Glass Card -->
            <div class="glass-card rounded-3xl p-8 shadow-2xl">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-white">Selamat Datang 👋</h2>
                    <p class="text-slate-300 text-sm mt-0.5">Silakan masuk untuk melanjutkan</p>
                </div>

                @if(session('success'))
                <div class="mb-4 bg-emerald-500/20 border border-emerald-400/40 rounded-xl p-3.5 flex items-start gap-2.5">
                    <i class="fa-solid fa-circle-check text-emerald-400 mt-0.5 shrink-0"></i>
                    <p class="text-emerald-200 text-xs leading-relaxed">{{ session('success') }}</p>
                </div>
                @endif

                @if(session('is_locked'))
                <div class="mb-5 bg-gradient-to-r from-red-950/80 to-rose-950/80 border-2 border-red-500/60 rounded-2xl p-4 shadow-xl text-center space-y-2">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-red-600/30 border border-red-500/50 text-red-400 animate-pulse">
                        <i class="fa-solid fa-lock text-xl"></i>
                    </div>
                    <h3 class="text-sm font-bold text-red-300">AKSES LOGIN DIKUNCI SEMENTARA</h3>
                    <p class="text-slate-300 text-xs">
                        Terlalu banyak percobaan login gagal dari perangkat ini demi perlindungan keamanan sistem.
                    </p>
                    <div class="py-2">
                        <div class="inline-block px-4 py-2 rounded-xl bg-red-950/90 border border-red-500/40 font-mono text-lg font-black text-red-400 tracking-wider shadow-inner" id="countdownBox">
                            ⏳ <span id="countdownTimer">--:--</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-slate-400">Silakan tunggu hingga waktu selesai atau hubungi administrator.</p>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-4 bg-red-500/20 border border-red-400/40 rounded-xl p-3 flex items-start gap-2">
                    <i class="fa-solid fa-circle-exclamation text-red-400 mt-0.5 shrink-0"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <p class="text-red-200 text-xs">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-5" id="loginForm">
                    @csrf

                    <!-- Username -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-200 mb-1.5 uppercase tracking-wide">
                            <i class="fa-solid fa-user mr-1.5 text-red-400"></i>Username
                        </label>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            value="{{ old('username') }}"
                            placeholder="Masukkan username..."
                            autocomplete="username"
                            class="input-field w-full bg-white/10 border border-white/20 text-white placeholder-slate-400 rounded-xl px-4 py-3 text-sm"
                            required
                        >
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-200 mb-1.5 uppercase tracking-wide">
                            <i class="fa-solid fa-lock mr-1.5 text-red-400"></i>Password
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="••••••••"
                                autocomplete="current-password"
                                class="input-field w-full bg-white/10 border {{ session('error') && !session('is_locked') ? 'border-red-400/80 ring-1 ring-red-400/50' : 'border-white/20' }} text-white placeholder-slate-400 rounded-xl px-4 py-3 pr-11 text-sm"
                                required
                            >
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-red-400 hover:text-white transition-colors" onclick="togglePass()">
                                <i class="fa-solid fa-eye text-sm" id="eyeIcon"></i>
                            </button>
                        </div>

                        <!-- Peringatan Error & Sisa Percobaan (Di Bawah Password) -->
                        @if(session('error') && !session('is_locked'))
                        <div class="mt-2.5 bg-red-500/20 border border-red-400/40 rounded-xl p-3 flex items-start gap-2.5">
                            <i class="fa-solid fa-triangle-exclamation text-red-400 mt-0.5 shrink-0 text-sm"></i>
                            <div class="space-y-1">
                                <p class="text-red-200 text-xs font-semibold leading-relaxed">{!! session('error') !!}</p>
                                @if(session('remaining_attempts'))
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-amber-500/20 border border-amber-400/40 text-amber-300 text-[11px] font-bold">
                                    <i class="fa-solid fa-shield-halved text-[10px]"></i>
                                    <span>Sisa percobaan: {{ session('remaining_attempts') }}x lagi sebelum diblokir</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded accent-red-600">
                            <span class="text-xs text-slate-300">Ingat saya selama 7 hari</span>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" id="loginBtn"
                        class="btn-login w-full font-black text-sm py-3.5 rounded-xl shadow-lg tracking-wide flex items-center justify-center gap-2 active:scale-95">
                        <i class="fa-solid fa-right-to-bracket" id="loginIcon"></i>
                        <span id="loginText">Masuk ke Sistem</span>
                    </button>
                </form>

                <!-- Info Footer -->
                <div class="mt-6 pt-6 border-t border-white/10 text-center space-y-3">
                    <p class="text-slate-400 text-xs">
                        <i class="fa-solid fa-shield-halved mr-1 text-red-400"></i>
                        Akses terbatas untuk panitia munaqasyah yang berwenang
                    </p>
                    <div class="pt-1">
                        <a href="{{ route('landing') }}" class="inline-flex items-center justify-center gap-2 text-xs font-semibold text-slate-300 hover:text-white transition group py-1.5 px-3 rounded-xl hover:bg-white/5 border border-transparent hover:border-white/10">
                            <i class="fa-solid fa-house text-[11px] text-red-400 group-hover:scale-110 transition-transform"></i>
                            <span>Kembali ke Halaman Landing</span>
                        </a>
                    </div>
                </div>
            </div>

            <p class="text-center text-slate-400 text-xs mt-6">
                &copy; 2026 Yayasan Cahaya Amanah Ar-Raudhah • Banjarbaru
            </p>
        </div>
    </div>

    <script>
        function togglePass() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            pwd.type = pwd.type === 'password' ? 'text' : 'password';
            icon.className = pwd.type === 'text' ? 'fa-solid fa-eye-slash text-sm' : 'fa-solid fa-eye text-sm';
        }

        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            const text = document.getElementById('loginText');
            const icon = document.getElementById('loginIcon');
            text.textContent = 'Memverifikasi...';
            icon.className = 'fa-solid fa-spinner fa-spin';
            btn.disabled = true;
            btn.style.opacity = '0.8';
        });

        // Floating particles
        function createParticle() {
            const p = document.createElement('div');
            const size = Math.random() * 4 + 2;
            p.style.cssText = `position:fixed;width:${size}px;height:${size}px;background:rgba(239,68,68,${Math.random()*0.35+0.1});border-radius:50%;left:${Math.random()*100}vw;top:100vh;pointer-events:none;z-index:1;animation:rise ${Math.random()*6+6}s linear forwards;`;
            document.body.appendChild(p);
            setTimeout(() => p.remove(), 12000);
        }
        setInterval(createParticle, 700);

        @if(session('is_locked'))
        (function() {
            let secondsLeft = {{ (int) session('lockout_seconds', 900) }};
            const display = document.getElementById('countdownTimer');
            const form = document.getElementById('loginForm');
            const btn = document.getElementById('loginBtn');
            const uInput = document.getElementById('username');
            const pInput = document.getElementById('password');

            if (btn) {
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed');
                document.getElementById('loginText').textContent = 'Terkunci Sementara';
            }
            if (uInput) uInput.disabled = true;
            if (pInput) pInput.disabled = true;

            function updateTimer() {
                if (secondsLeft <= 0) {
                    if (display) display.textContent = 'Waktu Habis! Silakan Refresh';
                    if (btn) {
                        btn.disabled = false;
                        btn.classList.remove('opacity-50', 'cursor-not-allowed');
                        document.getElementById('loginText').textContent = 'Coba Masuk Lagi';
                    }
                    if (uInput) uInput.disabled = false;
                    if (pInput) pInput.disabled = false;
                    return;
                }
                const mins = Math.floor(secondsLeft / 60);
                const secs = secondsLeft % 60;
                if (display) {
                    display.textContent = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                }
                secondsLeft--;
                setTimeout(updateTimer, 1000);
            }
            updateTimer();
        })();
        @endif
    </script>
</body>
</html>
