<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Yayasan Cahaya Amanah Ar-Raudhah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <script>
        window.tailwind = window.tailwind || {};
        window.tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: { 50:'#f0f4ff', 100:'#dce6ff', 200:'#b9ccff', 300:'#87a8ff', 400:'#5481f7', 500:'#2d5be3', 600:'#1e3fa8', 700:'#17317f', 800:'#132460', 900:'#0d1a45', 950:'#080f2a' },
                        green: { 50:'#f0fdf4', 100:'#dcfce7', 400:'#4ade80', 500:'#22c55e', 600:'#16a34a', 700:'#15803d' },
                        amber: { 300:'#fcd34d', 400:'#fbbf24', 500:'#f59e0b', 600:'#d97706' }
                    }
                }
            }
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background: #f8fafc;
            min-height: 100vh;
        }

        .login-left {
            background: linear-gradient(155deg, #0d1a45 0%, #132460 40%, #17317f 100%);
        }

        .pattern-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04' fill-rule='evenodd'%3E%3Cpath d='M20 18v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM4 2V0H2v2H0v2h2v2h2V4h2V2H4z'/%3E%3C/g%3E%3C/svg%3E");
        }

        .input-field {
            width: 100%;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            color: #1e293b;
            border-radius: 10px;
            padding: 11px 16px;
            font-size: 0.875rem;
            transition: all 0.2s;
            outline: none;
        }
        .input-field::placeholder { color: #94a3b8; }
        .input-field:focus {
            border-color: #2d5be3;
            box-shadow: 0 0 0 3px rgba(45, 91, 227, 0.12);
            background: #fff;
        }
        .input-field.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.10);
        }

        .btn-primary {
            width: 100%;
            background: #132460;
            color: #fff;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 12px 24px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-primary:hover {
            background: #17317f;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(19, 36, 96, 0.28);
        }
        .btn-primary:active { transform: translateY(0); }
        .btn-primary:disabled { opacity: 0.65; cursor: not-allowed; transform: none; }

        .card-enter {
            animation: cardIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .amiri-text {
            font-family: 'Amiri', serif;
        }

        .geometric-deco {
            position: absolute;
            border-radius: 50%;
            opacity: 0.07;
        }
    </style>
</head>
<body class="min-h-screen flex">

    <!-- Left Panel (Branding) -->
    <div class="login-left pattern-bg hidden lg:flex flex-col justify-between w-[45%] min-h-screen p-12 relative overflow-hidden">

        <!-- Geometric decorations (subtle, not animated) -->
        <div class="geometric-deco bg-white" style="width:320px;height:320px;top:-80px;right:-80px;"></div>
        <div class="geometric-deco bg-white" style="width:200px;height:200px;bottom:-40px;left:-40px;"></div>

        <!-- Top section -->
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-12">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center p-1.5 shadow-md">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">AR-RAUDHAH</p>
                    <p class="text-blue-200 text-xs">Yayasan Cahaya Amanah</p>
                </div>
            </div>

            <h2 class="text-3xl xl:text-4xl font-black text-white leading-tight mb-4">
                Sistem Penilaian<br>
                <span class="text-amber-300">Munaqasyah</span><br>
                Santri
            </h2>
            <p class="text-blue-200 text-sm leading-relaxed max-w-xs">
                Platform digital pengelolaan ujian dan kelulusan santri TPQ & RTQ Ar-Raudhah, Banjarbaru.
            </p>
        </div>

        <!-- Arabic verse -->
        <div class="relative z-10">
            <p class="amiri-text text-2xl text-amber-200 leading-relaxed mb-1">بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
            <p class="text-blue-300 text-xs">Dengan menyebut nama Allah Yang Maha Pengasih lagi Maha Penyayang</p>

            <div class="mt-8 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                    <i class="fa-solid fa-scroll text-amber-300 text-sm"></i>
                </div>
                <div>
                    <p class="text-white text-xs font-semibold">TPQ Ar-Raudhah</p>
                    <p class="text-blue-300 text-[11px]">Taman Pendidikan Qur'an</p>
                </div>
                <div class="w-px h-8 bg-white/20 mx-1"></div>
                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                    <i class="fa-solid fa-book-quran text-amber-300 text-sm"></i>
                </div>
                <div>
                    <p class="text-white text-xs font-semibold">RTQ Ar-Raudhah</p>
                    <p class="text-blue-300 text-[11px]">Rumah Tahfidz Qur'an</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel (Form) -->
    <div class="flex-1 flex flex-col justify-center items-center px-6 py-10 bg-slate-50">

        <!-- Back button -->
        <a href="{{ route('landing') }}"
           class="absolute top-5 left-5 lg:top-6 lg:left-[47%] xl:left-[47%] inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-slate-800 bg-white border border-slate-200 px-3 py-2 rounded-lg shadow-sm transition hover:shadow-md group">
            <i class="fa-solid fa-arrow-left text-[10px] group-hover:-translate-x-0.5 transition-transform"></i>
            Kembali ke Beranda
        </a>

        <div class="w-full max-w-sm card-enter">

            <!-- Mobile logo -->
            <div class="lg:hidden text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white border border-slate-200 shadow-sm mb-3 p-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <h1 class="font-black text-slate-800 text-xl">AR-RAUDHAH</h1>
                <p class="text-slate-500 text-xs">Yayasan Cahaya Amanah Banjarbaru</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-800">Selamat Datang</h2>
                    <p class="text-slate-500 text-sm mt-1">Masuk untuk mengelola data munaqasyah</p>
                </div>

                {{-- Success message --}}
                @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-3 flex items-start gap-2.5">
                    <i class="fa-solid fa-circle-check text-green-500 mt-0.5 shrink-0 text-sm"></i>
                    <p class="text-green-700 text-xs leading-relaxed">{{ session('success') }}</p>
                </div>
                @endif

                {{-- Lockout warning --}}
                @if(session('is_locked'))
                <div class="mb-5 bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                    <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-100 text-red-500 mb-2">
                        <i class="fa-solid fa-lock text-lg"></i>
                    </div>
                    <h3 class="text-sm font-bold text-red-700 mb-1">Akses Sementara Dikunci</h3>
                    <p class="text-slate-500 text-xs mb-3">Terlalu banyak percobaan login gagal. Harap tunggu:</p>
                    <div class="inline-block px-4 py-2 rounded-lg bg-red-100 font-mono text-lg font-black text-red-600" id="countdownBox">
                        <span id="countdownTimer">--:--</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Atau hubungi administrator sistem.</p>
                </div>
                @endif

                {{-- Validation errors (global) --}}
                @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-3 flex items-start gap-2">
                    <i class="fa-solid fa-circle-exclamation text-red-400 mt-0.5 shrink-0 text-sm"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <p class="text-red-600 text-xs">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-4" id="loginForm">
                    @csrf

                    <!-- Username -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">
                            Username
                        </label>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            value="{{ old('username') }}"
                            placeholder="Masukkan username"
                            autocomplete="username"
                            class="input-field"
                            required
                        >
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">
                            Password
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="••••••••"
                                autocomplete="current-password"
                                class="input-field pr-11 {{ session('error') && !session('is_locked') ? 'error' : '' }}"
                                required
                            >
                            <button type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 transition-colors"
                                onclick="togglePass()">
                                <i class="fa-solid fa-eye text-sm" id="eyeIcon"></i>
                            </button>
                        </div>

                        <!-- Password error (di bawah input) -->
                        @if(session('error') && !session('is_locked'))
                        <div class="mt-2 bg-red-50 border border-red-200 rounded-lg p-3 flex items-start gap-2.5">
                            <i class="fa-solid fa-triangle-exclamation text-red-400 mt-0.5 shrink-0 text-sm"></i>
                            <div class="space-y-1.5">
                                <p class="text-red-600 text-xs font-semibold leading-relaxed">{!! session('error') !!}</p>
                                @if(session('remaining_attempts'))
                                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-amber-50 border border-amber-200 text-amber-700 text-[11px] font-semibold">
                                    <i class="fa-solid fa-shield-halved text-[10px]"></i>
                                    <span>Sisa percobaan: {{ session('remaining_attempts') }}x sebelum diblokir</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded accent-blue-700">
                            <span class="text-xs text-slate-500">Ingat saya selama 7 hari</span>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" id="loginBtn" class="btn-primary mt-2">
                        <i class="fa-solid fa-right-to-bracket" id="loginIcon"></i>
                        <span id="loginText">Masuk ke Sistem</span>
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-6 pt-5 border-t border-slate-100 text-center space-y-3">
                    <p class="text-slate-400 text-xs">
                        <i class="fa-solid fa-shield-halved mr-1 text-slate-400"></i>
                        Akses terbatas — panitia munaqasyah berwenang
                    </p>
                    <a href="{{ route('landing') }}"
                       class="inline-flex items-center gap-2 text-xs text-slate-500 hover:text-slate-800 transition font-medium py-1">
                        <i class="fa-solid fa-house text-[11px]"></i>
                        Kembali ke Halaman Beranda
                    </a>
                </div>
            </div>

            <p class="text-center text-slate-400 text-xs mt-5">
                &copy; 2026 Yayasan Cahaya Amanah Ar-Raudhah, Banjarbaru
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
        });

        @if(session('is_locked'))
        (function() {
            let secondsLeft = {{ (int) session('lockout_seconds', 900) }};
            const display = document.getElementById('countdownTimer');
            const btn = document.getElementById('loginBtn');
            const uInput = document.getElementById('username');
            const pInput = document.getElementById('password');

            if (btn) { btn.disabled = true; document.getElementById('loginText').textContent = 'Terkunci Sementara'; }
            if (uInput) uInput.disabled = true;
            if (pInput) pInput.disabled = true;

            function updateTimer() {
                if (secondsLeft <= 0) {
                    if (display) display.textContent = 'Silakan Refresh';
                    if (btn) { btn.disabled = false; document.getElementById('loginText').textContent = 'Coba Masuk Lagi'; }
                    if (uInput) uInput.disabled = false;
                    if (pInput) pInput.disabled = false;
                    return;
                }
                const mins = Math.floor(secondsLeft / 60);
                const secs = secondsLeft % 60;
                if (display) display.textContent = `${mins.toString().padStart(2,'0')}:${secs.toString().padStart(2,'0')}`;
                secondsLeft--;
                setTimeout(updateTimer, 1000);
            }
            updateTimer();
        })();
        @endif
    </script>
</body>
</html>
