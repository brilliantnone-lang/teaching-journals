@extends('layouts.app')

@section('title', 'Edit Jurnal')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 style="color: #f8fafc;">✏️ Edit Jurnal Mengajar</h1>
    <a href="{{ route('guru.journals.index') }}" class="btn btn-secondary"
        style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); color: #94a3b8; border-radius: 10px; padding: 8px 18px;">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="card" style="background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 16px; overflow: hidden;">
    <div class="card-body" style="padding: 28px;">

        <form action="{{ route('guru.journals.update', $journal) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- ========================================== -->
            <!-- DATA GURU & AKADEMIK -->
            <!-- ========================================== -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Nama Guru <span class="text-danger">*</span></label>
                        <input type="text" name="teacher_name" class="form-control"
                            value="{{ old('teacher_name', $journal->teacher_name) }}" readonly
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">NIP <span class="text-danger">*</span></label>
                        <input type="text" name="nip" class="form-control"
                            value="{{ old('nip', $journal->nip) }}" readonly
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="class" class="form-control @error('class') is-invalid @enderror"
                            value="{{ old('class', $journal->class) }}" required
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        @error('class')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Semester <span class="text-danger">*</span></label>
                        <select name="semester" class="form-control @error('semester') is-invalid @enderror" required
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                            <option value="">Pilih Semester</option>
                            <option value="1" {{ old('semester', $journal->semester) == 1 ? 'selected' : '' }}>1 (Ganjil)</option>
                            <option value="2" {{ old('semester', $journal->semester) == 2 ? 'selected' : '' }}>2 (Genap)</option>
                        </select>
                        @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Mata Pelajaran <span class="text-danger">*</span></label>
                        <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror"
                            value="{{ old('subject', $journal->subject) }}" required
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Hari <span class="text-danger">*</span></label>
                        <select name="day" class="form-control @error('day') is-invalid @enderror" required
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                            <option value="">Pilih Hari</option>
                            <option value="Senin" {{ old('day', $journal->day) == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('day', $journal->day) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('day', $journal->day) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('day', $journal->day) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('day', $journal->day) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ old('day', $journal->day) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                        </select>
                        @error('day')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                            value="{{ old('date', $journal->date) }}" required
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr style="border-color: rgba(255,255,255,0.05);">

            <!-- ========================================== -->
            <!-- JAM & MATERI -->
            <!-- ========================================== -->
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Jam Pelajaran ke- <span class="text-danger">*</span></label>
                        <input type="number" name="lesson_start" class="form-control @error('lesson_start') is-invalid @enderror"
                            value="{{ old('lesson_start', $journal->lesson_start) }}" required
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        @error('lesson_start')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">s.d Jam ke- <span class="text-danger">*</span></label>
                        <input type="number" name="lesson_end" class="form-control @error('lesson_end') is-invalid @enderror"
                            value="{{ old('lesson_end', $journal->lesson_end) }}" required
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        @error('lesson_end')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Jam WITA <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="time" name="time_start" class="form-control @error('time_start') is-invalid @enderror"
                                value="{{ old('time_start', $journal->time_start) }}" required
                                style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                            <span class="input-group-text" style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;">s.d</span>
                            <input type="time" name="time_end" class="form-control @error('time_end') is-invalid @enderror"
                                value="{{ old('time_end', $journal->time_end) }}" required
                                style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        </div>
                        @error('time_start')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('time_end')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label text-white fw-bold">Materi <span class="text-danger">*</span></label>
                <textarea name="material" class="form-control @error('material') is-invalid @enderror"
                    rows="2" required
                    style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">{{ old('material', $journal->material) }}</textarea>
                @error('material')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label text-white fw-bold">Kegiatan Pembelajaran <span class="text-danger">*</span></label>
                <textarea name="learning_activity" class="form-control @error('learning_activity') is-invalid @enderror"
                    rows="3" required
                    style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">{{ old('learning_activity', $journal->learning_activity) }}</textarea>
                @error('learning_activity')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr style="border-color: rgba(255,255,255,0.05);">

            <!-- ========================================== -->
            <!-- PRESENSI SISWA -->
            <!-- ========================================== -->
            <h5 class="fw-bold text-white">📊 Presensi Siswa</h5>

            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Hadir <span class="text-danger">*</span></label>
                        <input type="number" name="present" class="form-control @error('present') is-invalid @enderror"
                            value="{{ old('present', $journal->present) }}" required
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        @error('present')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Izin <span class="text-danger">*</span></label>
                        <input type="number" name="permit" class="form-control @error('permit') is-invalid @enderror"
                            value="{{ old('permit', $journal->permit) }}" required
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        @error('permit')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Sakit <span class="text-danger">*</span></label>
                        <input type="number" name="sick" class="form-control @error('sick') is-invalid @enderror"
                            value="{{ old('sick', $journal->sick) }}" required
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        @error('sick')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label text-white fw-bold">Alpa <span class="text-danger">*</span></label>
                        <input type="number" name="absent" class="form-control @error('absent') is-invalid @enderror"
                            value="{{ old('absent', $journal->absent) }}" required
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        @error('absent')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label text-white">Nama Siswa Izin</label>
                        <input type="text" name="permit_names" class="form-control"
                            value="{{ old('permit_names', $journal->permit_names) }}" placeholder="Pisahkan dengan koma"
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label text-white">Nama Siswa Sakit</label>
                        <input type="text" name="sick_names" class="form-control"
                            value="{{ old('sick_names', $journal->sick_names) }}" placeholder="Pisahkan dengan koma"
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label text-white">Nama Siswa Alpa</label>
                        <input type="text" name="absent_names" class="form-control"
                            value="{{ old('absent_names', $journal->absent_names) }}" placeholder="Pisahkan dengan koma"
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- CATATAN -->
            <!-- ========================================== -->
            <div class="mb-3">
                <label class="form-label text-white fw-bold">Catatan Saat Mengajar</label>
                <textarea name="notes" class="form-control" rows="2"
                    style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">{{ old('notes', $journal->notes) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label text-white fw-bold">
                    <i class="fas fa-pencil-alt" style="color: #fbbf24;"></i> Catatan Kepala Sekolah
                </label>
                <textarea name="catatan_kepsek" class="form-control" rows="3"
                    style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;"
                    placeholder="Catatan dari Kepala Sekolah (opsional)">{{ old('catatan_kepsek', $journal->catatan_kepsek) }}</textarea>
                <small class="text-muted">Catatan ini akan tampil di PDF pada halaman terpisah</small>
            </div>

            <hr style="border-color: rgba(255,255,255,0.05);">

            <!-- ========================================== -->
            <!-- FOTO KEGIATAN -->
            <!-- ========================================== -->
            <h5 class="fw-bold text-white">📷 Foto Kegiatan</h5>

            @if($journal->photo1)
            <div class="mb-2">
                <p class="text-white">Foto 1 saat ini:</p>
                <img src="{{ asset('storage/'.$journal->photo1) }}" style="max-height: 100px; border-radius: 8px;">
            </div>
            @endif

            @if($journal->photo2)
            <div class="mb-2">
                <p class="text-white">Foto 2 saat ini:</p>
                <img src="{{ asset('storage/'.$journal->photo2) }}" style="max-height: 100px; border-radius: 8px;">
            </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-white">Ganti Foto 1</label>
                        <input type="file" name="photo1" class="form-control @error('photo1') is-invalid @enderror" accept="image/*"
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        @error('photo1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max 2MB</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-white">Ganti Foto 2</label>
                        <input type="file" name="photo2" class="form-control @error('photo2') is-invalid @enderror" accept="image/*"
                            style="background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.1);color:white;border-radius:10px;">
                        @error('photo2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max 2MB</small>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TOMBOL -->
            <!-- ========================================== -->
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('guru.journals.index') }}" class="btn btn-secondary"
                    style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);color:#94a3b8;border-radius:10px;padding:8px 24px;">
                    <i class="fas fa-arrow-left me-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary"
                    style="background:linear-gradient(90deg, #4361ee, #3f37c9); color:white; border:none; border-radius:10px; padding:10px 32px; font-weight:600;">
                    <i class="fas fa-save me-2"></i> Update Jurnal
                </button>
            </div>

        </form>

    </div>
</div>
@endsection