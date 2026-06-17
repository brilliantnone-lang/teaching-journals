@extends('layouts.app')

@section('title', 'Detail Jurnal')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>📄 Detail Jurnal Mengajar</h1>
        <div>
            <a href="{{ route('journals.index') }}" class="btn btn-secondary">← Kembali</a>
            <a href="{{ route('journals.export-pdf', $journal) }}" class="btn btn-danger">📄 Export PDF</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama Guru:</strong> {{ $journal->teacher_name }}</p>
                    <p><strong>NIP:</strong> {{ $journal->nip }}</p>
                    <p><strong>Kelas/Semester:</strong> {{ $journal->class }} / {{ $journal->semester }}</p>
                    <p><strong>Mata Pelajaran:</strong> {{ $journal->subject }}</p>
                    <p><strong>Hari:</strong> {{ $journal->day }}</p>
                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($journal->date)->format('d-m-Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Materi:</strong> {{ $journal->material }}</p>
                    <p><strong>Jam Pelajaran:</strong> ke-{{ $journal->lesson_start }} s.d ke-{{ $journal->lesson_end }}</p>
                    <p><strong>Jam WITA:</strong> {{ \Carbon\Carbon::parse($journal->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($journal->time_end)->format('H:i') }}</p>
                </div>
            </div>

            <hr>

            <h5>📝 Kegiatan Pembelajaran</h5>
            <p>{{ $journal->learning_activity }}</p>

            <hr>

            <h5>📊 Presensi Siswa</h5>
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 50%;">
                    <tr>
                        <th>Hadir</th>
                        <td>{{ $journal->present }}</td>
                    </tr>
                    <tr>
                        <th>Izin</th>
                        <td>{{ $journal->permit }} @if($journal->permit_names) - {{ $journal->permit_names }} @endif</td>
                    </tr>
                    <tr>
                        <th>Sakit</th>
                        <td>{{ $journal->sick }} @if($journal->sick_names) - {{ $journal->sick_names }} @endif</td>
                    </tr>
                    <tr>
                        <th>Alpa</th>
                        <td>{{ $journal->absent }} @if($journal->absent_names) - {{ $journal->absent_names }} @endif</td>
                    </tr>
                </table>
            </div>

            <h5>📝 Catatan Saat Mengajar</h5>
            <p>{{ $journal->notes ?? '-' }}</p>

            @if($journal->photo1 || $journal->photo2)
                <hr>
                <h5>📷 Foto Kegiatan</h5>
                <div class="row">
                    @if($journal->photo1)
                    <div class="col-md-6">
                        <img src="{{ asset('storage/'.$journal->photo1) }}" class="img-fluid rounded" style="max-height: 250px;">
                    </div>
                    @endif
                    @if($journal->photo2)
                    <div class="col-md-6">
                        <img src="{{ asset('storage/'.$journal->photo2) }}" class="img-fluid rounded" style="max-height: 250px;">
                    </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection