<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $semua = Santri::with('penilaian')->get();

        $santriTPQ = $semua->where('jenis', 'TPQ');
        $santriRTQ = $semua->where('jenis', 'RTQ');

        $totalSemua      = $semua->count();
        $totalTPQ        = $santriTPQ->count();
        $totalRTQ        = $santriRTQ->count();

        $totalLulus      = $semua->where('status_kelulusan', 'LULUS')->count();
        $totalTidakLulus = $semua->where('status_kelulusan', 'TIDAK LULUS')->count();

        $lulusTPQ        = $santriTPQ->where('status_kelulusan', 'LULUS')->count();
        $tidakLulusTPQ   = $santriTPQ->where('status_kelulusan', 'TIDAK LULUS')->count();
        $lulusRTQ        = $santriRTQ->where('status_kelulusan', 'LULUS')->count();
        $tidakLulusRTQ   = $santriRTQ->where('status_kelulusan', 'TIDAK LULUS')->count();

        $rataRataGlobal = $semua->avg(fn($s) => $s->penilaian?->rata_rata ?? 0);
        $rataTPQ        = $santriTPQ->avg(fn($s) => $s->penilaian?->rata_rata ?? 0);
        $rataRTQ        = $santriRTQ->avg(fn($s) => $s->penilaian?->rata_rata ?? 0);

        // Predikat Distribution
        $predikatCounts = [
            'Mumtaz (Istimewa)' => 0,
            'Jayyid Jiddan (Sangat Baik)' => 0,
            'Jayyid (Baik)' => 0,
            'Maqbul (Cukup)' => 0,
            'Rasib (Kurang)' => 0,
        ];

        foreach ($semua as $s) {
            $p = $s->penilaian;
            if ($p && $p->predikat) {
                if (isset($predikatCounts[$p->predikat])) {
                    $predikatCounts[$p->predikat]++;
                } else {
                    // Fallback matching partial strings
                    if (str_contains($p->predikat, 'Mumtaz')) $predikatCounts['Mumtaz (Istimewa)']++;
                    elseif (str_contains($p->predikat, 'Jayyid Jiddan')) $predikatCounts['Jayyid Jiddan (Sangat Baik)']++;
                    elseif (str_contains($p->predikat, 'Jayyid')) $predikatCounts['Jayyid (Baik)']++;
                    elseif (str_contains($p->predikat, 'Maqbul')) $predikatCounts['Maqbul (Cukup)']++;
                    else $predikatCounts['Rasib (Kurang)']++;
                }
            }
        }

        // 9 Komponen Nilai Rata-rata
        $komponenLabels = [
            'Fashohah', 'Tajwid', 'Gharib', 'Suara/Lagu', 
            'Ayat Pilihan', 'Surah Pendek', 'Doa Harian', 'Bacaan Shalat', 'Tertulis'
        ];

        $komponenKeys = [
            'fashohah', 'tajwid', 'gharib_musykilat', 'suara_lagu',
            'ayat_pilihan', 'surah_pendek', 'doa_harian', 'bacaan_shalat', 'ujian_tertulis'
        ];

        $avgKomponenSemua = [];
        $avgKomponenTPQ = [];
        $avgKomponenRTQ = [];

        foreach ($komponenKeys as $key) {
            $avgKomponenSemua[] = round($semua->avg(fn($s) => $s->penilaian?->$key ?? 0), 1);
            $avgKomponenTPQ[] = round($santriTPQ->avg(fn($s) => $s->penilaian?->$key ?? 0), 1);
            $avgKomponenRTQ[] = round($santriRTQ->avg(fn($s) => $s->penilaian?->$key ?? 0), 1);
        }

        $santriTerbaru  = Santri::latest()->take(10)->get();

        return view('dashboard.index', compact(
            'totalSemua', 'totalTPQ', 'totalRTQ',
            'totalLulus', 'totalTidakLulus',
            'lulusTPQ', 'tidakLulusTPQ',
            'lulusRTQ', 'tidakLulusRTQ',
            'rataRataGlobal', 'rataTPQ', 'rataRTQ',
            'predikatCounts',
            'komponenLabels',
            'avgKomponenSemua', 'avgKomponenTPQ', 'avgKomponenRTQ',
            'santriTerbaru'
        ));
    }
}
