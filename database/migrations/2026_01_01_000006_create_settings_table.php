<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Seed default settings
        $defaults = [
            ['key' => 'nama_yayasan', 'value' => 'Yayasan Cahaya Amanah Ar-Raudhah'],
            ['key' => 'alamat_yayasan', 'value' => 'Banjarbaru, Kalimantan Selatan'],
            ['key' => 'ketua_yayasan', 'value' => 'Ustadz H. Ahmad Ridhani, S.Pd.I'],
            ['key' => 'kepala_tpq', 'value' => 'Ustadz Muhammad Syauqi, S.Ag'],
            ['key' => 'kepala_rtq', 'value' => 'Ustadzah Nurul Fatimah, S.Pd'],
            ['key' => 'tanggal_surat_masehi', 'value' => '08 September 2026'],
            ['key' => 'tanggal_surat_hijriyah', 'value' => '25 Rabiul Awwal 1448 H'],
            ['key' => 'nomor_sk_munaqasyah', 'value' => '045/SK-MUN/YCA-AR/IX/2026'],
            ['key' => 'tahun_ajaran', 'value' => '2025/2026'],
        ];

        foreach ($defaults as $d) {
            DB::table('settings')->insert(array_merge($d, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
