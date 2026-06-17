<?php

namespace App\Http\Controllers;

use App\Models\TeachingJournal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TeachingJournalController extends Controller
{
    public function index()
    {
        $journals = TeachingJournal::latest()->get();
        return view('journals.index', compact('journals'));
    }

    public function create()
    {
        return view('journals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_name' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
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

        $journal = TeachingJournal::create($validated);

        return redirect()->route('journals.show', $journal)
            ->with('success', 'Jurnal berhasil dibuat!');
    }

    public function show(TeachingJournal $journal)
    {
        return view('journals.show', compact('journal'));
    }

    public function exportPdf(TeachingJournal $journal)
    {
        $pdf = Pdf::loadView('journals.pdf', compact('journal'));

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download(
            'jurnal-mengajar-' . $journal->date . '.pdf'
        );
    }

    public function edit(TeachingJournal $journal)
    {
        return view('journals.edit', compact('journal'));
    }

    public function update(Request $request, TeachingJournal $journal)
    {
        // Similar validation as store
        // Update logic here
    }

    public function destroy(TeachingJournal $journal)
    {
        $journal->delete();
        return redirect()->route('journals.index')
            ->with('success', 'Jurnal berhasil dihapus!');
    }

    // Di controller atau helper
    function getLogoBase64($path)
    {
        $imageData = file_get_contents(public_path($path));
        return 'data:image/png;base64,' . base64_encode($imageData);
    }
}
