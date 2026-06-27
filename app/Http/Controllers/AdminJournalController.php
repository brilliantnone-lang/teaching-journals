<?php

namespace App\Http\Controllers;

use App\Models\TeachingJournal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;  // ✅ TAMBAHKAN INI

class AdminJournalController extends Controller
{
    public function index()
    {
        $journals = TeachingJournal::latest()->get();
        return view('admin.journals.index', compact('journals'));
    }

    public function show(TeachingJournal $journal)
    {
        return view('admin.journals.show', compact('journal'));
    }

    // ✅ TAMBAHKAN METHOD INI
    public function exportPdf(TeachingJournal $journal)
    {
        $pdf = Pdf::loadView('admin.journals.pdf', compact('journal'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('jurnal-mengajar-' . $journal->date . '.pdf');
    }
}