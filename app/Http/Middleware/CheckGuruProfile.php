<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GuruProfile;

class CheckGuruProfile
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->role !== 'guru') {
            return $next($request);
        }

        $profile = GuruProfile::where('user_id', $user->id)->first();

        if (!$profile || empty($profile->nama_guru) || empty($profile->nip_guru)) {
            return redirect()->route('guru.profile.create')
                ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu sebelum membuat jurnal.');
        }

        return $next($request);
    }
}