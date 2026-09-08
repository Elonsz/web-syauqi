<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MunaqasyahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ImportSantriController;
use App\Http\Controllers\PublicCheckController;

// ===== Auth Routes (public) =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// ===== Landing Page (public) =====
Route::get('/', function () {
    return view('landing');
})->name('landing');

// ===== Public Graduation Check (Wali Santri) =====
Route::get('/cek-kelulusan', [PublicCheckController::class, 'index'])->name('public.check');
Route::get('/cek-kelulusan/{id}', [PublicCheckController::class, 'show'])->name('public.check.cetak');

// ===== Protected Routes (wajib login) =====
Route::middleware('auth.check')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Pengguna / Users
    Route::resource('users', UserController::class)->except(['show']);

    // Pengaturan Identitas & Surat
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Munaqasyah
    Route::prefix('munaqasyah')->name('munaqasyah.')->group(function () {
        Route::get('/', [MunaqasyahController::class, 'index'])->name('index');
        Route::get('/tambah', [MunaqasyahController::class, 'create'])->name('create');
        Route::post('/', [MunaqasyahController::class, 'store'])->name('store');

        // Import Excel / CSV
        Route::get('/import', [ImportSantriController::class, 'showImportForm'])->name('import');
        Route::post('/import', [ImportSantriController::class, 'import'])->name('import.post');
        Route::get('/import/template', [ImportSantriController::class, 'downloadTemplate'])->name('import.template');

        // Export
        Route::get('/export/excel', [MunaqasyahController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/csv', [MunaqasyahController::class, 'exportCsv'])->name('export.csv');

        // Surat Kelulusan
        Route::get('/cetak-massal', [MunaqasyahController::class, 'cetakMassal'])->name('cetak.massal');
        Route::get('/{id}/kelulusan', [MunaqasyahController::class, 'kelulusan'])->name('kelulusan');

        // CRUD with ID wildcard
        Route::get('/{id}/edit', [MunaqasyahController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MunaqasyahController::class, 'update'])->name('update');
        Route::delete('/{id}', [MunaqasyahController::class, 'destroy'])->name('destroy');
    });
});

