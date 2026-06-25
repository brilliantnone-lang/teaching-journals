@extends('layouts.app')

@section('title', 'Detail Jurnal')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1" style="color: #f8fafc;">📄 Detail Jurnal Mengajar</h1>
            <p class="text-muted" style="font-size: 0.95rem;">Lihat detail lengkap jurnal mengajar harian</p>
        </div>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('guru.journals.index') }}" class="btn btn-secondary" 
               style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); color: #94a3b8; border-radius: 10px; padding: 8px 18px; transition: all 0.2s;">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            <a href="{{ route('guru.journals.edit', $journal) }}" class="btn" 
               style="background: rgba(251, 191, 36, 0.15); border: 1px solid rgba(251, 191, 36, 0.2); color: #fbbf24; border-radius: 10px; padding: 8px 18px; transition: all 0.2s;">
                <i class="fas fa-edit me-2"></i> Edit
            </a>
            <a href="{{ route('guru.journals.export-pdf', $journal) }}" class="btn" 
               style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.2); color: #f87171; border-radius: 10px; padding: 8px 18px; transition: all 0.2s;">
                <i class="fas fa-file-pdf me-2"></i> Export PDF
            </a>
        </div>
    </div>

    <div class="card" style="background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 16px; overflow: hidden;">
        <div class="card-body" style="padding: 28px;">

            <!-- ========================================== -->
            <!-- INFO UMUM -->
            <!-- ========================================== -->
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-6">
                    <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 16px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                            <i class="fas fa-user" style="color: #4cc9f0; font-size: 1.1rem;"></i>
                            <span style="font-weight: 600; color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Informasi Guru</span>
                        </div>
                        <p style="margin-bottom: 6px; color: #e2e8f0;"><strong style="color: #94a3b8;">Nama Guru:</strong> {{ $journal->teacher_name }}</p>
                        <p style="margin-bottom: 0; color: #e2e8f0;"><strong style="color: #94a3b8;">NIP:</strong> {{ $journal->nip }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 16px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                            <i class="fas fa-book-open" style="color: #fbbf24; font-size: 1.1rem;"></i>
                            <span style="font-weight: 600; color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Informasi Akademik</span>
                        </div>
                        <p style="margin-bottom: 6px; color: #e2e8f0;"><strong style="color: #94a3b8;">Kelas/Semester:</strong> {{ $journal->class }} / {{ $journal->semester }}</p>
                        <p style="margin-bottom: 0; color: #e2e8f0;"><strong style="color: #94a3b8;">Mata Pelajaran:</strong> {{ $journal->subject }}</p>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- MATERI & JADWAL -->
            <!-- ========================================== -->
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 16px; text-align: center;">
                    <div style="color: #94a3b8; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Hari & Tanggal</div>
                    <div style="color: #f8fafc; font-weight: 600;">{{ $journal->day }}, {{ \Carbon\Carbon::parse($journal->date)->format('d-m-Y') }}</div>
                </div>
                <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 16px; text-align: center;">
                    <div style="color: #94a3b8; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Jam Pelajaran</div>
                    <div style="color: #f8fafc; font-weight: 600;">ke-{{ $journal->lesson_start }} s.d ke-{{ $journal->lesson_end }}</div>
                </div>
                <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 16px; text-align: center;">
                    <div style="color: #94a3b8; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Jam WITA</div>
                    <div style="color: #f8fafc; font-weight: 600;">{{ \Carbon\Carbon::parse($journal->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($journal->time_end)->format('H:i') }}</div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- MATERI & KEGIATAN -->
            <!-- ========================================== -->
            <div style="background: rgba(67, 97, 238, 0.08); border: 1px solid rgba(67, 97, 238, 0.15); border-radius: 12px; padding: 18px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                    <i class="fas fa-book" style="color: #4cc9f0;"></i>
                    <span style="font-weight: 600; color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Materi</span>
                </div>
                <p style="color: #f8fafc; font-size: 1.05rem; margin-bottom: 0;">{{ $journal->material }}</p>
            </div>

            <div style="background: rgba(16, 185, 129, 0.06); border: 1px solid rgba(16, 185, 129, 0.12); border-radius: 12px; padding: 18px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                    <i class="fas fa-chalkboard-teacher" style="color: #34d399;"></i>
                    <span style="font-weight: 600; color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Kegiatan Pembelajaran</span>
                </div>
                <p style="color: #e2e8f0; margin-bottom: 0;">{{ $journal->learning_activity }}</p>
            </div>

            <!-- ========================================== -->
            <!-- PRESENSI SISWA -->
            <!-- ========================================== -->
            <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 18px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                    <i class="fas fa-users" style="color: #60a5fa;"></i>
                    <span style="font-weight: 600; color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Presensi Siswa</span>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; max-width: 400px;">
                    <div style="background: rgba(16, 185, 129, 0.08); border-radius: 8px; padding: 10px 14px; display: flex; justify-content: space-between; border-left: 3px solid #34d399;">
                        <span style="color: #94a3b8;">Hadir</span>
                        <span style="color: #34d399; font-weight: 600;">{{ $journal->present }}</span>
                    </div>
                    <div style="background: rgba(251, 191, 36, 0.08); border-radius: 8px; padding: 10px 14px; display: flex; justify-content: space-between; border-left: 3px solid #fbbf24;">
                        <span style="color: #94a3b8;">Izin</span>
                        <span style="color: #fbbf24; font-weight: 600;">{{ $journal->permit }}</span>
                    </div>
                    <div style="background: rgba(59, 130, 246, 0.08); border-radius: 8px; padding: 10px 14px; display: flex; justify-content: space-between; border-left: 3px solid #60a5fa;">
                        <span style="color: #94a3b8;">Sakit</span>
                        <span style="color: #60a5fa; font-weight: 600;">{{ $journal->sick }}</span>
                    </div>
                    <div style="background: rgba(239, 68, 68, 0.08); border-radius: 8px; padding: 10px 14px; display: flex; justify-content: space-between; border-left: 3px solid #f87171;">
                        <span style="color: #94a3b8;">Alpa</span>
                        <span style="color: #f87171; font-weight: 600;">{{ $journal->absent }}</span>
                    </div>
                </div>

                <!-- Nama Siswa -->
                <div style="margin-top: 12px; display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; max-width: 600px;">
                    @if($journal->permit_names)
                    <div style="background: rgba(251, 191, 36, 0.05); border-radius: 6px; padding: 6px 12px; border: 1px solid rgba(251, 191, 36, 0.1);">
                        <span style="color: #94a3b8; font-size: 0.7rem; display: block;">Izin</span>
                        <span style="color: #fbbf24; font-size: 0.85rem;">{{ $journal->permit_names }}</span>
                    </div>
                    @endif
                    @if($journal->sick_names)
                    <div style="background: rgba(59, 130, 246, 0.05); border-radius: 6px; padding: 6px 12px; border: 1px solid rgba(59, 130, 246, 0.1);">
                        <span style="color: #94a3b8; font-size: 0.7rem; display: block;">Sakit</span>
                        <span style="color: #60a5fa; font-size: 0.85rem;">{{ $journal->sick_names }}</span>
                    </div>
                    @endif
                    @if($journal->absent_names)
                    <div style="background: rgba(239, 68, 68, 0.05); border-radius: 6px; padding: 6px 12px; border: 1px solid rgba(239, 68, 68, 0.1);">
                        <span style="color: #94a3b8; font-size: 0.7rem; display: block;">Alpa</span>
                        <span style="color: #f87171; font-size: 0.85rem;">{{ $journal->absent_names }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- ========================================== -->
            <!-- CATATAN -->
            <!-- ========================================== -->
            <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 18px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                    <i class="fas fa-pencil-alt" style="color: #94a3b8;"></i>
                    <span style="font-weight: 600; color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Catatan Saat Mengajar</span>
                </div>
                <p style="color: #e2e8f0; margin-bottom: 0;">{{ $journal->notes ?? '-' }}</p>
            </div>

            <!-- ========================================== -->
            <!-- FOTO -->
            <!-- ========================================== -->
            @if($journal->photo1 || $journal->photo2)
            <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 18px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                    <i class="fas fa-camera" style="color: #4cc9f0;"></i>
                    <span style="font-weight: 600; color: #94a3b8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Foto Kegiatan</span>
                </div>
                <div class="row" style="gap: 16px;">
                    @if($journal->photo1)
                    <div class="col-md-6" style="flex: 1; min-width: 200px;">
                        <img src="{{ asset('storage/'.$journal->photo1) }}" 
                             class="img-fluid rounded" 
                             style="max-height: 250px; width: 100%; object-fit: cover; border: 1px solid rgba(255,255,255,0.05);">
                    </div>
                    @endif
                    @if($journal->photo2)
                    <div class="col-md-6" style="flex: 1; min-width: 200px;">
                        <img src="{{ asset('storage/'.$journal->photo2) }}" 
                             class="img-fluid rounded" 
                             style="max-height: 250px; width: 100%; object-fit: cover; border: 1px solid rgba(255,255,255,0.05);">
                    </div>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </div>
@endsection