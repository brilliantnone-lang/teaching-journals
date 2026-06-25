@extends('layouts.app')

@section('title', 'Setting Sekolah')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-2">🏫 Setting Sekolah</h1>
        <p class="text-muted">Isi data sekolah untuk ditampilkan di kop surat jurnal</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <i class="fas fa-school"></i> Data Sekolah
            </div>
            <div class="card-body">
                <form action="{{ route('guru.sekolah.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-white">Logo Kiri</label>
                                @if($sekolah && $sekolah->logo_kiri)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/'.$sekolah->logo_kiri) }}" 
                                             style="max-height:80px; border-radius:8px; border:1px solid rgba(255,255,255,0.1);">
                                    </div>
                                @endif
                                <input type="file" name="logo_kiri" class="form-control" 
                                       style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                                <small class="text-muted">Upload gambar baru untuk mengganti</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">Logo Kanan</label>
                                @if($sekolah && $sekolah->logo_kanan)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/'.$sekolah->logo_kanan) }}" 
                                             style="max-height:80px; border-radius:8px; border:1px solid rgba(255,255,255,0.1);">
                                    </div>
                                @endif
                                <input type="file" name="logo_kanan" class="form-control" 
                                       style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                                <small class="text-muted">Upload gambar baru untuk mengganti</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">Instansi / Pemerintah</label>
                                <input type="text" name="instansi" class="form-control" 
                                       value="{{ old('instansi', $sekolah->instansi ?? '') }}"
                                       placeholder="Contoh: PEMERINTAH PROVINSI KALIMANTAN SELATAN"
                                       style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">Dinas</label>
                                <input type="text" name="dinas" class="form-control" 
                                       value="{{ old('dinas', $sekolah->dinas ?? '') }}"
                                       placeholder="Contoh: DINAS PENDIDIKAN DAN KEBUDAYAAN"
                                       style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control" 
                                       value="{{ old('nama_sekolah', $sekolah->nama_sekolah ?? '') }}"
                                       placeholder="Contoh: SMK NEGERI 1 BANJARMASIN"
                                       style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-white">Alamat Sekolah</label>
                                <textarea name="alamat_sekolah" class="form-control" rows="2"
                                          placeholder="Contoh: Jalan Mulawarman No. 45 Telp & Faxs. 0511-4368225 Banjarmasin 70117"
                                          style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">{{ old('alamat_sekolah', $sekolah->alamat_sekolah ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">Website Sekolah</label>
                                <input type="text" name="website_sekolah" class="form-control" 
                                       value="{{ old('website_sekolah', $sekolah->website_sekolah ?? '') }}"
                                       placeholder="Contoh: http://smkn1bjm.sch.id"
                                       style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">Nama Kepala Sekolah</label>
                                <input type="text" name="kepala_sekolah" class="form-control" 
                                       value="{{ old('kepala_sekolah', $sekolah->kepala_sekolah ?? '') }}"
                                       placeholder="Contoh: Agustin Purnomosari, S.Pd., M.Pd"
                                       style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">NIP Kepala Sekolah</label>
                                <input type="text" name="nip_kepala_sekolah" class="form-control" 
                                       value="{{ old('nip_kepala_sekolah', $sekolah->nip_kepala_sekolah ?? '') }}"
                                       placeholder="Contoh: 197208211998032007"
                                       style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">Tahun Pelajaran</label>
                                <input type="text" name="tahun_pelajaran" class="form-control" 
                                       value="{{ old('tahun_pelajaran', $sekolah->tahun_pelajaran ?? '') }}"
                                       placeholder="Contoh: 2025/2026"
                                       style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);color:white;">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Data Sekolah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection