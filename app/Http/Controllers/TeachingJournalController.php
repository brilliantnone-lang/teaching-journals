<?php

namespace App\Http\Controllers;

use App\Models\TeachingJournal;
use App\Models\GuruProfile;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;  // ✅ IMPORT STORAGE

class TeachingJournalController extends Controller
{
    public function index()
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if ($profile) {
            $journals = TeachingJournal::where('guru_profile_id', $profile->id)
                ->latest()
                ->get();
        } else {
            $journals = collect();
        }
        
        return view('guru.journals.index', compact('journals'));
    }

    public function create()
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile) {
            return redirect()->route('guru.profile.create')
                ->with('warning', 'Silakan lengkapi profil terlebih dahulu.');
        }
        
        return view('guru.journals.create', compact('profile'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class' => 'required|string|max:50',
            'semester' => 'required|string|max:10',
            'subject' => 'required|string|max:255',
            'day' => 'required|string|max:20',
            'date' => 'required|date',
            'material' => 'required|string',
            'lesson_start' => 'required|string|max:10',
            'lesson_end' => 'required|string|max:10',
            'time_start' => 'required',
            'time_end' => 'required',
            'learning_activity' => 'required|string',
            'present' => 'required|integer|min:0',
            'permit' => 'required|integer|min:0',
            'sick' => 'required|integer|min:0',
            'absent' => 'required|integer|min:0',
            'permit_names' => 'nullable|string',
            'sick_names' => 'nullable|string',
            'absent_names' => 'nullable|string',
            'notes' => 'nullable|string',
            'photo1' => 'nullable|image|max:2048',
            'photo2' => 'nullable|image|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('photo1')) {
            $validated['photo1'] = $request->file('photo1')->store('photos', 'public');
        }
        if ($request->hasFile('photo2')) {
            $validated['photo2'] = $request->file('photo2')->store('photos', 'public');
        }

        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile) {
            return redirect()->route('guru.profile.create')
                ->with('warning', 'Silakan lengkapi profil terlebih dahulu.');
        }

        $validated['guru_profile_id'] = $profile->id;
        $validated['teacher_name'] = $profile->nama_guru;
        $validated['nip'] = $profile->nip_guru;

        $journal = TeachingJournal::create($validated);

        return redirect()->route('guru.journals.show', $journal)
            ->with('success', 'Jurnal berhasil dibuat!');
    }

    public function show(TeachingJournal $journal)
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile || $journal->guru_profile_id !== $profile->id) {
            abort(403, 'Anda tidak memiliki akses ke jurnal ini.');
        }
        
        return view('guru.journals.show', compact('journal'));
    }

    public function exportPdf(TeachingJournal $journal)
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile || $journal->guru_profile_id !== $profile->id) {
            abort(403, 'Anda tidak memiliki akses ke jurnal ini.');
        }
        
        $pdf = Pdf::loadView('guru.journals.pdf', compact('journal'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('jurnal-mengajar-' . $journal->date . '.pdf');
    }

    public function edit(TeachingJournal $journal)
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile || $journal->guru_profile_id !== $profile->id) {
            abort(403, 'Anda tidak memiliki akses ke jurnal ini.');
        }
        
        return view('guru.journals.edit', compact('journal'));
    }

    public function update(Request $request, TeachingJournal $journal)
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile || $journal->guru_profile_id !== $profile->id) {
            abort(403, 'Anda tidak memiliki akses ke jurnal ini.');
        }

        $validated = $request->validate([
            'class' => 'required|string|max:50',
            'semester' => 'required|string|max:10',
            'subject' => 'required|string|max:255',
            'day' => 'required|string|max:20',
            'date' => 'required|date',
            'material' => 'required|string',
            'lesson_start' => 'required|string|max:10',
            'lesson_end' => 'required|string|max:10',
            'time_start' => 'required',
            'time_end' => 'required',
            'learning_activity' => 'required|string',
            'present' => 'required|integer|min:0',
            'permit' => 'required|integer|min:0',
            'sick' => 'required|integer|min:0',
            'absent' => 'required|integer|min:0',
            'permit_names' => 'nullable|string',
            'sick_names' => 'nullable|string',
            'absent_names' => 'nullable|string',
            'notes' => 'nullable|string',
            'photo1' => 'nullable|image|max:2048',
            'photo2' => 'nullable|image|max:2048',
        ]);

        // Handle file uploads
        if ($request->hasFile('photo1')) {
            if ($journal->photo1) {
                Storage::disk('public')->delete($journal->photo1);  // ✅ SEKARANG TIDAK MERAH
            }
            $validated['photo1'] = $request->file('photo1')->store('photos', 'public');
        }
        if ($request->hasFile('photo2')) {
            if ($journal->photo2) {
                Storage::disk('public')->delete($journal->photo2);  // ✅ SEKARANG TIDAK MERAH
            }
            $validated['photo2'] = $request->file('photo2')->store('photos', 'public');
        }

        $journal->update($validated);

        return redirect()->route('guru.journals.show', $journal)
            ->with('success', 'Jurnal berhasil diperbarui!');
    }

    public function destroy(TeachingJournal $journal)
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile || $journal->guru_profile_id !== $profile->id) {
            abort(403, 'Anda tidak memiliki akses ke jurnal ini.');
        }

        if ($journal->photo1) {
            Storage::disk('public')->delete($journal->photo1);  // ✅ SEKARANG TIDAK MERAH
        }
        if ($journal->photo2) {
            Storage::disk('public')->delete($journal->photo2);  // ✅ SEKARANG TIDAK MERAH
        }

        $journal->delete();
        
        return redirect()->route('guru.journals.index')
            ->with('success', 'Jurnal berhasil dihapus!');
    }
}