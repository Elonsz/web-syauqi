<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_unit',
        'nama_unit',
        'jenis', // TPQ atau RTQ
        'kepala_unit',
        'telepon',
        'alamat',
    ];

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }
}
