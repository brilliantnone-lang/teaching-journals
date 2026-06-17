<?php

namespace App\Http\Controllers;

use App\Models\TeachingJournal;
use Illuminate\Http\Request;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $totalJurnal = TeachingJournal::count();
        $jurnalTerbaru = TeachingJournal::latest()->take(5)->get();
        
        return view('guru.dashboard', compact(
            'totalJurnal',
            'jurnalTerbaru'
        ));
    }
}