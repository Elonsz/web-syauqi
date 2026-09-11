<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Kelulusan Database Sekolah - {{ $santri->nama }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <script>
        window.tailwind = window.tailwind || {};
        window.tailwind.config = { theme: { extend: { colors: {
            blue: { 50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa', 500: '#2563eb', 600: '#1d4ed8', 700: '#1e40af', 800: '#1e3a8a', 900: '#16285a', 950: '#081026' },
            red: { 50: '#fef2f2', 100: '#fee2e2', 200: '#fecaca', 300: '#fca5a5', 400: '#f87171', 500: '#ef4444', 600: '#dc2626', 700: '#b91c1c', 800: '#991b1b', 900: '#7f1d1d', 950: '#450a0a' },
            rose: { 50: '#fff1f2', 100: '#ffe4e6', 200: '#fecdd3', 300: '#fda4af', 400: '#fb7185', 500: '#f43f5e', 600: '#e11d48', 700: '#be123c', 800: '#9f1239', 900: '#881337', 950: '#4c0519' }
        } } } };
    </script>
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
                border-radius: 0 !important;
            }
            .print-row { flex-direction: row !important; }
        }
        .table-nilai th, .table-nilai td {
            border: 1px solid #1e293b;
            padding: 5px 8px;
            font-size: 11px;
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-4 sm:py-8 px-2 sm:px-4 text-slate-900">
    <!-- Action Bar (No Print) -->
    <div class="max-w-3xl mx-auto mb-4 sm:mb-5 flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 no-print">
        @if(isset($isPublic) && $isPublic)
            <a href="{{ route('public.check', ['q' => $santri->no_peserta, 'jenis' => $santri->jenis]) }}" 
               class="inline-flex items-center justify-center gap-2 text-xs font-semibold text-slate-700 bg-white border border-slate-300 px-3.5 py-2.5 rounded-xl shadow-xs hover:bg-slate-50 transition">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Portal Cek Kelulusan
            </a>
        @else
            <a href="{{ route('database_sekolah.index', ['jenis' => $santri->jenis]) }}" 
               class="inline-flex items-center justify-center gap-2 text-xs font-semibold text-slate-700 bg-white border border-slate-300 px-3.5 py-2.5 rounded-xl shadow-xs hover:bg-slate-50 transition">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Rekapitulasi
            </a>
        @endif
        <div class="flex items-center gap-2">
            <!-- WhatsApp Share Button -->
            @php
                $p = $santri->penilaian;
                $waMessage = "Assalamu'alaikum Wr. Wb. Yth. Wali Santri dari *" . $santri->nama . "* (No. Peserta: " . ($santri->no_peserta ?? '-') . ").%0A%0AAlhamdulillah, santri dinyatakan *" . $santri->status_kelulusan . "* pada Ujian Database Sekolah Yayasan Cahaya Amanah Ar-Raudhah dengan Predikat *" . ($p ? $p->predikat : '-') . "* (Rata-rata: " . ($p ? number_format($p->rata_rata, 2) : '-') . ").%0A%0ABerikut tautan resmi Surat Keterangan Kelulusan dan nilai lengkap:%0A" . urlencode(route('public.check.cetak', $santri->id)) . "%0A%0ABarakallahu fiikum.%0A_Panitia Database Sekolah Ar-Raudhah_";
            @endphp
            <a href="https://api.whatsapp.com/send?text={{ $waMessage }}" target="_blank" rel="noopener"
               class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 px-3.5 py-2.5 rounded-xl shadow-md transition active:scale-95" title="Bagikan hasil ke WhatsApp">
                <i class="fa-brands fa-whatsapp text-sm"></i> <span>Kirim ke WhatsApp</span>
            </a>

            @if(!isset($isPublic) || !$isPublic)
                <a href="{{ route('database_sekolah.edit', $santri->id) }}"
                   class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 text-xs font-semibold text-slate-700 bg-white border border-slate-300 px-3.5 py-2.5 rounded-xl shadow-xs hover:bg-slate-50 transition">
                    <i class="fa-solid fa-pen-to-square text-amber-500"></i> Edit Data
                </a>
            @endif
            <button onclick="window.print()" 
                    class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2.5 rounded-xl shadow-md transition active:scale-95">
                <i class="fa-solid fa-print"></i> Cetak / Simpan PDF
            </button>
        </div>
    </div>

    <!-- Halaman Dokumen Cetak Kelulusan (A4 Standard) -->
    <div class="sheet-page max-w-3xl mx-auto bg-white p-4 sm:p-8 md:p-12 shadow-md border border-slate-200 rounded-2xl relative overflow-hidden">
        <!-- Watermark Logo Resmi Yayasan -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none z-0">
            <img src="{{ asset('images/logo.png') }}" alt="Watermark Ar-Raudhah" class="w-80 h-80 sm:w-96 sm:h-96 object-contain opacity-[0.04] grayscale">
        </div>
        <!-- Bingkai Hiasan Islami Header -->
        <div class="border-b-2 border-slate-900 pb-4 mb-5 text-center relative">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-5">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Yayasan" class="w-16 h-16 sm:w-20 sm:h-20 object-contain shrink-0">
                <div>
                    <h3 class="text-xs sm:text-sm font-black tracking-wider text-blue-950 uppercase">{{ $settings['nama_yayasan'] ?? 'YAYASAN CAHAYA AMANAH AR-RAUDHAH' }}</h3>
                    <h1 class="text-base sm:text-xl font-black text-slate-900 tracking-tight">TAMAN PENDIDIKAN QUR'AN AR-RAUDHAH UNIT 004</h1>
                    <p class="text-[10px] sm:text-[11px] text-slate-600 font-semibold">{{ $settings['alamat_yayasan'] ?? 'Banjarbaru - Kalimantan Selatan' }} • Periode {{ $settings['tahun_ajaran'] ?? '1447 H / 2026 M' }}</p>
                </div>
            </div>
        </div>

        <div class="text-center mb-5 sm:mb-6">
            <h2 class="text-sm sm:text-base font-extrabold uppercase text-slate-900 tracking-wide underline decoration-slate-900 decoration-2 underline-offset-4">
                SURAT KETERANGAN HASIL UJIAN DATABASE SEKOLAH
            </h2>
            <p class="text-[11px] sm:text-xs text-slate-500 mt-1 font-mono">
                Nomor: {{ $settings['nomor_sk_munaqasyah'] ?? $settings['nomor_sk_database sekolah'] ?? ('SKM/' . $santri->jenis . '/2026/' . str_pad($santri->no_peserta ?? $santri->id, 4, '0', STR_PAD_LEFT)) }}
            </p>
        </div>

        <!-- Bagian Biodata Santri + Pas Foto Kelulusan -->
        <div class="flex flex-col-reverse sm:flex-row items-center sm:items-start justify-between gap-4 sm:gap-6 mb-6 p-4 bg-slate-50 rounded-xl border border-slate-200">
            <div class="w-full sm:flex-1 text-xs space-y-1.5">
                <div class="flex">
                    <span class="w-32 sm:w-36 font-semibold text-slate-600 shrink-0">Nomor Peserta</span>
                    <span class="w-3 text-center shrink-0">:</span>
                    <span class="font-bold text-slate-900 font-mono">{{ $santri->no_peserta ?? '-' }}</span>
                </div>
                <div class="flex">
                    <span class="w-32 sm:w-36 font-semibold text-slate-600 shrink-0">Nomor Unit</span>
                    <span class="w-3 text-center shrink-0">:</span>
                    <span class="font-bold text-slate-900">{{ $santri->no_unit ?? '-' }}</span>
                </div>
                <div class="flex">
                    <span class="w-32 sm:w-36 font-semibold text-slate-600 shrink-0">Nama Lengkap</span>
                    <span class="w-3 text-center shrink-0">:</span>
                    <span class="font-extrabold text-slate-900 uppercase text-xs sm:text-sm tracking-wide">{{ $santri->nama }}</span>
                </div>
                <div class="flex">
                    <span class="w-32 sm:w-36 font-semibold text-slate-600 shrink-0">Asal Lembaga / Unit</span>
                    <span class="w-3 text-center shrink-0">:</span>
                    <span class="font-bold text-slate-900">{{ $santri->nama_unit ?? 'AL-FALAH' }} • {{ $santri->jenis == 'TPQ' ? "Taman Pendidikan Qur'an Ar-Raudhah (TPQ)" : "Rumah Tahfidz Qur'an Ar-Raudhah (RTQ)" }}</span>
                </div>
                <div class="flex">
                    <span class="w-32 sm:w-36 font-semibold text-slate-600 shrink-0">Jenis Kelamin</span>
                    <span class="w-3 text-center shrink-0">:</span>
                    <span class="text-slate-800">{{ $santri->jenis_kelamin == 'L' ? 'Laki-laki' : ($santri->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</span>
                </div>
                <div class="flex">
                    <span class="w-32 sm:w-36 font-semibold text-slate-600 shrink-0">Tahun Ujian</span>
                    <span class="w-3 text-center shrink-0">:</span>
                    <span class="text-slate-800">{{ $santri->tahun_munaqasyah ?? '2026' }}</span>
                </div>
            </div>

            <!-- FOTO SISWA KELULUSAN (3x4 PAS FOTO) -->
            <div class="shrink-0 flex flex-col items-center">
                <div class="w-24 h-32 border-2 border-slate-700 p-0.5 bg-white shadow-xs rounded-sm overflow-hidden flex items-center justify-center">
                    <img src="{{ $santri->foto_url }}" alt="Pas Foto {{ $santri->nama }}" class="w-full h-full object-cover">
                </div>
                <span class="text-[9px] font-bold text-slate-500 uppercase tracking-wider mt-1">PAS FOTO SISWA</span>
            </div>
        </div>

        @php $p = $santri->penilaian; @endphp

        <!-- Tabel Transkrip Nilai Database Sekolah (Sesuai 9 Mata Uji Google Sheet) -->
        <div class="mb-6">
            <h4 class="text-xs font-bold text-slate-800 uppercase mb-2 flex items-center gap-1.5">
                <i class="fa-solid fa-square-poll-vertical text-blue-900"></i>
                Rincian Nilai Ujian Database Sekolah
            </h4>
            <div class="overflow-x-auto -mx-1 sm:mx-0">
                <table class="w-full text-center table-nilai border-collapse min-w-[340px]">
                    <thead>
                        <tr class="bg-slate-900 text-white font-extrabold text-[11px] uppercase">
                            <th class="w-10 bg-slate-950">NO</th>
                            <th class="text-left bg-slate-900">BIDANG &amp; MATERI UJIAN</th>
                            <th class="w-20 sm:w-24 bg-slate-900">NILAI</th>
                            <th class="w-28 sm:w-32 bg-slate-950">STANDAR KELULUSAN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        <!-- Kelompok A: Bacaan -->
                        <tr class="bg-blue-50/70 font-bold text-blue-950 text-left">
                            <td colspan="4" class="px-2 py-1">A. DATABASE SEKOLAH BACAAN</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td class="text-left pl-3 sm:pl-4">Fashohah</td>
                            <td class="font-mono font-bold">{{ $p ? number_format($p->fashohah, 0) : '-' }}</td>
                            <td class="text-slate-500">Min. 60</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="text-left pl-3 sm:pl-4">Tajwid</td>
                            <td class="font-mono font-bold">{{ $p ? number_format($p->tajwid, 0) : '-' }}</td>
                            <td class="text-slate-500">Min. 60</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="text-left pl-3 sm:pl-4">Gharib Musykilat</td>
                            <td class="font-mono font-bold">{{ $p ? number_format($p->gharib_musykilat, 0) : '-' }}</td>
                            <td class="text-slate-500">Min. 60</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="text-left pl-3 sm:pl-4">Suara & Lagu</td>
                            <td class="font-mono font-bold">{{ $p ? number_format($p->suara_lagu, 0) : '-' }}</td>
                            <td class="text-slate-500">Min. 60</td>
                        </tr>

                        <!-- Kelompok B: Hafalan -->
                        <tr class="bg-amber-50/60 font-bold text-amber-950 text-left">
                            <td colspan="4" class="px-2 py-1">B. DATABASE SEKOLAH HAFALAN</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td class="text-left pl-3 sm:pl-4">Ayat-ayat Pilihan</td>
                            <td class="font-mono font-bold">{{ $p ? number_format($p->ayat_pilihan, 0) : '-' }}</td>
                            <td class="text-slate-500">Min. 60</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td class="text-left pl-3 sm:pl-4">Surah Pendek</td>
                            <td class="font-mono font-bold">{{ $p ? number_format($p->surah_pendek, 0) : '-' }}</td>
                            <td class="text-slate-500">Min. 60</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td class="text-left pl-3 sm:pl-4">Doa Harian</td>
                            <td class="font-mono font-bold">{{ $p ? number_format($p->doa_harian, 0) : '-' }}</td>
                            <td class="text-slate-500">Min. 60</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td class="text-left pl-3 sm:pl-4">Bacaan Shalat</td>
                            <td class="font-mono font-bold">{{ $p ? number_format($p->bacaan_shalat, 0) : '-' }}</td>
                            <td class="text-slate-500">Min. 60</td>
                        </tr>

                        <!-- Kelompok C: Ujian Tertulis -->
                        <tr class="bg-blue-50/60 font-bold text-blue-950 text-left">
                            <td colspan="4" class="px-2 py-1">C. UJIAN TERTULIS</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td class="text-left pl-3 sm:pl-4">Ujian Tertulis (Dinul Islam / Teori)</td>
                            <td class="font-mono font-bold">{{ $p ? number_format($p->ujian_tertulis, 0) : '-' }}</td>
                            <td class="text-slate-500">Min. 60</td>
                        </tr>

                        <!-- Ringkasan -->
                        <tr class="bg-yellow-100 font-extrabold text-slate-900">
                            <td colspan="2" class="text-right pr-3 sm:pr-4 uppercase">JUMLAH NILAI (TOTAL)</td>
                            <td class="font-mono text-xs">{{ $p ? number_format($p->jumlah_nilai, 0) : '-' }}</td>
                            <td class="text-slate-500">-</td>
                        </tr>
                        <tr class="bg-yellow-200 font-extrabold text-slate-900">
                            <td colspan="2" class="text-right pr-3 sm:pr-4 uppercase">RATA - RATA NILAI</td>
                            <td class="font-mono text-xs sm:text-sm text-blue-950">{{ $p ? number_format($p->rata_rata, 2) : '-' }}</td>
                            <td class="text-slate-700 font-bold">Min. 60.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Box Keputusan Kelulusan -->
        <div class="border-2 {{ $santri->status_kelulusan == 'LULUS' ? 'border-emerald-600 bg-emerald-50/50' : 'border-rose-600 bg-rose-50/50' }} rounded-xl p-3 sm:p-4 mb-6 sm:mb-8 text-center">
            <p class="text-[11px] sm:text-xs uppercase font-semibold text-slate-600">Berdasarkan hasil sidang database sekolah, santri yang bersangkutan dinyatakan:</p>
            <h3 class="text-lg sm:text-xl font-black {{ $santri->status_kelulusan == 'LULUS' ? 'text-emerald-700' : 'text-rose-700' }} tracking-widest my-1 uppercase">
                {{ $santri->status_kelulusan }}
            </h3>
            <p class="text-xs text-slate-800 font-medium">
                Predikat: <span class="font-bold underline">{{ $p ? $p->predikat : '-' }}</span>
            </p>
        </div>

        <!-- Tanda Tangan, Stempel Resmi & QR Code Verifikasi -->
        <div class="grid grid-cols-3 gap-2 sm:gap-4 items-end text-center text-xs mt-6 sm:mt-8 relative z-10">
            <!-- Kolom Ketua Panitia + Stempel -->
            <div class="relative">
                <p class="text-slate-600 mb-12 sm:mb-16">Ketua Panitia Database Sekolah,</p>
                <!-- Stempel Digital Resmi Yayasan -->
                <div class="absolute left-1/2 -translate-x-1/2 top-4 w-24 h-24 sm:w-28 sm:h-28 pointer-events-none select-none opacity-85 -rotate-12">
                    <svg viewBox="0 0 120 120" class="w-full h-full text-blue-800" fill="currentColor">
                        <circle cx="60" cy="60" r="54" fill="none" stroke="currentColor" stroke-width="2.5" stroke-dasharray="3 1.5"/>
                        <circle cx="60" cy="60" r="50" fill="none" stroke="currentColor" stroke-width="1.5"/>
                        <circle cx="60" cy="60" r="34" fill="none" stroke="currentColor" stroke-width="1"/>
                        <path id="stampPathTop" d="M 18,60 A 42,42 0 0,1 102,60" fill="none" stroke="none"/>
                        <path id="stampPathBottom" d="M 102,60 A 42,42 0 0,1 18,60" fill="none" stroke="none"/>
                        <text font-size="8" font-weight="bold" fill="currentColor" letter-spacing="1">
                            <textPath href="#stampPathTop" startOffset="50%" text-anchor="middle">
                                YAYASAN AR-RAUDHAH
                            </textPath>
                        </text>
                        <text font-size="7.5" font-weight="bold" fill="currentColor" letter-spacing="1">
                            <textPath href="#stampPathBottom" startOffset="50%" text-anchor="middle">
                                ★ PANITIA DATABASE SEKOLAH ★
                            </textPath>
                        </text>
                        <text x="60" y="55" font-size="9" font-weight="black" text-anchor="middle" fill="currentColor">SAH</text>
                        <text x="60" y="68" font-size="7" font-weight="bold" text-anchor="middle" fill="currentColor">2026 / 1447 H</text>
                    </svg>
                </div>
                <p class="font-bold text-slate-900 underline uppercase text-[11px] sm:text-xs relative z-10">{{ $settings['ketua_yayasan'] ?? 'H. AHMAD SYAUQI, S.Pd.I' }}</p>
                <p class="text-[10px] text-slate-500">Ketua Pelaksana Database Sekolah</p>
            </div>

            <!-- Kolom Tengah: QR Code Verifikasi Keaslian -->
            <div class="flex flex-col items-center justify-center">
                @php
                    $verifyUrl = route('public.check.cetak', $santri->id);
                    $qrSrc = "https://api.qrserver.com/v1/create-qr-code/?size=110x110&margin=2&data=" . urlencode($verifyUrl);
                @endphp
                <div class="p-1.5 bg-white border border-slate-300 rounded-xl shadow-xs inline-block">
                    <img src="{{ $qrSrc }}" alt="QR Code Verifikasi" class="w-18 h-18 sm:w-20 sm:h-20 object-contain mx-auto" loading="lazy">
                </div>
                <p class="text-[9px] font-black text-slate-800 uppercase tracking-tighter mt-1">VERIFIKASI RESMI</p>
                <p class="text-[8px] text-slate-500 font-mono">Scan QR untuk cek keaslian</p>
            </div>

            <!-- Kolom Penguji -->
            <div>
                <p class="text-slate-600 mb-12 sm:mb-16">Penguji Database Sekolah,</p>
                <p class="font-bold text-slate-900 underline uppercase text-[11px] sm:text-xs">( ............................................ )</p>
                <p class="text-[10px] text-slate-500">Dewan Penguji Database Sekolah</p>
            </div>
        </div>
    </div>
</body>
</html>
