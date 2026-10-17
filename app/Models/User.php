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
        'foto',
        'no_hp',
        'alamat',
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

    public function isBendahara(): bool
    {
        return $this->role === 'bendahara';
    }

    public function isRt(): bool
    {
        return $this->role === 'rt' || $this->role === null;
    }

    public function getRoleLabelAttribute(): string
    {
        return $this->role === 'bendahara' ? 'Bendahara' : 'Ketua RT';
    }
}