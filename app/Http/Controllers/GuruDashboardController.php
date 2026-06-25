<?php

namespace App\Http\Controllers;

use App\Models\TeachingJournal;
use App\Models\GuruProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruDashboardController extends Controller
{
    public function index(Request $request)
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile) {
            return view('guru.dashboard', [
                'journals' => collect(),
                'selectedMonth' => date('m'),
                'selectedYear' => date('Y'),
            ]);
        }

        $selectedMonth = $request->month ?? date('m');
        $selectedYear = $request->year ?? date('Y');

        $query = TeachingJournal::where('guru_profile_id', $profile->id);
        
        if ($selectedMonth && $selectedYear) {
            $query->whereMonth('date', $selectedMonth)
                  ->whereYear('date', $selectedYear);
        }

        $journals = $query->orderBy('date', 'desc')->get();

        return view('guru.dashboard', compact(
            'journals',
            'selectedMonth',
            'selectedYear',
            'profile'
        ));
    }

    // Export PDF Bulanan - Dengan Catatan
    public function exportMonthlyWithNote(Request $request)
    {
        return $this->exportMonthly($request, true);
    }

    // Export PDF Bulanan - Tanpa Catatan
    public function exportMonthlyWithoutNote(Request $request)
    {
        return $this->exportMonthly($request, false);
    }

    private function exportMonthly(Request $request, $withNote)
    {
        $profile = GuruProfile::where('user_id', Auth::id())->first();
        
        if (!$profile) {
            return redirect()->route('guru.dashboard')
                ->with('error', 'Profil tidak ditemukan.');
        }

        $month = $request->month ?? date('m');
        $year = $request->year ?? date('Y');

        $journals = TeachingJournal::where('guru_profile_id', $profile->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'desc')
            ->get();

        if ($journals->isEmpty()) {
            return redirect()->route('guru.dashboard')
                ->with('error', 'Tidak ada jurnal untuk bulan ' . $month . '/' . $year);
        }

        $sekolah = \App\Models\SekolahProfile::where('guru_profile_id', $profile->id)->first();
        
        $instansi = $sekolah->instansi ?? 'PEMERINTAH PROVINSI KALIMANTAN SELATAN';
        $dinas = $sekolah->dinas ?? 'DINAS PENDIDIKAN DAN KEBUDAYAAN';
        $namaSekolah = $sekolah->nama_sekolah ?? 'SMK NEGERI 1 BANJARMASIN';
        $alamatSekolah = $sekolah->alamat_sekolah ?? 'Jalan Mulawarman No. 45 Telp & Faxs. 0511-4368225 Banjarmasin 70117';
        $kota = $sekolah->kota ?? 'Banjarmasin';
        $websiteSekolah = $sekolah->website_sekolah ?? 'http://smkn1bjm.sch.id';
        $kepalaSekolah = $sekolah->kepala_sekolah ?? 'Agustin Purnomosari, S.Pd., M.Pd';
        $nipKepsek = $sekolah->nip_kepala_sekolah ?? '197208211998032007';
        $tahunPelajaran = $sekolah->tahun_pelajaran ?? '2025/2026';

        $data = [
            'journals' => $journals,
            'profile' => $profile,
            'instansi' => $instansi,
            'dinas' => $dinas,
            'namaSekolah' => $namaSekolah,
            'alamatSekolah' => $alamatSekolah,
            'kota' => $kota,
            'websiteSekolah' => $websiteSekolah,
            'kepalaSekolah' => $kepalaSekolah,
            'nipKepsek' => $nipKepsek,
            'tahunPelajaran' => $tahunPelajaran,
            'month' => $month,
            'year' => $year,
            'withNote' => $withNote,
        ];

        $pdf = Pdf::loadView('guru.journals.export-monthly', $data);
        $pdf->setPaper('A4', 'portrait');

        $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $suffix = $withNote ? '-dengan-catatan' : '-tanpa-catatan';
        
        return $pdf->download('Jurnal-Bulanan-' . $namaBulan[(int)$month - 1] . '-' . $year . $suffix . '.pdf');
    }
}