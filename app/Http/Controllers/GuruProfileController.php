<?php

namespace App\Http\Controllers;

use App\Models\GuruProfile;
use App\Models\TeachingJournal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruProfileController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        
        $profile = GuruProfile::where('user_id', $user->id)->first();
        
        if ($profile) {
            return redirect()->route('guru.profile.edit');
        }

        return view('guru.profile.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_guru' => 'required|string|max:255',
            'nip_guru' => 'required|string|unique:guru_profiles,nip_guru|max:50',
            'telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $profile = GuruProfile::create([
            'user_id' => Auth::id(),
            'nama_guru' => $validated['nama_guru'],
            'nip_guru' => $validated['nip_guru'],
            'telepon' => $validated['telepon'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
        ]);

        return redirect()->route('guru.dashboard')
            ->with('success', 'Profil berhasil dibuat! Sekarang Anda bisa membuat jurnal.');
    }

    public function edit()
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile) {
            return redirect()->route('guru.profile.create')
                ->with('warning', 'Silakan buat profil terlebih dahulu.');
        }

        return view('guru.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();

        if (!$profile) {
            return redirect()->route('guru.profile.create')
                ->with('warning', 'Silakan buat profil terlebih dahulu.');
        }

        $validated = $request->validate([
            'nama_guru' => 'required|string|max:255',
            'nip_guru' => 'required|string|max:50|unique:guru_profiles,nip_guru,' . $profile->id,
            'telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $profile->update($validated);

        // ✅ SINKRONISASI OTOMATIS KE SEMUA JURNAL
        TeachingJournal::where('guru_profile_id', $profile->id)
            ->update([
                'teacher_name' => $profile->nama_guru,
                'nip' => $profile->nip_guru,
            ]);

        return redirect()->route('guru.dashboard')
            ->with('success', 'Profil berhasil diupdate! Semua jurnal juga sudah disesuaikan.');
    }

    // ========================================== //
    // ✅ TAMBAHKAN METHOD INI
    // ========================================== //
    public function syncJournals(Request $request)
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile) {
            return back()->with('error', 'Profil tidak ditemukan.');
        }

        $updated = TeachingJournal::where('guru_profile_id', $profile->id)
            ->update([
                'teacher_name' => $profile->nama_guru,
                'nip' => $profile->nip_guru,
            ]);

        $message = $updated > 0 
            ? "Berhasil sinkronisasi $updated jurnal dengan data profil terbaru." 
            : "Tidak ada jurnal yang perlu disinkronisasi.";

        return redirect()->route('guru.profile.edit')
            ->with('success', $message);
    }
}