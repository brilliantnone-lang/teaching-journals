<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\TeachingJournalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruProfileController;
use App\Http\Controllers\AdminJournalController; 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/splash', function () {
    return view('splash-screen');
})->name('splash');

Route::get('/', function () {
    return redirect()->route('splash');
});

// ========================================== //
// AUTH ROUTES (LOGIN & REGISTER)
// ========================================== //

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========================================== //
// PROTECTED ROUTES (HARUS LOGIN)
// ========================================== //

Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ❌ HAPUS route journals di sini (pindah ke guru)
});

// ========================================== //
// ADMIN ROUTES (HANYA ADMIN)
// ========================================== //

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Admin lihat semua jurnal - PAKAI CONTROLLER KHUSUS
    Route::get('/journals', [AdminJournalController::class, 'index'])->name('journals.index');
    Route::get('/journals/{journal}', [AdminJournalController::class, 'show'])->name('journals.show');
});

// ========================================== //
// GURU ROUTES (HANYA GURU)
// ========================================== //

Route::middleware(['auth', 'guru'])->prefix('guru')->name('guru.')->group(function () {
    
    // Dashboard Guru
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');

    // Profile Guru (WAJIB DIISI DULU)
    Route::get('/profile/create', [GuruProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [GuruProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [GuruProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [GuruProfileController::class, 'update'])->name('profile.update');

    // Jurnal - PAKAI MIDDLEWARE CHECK PROFILE
    Route::middleware(['check.guru.profile'])->group(function () {
        Route::resource('journals', TeachingJournalController::class);
        Route::get('journals/{journal}/export-pdf', [TeachingJournalController::class, 'exportPdf'])->name('journals.export-pdf');
    });
});