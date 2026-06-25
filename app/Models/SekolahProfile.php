<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SekolahProfile extends Model
{
    protected $fillable = [
        'guru_profile_id',
        'logo_kiri',
        'logo_kanan',
        'instansi',
        'dinas',
        'nama_sekolah',
        'alamat_sekolah',
        'kota',
        'website_sekolah',
        'kepala_sekolah',
        'nip_kepala_sekolah',
        'tahun_pelajaran',
    ];

    public function guruProfile()
    {
        return $this->belongsTo(GuruProfile::class);
    }
}