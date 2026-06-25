<?php

namespace App\Http\Controllers;

use App\Models\SekolahProfile;
use App\Models\GuruProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SekolahProfileController extends Controller
{
    public function index()
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile) {
            return redirect()->route('guru.profile.create')
                ->with('warning', 'Silakan lengkapi profil guru terlebih dahulu.');
        }

        $sekolah = SekolahProfile::where('guru_profile_id', $profile->id)->first();

        return view('guru.sekolah.index', compact('sekolah', 'profile'));
    }

    public function store(Request $request)
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();

        if (!$profile) {
            return redirect()->route('guru.profile.create')
                ->with('warning', 'Silakan lengkapi profil guru terlebih dahulu.');
        }

        $validated = $request->validate([
            'instansi' => 'nullable|string|max:255',
            'dinas' => 'nullable|string|max:255',
            'nama_sekolah' => 'nullable|string|max:255',
            'alamat_sekolah' => 'nullable|string',
            'kota' => 'nullable|string|max:100',
            'website_sekolah' => 'nullable|string|max:255',
            'kepala_sekolah' => 'nullable|string|max:255',
            'nip_kepala_sekolah' => 'nullable|string|max:50',
            'tahun_pelajaran' => 'nullable|string|max:20',
            'logo_kiri' => 'nullable|image|max:2048',
            'logo_kanan' => 'nullable|image|max:2048',
        ]);

        $sekolah = SekolahProfile::where('guru_profile_id', $profile->id)->first();

        if ($request->hasFile('logo_kiri')) {
            if ($sekolah && $sekolah->logo_kiri) {
                Storage::disk('public')->delete($sekolah->logo_kiri);
            }
            $validated['logo_kiri'] = $request->file('logo_kiri')->store('logos', 'public');
        }

        if ($request->hasFile('logo_kanan')) {
            if ($sekolah && $sekolah->logo_kanan) {
                Storage::disk('public')->delete($sekolah->logo_kanan);
            }
            $validated['logo_kanan'] = $request->file('logo_kanan')->store('logos', 'public');
        }

        if ($sekolah) {
            $sekolah->update($validated);
            $message = 'Data sekolah berhasil diperbarui!';
        } else {
            $validated['guru_profile_id'] = $profile->id;
            SekolahProfile::create($validated);
            $message = 'Data sekolah berhasil disimpan!';
        }

        return redirect()->route('guru.sekolah.index')
            ->with('success', $message);
    }
}