<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\TeachingJournalController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 

// ========================================== //
// GUEST ROUTES (TIDAK PERLU LOGIN)           //
// ========================================== //
Route::get('/splash', function () {
    return view('splash-screen');
})->name('splash');

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register (opsional)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ========================================== //
// ADMIN ROUTES (HANYA ADMIN)                //
// ========================================== //
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Admin bisa akses semua jurnal
    Route::resource('journals', TeachingJournalController::class);
    Route::get('journals/{journal}/export-pdf', [TeachingJournalController::class, 'exportPdf'])->name('journals.export-pdf');
});

// ========================================== //
// GURU ROUTES (HANYA GURU)                  //
// ========================================== //
Route::middleware(['auth', 'guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    
    // Guru hanya bisa akses jurnal miliknya sendiri
    Route::resource('journals', TeachingJournalController::class);
    Route::get('journals/{journal}/export-pdf', [TeachingJournalController::class, 'exportPdf'])->name('journals.export-pdf');
});

// ========================================== //
// REDIRECT DASHBOARD BERDASARKAN ROLE       //
// ========================================== //
Route::get('/dashboard', function () {
    if (request()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('guru.dashboard');
})->middleware('auth')->name('dashboard');