<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\TeachingJournalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruProfileController;
use App\Http\Controllers\SekolahProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Cache\RateLimiting\Limit;  
use Illuminate\Support\Facades\RateLimiter;

RateLimiter::for('login', function ($job) {
    return Limit::perMinute(10); 
});

Route::get('/splash', function () {
    return view('splash-screen');
})->name('splash');

Route::get('/', function () {
    return redirect()->route('splash');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post')
    ->middleware('throttle:login');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'guru'])->prefix('guru')->name('guru.')->group(function () {
    
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export-monthly-with-note', [GuruDashboardController::class, 'exportMonthlyWithNote'])->name('dashboard.export-monthly-with-note');
    Route::get('/dashboard/export-monthly-without-note', [GuruDashboardController::class, 'exportMonthlyWithoutNote'])->name('dashboard.export-monthly-without-note');

    Route::get('/profile/create', [GuruProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [GuruProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [GuruProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [GuruProfileController::class, 'update'])->name('profile.update');

    Route::get('/sekolah', [SekolahProfileController::class, 'index'])->name('sekolah.index');
    Route::post('/sekolah', [SekolahProfileController::class, 'store'])->name('sekolah.store');

    Route::middleware(['check.guru.profile'])->group(function () {
        Route::resource('journals', TeachingJournalController::class);
        Route::get('journals/{journal}/export-pdf', [TeachingJournalController::class, 'exportPdf'])->name('journals.export-pdf');
        Route::put('journals/{journal}/update-catatan', [TeachingJournalController::class, 'updateCatatan'])->name('journals.update-catatan'); 
    });

    Route::post('/profile/sync', [GuruProfileController::class, 'syncJournals'])->name('profile.sync');
});