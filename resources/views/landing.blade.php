<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yayasan Cahaya Amanah Ar-Raudhah — Munaqasyah TPQ & RTQ</title>
    <meta name="description" content="Platform digital penilaian & kelulusan munaqasyah santri Taman Pendidikan Qur'an (TPQ) & Rumah Tahfidz Qur'an (RTQ) Ar-Raudhah, Yayasan Cahaya Amanah Ar-Raudhah Banjarbaru.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Animated hero background matching official logo palette */
        .hero-bg {
            background: linear-gradient(135deg, #020617 0%, #0f172a 25%, #172554 50%, #1e3a8a 75%, #090d16 100%);
            background-size: 300% 300%;
            animation: heroBgShift 14s ease infinite;
        }
        @keyframes heroBgShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating orbs in Crimson Red, Navy Blue, and Amber Gold */
        .orb { position: absolute; border-radius: 50%; filter: blur(90px); animation: orbFloat 14s ease-in-out infinite; }
        .orb-1 { width:520px; height:520px; background:rgba(220,38,38,.14); top:-15%; left:-10%; animation-delay:0s; }
        .orb-2 { width:420px; height:420px; background:rgba(245,158,11,.12); top:45%; right:-8%; animation-delay:-5s; }
        .orb-3 { width:340px; height:340px; background:rgba(37,99,235,.18); bottom:-8%; left:30%; animation-delay:-9s; }
        @keyframes orbFloat {
            0%,100% { transform:translateY(0) scale(1); }
            50%      { transform:translateY(-40px) scale(1.06); }
        }

        /* Islamic SVG pattern overlay */
        .islamic-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Text shimmer - Amber Gold */
        .text-shimmer {
            background: linear-gradient(90deg, #fde68a, #fbbf24, #f59e0b, #fbbf24, #fde68a);
            background-size: 250% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s linear infinite;
        }
        @keyframes shimmer { from{background-position:0%} to{background-position:250%} }

        /* Arabic shimmer */
        .arabic-shimmer {
            font-family: 'Amiri', serif;
            background: linear-gradient(90deg, #93c5fd, #60a5fa, #bfdbfe);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s linear infinite;
        }

        /* Feature card hover */
        .feature-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -12px rgba(15, 23, 42, 0.16);
        }

        /* Stat counter card */
        .stat-card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.12);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            background: rgba(255,255,255,0.11);
            transform: translateY(-3px);
        }

        /* CTA button in Crimson Red */
        .btn-cta {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            box-shadow: 0 8px 24px rgba(220,38,38,0.35);
            transition: all 0.3s ease;
            position: relative; 
            overflow: hidden;
        }
        .btn-cta::before {
            content:''; position:absolute; top:0; left:-100%;
            width:100%; height:100%;
            background:linear-gradient(90deg,transparent,rgba(255,255,255,.24),transparent);
            transition:left 0.5s;
        }
        .btn-cta:hover::before { left:100%; }
        .btn-cta:hover { transform:translateY(-2px); box-shadow:0 12px 32px rgba(220,38,38,0.48); }

        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Navbar glass */
        #navbar.scrolled {
            background: rgba(15, 23, 42, 0.94);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 4px 24px rgba(0,0,0,0.35);
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 antialiased overflow-x-hidden">

    <!-- ===== NAVBAR ===== -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <a href="#" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Yayasan" class="w-10 h-10 sm:w-11 sm:h-11 object-contain bg-white rounded-xl p-1 shadow-lg group-hover:scale-105 transition-transform shrink-0">
                    <div>
                        <p class="text-sm sm:text-base font-black text-white tracking-tight leading-none">AR-RAUDHAH</p>
                        <p class="text-[10px] sm:text-xs text-blue-300 font-semibold leading-none mt-1">Yayasan Cahaya Amanah</p>
                    </div>
                </a>
                <div class="flex items-center gap-3 sm:gap-6">
                    <a href="#kategori" class="text-slate-300 hover:text-white text-xs sm:text-sm font-semibold transition hidden sm:block">Unit Lembaga</a>
                    <a href="#fitur" class="text-slate-300 hover:text-white text-xs sm:text-sm font-semibold transition hidden sm:block">Fitur Sistem</a>
                    <a href="#faq" class="text-slate-300 hover:text-white text-xs sm:text-sm font-semibold transition hidden sm:block">FAQ &amp; Bantuan</a>
                    <a href="#tentang" class="text-slate-300 hover:text-white text-xs sm:text-sm font-semibold transition hidden sm:block">Tentang</a>
                    <a href="{{ route('login') }}"
                        class="btn-cta text-white font-bold text-xs sm:text-sm px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl flex items-center gap-2">
                        <i class="fa-solid fa-right-to-bracket"></i> Masuk Sistem
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <section class="hero-bg min-h-screen flex flex-col items-center justify-center relative overflow-hidden pt-20 pb-16">
        <!-- Ambient Orbs & Pattern -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="absolute inset-0 islamic-bg"></div>

        <!-- Canvas Particles -->
        <canvas id="particles" class="absolute inset-0 pointer-events-none opacity-40"></canvas>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            <!-- Badge Yayasan -->
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-4 py-1.5 mb-6 backdrop-blur-md shadow-lg">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-4 h-4 object-contain bg-white rounded-full p-0.5">
                <span class="text-[11px] sm:text-xs font-bold text-slate-100 uppercase tracking-widest">Yayasan Cahaya Amanah Ar-Raudhah</span>
            </div>

            <!-- Arabic Bismillah -->
            <p class="arabic-shimmer text-3xl sm:text-4xl lg:text-5xl mb-4 font-bold">بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ</p>

            <!-- Main Heading -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 tracking-tight">
                Sistem Penilaian Munaqasyah
                <span class="text-shimmer block mt-1">TPQ &amp; RTQ Ar-Raudhah</span>
            </h1>

            <p class="text-slate-300 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto leading-relaxed mb-6 font-normal">
                Platform digital resmi evaluasi, penilaian 9 mata uji, dan penerbitan surat kelulusan santri 
                <strong class="text-white font-bold">Taman Pendidikan Qur'an (TPQ)</strong> &amp; 
                <strong class="text-white font-bold">Rumah Tahfidz Qur'an (RTQ)</strong> Ar-Raudhah Banjarbaru.
            </p>

            <!-- Unit Pills -->
            <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mb-10">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-blue-900/60 border border-blue-500/30 text-blue-200 text-xs font-semibold backdrop-blur-sm">
                    <i class="fa-solid fa-book-quran text-amber-400"></i> Taman Pendidikan Qur'an Ar-Raudhah (TPQ)
                </span>
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-red-950/60 border border-red-500/30 text-red-200 text-xs font-semibold backdrop-blur-sm">
                    <i class="fa-solid fa-mosque text-red-400"></i> Rumah Tahfidz Qur'an Ar-Raudhah (RTQ)
                </span>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}"
                    class="btn-cta text-white font-black text-sm sm:text-base px-8 py-3.5 rounded-2xl flex items-center justify-center gap-2.5 shadow-2xl">
                    <i class="fa-solid fa-right-to-bracket text-lg"></i>
                    Masuk ke Sistem
                </a>
                <a href="#fitur"
                    class="flex items-center justify-center gap-2.5 text-white font-bold text-sm sm:text-base px-8 py-3.5 rounded-2xl border border-white/20 bg-white/10 backdrop-blur-sm hover:bg-white/20 transition">
                    <i class="fa-solid fa-circle-info"></i>
                    Lihat Fitur &amp; Mata Uji
                </a>
            </div>

            <!-- Scroll Indicator -->
            <div class="mt-14 flex flex-col items-center gap-2 animate-bounce">
                <span class="text-slate-400 text-xs font-medium">Gulir ke bawah</span>
                <i class="fa-solid fa-chevron-down text-slate-400 text-xs"></i>
            </div>
        </div>
    </section>

    <!-- ===== STATS SECTION ===== -->
    <section class="bg-gradient-to-r from-slate-950 via-blue-950 to-slate-950 py-12 border-y border-white/10">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="stat-card rounded-2xl p-5 text-center">
                    <p class="text-3xl sm:text-4xl font-black text-amber-400" data-count="2">0</p>
                    <p class="text-xs text-slate-200 font-bold uppercase tracking-wide mt-1">Lembaga Naungan</p>
                    <p class="text-[11px] text-blue-300 mt-0.5 font-medium">TPQ &amp; RTQ Ar-Raudhah</p>
                </div>
                <div class="stat-card rounded-2xl p-5 text-center">
                    <p class="text-3xl sm:text-4xl font-black text-amber-400" data-count="9">0</p>
                    <p class="text-xs text-slate-200 font-bold uppercase tracking-wide mt-1">Mata Uji Standar</p>
                    <p class="text-[11px] text-blue-300 mt-0.5 font-medium">Tajwid, Gharib, &amp; Hafalan</p>
                </div>
                <div class="stat-card rounded-2xl p-5 text-center">
                    <p class="text-3xl sm:text-4xl font-black text-amber-400">
                        <span data-count="100">0</span>%
                    </p>
                    <p class="text-xs text-slate-200 font-bold uppercase tracking-wide mt-1">Digital &amp; Akurat</p>
                    <p class="text-[11px] text-blue-300 mt-0.5 font-medium">Kalkulasi Otomatis</p>
                </div>
                <div class="stat-card rounded-2xl p-5 text-center">
                    <p class="text-3xl sm:text-4xl font-black text-amber-400" data-count="1447">0</p>
                    <p class="text-xs text-slate-200 font-bold uppercase tracking-wide mt-1">Tahun Hijriyah</p>
                    <p class="text-[11px] text-blue-300 mt-0.5 font-medium">1447 H / 2026 M</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== UNIT SECTION ===== -->
    <section id="kategori" class="py-16 bg-slate-900/60">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12 reveal">
                <span class="text-xs font-bold text-red-400 uppercase tracking-widest bg-red-950/60 border border-red-800/60 px-3.5 py-1 rounded-full">Unit Pendidikan</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white mt-3">
                    Lembaga Pendidikan Al-Qur'an Ar-Raudhah
                </h2>
                <p class="text-slate-400 text-sm mt-2 max-w-xl mx-auto">Membina generasi qur'ani yang berakhlak mulia melalui pembinaan tartil, tahsin, dan tahfidz yang terstruktur.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- TPQ Card -->
                <div class="bg-gradient-to-br from-slate-900 to-blue-950/80 border border-blue-800/40 rounded-3xl p-7 shadow-xl hover:border-blue-500/50 transition reveal">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-blue-600/20 text-blue-400 border border-blue-500/30 rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-blue-400 uppercase tracking-wider">Unit Pendidikan 01</span>
                            <h3 class="text-lg sm:text-xl font-black text-white">Taman Pendidikan Qur'an Ar-Raudhah</h3>
                            <p class="text-xs text-slate-400 font-semibold">TPQ Ar-Raudhah Banjarbaru</p>
                        </div>
                    </div>
                    <p class="text-slate-300 text-sm leading-relaxed mb-5">
                        Fokus pada pembinaan dasar membaca Al-Qur'an dengan tartil, hukum tajwid praktis, makharijul huruf, gharib &amp; musykilat, adab harian, serta doa dan surat-surat pendek.
                    </p>
                    <div class="flex flex-wrap gap-2 text-[11px] font-semibold text-blue-200">
                        <span class="px-2.5 py-1 bg-blue-950/80 border border-blue-700/50 rounded-lg">Fashohah &amp; Tartil</span>
                        <span class="px-2.5 py-1 bg-blue-950/80 border border-blue-700/50 rounded-lg">Tajwid Praktis</span>
                        <span class="px-2.5 py-1 bg-blue-950/80 border border-blue-700/50 rounded-lg">Gharib Al-Qur'an</span>
                        <span class="px-2.5 py-1 bg-blue-950/80 border border-blue-700/50 rounded-lg">Hafalan Juz 'Amma</span>
                    </div>
                </div>

                <!-- RTQ Card -->
                <div class="bg-gradient-to-br from-slate-900 to-red-950/70 border border-red-800/40 rounded-3xl p-7 shadow-xl hover:border-red-500/50 transition reveal">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-red-600/20 text-red-400 border border-red-500/30 rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fa-solid fa-mosque"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-red-400 uppercase tracking-wider">Unit Pendidikan 02</span>
                            <h3 class="text-lg sm:text-xl font-black text-white">Rumah Tahfidz Qur'an Ar-Raudhah</h3>
                            <p class="text-xs text-slate-400 font-semibold">RTQ Ar-Raudhah Banjarbaru</p>
                        </div>
                    </div>
                    <p class="text-slate-300 text-sm leading-relaxed mb-5">
                        Program intensif penghafalan Al-Qur'an berjenjang dengan muraja'ah berkala, penguatan mutqin hafalan, dan pengujian kelayakan sanad hafalan santri binaan.
                    </p>
                    <div class="flex flex-wrap gap-2 text-[11px] font-semibold text-red-200">
                        <span class="px-2.5 py-1 bg-red-950/80 border border-red-700/50 rounded-lg">Tahfidz Tematik</span>
                        <span class="px-2.5 py-1 bg-red-950/80 border border-red-700/50 rounded-lg">Tahfidz Juz 'Amma</span>
                        <span class="px-2.5 py-1 bg-red-950/80 border border-red-700/50 rounded-lg">Muraja'ah Berkala</span>
                        <span class="px-2.5 py-1 bg-red-950/80 border border-red-700/50 rounded-lg">Kelulusan Resmi</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FITUR SECTION ===== -->
    <section id="fitur" class="py-20 bg-slate-100 text-slate-800">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-14 reveal">
                <span class="text-xs font-bold text-red-600 uppercase tracking-widest bg-red-50 border border-red-200 px-3.5 py-1 rounded-full">Fitur Unggulan</span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-4 leading-tight">
                    Semua yang Dibutuhkan Penguji &amp; Panitia<br>
                    <span class="text-blue-900">dalam Satu Platform Terpadu</span>
                </h2>
                <p class="text-slate-500 mt-3 max-w-xl mx-auto text-sm">Dirancang khusus untuk Yayasan Cahaya Amanah Ar-Raudhah agar proses penilaian menjadi terstandar, objektif, dan efisien.</p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- F1 -->
                <div class="feature-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm reveal">
                    <div class="w-12 h-12 bg-blue-50 text-blue-800 rounded-xl flex items-center justify-center text-xl mb-4 border border-blue-100">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Penilaian 9 Mata Uji</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Form penilaian digital untuk 9 indikator resmi: Fashohah, Tajwid, Gharib, Dinul Islam, Ayat Pilihan, Praktek Sholat, Doa Harian, dan Tahfidz.</p>
                </div>
                <!-- F2 -->
                <div class="feature-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm reveal">
                    <div class="w-12 h-12 bg-amber-50 text-amber-700 rounded-xl flex items-center justify-center text-xl mb-4 border border-amber-100">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Penentuan Kelulusan Otomatis</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Algoritma otomatis mengevaluasi nilai ambang batas kelulusan per mata uji secara transparan dan tanpa bias manusiawi.</p>
                </div>
                <!-- F3 -->
                <div class="feature-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm reveal">
                    <div class="w-12 h-12 bg-red-50 text-red-700 rounded-xl flex items-center justify-center text-xl mb-4 border border-red-100">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Surat Keterangan Kelulusan</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Penerbitan surat kelulusan resmi dengan kop yayasan, transkrip nilai 9 mata uji, pas foto santri, dan format siap cetak.</p>
                </div>
                <!-- F4 -->
                <div class="feature-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm reveal">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-xl mb-4 border border-emerald-100">
                        <i class="fa-solid fa-file-excel"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Export Data Excel &amp; CSV</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Unduh seluruh rekapitulasi data santri munaqasyah TPQ &amp; RTQ dalam format Excel/CSV dengan sekali klik.</p>
                </div>
                <!-- F5 -->
                <div class="feature-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm reveal">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-700 rounded-xl flex items-center justify-center text-xl mb-4 border border-indigo-100">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Upload Pas Foto Santri</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Manajemen foto santri resmi yang otomatis tersemat rapi pada surat keterangan kelulusan dan arsip database.</p>
                </div>
                <!-- F6 -->
                <div class="feature-card bg-white rounded-2xl p-6 border border-slate-200 shadow-sm reveal">
                    <div class="w-12 h-12 bg-slate-100 text-slate-800 rounded-xl flex items-center justify-center text-xl mb-4 border border-slate-200">
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 text-base mb-2">Dashboard Statistik Real-Time</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Pantau grafik perolehan kelulusan, statistik santri lulus/tidak lulus, serta rekapitulasi nilai tertinggi &amp; terendah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FAQ & TANYA JAWAB SECTION ===== -->
    <section id="faq" class="py-20 bg-slate-900/90 relative border-t border-slate-800/80">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-12 reveal">
                <span class="text-xs font-bold text-red-400 uppercase tracking-widest bg-red-950/60 border border-red-800/60 px-3.5 py-1 rounded-full">
                    Pertanyaan Umum
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-white mt-3 leading-tight">
                    Frequently Asked Questions (FAQ)
                </h2>
                <p class="text-slate-400 text-xs sm:text-sm mt-2 max-w-lg mx-auto">
                    Temukan jawaban atas pertanyaan seputar penilaian, syarat kelulusan munaqasyah santri, dan pengembang platform.
                </p>
            </div>

            <!-- FAQ List -->
            <div class="space-y-4 reveal">
                <!-- Q1: Pembuat -->
                <div class="bg-gradient-to-r from-slate-900 to-blue-950/60 border border-blue-500/30 rounded-2xl p-5 shadow-lg">
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-red-600/20 text-red-400 border border-red-500/30 flex items-center justify-center text-lg shrink-0 mt-0.5">
                            <i class="fa-solid fa-code"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white mb-1.5 flex items-center gap-2">
                                Siapa pembuat sistem munaqasyah ini?
                                <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-red-600 text-white uppercase">Creator</span>
                            </h3>
                            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                                Sistem ini dirancang dan diciptakan oleh <strong class="text-amber-300 font-bold">Hugo Putra Pratama</strong>, software engineer yang mendedikasikan platform digital ini untuk standarisasi penilaian santri di <strong>Yayasan Cahaya Amanah Ar-Raudhah Banjarbaru</strong>.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Q2: 9 Mata Uji -->
                <div class="bg-slate-900/60 border border-slate-800 hover:border-slate-700 rounded-2xl p-5 transition">
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-blue-600/20 text-blue-400 border border-blue-500/30 flex items-center justify-center text-lg shrink-0 mt-0.5">
                            <i class="fa-solid fa-clipboard-check"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white mb-1.5">Apa saja 9 mata uji standar yang dinilai?</h3>
                            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed mb-2">
                                Sembilan mata uji resmi meliputi: <strong>Fashohah</strong>, <strong>Tajwid</strong>, <strong>Gharib &amp; Musykilat</strong>, <strong>Suara &amp; Lagu</strong>, <strong>Ayat Pilihan</strong>, <strong>Surah Pendek (Juz 'Amma)</strong>, <strong>Doa Harian</strong>, <strong>Bacaan Shalat</strong>, dan <strong>Ujian Tertulis Dinul Islam</strong>.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Q3: Cetak Surat -->
                <div class="bg-slate-900/60 border border-slate-800 hover:border-slate-700 rounded-2xl p-5 transition">
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center text-lg shrink-0 mt-0.5">
                            <i class="fa-solid fa-print"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white mb-1.5">Bagaimana cara menerbitkan surat keterangan kelulusan?</h3>
                            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                                Panitia atau penguji cukup membuka daftar nilai TPQ/RTQ, memilih santri terkait, lalu menekan tombol <strong>"Sertifikat"</strong>. Halaman surat kelulusan resmi dengan kop yayasan, transkrip 9 mata uji, dan pas foto santri akan langsung siap cetak atau disimpan ke format PDF.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Q4: Export Data -->
                <div class="bg-slate-900/60 border border-slate-800 hover:border-slate-700 rounded-2xl p-5 transition">
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-amber-600/20 text-amber-400 border border-amber-500/30 flex items-center justify-center text-lg shrink-0 mt-0.5">
                            <i class="fa-solid fa-file-excel"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white mb-1.5">Apakah data rekapitulasi bisa diunduh ke Excel?</h3>
                            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                                Ya, sistem menyediakan dua format unduhan: <strong>Microsoft Excel (.xls)</strong> lengkap dengan format tabel formal, dan <strong>CSV Spreadsheet (.csv)</strong> yang dapat dibuka langsung di Google Sheets kapan saja.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chatbot CTA Prompt -->
            <div class="mt-8 p-6 rounded-2xl bg-gradient-to-r from-red-950/70 via-slate-900 to-blue-950/70 border border-red-500/30 text-center reveal">
                <p class="text-white font-bold text-sm mb-1 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-robot text-red-400"></i> Punya pertanyaan lain yang belum terjawab?
                </p>
                <p class="text-slate-300 text-xs mb-4">Gunakan Asisten Virtual Ar-Raudhah interaktif yang selalu siap menjawab 24/7.</p>
                <button type="button" onclick="toggleChatbot()"
                        class="btn-cta inline-flex items-center gap-2 text-white font-bold text-xs sm:text-sm px-5 py-2.5 rounded-xl shadow-lg cursor-pointer">
                    <i class="fa-solid fa-comments"></i> Buka Chatbot Asisten
                </button>
            </div>
        </div>
    </section>

    <!-- ===== TENTANG SECTION ===== -->
    <section id="tentang" class="py-20 bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 relative overflow-hidden">
        <div class="absolute inset-0 islamic-bg opacity-40"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
        
        <div class="max-w-4xl mx-auto px-4 relative z-10">
            <div class="text-center reveal">
                <p class="arabic-shimmer text-3xl font-bold mb-4">اِقْرَأْ بِاسْمِ رَبِّكَ الَّذِيْ خَلَقَ</p>
                <h2 class="text-3xl sm:text-4xl font-black text-white mb-4">
                    Yayasan Cahaya Amanah Ar-Raudhah
                </h2>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto mb-10">
                    Berdedikasi dalam pendidikan Al-Qur'an di Banjarbaru melalui 
                    <strong class="text-amber-300 font-bold">Taman Pendidikan Qur'an (TPQ) Ar-Raudhah</strong> dan 
                    <strong class="text-amber-300 font-bold">Rumah Tahfidz Qur'an (RTQ) Ar-Raudhah</strong>. 
                    Platform ini hadir untuk menjamin akuntabilitas, validitas, dan standar kualitas para santri lulusan.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center backdrop-blur-sm">
                        <i class="fa-solid fa-shield-halved text-2xl text-red-400 mb-3"></i>
                        <p class="font-bold text-white text-sm">Aman &amp; Terverifikasi</p>
                        <p class="text-slate-400 text-xs mt-1">Akses khusus akun panitia &amp; penguji</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center backdrop-blur-sm">
                        <i class="fa-solid fa-calculator text-2xl text-amber-400 mb-3"></i>
                        <p class="font-bold text-white text-sm">Kalkulasi Cepat</p>
                        <p class="text-slate-400 text-xs mt-1">Penghitungan nilai otomatis &amp; akurat</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center backdrop-blur-sm">
                        <i class="fa-solid fa-print text-2xl text-blue-400 mb-3"></i>
                        <p class="font-bold text-white text-sm">Cetak Surat Kelulusan</p>
                        <p class="text-slate-400 text-xs mt-1">Format siap cetak berkop resmi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA FINAL ===== -->
    <section class="py-16 bg-slate-900">
        <div class="max-w-3xl mx-auto px-4 text-center reveal">
            <div class="bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 border border-white/10 rounded-3xl p-8 sm:p-12 shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 islamic-bg opacity-30"></div>
                <div class="absolute -top-10 -right-10 w-48 h-48 bg-red-600/15 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Yayasan" class="w-16 h-16 sm:w-20 sm:h-20 object-contain bg-white rounded-2xl p-1.5 shadow-xl mx-auto mb-5">
                    <h2 class="text-xl sm:text-3xl font-black text-white mb-2">Yayasan Cahaya Amanah Ar-Raudhah</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mb-8 max-w-md mx-auto">
                        Taman Pendidikan Qur'an (TPQ) &amp; Rumah Tahfidz Qur'an (RTQ) Ar-Raudhah Banjarbaru.
                    </p>
                    <a href="{{ route('login') }}"
                        class="btn-cta inline-flex items-center gap-2.5 text-white font-black text-sm sm:text-base px-8 py-3.5 rounded-2xl">
                        <i class="fa-solid fa-right-to-bracket text-lg"></i>
                        Masuk ke Sistem Penilaian
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-slate-950 border-t border-slate-800/80 py-8 text-center text-slate-400">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mb-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain bg-white rounded-lg p-0.5 shadow">
                <span class="text-white font-bold text-sm">Yayasan Cahaya Amanah Ar-Raudhah</span>
                <span class="hidden sm:inline text-slate-600">•</span>
                <span class="text-blue-400 text-xs font-semibold">TPQ &amp; RTQ Ar-Raudhah Banjarbaru</span>
            </div>
            <p class="text-xs text-slate-400">
                Sistem Penilaian Munaqasyah Santri &copy; 2026. Diciptakan &amp; Dikembangkan dengan bangga oleh <strong class="text-white font-bold">Hugo Putra Pratama</strong>.
            </p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 40);
        });

        // Scroll reveal
        const revealEls = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 70);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        revealEls.forEach(el => observer.observe(el));

        // Counter animation
        function animateCounter(el, target, duration = 1800) {
            let start = 0;
            const step = (timestamp) => {
                if (!start) start = timestamp;
                const progress = Math.min((timestamp - start) / duration, 1);
                el.textContent = Math.floor(progress * target);
                if (progress < 1) requestAnimationFrame(step);
                else el.textContent = target;
            };
            requestAnimationFrame(step);
        }
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    animateCounter(el, parseInt(el.dataset.count));
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        document.querySelectorAll('[data-count]').forEach(el => counterObserver.observe(el));

        // Canvas particles
        const canvas = document.getElementById('particles');
        const ctx = canvas.getContext('2d');
        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);
        
        const colors = ['rgba(147,197,253,', 'rgba(252,165,165,', 'rgba(251,191,36,'];
        const pts = Array.from({length: 50}, () => ({
            x: Math.random() * window.innerWidth,
            y: Math.random() * window.innerHeight,
            r: Math.random() * 1.6 + 0.6,
            dx: (Math.random() - 0.5) * 0.4,
            dy: (Math.random() - 0.5) * 0.4,
            color: colors[Math.floor(Math.random() * colors.length)],
            a: Math.random() * 0.4 + 0.15,
        }));
        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            pts.forEach(p => {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = `${p.color}${p.a})`;
                ctx.fill();
                p.x += p.dx; p.y += p.dy;
                if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
            });
            requestAnimationFrame(drawParticles);
        }
        drawParticles();
    </script>

    {{-- Floating FAQ Chatbot Widget (Created by Hugo Putra Pratama) --}}
    @include('partials.chatbot')
</body>
</html>
