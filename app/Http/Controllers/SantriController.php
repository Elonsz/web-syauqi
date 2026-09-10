<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Unit;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SantriController extends Controller
{
    /**
     * Tampilkan daftar biodata siswa (dipisah dari tabel penilaian)
     */
    public function index(Request $request)
    {
        $jenis = $request->get('jenis'); // null = semua, or 'TPQ', 'RTQ'
        $unitFilter = $request->get('unit');
        $search = $request->get('search');
        $statusFilter = $request->get('status'); // 'LULUS', 'TIDAK LULUS', 'PENDING'

        $query = Santri::with(['penilaian', 'unit']);

        if ($jenis) {
            $query->where('jenis', $jenis);
        }

        if ($unitFilter) {
            $query->where('nama_unit', $unitFilter);
        }

        if ($statusFilter) {
            $query->where('status_kelulusan', $statusFilter);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_peserta', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('nama_wali', 'like', "%{$search}%");
            });
        }

        $santris = $query->orderBy('jenis', 'asc')
                         ->orderBy('no_peserta', 'asc')
                         ->get();

        $units = Unit::all();

        // Statistik Cepat
        $totalSantri = Santri::count();
        $totalTPQ    = Santri::where('jenis', 'TPQ')->count();
        $totalRTQ    = Santri::where('jenis', 'RTQ')->count();
        $totalLaki   = Santri::where('jenis_kelamin', 'L')->count();
        $totalPerem  = Santri::where('jenis_kelamin', 'P')->count();
        $sudahNilai  = Santri::has('penilaian')->count();
        $belumNilai  = Santri::doesntHave('penilaian')->count();

        return view('santri.index', compact(
            'santris',
            'units',
            'jenis',
            'unitFilter',
            'search',
            'statusFilter',
            'totalSantri',
            'totalTPQ',
            'totalRTQ',
            'totalLaki',
            'totalPerem',
            'sudahNilai',
            'belumNilai'
        ));
    }

    /**
     * Form tambah biodata siswa baru (tanpa input penilaian)
     */
    public function create(Request $request)
    {
        $jenis = $request->get('jenis', 'TPQ');
        $units = Unit::all();
        return view('santri.create', compact('jenis', 'units'));
    }

    /**
     * Simpan data biodata siswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'jenis'           => 'required|in:TPQ,RTQ',
            'no_peserta'      => 'nullable|string|max:50',
            'no_unit'         => 'nullable|string|max:50',
            'nama_unit'       => 'required|string|max:255',
            'jenis_kelamin'   => 'nullable|in:L,P',
            'nisn'            => 'nullable|string|max:50',
            'tempat_lahir'    => 'nullable|string|max:100',
            'tanggal_lahir'   => 'nullable|date',
            'nama_wali'       => 'nullable|string|max:255',
            'foto'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tahun_munaqasyah'=> 'nullable|string|max:10',
            'keterangan'      => 'nullable|string',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_santri', 'public');
        }

        // Cari atau buat unit lembaga
        $unit = Unit::firstOrCreate(
            ['nama_unit' => $request->nama_unit, 'jenis' => $request->jenis],
            ['no_unit' => $request->no_unit ?? '01']
        );

        $santri = Santri::create([
            'no_peserta'       => $request->no_peserta,
            'no_unit'          => $request->no_unit,
            'nama'             => strtoupper($request->nama),
            'unit_id'          => $unit->id,
            'nama_unit'        => $request->nama_unit,
            'jenis'            => $request->jenis,
            'jenis_kelamin'    => $request->jenis_kelamin,
            'nisn'             => $request->nisn,
            'tempat_lahir'     => $request->tempat_lahir,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'nama_wali'        => $request->nama_wali,
            'foto'             => $fotoPath,
            'tahun_munaqasyah' => $request->tahun_munaqasyah ?? '2026',
            'status_kelulusan' => 'PENDING',
            'keterangan'       => $request->keterangan,
        ]);

        // Jika user memilih tombol "Simpan & Input Penilaian"
        if ($request->input('action') === 'save_and_grade') {
            return redirect()->route('database_sekolah.edit', $santri->id)
                ->with('success', "Biodata santri {$santri->nama} berhasil disimpan. Silakan lanjutkan mengisi nilai database sekolah.");
        }

        return redirect()->route('santri.index', ['jenis' => $santri->jenis])
            ->with('success', "Biodata santri {$santri->nama} berhasil didaftarkan.");
    }

    /**
     * Tampilkan profil / detail biodata siswa lengkap
     */
    public function show($id)
    {
        $santri = Santri::with(['penilaian', 'unit'])->findOrFail($id);
        return view('santri.show', compact('santri'));
    }

    /**
     * Form edit biodata siswa
     */
    public function edit($id)
    {
        $santri = Santri::findOrFail($id);
        $units = Unit::all();
        return view('santri.edit', compact('santri', 'units'));
    }

    /**
     * Simpan perubahan biodata siswa
     */
    public function update(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);

        $request->validate([
            'nama'            => 'required|string|max:255',
            'jenis'           => 'required|in:TPQ,RTQ',
            'no_peserta'      => 'nullable|string|max:50',
            'no_unit'         => 'nullable|string|max:50',
            'nama_unit'       => 'required|string|max:255',
            'jenis_kelamin'   => 'nullable|in:L,P',
            'nisn'            => 'nullable|string|max:50',
            'tempat_lahir'    => 'nullable|string|max:100',
            'tanggal_lahir'   => 'nullable|date',
            'nama_wali'       => 'nullable|string|max:255',
            'foto'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tahun_munaqasyah'=> 'nullable|string|max:10',
            'status_kelulusan'=> 'nullable|in:LULUS,TIDAK LULUS,PENDING',
            'keterangan'      => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            if ($santri->foto && Storage::disk('public')->exists($santri->foto)) {
                Storage::disk('public')->delete($santri->foto);
            }
            $santri->foto = $request->file('foto')->store('foto_santri', 'public');
        }

        $unit = Unit::firstOrCreate(
            ['nama_unit' => $request->nama_unit, 'jenis' => $request->jenis],
            ['no_unit' => $request->no_unit ?? '01']
        );

        $santri->update([
            'no_peserta'       => $request->no_peserta,
            'no_unit'          => $request->no_unit,
            'nama'             => strtoupper($request->nama),
            'unit_id'          => $unit->id,
            'nama_unit'        => $request->nama_unit,
            'jenis'            => $request->jenis,
            'jenis_kelamin'    => $request->jenis_kelamin,
            'nisn'             => $request->nisn,
            'tempat_lahir'     => $request->tempat_lahir,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'nama_wali'        => $request->nama_wali,
            'tahun_munaqasyah' => $request->tahun_munaqasyah ?? $santri->tahun_munaqasyah,
            'status_kelulusan' => $request->status_kelulusan ?? $santri->status_kelulusan,
            'keterangan'       => $request->keterangan,
        ]);

        return redirect()->route('santri.show', $santri->id)
            ->with('success', "Biodata santri {$santri->nama} berhasil diperbarui.");
    }

    /**
     * Hapus data santri dan nilai terkait
     */
    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);
        $nama = $santri->nama;

        if ($santri->foto && Storage::disk('public')->exists($santri->foto)) {
            Storage::disk('public')->delete($santri->foto);
        }

        if ($santri->penilaian) {
            $santri->penilaian->delete();
        }

        $santri->delete();

        return redirect()->route('santri.index')
            ->with('success', "Data santri {$nama} dan seluruh riwayat penilaiannya berhasil dihapus.");
    }
}
