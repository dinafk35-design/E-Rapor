<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
   protected $table = 'rombel';

    protected $fillable = [
        'nama_rombel','tingkat','sekolah_id','wali_kelas_id',
    ];

    // Relasi ke Data Sekolah
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(DataSekolah::class, 'sekolah_id');
    }

    // Relasi ke Data Siswa
    public function siswa(): HasMany
    {
        return $this->hasMany(DataSiswa::class, 'rombel_id');
    }

    // Relasi ke Guru Mengajar
    public function guruMengajar(): HasMany
    {
        return $this->hasMany(GuruMengajar::class, 'rombel_id');
    }

    // Relasi ke Guru sebagai Wali Kelas
    public function waliKelas(): BelongsTo
    {
        return $this->belongsTo(DataGuru::class, 'wali_kelas_id');
    }
}
