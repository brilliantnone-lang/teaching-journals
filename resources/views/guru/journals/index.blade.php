@extends('layouts.app')

@section('title', 'Daftar Jurnal')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>📋 Daftar Jurnal Mengajar</h1>
    <a href="{{ route('guru.journals.create') }}" class="btn btn-primary">
        ➕ Tambah Jurnal
    </a>
</div>

@if($journals->isEmpty())
<div class="alert alert-info">
    Belum ada data jurnal. Silakan tambah jurnal baru.
</div>
@else
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Guru</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Tanggal</th>
                <th>Hadir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($journals as $journal)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $journal->teacher_name }}</td>
                <td>{{ $journal->class }}</td>
                <td>{{ $journal->subject }}</td>
                <td>{{ \Carbon\Carbon::parse($journal->date)->format('d-m-Y') }}</td>
                <td>{{ $journal->present }}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('guru.journals.show', $journal) }}" class="btn btn-info">👁️</a>
                        <a href="{{ route('guru.journals.edit', $journal) }}" class="btn btn-warning">✏️</a>
                        <a href="{{ route('guru.journals.export-pdf', $journal) }}" class="btn btn-danger">📄</a>
                        <form action="{{ route('guru.journals.destroy', $journal) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus data ini?')">🗑️</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection