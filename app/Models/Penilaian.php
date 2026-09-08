<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'santri_id',
        // Munaqasyah Bacaan
        'fashohah',
        'tajwid',
        'gharib_musykilat',
        'suara_lagu',
        // Munaqasyah Hafalan
        'ayat_pilihan',
        'surah_pendek',
        'doa_harian',
        'bacaan_shalat',
        // Ujian Tertulis
        'ujian_tertulis',
        // Hasil
        'jumlah_nilai',
        'rata_rata',
        'predikat',
        'status_kelulusan',
        'catatan',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    /**
     * Hitung otomatis jumlah nilai, rata-rata, dan predikat
     */
    public function hitungNilai(): void
    {
        $komponen = [
            $this->fashohah ?? 0,
            $this->tajwid ?? 0,
            $this->gharib_musykilat ?? 0,
            $this->suara_lagu ?? 0,
            $this->ayat_pilihan ?? 0,
            $this->surah_pendek ?? 0,
            $this->doa_harian ?? 0,
            $this->bacaan_shalat ?? 0,
            $this->ujian_tertulis ?? 0,
        ];

        $this->jumlah_nilai = array_sum($komponen);
        $this->rata_rata = round($this->jumlah_nilai / 9, 2);

        // Tentukan predikat
        if ($this->rata_rata >= 90) {
            $this->predikat = 'Mumtaz (Istimewa)';
            $this->status_kelulusan = 'LULUS';
        } elseif ($this->rata_rata >= 80) {
            $this->predikat = 'Jayyid Jiddan (Sangat Baik)';
            $this->status_kelulusan = 'LULUS';
        } elseif ($this->rata_rata >= 70) {
            $this->predikat = 'Jayyid (Baik)';
            $this->status_kelulusan = 'LULUS';
        } elseif ($this->rata_rata >= 60) {
            $this->predikat = 'Maqbul (Cukup)';
            $this->status_kelulusan = 'LULUS';
        } else {
            $this->predikat = 'Rasib (Kurang)';
            $this->status_kelulusan = 'TIDAK LULUS';
        }
    }
}
