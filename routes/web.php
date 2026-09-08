<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MunaqasyahController;

// Redirect root ke halaman utama Munaqasyah
Route::get('/', function () {
    return redirect()->route('munaqasyah.index');
});

// Route Penilaian & Kelulusan Munaqasyah TPQ & RTQ
Route::prefix('munaqasyah')->name('munaqasyah.')->group(function () {
    Route::get('/', [MunaqasyahController::class, 'index'])->name('index');
    Route::get('/tambah', [MunaqasyahController::class, 'create'])->name('create');
    Route::post('/', [MunaqasyahController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [MunaqasyahController::class, 'edit'])->name('edit');
    Route::put('/{id}', [MunaqasyahController::class, 'update'])->name('update');
    Route::delete('/{id}', [MunaqasyahController::class, 'destroy'])->name('destroy');
    // Export ke Excel & Spreadsheet
    Route::get('/export/excel', [MunaqasyahController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/csv', [MunaqasyahController::class, 'exportCsv'])->name('export.csv');
    // Surat Keterangan Kelulusan & Transkrip Nilai dengan Foto Siswa
    Route::get('/{id}/kelulusan', [MunaqasyahController::class, 'kelulusan'])->name('kelulusan');
});
