<?php

namespace App\Traits;

use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\Cache;

trait RateLimiterTrait
{
    protected function hasTooManyLoginAttempts($key, $maxAttempts = 5)
    {
        $limiter = app(RateLimiter::class);
        return $limiter->tooManyAttempts($key, $maxAttempts);
    }

    protected function incrementLoginAttempts($key, $decaySeconds = 60)
    {
        $limiter = app(RateLimiter::class);
        $limiter->hit($key, $decaySeconds);
    }

    protected function clearLoginAttempts($key)
    {
        $limiter = app(RateLimiter::class);
        $limiter->clear($key);
    }

    protected function getLoginLockoutSeconds($key)
    {
        $limiter = app(RateLimiter::class);
        return $limiter->availableIn($key);
    }

    protected function getLoginKey()
    {
        return 'login_attempts_' . request()->ip();
    }
}