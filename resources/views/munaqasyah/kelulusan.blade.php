    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Kelulusan Munaqasyah - {{ $santri->nama }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .sheet-page {
                box-shadow: none !important;
                border: none !important;
                margin: 0 !important;
                width: 100% !important;
                padding: 10mm 15mm !important;
            }
        }
        .table-nilai th, .table-nilai td {
            border: 1px solid #1e293b;
            padding: 5px 8px;
            font-size: 11px;
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-8 text-slate-900">
    <!-- Action Bar (No Print) -->
    <div class="max-w-3xl mx-auto mb-5 flex items-center justify-between no-print px-4">
        <a href="{{ route('munaqasyah.index', ['jenis' => $santri->jenis]) }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700 bg-white border border-slate-300 px-3 py-2 rounded-lg shadow-sm hover:bg-slate-50 transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Rekapitulasi
        </a>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 px-4 py-2 rounded-lg shadow transition">
                <i class="fa-solid fa-print"></i> Cetak / Simpan PDF
            </button>
        </div>
    </div>

    <!-- Halaman Dokumen Cetak Kelulusan (A4 Standard) -->
    <div class="sheet-page max-w-3xl mx-auto bg-white p-8 sm:p-12 shadow-md border border-slate-200 rounded-xl relative">
        <!-- Bingkai Hiasan Islami Header -->
        <div class="border-b-2 border-slate-800 pb-4 mb-5 text-center relative">
            <div class="flex items-center justify-center gap-4">
                <div class="w-14 h-14 rounded-full bg-emerald-800 text-amber-300 flex items-center justify-center text-2xl font-bold border-2 border-amber-400">
                    <i class="fa-solid fa-quran"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold tracking-wider text-emerald-900 uppercase">LEMBAGA PEMBINAAN & PENGEMBANGAN PENDIDIKAN AL-QUR'AN</h3>
                    <h1 class="text-lg font-black text-slate-900 tracking-tight">PANITIA MUNAQASYAH SANTRI KOTA</h1>
                    <p class="text-[11px] text-slate-600 font-medium">Sekretariat Bersama Kota • Tahun 1447 H / 2026 M</p>
                </div>
            </div>
        </div>

        <div class="text-center mb-6">
            <h2 class="text-base font-extrabold uppercase text-slate-900 tracking-wide underline decoration-emerald-600 decoration-2 underline-offset-4">
                SURAT KETERANGAN HASIL UJIAN MUNAQASYAH
            </h2>
            <p class="text-xs text-slate-500 mt-1 font-mono">Nomor: SKM/{{ $santri->jenis }}/2026/{{ str_pad($santri->no_peserta ?? $santri->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>

        <!-- Bagian Biodata Santri + Pas Foto Kelulusan -->
        <div class="flex flex-row items-start justify-between gap-6 mb-6 p-4 bg-slate-50 rounded-xl border border-slate-200">
            <div class="flex-1 text-xs space-y-1.5">
                <div class="flex">
                    <span class="w-36 font-semibold text-slate-600">Nomor Peserta</span>
                    <span class="w-3 text-center">:</span>
                    <span class="font-bold text-slate-900 font-mono">{{ $santri->no_peserta ?? '-' }}</span>
                </div>
                <div class="flex">
                    <span class="w-36 font-semibold text-slate-600">Nomor Unit</span>
                    <span class="w-3 text-center">:</span>
                    <span class="font-bold text-slate-900">{{ $santri->no_unit ?? '-' }}</span>
                </div>
                <div class="flex">
                    <span class="w-36 font-semibold text-slate-600">Nama Lengkap</span>
                    <span class="w-3 text-center">:</span>
                    <span class="font-extrabold text-slate-900 uppercase text-sm tracking-wide">{{ $santri->nama }}</span>
                </div>
                <div class="flex">
                    <span class="w-36 font-semibold text-slate-600">Asal Lembaga / Unit</span>
                    <span class="w-3 text-center">:</span>
                    <span class="font-semibold text-slate-900">{{ $santri->nama_unit ?? 'AL-FALAH' }} ({{ $santri->jenis }})</span>
                </div>
                <div class="flex">
                    <span class="w-36 font-semibold text-slate-600">Jenis Kelamin</span>
                    <span class="w-3 text-center">:</span>
                    <span class="text-slate-800">{{ $santri->jenis_kelamin == 'L' ? 'Laki-laki' : ($santri->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</span>
                </div>
                <div class="flex">
                    <span class="w-36 font-semibold text-slate-600">Tahun Ujian</span>
                    <span class="w-3 text-center">:</span>
                    <span class="text-slate-800">{{ $santri->tahun_munaqasyah ?? '2026' }}</span>
                </div>
            </div>

            <!-- FOTO SISWA KELULUSAN (3x4 PAS FOTO) -->
            <div class="flex-shrink-0 flex flex-col items-center">
                <div class="w-24 h-32 border-2 border-slate-700 p-0.5 bg-white shadow-xs rounded-sm overflow-hidden flex items-center justify-center">
                    <img src="{{ $santri->foto_url }}" alt="Pas Foto {{ $santri->nama }}" class="w-full h-full object-cover">
                </div>
                <span class="text-[9px] font-bold text-slate-500 uppercase tracking-wider mt-1">PAS FOTO SISWA</span>
            </div>
        </div>

        @php $p = $santri->penilaian; @endphp

        <!-- Tabel Transkrip Nilai Munaqasyah (Sesuai 9 Mata Uji Google Sheet) -->
        <div class="mb-6">
            <h4 class="text-xs font-bold text-slate-800 uppercase mb-2 flex items-center gap-1.5">
                <i class="fa-solid fa-square-poll-vertical text-emerald-700"></i>
                Rincian Nilai Ujian Munaqasyah
            </h4>
            <table class="w-full text-center table-nilai border-collapse">
                <thead>
                    <tr class="bg-yellow-300 text-slate-900 font-extrabold text-[11px] uppercase">
                        <th class="w-10">NO</th>
                        <th class="text-left">BIDANG & MATERI UJIAN</th>
                        <th class="w-24">NILAI</th>
                        <th class="w-32">STANDAR KELULUSAN</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    <!-- Kelompok A: Bacaan -->
                    <tr class="bg-emerald-50/60 font-bold text-emerald-950 text-left">
                        <td colspan="4" class="px-2 py-1">A. MUNAQASYAH BACAAN</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="text-left pl-4">Fashohah</td>
                        <td class="font-mono font-bold">{{ $p ? number_format($p->fashohah, 0) : '-' }}</td>
                        <td class="text-slate-500">Min. 60</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td class="text-left pl-4">Tajwid</td>
                        <td class="font-mono font-bold">{{ $p ? number_format($p->tajwid, 0) : '-' }}</td>
                        <td class="text-slate-500">Min. 60</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="text-left pl-4">Gharib Musykilat</td>
                        <td class="font-mono font-bold">{{ $p ? number_format($p->gharib_musykilat, 0) : '-' }}</td>
                        <td class="text-slate-500">Min. 60</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td class="text-left pl-4">Suara & Lagu</td>
                        <td class="font-mono font-bold">{{ $p ? number_format($p->suara_lagu, 0) : '-' }}</td>
                        <td class="text-slate-500">Min. 60</td>
                    </tr>

                    <!-- Kelompok B: Hafalan -->
                    <tr class="bg-amber-50/60 font-bold text-amber-950 text-left">
                        <td colspan="4" class="px-2 py-1">B. MUNAQASYAH HAFALAN</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td class="text-left pl-4">Ayat-ayat Pilihan</td>
                        <td class="font-mono font-bold">{{ $p ? number_format($p->ayat_pilihan, 0) : '-' }}</td>
                        <td class="text-slate-500">Min. 60</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td class="text-left pl-4">Surah Pendek</td>
                        <td class="font-mono font-bold">{{ $p ? number_format($p->surah_pendek, 0) : '-' }}</td>
                        <td class="text-slate-500">Min. 60</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td class="text-left pl-4">Doa Harian</td>
                        <td class="font-mono font-bold">{{ $p ? number_format($p->doa_harian, 0) : '-' }}</td>
                        <td class="text-slate-500">Min. 60</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td class="text-left pl-4">Bacaan Shalat</td>
                        <td class="font-mono font-bold">{{ $p ? number_format($p->bacaan_shalat, 0) : '-' }}</td>
                        <td class="text-slate-500">Min. 60</td>
                    </tr>

                    <!-- Kelompok C: Ujian Tertulis -->
                    <tr class="bg-blue-50/60 font-bold text-blue-950 text-left">
                        <td colspan="4" class="px-2 py-1">C. UJIAN TERTULIS</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td class="text-left pl-4">Ujian Tertulis (Dinul Islam / Teori)</td>
                        <td class="font-mono font-bold">{{ $p ? number_format($p->ujian_tertulis, 0) : '-' }}</td>
                        <td class="text-slate-500">Min. 60</td>
                    </tr>

                    <!-- Ringkasan -->
                    <tr class="bg-yellow-100 font-extrabold text-slate-900">
                        <td colspan="2" class="text-right pr-4 uppercase">JUMLAH NILAI (TOTAL)</td>
                        <td class="font-mono text-xs">{{ $p ? number_format($p->jumlah_nilai, 0) : '-' }}</td>
                        <td class="text-slate-500">-</td>
                    </tr>
                    <tr class="bg-yellow-200 font-extrabold text-slate-900">
                        <td colspan="2" class="text-right pr-4 uppercase">RATA - RATA NILAI</td>
                        <td class="font-mono text-sm text-emerald-800">{{ $p ? number_format($p->rata_rata, 2) : '-' }}</td>
                        <td class="text-slate-700 font-bold">Min. 60.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Box Keputusan Kelulusan -->
        <div class="border-2 {{ $santri->status_kelulusan == 'LULUS' ? 'border-emerald-600 bg-emerald-50/50' : 'border-rose-600 bg-rose-50/50' }} rounded-xl p-4 mb-8 text-center">
            <p class="text-xs uppercase font-semibold text-slate-600">Berdasarkan hasil sidang munaqasyah, santri yang bersangkutan dinyatakan:</p>
            <h3 class="text-xl font-black {{ $santri->status_kelulusan == 'LULUS' ? 'text-emerald-700' : 'text-rose-700' }} tracking-widest my-1 uppercase">
                {{ $santri->status_kelulusan }}
            </h3>
            <p class="text-xs text-slate-800 font-medium">
                Predikat: <span class="font-bold underline">{{ $p ? $p->predikat : '-' }}</span>
            </p>
        </div>

        <!-- Tanda Tangan Penguji & Panitia -->
        <div class="grid grid-cols-2 text-center text-xs mt-10">
            <div>
                <p class="text-slate-600 mb-16">Penguji Munaqasyah,</p>
                <p class="font-bold text-slate-900 underline uppercase">( ............................................ )</p>
                <p class="text-[10px] text-slate-500">NIP / ID Penguji</p>
            </div>
            <div>
                <p class="text-slate-600 mb-16">Ketua Panitia Munaqasyah,</p>
                <p class="font-bold text-slate-900 underline uppercase">H. AHMAD SYAUQI, S.Pd.I</p>
                <p class="text-[10px] text-slate-500">Ketua Panitia Pelaksana Kota 2026</p>
            </div>
        </div>
    </div>
</body>
</html>
