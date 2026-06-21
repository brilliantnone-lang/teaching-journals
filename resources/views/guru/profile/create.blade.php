@extends('layouts.app')

@section('title', 'Lengkapi Profil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-user-plus"></i> Lengkapi Profil Guru
            </div>
            <div class="card-body">
                @if(session('warning'))
                    <div class="alert alert-warning">{{ session('warning') }}</div>
                @endif

                <p class="text-muted">
                    <i class="fas fa-info-circle"></i> 
                    Anda harus mengisi profil terlebih dahulu sebelum bisa membuat jurnal.
                </p>

                <form action="{{ route('guru.profile.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-white">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_guru" class="form-control" 
                               value="{{ old('nama_guru', Auth::user()->name) }}" required
                               style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">NIP <span class="text-danger">*</span></label>
                        <input type="text" name="nip_guru" class="form-control" 
                               value="{{ old('nip_guru') }}" required
                               style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Telepon</label>
                        <input type="text" name="telepon" class="form-control" 
                               value="{{ old('telepon') }}"
                               style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2"
                                  style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">{{ old('alamat') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> Simpan Profil & Lanjutkan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection