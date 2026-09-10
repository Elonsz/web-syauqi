<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Unit;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportSantriController extends Controller
{
    /**
     * Tampilkan form upload import
     */
    public function showImportForm(Request $request)
    {
        $jenis = $request->get('jenis', 'TPQ');
        return view('database_sekolah.import', compact('jenis'));
    }

    /**
     * Download format template CSV
     */
    public function downloadTemplate(Request $request)
    {
        $jenis = $request->get('jenis', 'TPQ');
        $filename = "template_import_munaqasyah_{$jenis}.csv";

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($jenis) {
            $file = fopen('php://output', 'w');
            // BOM UTF-8
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Kolom Header
            fputcsv($file, [
                'NO_PESERTA',
                'NO_UNIT',
                'NAMA_SANTRI',
                'JENIS_KELAMIN',
                'NAMA_UNIT',
                'FASHOHAH',
                'TAJWID',
                'GHARIB_MUSYKILAT',
                'SUARA_LAGU',
                'AYAT_PILIHAN',
                'SURAH_PENDEK',
                'DOA_HARIAN',
                'BACAAN_SHALAT',
                'UJIAN_TERTULIS'
            ]);

            // Baris Contoh 1
            fputcsv($file, [
                $jenis === 'TPQ' ? '001' : '101',
                '01',
                'Muhammad Rayhan Pratama',
                'L',
                'Unit Ar-Raudhah Pusat',
                '85',
                '88',
                '84',
                '82',
                '86',
                '90',
                '88',
                '85',
                '87'
            ]);

            // Baris Contoh 2
            fputcsv($file, [
                $jenis === 'TPQ' ? '002' : '102',
                '01',
                'Aisyah Nur Salsabila',
                'P',
                'Unit Ar-Raudhah Pusat',
                '90',
                '92',
                '89',
                '88',
                '95',
                '96',
                '92',
                '90',
                '91'
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Proses file CSV yang diunggah
     */
    public function import(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:TPQ,RTQ',
            'file' => 'required|file|mimes:csv,txt|max:5120',
        ], [
            'file.required' => 'Silakan pilih file CSV yang ingin diimpor.',
            'file.mimes' => 'Format file harus berupa CSV (.csv) atau TXT teks terpisah koma/titik-koma.',
            'file.max' => 'Ukuran file maksimal 5 MB.'
        ]);

        $jenis = $request->jenis;
        $path = $request->file('file')->getRealPath();

        // Deteksi delimiter
        $sampleLine = '';
        $handle = fopen($path, 'r');
        if ($handle) {
            $sampleLine = fgets($handle);
            fclose($handle);
        }

        $delimiter = ',';
        if (substr_count($sampleLine, ';') > substr_count($sampleLine, ',')) {
            $delimiter = ';';
        } elseif (substr_count($sampleLine, "\t") > substr_count($sampleLine, ',')) {
            $delimiter = "\t";
        }

        $handle = fopen($path, 'r');
        if (!$handle) {
            return back()->with('error', 'Gagal membuka file CSV.');
        }

        $rowNumber = 0;
        $importedCount = 0;
        $updatedCount = 0;
        $skippedCount = 0;
        $errors = [];

        DB::beginTransaction();

        try {
            while (($data = fgetcsv($handle, 4096, $delimiter)) !== false) {
                $rowNumber++;

                // Skip baris pertama jika header
                if ($rowNumber === 1) {
                    // Bersihkan karakter BOM dari header
                    $firstCell = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data[0] ?? '');
                    if (str_contains(strtoupper($firstCell), 'PESERTA') || str_contains(strtoupper($data[2] ?? ''), 'NAMA')) {
                        continue;
                    }
                }

                // Cek apakah baris kosong
                if (empty(array_filter($data))) {
                    continue;
                }

                $noPeserta     = trim($data[0] ?? '');
                $noUnit        = trim($data[1] ?? '');
                $nama          = trim($data[2] ?? '');
                $jenisKelamin  = strtoupper(trim($data[3] ?? ''));
                $namaUnit      = trim($data[4] ?? '');
                $fashohah      = floatval(str_replace(',', '.', trim($data[5] ?? '0')));
                $tajwid        = floatval(str_replace(',', '.', trim($data[6] ?? '0')));
                $gharib        = floatval(str_replace(',', '.', trim($data[7] ?? '0')));
                $suaraLagu     = floatval(str_replace(',', '.', trim($data[8] ?? '0')));
                $ayatPilihan   = floatval(str_replace(',', '.', trim($data[9] ?? '0')));
                $surahPendek   = floatval(str_replace(',', '.', trim($data[10] ?? '0')));
                $doaHarian     = floatval(str_replace(',', '.', trim($data[11] ?? '0')));
                $bacaanShalat  = floatval(str_replace(',', '.', trim($data[12] ?? '0')));
                $ujianTertulis = floatval(str_replace(',', '.', trim($data[13] ?? '0')));

                if (empty($nama)) {
                    $skippedCount++;
                    continue;
                }

                if (!in_array($jenisKelamin, ['L', 'P'])) {
                    $jenisKelamin = null;
                }

                // Cari atau buat Unit jika ada namaUnit
                $unitId = null;
                if (!empty($namaUnit)) {
                    $unit = Unit::firstOrCreate(
                        ['nama_unit' => $namaUnit],
                        ['no_unit' => $noUnit ?: '01']
                    );
                    $unitId = $unit->id;
                }

                // Cari santri berdasarkan no_peserta + jenis ATAU nama + jenis
                $santri = null;
                if (!empty($noPeserta)) {
                    $santri = Santri::where('jenis', $jenis)->where('no_peserta', $noPeserta)->first();
                }
                if (!$santri) {
                    $santri = Santri::where('jenis', $jenis)->where('nama', $nama)->first();
                }

                $isNew = false;
                if (!$santri) {
                    $santri = new Santri();
                    $santri->jenis = $jenis;
                    $isNew = true;
                }

                $santri->no_peserta = $noPeserta ?: ($santri->no_peserta ?? sprintf('%03d', $rowNumber));
                $santri->no_unit = $noUnit ?: ($santri->no_unit ?? '01');
                $santri->nama = $nama;
                $santri->nama_unit = $namaUnit ?: ($santri->nama_unit ?? '-');
                $santri->unit_id = $unitId ?: $santri->unit_id;
                if ($jenisKelamin) {
                    $santri->jenis_kelamin = $jenisKelamin;
                }
                $santri->save();

                // Simpan Penilaian
                $penilaian = Penilaian::firstOrNew(['santri_id' => $santri->id]);
                $penilaian->fashohah = $fashohah;
                $penilaian->tajwid = $tajwid;
                $penilaian->gharib_musykilat = $gharib;
                $penilaian->suara_lagu = $suaraLagu;
                $penilaian->ayat_pilihan = $ayatPilihan;
                $penilaian->surah_pendek = $surahPendek;
                $penilaian->doa_harian = $doaHarian;
                $penilaian->bacaan_shalat = $bacaanShalat;
                $penilaian->ujian_tertulis = $ujianTertulis;

                $penilaian->hitungNilai();
                $penilaian->save();

                // Sinkronkan status kelulusan ke santri
                $santri->status_kelulusan = $penilaian->status_kelulusan;
                $santri->save();

                if ($isNew) {
                    $importedCount++;
                } else {
                    $updatedCount++;
                }
            }

            fclose($handle);
            DB::commit();

            return redirect()->route('database_sekolah.index', ['jenis' => $jenis])
                ->with('success', "Proses import berhasil! {$importedCount} data santri baru ditambahkan, {$updatedCount} data diperbarui.");
        } catch (\Exception $e) {
            DB::rollBack();
            if (is_resource($handle)) {
                fclose($handle);
            }
            return back()->with('error', "Gagal mengimpor data pada baris {$rowNumber}: " . $e->getMessage());
        }
    }
}
