<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Database Sekolah Ar-Raudhah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 520px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.07), 0 10px 30px -5px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        /* LEFT PANEL */
        .login-left {
            flex: 1;
            background: #1e3a8a;
            background-image:
                radial-gradient(ellipse at top left, #1d4ed8 0%, transparent 60%),
                radial-gradient(ellipse at bottom right, #1e40af 0%, transparent 60%);
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .login-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04' fill-rule='evenodd'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .left-brand { display: flex; align-items: center; gap: 12px; }
        .left-logo {
            width: 44px; height: 44px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 12px;
            padding: 6px;
            display: flex; align-items: center; justify-content: center;
        }
        .left-logo img { width: 100%; height: 100%; object-fit: contain; }
        .left-brand-text h2 { color: #fff; font-size: 15px; font-weight: 800; letter-spacing: -0.01em; }
        .left-brand-text p { color: rgba(255,255,255,0.55); font-size: 11.5px; margin-top: 1px; }

        .left-body { position: relative; z-index: 1; }
        .left-body .arabic {
            font-family: 'Amiri', serif;
            color: #fde68a;
            font-size: 1.6rem;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        .left-body h1 { color: #fff; font-size: 1.5rem; font-weight: 800; line-height: 1.3; margin-bottom: 10px; }
        .left-body p { color: rgba(255,255,255,0.55); font-size: 13px; line-height: 1.6; }

        .left-footer { position: relative; z-index: 1; }
        .unit-pill {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 7px 14px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 8px;
            color: rgba(255,255,255,0.75);
            font-size: 12px; font-weight: 600;
            margin-right: 8px; margin-top: 8px;
        }
        .unit-pill i { color: #fde68a; font-size: 11px; }

        /* RIGHT PANEL */
        .login-right {
            width: 380px;
            flex-shrink: 0;
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        .right-header { margin-bottom: 28px; }
        .right-header h3 { font-size: 1.3rem; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
        .right-header p { font-size: 13px; color: #94a3b8; }

        /* Alerts */
        .alert { border-radius: 10px; padding: 10px 14px; margin-bottom: 16px; display: flex; align-items: flex-start; gap: 9px; font-size: 13px; }
        .alert-ok { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
        .alert-err { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
        .alert-lock { background: #fef2f2; border: 1px solid #fecaca; border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 16px; }

        /* Form */
        .field { margin-bottom: 16px; }
        .field label { display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em; }
        .field input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            background: #f8fafc;
            outline: none;
            transition: all 0.18s;
        }
        .field input::placeholder { color: #cbd5e1; }
        .field input:focus { border-color: #3b82f6; background: #fff; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
        .field input.err { border-color: #f87171; box-shadow: 0 0 0 3px rgba(248,113,113,0.1); }
        .pw-wrap { position: relative; }
        .pw-wrap input { padding-right: 42px; }
        .pw-toggle { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #94a3b8; padding: 0; line-height: 1; }
        .pw-toggle:hover { color: #475569; }

        .field-alert { background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 10px 12px; margin-top: 8px; display: flex; align-items: flex-start; gap: 8px; }
        .field-alert p { font-size: 12px; color: #b91c1c; line-height: 1.5; margin: 0; }
        .attempt-badge { display: inline-flex; align-items: center; gap: 5px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 600; color: #92400e; margin-top: 4px; }

        .remember { display: flex; align-items: center; gap: 8px; margin-bottom: 20px; }
        .remember input { width: 15px; height: 15px; accent-color: #3b82f6; }
        .remember label { font-size: 13px; color: #64748b; cursor: pointer; }

        .btn-submit {
            width: 100%;
            background: #1e40af;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.18s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-submit:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(30,64,175,0.3); }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled { opacity: 0.6; cursor: not-allowed; transform: none; box-shadow: none; }

        .login-footer { margin-top: 24px; padding-top: 20px; border-top: 1px solid #f1f5f9; text-align: center; }
        .login-footer p { font-size: 12px; color: #94a3b8; margin-bottom: 8px; }
        .login-footer a { font-size: 12px; color: #64748b; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: color 0.15s; }
        .login-footer a:hover { color: #1e40af; }

        /* RESPONSIVE — mobile: stack vertically, hide left panel */
        @media (max-width: 700px) {
            body { padding: 0; align-items: stretch; }
            .login-wrapper {
                max-width: 100%;
                min-height: 100vh;
                border-radius: 0;
                flex-direction: column;
                box-shadow: none;
            }
            .login-left {
                padding: 32px 24px 28px;
                flex: none;
            }
            .left-body h1 { font-size: 1.2rem; }
            .left-body .arabic { font-size: 1.3rem; }
            .login-right {
                width: 100%;
                padding: 32px 24px;
                flex: 1;
            }
        }
    </style>
</head>
<body>
<div class="login-wrapper">

    <!-- ===== LEFT BRANDING PANEL ===== -->
    <div class="login-left">
        <div class="left-brand">
            <div class="left-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Yayasan">
            </div>
            <div class="left-brand-text">
                <h2>AR-RAUDHAH</h2>
                <p>Yayasan Cahaya Amanah · Banjarbaru</p>
            </div>
        </div>

        <div class="left-body">
            <p class="arabic">بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ</p>
            <h1>Database Sekolah<br>Santri</h1>
            <p>Platform digital resmi untuk pengelolaan ujian, penilaian, dan kelulusan santri Ar-Raudhah Banjarbaru.</p>
        </div>

        <div class="left-footer">
            <div>
                <span class="unit-pill"><i class="fa-solid fa-scroll"></i> TPQ Ar-Raudhah</span>
                <span class="unit-pill"><i class="fa-solid fa-book-quran"></i> RTQ Ar-Raudhah</span>
            </div>
            <p style="color:rgba(255,255,255,0.3);font-size:11px;margin-top:16px;">&copy; 2026 Yayasan Cahaya Amanah Ar-Raudhah</p>
        </div>
    </div>

    <!-- ===== RIGHT FORM PANEL ===== -->
    <div class="login-right">
        <div class="right-header">
            <h3>Selamat Datang</h3>
            <p>Masuk untuk mengelola database sekolah</p>
        </div>

        {{-- Success --}}
        @if(session('success'))
        <div class="alert alert-ok">
            <i class="fa-solid fa-circle-check" style="flex-shrink:0;margin-top:1px;"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        {{-- Lockout --}}
        @if(session('is_locked'))
        <div class="alert-lock">
            <div style="width:40px;height:40px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
                <i class="fa-solid fa-lock" style="color:#dc2626;"></i>
            </div>
            <p style="font-weight:700;color:#991b1b;font-size:13px;margin-bottom:4px;">Akses Dikunci Sementara</p>
            <p style="color:#64748b;font-size:12px;margin-bottom:12px;">Terlalu banyak percobaan gagal. Tunggu:</p>
            <div style="display:inline-block;padding:6px 20px;background:#fff;border:1.5px solid #fca5a5;border-radius:8px;font-family:monospace;font-size:1.25rem;font-weight:800;color:#dc2626;" id="countdownBox">
                <span id="countdownTimer">--:--</span>
            </div>
        </div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
        <div class="alert alert-err">
            <i class="fa-solid fa-circle-exclamation" style="flex-shrink:0;margin-top:1px;"></i>
            <div>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" id="loginForm">
            @csrf

            <!-- Username -->
            <div class="field">
                <label>Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}"
                    placeholder="Masukkan username" autocomplete="username" required>
            </div>

            <!-- Password -->
            <div class="field">
                <label>Password</label>
                <div class="pw-wrap">
                    <input type="password" name="password" id="password"
                        placeholder="••••••••" autocomplete="current-password"
                        class="{{ session('error') && !session('is_locked') ? 'err' : '' }}" required>
                    <button type="button" class="pw-toggle" onclick="togglePass()">
                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                    </button>
                </div>

                @if(session('error') && !session('is_locked'))
                <div class="field-alert">
                    <i class="fa-solid fa-triangle-exclamation" style="color:#f87171;flex-shrink:0;margin-top:1px;font-size:12px;"></i>
                    <div>
                        <p>{!! session('error') !!}</p>
                        @if(session('remaining_attempts'))
                        <div class="attempt-badge">
                            <i class="fa-solid fa-shield-halved" style="font-size:10px;"></i>
                            Sisa: {{ session('remaining_attempts') }}x percobaan
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Remember -->
            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ingat saya selama 7 hari</label>
            </div>

            <!-- Submit -->
            <button type="submit" id="loginBtn" class="btn-submit">
                <i class="fa-solid fa-right-to-bracket" id="loginIcon"></i>
                <span id="loginText">Masuk ke Sistem</span>
            </button>
        </form>

        <div class="login-footer">
            <p><i class="fa-solid fa-shield-halved" style="margin-right:4px;"></i>Akses terbatas untuk panitia berwenang</p>
            <a href="{{ route('landing') }}">
                <i class="fa-solid fa-arrow-left" style="font-size:10px;"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<script>
    function togglePass() {
        const p = document.getElementById('password');
        const i = document.getElementById('eyeIcon');
        p.type = p.type === 'password' ? 'text' : 'password';
        i.className = p.type === 'text' ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
    }

    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('loginBtn');
        document.getElementById('loginText').textContent = 'Memverifikasi...';
        document.getElementById('loginIcon').className = 'fa-solid fa-spinner fa-spin';
        btn.disabled = true;
    });

    @if(session('is_locked'))
    (function() {
        let s = {{ (int) session('lockout_seconds', 900) }};
        const d = document.getElementById('countdownTimer');
        const btn = document.getElementById('loginBtn');
        const u = document.getElementById('username');
        const p = document.getElementById('password');
        if (btn) { btn.disabled = true; document.getElementById('loginText').textContent = 'Terkunci'; }
        if (u) u.disabled = true;
        if (p) p.disabled = true;
        function tick() {
            if (s <= 0) {
                if (d) d.textContent = 'Silakan Refresh';
                if (btn) { btn.disabled = false; document.getElementById('loginText').textContent = 'Coba Lagi'; }
                if (u) u.disabled = false;
                if (p) p.disabled = false;
                return;
            }
            const m = Math.floor(s/60), sec = s%60;
            if (d) d.textContent = `${String(m).padStart(2,'0')}:${String(sec).padStart(2,'0')}`;
            s--; setTimeout(tick, 1000);
        }
        tick();
    })();
    @endif
</script>
</body>
</html>
