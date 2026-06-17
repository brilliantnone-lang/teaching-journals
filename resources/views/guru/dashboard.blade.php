@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Dashboard Guru</h1>
        <p>Selamat datang, {{ Auth::user()->name }}!</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5>Total Jurnal</h5>
                <h2>{{ $totalJurnal }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5>Jurnal Hari Ini</h5>
                <h2>{{ \App\Models\TeachingJournal::whereDate('date', now())->count() }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Jurnal Terbaru Saya</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Materi</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jurnalTerbaru as $jurnal)
                        <tr>
                            <td>{{ $jurnal->class }}</td>
                            <td>{{ $jurnal->subject }}</td>
                            <td>{{ $jurnal->material }}</td>
                            <td>{{ \Carbon\Carbon::parse($jurnal->date)->format('d-m-Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection