@extends('layouts.app')

@section('title', 'Semua Jurnal - Admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-2">📚 Semua Jurnal</h1>
        <p class="text-muted">Daftar semua jurnal mengajar guru</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-list"></i> Data Jurnal
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark-custom">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Guru</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($journals as $key => $journal)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $journal->teacher_name }}</td>
                                <td>{{ $journal->class }}</td>
                                <td>{{ $journal->subject }}</td>
                                <td>{{ \Carbon\Carbon::parse($journal->date)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.journals.show', $journal) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
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