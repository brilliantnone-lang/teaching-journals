@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-user-edit"></i> Edit Profil Guru
            </div>
            <div class="card-body">
                <form action="{{ route('guru.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label text-white">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_guru" class="form-control"
                            value="{{ old('nama_guru', $profile->nama_guru) }}" required
                            style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">NIP <span class="text-danger">*</span></label>
                        <input type="text" name="nip_guru" class="form-control"
                            value="{{ old('nip_guru', $profile->nip_guru) }}" required
                            style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Telepon</label>
                        <input type="text" name="telepon" class="form-control"
                            value="{{ old('telepon', $profile->telepon) }}"
                            style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2"
                            style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">{{ old('alamat', $profile->alamat) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="fas fa-save"></i> Update Profil
                        </button>
                        <a href="{{ route('guru.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
                <!-- ========================================== -->
                <!-- TOMBOL SINKRONISASI -->
                <!-- ========================================== -->
                <div class="mt-3 pt-3" style="border-top: 1px solid rgba(255,255,255,0.05);">
                    <form action="{{ route('guru.profile.sync') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning" style="color: #0f172a; width: 100%;">
                            <i class="fas fa-sync me-2"></i> Sinkronisasi ke Semua Jurnal
                        </button>
                        <small class="text-muted d-block mt-1 text-center">
                            Update nama & NIP di semua jurnal yang sudah dibuat
                        </small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection