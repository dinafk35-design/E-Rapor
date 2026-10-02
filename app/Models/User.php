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
        'username',
        'email',
        'email_verified_at',
        'password',
        'role',
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


    /*
    |--------------------------------------------------------------------------
    | RELASI KE DATA SISWA / DATA GURU
    |--------------------------------------------------------------------------
    */

    /**
     * Data siswa yang memakai akun ini.
     */
    public function siswa()
    {
        return $this->hasOne(DataSiswa::class);
    }

    /**
     * Data guru yang memakai akun ini.
     */
    public function guru()
    {
        return $this->hasOne(DataGuru::class);
    }
}
