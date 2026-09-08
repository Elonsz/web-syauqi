<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SIMUNAQASYAH Kota 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .bg-animated {
            background: linear-gradient(135deg, #064e3b 0%, #065f46 25%, #047857 50%, #0f766e 75%, #0d9488 100%);
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
            opacity: 0.15;
            animation: floatOrb 10s ease-in-out infinite;
        }
        .orb-1 { width: 400px; height: 400px; background: #34d399; top: -10%; left: -10%; animation-delay: 0s; }
        .orb-2 { width: 300px; height: 300px; background: #fbbf24; top: 60%; right: -5%; animation-delay: -4s; }
        .orb-3 { width: 250px; height: 250px; background: #6ee7b7; bottom: -5%; left: 40%; animation-delay: -7s; }
        @keyframes floatOrb {
            0%, 100% { transform: translateY(0) scale(1); }
            50%       { transform: translateY(-30px) scale(1.08); }
        }

        .islamic-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .input-field {
            transition: all 0.2s;
        }
        .input-field:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 211, 153, 0.35);
            border-color: #34d399;
            background: rgba(255,255,255,0.15) !important;
        }

        .btn-login {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .btn-login:hover::before { left: 100%; }
        .btn-login:hover { transform: translateY(-1px); box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4); }
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
            from { transform: translateY(0) rotate(0deg); opacity: 1; }
            to   { transform: translateY(-110vh) rotate(360deg); opacity: 0; }
        }
    </style>
</head>
<body class="bg-animated min-h-screen flex items-center justify-center relative overflow-hidden">

    <!-- Decorative Orbs -->
    <div class="orb orb-1 islamic-pattern"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Islamic Pattern Overlay -->
    <div class="absolute inset-0 islamic-pattern pointer-events-none"></div>

    <!-- Login Container -->
    <div class="relative z-10 w-full max-w-md px-4">
        <div class="card-enter">

            <!-- Logo & Branding -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-amber-400 text-emerald-950 text-3xl shadow-2xl mb-4 relative">
                    <i class="fa-solid fa-quran"></i>
                    <div class="absolute -top-1 -right-1 w-5 h-5 bg-emerald-400 rounded-full border-2 border-emerald-950 flex items-center justify-center">
                        <div class="w-1.5 h-1.5 bg-white rounded-full animate-ping"></div>
                    </div>
                </div>
                <h1 class="text-3xl font-black text-white tracking-tight">SIMUNAQASYAH</h1>
                <div class="flex items-center justify-center gap-2 mt-1">
                    <div class="h-px w-8 bg-emerald-400/50"></div>
                    <span class="text-xs font-bold text-amber-300 uppercase tracking-widest">Kota 2026</span>
                    <div class="h-px w-8 bg-emerald-400/50"></div>
                </div>
                <p class="arabic-text text-2xl mt-3 font-bold">بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
                <p class="text-emerald-300 text-xs mt-1">Sistem Penilaian & Kelulusan Munaqasyah Santri</p>
            </div>

            <!-- Glass Card -->
            <div class="glass-card rounded-3xl p-8 shadow-2xl">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-white">Selamat Datang 👋</h2>
                    <p class="text-emerald-300 text-sm mt-0.5">Silakan masuk untuk melanjutkan</p>
                </div>

                @if($errors->any())
                <div class="mb-4 bg-red-500/20 border border-red-400/30 rounded-xl p-3 flex items-start gap-2">
                    <i class="fa-solid fa-circle-exclamation text-red-300 mt-0.5 shrink-0"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <p class="text-red-200 text-xs">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 bg-red-500/20 border border-red-400/30 rounded-xl p-3 flex items-start gap-2">
                    <i class="fa-solid fa-circle-exclamation text-red-300 mt-0.5 shrink-0"></i>
                    <p class="text-red-200 text-xs">{{ session('error') }}</p>
                </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-5" id="loginForm">
                    @csrf

                    <!-- Username -->
                    <div>
                        <label class="block text-xs font-semibold text-emerald-200 mb-1.5 uppercase tracking-wide">
                            <i class="fa-solid fa-user mr-1.5 text-emerald-400"></i>Username
                        </label>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            value="{{ old('username') }}"
                            placeholder="Masukkan username..."
                            autocomplete="username"
                            class="input-field w-full bg-white/10 border border-white/20 text-white placeholder-emerald-400/50 rounded-xl px-4 py-3 text-sm"
                            required
                        >
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-xs font-semibold text-emerald-200 mb-1.5 uppercase tracking-wide">
                            <i class="fa-solid fa-lock mr-1.5 text-emerald-400"></i>Password
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="••••••••"
                                autocomplete="current-password"
                                class="input-field w-full bg-white/10 border border-white/20 text-white placeholder-emerald-400/50 rounded-xl px-4 py-3 pr-11 text-sm"
                                required
                            >
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-emerald-400 hover:text-white transition-colors" onclick="togglePass()">
                                <i class="fa-solid fa-eye text-sm" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded accent-amber-400">
                            <span class="text-xs text-emerald-300">Ingat saya selama 7 hari</span>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" id="loginBtn"
                        class="btn-login w-full text-emerald-950 font-black text-sm py-3.5 rounded-xl shadow-lg tracking-wide flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-to-bracket" id="loginIcon"></i>
                        <span id="loginText">Masuk ke Sistem</span>
                    </button>
                </form>

                <!-- Info Footer -->
                <div class="mt-6 pt-6 border-t border-white/10 text-center">
                    <p class="text-emerald-400/60 text-xs">
                        <i class="fa-solid fa-shield-halved mr-1"></i>
                        Akses terbatas untuk panitia munaqasyah yang berwenang
                    </p>
                </div>
            </div>

            <p class="text-center text-emerald-500/60 text-xs mt-6">
                &copy; 2026 Lembaga Penilaian Munaqasyah Santri Kota
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
            p.style.cssText = `position:fixed;width:${size}px;height:${size}px;background:rgba(52,211,153,${Math.random()*0.4+0.1});border-radius:50%;left:${Math.random()*100}vw;top:100vh;pointer-events:none;z-index:1;animation:rise ${Math.random()*6+6}s linear forwards;`;
            document.body.appendChild(p);
            setTimeout(() => p.remove(), 12000);
        }
        setInterval(createParticle, 700);
    </script>
</body>
</html>
