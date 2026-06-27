@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<style>
    .bar-fill {
        width: 80%;
        border-radius: 8px 8px 0 0;
        min-height: 4px;
        transition: height 0.5s;
        background: linear-gradient(180deg, #4361ee, #3f37c9);
    }
</style>

<div class="row">
    <div class="col-md-12">
        <h1 class="mb-2" style="color: #f8fafc;">📊 Dashboard Admin</h1>
        <p class="text-muted" style="font-size: 0.95rem;">Selamat datang, {{ Auth::user()->name }}!</p>
    </div>
</div>

<!-- STATISTIK UTAMA -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card" style="background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 20px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 48px; height: 48px; background: rgba(67, 97, 238, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-users" style="color: #4cc9f0; font-size: 1.4rem;"></i>
                </div>
                <div>
                    <div style="color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Total Pengguna</div>
                    <div style="color: #f8fafc; font-size: 1.8rem; font-weight: 700;">{{ $totalUser }}</div>
                    <div style="color: #94a3b8; font-size: 0.75rem;">
                        <span style="color: #34d399;">{{ $totalGuru }} Guru</span> · 
                        <span style="color: #60a5fa;">{{ $totalAdmin }} Admin</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card" style="background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 20px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 48px; height: 48px; background: rgba(16, 185, 129, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-book" style="color: #34d399; font-size: 1.4rem;"></i>
                </div>
                <div>
                    <div style="color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Total Jurnal</div>
                    <div style="color: #f8fafc; font-size: 1.8rem; font-weight: 700;">{{ $totalJurnal }}</div>
                    <div style="color: #94a3b8; font-size: 0.75rem;">
                        <span style="color: #fbbf24;">{{ $jurnalBulanIni }} bulan ini</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card" style="background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 20px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 48px; height: 48px; background: rgba(16, 185, 129, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-user-graduate" style="color: #34d399; font-size: 1.4rem;"></i>
                </div>
                <div>
                    <div style="color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Guru Aktif</div>
                    <div style="color: #f8fafc; font-size: 1.8rem; font-weight: 700;">{{ $guruAktif }}</div>
                    <div style="color: #94a3b8; font-size: 0.75rem;">
                        <span style="color: #f87171;">{{ $guruTidakAktif }} tidak aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card" style="background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 20px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 48px; height: 48px; background: rgba(251, 191, 36, 0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-calendar-day" style="color: #fbbf24; font-size: 1.4rem;"></i>
                </div>
                <div>
                    <div style="color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Jurnal Hari Ini</div>
                    <div style="color: #f8fafc; font-size: 1.8rem; font-weight: 700;">{{ $jurnalHariIni }}</div>
                    <div style="color: #94a3b8; font-size: 0.75rem;">
                        <span style="color: #60a5fa;">{{ \Carbon\Carbon::now()->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- GRAFIK STATISTIK BULANAN -->
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-chart-bar"></i> Statistik Jurnal 6 Bulan Terakhir
            </div>
            <div class="card-body">
                <div style="display: flex; align-items: flex-end; height: 200px; gap: 20px; padding-top: 20px;">
                    @php
                        $maxJumlah = $bulanStatistik->pluck('jumlah')->max() ?: 1;
                    @endphp

                    @foreach($bulanStatistik as $data)
                        @php
                            $height = max(4, ($data['jumlah'] / $maxJumlah) * 100);
                        @endphp
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; height: 100%;">
                            <div style="width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; height: 100%;">
                                <div class="bar-fill" style="height: {{ $height }}%;">
                                </div>
                                <div style="color: #94a3b8; font-size: 0.7rem; margin-top: 8px; text-align: center;">
                                    {{ $data['bulan'] }}
                                    <div style="color: #f8fafc; font-weight: 600;">{{ $data['jumlah'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- TOP 5 MATA PELAJARAN -->
    <div class="col-md-4">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-star"></i> Top 5 Mata Pelajaran
            </div>
            <div class="card-body">
                @forelse($mapelStatistik as $mapel)
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.03);">
                    <span style="color: #e2e8f0;">{{ $mapel->subject }}</span>
                    <span style="background: rgba(67, 97, 238, 0.15); color: #4cc9f0; padding: 2px 12px; border-radius: 12px; font-size: 0.8rem; font-weight: 600;">{{ $mapel->total }}</span>
                </div>
                @empty
                <div class="text-muted text-center">Belum ada data</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- DAFTAR GURU & JUMLAH JURNAL -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-users"></i> Daftar Guru & Jumlah Jurnal
                <span class="badge bg-info ms-2">{{ $daftarGuru->count() }} guru</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark-custom">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Guru</th>
                                <th>Asal Sekolah</th>
                                <th>Total Jurnal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($daftarGuru as $key => $guru)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $guru->nama_guru }}</td>
                                <td>
                                    @if($guru->sekolahProfile)
                                        {{ $guru->sekolahProfile->nama_sekolah ?? '-' }}
                                    @else
                                        <span style="color: #64748b;">Belum setting sekolah</span>
                                    @endif
                                </td>
                                <td>
                                    <span style="background: rgba(16, 185, 129, 0.15); color: #34d399; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                        {{ $guru->teachingJournals->count() }} jurnal
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada data guru.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection