@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-2">Dashboard Admin</h1>
        <p class="text-muted">Selamat datang, {{ Auth::user()->name }}!</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5><i class="fas fa-book"></i> Total Jurnal</h5>
                <h2>{{ $totalJurnal }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5><i class="fas fa-users"></i> Total Guru</h5>
                <h2>{{ $totalGuru }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5><i class="fas fa-user-shield"></i> Total Admin</h5>
                <h2>{{ $totalAdmin }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5><i class="fas fa-calendar-day"></i> Jurnal Hari Ini</h5>
                <h2>{{ \App\Models\TeachingJournal::whereDate('date', now())->count() }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-clock"></i> Jurnal Terbaru
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
                                    <a href="{{ route('journals.show', $jurnal) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('journals.export-pdf', $jurnal) }}" class="btn btn-sm btn-danger">
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