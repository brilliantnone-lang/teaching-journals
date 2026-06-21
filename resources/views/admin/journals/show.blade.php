@extends('layouts.app')

@section('title', 'Detail Jurnal - Admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-2">📄 Detail Jurnal</h1>
        <p class="text-muted">Detail lengkap jurnal mengajar</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi Jurnal
            </div>
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

                <div class="mt-3">
                    <a href="{{ route('admin.journals.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection