<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Setting;
use Illuminate\Http\Request;

class PublicCheckController extends Controller
{
    /**
     * Tampilan utama portal cek kelulusan publik untuk wali santri
     */
    public function index(Request $request)
    {
        $keyword = trim($request->get('q', ''));
        $jenis   = $request->get('jenis', '');
        $santri  = null;
        $searched = false;
        $allResults = collect();

        if (!empty($keyword)) {
            $searched = true;
            $query = Santri::with(['penilaian', 'unit']);

            if (!empty($jenis)) {
                $query->where('jenis', $jenis);
            }

            // Pencarian berdasarkan no_peserta (exact/prefix) atau nama (fuzzy)
            $allResults = $query->where(function ($q) use ($keyword) {
                $q->where('no_peserta', $keyword)
                  ->orWhere('no_peserta', 'like', "%{$keyword}%")
                  ->orWhere('nama', 'like', "%{$keyword}%");
            })->take(10)->get();

            if ($allResults->count() === 1) {
                $santri = $allResults->first();
            }
        }

        $settings = Setting::getAll();

        return view('public.cek_kelulusan', compact('keyword', 'jenis', 'santri', 'allResults', 'searched', 'settings'));
    }

    /**
     * Detail atau cetak surat kelulusan publik
     */
    public function show($id)
    {
        $santri = Santri::with(['penilaian', 'unit'])->findOrFail($id);
        $settings = Setting::getAll();

        return view('public.detail_kelulusan', compact('santri', 'settings'));
    }
}
