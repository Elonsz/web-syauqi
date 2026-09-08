@extends('layouts.app')

@section('title', 'Penilaian Munaqasyah ' . $jenis . ' Kota 2026')

@section('content')
<div class="space-y-6">
    <!-- Header Title & Switch Tab -->
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 text-xs font-bold rounded-md {{ $jenis == 'TPQ' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                    KATEGORI: {{ $jenis }}
                </span>
                <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">PENILAIAN MUNAQASYAH KOTA 2026</h2>
            </div>
            <p class="text-xs text-slate-500 mt-1">Data kelulusan munaqasyah, rekapitulasi nilai bacaan & hafalan santri, serta pas foto kelulusan.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <!-- Tab TPQ & RTQ -->
            <div class="inline-flex bg-slate-100 p-1 rounded-xl border border-slate-200">
                <a href="{{ route('munaqasyah.index', ['jenis' => 'TPQ']) }}" 
                   class="px-4 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ $jenis == 'TPQ' ? 'bg-yellow-400 text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="fa-solid fa-scroll"></i> Tab TPQ
                </a>
                <a href="{{ route('munaqasyah.index', ['jenis' => 'RTQ']) }}" 
                   class="px-4 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ $jenis == 'RTQ' ? 'bg-yellow-400 text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                    <i class="fa-solid fa-book-quran"></i> Tab RTQ
                </a>
            </div>

            <!-- Tombol Export Excel & Spreadsheet -->
            <div class="inline-flex items-center gap-1.5">
                <a href="{{ route('munaqasyah.export.excel', ['jenis' => $jenis, 'unit' => request('unit')]) }}" 
                   class="bg-emerald-700 hover:bg-emerald-800 text-white px-3.5 py-2 rounded-xl text-xs font-bold shadow-xs transition flex items-center gap-1.5"
                   title="Download Format Excel (.xls) dengan warna dan tabel lengkap">
                    <i class="fa-solid fa-file-excel text-emerald-300"></i> Export Excel
                </a>
                <a href="{{ route('munaqasyah.export.csv', ['jenis' => $jenis, 'unit' => request('unit')]) }}" 
                   class="bg-teal-600 hover:bg-teal-700 text-white px-3.5 py-2 rounded-xl text-xs font-bold shadow-xs transition flex items-center gap-1.5"
                   title="Download Format Spreadsheet / CSV untuk Google Sheets">
                    <i class="fa-solid fa-table text-teal-200"></i> Export Spreadsheet
                </a>
            </div>

            <a href="{{ route('munaqasyah.create', ['jenis' => $jenis]) }}" 
               class="bg-amber-500 hover:bg-amber-600 text-slate-900 px-4 py-2 rounded-xl text-xs font-bold shadow-xs transition flex items-center gap-1.5">
                <i class="fa-solid fa-user-plus"></i> Input Santri & Foto
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase">Total Peserta {{ $jenis }}</p>
                <p class="text-2xl font-black text-slate-800">{{ $totalSantri }} <span class="text-xs font-normal text-slate-500">Santri</span></p>
            </div>
            <div class="w-11 h-11 bg-amber-100 text-amber-700 rounded-xl flex items-center justify-center text-lg">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase">Lulus Munaqasyah</p>
                <p class="text-2xl font-black text-emerald-600">{{ $totalLulus }} <span class="text-xs font-normal text-slate-500">Santri</span></p>
            </div>
            <div class="w-11 h-11 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center text-lg">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase">Rata-rata Nilai</p>
                <p class="text-2xl font-black text-blue-600">{{ number_format($rataRataKeseluruhan, 2) }}</p>
            </div>
            <div class="w-11 h-11 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center text-lg">
                <i class="fa-solid fa-chart-line"></i>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <form action="{{ route('munaqasyah.index') }}" method="GET" class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
            <input type="hidden" name="jenis" value="{{ $jenis }}">
            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama santri..." 
                       class="pl-9 pr-3 py-1.5 text-xs bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none w-52">
            </div>
            <select name="unit" onchange="this.form.submit()" 
                    class="py-1.5 px-3 text-xs bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                <option value="">Semua Unit Lembaga</option>
                @foreach($units as $u)
                    <option value="{{ $u->nama_unit }}" {{ request('unit') == $u->nama_unit ? 'selected' : '' }}>
                        {{ $u->nama_unit }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-slate-800 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-slate-700">
                Filter
            </button>
            @if(request('search') || request('unit'))
                <a href="{{ route('munaqasyah.index', ['jenis' => $jenis]) }}" class="text-xs text-rose-600 hover:underline">
                    Reset
                </a>
            @endif
        </form>

        <div class="text-xs text-slate-500 flex items-center gap-1.5">
            <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
            Format identik tabel spreadsheet munaqasyah
        </div>
    </div>

    <!-- Table Container (Spreadsheet Look & Feel) -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-center border-collapse table-custom">
                <thead>
                    <!-- Top Category Header -->
                    <tr class="bg-yellow-300 text-slate-900 font-extrabold uppercase tracking-wider text-[11px]">
                        <th rowspan="2" class="w-12 bg-yellow-400">NO. PESERTA</th>
                        <th rowspan="2" class="w-12 bg-yellow-400">NO. UNIT</th>
                        <th rowspan="2" class="text-left w-64 bg-yellow-300">NAMA</th>
                        <th rowspan="2" class="w-16 bg-yellow-300">FOTO</th>
                        <th rowspan="2" class="w-28 bg-yellow-300">NAMA UNIT</th>
                        <th colspan="4" class="bg-amber-300 border-b border-amber-400">MUNAQASYAH BACAAN</th>
                        <th colspan="4" class="bg-yellow-200 border-b border-yellow-300">MUNAQASYAH HAFALAN</th>
                        <th rowspan="2" class="w-16 bg-yellow-400">UJIAN TERTULIS</th>
                        <th rowspan="2" class="w-16 bg-yellow-400">JUMLAH NILAI</th>
                        <th rowspan="2" class="w-16 bg-yellow-400">RATA-RATA</th>
                        <th rowspan="2" class="w-28 bg-yellow-300 no-print">AKSI / KELULUSAN</th>
                    </tr>
                    <!-- Sub Header -->
                    <tr class="bg-yellow-100 text-slate-800 font-bold text-[10px] uppercase">
                        <th class="w-14">FASHOHAH</th>
                        <th class="w-14">TAJWID</th>
                        <th class="w-16">GHARIB MUSYKILAT</th>
                        <th class="w-14">SUARA & LAGU</th>
                        <th class="w-16">AYAT-AYAT PILIHAN</th>
                        <th class="w-14">SURAH PENDEK</th>
                        <th class="w-14">DOA HARIAN</th>
                        <th class="w-14">BACAAN SHALAT</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-xs">
                    @forelse($santris as $santri)
                        @php
                            $p = $santri->penilaian;
                            $isRed = ($p && $p->rata_rata < 60) || ($santri->status_kelulusan == 'TIDAK LULUS');
                        @endphp
                        <tr class="hover:bg-slate-50 transition {{ $isRed ? 'bg-rose-50 text-rose-900' : '' }}">
                            <td class="font-bold text-slate-700 bg-slate-50/50">{{ $santri->no_peserta ?? '-' }}</td>
                            <td class="text-slate-600">{{ $santri->no_unit ?? '-' }}</td>
                            <td class="text-left font-semibold text-slate-900 px-3">
                                {{ $santri->nama }}
                                @if($santri->jenis_kelamin)
                                    <span class="ml-1 text-[10px] px-1.5 py-0.2 rounded font-normal {{ $santri->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                        {{ $santri->jenis_kelamin }}
                                    </span>
                                @endif
                            </td>
                            <!-- FOTO SISWA -->
                            <td class="p-1">
                                <div class="w-10 h-10 mx-auto rounded-lg overflow-hidden border border-slate-200 shadow-xs bg-slate-100 flex items-center justify-center">
                                    <img src="{{ $santri->foto_url }}" alt="{{ $santri->nama }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="font-medium text-slate-700">{{ $santri->nama_unit ?? 'AL-FALAH' }}</td>

                            <!-- MUNAQASYAH BACAAN -->
                            <td class="font-mono text-slate-800">{{ $p ? number_format($p->fashohah, 0) : '-' }}</td>
                            <td class="font-mono text-slate-800">{{ $p ? number_format($p->tajwid, 0) : '-' }}</td>
                            <td class="font-mono text-slate-800">{{ $p ? number_format($p->gharib_musykilat, 0) : '-' }}</td>
                            <td class="font-mono text-slate-800">{{ $p ? number_format($p->suara_lagu, 0) : '-' }}</td>

                            <!-- MUNAQASYAH HAFALAN -->
                            <td class="font-mono text-slate-800">{{ $p ? number_format($p->ayat_pilihan, 0) : '-' }}</td>
                            <td class="font-mono text-slate-800">{{ $p ? number_format($p->surah_pendek, 0) : '-' }}</td>
                            <td class="font-mono text-slate-800">{{ $p ? number_format($p->doa_harian, 0) : '-' }}</td>
                            <td class="font-mono text-slate-800">{{ $p ? number_format($p->bacaan_shalat, 0) : '-' }}</td>

                            <!-- UJIAN TERTULIS -->
                            <td class="font-mono text-slate-800 bg-amber-50/50">{{ $p ? number_format($p->ujian_tertulis, 0) : '-' }}</td>

                            <!-- JUMLAH & RATA-RATA -->
                            <td class="font-mono font-bold text-slate-900 bg-amber-50">{{ $p ? number_format($p->jumlah_nilai, 0) : '-' }}</td>
                            <td class="font-mono font-extrabold {{ $isRed ? 'text-rose-600' : 'text-emerald-700' }} bg-amber-100/50">
                                {{ $p ? number_format($p->rata_rata, 2) : '-' }}
                            </td>

                            <!-- AKSI & CETAK KELULUSAN -->
                            <td class="no-print">
                                <div class="flex items-center justify-center gap-1.5">
                                    <!-- Cetak Keterangan Kelulusan + Foto -->
                                    <a href="{{ route('munaqasyah.kelulusan', $santri->id) }}" target="_blank" 
                                       title="Cetak Surat Kelulusan & Foto"
                                       class="p-1.5 bg-emerald-100 hover:bg-emerald-200 text-emerald-800 rounded-lg text-xs font-semibold flex items-center gap-1 transition">
                                        <i class="fa-solid fa-id-card"></i> Kelulusan
                                    </a>
                                    <!-- Edit -->
                                    <a href="{{ route('munaqasyah.edit', $santri->id) }}" 
                                       title="Edit Data & Nilai"
                                       class="p-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <!-- Hapus -->
                                    <form action="{{ route('munaqasyah.destroy', $santri->id) }}" method="POST" onsubmit="return confirm('Hapus data santri ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg text-xs transition" title="Hapus">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="17" class="py-8 text-center text-slate-400">
                                <i class="fa-solid fa-inbox text-3xl mb-2 block"></i>
                                Belum ada data santri untuk kategori {{ $jenis }}.
                                <div class="mt-2">
                                    <a href="{{ route('munaqasyah.create', ['jenis' => $jenis]) }}" class="text-emerald-600 font-bold hover:underline">
                                        + Tambah Santri Sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
