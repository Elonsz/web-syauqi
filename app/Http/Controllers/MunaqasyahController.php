<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Santri;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MunaqasyahController extends Controller
{
    /**
     * Tampilkan data munaqasyah (TPQ & RTQ)
     */
    public function index(Request $request)
    {
        $jenis = $request->get('jenis', 'TPQ'); // default TPQ
        $unitFilter = $request->get('unit');
        $search = $request->get('search');

        $query = Santri::with(['penilaian', 'unit'])
            ->where('jenis', $jenis);

        if ($unitFilter) {
            $query->where('nama_unit', $unitFilter);
        }

        if ($search) {
            $query->where('nama', 'like', "%{$search}%");
        }

        $santris = $query->orderBy('no_peserta', 'asc')->get();
        $units = Unit::where('jenis', $jenis)->get();

        // Statistik
        $totalSantri = $santris->count();
        $totalLulus = $santris->where('status_kelulusan', 'LULUS')->count();
        $rataRataKeseluruhan = $santris->avg(function ($s) {
            return $s->penilaian ? $s->penilaian->rata_rata : 0;
        });

        return view('munaqasyah.index', compact(
            'santris',
            'units',
            'jenis',
            'totalSantri',
            'totalLulus',
            'rataRataKeseluruhan'
        ));
    }

    /**
     * Form tambah santri & nilai munaqasyah
     */
    public function create(Request $request)
    {
        $jenis = $request->get('jenis', 'TPQ');
        $units = Unit::all();
        return view('munaqasyah.create', compact('jenis', 'units'));
    }

    /**
     * Simpan data santri, foto, dan penilaian
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:TPQ,RTQ',
            'no_peserta' => 'nullable|string|max:50',
            'no_unit' => 'nullable|string|max:50',
            'nama_unit' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 2MB max
            // Nilai
            'fashohah' => 'nullable|numeric|min:0|max:100',
            'tajwid' => 'nullable|numeric|min:0|max:100',
            'gharib_musykilat' => 'nullable|numeric|min:0|max:100',
            'suara_lagu' => 'nullable|numeric|min:0|max:100',
            'ayat_pilihan' => 'nullable|numeric|min:0|max:100',
            'surah_pendek' => 'nullable|numeric|min:0|max:100',
            'doa_harian' => 'nullable|numeric|min:0|max:100',
            'bacaan_shalat' => 'nullable|numeric|min:0|max:100',
            'ujian_tertulis' => 'nullable|numeric|min:0|max:100',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_santri', 'public');
        }

        // Cari atau buat unit
        $unit = Unit::firstOrCreate(
            ['nama_unit' => $request->nama_unit, 'jenis' => $request->jenis],
            ['no_unit' => $request->no_unit ?? '01']
        );

        $santri = Santri::create([
            'no_peserta' => $request->no_peserta,
            'no_unit' => $request->no_unit,
            'nama' => strtoupper($request->nama),
            'unit_id' => $unit->id,
            'nama_unit' => $request->nama_unit,
            'jenis' => $request->jenis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nisn' => $request->nisn,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nama_wali' => $request->nama_wali,
            'foto' => $fotoPath,
            'tahun_munaqasyah' => $request->tahun_munaqasyah ?? '2026',
            'status_kelulusan' => $request->status_kelulusan ?? 'LULUS',
            'keterangan' => $request->keterangan,
        ]);

        // Simpan nilai
        $penilaian = new Penilaian([
            'santri_id' => $santri->id,
            'fashohah' => $request->fashohah ?? 0,
            'tajwid' => $request->tajwid ?? 0,
            'gharib_musykilat' => $request->gharib_musykilat ?? 0,
            'suara_lagu' => $request->suara_lagu ?? 0,
            'ayat_pilihan' => $request->ayat_pilihan ?? 0,
            'surah_pendek' => $request->surah_pendek ?? 0,
            'doa_harian' => $request->doa_harian ?? 0,
            'bacaan_shalat' => $request->bacaan_shalat ?? 0,
            'ujian_tertulis' => $request->ujian_tertulis ?? 0,
            'catatan' => $request->catatan,
        ]);

        $penilaian->hitungNilai();
        $penilaian->save();

        return redirect()->route('munaqasyah.index', ['jenis' => $santri->jenis])
            ->with('success', "Data santri {$santri->nama} dan nilai munaqasyah berhasil disimpan.");
    }

    /**
     * Form edit santri & nilai
     */
    public function edit($id)
    {
        $santri = Santri::with(['penilaian', 'unit'])->findOrFail($id);
        $units = Unit::all();
        return view('munaqasyah.edit', compact('santri', 'units'));
    }

    /**
     * Update data santri & upload foto baru jika ada
     */
    public function update(Request $request, $id)
    {
        $santri = Santri::with('penilaian')->findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:TPQ,RTQ',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Jika upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($santri->foto && Storage::disk('public')->exists($santri->foto)) {
                Storage::disk('public')->delete($santri->foto);
            }
            $santri->foto = $request->file('foto')->store('foto_santri', 'public');
        }

        $santri->no_peserta = $request->no_peserta;
        $santri->no_unit = $request->no_unit;
        $santri->nama = strtoupper($request->nama);
        $santri->nama_unit = $request->nama_unit;
        $santri->jenis = $request->jenis;
        $santri->jenis_kelamin = $request->jenis_kelamin;
        $santri->nisn = $request->nisn;
        $santri->tempat_lahir = $request->tempat_lahir;
        $santri->tanggal_lahir = $request->tanggal_lahir;
        $santri->nama_wali = $request->nama_wali;
        $santri->tahun_munaqasyah = $request->tahun_munaqasyah ?? '2026';
        $santri->status_kelulusan = $request->status_kelulusan ?? 'LULUS';
        $santri->keterangan = $request->keterangan;
        $santri->save();

        // Update nilai
        $penilaian = $santri->penilaian ?? new Penilaian(['santri_id' => $santri->id]);
        $penilaian->fashohah = $request->fashohah ?? 0;
        $penilaian->tajwid = $request->tajwid ?? 0;
        $penilaian->gharib_musykilat = $request->gharib_musykilat ?? 0;
        $penilaian->suara_lagu = $request->suara_lagu ?? 0;
        $penilaian->ayat_pilihan = $request->ayat_pilihan ?? 0;
        $penilaian->surah_pendek = $request->surah_pendek ?? 0;
        $penilaian->doa_harian = $request->doa_harian ?? 0;
        $penilaian->bacaan_shalat = $request->bacaan_shalat ?? 0;
        $penilaian->ujian_tertulis = $request->ujian_tertulis ?? 0;
        $penilaian->catatan = $request->catatan;

        $penilaian->hitungNilai();
        $penilaian->save();

        return redirect()->route('munaqasyah.index', ['jenis' => $santri->jenis])
            ->with('success', "Data santri {$santri->nama} berhasil diperbarui.");
    }

    /**
     * Hapus data santri & foto
     */
    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);
        $jenis = $santri->jenis;

        if ($santri->foto && Storage::disk('public')->exists($santri->foto)) {
            Storage::disk('public')->delete($santri->foto);
        }

        $santri->delete();

        return redirect()->route('munaqasyah.index', ['jenis' => $jenis])
            ->with('success', 'Data santri berhasil dihapus.');
    }

    /**
     * Tampilan Surat Keterangan Kelulusan / Sertifikat dengan Foto Siswa
     */
    public function kelulusan($id)
    {
        $santri = Santri::with(['penilaian', 'unit'])->findOrFail($id);
        $settings = \App\Models\Setting::getAll();
        return view('munaqasyah.kelulusan', compact('santri', 'settings'));
    }

    /**
     * Cetak Massal Surat Kelulusan (Multi-halaman)
     */
    public function cetakMassal(Request $request)
    {
        $jenis = $request->get('jenis', 'TPQ');
        $status = $request->get('status', 'LULUS');
        $santriIds = $request->get('ids');

        $query = Santri::with(['penilaian', 'unit'])->where('jenis', $jenis);

        if (!empty($santriIds)) {
            $ids = is_array($santriIds) ? $santriIds : explode(',', $santriIds);
            $query->whereIn('id', $ids);
        } elseif ($status && $status !== 'SEMUA') {
            $query->where('status_kelulusan', $status);
        }

        if ($request->filled('unit')) {
            $query->where('nama_unit', $request->unit);
        }

        $santris = $query->orderBy('no_peserta', 'asc')->get();
        $settings = \App\Models\Setting::getAll();

        if ($santris->isEmpty()) {
            return back()->with('error', "Tidak ada data santri {$jenis} yang memenuhi kriteria untuk dicetak massal.");
        }

        return view('munaqasyah.cetak_massal', compact('santris', 'jenis', 'settings'));
    }

    /**
     * Export data munaqasyah ke format Microsoft Excel (.xls) dengan styling tabel kuning persis
     */
    public function exportExcel(Request $request)
    {
        $jenis = $request->get('jenis', 'TPQ');
        $query = Santri::with(['penilaian', 'unit'])->where('jenis', $jenis);

        if ($request->filled('unit')) {
            $query->where('nama_unit', $request->unit);
        }

        $santris = $query->orderBy('no_peserta', 'asc')->get();

        $filename = "PENILAIAN_MUNAQASYAH_{$jenis}_KOTA_2026.xls";

        return response()
            ->view('munaqasyah.export_excel', compact('santris', 'jenis'))
            ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"")
            ->header('Cache-Control', 'max-age=0');
    }

    /**
     * Export data munaqasyah ke format CSV Spreadsheet (kompatibel langsung dengan Google Sheets)
     */
    public function exportCsv(Request $request)
    {
        $jenis = $request->get('jenis', 'TPQ');
        $query = Santri::with(['penilaian', 'unit'])->where('jenis', $jenis);

        if ($request->filled('unit')) {
            $query->where('nama_unit', $request->unit);
        }

        $santris = $query->orderBy('no_peserta', 'asc')->get();

        $filename = "PENILAIAN_MUNAQASYAH_{$jenis}_KOTA_2026.csv";

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($santris) {
            $file = fopen('php://output', 'w');
            // BOM UTF-8 agar karakter terbaca sempurna di Excel / Google Sheets
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header Baris 1
            fputcsv($file, [
                'NO. PESERTA',
                'NO. UNIT',
                'NAMA',
                'NAMA UNIT',
                'FASHOHAH (BACAAN)',
                'TAJWID (BACAAN)',
                'GHARIB MUSYKILAT (BACAAN)',
                'SUARA & LAGU (BACAAN)',
                'AYAT-AYAT PILIHAN (HAFALAN)',
                'SURAH PENDEK (HAFALAN)',
                'DOA HARIAN (HAFALAN)',
                'BACAAN SHALAT (HAFALAN)',
                'UJIAN TERTULIS',
                'JUMLAH NILAI',
                'RATA-RATA',
                'STATUS KELULUSAN',
                'PREDIKAT'
            ]);

            foreach ($santris as $s) {
                $p = $s->penilaian;
                fputcsv($file, [
                    $s->no_peserta ?? '',
                    $s->no_unit ?? '',
                    $s->nama,
                    $s->nama_unit ?? 'AL-FALAH',
                    $p ? $p->fashohah : 0,
                    $p ? $p->tajwid : 0,
                    $p ? $p->gharib_musykilat : 0,
                    $p ? $p->suara_lagu : 0,
                    $p ? $p->ayat_pilihan : 0,
                    $p ? $p->surah_pendek : 0,
                    $p ? $p->doa_harian : 0,
                    $p ? $p->bacaan_shalat : 0,
                    $p ? $p->ujian_tertulis : 0,
                    $p ? $p->jumlah_nilai : 0,
                    $p ? number_format($p->rata_rata, 2) : 0,
                    $s->status_kelulusan,
                    $p ? $p->predikat : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
