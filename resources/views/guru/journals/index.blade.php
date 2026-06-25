@extends('layouts.app')

@section('title', 'Daftar Jurnal')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1" style="color: #f8fafc;">📋 Daftar Jurnal Mengajar</h1>
        <p class="text-muted" style="font-size: 0.95rem;">Kelola semua jurnal mengajar harian Anda</p>
    </div>
    <a href="{{ route('guru.journals.create') }}" class="btn btn-primary" style="padding: 10px 24px; border-radius: 10px; font-weight: 600;">
        <i class="fas fa-plus-circle me-2"></i> Tambah Jurnal
    </a>
</div>

@if($journals->isEmpty())
<div class="alert alert-info" style="background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.3); color: #93c5fd; border-radius: 12px; padding: 20px;">
    <i class="fas fa-info-circle me-2"></i>
    Belum ada data jurnal. Silakan <a href="{{ route('guru.journals.create') }}" style="color: #60a5fa; font-weight: 600;">tambah jurnal baru</a>.
</div>
@else
<div class="card" style="background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 16px; overflow: hidden;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table" style="margin-bottom: 0; color: #e2e8f0;">
                <thead style="background: rgba(15, 23, 42, 0.6); border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                    <tr>
                        <th style="padding: 14px 16px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">#</th>
                        <th style="padding: 14px 16px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">Guru</th>
                        <th style="padding: 14px 16px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">Kelas</th>
                        <th style="padding: 14px 16px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">Mata Pelajaran</th>
                        <th style="padding: 14px 16px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">Tanggal</th>
                        <th style="padding: 14px 16px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">Hadir</th>
                        <th style="padding: 14px 16px; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; border-bottom: 1px solid rgba(255, 255, 255, 0.05); text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($journals as $journal)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.03); transition: background 0.2s;">
                        <td style="padding: 12px 16px; vertical-align: middle; color: #94a3b8;">{{ $loop->iteration }}</td>
                        <td style="padding: 12px 16px; vertical-align: middle; font-weight: 500; color: #f8fafc;">{{ $journal->teacher_name }}</td>
                        <td style="padding: 12px 16px; vertical-align: middle; color: #e2e8f0;">{{ $journal->class }}</td>
                        <td style="padding: 12px 16px; vertical-align: middle; color: #e2e8f0;">{{ $journal->subject }}</td>
                        <td style="padding: 12px 16px; vertical-align: middle; color: #e2e8f0;">{{ \Carbon\Carbon::parse($journal->date)->format('d-m-Y') }}</td>
                        <td style="padding: 12px 16px; vertical-align: middle;">
                            <span style="background: rgba(16, 185, 129, 0.15); color: #34d399; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                                {{ $journal->present }}
                            </span>
                        </td>
                        <td style="padding: 12px 16px; vertical-align: middle; text-align: center;">
                            <div class="btn-group" role="group" style="gap: 4px;">
                                <!-- SHOW -->
                                <a href="{{ route('guru.journals.show', $journal) }}"
                                    class="btn btn-sm"
                                    style="background: rgba(59, 130, 246, 0.15); color: #60a5fa; border: none; border-radius: 8px; padding: 6px 12px; transition: all 0.2s;"
                                    title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- EDIT -->
                                <a href="{{ route('guru.journals.edit', $journal) }}"
                                    class="btn btn-sm"
                                    style="background: rgba(251, 191, 36, 0.15); color: #fbbf24; border: none; border-radius: 8px; padding: 6px 12px; transition: all 0.2s;"
                                    title="Edit Jurnal">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- PDF -->
                                <a href="{{ route('guru.journals.export-pdf', $journal) }}"
                                    class="btn btn-sm"
                                    style="background: rgba(239, 68, 68, 0.15); color: #f87171; border: none; border-radius: 8px; padding: 6px 12px; transition: all 0.2s;"
                                    title="Export PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>

                                <!-- DELETE - PAKAI MODAL -->
                                <button type="button"
                                    class="btn btn-sm btn-delete-journal"
                                    style="background: rgba(239, 68, 68, 0.1); color: #f87171; border: none; border-radius: 8px; padding: 6px 12px; transition: all 0.2s;"
                                    data-url="{{ route('guru.journals.destroy', $journal) }}"
                                    data-teacher="{{ addslashes($journal->teacher_name) }}"
                                    data-class="{{ addslashes($journal->class) }}"
                                    data-date="{{ \Carbon\Carbon::parse($journal->date)->format('d-m-Y') }}"
                                    title="Hapus Jurnal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3" style="color: #64748b; font-size: 0.85rem;">
    <i class="fas fa-info-circle me-1"></i> Total: <strong style="color: #94a3b8;">{{ $journals->count() }}</strong> jurnal
</div>
@endif

<!-- ========================================== -->
<!-- INCLUDE MODAL DELETE -->
<!-- ========================================== -->
@include('guru.journals.delete')
@endsection