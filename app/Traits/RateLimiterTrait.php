<?php

namespace App\Traits;

use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\Cache;

trait RateLimiterTrait
{
    /**
     * Cek apakah IP sudah melewati batas percobaan
     */
    protected function hasTooManyLoginAttempts($key, $maxAttempts = 5)
    {
        $limiter = app(RateLimiter::class);
        return $limiter->tooManyAttempts($key, $maxAttempts);
    }

    /**
     * Hitung percobaan login
     */
    protected function incrementLoginAttempts($key, $decaySeconds = 60)
    {
        $limiter = app(RateLimiter::class);
        $limiter->hit($key, $decaySeconds);
    }

    /**
     * Hapus percobaan login (saat login sukses)
     */
    protected function clearLoginAttempts($key)
    {
        $limiter = app(RateLimiter::class);
        $limiter->clear($key);
    }

    /**
     * Dapatkan sisa waktu tunggu
     */
    protected function getLoginLockoutSeconds($key)
    {
        $limiter = app(RateLimiter::class);
        return $limiter->availableIn($key);
    }

    /**
     * Dapatkan key untuk rate limit berdasarkan IP
     */
    protected function getLoginKey()
    {
        return 'login_attempts_' . request()->ip();
    }
}