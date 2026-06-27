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

<!-- JURNAL TERBARU -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-clock"></i> Jurnal Terbaru
                <span class="badge bg-info ms-2">{{ $jurnalTerbaru->count() }} data</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark-custom">
                        <thead>
                            <tr>
                                <th>Guru</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Materi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jurnalTerbaru as $jurnal)
                            <tr>
                                <td>{{ $jurnal->teacher_name }}</td>
                                <td>{{ $jurnal->class }}</td>
                                <td>{{ $jurnal->subject }}</td>
                                <td>{{ \Str::limit($jurnal->material, 25) }}</td>
                                <td>{{ \Carbon\Carbon::parse($jurnal->date)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.journals.show', $jurnal) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.journals.export-pdf', $jurnal) }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Belum ada data jurnal.
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