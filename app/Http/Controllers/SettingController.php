<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Tampilkan halaman pengaturan surat dan identitas lembaga
     */
    public function index()
    {
        $settings = Setting::getAll();
        return view('settings.index', compact('settings'));
    }

    /**
     * Simpan pembaruan pengaturan
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_yayasan'           => 'required|string|max:255',
            'alamat_yayasan'         => 'nullable|string|max:255',
            'ketua_yayasan'          => 'required|string|max:255',
            'kepala_tpq'             => 'required|string|max:255',
            'kepala_rtq'             => 'required|string|max:255',
            'tanggal_surat_masehi'   => 'required|string|max:100',
            'tanggal_surat_hijriyah' => 'required|string|max:100',
            'nomor_sk_munaqasyah'    => 'nullable|string|max:150',
            'tahun_ajaran'           => 'nullable|string|max:50',
        ]);

        $keys = [
            'nama_yayasan',
            'alamat_yayasan',
            'ketua_yayasan',
            'kepala_tpq',
            'kepala_rtq',
            'tanggal_surat_masehi',
            'tanggal_surat_hijriyah',
            'nomor_sk_munaqasyah',
            'tahun_ajaran',
        ];

        foreach ($keys as $key) {
            Setting::set($key, $request->input($key));
        }

        return redirect()->route('settings.index')->with('success', 'Pengaturan surat kelulusan & identitas lembaga berhasil disimpan.');
    }
}
