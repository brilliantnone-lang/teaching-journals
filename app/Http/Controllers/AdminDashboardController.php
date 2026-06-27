<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TeachingJournal;
use App\Models\GuruProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total Pengguna
        $totalGuru = User::where('role', 'guru')->count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalUser = $totalGuru + $totalAdmin;
        
        // Total Jurnal
        $totalJurnal = TeachingJournal::count();
        $jurnalHariIni = TeachingJournal::whereDate('date', now())->count();
        $jurnalBulanIni = TeachingJournal::whereMonth('date', now()->month)
                            ->whereYear('date', now()->year)
                            ->count();
        
        // Guru Aktif
        $guruAktif = GuruProfile::whereHas('teachingJournals')->count();
        $guruTidakAktif = $totalGuru - $guruAktif;
        
        // Statistik Per Bulan (6 bulan terakhir)
        $bulanStatistik = collect();
        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $bulanStatistik->push([
                'bulan' => $bulan->format('M'),
                'tahun' => $bulan->year,
                'jumlah' => TeachingJournal::whereMonth('date', $bulan->month)
                                ->whereYear('date', $bulan->year)
                                ->count()
            ]);
        }
        
        // Top 5 Mata Pelajaran
        $mapelStatistik = TeachingJournal::selectRaw('subject, count(*) as total')
                            ->groupBy('subject')
                            ->orderBy('total', 'desc')
                            ->limit(5)
                            ->get();
        
        // Jurnal Terbaru
        $jurnalTerbaru = TeachingJournal::with('guruProfile')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact(
            'totalGuru',
            'totalAdmin',
            'totalUser',
            'totalJurnal',
            'jurnalHariIni',
            'jurnalBulanIni',
            'guruAktif',
            'guruTidakAktif',
            'bulanStatistik',
            'mapelStatistik',
            'jurnalTerbaru'
        ));
    }
}