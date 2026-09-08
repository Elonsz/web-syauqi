<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Penilaian Munaqasyah TPQ & RTQ')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        arabic: ['Amiri', 'serif'],
                    },
                    colors: {
                        blue: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#2563eb',
                            600: '#1d4ed8',
                            700: '#1e40af',
                            800: '#1e3a8a',
                            900: '#16285a',
                            950: '#081026',
                        },
                        red: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                            950: '#450a0a',
                        },
                        rose: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            200: '#fecdd3',
                            300: '#fda4af',
                            400: '#fb7185',
                            500: '#f43f5e',
                            600: '#e11d48',
                            700: '#be123c',
                            800: '#9f1239',
                            900: '#881337',
                            950: '#4c0519',
                        },
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#2563eb',
                            600: '#1d4ed8',
                            700: '#1e40af',
                            800: '#1e3a8a',
                            900: '#16285a',
                        },
                        munaqasyah: {
                            yellow: '#FEF08A',
                            yellowDark: '#EAB308',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; color: black !important; }
            .print-full { width: 100% !important; margin: 0 !important; padding: 0 !important; }
        }
        .table-custom th, .table-custom td {
            border: 1px solid #cbd5e1;
            padding: 6px 10px;
            font-size: 0.85rem;
        }

        /* ===== PAGE TRANSITION ===== */
        #page-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            pointer-events: none;
            background: linear-gradient(135deg, #081026, #16285a, #dc2626);
            opacity: 0;
            transition: opacity 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #page-overlay.fade-in  { opacity: 1; pointer-events: all; }
        #page-overlay.fade-out { opacity: 0; pointer-events: none; }

        /* Progress bar */
        #page-progress {
            position: fixed;
            top: 0; left: 0;
            height: 3px;
            width: 0%;
            background: linear-gradient(90deg, #dc2626, #2563eb, #dc2626);
            background-size: 200% auto;
            animation: progressShimmer 1.2s linear infinite;
            z-index: 10000;
            transition: width 0.3s ease;
            border-radius: 0 2px 2px 0;
            box-shadow: 0 0 8px rgba(220, 38, 38, 0.7);
        }
        @keyframes progressShimmer {
            from { background-position: 0% center; }
            to   { background-position: 200% center; }
        }

        /* Content fade-in on load */
        #main-content {
            animation: contentAppear 0.35s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        @keyframes contentAppear {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ===== LOGOUT MODAL ===== */
        #logout-modal {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }
        #logout-modal.show {
            opacity: 1;
            pointer-events: all;
        }
        #logout-modal .modal-card {
            transform: scale(0.92) translateY(16px);
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        #logout-modal.show .modal-card {
            transform: scale(1) translateY(0);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col antialiased">

    <!-- Page Transition Overlay -->
    <div id="page-overlay"></div>
    <!-- Progress Bar -->
    <div id="page-progress"></div>

    <!-- ===== LOGOUT CONFIRM MODAL ===== -->
    <div id="logout-modal" class="fixed inset-0 z-[9998] flex items-center justify-center p-4" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeLogoutModal()"></div>
        <!-- Card -->
        <div class="modal-card relative bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
            <!-- Top accent bar -->
            <div class="h-1.5 bg-gradient-to-r from-red-500 via-rose-500 to-red-600"></div>
            <div class="p-6">
                <!-- Icon -->
                <div class="flex items-center justify-center mb-4">
                    <div class="w-16 h-16 rounded-2xl bg-red-50 border-2 border-red-100 flex items-center justify-center">
                        <i class="fa-solid fa-right-from-bracket text-2xl text-red-500"></i>
                    </div>
                </div>
                <!-- Text -->
                <div class="text-center mb-6">
                    <h3 class="text-lg font-black text-slate-800">Keluar dari Sistem?</h3>
                    <p class="text-sm text-slate-500 mt-1.5 leading-relaxed">
                        Kamu akan keluar dari <span class="font-bold text-blue-900">SIMUNAQASYAH</span>.<br>
                        Pastikan semua data sudah tersimpan sebelum keluar.
                    </p>
                </div>
                <!-- Actions -->
                <div class="flex gap-3">
                    <button onclick="closeLogoutModal()"
                        class="flex-1 py-2.5 rounded-xl text-sm font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </button>
                    <button onclick="confirmLogout()"
                        id="confirmLogoutBtn"
                        class="flex-1 py-2.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 shadow-lg hover:shadow-red-200 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-from-bracket" id="logoutBtnIcon"></i>
                        <span id="logoutBtnText">Ya, Keluar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <!-- Navbar -->
    <header class="bg-gradient-to-r from-[#081026] via-[#0D1C44] to-[#1E3A8A] text-white shadow-lg sticky top-0 z-50 no-print border-b border-[#1E3A8A]/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-xl bg-white p-1 flex items-center justify-center font-bold text-xl shadow-md group-hover:scale-105 transition-transform border border-[#1E3A8A]">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h1 class="text-base font-bold tracking-tight text-white flex items-center gap-2">
                                AR-RAUDHAH
                                <span class="text-xs bg-[#dc2626] text-white font-black px-2 py-0.5 rounded-full uppercase shadow">MUNAQASYAH</span>
                            </h1>
                            <p class="text-xs text-blue-200">Yayasan Cahaya Amanah Banjarbaru</p>
                        </div>
                    </a>
                    <a href="{{ route('dashboard') }}" title="Dashboard"
                       class="px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : 'text-blue-200 hover:bg-[#1E3A8A] hover:text-white' }}">
                        <i class="fa-solid fa-gauge-high"></i> Dashboard
                    </a>
                </div>

                <div class="flex items-center gap-2">
                    {{-- Tab Switch TPQ / RTQ --}}
                    <div class="inline-flex bg-[#081026]/80 p-1 rounded-xl border border-blue-900/60">
                        <a href="{{ route('munaqasyah.index', ['jenis' => 'TPQ']) }}"
                           class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ request('jenis', 'TPQ') == 'TPQ' ? 'bg-[#1E3A8A] text-white shadow' : 'text-blue-200 hover:bg-[#1E3A8A]/50' }}">
                            <i class="fa-solid fa-scroll"></i> Tab TPQ
                        </a>
                        <a href="{{ route('munaqasyah.index', ['jenis' => 'RTQ']) }}"
                           class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ request('jenis') == 'RTQ' ? 'bg-[#dc2626] text-white shadow' : 'text-red-200 hover:bg-[#dc2626]/50' }}">
                            <i class="fa-solid fa-book-quran"></i> Tab RTQ
                        </a>
                    </div>

                    {{-- Export Buttons --}}
                    @php $navJenis = request('jenis', 'TPQ'); $navUnit = request('unit'); @endphp
                    <a href="{{ route('munaqasyah.export.excel', ['jenis' => $navJenis, 'unit' => $navUnit]) }}"
                       class="bg-emerald-600 hover:bg-emerald-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 shadow-sm"
                       title="Download Excel">
                        <i class="fa-solid fa-file-excel text-emerald-200"></i> Export Excel
                    </a>
                    <a href="{{ route('munaqasyah.export.csv', ['jenis' => $navJenis, 'unit' => $navUnit]) }}"
                       class="bg-[#1E3A8A] hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 shadow-sm border border-blue-400/40"
                       title="Download Spreadsheet / CSV">
                        <i class="fa-solid fa-table text-blue-200"></i> Export Spreadsheet
                    </a>

                    {{-- Input Santri & Foto --}}
                    <a href="{{ route('munaqasyah.create', ['jenis' => $navJenis]) }}"
                       class="bg-[#dc2626] hover:bg-red-700 text-white px-3.5 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
                        <i class="fa-solid fa-user-plus"></i> Input Santri &amp; Foto
                    </a>

                    {{-- Logout Button --}}
                    <div class="border-l border-blue-800/60 pl-2 ml-1">
                        <button type="button" onclick="openLogoutModal()" title="Keluar dari sistem"
                            class="flex items-center gap-1.5 text-xs font-bold text-red-300 hover:text-white hover:bg-red-600/40 px-3 py-1.5 rounded-lg transition">
                            <i class="fa-solid fa-right-from-bracket"></i> Keluar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6" id="main-content">
        @if(session('success'))
            <div class="mb-5 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm flex items-center justify-between no-print" id="flash-success">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-xl mr-3"></i>
                    <p class="text-sm font-medium text-emerald-900">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-4 text-center text-xs text-slate-500 no-print">
        <p>&copy; 2026 Yayasan Cahaya Amanah Ar-Raudhah Banjarbaru. Sistem Penilaian Munaqasyah Santri.</p>
    </footer>

    @yield('scripts')

    <script>
        // =============================================
        // LOGOUT MODAL
        // =============================================
        function openLogoutModal() {
            const modal = document.getElementById('logout-modal');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logout-modal');
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }

        function confirmLogout() {
            const btn = document.getElementById('confirmLogoutBtn');
            const icon = document.getElementById('logoutBtnIcon');
            const text = document.getElementById('logoutBtnText');
            icon.className = 'fa-solid fa-spinner fa-spin';
            text.textContent = 'Keluar...';
            btn.disabled = true;
            // Submit the hidden form
            document.getElementById('logout-form').submit();
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLogoutModal();
        });

        // =============================================
        // PAGE TRANSITION
        // =============================================
        const overlay   = document.getElementById('page-overlay');
        const progress  = document.getElementById('page-progress');

        function startTransition(href) {
            // Start progress bar
            progress.style.width = '0%';
            progress.style.opacity = '1';
            setTimeout(() => { progress.style.width = '70%'; }, 10);

            // Fade overlay in
            overlay.classList.add('fade-in');
            overlay.classList.remove('fade-out');

            setTimeout(() => {
                progress.style.width = '100%';
                setTimeout(() => {
                    window.location.href = href;
                }, 150);
            }, 280);
        }

        // Intercept all internal navigation links
        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('a[href]');
            links.forEach(link => {
                const href = link.getAttribute('href');
                // Skip: external, hash-only, download, mailto, tel, print, export
                if (!href
                    || href.startsWith('http') && !href.includes(window.location.host)
                    || href.startsWith('#')
                    || href.startsWith('mailto:')
                    || href.startsWith('tel:')
                    || link.hasAttribute('download')
                    || link.getAttribute('target') === '_blank'
                    || href.includes('/export/')
                ) return;

                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    startTransition(href);
                });
            });

            // Handle browser back/forward: remove overlay
            window.addEventListener('pageshow', function (e) {
                if (e.persisted) {
                    overlay.classList.remove('fade-in');
                    overlay.classList.add('fade-out');
                    progress.style.width = '0%';
                    progress.style.opacity = '0';
                }
            });
        });

        // Page enter: finish progress bar
        window.addEventListener('load', function () {
            progress.style.width = '100%';
            setTimeout(() => {
                progress.style.opacity = '0';
                progress.style.transition = 'opacity 0.4s ease, width 0.3s ease';
            }, 400);

            // Remove overlay on page load
            overlay.classList.remove('fade-in');
            overlay.classList.add('fade-out');
        });

        // Flash message auto-dismiss after 5s
        setTimeout(() => {
            const flash = document.getElementById('flash-success');
            if (flash) {
                flash.style.transition = 'opacity 0.5s ease, max-height 0.5s ease';
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }
        }, 5000);
    </script>
</body>
</html>
