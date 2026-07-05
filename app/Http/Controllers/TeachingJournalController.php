<?php

namespace App\Http\Controllers;

use App\Models\TeachingJournal;
use App\Models\GuruProfile;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeachingJournalController extends Controller
{
    private function sanitizeFileName($filename)
    {
        $filename = str_replace(' ', '_', $filename);
        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
        return $filename;
    }

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
            'catatan_kepsek' => 'nullable|string',
            'photo1' => 'nullable|image|max:2048',
            'photo2' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo1')) {
            $file = $request->file('photo1');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $safeName = $this->sanitizeFileName($originalName);
            $filename = time() . '_1_' . $safeName . '.' . $extension;
            $path = $file->storeAs('photos', $filename, 'public');
            $validated['photo1'] = $path;
        }

        if ($request->hasFile('photo2')) {
            $file = $request->file('photo2');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $safeName = $this->sanitizeFileName($originalName);
            $filename = time() . '_2_' . $safeName . '.' . $extension;
            $path = $file->storeAs('photos', $filename, 'public');
            $validated['photo2'] = $path;
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

        $withNote = !request()->has('without_note');

        $pdf = Pdf::loadView('guru.journals.pdf', compact('journal', 'withNote'));
        $pdf->setPaper('A4', 'portrait');

        $filename = 'jurnal-mengajar-' . $journal->date . '.pdf';
        if (!$withNote) {
            $filename = 'jurnal-mengajar-' . $journal->date . '-tanpa-catatan.pdf';
        }

        return $pdf->download($filename);
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
            'catatan_kepsek' => 'nullable|string',
            'photo1' => 'nullable|image|max:2048',
            'photo2' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo1')) {
            if ($journal->photo1) {
                Storage::disk('public')->delete($journal->photo1);
            }
            $file = $request->file('photo1');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $safeName = $this->sanitizeFileName($originalName);
            $filename = time() . '_1_' . $safeName . '.' . $extension;
            $path = $file->storeAs('photos', $filename, 'public');
            $validated['photo1'] = $path;
        }

        if ($request->hasFile('photo2')) {
            if ($journal->photo2) {
                Storage::disk('public')->delete($journal->photo2);
            }
            $file = $request->file('photo2');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $safeName = $this->sanitizeFileName($originalName);
            $filename = time() . '_2_' . $safeName . '.' . $extension;
            $path = $file->storeAs('photos', $filename, 'public');
            $validated['photo2'] = $path;
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
            Storage::disk('public')->delete($journal->photo1);
        }
        if ($journal->photo2) {
            Storage::disk('public')->delete($journal->photo2);
        }

        $journal->delete();

        return redirect()->route('guru.journals.index')
            ->with('success', 'Jurnal berhasil dihapus!');
    }

    public function updateCatatan(Request $request, TeachingJournal $journal)
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();

        if (!$profile || $journal->guru_profile_id !== $profile->id) {
            abort(403, 'Anda tidak memiliki akses ke jurnal ini.');
        }

        $validated = $request->validate([
            'catatan_kepsek' => 'nullable|string',
        ]);

        $journal->update([
            'catatan_kepsek' => $validated['catatan_kepsek'] ?? null,
        ]);

        return redirect()->route('guru.journals.show', $journal)
            ->with('success', 'Catatan Kepala Sekolah berhasil diperbarui!');
    }
}