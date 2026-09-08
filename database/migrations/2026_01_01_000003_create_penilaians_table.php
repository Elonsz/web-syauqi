<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santris')->cascadeOnDelete();

            // MUNAQASYAH BACAAN
            $table->decimal('fashohah', 5, 2)->default(0);
            $table->decimal('tajwid', 5, 2)->default(0);
            $table->decimal('gharib_musykilat', 5, 2)->default(0);
            $table->decimal('suara_lagu', 5, 2)->default(0);

            // MUNAQASYAH HAFALAN
            $table->decimal('ayat_pilihan', 5, 2)->default(0);
            $table->decimal('surah_pendek', 5, 2)->default(0);
            $table->decimal('doa_harian', 5, 2)->default(0);
            $table->decimal('bacaan_shalat', 5, 2)->default(0);

            // UJIAN TERTULIS
            $table->decimal('ujian_tertulis', 5, 2)->default(0);

            // HASIL KALKULASI
            $table->decimal('jumlah_nilai', 7, 2)->default(0);
            $table->decimal('rata_rata', 5, 2)->default(0);
            $table->string('predikat', 50)->nullable(); // Misal: Mumtaz, Jayyid Jiddan, Jayyid, Maqbul
            $table->enum('status_kelulusan', ['LULUS', 'TIDAK LULUS', 'BELUM LENGKAP'])->default('LULUS');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
