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
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        arabic: ['Amiri', 'serif'],
                    },
                    colors: {
                        brand: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
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
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col antialiased">
    <!-- Navbar -->
    <header class="bg-gradient-to-r from-emerald-800 to-teal-900 text-white shadow-lg sticky top-0 z-50 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-400 text-emerald-950 flex items-center justify-center font-bold text-xl shadow-md">
                        <i class="fa-solid fa-quran"></i>
                    </div>
                    <div>
                        <h1 class="text-base font-bold tracking-tight text-white flex items-center gap-2">
                            SIMUNAQASYAH
                            <span class="text-xs bg-amber-400 text-emerald-950 font-bold px-2 py-0.5 rounded-full uppercase">KOTA 2026</span>
                        </h1>
                        <p class="text-xs text-emerald-200">Sistem Penilaian & Kelulusan TPQ - RTQ</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('munaqasyah.index', ['jenis' => 'TPQ']) }}" 
                       class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition {{ request('jenis', 'TPQ') == 'TPQ' ? 'bg-amber-400 text-emerald-950 shadow' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fa-solid fa-school mr-1.5"></i> TPQ
                    </a>
                    <a href="{{ route('munaqasyah.index', ['jenis' => 'RTQ']) }}" 
                       class="px-3.5 py-1.5 rounded-lg text-xs font-semibold transition {{ request('jenis') == 'RTQ' ? 'bg-amber-400 text-emerald-950 shadow' : 'text-emerald-100 hover:bg-emerald-700' }}">
                        <i class="fa-solid fa-mosque mr-1.5"></i> RTQ
                    </a>
                    <a href="{{ route('munaqasyah.create', ['jenis' => request('jenis', 'TPQ')]) }}" 
                       class="bg-white text-emerald-800 hover:bg-emerald-50 px-3.5 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
                        <i class="fa-solid fa-plus-circle text-emerald-600"></i> Tambah Data Santri
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @if(session('success'))
            <div class="mb-5 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm flex items-center justify-between no-print">
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
        <p>&copy; 2026 Lembaga Penilaian Munaqasyah Santri Kota. Database Web Syauqi.</p>
    </footer>

    @yield('scripts')
</body>
</html>
