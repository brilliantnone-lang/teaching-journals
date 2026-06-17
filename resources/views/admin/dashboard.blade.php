@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, {{ Auth::user()->name }}!</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5>Total Guru</h5>
                <h2>{{ $totalGuru }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5>Total Admin</h5>
                <h2>{{ $totalAdmin }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5>Total Jurnal</h5>
                <h2>{{ $totalJurnal }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Jurnal Terbaru</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Guru</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jurnalTerbaru as $jurnal)
                        <tr>
                            <td>{{ $jurnal->teacher_name }}</td>
                            <td>{{ $jurnal->class }}</td>
                            <td>{{ $jurnal->subject }}</td>
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