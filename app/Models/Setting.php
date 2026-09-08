<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Ambil nilai pengaturan berdasarkan key
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting && $setting->value !== null ? $setting->value : $default;
    }

    /**
     * Simpan atau perbarui nilai pengaturan
     */
    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Ambil semua pengaturan dalam bentuk array key-value asosiatif
     */
    public static function getAll(): array
    {
        return static::pluck('value', 'key')->toArray();
    }
}
