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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('no_unit', 20)->nullable();
            $table->string('nama_unit'); // contoh: AL-FALAH
            $table->enum('jenis', ['TPQ', 'RTQ'])->default('TPQ');
            $table->string('kepala_unit')->nullable();
            $table->string('telepon', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
