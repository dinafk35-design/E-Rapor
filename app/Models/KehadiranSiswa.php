<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KehadiranSiswa extends Model
{
    protected $table = 'kehadiran_siswa';

    protected $fillable = [
        'siswa_id',
        'tahun_ajaran',
        'semester',
        'izin',
        'sakit',
        'alpa',
    ];

    protected $casts = [
        'izin' => 'integer',
        'sakit' => 'integer',
        'alpa' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class, 'siswa_id');
    }
}