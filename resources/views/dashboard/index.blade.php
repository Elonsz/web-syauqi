@extends('layouts.app')

@section('title', 'Dashboard — SIMUNAQASYAH Kota 2026')

@section('content')
<div class="space-y-6">

    {{-- ===== HERO WELCOME BANNER ===== --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-800 via-teal-800 to-emerald-900 rounded-3xl p-7 shadow-xl">
        <!-- Pattern overlay -->
        <div class="absolute inset-0 opacity-10"
            style="background-image:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C%2Fg%3E%3C%2Fsvg%3E');">
        </div>
        <!-- Decorative circle -->
        <div class="absolute -top-12 -right-12 w-64 h-64 bg-amber-400/10 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-teal-400/10 rounded-full blur-2xl"></div>

        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-amber-400 rounded-2xl flex items-center justify-center text-emerald-950 text-xl shadow-lg">
                        <i class="fa-solid fa-quran"></i>
                    </div>
                    <div>
                        <p class="text-emerald-300 text-xs font-medium uppercase tracking-widest">Panel Kontrol</p>
                        <h1 class="text-2xl font-black text-white tracking-tight">Dashboard SIMUNAQASYAH</h1>
                    </div>
                </div>
                <p class="text-emerald-200 text-sm max-w-lg">
                    Selamat datang, <span class="font-bold text-amber-300">Panitia Munaqasyah</span>! 
                    Pantau data kelulusan & statistik penilaian santri TPQ & RTQ Kota 2026.
                </p>
            </div>
            <div class="text-right shrink-0">
                <p class="text-emerald-300 text-xs" id="dashDate"></p>
                <p class="text-amber-300 font-bold text-lg font-mono" id="dashTime"></p>
                <div class="mt-2 inline-flex items-center gap-1.5 bg-emerald-700/50 px-3 py-1 rounded-full border border-emerald-600/50">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-xs text-emerald-200 font-semibold">Sistem Aktif</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== STAT CARDS ===== --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Total Peserta --}}
        <div class="group bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-start justify-between mb-3">
                <div class="w-11 h-11 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-users"></i>
                </div>
                <span class="text-xs text-slate-500 font-medium bg-slate-100 px-2 py-0.5 rounded-full">Total</span>
            </div>
            <p class="text-3xl font-black text-slate-800">{{ $totalSemua }}</p>
            <p class="text-xs font-semibold text-slate-500 mt-0.5 uppercase tracking-wide">Total Peserta</p>
            <div class="mt-3 flex items-center gap-2">
                <span class="text-[10px] text-blue-600 font-bold bg-blue-50 px-2 py-0.5 rounded-full">
                    {{ $totalTPQ }} TPQ
                </span>
                <span class="text-[10px] text-indigo-600 font-bold bg-indigo-50 px-2 py-0.5 rounded-full">
                    {{ $totalRTQ }} RTQ
                </span>
            </div>
        </div>

        {{-- Total Lulus --}}
        <div class="group bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-start justify-between mb-3">
                <div class="w-11 h-11 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <span class="text-xs text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-full">LULUS</span>
            </div>
            <p class="text-3xl font-black text-emerald-600">{{ $totalLulus }}</p>
            <p class="text-xs font-semibold text-slate-500 mt-0.5 uppercase tracking-wide">Peserta Lulus</p>
            <div class="mt-3">
                <div class="w-full bg-slate-100 rounded-full h-1.5">
                    <div class="bg-emerald-500 h-1.5 rounded-full transition-all duration-700"
                        style="width: {{ $totalSemua > 0 ? round(($totalLulus / $totalSemua) * 100) : 0 }}%"></div>
                </div>
                <p class="text-[10px] text-slate-500 mt-1">
                    {{ $totalSemua > 0 ? round(($totalLulus / $totalSemua) * 100) : 0 }}% tingkat kelulusan
                </p>
            </div>
        </div>

        {{-- Belum Lulus --}}
        <div class="group bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-start justify-between mb-3">
                <div class="w-11 h-11 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <span class="text-xs text-rose-600 font-bold bg-rose-50 px-2 py-0.5 rounded-full">TIDAK LULUS</span>
            </div>
            <p class="text-3xl font-black text-rose-600">{{ $totalTidakLulus }}</p>
            <p class="text-xs font-semibold text-slate-500 mt-0.5 uppercase tracking-wide">Tidak Lulus</p>
            <div class="mt-3">
                <div class="w-full bg-slate-100 rounded-full h-1.5">
                    <div class="bg-rose-500 h-1.5 rounded-full transition-all duration-700"
                        style="width: {{ $totalSemua > 0 ? round(($totalTidakLulus / $totalSemua) * 100) : 0 }}%"></div>
                </div>
                <p class="text-[10px] text-slate-500 mt-1">
                    {{ $totalSemua > 0 ? round(($totalTidakLulus / $totalSemua) * 100) : 0 }}% dari total
                </p>
            </div>
        </div>

        {{-- Rata-rata Nilai --}}
        <div class="group bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-start justify-between mb-3">
                <div class="w-11 h-11 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center text-lg group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <span class="text-xs text-amber-600 font-bold bg-amber-50 px-2 py-0.5 rounded-full">AVG</span>
            </div>
            <p class="text-3xl font-black text-amber-600">{{ number_format($rataRataGlobal, 1) }}</p>
            <p class="text-xs font-semibold text-slate-500 mt-0.5 uppercase tracking-wide">Rata-rata Nilai</p>
            <div class="mt-3 flex items-center gap-1 text-[10px] text-slate-500">
                <i class="fa-solid fa-circle-info text-amber-400"></i>
                Rata-rata semua peserta
            </div>
        </div>
    </div>

    {{-- ===== GRID: Breakdown TPQ/RTQ + Aksi Cepat ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Breakdown per Jenis --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-chart-bar text-emerald-600"></i>
                    <h3 class="font-bold text-slate-800 text-sm">Rekapitulasi TPQ & RTQ</h3>
                </div>
                <span class="text-xs text-slate-400">Kelulusan per kategori</span>
            </div>
            <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- TPQ Card --}}
                <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl p-4 border border-amber-200">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-9 h-9 bg-amber-400 rounded-xl flex items-center justify-center text-emerald-950">
                            <i class="fa-solid fa-scroll text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Kategori</p>
                            <p class="text-base font-black text-slate-800">TPQ</p>
                        </div>
                    </div>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between">
                            <span class="text-slate-600">Total Peserta</span>
                            <span class="font-bold text-slate-800">{{ $totalTPQ }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Lulus</span>
                            <span class="font-bold text-emerald-600">{{ $lulusTPQ }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Tidak Lulus</span>
                            <span class="font-bold text-rose-600">{{ $tidakLulusTPQ }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Rata-rata Nilai</span>
                            <span class="font-bold text-amber-700">{{ number_format($rataTPQ, 1) }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="w-full bg-amber-100 rounded-full h-2">
                            <div class="bg-amber-500 h-2 rounded-full"
                                style="width: {{ $totalTPQ > 0 ? round(($lulusTPQ / $totalTPQ) * 100) : 0 }}%"></div>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-1">
                            {{ $totalTPQ > 0 ? round(($lulusTPQ / $totalTPQ) * 100) : 0 }}% lulus
                        </p>
                    </div>
                    <a href="{{ route('munaqasyah.index', ['jenis' => 'TPQ']) }}"
                        class="mt-3 w-full inline-flex items-center justify-center gap-1.5 text-xs font-bold text-amber-800 bg-amber-200 hover:bg-amber-300 py-1.5 rounded-lg transition">
                        <i class="fa-solid fa-arrow-right"></i> Lihat Data TPQ
                    </a>
                </div>

                {{-- RTQ Card --}}
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-9 h-9 bg-blue-500 rounded-xl flex items-center justify-center text-white">
                            <i class="fa-solid fa-book-quran text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Kategori</p>
                            <p class="text-base font-black text-slate-800">RTQ</p>
                        </div>
                    </div>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between">
                            <span class="text-slate-600">Total Peserta</span>
                            <span class="font-bold text-slate-800">{{ $totalRTQ }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Lulus</span>
                            <span class="font-bold text-emerald-600">{{ $lulusRTQ }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Tidak Lulus</span>
                            <span class="font-bold text-rose-600">{{ $tidakLulusRTQ }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Rata-rata Nilai</span>
                            <span class="font-bold text-blue-700">{{ number_format($rataRTQ, 1) }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="w-full bg-blue-100 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full"
                                style="width: {{ $totalRTQ > 0 ? round(($lulusRTQ / $totalRTQ) * 100) : 0 }}%"></div>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-1">
                            {{ $totalRTQ > 0 ? round(($lulusRTQ / $totalRTQ) * 100) : 0 }}% lulus
                        </p>
                    </div>
                    <a href="{{ route('munaqasyah.index', ['jenis' => 'RTQ']) }}"
                        class="mt-3 w-full inline-flex items-center justify-center gap-1.5 text-xs font-bold text-blue-800 bg-blue-200 hover:bg-blue-300 py-1.5 rounded-lg transition">
                        <i class="fa-solid fa-arrow-right"></i> Lihat Data RTQ
                    </a>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex items-center gap-2">
                <i class="fa-solid fa-bolt text-amber-500"></i>
                <h3 class="font-bold text-slate-800 text-sm">Aksi Cepat</h3>
            </div>
            <div class="p-4 space-y-2">
                <a href="{{ route('munaqasyah.create', ['jenis' => 'TPQ']) }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-amber-50 hover:bg-amber-100 border border-amber-200 transition group">
                    <div class="w-9 h-9 bg-amber-400 rounded-lg flex items-center justify-center text-emerald-950 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-user-plus text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Input Santri TPQ</p>
                        <p class="text-[10px] text-slate-500">Tambah data & foto</p>
                    </div>
                    <i class="fa-solid fa-chevron-right text-xs text-slate-400 ml-auto"></i>
                </a>

                <a href="{{ route('munaqasyah.create', ['jenis' => 'RTQ']) }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 hover:bg-blue-100 border border-blue-200 transition group">
                    <div class="w-9 h-9 bg-blue-500 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-user-plus text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Input Santri RTQ</p>
                        <p class="text-[10px] text-slate-500">Tambah data & foto</p>
                    </div>
                    <i class="fa-solid fa-chevron-right text-xs text-slate-400 ml-auto"></i>
                </a>

                <a href="{{ route('munaqasyah.index', ['jenis' => 'TPQ']) }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 transition group">
                    <div class="w-9 h-9 bg-emerald-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-table-list text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Rekapitulasi TPQ</p>
                        <p class="text-[10px] text-slate-500">Lihat semua penilaian</p>
                    </div>
                    <i class="fa-solid fa-chevron-right text-xs text-slate-400 ml-auto"></i>
                </a>

                <a href="{{ route('munaqasyah.index', ['jenis' => 'RTQ']) }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 transition group">
                    <div class="w-9 h-9 bg-indigo-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-table-list text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Rekapitulasi RTQ</p>
                        <p class="text-[10px] text-slate-500">Lihat semua penilaian</p>
                    </div>
                    <i class="fa-solid fa-chevron-right text-xs text-slate-400 ml-auto"></i>
                </a>

                <a href="{{ route('munaqasyah.export.excel', ['jenis' => 'TPQ']) }}"
                    class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 transition group">
                    <div class="w-9 h-9 bg-slate-700 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-file-excel text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Export Excel TPQ</p>
                        <p class="text-[10px] text-slate-500">Download laporan</p>
                    </div>
                    <i class="fa-solid fa-chevron-right text-xs text-slate-400 ml-auto"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- ===== 10 Santri Terbaru ===== --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-teal-600"></i>
                <h3 class="font-bold text-slate-800 text-sm">Santri Terbaru Ditambahkan</h3>
            </div>
            <a href="{{ route('munaqasyah.index') }}" class="text-xs text-emerald-600 font-semibold hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-5 py-3 text-slate-500 font-semibold uppercase tracking-wide">No. Peserta</th>
                        <th class="text-left px-4 py-3 text-slate-500 font-semibold uppercase tracking-wide">Nama Santri</th>
                        <th class="text-left px-4 py-3 text-slate-500 font-semibold uppercase tracking-wide">Unit / Lembaga</th>
                        <th class="text-center px-4 py-3 text-slate-500 font-semibold uppercase tracking-wide">Kategori</th>
                        <th class="text-center px-4 py-3 text-slate-500 font-semibold uppercase tracking-wide">Status</th>
                        <th class="text-center px-4 py-3 text-slate-500 font-semibold uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($santriTerbaru as $santri)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-5 py-3 font-mono font-bold text-slate-700">{{ $santri->no_peserta ?? '-' }}</td>
                        <td class="px-4 py-3 font-semibold text-slate-800">{{ $santri->nama }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $santri->nama_unit ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $santri->jenis == 'TPQ' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $santri->jenis }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($santri->status_kelulusan == 'LULUS')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> LULUS
                                </span>
                            @elseif($santri->status_kelulusan == 'TIDAK LULUS')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700">
                                    <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span> TIDAK LULUS
                                </span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500">
                                    BELUM DINILAI
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('munaqasyah.edit', $santri->id) }}"
                                class="inline-flex items-center gap-1 text-[10px] font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 px-2 py-1 rounded-lg transition">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-slate-400 text-sm">
                            <i class="fa-solid fa-inbox text-3xl mb-2 block text-slate-300"></i>
                            Belum ada data santri
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    // Live clock
    function updateClock() {
        const now = new Date();
        const dateEl = document.getElementById('dashDate');
        const timeEl = document.getElementById('dashTime');
        if (!dateEl || !timeEl) return;

        const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        dateEl.textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
        timeEl.textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    }
    updateClock();
    setInterval(updateClock, 1000);
</script>
@endsection
