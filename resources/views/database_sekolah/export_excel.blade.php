<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        table {
            border-collapse: collapse;
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
        }
        th, td {
            border: 1px solid #000000;
            padding: 6px 10px;
            vertical-align: middle;
        }
        .header-top {
            background-color: #FFFF00;
            font-weight: bold;
            text-align: center;
        }
        .header-bacaan {
            background-color: #FFFF00;
            font-weight: bold;
            text-align: center;
        }
        .header-hafalan {
            background-color: #FFFF00;
            font-weight: bold;
            text-align: center;
        }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .danger-row {
            background-color: #FF0000;
            color: #FFFFFF;
        }
    </style>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th colspan="13" style="font-size: 14pt; font-weight: bold; text-align: center; border: none; height: 35px; background-color: #FFFF00;">
                    PENILAIAN DATABASE SEKOLAH KOTA 2026 ({{ $jenis }})
                </th>
            </tr>
            <tr>
                <th rowspan="2" class="header-top" style="width: 70px;">NO. PESERTA</th>
                <th rowspan="2" class="header-top" style="width: 70px;">NO. UNIT</th>
                <th rowspan="2" class="header-top" style="width: 250px;">NAMA</th>
                <th rowspan="2" class="header-top" style="width: 120px;">NAMA UNIT</th>
                <th colspan="4" class="header-bacaan">DATABASE SEKOLAH BACAAN</th>
                <th colspan="4" class="header-hafalan">DATABASE SEKOLAH HAFALAN</th>
                <th rowspan="2" class="header-top" style="width: 90px;">UJIAN TERTULIS</th>
                <th rowspan="2" class="header-top" style="width: 90px;">JUMLAH NILAI</th>
                <th rowspan="2" class="header-top" style="width: 90px;">RATA - RATA</th>
            </tr>
            <tr>
                <!-- DATABASE SEKOLAH BACAAN -->
                <th class="header-bacaan" style="width: 80px;">FASHOHAH</th>
                <th class="header-bacaan" style="width: 80px;">TAJWID</th>
                <th class="header-bacaan" style="width: 95px;">GHARIB MUSYKILAT</th>
                <th class="header-bacaan" style="width: 85px;">SUARA & LAGU</th>
                <!-- DATABASE SEKOLAH HAFALAN -->
                <th class="header-hafalan" style="width: 95px;">AYAT-AYAT PILIHAN</th>
                <th class="header-hafalan" style="width: 85px;">SURAH PENDEK</th>
                <th class="header-hafalan" style="width: 85px;">DOA HARIAN</th>
                <th class="header-hafalan" style="width: 85px;">BACAAN SHALAT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($santris as $index => $santri)
                @php
                    $p = $santri->penilaian;
                    $isRed = ($p && $p->rata_rata < 60) || ($santri->status_kelulusan == 'TIDAK LULUS');
                @endphp
                <tr @if($isRed) style="background-color: #FF0000; color: #FFFFFF;" @endif>
                    <td class="text-center">{{ $santri->no_peserta ?? ($index + 1) }}</td>
                    <td class="text-center">{{ $santri->no_unit ?? ($index + 1) }}</td>
                    <td class="text-left" style="font-weight: bold;">{{ strtoupper($santri->nama) }}</td>
                    <td class="text-center">{{ $santri->nama_unit ?? 'AL-FALAH' }}</td>
                    
                    <!-- Nilai Bacaan -->
                    <td class="text-center">{{ $p ? $p->fashohah : 0 }}</td>
                    <td class="text-center">{{ $p ? $p->tajwid : 0 }}</td>
                    <td class="text-center">{{ $p ? $p->gharib_musykilat : 0 }}</td>
                    <td class="text-center">{{ $p ? $p->suara_lagu : 0 }}</td>

                    <!-- Nilai Hafalan -->
                    <td class="text-center">{{ $p ? $p->ayat_pilihan : 0 }}</td>
                    <td class="text-center">{{ $p ? $p->surah_pendek : 0 }}</td>
                    <td class="text-center">{{ $p ? $p->doa_harian : 0 }}</td>
                    <td class="text-center">{{ $p ? $p->bacaan_shalat : 0 }}</td>

                    <!-- Ujian Tertulis -->
                    <td class="text-center">{{ $p ? $p->ujian_tertulis : 0 }}</td>

                    <!-- Jumlah Nilai & Rata-rata -->
                    <td class="text-center font-bold" style="background-color: #FFF9C4;">
                        {{ $p ? $p->jumlah_nilai : 0 }}
                    </td>
                    <td class="text-center font-bold" style="background-color: #FFF59D;">
                        {{ $p ? number_format($p->rata_rata, 2) : 0 }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
