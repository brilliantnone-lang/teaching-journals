@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-2">Dashboard Guru</h1>
        <p class="text-muted">Selamat datang, {{ Auth::user()->name }}!</p>
    </div>
</div>

<!-- CEK APAKAH PROFIL SUDAH LENGKAP -->
@if(!Auth::user()->hasCompleteProfile())
<div class="row mt-4">
    <div class="col-md-12">
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Profil belum lengkap!</strong>
            Silakan lengkapi profil Anda terlebih dahulu sebelum membuat jurnal.
            <a href="{{ route('guru.profile.create') }}" class="btn btn-warning btn-sm ms-2">
                <i class="fas fa-user-plus"></i> Lengkapi Profil
            </a>
        </div>
    </div>
</div>
@endif

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-clock"></i> Jurnal Terbaru Saya
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark-custom">
                        <thead>
                            <tr>
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
                                <td>{{ $jurnal->class }}</td>
                                <td>{{ $jurnal->subject }}</td>
                                <td>{{ \Str::limit($jurnal->material, 30) }}</td>
                                <td>{{ \Carbon\Carbon::parse($jurnal->date)->format('d-m-Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group" style="display: flex; gap: 4px; flex-wrap: wrap;">
                                        <!-- SHOW -->
                                        <a href="{{ route('guru.journals.show', $jurnal) }}" 
                                           class="btn btn-sm" 
                                           style="background: rgba(59, 130, 246, 0.15); color: #60a5fa; border: none; border-radius: 8px; padding: 6px 12px;"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- PDF DENGAN CATATAN -->
                                        <a href="{{ route('guru.journals.export-pdf', $jurnal) }}" 
                                           class="btn btn-sm" 
                                           style="background: rgba(16, 185, 129, 0.15); color: #34d399; border: none; border-radius: 8px; padding: 6px 12px;"
                                           title="Export PDF dengan Catatan Kepala Sekolah">
                                            <i class="fas fa-file-pdf"></i>
                                            <span style="font-size: 0.65rem; margin-left: 2px;">+Catatan</span>
                                        </a>

                                        <!-- PDF TANPA CATATAN -->
                                        <a href="{{ route('guru.journals.export-pdf', $jurnal) }}?without_note=true" 
                                           class="btn btn-sm" 
                                           style="background: rgba(239, 68, 68, 0.15); color: #f87171; border: none; border-radius: 8px; padding: 6px 12px;"
                                           title="Export PDF Tanpa Catatan Kepala Sekolah">
                                            <i class="fas fa-file-pdf"></i>
                                            <span style="font-size: 0.65rem; margin-left: 2px;">Tanpa</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Belum ada jurnal.
                                    <a href="{{ route('guru.journals.create') }}">Buat jurnal sekarang</a>
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