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
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }

        // Avatar placeholder berdasarkan jenis kelamin / nama jika belum ada foto
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=0D8ABC&color=fff&size=256';
    }
}
