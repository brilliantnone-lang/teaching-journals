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
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5><i class="fas fa-book"></i> Total Jurnal</h5>
                <h2>{{ $totalJurnal }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5><i class="fas fa-calendar-day"></i> Jurnal Hari Ini</h5>
                <h2>{{ \App\Models\TeachingJournal::whereDate('date', now())->count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5><i class="fas fa-users"></i> Total Siswa</h5>
                <h2>{{ \App\Models\TeachingJournal::sum('present') }}</h2>
            </div>
        </div>
    </div>
</div>

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
                                    <!-- ✅ PAKAI guru.journals.* -->
                                    <a href="{{ route('guru.journals.show', $jurnal) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('guru.journals.export-pdf', $jurnal) }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
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