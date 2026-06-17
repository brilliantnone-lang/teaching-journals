<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TeachingJournal;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalGuru = User::where('role', 'guru')->count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalJurnal = TeachingJournal::count();
        $jurnalTerbaru = TeachingJournal::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalGuru',
            'totalAdmin',
            'totalJurnal',
            'jurnalTerbaru'
        ));
    }
}