<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Jurnal Mengajar Harian</title>
    <style>
        /* ======================================== */
        /* PENGATURAN HALAMAN PDF */
        /* ======================================== */
        @page {
            margin-top: 1cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
            margin-left: 2.5cm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000;
            margin: 0;
            padding: 0;
        }

        /* ======================================== */
        /* PAGE BREAK */
        /* ======================================== */
        .page-break {
            page-break-before: always;
        }

        /* ======================================== */
        /* KOP SURAT - HITAM */
        /* ======================================== */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .kop-table td {
            border: none !important;
            padding: 0;
            vertical-align: middle;
        }

        .header-text {
            text-align: center;
            line-height: 1.3;
        }

        .provinsi {
            font-size: 11pt;
            font-weight: bold;
            color: #000;
        }

        .dinas {
            font-size: 12pt;
            font-weight: bold;
            color: #000;
        }

        .sekolah {
            font-size: 18pt;
            font-weight: bold;
            letter-spacing: 1px;
            color: #000;
        }

        .alamat,
        .website {
            font-size: 9pt;
            color: #000;
        }

        .garis-kop {
            border-bottom: 4px solid #000;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        /* ======================================== */
        /* JUDUL - HITAM */
        /* ======================================== */
        .judul-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .judul-dokumen {
            font-size: 15pt;
            font-weight: bold;
            color: #000;
            margin-bottom: 3px;
        }

        .tahun-pelajaran {
            font-size: 12pt;
            font-weight: bold;
            color: #000;
        }

        /* ======================================== */
        /* TABEL UTAMA - BERWARNA */
        /* ======================================== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0;
            font-size: 10pt;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: top;
        }

        th {
            background: #1a3c6e;
            color: white;
            text-align: center;
            font-weight: bold;
        }

        /* ======================================== */
        /* INFO GURU - 6 KOLOM SEJAJAR */
        /* ======================================== */
        .info-guru-table {
            margin: 0 0 10px 0;
        }

        .info-guru-table td {
            border: none !important;
            padding: 2px 4px;
            vertical-align: top;
        }

        .info-guru-table .label {
            font-weight: bold;
            text-align: left;
            width: auto;
        }

        .info-guru-table .value {
            font-weight: normal;
            text-align: left;
        }

        /* ======================================== */
        /* FOTO */
        /* ======================================== */
        .foto-cell {
            height: 120px;
            text-align: center;
            vertical-align: middle;
        }

        .foto-cell img {
            max-width: 100%;
            max-height: 100px;
            object-fit: contain;
        }

        .no-photo {
            color: #777;
        }

        /* ======================================== */
        /* TANDA TANGAN */
        /* ======================================== */
        .signature-table td {
            border: none !important;
            padding: 0;
            font-size: 11pt;
            vertical-align: top;
        }

        .ttd-space {
            height: 50px;
        }

        /* ======================================== */
        /* CATATAN KS */
        /* ======================================== */
        .catatan-ks {
            margin-top: 15px;
            border: 1px solid #000;
            padding: 10px;
        }

        .label-ks {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .garis-ks {
            line-height: 1.8;
        }

        /* ======================================== */
        /* NAMA SISWA - VERTIKAL */
        /* ======================================== */
        .nama-siswa-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nama-siswa-list li {
            display: block;
            padding: 1px 0;
        }

        /* ======================================== */
        /* WEBSITE - WARNA BIRU + GARIS BAWAH */
        /* ======================================== */
        .website-link {
            color: #0000EE;
            font-size: 9pt;
            text-decoration: underline;
        }

        /* ======================================== */
        /* LOGO KIRI - LONJONG/OVAL */
        /* ======================================== */
        .logo-cell-left {
            width: 100px;
            text-align: center;
        }

        .logo-kiri {
            width: 80px;
            height: 100px;
            object-fit: contain;
        }

        /* ======================================== */
        /* LOGO KANAN - TETAP PERSEGI */
        /* ======================================== */
        .logo-cell-right {
            width: 100px;
            text-align: center;
        }

        .logo-kanan {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>

    <!-- ========================================== -->
    <!-- BASE64 LOGO, FOTO, & DATA SEKOLAH -->
    <!-- ========================================== -->
    @php
    // ========================================== //
    // AMBIL DATA SEKOLAH DARI DATABASE
    // ========================================== //
    $sekolah = \App\Models\SekolahProfile::where('guru_profile_id', $journal->guru_profile_id)->first();

    $instansi = $sekolah->instansi ?? 'PEMERINTAH PROVINSI KALIMANTAN SELATAN';
    $dinas = $sekolah->dinas ?? 'DINAS PENDIDIKAN DAN KEBUDAYAAN';
    $namaSekolah = $sekolah->nama_sekolah ?? 'SMK NEGERI 1 BANJARMASIN';
    $alamatSekolah = $sekolah->alamat_sekolah ?? 'Jalan Mulawarman No. 45 Telp & Faxs. 0511-4368225 Banjarmasin 70117';
    $kota = $sekolah->kota ?? 'Banjarmasin';
    $websiteSekolah = $sekolah->website_sekolah ?? 'http://smkn1bjm.sch.id';
    $kepalaSekolah = $sekolah->kepala_sekolah ?? 'Agustin Purnomosari, S.Pd., M.Pd';
    $nipKepsek = $sekolah->nip_kepala_sekolah ?? '197208211998032007';
    $tahunPelajaran = $sekolah->tahun_pelajaran ?? '2025/2026';

    // DEFAULT: dengan catatan kepala sekolah
    $withNote = isset($withNote) ? $withNote : true;

    // ========================================== //
    // LOGO
    // ========================================== //
    $logoKiriBase64 = '';
    if ($sekolah && $sekolah->logo_kiri && file_exists(storage_path('app/public/'.$sekolah->logo_kiri))) {
    $logoKiriPath = storage_path('app/public/'.$sekolah->logo_kiri);
    $logoKiriBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoKiriPath));
    }

    $logoKananBase64 = '';
    if ($sekolah && $sekolah->logo_kanan && file_exists(storage_path('app/public/'.$sekolah->logo_kanan))) {
    $logoKananPath = storage_path('app/public/'.$sekolah->logo_kanan);
    $logoKananBase64 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoKananPath));
    }

    // ========================================== //
    // FOTO JURNAL
    // ========================================== //
    $foto1Base64 = '';
    if ($journal->photo1 && file_exists(storage_path('app/public/'.$journal->photo1))) {
    $foto1Path = storage_path('app/public/'.$journal->photo1);
    $foto1Base64 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($foto1Path));
    }

    $foto2Base64 = '';
    if ($journal->photo2 && file_exists(storage_path('app/public/'.$journal->photo2))) {
    $foto2Path = storage_path('app/public/'.$journal->photo2);
    $foto2Base64 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($foto2Path));
    }

    // ========================================== //
    // FORMAT NAMA SISWA VERTIKAL
    // ========================================== //
    $permitNames = $journal->permit_names ? explode(',', $journal->permit_names) : [];
    $sickNames = $journal->sick_names ? explode(',', $journal->sick_names) : [];
    $absentNames = $journal->absent_names ? explode(',', $journal->absent_names) : [];
    @endphp

    <!-- ========================================== -->
    <!-- HALAMAN 1: ISI JURNAL -->
    <!-- ========================================== -->

    <!-- KOP SURAT -->
    <table class="kop-table">
        <tr>
            <td class="logo-cell-left">
                @if($logoKiriBase64)
                <img src="{{ $logoKiriBase64 }}" class="logo-kiri" alt="Logo Kiri">
                @endif
            </td>

            <td class="header-text">
                <div class="provinsi">{{ $instansi }}</div>
                <div class="dinas">{{ $dinas }}</div>
                <div class="sekolah">{{ $namaSekolah }}</div>
                <div class="alamat">{{ $alamatSekolah }}</div>
                <div class="website-link">{{ $websiteSekolah }}</div>
            </td>

            <td class="logo-cell-right">
                @if($logoKananBase64)
                <img src="{{ $logoKananBase64 }}" class="logo-kanan" alt="Logo Kanan">
                @endif
            </td>
        </tr>
    </table>

    <div class="garis-kop"></div>

    <!-- JUDUL -->
    <div class="judul-container">
        <div class="judul-dokumen">JURNAL MENGAJAR HARIAN GURU</div>
        <div class="tahun-pelajaran">TAHUN PELAJARAN {{ $tahunPelajaran }}</div>
    </div>

    <!-- INFO GURU -->
    <table class="info-guru-table">
        <tr>
            <td class="label" style="width: 90px;">Nama Guru</td>
            <td class="value" style="width: 1px;">:</td>
            <td class="value">{{ $journal->teacher_name }}</td>
            <td style="width: 20px;"></td>
            <td class="label" style="width: 110px;">Mata Pelajaran</td>
            <td class="value" style="width: 1px;">:</td>
            <td class="value">{{ $journal->subject }}</td>
        </tr>
        <tr>
            <td class="label">NIP</td>
            <td class="value">:</td>
            <td class="value">{{ $journal->nip }}</td>
            <td></td>
            <td class="label">Hari</td>
            <td class="value">:</td>
            <td class="value">{{ $journal->day }}</td>
        </tr>
        <tr>
            <td class="label">Kelas/Semester</td>
            <td class="value">:</td>
            <td class="value">{{ $journal->class }} / {{ $journal->semester }}</td>
            <td></td>
            <td class="label">Tanggal</td>
            <td class="value">:</td>
            <td class="value">{{ \Carbon\Carbon::parse($journal->date)->format('d-m-Y') }}</td>
        </tr>
    </table>

    <!-- MATERI & KEGIATAN -->
    <table>
        <tr>
            <th style="width: 18%;">MATERI</th>
            <th style="width: 18%;">JAM PELAJARAN</th>
            <th style="width: 18%;">JAM (WITA)</th>
            <th style="width: 46%;">KEGIATAN PEMBELAJARAN</th>
        </tr>
        <tr>
            <td>{{ $journal->material }}</td>
            <td>ke-{{ $journal->lesson_start }} s.d ke-{{ $journal->lesson_end }}</td>
            <td>{{ \Carbon\Carbon::parse($journal->time_start)->format('H:i') }} s.d {{ \Carbon\Carbon::parse($journal->time_end)->format('H:i') }}</td>
            <td>{{ $journal->learning_activity }}</td>
        </tr>
    </table>

    <!-- PRESENSI SISWA -->
    <table>
        <tr>
            <th colspan="3">PRESENSI SISWA</th>
        </tr>
        <tr>
            <th style="width: 18%;">Keterangan</th>
            <th style="width: 12%;">Jumlah</th>
            <th style="width: 70%;">Nama Siswa</th>
        </tr>
        <tr>
            <td>Hadir</td>
            <td>{{ $journal->present }}</td>
            <td></td>
        </tr>
        <tr>
            <td>Izin</td>
            <td>{{ $journal->permit }}</td>
            <td>
                @if(count($permitNames) > 0)
                <ul class="nama-siswa-list">
                    @foreach($permitNames as $name)
                    <li>{{ trim($name) }}</li>
                    @endforeach
                </ul>
                @else
                -
                @endif
            </td>
        </tr>
        <tr>
            <td>Sakit</td>
            <td>{{ $journal->sick }}</td>
            <td>
                @if(count($sickNames) > 0)
                <ul class="nama-siswa-list">
                    @foreach($sickNames as $name)
                    <li>{{ trim($name) }}</li>
                    @endforeach
                </ul>
                @else
                -
                @endif
            </td>
        </tr>
        <tr>
            <td>Alpa</td>
            <td>{{ $journal->absent }}</td>
            <td>
                @if(count($absentNames) > 0)
                <ul class="nama-siswa-list">
                    @foreach($absentNames as $name)
                    <li>{{ trim($name) }}</li>
                    @endforeach
                </ul>
                @else
                -
                @endif
            </td>
        </tr>
    </table>

    <!-- CATATAN SAAT MENGAJAR -->
    <table>
        <tr>
            <th>CATATAN SAAT MENGAJAR</th>
        </tr>
        <tr>
            <td style="min-height: 35px; padding: 5px 8px;">{{ $journal->notes ?? '-' }}</td>
        </tr>
    </table>

    <!-- FOTO KEGIATAN -->
    <table>
        <tr>
            <th colspan="2">FOTO KEGIATAN</th>
        </tr>
        <tr>
            <td class="foto-cell" style="width: 50%;">
                @if($foto1Base64)
                <img src="{{ $foto1Base64 }}" alt="Foto 1">
                @else
                <span class="no-photo">[Foto 1]</span>
                @endif
            </td>
            <td class="foto-cell" style="width: 50%;">
                @if($foto2Base64)
                <img src="{{ $foto2Base64 }}" alt="Foto 2">
                @else
                <span class="no-photo">[Foto 2]</span>
                @endif
            </td>
        </tr>
    </table>

    <!-- TANDA TANGAN HALAMAN 1 -->
    <table class="signature-table">
        <tr>
            <td style="width: 45%; text-align: center;">
                Mengetahui,<br>
                Kepala Sekolah
                <div class="ttd-space"></div>
                <strong><u>{{ $kepalaSekolah }}</u></strong><br>
                NIP. {{ $nipKepsek }}
            </td>
            <td style="width: 10%;"></td>
            <td style="width: 45%; text-align: center;">
                {{ $kota }}, {{ \Carbon\Carbon::parse($journal->date)->format('d-m-Y') }}<br>
                Guru Mata Pelajaran
                <div class="ttd-space"></div>
                <strong><u>{{ $journal->teacher_name }}</u></strong><br>
                NIP. {{ $journal->nip }}
            </td>
        </tr>
    </table>

    <!-- ========================================== -->
    <!-- PAGE BREAK + CATATAN KEPALA SEKOLAH -->
    <!-- HANYA JIKA withNote = true -->
    <!-- ========================================== -->
    @if($withNote)
    <div class="page-break"></div>

    <!-- HALAMAN 2: CATATAN KEPALA SEKOLAH -->
    <table class="kop-table">
        <tr>
            <td class="logo-cell-left">
                @if($logoKiriBase64)
                <img src="{{ $logoKiriBase64 }}" class="logo-kiri" alt="Logo Kiri">
                @endif
            </td>

            <td class="header-text">
                <div class="provinsi">{{ $instansi }}</div>
                <div class="dinas">{{ $dinas }}</div>
                <div class="sekolah">{{ $namaSekolah }}</div>
                <div class="alamat">{{ $alamatSekolah }}</div>
                <div class="website-link">{{ $websiteSekolah }}</div>
            </td>

            <td class="logo-cell-right">
                @if($logoKananBase64)
                <img src="{{ $logoKananBase64 }}" class="logo-kanan" alt="Logo Kanan">
                @endif
            </td>
        </tr>
    </table>

    <div class="garis-kop"></div>

    <div class="catatan-ks">
        <div class="label-ks">Catatan Kepala Sekolah :</div>
        <div class="garis-ks">
            @if($journal->catatan_kepsek)
            {{ $journal->catatan_kepsek }}
            @else
            ................................................................................................................................................................<br>
            ................................................................................................................................................................<br>
            ................................................................................................................................................................<br>
            ................................................................................................................................................................
            @endif
        </div>
    </div>

    @endif

</body>

</html>