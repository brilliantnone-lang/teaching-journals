<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingJournal extends Model
{
    protected $fillable = [
        'teacher_name',
        'nip',
        'class',
        'semester',
        'subject',
        'day',
        'date',
        'material',
        'lesson_start',
        'lesson_end',
        'time_start',
        'time_end',
        'learning_activity',
        'present',
        'permit',
        'sick',
        'absent',
        'permit_names',
        'sick_names',
        'absent_names',
        'notes',
        'catatan_kepsek',
        'photo1',
        'photo2',
        'guru_profile_id',  // TAMBAHKAN INI
    ];

    // ========================================== //
    // RELASI - HARUS ADA DI MODEL, BUKAN CONTROLLER
    // ========================================== //
    
    public function guruProfile()
    {
        return $this->belongsTo(GuruProfile::class);
    }
}