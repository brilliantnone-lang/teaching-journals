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

    public function guruProfile()
    {
        return $this->hasOne(GuruProfile::class);
    }
    
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }
    
    public function hasCompleteProfile(): bool
    {
        if ($this->role !== 'guru') {
            return true;
        }

        $profile = $this->guruProfile;
        
        if (!$profile) {
            return false;
        }

        return !empty($profile->nama_guru) && !empty($profile->nip_guru);
    }
}