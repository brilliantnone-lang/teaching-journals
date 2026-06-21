<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nip',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ========================================== //
    // RELASI
    // ========================================== //
    
    public function guruProfile()
    {
        return $this->hasOne(GuruProfile::class);
    }

    // ========================================== //
    // CEK ROLE
    // ========================================== //
    
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }

    // ========================================== //
    // CEK APAKAH PROFILE GURU SUDAH LENGKAP
    // ========================================== //
    
    public function hasCompleteProfile(): bool
    {
        // Jika admin, tidak perlu profile
        if ($this->role !== 'guru') {
            return true;
        }

        // Cek apakah ada profile dan sudah terisi nama & nip
        $profile = $this->guruProfile;
        
        if (!$profile) {
            return false;
        }

        return !empty($profile->nama_guru) && !empty($profile->nip_guru);
    }
}