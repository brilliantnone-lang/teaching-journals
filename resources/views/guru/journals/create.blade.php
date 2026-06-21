@extends('layouts.app')

@section('title', 'Tambah Jurnal')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>📝 Form Jurnal Mengajar Harian</h1>
        <a href="{{ route('journals.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <form action="{{ route('journals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Guru <span class="text-danger">*</span></label>
                    <input type="text" name="teacher_name" class="form-control @error('teacher_name') is-invalid @enderror" 
                           value="{{ old('teacher_name') }}" required>
                    @error('teacher_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">NIP <span class="text-danger">*</span></label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" 
                           value="{{ old('nip') }}" required>
                    @error('nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Kelas <span class="text-danger">*</span></label>
                    <input type="text" name="class" class="form-control @error('class') is-invalid @enderror" 
                           value="{{ old('class') }}" placeholder="Contoh: XII RPL 1" required>
                    @error('class')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Semester <span class="text-danger">*</span></label>
                    <select name="semester" class="form-control @error('semester') is-invalid @enderror" required>
                        <option value="">Pilih Semester</option>
                        <option value="1" {{ old('semester') == 1 ? 'selected' : '' }}>1 (Ganjil)</option>
                        <option value="2" {{ old('semester') == 2 ? 'selected' : '' }}>2 (Genap)</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label fw-bold">Mata Pelajaran <span class="text-danger">*</span></label>
                    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" 
                           value="{{ old('subject') }}" placeholder="Contoh: Pemrograman Web" required>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Hari <span class="text-danger">*</span></label>
                    <select name="day" class="form-control @error('day') is-invalid @enderror" required>
                        <option value="">Pilih Hari</option>
                        <option value="Senin" {{ old('day') == 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ old('day') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ old('day') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ old('day') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ old('day') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ old('day') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    </select>
                    @error('day')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" 
                           value="{{ old('date') }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label fw-bold">Jam Pelajaran ke- <span class="text-danger">*</span></label>
                    <input type="number" name="lesson_start" class="form-control @error('lesson_start') is-invalid @enderror" 
                           value="{{ old('lesson_start') }}" placeholder="1" required>
                    @error('lesson_start')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label fw-bold">s.d Jam ke- <span class="text-danger">*</span></label>
                    <input type="number" name="lesson_end" class="form-control @error('lesson_end') is-invalid @enderror" 
                           value="{{ old('lesson_end') }}" placeholder="2" required>
                    @error('lesson_end')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label fw-bold">Jam WITA <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="time" name="time_start" class="form-control @error('time_start') is-invalid @enderror" 
                               value="{{ old('time_start') }}" required>
                        <span class="input-group-text">s.d</span>
                        <input type="time" name="time_end" class="form-control @error('time_end') is-invalid @enderror" 
                               value="{{ old('time_end') }}" required>
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
            <label class="form-label fw-bold">Materi <span class="text-danger">*</span></label>
            <textarea name="material" class="form-control @error('material') is-invalid @enderror" 
                      rows="2" required>{{ old('material') }}</textarea>
            @error('material')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Kegiatan Pembelajaran <span class="text-danger">*</span></label>
            <textarea name="learning_activity" class="form-control @error('learning_activity') is-invalid @enderror" 
                      rows="3" required>{{ old('learning_activity') }}</textarea>
            @error('learning_activity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr>
        <h5 class="fw-bold">📊 Presensi Siswa</h5>

        <div class="row">
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label fw-bold">Hadir <span class="text-danger">*</span></label>
                    <input type="number" name="present" class="form-control @error('present') is-invalid @enderror" 
                           value="{{ old('present', 0) }}" required>
                    @error('present')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label fw-bold">Izin <span class="text-danger">*</span></label>
                    <input type="number" name="permit" class="form-control @error('permit') is-invalid @enderror" 
                           value="{{ old('permit', 0) }}" required>
                    @error('permit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label fw-bold">Sakit <span class="text-danger">*</span></label>
                    <input type="number" name="sick" class="form-control @error('sick') is-invalid @enderror" 
                           value="{{ old('sick', 0) }}" required>
                    @error('sick')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label fw-bold">Alpa <span class="text-danger">*</span></label>
                    <input type="number" name="absent" class="form-control @error('absent') is-invalid @enderror" 
                           value="{{ old('absent', 0) }}" required>
                    @error('absent')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Nama Siswa Izin</label>
                    <input type="text" name="permit_names" class="form-control" 
                           value="{{ old('permit_names') }}" placeholder="Pisahkan dengan koma">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Nama Siswa Sakit</label>
                    <input type="text" name="sick_names" class="form-control" 
                           value="{{ old('sick_names') }}" placeholder="Pisahkan dengan koma">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Nama Siswa Alpa</label>
                    <input type="text" name="absent_names" class="form-control" 
                           value="{{ old('absent_names') }}" placeholder="Pisahkan dengan koma">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Catatan Saat Mengajar</label>
            <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
        </div>

        <hr>
        <h5 class="fw-bold">📷 Foto Kegiatan</h5>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Foto 1</label>
                    <input type="file" name="photo1" class="form-control @error('photo1') is-invalid @enderror" accept="image/*">
                    @error('photo1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Max 2MB</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Foto 2</label>
                    <input type="file" name="photo2" class="form-control @error('photo2') is-invalid @enderror" accept="image/*">
                    @error('photo2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Max 2MB</small>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('journals.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">💾 Simpan Jurnal</button>
        </div>
    </form>
@endsection