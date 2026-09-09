<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MunaqasyahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ImportSantriController;
use App\Http\Controllers\PublicCheckController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\SantriController;

// ============================================================
// ===== Auth Routes (public) — dilindungi rate limiter  ======
// ============================================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('login.throttle')
    ->name('login.post');

// ============================================================
// ===== Landing Page (public) ================================
// ============================================================
Route::get('/', function () {
    return view('landing');
})->name('landing');

// ============================================================
// ===== Public Routes (tidak butuh login) ====================
// ============================================================
// Cek Kelulusan — hanya expose info yang diperlukan wali santri
Route::get('/cek-kelulusan', [PublicCheckController::class, 'index'])->name('public.check');
Route::get('/cek-kelulusan/{id}', [PublicCheckController::class, 'show'])
    ->where('id', '[0-9]+')  // ✅ Batasi hanya angka (cegah ID enumeration string)
    ->name('public.check.cetak');

// Chatbot AI — publik tapi dilindungi rate limiter
Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])
    ->middleware('chatbot.throttle')
    ->name('chatbot.ask');

// ============================================================
// ===== Protected Routes — wajib login =======================
// ============================================================
Route::middleware('auth.check')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ── Biodata Siswa (semua user yang sudah login) ──────────────────
    Route::resource('santri', SantriController::class);

    // ── Munaqasyah — Penilaian (semua user yang sudah login) ─────────
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
        Route::get('/{id}/kelulusan', [MunaqasyahController::class, 'kelulusan'])
            ->where('id', '[0-9]+')
            ->name('kelulusan');

        // CRUD — Edit & Update bisa semua user login
        Route::get('/{id}/edit', [MunaqasyahController::class, 'edit'])
            ->where('id', '[0-9]+')
            ->name('edit');
        Route::put('/{id}', [MunaqasyahController::class, 'update'])
            ->where('id', '[0-9]+')
            ->name('update');

        // ✅ RBAC: Hapus data santri — hanya Administrator
        Route::delete('/{id}', [MunaqasyahController::class, 'destroy'])
            ->where('id', '[0-9]+')
            ->middleware('admin.only')
            ->name('destroy');
    });

    // ── Kelola Pengguna — hanya Administrator ─────────────────────────
    Route::resource('users', UserController::class)
        ->except(['show'])
        ->middleware('admin.only');

    // ── Pengaturan & Backup — hanya Administrator ─────────────────────
    Route::prefix('settings')->name('settings.')->middleware('admin.only')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/', [SettingController::class, 'update'])->name('update');
        Route::get('/backup', [SettingController::class, 'backup'])->name('backup');
    });
});
