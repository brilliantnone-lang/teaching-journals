<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\TeachingJournalController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ========================================== //
// GUEST ROUTES (TIDAK PERLU LOGIN)
// ========================================== //

// Splash Screen - Halaman Pembuka
Route::get('/splash', function () {
    return view('splash-screen');
})->name('splash');

// Root - Redirect ke splash
Route::get('/', function () {
    return redirect()->route('splash');
});

// ========================================== //
// AUTH ROUTES (LOGIN & REGISTER SATU HALAMAN)
// ========================================== //

// Halaman Login & Register (Satu Halaman)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========================================== //
// PROTECTED ROUTES (HARUS LOGIN) - LETAKKAN DI SINI!
// ========================================== //

Route::middleware(['auth'])->group(function () {
    
    // ⬇️⬇️⬇️ LETAKKAN DI SINI ⬇️⬇️⬇️
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Route Jurnal (untuk semua user yang login)
    Route::resource('journals', TeachingJournalController::class);
    Route::get('journals/{journal}/export-pdf', [TeachingJournalController::class, 'exportPdf'])->name('journals.export-pdf');
});

// ========================================== //
// ADMIN ROUTES (HANYA ADMIN)
// ========================================== //

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

// ========================================== //
// GURU ROUTES (HANYA GURU)
// ========================================== //

Route::middleware(['auth', 'guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
});