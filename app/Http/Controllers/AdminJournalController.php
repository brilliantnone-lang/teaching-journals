<?php

namespace App\Http\Controllers;

use App\Models\TeachingJournal;
use Illuminate\Http\Request;

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
}