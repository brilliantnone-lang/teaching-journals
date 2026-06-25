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

<!-- ========================================== -->
<!-- FILTER BULAN & EXPORT PDF BULANAN -->
<!-- ========================================== -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-filter"></i> Filter Jurnal
            </div>
            <div class="card-body">
                <form action="{{ route('guru.dashboard') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label text-white">Bulan</label>
                        <select name="month" class="form-control" style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                            @php
                            $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            @foreach($months as $i => $month)
                            <option value="{{ $i + 1 }}" {{ (int)($selectedMonth ?? date('m')) == $i + 1 ? 'selected' : '' }}>
                                {{ $month }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-white">Tahun</label>
                        <select name="year" class="form-control" style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                            @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                            <option value="{{ $y }}" {{ (int)($selectedYear ?? date('Y')) == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i> Tampilkan
                        </button>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <!-- Tombol Export Dengan Catatan -->
                            <button type="button"
                                class="btn btn-success flex-fill btn-export-monthly"
                                data-url="{{ route('guru.dashboard.export-monthly-with-note', ['month' => $selectedMonth ?? date('m'), 'year' => $selectedYear ?? date('Y')]) }}"
                                data-message="Export Jurnal Bulanan dengan Catatan Kepala Sekolah">
                                <i class="fas fa-file-pdf me-1"></i> +Catatan
                            </button>

                            <!-- Tombol Export Tanpa Catatan -->
                            <button type="button"
                                class="btn btn-danger flex-fill btn-export-monthly"
                                data-url="{{ route('guru.dashboard.export-monthly-without-note', ['month' => $selectedMonth ?? date('m'), 'year' => $selectedYear ?? date('Y')]) }}"
                                data-message="Export Jurnal Bulanan Tanpa Catatan Kepala Sekolah">
                                <i class="fas fa-file-pdf me-1"></i> Tanpa
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- DAFTAR JURNAL FILTER -->
<!-- ========================================== -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-list"></i>
                Jurnal
                @php
                $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                $bulanDipilih = $selectedMonth ?? date('m');
                $tahunDipilih = $selectedYear ?? date('Y');
                @endphp
                {{ $namaBulan[(int)$bulanDipilih - 1] }} {{ $tahunDipilih }}
                <span class="badge bg-info ms-2">{{ $journals->count() }} jurnal</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark-custom">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Materi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($journals as $index => $jurnal)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $jurnal->class }}</td>
                                <td>{{ $jurnal->subject }}</td>
                                <td>{{ \Str::limit($jurnal->material, 30) }}</td>
                                <td>{{ \Carbon\Carbon::parse($jurnal->date)->format('d-m-Y') }}</td>
                                <td>
                                    <div class="btn-group" style="gap: 4px; flex-wrap: wrap;">
                                        <a href="{{ route('guru.journals.show', $jurnal) }}"
                                            class="btn btn-sm btn-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('guru.journals.export-pdf', $jurnal) }}"
                                            class="btn btn-sm btn-success" title="PDF + Catatan">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <a href="{{ route('guru.journals.export-pdf', $jurnal) }}?without_note=true"
                                            class="btn btn-sm btn-danger" title="PDF Tanpa Catatan">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Tidak ada jurnal untuk bulan ini.
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

<!-- ========================================== -->
<!-- MODAL KONFIRMASI EXPORT PDF BULANAN -->
<!-- ========================================== -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #1e293b; border: 1px solid rgba(255,255,255,0.05); border-radius: 16px;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.05); padding: 20px 24px;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 48px; height: 48px; background: rgba(16, 185, 129, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-file-pdf" style="color: #34d399; font-size: 1.4rem;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title text-white" id="exportModalLabel" style="font-weight: 700; font-size: 1.2rem; margin: 0;">
                            Export PDF Bulanan
                        </h5>
                        <p class="text-muted" style="margin: 0; font-size: 0.85rem; color: #94a3b8;">
                            <i class="fas fa-info-circle me-1"></i> Konfirmasi sebelum export
                        </p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding: 24px;">
                <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                    <p style="color: #e2e8f0; margin: 0; font-size: 1rem;" id="exportMessage">
                        Apakah Anda yakin ingin mengexport jurnal bulan ini?
                    </p>
                </div>
                <div style="background: rgba(255,255,255,0.03); border-radius: 10px; padding: 14px 16px; border: 1px solid rgba(255,255,255,0.05);">
                    <div style="display: flex; justify-content: space-between; padding: 4px 0; border-bottom: 1px solid rgba(255,255,255,0.03);">
                        <span style="color: #94a3b8;">Bulan</span>
                        <span style="color: #f8fafc; font-weight: 500;">
                            @php
                            $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            {{ $namaBulan[(int)($selectedMonth ?? date('m')) - 1] }} {{ $selectedYear ?? date('Y') }}
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 4px 0;">
                        <span style="color: #94a3b8;">Total Jurnal</span>
                        <span style="color: #f8fafc; font-weight: 500;">{{ $journals->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.05); padding: 16px 24px;">
                <button type="button" class="btn" data-bs-dismiss="modal" style="background: rgba(255,255,255,0.05); color: #94a3b8; border: 1px solid rgba(255,255,255,0.05); border-radius: 10px; padding: 8px 24px; font-weight: 600;">
                    <i class="fas fa-times me-2"></i> Batal
                </button>
                <a href="#" id="exportLink" class="btn" style="background: #34d399; color: #0f172a; border-radius: 10px; padding: 8px 24px; font-weight: 600; text-decoration: none;">
                    <i class="fas fa-file-pdf me-2"></i> Ya, Export
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- JAVASCRIPT MODAL -->
<!-- ========================================== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var exportButtons = document.querySelectorAll('.btn-export-monthly');
        var exportModal = document.getElementById('exportModal');
        var exportMessage = document.getElementById('exportMessage');
        var exportLink = document.getElementById('exportLink');

        if (exportButtons.length > 0) {
            exportButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var url = this.getAttribute('data-url');
                    var message = this.getAttribute('data-message');

                    exportMessage.textContent = message;
                    exportLink.href = url;

                    var modal = new bootstrap.Modal(exportModal);
                    modal.show();
                });
            });
        }
    });
</script>

@endsection