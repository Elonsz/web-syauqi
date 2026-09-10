<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Yayasan Cahaya Amanah Ar-Raudhah — Database Sekolah')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        blue: {
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd',
                            400: '#60a5fa', 500: '#2563eb', 600: '#1d4ed8', 700: '#1e40af',
                            800: '#1e3a8a', 900: '#16285a', 950: '#081026',
                        },
                        red: {
                            50: '#fef2f2', 100: '#fee2e2', 200: '#fecaca', 300: '#fca5a5',
                            400: '#f87171', 500: '#ef4444', 600: '#dc2626', 700: '#b91c1c',
                            800: '#991b1b', 900: '#7f1d1d', 950: '#450a0a',
                        },
                        rose: {
                            50: '#fff1f2', 100: '#ffe4e6', 200: '#fecdd3', 300: '#fda4af',
                            400: '#fb7185', 500: '#f43f5e', 600: '#e11d48', 700: '#be123c',
                            800: '#9f1239', 900: '#881337', 950: '#4c0519',
                        },
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        arabic: ['Amiri', 'serif'],
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; color: black !important; }
        }
        .table-custom th, .table-custom td {
            border: 1px solid #cbd5e1;
            padding: 6px 10px;
            font-size: 0.85rem;
        }

        /* ===== SIDEBAR ===== */
        #sidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #sidebar.collapsed {
            width: 72px !important;
        }
        #sidebar.collapsed .sidebar-header {
            padding-left: 0 !important;
            padding-right: 0 !important;
            justify-content: center !important;
        }
        #sidebar.collapsed .sidebar-brand {
            display: none !important;
        }
        #sidebar.collapsed #collapseBtn {
            display: flex !important;
            margin: 0 auto !important;
            width: 42px !important;
            height: 42px !important;
            background: rgba(30, 58, 138, 0.85) !important;
            border: 1.5px solid rgba(220, 38, 38, 0.6) !important;
            color: #ffffff !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 14px rgba(0,0,0,0.3) !important;
            cursor: pointer !important;
        }
        #sidebar.collapsed #collapseBtn:hover {
            background: rgba(220, 38, 38, 0.8) !important;
            color: #ffffff !important;
            transform: scale(1.08);
        }
        #sidebar.collapsed .sidebar-label,
        #sidebar.collapsed .sidebar-section-label,
        #sidebar.collapsed .sidebar-brand-text {
            display: none !important;
        }
        #sidebar.collapsed .sidebar-item {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            gap: 0 !important;
        }
        #sidebar.collapsed .sidebar-item i {
            font-size: 1.15rem;
            margin: 0 auto;
        }
        #sidebar.collapsed .sidebar-footer button {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            gap: 0 !important;
        }
        #sidebar.collapsed .sidebar-footer button i {
            font-size: 1.15rem;
            margin: 0 auto;
        }

        .sidebar-item {
            transition: all 0.15s ease;
        }
        .sidebar-item:hover {
            background: #f1f5f9;
            color: #1e3a8a;
        }
        .sidebar-item.active {
            background: #eff6ff;
            border-left: 3px solid #2563eb;
        }
        .sidebar-item.active i { color: #2563eb; }
        .sidebar-item.active span { color: #1e3a8a; font-weight: 700; }

        /* ===== PAGE TRANSITION ===== */
        #page-overlay {
            position: fixed; inset: 0; z-index: 9999;
            pointer-events: none;
            background: #fff;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        #page-overlay.fade-in  { opacity: 0.4; pointer-events: all; }

        #page-progress {
            position: fixed; top: 0; left: 0;
            height: 2px; width: 0%;
            background: #2563eb;
            z-index: 10000;
            transition: width 0.3s ease;
            border-radius: 0 2px 2px 0;
        }

        #main-content {
            animation: contentIn 0.35s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes contentIn {
            from { opacity:0; transform:translateY(12px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* ===== LOGOUT MODAL ===== */
        #logout-modal { opacity:0; pointer-events:none; transition:opacity 0.2s ease; }
        #logout-modal.show { opacity:1; pointer-events:all; }
        #logout-modal .modal-card { transform:scale(0.92) translateY(16px); transition:transform 0.25s cubic-bezier(0.16,1,0.3,1); }
        #logout-modal.show .modal-card { transform:scale(1) translateY(0); }

        /* Mobile overlay */
        #sidebar-overlay {
            display: none;
            position: fixed; inset: 0; z-index: 39;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(2px);
        }
        @media (max-width: 1024px) {
            #sidebar {
                position: fixed !important;
                height: 100vh !important;
                z-index: 40 !important;
                transform: translateX(-100%);
            }
            #sidebar.mobile-open {
                transform: translateX(0);
            }
            #sidebar-overlay.active { display: block; }
        }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased overflow-x-hidden">

    <!-- Page Transition -->
    <div id="page-overlay"></div>
    <div id="page-progress"></div>

    <!-- ===== LOGOUT MODAL ===== -->
    <div id="logout-modal" class="fixed inset-0 z-[9998] flex items-center justify-center p-4" role="dialog" aria-modal="true">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeLogoutModal()"></div>
        <div class="modal-card relative bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden">
            <div class="h-1.5 bg-slate-700"></div>
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="w-16 h-16 rounded-2xl bg-red-50 border-2 border-red-100 flex items-center justify-center">
                        <i class="fa-solid fa-right-from-bracket text-2xl text-red-500"></i>
                    </div>
                </div>
                <div class="text-center mb-6">
                    <h3 class="text-lg font-black text-slate-800">Keluar dari Sistem?</h3>
                    <p class="text-sm text-slate-500 mt-1.5 leading-relaxed">
                        Kamu akan keluar dari sistem <span class="font-bold text-blue-900">Yayasan Cahaya Amanah Ar-Raudhah</span>.<br>
                        Pastikan semua data penilaian sudah tersimpan.
                    </p>
                </div>
                <div class="flex gap-3">
                    <button onclick="closeLogoutModal()"
                        class="flex-1 py-2.5 rounded-xl text-sm font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </button>
                    <button onclick="confirmLogout()" id="confirmLogoutBtn"
                        class="flex-1 py-2.5 rounded-xl text-sm font-bold text-white bg-rose-600 hover:bg-rose-700 shadow-sm transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-from-bracket" id="logoutBtnIcon"></i>
                        <span id="logoutBtnText">Ya, Keluar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" onclick="closeMobileSidebar()"></div>

    <div class="flex min-h-screen">

        <!-- ===== SIDEBAR ===== -->
        <aside id="sidebar" class="no-print bg-white text-slate-700 flex flex-col w-64 shrink-0 relative border-r border-slate-200 shadow-sm">

            <!-- Brand -->
            <div class="sidebar-header flex items-center justify-between px-3.5 py-3.5 border-b border-slate-200 min-h-[60px] transition-all duration-300">
                <a href="{{ route('dashboard') }}" class="sidebar-brand flex items-center gap-3 min-w-0 transition-all duration-300">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Yayasan" class="w-9 h-9 object-contain bg-slate-50 border border-slate-200 rounded-xl p-0.5 shrink-0">
                    <div class="sidebar-brand-text transition-all duration-300 overflow-hidden">
                        <p class="text-xs font-black text-slate-800 leading-tight tracking-tight">AR-RAUDHAH</p>
                        <p class="text-[9px] text-slate-400 leading-tight truncate">Cahaya Amanah</p>
                    </div>
                </a>
                <!-- Collapse toggle (desktop) -->
                <button onclick="toggleSidebar()" id="collapseBtn"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 transition flex items-center justify-center shrink-0 hidden lg:flex"
                    title="Kecilkan sidebar">
                    <i class="fa-solid fa-angles-left text-xs" id="collapseIcon"></i>
                </button>

                <!-- Close button (mobile) -->
                <button onclick="closeMobileSidebar()"
                    class="ml-auto w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-800 transition shrink-0 lg:hidden"
                    title="Tutup menu">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Nav -->
            <nav class="flex-1 py-4 px-2 overflow-y-auto space-y-0.5">

                <!-- Overview -->
                <p class="sidebar-section-label text-[9px] font-bold text-slate-400 uppercase tracking-widest px-3 py-2 transition-all duration-300">Overview</p>
                <a href="{{ route('dashboard') }}"
                   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-800 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high w-5 text-center shrink-0 text-slate-400"></i>
                    <span class="sidebar-label transition-all duration-300">Dashboard</span>
                </a>

                <!-- Biodata Santri -->
                <p class="sidebar-section-label text-[9px] font-bold text-slate-400 uppercase tracking-widest px-3 pt-4 pb-2 transition-all duration-300">Biodata Santri</p>
                <a href="{{ route('santri.index') }}"
                   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-800 {{ request()->routeIs('santri.index') || request()->routeIs('santri.show') || request()->routeIs('santri.edit') ? 'active' : '' }}"
                   title="Direktori Biodata Siswa">
                    <i class="fa-solid fa-address-card w-5 text-center shrink-0 text-slate-400"></i>
                    <span class="sidebar-label transition-all duration-300">Direktori Biodata</span>
                </a>
                <a href="{{ route('santri.create') }}"
                   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-800 {{ request()->routeIs('santri.create') ? 'active' : '' }}"
                   title="Tambah Biodata Santri Baru">
                    <i class="fa-solid fa-user-plus w-5 text-center shrink-0 text-slate-400"></i>
                    <span class="sidebar-label transition-all duration-300">Tambah Biodata</span>
                </a>

                <!-- Penilaian -->
                <p class="sidebar-section-label text-[9px] font-bold text-slate-400 uppercase tracking-widest px-3 pt-4 pb-2 transition-all duration-300">Penilaian</p>
                @php
                    $isCreatePage = request()->routeIs('database sekolah.create');
                    $currJenis = request('jenis', isset($santri) ? ($santri->jenis ?? 'TPQ') : 'TPQ');
                    $isTpqActive = !$isCreatePage && request()->is('database sekolah*') && $currJenis === 'TPQ';
                    $isRtqActive = !$isCreatePage && request()->is('database sekolah*') && $currJenis === 'RTQ';
                    $isCreateTpqActive = $isCreatePage && request('jenis', 'TPQ') === 'TPQ';
                    $isCreateRtqActive = $isCreatePage && request('jenis') === 'RTQ';
                @endphp
                <a href="{{ route('database sekolah.index', ['jenis' => 'TPQ']) }}"
                   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-800 {{ $isTpqActive ? 'active' : '' }}"
                   title="Taman Pendidikan Qur'an Ar-Raudhah">
                    <i class="fa-solid fa-scroll w-5 text-center shrink-0 text-slate-400"></i>
                    <span class="sidebar-label transition-all duration-300">TPQ Ar-Raudhah</span>
                </a>
                <a href="{{ route('database sekolah.index', ['jenis' => 'RTQ']) }}"
                   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-800 {{ $isRtqActive ? 'active' : '' }}"
                   title="Rumah Tahfidz Qur'an Ar-Raudhah">
                    <i class="fa-solid fa-book-quran w-5 text-center shrink-0 text-slate-400"></i>
                    <span class="sidebar-label transition-all duration-300">RTQ Ar-Raudhah</span>
                </a>

                <!-- Input Data -->
                <p class="sidebar-section-label text-[9px] font-bold text-slate-400 uppercase tracking-widest px-3 pt-4 pb-2 transition-all duration-300">Input Data</p>
                @php $navJenis = request('jenis', 'TPQ'); @endphp
                <a href="{{ route('database sekolah.create', ['jenis' => 'TPQ']) }}"
                   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-800 {{ $isCreateTpqActive ? 'active' : '' }}">
                    <i class="fa-solid fa-user-plus w-5 text-center shrink-0 text-slate-400"></i>
                    <span class="sidebar-label transition-all duration-300">Input TPQ Ar-Raudhah</span>
                </a>
                <a href="{{ route('database sekolah.create', ['jenis' => 'RTQ']) }}"
                   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-800 {{ $isCreateRtqActive ? 'active' : '' }}">
                    <i class="fa-solid fa-user-plus w-5 text-center shrink-0 text-slate-400"></i>
                    <span class="sidebar-label transition-all duration-300">Input RTQ Ar-Raudhah</span>
                </a>

                <!-- Export -->
                <p class="sidebar-section-label text-[9px] font-bold text-slate-400 uppercase tracking-widest px-3 pt-4 pb-2 transition-all duration-300">Export</p>
                @php $navUnit = request('unit'); @endphp
                <a href="{{ route('database sekolah.export.excel', ['jenis' => $navJenis, 'unit' => $navUnit]) }}"
                   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-800">
                    <i class="fa-solid fa-file-excel w-5 text-center shrink-0 text-emerald-400"></i>
                    <span class="sidebar-label transition-all duration-300">Export Excel</span>
                </a>
                <a href="{{ route('database sekolah.export.csv', ['jenis' => $navJenis, 'unit' => $navUnit]) }}"
                   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-800">
                    <i class="fa-solid fa-table w-5 text-center shrink-0 text-slate-400"></i>
                    <span class="sidebar-label transition-all duration-300">Export Spreadsheet</span>
                </a>

                <!-- Pengaturan -->
                <p class="sidebar-section-label text-[9px] font-bold text-slate-400 uppercase tracking-widest px-3 pt-4 pb-2 transition-all duration-300">Pengaturan</p>
                <a href="{{ route('users.index') }}"
                   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-800 {{ request()->routeIs('users.*') ? 'active' : '' }}"
                   title="Kelola Pengguna Sistem">
                    <i class="fa-solid fa-users-gear w-5 text-center shrink-0 text-slate-400"></i>
                    <span class="sidebar-label transition-all duration-300">Kelola Pengguna</span>
                </a>
                <a href="{{ route('settings.index') }}"
                   class="sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-800 {{ request()->routeIs('settings.*') ? 'active' : '' }}"
                   title="Pengaturan Kop Surat & Identitas">
                    <i class="fa-solid fa-sliders w-5 text-center shrink-0 text-slate-400"></i>
                    <span class="sidebar-label transition-all duration-300">Pengaturan Surat</span>
                </a>
            </nav>

            <!-- Sidebar Footer -->
            <div class="sidebar-footer border-t border-slate-200 p-3 text-center">
                <div class="sidebar-label px-2 transition-all duration-300 overflow-hidden">
                    <p class="text-[10px] text-slate-700 font-bold uppercase tracking-wider">AR-RAUDHAH</p>
                    <p class="text-[9px] text-slate-400 mt-0.5">&copy; 2026 Yayasan Cahaya Amanah</p>
                    <p class="text-[8.5px] text-slate-400 mt-1">by <span class="text-blue-600 font-semibold">Hugo Putra Pratama</span></p>
                </div>
            </div>
        </aside>

        <!-- ===== MAIN AREA ===== -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Top Bar -->
            <header class="no-print bg-white border-b border-slate-200 shadow-xs sticky top-0 z-30 h-14 flex items-center px-3 sm:px-4 gap-2 sm:gap-3">
                <!-- Mobile hamburger -->
                <button onclick="openMobileSidebar()" id="mobileMenuBtn" class="lg:hidden w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-700 transition shrink-0">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- Desktop Sidebar Toggle Button -->
                <button onclick="toggleSidebar()" id="topbarToggleBtn"
                    class="hidden lg:flex w-9 h-9 rounded-xl bg-slate-100 hover:bg-blue-50 hover:text-blue-800 items-center justify-center text-slate-600 transition shrink-0"
                    title="Kecilkan / Perbesar Sidebar">
                    <i class="fa-solid fa-bars-staggered text-sm" id="topbarCollapseIcon"></i>
                </button>

                <!-- Brand name on mobile (when sidebar hidden) -->
                <a href="{{ route('dashboard') }}" class="lg:hidden flex items-center gap-2 shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-7 h-7 object-contain bg-white rounded-lg p-0.5 shadow-xs">
                    <div>
                        <span class="text-xs font-black text-slate-900 tracking-tight leading-none block">AR-RAUDHAH</span>
                        <span class="text-[8px] text-slate-500 font-semibold leading-none block">Cahaya Amanah</span>
                    </div>
                </a>

                <!-- Breadcrumb (desktop) -->
                <div class="hidden lg:flex items-center gap-2 text-xs text-slate-500 flex-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-900 transition font-medium">
                        <i class="fa-solid fa-house"></i>
                    </a>
                    @hasSection('breadcrumb')
                        <i class="fa-solid fa-chevron-right text-[9px]"></i>
                        @yield('breadcrumb')
                    @endif
                </div>

                <!-- Spacer mobile -->
                <div class="flex-1 lg:hidden"></div>

                <!-- Right side -->
                <div class="flex items-center gap-1.5 sm:gap-2">
                    {{-- Tab TPQ/RTQ (database sekolah pages) --}}
                    @if(request()->is('database sekolah*'))
                    <div class="inline-flex bg-slate-100 p-0.5 rounded-lg border border-slate-200">
                        <a href="{{ route('database sekolah.index', ['jenis' => 'TPQ']) }}"
                           class="px-2.5 sm:px-3 py-1.5 rounded-md text-xs font-semibold transition {{ request('jenis','TPQ') == 'TPQ' ? 'bg-white text-blue-700 shadow-sm border border-slate-200' : 'text-slate-500 hover:text-slate-700' }}">
                            <i class="fa-solid fa-scroll"></i><span class="hidden sm:inline ml-1.5">TPQ</span>
                        </a>
                        <a href="{{ route('database sekolah.index', ['jenis' => 'RTQ']) }}"
                           class="px-2.5 sm:px-3 py-1.5 rounded-md text-xs font-semibold transition {{ request('jenis') == 'RTQ' ? 'bg-white text-emerald-700 shadow-sm border border-slate-200' : 'text-slate-500 hover:text-slate-700' }}">
                            <i class="fa-solid fa-book-quran"></i><span class="hidden sm:inline ml-1.5">RTQ</span>
                        </a>
                    </div>
                    @endif

                    <!-- User Profile Dropdown -->
                    <div class="relative" id="userDropdownWrapper">
                        <button onclick="toggleUserDropdown(event)" id="userDropdownBtn"
                            class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 border border-slate-200 rounded-xl px-2.5 py-1.5 transition select-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500/30"
                            aria-expanded="false" aria-haspopup="true">
                            <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-lg bg-slate-800 text-white flex items-center justify-center text-xs font-bold shrink-0">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <div class="text-left hidden sm:block">
                                <p class="text-xs font-semibold text-slate-800 leading-none capitalize">{{ session('user_name', 'Admin') }}</p>
                                <p class="text-[9px] text-emerald-600 font-semibold leading-none mt-0.5">● Online</p>
                            </div>
                            <span class="w-2 h-2 bg-emerald-400 rounded-full sm:hidden shrink-0"></span>
                            <i class="fa-solid fa-chevron-down text-[9px] text-slate-400 transition-transform duration-200 hidden sm:inline-block" id="userDropdownChevron"></i>
                        </button>

                        <!-- Dropdown Menu Card -->
                        <div id="userDropdownMenu"
                            class="hidden absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-slate-200/90 py-1.5 z-50 transition-all origin-top-right">
                            
                            <!-- Header Info -->
                            <div class="px-3.5 py-2.5 border-b border-slate-100 bg-slate-50/70 rounded-t-xl">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <p class="text-xs font-black text-slate-800 capitalize">{{ session('user_name', 'Admin') }}</p>
                                </div>
                                <p class="text-[10px] text-slate-700 font-bold">Yayasan Cahaya Amanah Ar-Raudhah</p>
                                <p class="text-[9px] text-slate-400">Banjarbaru - Kalimantan Selatan</p>
                            </div>

                            <!-- Menu Items -->
                            <div class="p-1 space-y-0.5">
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100 rounded-xl transition">
                                    <i class="fa-solid fa-gauge-high text-slate-500 w-4 text-center"></i>
                                    Dashboard
                                </a>
                                <a href="{{ route('santri.index') }}" class="flex items-start gap-2.5 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100 rounded-xl transition">
                                    <i class="fa-solid fa-address-card text-blue-600 w-4 text-center mt-0.5 shrink-0"></i>
                                    <div>
                                        <p class="font-bold text-slate-800 leading-tight">Biodata Santri</p>
                                        <p class="text-[10px] text-slate-400 font-normal">Direktori Data Pokok</p>
                                    </div>
                                </a>
                                <a href="{{ route('database sekolah.index', ['jenis' => 'TPQ']) }}" class="flex items-start gap-2.5 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100 rounded-xl transition">
                                    <i class="fa-solid fa-scroll text-amber-500 w-4 text-center mt-0.5 shrink-0"></i>
                                    <div>
                                        <p class="font-bold text-slate-800 leading-tight">TPQ Ar-Raudhah</p>
                                        <p class="text-[10px] text-slate-400 font-normal">Taman Pendidikan Qur'an</p>
                                    </div>
                                </a>
                                <a href="{{ route('database sekolah.index', ['jenis' => 'RTQ']) }}" class="flex items-start gap-2.5 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100 rounded-xl transition">
                                    <i class="fa-solid fa-book-quran text-emerald-600 w-4 text-center mt-0.5 shrink-0"></i>
                                    <div>
                                        <p class="font-bold text-slate-800 leading-tight">RTQ Ar-Raudhah</p>
                                        <p class="text-[10px] text-slate-400 font-normal">Rumah Tahfidz Qur'an</p>
                                    </div>
                                </a>
                                <a href="{{ route('users.index') }}" class="flex items-start gap-2.5 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100 rounded-xl transition">
                                    <i class="fa-solid fa-users-gear text-slate-500 w-4 text-center mt-0.5 shrink-0"></i>
                                    <div>
                                        <p class="font-bold text-slate-800 leading-tight">Kelola Pengguna</p>
                                        <p class="text-[10px] text-slate-400 font-normal">Manajemen Akun &amp; Hak Akses</p>
                                    </div>
                                </a>
                            </div>

                            <div class="border-t border-slate-100 my-1"></div>

                            <!-- Logout Action -->
                            <div class="p-1">
                                <button onclick="openLogoutModal(); closeUserDropdown();"
                                    class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50 hover:text-rose-700 rounded-xl transition cursor-pointer">
                                    <i class="fa-solid fa-right-from-bracket text-rose-500 w-4 text-center"></i>
                                    Keluar / Logout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-5 sm:p-6" id="main-content">
                @if(session('success'))
                <div class="mb-5 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm flex items-center justify-between no-print" id="flash-success">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                        <p class="text-sm font-medium text-emerald-900">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 ml-4">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-5 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm flex items-center justify-between no-print">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-exclamation text-red-600 text-lg"></i>
                        <p class="text-sm font-medium text-red-900">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-700 ml-4">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="no-print bg-white border-t border-slate-200 py-3 px-6 text-xs text-slate-400 flex flex-col sm:flex-row items-center justify-between gap-1">
                <span>&copy; 2026 Yayasan Cahaya Amanah Ar-Raudhah • Banjarbaru</span>
                <span class="text-slate-500 font-medium">Database Sekolah Ar-Raudhah v1.0</span>
            </footer>
        </div>
    </div>

    @yield('scripts')

    <script>
        // ==============================
        // SIDEBAR COLLAPSE (desktop)
        // ==============================
        let sidebarCollapsed = false;

        function applySidebarState() {
            const sidebar = document.getElementById('sidebar');
            const collapseBtn = document.getElementById('collapseBtn');
            const collapseIcon = document.getElementById('collapseIcon');
            const topbarIcon = document.getElementById('topbarCollapseIcon');
            const topbarBtn = document.getElementById('topbarToggleBtn');

            if (!sidebar) return;

            if (sidebarCollapsed) {
                sidebar.classList.add('collapsed');
                if (collapseIcon) collapseIcon.className = 'fa-solid fa-angles-right text-sm';
                if (collapseBtn) collapseBtn.setAttribute('title', 'Perbesar sidebar');
                if (topbarIcon) topbarIcon.className = 'fa-solid fa-bars text-sm';
                if (topbarBtn) topbarBtn.setAttribute('title', 'Perbesar sidebar');
            } else {
                sidebar.classList.remove('collapsed');
                if (collapseIcon) collapseIcon.className = 'fa-solid fa-angles-left text-xs';
                if (collapseBtn) collapseBtn.setAttribute('title', 'Kecilkan sidebar');
                if (topbarIcon) topbarIcon.className = 'fa-solid fa-bars-staggered text-sm';
                if (topbarBtn) topbarBtn.setAttribute('title', 'Kecilkan sidebar');
            }
        }

        function toggleSidebar() {
            sidebarCollapsed = !sidebarCollapsed;
            applySidebarState();
            try {
                localStorage.setItem('sidebar_collapsed', sidebarCollapsed ? 'true' : 'false');
            } catch (e) {}
        }

        // Restore state on initial load
        try {
            if (localStorage.getItem('sidebar_collapsed') === 'true') {
                sidebarCollapsed = true;
                applySidebarState();
            }
        } catch (e) {}

        // Otomatis bersihkan state drawer mobile jika layar dibesarkan ke desktop
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024) {
                closeMobileSidebar();
            }
        });

        // ==============================
        // MOBILE SIDEBAR
        // ==============================
        function openMobileSidebar() {
            document.getElementById('sidebar').classList.add('mobile-open');
            document.getElementById('sidebar-overlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        function closeMobileSidebar() {
            document.getElementById('sidebar').classList.remove('mobile-open');
            document.getElementById('sidebar-overlay').classList.remove('active');
            document.body.style.overflow = '';
        }

        // ==============================
        // USER PROFILE DROPDOWN
        // ==============================
        function toggleUserDropdown(event) {
            if (event) event.stopPropagation();
            const menu = document.getElementById('userDropdownMenu');
            const chevron = document.getElementById('userDropdownChevron');
            if (!menu) return;

            const isHidden = menu.classList.contains('hidden');
            if (isHidden) {
                menu.classList.remove('hidden');
                if (chevron) chevron.style.transform = 'rotate(180deg)';
            } else {
                closeUserDropdown();
            }
        }

        function closeUserDropdown() {
            const menu = document.getElementById('userDropdownMenu');
            const chevron = document.getElementById('userDropdownChevron');
            if (menu) menu.classList.add('hidden');
            if (chevron) chevron.style.transform = 'rotate(0deg)';
        }

        document.addEventListener('click', function (e) {
            const wrapper = document.getElementById('userDropdownWrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                closeUserDropdown();
            }
        });

        // ==============================
        // LOGOUT MODAL
        // ==============================
        function openLogoutModal() {
            closeUserDropdown();
            document.getElementById('logout-modal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }
        function closeLogoutModal() {
            document.getElementById('logout-modal').classList.remove('show');
            document.body.style.overflow = '';
        }
        function confirmLogout() {
            const btn = document.getElementById('confirmLogoutBtn');
            document.getElementById('logoutBtnIcon').className = 'fa-solid fa-spinner fa-spin';
            document.getElementById('logoutBtnText').textContent = 'Keluar...';
            btn.disabled = true;
            document.getElementById('logout-form').submit();
        }
        document.addEventListener('keydown', e => { 
            if (e.key === 'Escape') {
                closeLogoutModal();
                closeUserDropdown();
            }
        });

        // ==============================
        // PAGE TRANSITION
        // ==============================
        const overlay  = document.getElementById('page-overlay');
        const progress = document.getElementById('page-progress');

        function startTransition(href) {
            progress.style.width = '0%';
            progress.style.opacity = '1';
            setTimeout(() => progress.style.width = '70%', 10);
            overlay.classList.add('fade-in');
            setTimeout(() => {
                progress.style.width = '100%';
                setTimeout(() => window.location.href = href, 150);
            }, 260);
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('a[href]').forEach(link => {
                const href = link.getAttribute('href');
                if (!href || href.startsWith('http') || href.startsWith('#')
                    || href.startsWith('mailto:') || href.startsWith('tel:')
                    || link.hasAttribute('download') || link.target === '_blank'
                    || href.includes('/export/')) return;
                link.addEventListener('click', e => { e.preventDefault(); startTransition(href); });
            });
            window.addEventListener('pageshow', e => {
                if (e.persisted) { overlay.classList.remove('fade-in'); progress.style.opacity = '0'; }
            });
        });

        window.addEventListener('load', function () {
            progress.style.width = '100%';
            setTimeout(() => { progress.style.opacity = '0'; }, 400);
            overlay.classList.remove('fade-in');

            // Flash auto dismiss
            setTimeout(() => {
                const flash = document.getElementById('flash-success');
                if (flash) { flash.style.opacity = '0'; flash.style.transition = 'opacity 0.5s'; setTimeout(() => flash.remove(), 500); }
            }, 5000);
        });
    </script>

    {{-- Floating FAQ Chatbot Widget (Created by Hugo Putra Pratama) --}}
    @include('partials.chatbot')
</body>
</html>
