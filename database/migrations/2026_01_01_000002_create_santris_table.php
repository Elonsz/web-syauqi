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
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->string('no_peserta', 50)->nullable(); // No. Peserta
            $table->string('no_unit', 20)->nullable(); // No. Unit
            $table->string('nama'); // Nama Siswa / Santri
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->string('nama_unit')->nullable(); // Nama Lembaga (cth: AL-FALAH)
            $table->enum('jenis', ['TPQ', 'RTQ'])->default('TPQ');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('nisn', 50)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('foto')->nullable(); // Path foto siswa untuk data kelulusan / cetak ijazah
            $table->string('tahun_munaqasyah', 10)->default('2026');
            $table->enum('status_kelulusan', ['LULUS', 'TIDAK LULUS', 'PENDING'])->default('LULUS');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
