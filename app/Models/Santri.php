<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_peserta',
        'no_unit',
        'nama',
        'unit_id',
        'nama_unit',
        'jenis', // TPQ / RTQ
        'jenis_kelamin',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_wali',
        'foto',
        'tahun_munaqasyah',
        'status_kelulusan',
        'keterangan',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class);
    }

    // Accessor untuk URL foto siswa
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            $cleanPath = ltrim(str_replace('storage/', '', $this->foto), '/\\');
            if (Storage::disk('public')->exists($cleanPath)) {
                return asset('storage/' . $cleanPath);
            }
        }

        // Avatar placeholder berdasarkan jenis kelamin / nama jika belum ada foto
        $bg = ($this->jenis_kelamin === 'P') ? 'E11D48' : '1D4ED8';
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=' . $bg . '&color=fff&size=256&bold=true';
    }
}
