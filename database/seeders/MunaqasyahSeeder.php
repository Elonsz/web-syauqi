<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\Santri;
use App\Models\Penilaian;
use Illuminate\Database\Seeder;

class MunaqasyahSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Unit TPQ dan RTQ
        $unitTpq = Unit::firstOrCreate(
            ['nama_unit' => 'AL-FALAH', 'jenis' => 'TPQ'],
            [
                'no_unit' => '01',
                'kepala_unit' => 'Ustadz Ahmad',
                'telepon' => '08123456789',
                'alamat' => 'Jl. Al-Falah No. 12',
            ]
        );

        $unitRtq = Unit::firstOrCreate(
            ['nama_unit' => 'AL-FALAH', 'jenis' => 'RTQ'],
            [
                'no_unit' => '01',
                'kepala_unit' => 'Ustadzah Fatimah',
                'telepon' => '08129876543',
                'alamat' => 'Jl. Al-Falah No. 14',
            ]
        );

        // 2. Data Santri TPQ (sesuai Google Sheet)
        $dataTpq = [
            [
                'no_peserta' => '1',
                'no_unit' => '1',
                'nama' => 'ALIIFAH',
                'jenis_kelamin' => 'P',
                'fashohah' => 90, 'tajwid' => 88, 'gharib' => 90, 'suara' => 85,
                'ayat' => 95, 'surah' => 95, 'doa' => 90, 'shalat' => 95,
                'tertulis' => 90
            ],
            [
                'no_peserta' => '2',
                'no_unit' => '2',
                'nama' => 'SRI ADELIA RAHMAWATI',
                'jenis_kelamin' => 'P',
                'fashohah' => 86, 'tajwid' => 88, 'gharib' => 85, 'suara' => 85,
                'ayat' => 85, 'surah' => 80, 'doa' => 80, 'shalat' => 80,
                'tertulis' => 93
            ],
            [
                'no_peserta' => '3',
                'no_unit' => '3',
                'nama' => 'MUHAMMAD IBNU HAZM ANDALUSIA',
                'jenis_kelamin' => 'L',
                'fashohah' => 88, 'tajwid' => 88, 'gharib' => 90, 'suara' => 85,
                'ayat' => 90, 'surah' => 90, 'doa' => 88, 'shalat' => 90,
                'tertulis' => 95
            ],
            [
                'no_peserta' => '4',
                'no_unit' => '4',
                'nama' => 'FAHRIANSYAH',
                'jenis_kelamin' => 'L',
                'fashohah' => 88, 'tajwid' => 88, 'gharib' => 90, 'suara' => 85,
                'ayat' => 80, 'surah' => 85, 'doa' => 90, 'shalat' => 85,
                'tertulis' => 90
            ],
            [
                'no_peserta' => '5',
                'no_unit' => '5',
                'nama' => 'LIYANA HAFIZAH',
                'jenis_kelamin' => 'P',
                'fashohah' => 90, 'tajwid' => 89, 'gharib' => 90, 'suara' => 85,
                'ayat' => 95, 'surah' => 90, 'doa' => 90, 'shalat' => 88,
                'tertulis' => 90
            ],
            [
                'no_peserta' => '6',
                'no_unit' => '6',
                'nama' => 'AZKIA SYAHLA',
                'jenis_kelamin' => 'P',
                'fashohah' => 90, 'tajwid' => 87, 'gharib' => 90, 'suara' => 85,
                'ayat' => 95, 'surah' => 95, 'doa' => 90, 'shalat' => 89,
                'tertulis' => 95
            ],
            [
                'no_peserta' => '7',
                'no_unit' => '7',
                'nama' => 'SATYA TRY ARIFIA',
                'jenis_kelamin' => 'L',
                'fashohah' => 88, 'tajwid' => 90, 'gharib' => 85, 'suara' => 85,
                'ayat' => 80, 'surah' => 90, 'doa' => 85, 'shalat' => 85,
                'tertulis' => 90
            ],
            [
                'no_peserta' => '8',
                'no_unit' => '8',
                'nama' => 'MADINA HABIBATUN JASMINE',
                'jenis_kelamin' => 'P',
                'fashohah' => 90, 'tajwid' => 85, 'gharib' => 90, 'suara' => 85,
                'ayat' => 85, 'surah' => 85, 'doa' => 85, 'shalat' => 85,
                'tertulis' => 75
            ],
            [
                'no_peserta' => '9',
                'no_unit' => '9',
                'nama' => 'MUHAMMAD FATIH',
                'jenis_kelamin' => 'L',
                'fashohah' => 88, 'tajwid' => 87, 'gharib' => 90, 'suara' => 85,
                'ayat' => 85, 'surah' => 90, 'doa' => 80, 'shalat' => 88,
                'tertulis' => 90
            ],
            [
                'no_peserta' => '10',
                'no_unit' => '10',
                'nama' => 'ABDULLAH FAEYZA NABIL',
                'jenis_kelamin' => 'L',
                'fashohah' => 84, 'tajwid' => 88, 'gharib' => 90, 'suara' => 84,
                'ayat' => 80, 'surah' => 85, 'doa' => 85, 'shalat' => 75,
                'tertulis' => 95
            ],
        ];

        foreach ($dataTpq as $d) {
            $santri = Santri::create([
                'no_peserta' => $d['no_peserta'],
                'no_unit' => $d['no_unit'],
                'nama' => $d['nama'],
                'unit_id' => $unitTpq->id,
                'nama_unit' => 'AL-FALAH',
                'jenis' => 'TPQ',
                'jenis_kelamin' => $d['jenis_kelamin'],
                'tahun_munaqasyah' => '2026',
                'status_kelulusan' => 'LULUS',
            ]);

            $penilaian = new Penilaian([
                'fashohah' => $d['fashohah'],
                'tajwid' => $d['tajwid'],
                'gharib_musykilat' => $d['gharib'],
                'suara_lagu' => $d['suara'],
                'ayat_pilihan' => $d['ayat'],
                'surah_pendek' => $d['surah'],
                'doa_harian' => $d['doa'],
                'bacaan_shalat' => $d['shalat'],
                'ujian_tertulis' => $d['tertulis'],
            ]);
            $penilaian->santri_id = $santri->id;
            $penilaian->hitungNilai();
            $penilaian->save();
        }

        // 3. Data Santri RTQ
        $dataRtq = [
            [
                'no_peserta' => '1',
                'no_unit' => '1',
                'nama' => 'MUHAMMAD AZKA ZUHDI',
                'jenis_kelamin' => 'L',
                'fashohah' => 88, 'tajwid' => 89, 'gharib' => 85, 'suara' => 85,
                'ayat' => 85, 'surah' => 85, 'doa' => 85, 'shalat' => 85,
                'tertulis' => 70
            ],
            [
                'no_peserta' => '2',
                'no_unit' => '2',
                'nama' => 'MUHAMMAD ZAKY MUBARAK',
                'jenis_kelamin' => 'L',
                'fashohah' => 90, 'tajwid' => 88, 'gharib' => 90, 'suara' => 85,
                'ayat' => 90, 'surah' => 90, 'doa' => 85, 'shalat' => 83,
                'tertulis' => 90
            ],
            [
                'no_peserta' => '3',
                'no_unit' => '3',
                'nama' => 'AYA SHOFIA',
                'jenis_kelamin' => 'P',
                'fashohah' => 82, 'tajwid' => 89, 'gharib' => 85, 'suara' => 85,
                'ayat' => 80, 'surah' => 85, 'doa' => 75, 'shalat' => 75,
                'tertulis' => 90
            ],
            [
                'no_peserta' => '4',
                'no_unit' => '4',
                'nama' => 'SALSABILLA NADHITA',
                'jenis_kelamin' => 'P',
                'fashohah' => 88, 'tajwid' => 89, 'gharib' => 85, 'suara' => 84,
                'ayat' => 80, 'surah' => 95, 'doa' => 88, 'shalat' => 89,
                'tertulis' => 95
            ],
        ];

        foreach ($dataRtq as $d) {
            $santri = Santri::create([
                'no_peserta' => $d['no_peserta'],
                'no_unit' => $d['no_unit'],
                'nama' => $d['nama'],
                'unit_id' => $unitRtq->id,
                'nama_unit' => 'AL-FALAH',
                'jenis' => 'RTQ',
                'jenis_kelamin' => $d['jenis_kelamin'],
                'tahun_munaqasyah' => '2026',
                'status_kelulusan' => 'LULUS',
            ]);

            $penilaian = new Penilaian([
                'fashohah' => $d['fashohah'],
                'tajwid' => $d['tajwid'],
                'gharib_musykilat' => $d['gharib'],
                'suara_lagu' => $d['suara'],
                'ayat_pilihan' => $d['ayat'],
                'surah_pendek' => $d['surah'],
                'doa_harian' => $d['doa'],
                'bacaan_shalat' => $d['shalat'],
                'ujian_tertulis' => $d['tertulis'],
            ]);
            $penilaian->santri_id = $santri->id;
            $penilaian->hitungNilai();
            $penilaian->save();
        }
    }
}
