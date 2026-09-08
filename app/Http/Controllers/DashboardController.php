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

        $santriTerbaru  = Santri::latest()->take(10)->get();

        return view('dashboard.index', compact(
            'totalSemua', 'totalTPQ', 'totalRTQ',
            'totalLulus', 'totalTidakLulus',
            'lulusTPQ', 'tidakLulusTPQ',
            'lulusRTQ', 'tidakLulusRTQ',
            'rataRataGlobal', 'rataTPQ', 'rataRTQ',
            'santriTerbaru'
        ));
    }
}
