<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruProfile extends Model
{
    protected $fillable = [
        'user_id',
        'nama_guru',
        'nip_guru',
        'telepon',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teachingJournals()
    {
        return $this->hasMany(TeachingJournal::class);
    }

    // ✅ RELASI KE SEKOLAH PROFILE
    public function sekolahProfile()
    {
        return $this->hasOne(SekolahProfile::class);
    }

    public static function getByUserId($userId)
    {
        return self::where('user_id', $userId)->first();
    }
}