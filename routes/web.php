<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MunaqasyahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

// ===== Auth Routes (public) =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// ===== Landing Page (public) =====
Route::get('/', function () {
    return view('landing');
})->name('landing');

// ===== Protected Routes (wajib login) =====
Route::middleware('auth.check')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Munaqasyah
    Route::prefix('munaqasyah')->name('munaqasyah.')->group(function () {
        Route::get('/', [MunaqasyahController::class, 'index'])->name('index');
        Route::get('/tambah', [MunaqasyahController::class, 'create'])->name('create');
        Route::post('/', [MunaqasyahController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MunaqasyahController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MunaqasyahController::class, 'update'])->name('update');
        Route::delete('/{id}', [MunaqasyahController::class, 'destroy'])->name('destroy');
        // Export
        Route::get('/export/excel', [MunaqasyahController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/csv', [MunaqasyahController::class, 'exportCsv'])->name('export.csv');
        // Surat Kelulusan
        Route::get('/{id}/kelulusan', [MunaqasyahController::class, 'kelulusan'])->name('kelulusan');
    });
});
